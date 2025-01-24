@extends('layouts.app')

@section('content')
    <style type="text/css">
        .img-wraps {
            position: relative;
            display: inline-block;

            font-size: 0;
        }

        .img-wraps .closes {
            position: absolute;
            top: 5px;
            right: 8px;
            z-index: 100;
            background-color: #FFF;
            padding: 4px 3px;

            color: #000;
            font-weight: bold;
            cursor: pointer;

            text-align: center;
            font-size: 22px;
            line-height: 10px;
            border-radius: 50%;
            border: 1px solid red;
        }

        .img-wraps:hover .closes {
            opacity: 1;
        }
    </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Case Attachment List </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Case Attachment List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Case Files</h3>
                </div>
                <div class="card-body">
                    <div id="actions" class="row">
                        <div class="col-lg-6">
                            <div class="btn-group w-100">
                                <span class="btn btn-success col fileinput-button">
                                    <i class="fas fa-plus"></i>
                                    <span>Add files</span>
                                </span>
                                <button type="submit" class="btn btn-primary col start">
                                    <i class="fas fa-upload"></i>
                                    <span>Start upload</span>
                                </button> 
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center">
                            <div class="fileupload-process w-100">
                                <div id="total-progress" class="progress progress-striped active" role="progressbar"
                                    aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table table-striped files" id="previews">
                        <div id="template" class="row mt-2">
                            <div class="col-auto">
                                <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                            </div>
                            <div class="col d-flex align-items-center">
                                <p class="mb-0">
                                    <span class="lead" data-dz-name></span>
                                    (<span data-dz-size></span>)
                                </p>
                                <strong class="error text-danger" data-dz-errormessage></strong>
                            </div>
                            <div class="col-4 d-flex align-items-center">
                                <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0"
                                    aria-valuemax="100" aria-valuenow="0">
                                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <div class="btn-group">
                                    <button class="btn btn-primary start">
                                        <i class="fas fa-upload"></i>
                                        <span>Start</span>
                                    </button>
                                    {{-- <button data-dz-remove class="btn btn-warning cancel">
                                        <i class="fas fa-times-circle"></i>
                                        <span>Cancel</span>
                                    </button> --}}
                                    <button data-dz-remove class="btn btn-danger delete">
                                        <i class="fas fa-trash"></i>
                                        <span>Delete</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">List Of files Associated with case</h3>
                </div>
                <div class="card-body">
                    @foreach ($getCaseAttachments as $imgs)
                    @php
                    $ext = pathinfo($imgs->fileName, PATHINFO_EXTENSION); 
                    if($ext === 'pdf'){ 
                        
                    @endphp
                    <div class="pr-2">
                            <span class="closes" title="Delete"
                                onClick="deleteImage({{ $imgs->id }},{{ $imgs->caseID }})">×</span>
                            <div><a href="{{asset('storage/uploads/' . $imgs->caseID . '/' . $imgs->tmpPath)}}" height="150px" width="150px">
                                <img class="img-responsive" src="{{ asset('img/pdfthumbnail.png')}}" height="150px"
                                width="150px">
                                </a></div>
                        </div>                        
                        @php
                    }else{
                         
                        @endphp
                        <div class="img-wraps pr-2">
                            <span class="closes" title="Delete"
                                onClick="deleteImage({{ $imgs->id }},{{ $imgs->caseID }})">×</span>
                            <img class="img-responsive"
                                src="{{ asset('storage/uploads/' . $imgs->caseID . '/' . $imgs->tmpPath) }}" height="150px"
                                width="150px">
                        </div>
                        @php
                    }
                        @endphp
                    @endforeach
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        function deleteImage(val, caseid) {
            let confirms = confirm("Are you sure! you want to delete this?");
            if (confirms === true) { 
                $.ajax({
                    url: "{{ route('deleteCaseAttachment') }}",
                    type: "post",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: val,
                        caseID: caseid
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response) {
                            location.reload();
                        } else {
                            alert("Something went wrong please refresh page and try again.")
                        }
                    }
                })
            }
        }
        Dropzone.autoDiscover = false

        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template")
        previewNode.id = ""
        var previewTemplate = previewNode.parentNode.innerHTML
        previewNode.parentNode.removeChild(previewNode)

        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
            url: "{{ route('fileStoreUpload', request()->route()->parameters['caseid']) }}", // Set the url
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            maxFilesize: 10,
            parallelUploads: 20,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf",
            previewTemplate: previewTemplate,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                 location.reload();
            },
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#previews", // Define the container to display the previews
            clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
        })

        myDropzone.on("addedfile", function(file) {
            // Hookup the start button
            console.log("file", file);
            file.previewElement.querySelector(".start").onclick = function() {
                myDropzone.enqueueFile(file)
            }
        })

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function(progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
        })

        myDropzone.on("sending", function(file) {
            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1"
            // And disable the start button
            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
        })

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function(progress) {
            document.querySelector("#total-progress").style.opacity = "0"
        })

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#actions .start").onclick = function() {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
        }
        document.querySelector("#actions .cancel").onclick = function() {
            myDropzone.removeAllFiles(true)
        }
    </script>
@endpush
