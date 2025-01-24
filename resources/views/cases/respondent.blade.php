<div class="modal" id="showRespondentModal" class="" data-easein="flipYIn" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="RespondentName">Respondents</h4>
                <select class="form-control col-sm-3 ml-4" name="appellantRespondentPerson"
                    id="appellantRespondentPerson" onChange="clickRespondentBindOnPersonClick(this.value)">
                    <option value="">Select</option>
                    @foreach ($allrespondent as $data)
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
                        <input type="hidden" name="editRespondentID" id="editRespondentID" value="">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Name</label><span class="validate-color">*</span>
                                <input type="text" name="respondentName" id="respondentName" class="form-control"
                                    value="" placeholder="Name">
                                <span class="invalid-feedback"
                                    id="respondentName
                                respondentName_error"
                                    style="display: none;"></span>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Age:</label>
                                <div class="input-group">
                                    <input type="text" name="respondentAge" id="respondentAge" class="form-control"
                                        placeholder="Age" value="" />
                                </div>
                                <span class="invalid-feedback" id="respondentAge_error" style="display: none;"></span>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Date Of Birth:</label>
                                <div class="input-group">
                                    <input type="date" name="respondentDob" id="respondentDob" class="form-control"
                                        value="" />
                                </div>
                                <span class="invalid-feedback" id="respondentDob_error" style="display: none;"></span>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="job">Job</label><span class="validate-color">*</span>
                                <input type="text" name="respondentJob" id="respondentJob" class="form-control"
                                    placeholder="Job" value="">
                                <span class="invalid-feedback" id="respondentJob_error" style="display: none;"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email:</label>
                                <div class="input-group">
                                    <input type="text" name="respondentEmail" id="respondentEmail"
                                        class="form-control" value="" placeholder="Email" />
                                </div>
                                <span class="invalid-feedback" id="respondentEmail_error" style="display: none;"></span>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="city">City</label><span class="validate-color">*</span>
                                <input type="text" name="respondentCity" id="respondentCity" class="form-control"
                                    value="" placeholder="City">
                                <span class="invalid-feedback" id="respondentCity_error"
                                    style="display: none;"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tahsil:</label>
                                <div class="input-group">
                                    <input type="text" name="respondentTahsil" id="respondentTahsil"
                                        class="form-control" value="" placeholder="Tahsil" />
                                </div>
                                <span class="invalid-feedback" id="respondentTahsil_error"
                                    style="display: none;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="district">District</label><span class="validate-color">*</span>
                                <input type="text" name="respondentDistrict" id="respondentDistrict"
                                    class="form-control" value="" placeholder="District">
                                <span class="invalid-feedback" id="respondentDistrict_error"
                                    style="display: none;"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>State:</label>
                                <div class="input-group">
                                    <input type="text" name="respondentState" id="respondentState"
                                        class="form-control" value="" placeholder="State" />
                                </div>
                                <span class="invalid-feedback" id="respondentState_error"
                                    style="display: none;"></span>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Mobile Number:</label>
                                <div class="input-group">
                                    <input type="text" name="respondentPhone" id="respondentPhone"
                                        class="form-control" value="" placeholder="Phone" />
                                </div>
                                <span class="invalid-feedback" id="respondentPhone_error"
                                    style="display: none;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="respondentAddress">Address</label><span class="validate-color">*</span>
                                <textarea id="respondentAddress" name="respondentAddress" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveRespondentEditButton"
                    onClick="respondantSubmit()">Save</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        function respondantSubmit() {
            var name = $('#respondentName').val();
            var age = $('#respondentAge').val();
            var dob = $('#respondentDob').val();
            var job = $('#respondentJob').val();
            var email = $('#respondentEmail').val();
            var city = $('#respondentCity').val();
            var tahsil = $('#respondentTahsil').val();
            var district = $('#respondentDistrict').val();
            var state = $('#respondentState').val();
            var phone = $('#respondentPhone').val();
            var address = $('#respondentAddress').val();
            var editRespondentID = $('#editRespondentID').val();
            var caseID = "{{ request()->route()->parameters['case'] }}";

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
                "id": ((editRespondentID !== "" && editRespondentID !== undefined) ? editRespondentID : ""),
                "caseID": caseID
            }
            $.ajax({
                url: (editRespondentID !== "" && editRespondentID !== undefined) ? "{{ route('editRespondent') }}" :
                    "{{ route('saveRespondent') }}",
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                dataType: "json",
                success: function(response) {
                    if (response) {
                        $('#showRespondentModal').modal('hide');
                        location.reload();
                    } else {
                        alert("Something went wrong please refresh page and try again.")
                    }
                }
            })
        }

        function clickRespondentBindOnPersonClick(id) {
            $.ajax({
                url: "{{ route('getRespondetBind') }}",
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
                        $('#respondentName').val(response.name);
                        $('#respondentAge').val(response.age);
                        $('#respondentDob').val(response.dob);
                        $('#respondentJob').val(response.job);
                        $('#respondentEmail').val(response.email);
                        $('#respondentCity').val(response.city);
                        $('#respondentTahsil').val(response.tahsil);
                        $('#respondentDistrict').val(response.district);
                        $('#respondentState').val(response.state);
                        $('#respondentPhone').val(response.phone);
                        $('#respondentAddress').val(response.address);
                    } else {
                        alert("Something went wrong please refresh page and try again.")
                    }
                }
            })
        }
    </script>
@endpush
