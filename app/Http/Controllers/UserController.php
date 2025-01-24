<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\State;
use App\Models\District;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
class UserController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){ 
		$this->middleware('auth');
    }
    public function index()
    { 
        // dd(Auth::user());
        if(Auth::user()->isAdmin == '1'){
            $users = DB::table('users')
                    ->leftjoin('states', 'states.StCode', '=', 'users.state') 
                    ->leftjoin('districts', 'districts.DistCode', '=', 'users.district') 
                    ->select('users.*', 'states.StateName as state','districts.DistrictName as district')                
                    ->get();  
            }else{
                $users = DB::table('users')
                ->leftjoin('states', 'states.StCode', '=', 'users.state') 
                ->leftjoin('districts', 'districts.DistCode', '=', 'users.district') 
                ->select('users.*', 'states.StateName as state','districts.DistrictName as district')                
                ->where('users.id','=',Auth::user()->id)
                ->get();                

            }
                // dd($users);
        return view('users.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');

    }
	 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
 	  // $request->validate([
      //       'fname'=>'required',
      //       'lname'=>'required',
      //       'group'=>'required',
      //       'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      //       'phone'=>'required',
      //       'gender'=>'required',
      //       'password' => ['required', 'string', 'min:8', 'confirmed'],
      //       'password_confirmation' => ['required', 'string', 'min:8', 'confirmed'],
      //       'status'=>'required'
      //   ]);

        $users = new User([
            'name' => $request->get('fname'),
            'fname' => $request->get('fname'),
            'lname' => $request->get('lname'),
            'email' => $request->get('email'),
            'group' => $request->get('group'),
            'phone' => $request->get('phone'),
            'gender' => $request->get('gender'),
            'password' => Hash::make($request->get('password')),
            'status' => $request->get('status')
        ]);
         
        $users->save();
        return redirect('/users')->with('success', 'User saved!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    { 
        $data = User::where("id",$request->id)->first();

        return response()->json(['data'=> $data]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    { 
        $state = State::get(); 
        $user = DB::table('users')
                ->leftjoin('states', 'states.StCode', '=', 'users.state') 
                ->leftjoin('districts', 'districts.DistCode', '=', 'users.district') 
                ->select('users.*', 'states.StateName as stateName','districts.DistrictName as districtName')
                ->where('users.id','=',$user->id)
                ->get(); 
                $user = $user[0];  
                //  dd($user);
        return view('users.edit',compact('user','state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    { 
        $user->update($request->all()); 
        return redirect()->route('users.index')
                        ->with('success','user updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
  
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
    public function getDistrict(Request $request)
    {
        $district = District::where('StCode','=',$request->val)->get();
        return response()->json($district);
    }
}
