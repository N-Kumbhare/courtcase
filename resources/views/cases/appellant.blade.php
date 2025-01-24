<div class="modal" id="showAppelantModal" class="" data-easein="flipYIn" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ProductName">Appellant</h4>

                <select class="form-control col-sm-3 ml-4" name="appellantPerson" id="appellantPerson"
                    onChange="clickBindOnPersonClick(this.value)">
                    <option value="">Select</option>
                    @foreach ($allappellant as $data)
                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
                </select>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <input type="hidden" name="editAppellentID" id="editAppellentID" value="">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Name</label><span class="validate-color">*</span>
                                <input type="text" name="appellantName" id="appellantName" class="form-control"
                                    value="{{ old('name') }}" placeholder="Name">
                                <span class="invalid-feedback"
                                    id="appellantName
                                appellantName_error"
                                    style="display: none;"></span>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Age:</label>
                                <div class="input-group">
                                    <input type="text" name="age" id="age" class="form-control"
                                        value="" placeholder="Age" />
                                </div>
                                <span class="invalid-feedback" id="age_error" style="display: none;"></span>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date Of Birth:</label>
                                <div class="input-group">
                                    <input type="date" name="dob" id="dob" class="form-control"
                                        value="" />
                                </div>
                                <span class="invalid-feedback" id="dob_error" style="display: none;"></span>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="job">Job</label><span class="validate-color">*</span>
                                <input type="text" name="job" id="job" class="form-control"
                                    value="{{ old('job') }}" placeholder="Job">
                                <span class="invalid-feedback" id="job_error" style="display: none;"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email:</label>
                                <div class="input-group">
                                    <input type="text" name="email" id="email" class="form-control"
                                        value="" placeholder="Email" />
                                </div>
                                <span class="invalid-feedback" id="email_error" style="display: none;"></span>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="city">City</label><span class="validate-color">*</span>
                                <input type="text" name="city" id="city" class="form-control" value=""
                                    placeholder="City">
                                <span class="invalid-feedback" id="city_error" style="display: none;"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tahsil:</label>
                                <div class="input-group">
                                    <input type="text" name="tahsil" id="tahsil" class="form-control"
                                        value="" placeholder="Tahsil" />
                                </div>
                                <span class="invalid-feedback" id="tahsil_error" style="display: none;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="district">District</label><span class="validate-color">*</span>
                                <input type="text" name="district" id="district" class="form-control"
                                    value="" placeholder="District">
                                <span class="invalid-feedback" id="district_error" style="display: none;"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>State:</label>
                                <div class="input-group">
                                    <input type="text" name="state" id="state" class="form-control"
                                        value="" placeholder="State" />
                                </div>
                                <span class="invalid-feedback" id="state_error" style="display: none;"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Mobile Number:</label>
                                <div class="input-group">
                                    <input type="text" name="phone" id="phone" class="form-control"
                                        value="" placeholder="Phone" />
                                </div>
                                <span class="invalid-feedback" id="phone_error" style="display: none;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="address">Address</label><span class="validate-color">*</span>
                                <textarea id="address" name="address" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="saveEditButton" class="btn btn-primary" onClick="submit()">Save</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        function submit() {
            var editAppellentID = $('#editAppellentID').val();
            var name = $('#appellantName').val();
            var age = $('#age').val();
            var dob = $('#dob').val();
            var job = $('#job').val();
            var email = $('#email').val();
            var city = $('#city').val();
            var tahsil = $('#tahsil').val();
            var district = $('#district').val();
            var state = $('#state').val();
            var phone = $('#phone').val();
            var address = $('#address').val();
            var caseID = "{{ request()->route()->parameters['case'] }}";
            console.log("editAppellentID", editAppellentID);
            const data = {
                "name": name,
                "age": age,
                "dob": dob,
                "job": job,
                "email": email,
                "city": city,
                "tahsil": tahsil,
                "district": district,
                "state": state,
                "phone": phone,
                "address": address,
                "id": ((editAppellentID !== "" && editAppellentID !== undefined) ? editAppellentID : ""),
                "caseID": caseID
            }
            $.ajax({
                url: (editAppellentID !== "" && editAppellentID !== undefined) ? "{{ route('editAppellant') }}" :
                    "{{ route('saveAppellant') }}",
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                dataType: "json",
                success: function(response) {
                    if (response) {
                        $('#showAppelantModal').modal('hide');
                        location.reload();
                    } else {
                        alert("Something went wrong please refresh page and try again.")
                    }
                }
            })
        }

        function clickBindOnPersonClick(id) {
            $.ajax({
                url: "{{ route('getAppellantToBind') }}",
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "id": id
                },
                dataType: "json",
                success: function(response) { 
                    if (response) {
                        $('#age').val(response.age);
                        $('#dob').val(response.dob);
                        $('#job').val(response.job);
                        $('#email').val(response.email);
                        $('#city').val(response.city);
                        $('#tahsil').val(response.tahsil);
                        $('#district').val(response.district);
                        $('#state').val(response.state);
                        $('#phone').val(response.phone);
                        $('#address').val(response.address);
                        $('#appellantName').val(response.name);
                    } else {
                        alert("Something went wrong please refresh page and try again.")
                    }
                }
            })
        }
    </script>
@endpush
