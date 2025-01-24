<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cases;
 use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
// use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;
use Auth;
use App\Models\Appellant;
use App\Models\Respondent;
use App\Models\Nextstage;
use DB;
use App\Models\Caseattachment;
use Storage;

class CaseController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
     }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {   
        $userID = '';
        if(Auth::user()->isAdmin == 1) {
            $userID = '1 =1';
        }else{
            $userID = 'C.userID = '.Auth::user()->id;
        } 
        $data = DB::select("
        SELECT 
			C.id AS id,
			C.userID AS userID,
			N.id AS nextStageID,	 
			C.name AS casename, 
            C.caseNo as caseNo,
            C.districtCourtID,
            D.name AS districtCourtName,
            C.courtID,
            CC.name AS courtName,
			IF(C.caseRegion = '1', 'District','High') AS caseRegion,
			N.caseID AS nextStageCaseID,
			DATE_FORMAT(C.caseDate,'%d/%m/%Y')  AS caseDate,
			DATE_FORMAT(N.date,'%d/%m/%Y') AS nextDate,            
	        DATE_FORMAT(N.previousDate,'%d/%m/%Y') AS previousDate
		FROM 
			cases C 
		LEFT JOIN 
			(SELECT * FROM `nextstages` N WHERE N.caseID IN (SELECT id FROM cases WHERE id = N.caseID) AND id IN(SELECT MAX(id) FROM nextstages GROUP BY caseID) ORDER BY N.id DESC) AS N
		ON 
			C.id = N.caseID
        LEFT JOIN 
			districtcourts D
		ON 
			D.id = C.districtCourtID
        LEFT JOIN 
			courts CC
		 ON
			C.courtID = CC.id
		WHERE
             ".$userID."
		ORDER BY 
			C.id DESC;
        ");
    //  dd($data);
        if ($request->ajax()) { 
             return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){  
                    return $this->getActionColumn($row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('cases.index', compact('data')); 
    }   
    protected function getActionColumn($data){
          
        $deleteUrl = route('cases.destroy',$data->id);
        $editUrl = route('cases.edit', $data->id); 
        $fileUrl = route('fileUploads', $data->id); 
        return '<a title="Send SMS" class="btn btn-dark btn-sm"><i class="fas fa-phone" onClick="sendSmsTo('.$data->id.')"></i></a>
        <a title="View Case History" class="btn btn-info btn-sm"><i class="fas fa-history" onClick="showHistoryModel('.$data->id.')"></i></a>
        <a title="Next Stage Date" class="btn btn-warning btn-sm"><i class="fas fa-calendar-alt" onClick="showNextStageDateModal('.$data->id.')"></i></a>
        <a title="Upload Case Attachments" href="'.$fileUrl.'" class="btn btn-success btn-sm">
        <i class="fas fa-upload"></i>
        </a> 
        <a title="Edit case" href="'.$editUrl.'" class="btn btn-primary btn-sm">
        <i class="fas fa-edit"></i>
        </a> 
        <a title="Delete case" onClick="deleteCase('.$data->id.')"  class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
        </a>';
    }
    public function fileUploads($id)
    { 
        $getCaseAttachments = Caseattachment::where('caseID','=',$id)->get();  
        return view('cases.casefiles',compact('getCaseAttachments'));
    }

    public function fileStoreUpload(Request $request)
    { 
        $path = storage_path('app/public/uploads/'.request()->route()->parameters['caseid']);
        
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        } 
        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);
        
        $caseattachment = new Caseattachment([
            'userID'=>Auth::user()->id, 
            'caseID'=> request()->route()->parameters['caseid'],
            'tmpPath'=> $name,
            'fileName'=> $file->getClientOriginalName()             
        ]); 
        $caseattachment->save();
        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
         
    }
    public function deleteCaseAttachment(Request $request)
    {
        $caseattachment =  Caseattachment::findOrFail($request->id);
        if(unlink(public_path("storage/uploads/".$request->caseID.'/'.$caseattachment->tmpPath))){
            $caseattachment->delete();  
        } 
        return response()->json($caseattachment);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $caseTypes = Cases::getCaseTypesList();
        // dd( $caseTypes);
        $briefs = Cases::getBriefsList();
        $courts = Cases::getCourtsList();
        $matters = Cases::getMattersList();  
        $districtCourtList = Cases::getDistrictCourtList();
        return view('cases.create', compact('caseTypes','briefs','courts','matters','districtCourtList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
dd($request->all());
        // $validator = Validator::make($request->all(), [
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        // ])->validate();  
        // dd($request);
        // $imageName = time().'.'.$request->image->extension();  
        $cases = new Cases([
            'userID'=>Auth::user()->id,
            'name'=> $request->get('name'),
            'caseNo'=> $request->get('caseNo'),
            'descriptions'=> $request->get('descriptions'),
            'caseDate'=> $request->get('caseDate'),
            'districtCourtID'=> $request->get('districtCourtID'),
            'matterID' => $request->get('matters'),
            'briefID' => $request->get('briefs'),
            'courtID' => $request->get('courts'),
            'caseRegion' => $request->get('caseRegion'), 
            'casetypeID' => $request->get('casetypes')
        ]);

        // $request->image->move(public_path('images\products'), $imageName);
        $cases->save();
        return \Redirect::route('cases.edit', $cases->id)->with('success', 'Case saved you can now add Appellent and Respondent!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cases $cases) 
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $caseTypes = Cases::getCaseTypesList();
        $briefs = Cases::getBriefsList();
        $courts = Cases::getCourtsList();
        $matters = Cases::getMattersList();  
        $districtCourtList = Cases::getDistrictCourtList();
        $cases = Cases::findOrFail($id); 
        // dd($cases);
        $appellant = Appellant::where('caseID','=',request()->route()->parameters['case'])
                        ->where('userID','=',Auth::user()->id)
                        ->latest()
                        ->get(); 
             
        $respondent = Respondent::where('caseID','=',request()->route()->parameters['case'])
                                ->where('userID','=',Auth::user()->id)
                                ->latest()
                                ->get(); 
        $allappellant = Appellant::latest()->get(); 
        $allrespondent = Respondent::latest()->get(); 
        return view('cases.edit',compact('cases','caseTypes','briefs','courts','matters','appellant','respondent','allappellant','allrespondent','districtCourtList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // dd($request->all());
        $cases = Cases::findOrFail($id);
        $requestData['userID'] =Auth::user()->id;
        $requestData['name'] = $request->get('name');
        $requestData['descriptions'] = $request->get('descriptions');
        $requestData['caseDate'] = $request->get('caseDate');
        $requestData['caseNo']= $request->get('caseNo');
        $requestData['districtCourtID'] = $request->get('districtCourtID');
        $requestData['briefID'] = $request->get('briefs');
        $requestData['courtID'] = $request->get('courts');
        $requestData['casetypeID'] = $request->get('casetypes');
        $requestData['matterID'] = $request->get('matters');
        // $requestData['caseRegion'] = $request->get('caseRegion');
        $requestData['recordRoom'] = !empty($request->get('recordRoom')) ? "1" :"0";
        
        // dd($requestData);
         // $requestData = $request->all();
        // dd($requestData);
        // if ($request->hasFile('image')){
        //      $validator = Validator::make($request->all(), [
        //         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024'
        //     ])->validate();
        //     $imageName = time().'.'.$request->image->extension();  
        //     $requestData['image'] = $imageName; 
        //     $request->image->move(public_path('images\products'), $imageName);
        // }
        $cases->update($requestData); 
        return redirect()->route('cases.index')
                        ->with('success','Case updated successfully');
    } 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $id)
    {
       
        $cases = Cases::findOrFail($id);
        $cases->delete(); 
        return redirect()->route('cases.index')
                        ->with('success','Case deleted successfully');
    }
    public function deleteCase(Request $id) {
         $cases = Cases::findOrFail($id->get('id'));
        $cases->delete(); 
        return redirect()->route('cases.index')
        ->with('success','Case deleted successfully');
    } 
    // public function viewImport(){
        
    //     return view('products.import');
    // }

    // public function importProduct(Request $request) 
    // { 
    //     $validator = Validator::make($request->all(), [
    //         'file' => 'required|mimes:xls,xlsx,csv|max:200'
    //     ])->validate(); 
    //     Excel::import(new ProductsImport,request()->file('file'));
           
    //     return back()->with('success','Product Imported successfully');;
    // }
    public function saveAppellant(Request $request){
         $appellant = new Appellant([
            'userID'=>Auth::user()->id,
            'name'=> $request->get('name'),
            'dob'=> $request->get('dob'),
            'job'=> $request->get('job'),
            'age' => $request->get('age'),
            'address' => $request->get('address'),
            'city' => $request->get('city'),
            'tahsil' => $request->get('tahsil'),
            'district' => $request->get('district'),
            'state' => $request->get('state'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'), 
            'caseID' => $request->get('caseID'),             
        ]); 
        $response = $appellant->save();         
        return response()->json($response);
    }
    public function saveRespondent(Request $request){
        $respondent = new Respondent([
           'userID'=>Auth::user()->id,
           'name'=> $request->get('name'),
           'dob'=> $request->get('dob'),
           'job'=> $request->get('job'),
           'age' => $request->get('age'),
           'address' => $request->get('address'),
           'city' => $request->get('city'),
           'tahsil' => $request->get('tahsil'),
           'district' => $request->get('district'),
           'state' => $request->get('state'),
           'phone' => $request->get('phone'),
           'email' => $request->get('email'), 
           'caseID' => $request->get('caseID'), 
       ]);  
       $response = $respondent->save();     
        return response()->json($response);
   }
   
    public function getAppellant(Request $request){
        $data = Appellant::findOrFail($request->get('id')); 
        return response()->json($data);
    }
    public function editAppellant(Request $request){
        $findID = Appellant::findOrFail($request->get('id'));  
        $requestData['address'] = $request->get('address');
        $requestData['age'] = $request->get('age');
        $requestData['city'] = $request->get('city'); 
        $requestData['district'] = $request->get('district');
        $requestData['dob'] = $request->get('dob');
        $requestData['email'] = $request->get('email');
        $requestData['job'] = $request->get('job');
        $requestData['name'] = $request->get('name');
        $requestData['phone'] = $request->get('phone');
        $requestData['state'] = $request->get('state');
        $requestData['tahsil'] = $request->get('tahsil');
        $requestData['caseID'] = $request->get('caseID');

        $response = $findID->update($requestData); 
        return response()->json($response);
    }
    public function deleteAppellant(Request $request){
        $appellent = Appellant::findOrFail($request->get('id'));   
        $response = $appellent->delete(); 
        return response()->json($response);
    }
    public function getRespondent(Request $request){
        $data = Respondent::findOrFail($request->get('id')); 
        return response()->json($data);
    }
    public function editRespondent(Request $request){
        $findID = Respondent::findOrFail($request->get('id'));  
        $requestData['address'] = $request->get('address');
        $requestData['age'] = $request->get('age');
        $requestData['city'] = $request->get('city'); 
        $requestData['district'] = $request->get('district');
        $requestData['dob'] = $request->get('dob');
        $requestData['email'] = $request->get('email');
        $requestData['job'] = $request->get('job');
        $requestData['name'] = $request->get('name');
        $requestData['phone'] = $request->get('phone');
        $requestData['state'] = $request->get('state');
        $requestData['tahsil'] = $request->get('tahsil');
        $requestData['caseID'] = $request->get('caseID');

        $response = $findID->update($requestData); 
        return response()->json($response);
    }
    public function deleteRespondent(Request $request){
        $appellent = Respondent::findOrFail($request->get('id'));   
        $response = $appellent->delete(); 
        return response()->json($response);
    }
    public function getAppellantToBind(Request $request){
        $appellent = Appellant::findOrFail($request->get('id')); 
         return response()->json($appellent); 
    }
    public function getRespondetBind(Request $request){
        $respondent = Respondent::findOrFail($request->get('id')); 
         return response()->json($respondent); 
    }

    
    public function saveNextStageDate(Request $request){
        $caseDate = ""; 
        $nextStagePreviousDate=\DB::table('nextstages')->Where('caseID', $request->get('caseID'))
        ->latest('id')->first();
        if(($nextStagePreviousDate) === null){
            $caseDate = Cases::findorfail($request->get('caseID'))->caseDate;
        }else{
            $caseDate = $nextStagePreviousDate->date;
        }
        $nextstage = new Nextstage([
           'userID'=>Auth::user()->id,
           'date'=> $request->get('date'),
           'description'=> $request->get('description'),
           'caseID' => $request->get('caseID'), 
           'previousDate' => $caseDate
        ]);  
         
        $response = $nextstage->save();     
        return response()->json($response);
   }

   public function viewHistory(Request $request){
        $getStageHistory = \DB::table('nextstages')->Where('caseID', $request->get('caseID'))->get();
        
        return response()->json($getStageHistory);

   }
}
