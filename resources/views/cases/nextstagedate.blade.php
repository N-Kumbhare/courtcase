<div class="modal" id="showNextStageDateModal" class="" data-easein="flipYIn" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="nextDate">Next Stage Date</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                {{-- <div class="col-sm-12">
                    <label>Case No: <span id="showCaseName" value=""></span></label>
                    <span id="showCaseNo" value=""></span></label>
                    
                </div> --}}
                <input type="hidden" id="showCaseID" value="">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Next Date:</label>
                        <div class="input-group">
                            <input type="date" name="nextStageDate" id="nextStageDate" class="form-control"
                                value="" />
                        </div>
                        <span class="invalid-feedback" id="nextStageDate_error" style="display: none;"></span>

                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Description:</label>
                        <div class="input-group">
                            <textarea id="nextStageDescriptions" name="nextStageDescriptions" class="form-control"></textarea>
                        </div>
                        <span class="invalid-feedback" id="nextStageDescriptions_error" style="display: none;"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onClick="nextStageSubmit()">Save</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        function nextStageSubmit() {
            var nextStageDate = $('#nextStageDate').val();
            var nextStageDescriptions = $('#nextStageDescriptions').val();
            var caseID = $('#showCaseID').val();
            if(nextStageDate === ''){
                alert('Please Enter Date')
                return false
            }
            if(nextStageDescriptions === ''){
                alert('Please Enter Description')
                return false
            }
            $.ajax({
                url: "{{ route('saveNextStageDate') }}",
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "date": nextStageDate,
                    "description": nextStageDescriptions,
                    "caseID": caseID
                },
                dataType: "json",
                success: function(response) {
                    console.log("response",response);
                    if (response) {
                        $('#showNextStageDateModal').modal('hide');
                        location.reload();
                    } else {
                        alert("Something went wrong please refresh page and try again.")
                    }
                }
            })
        }
    </script>
@endpush
