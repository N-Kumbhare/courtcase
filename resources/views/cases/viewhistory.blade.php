<div class="modal" id="viewHistoryModal" class="" data-easein="flipYIn" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="nextDate">History</h4>
                <button type="button" class="close" onClick="hideModel()" aria-hidden="true">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <div class="col-sm-12">
                    <input type="hidden" id="showCaseID" value="">
                </div>
                <table class="table table-hover text-nowrap table-sm">
                    <thead>
                        <tr>
                            <th>Previous Date</th>
                            <th>Next Date</th>
                            <th>Description</th>

                        </tr>
                    </thead>
                    <tbody id="historyID">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onClick="hideModel()">Close</button>
                <button type="button" class="btn btn-primary" onClick="nextStageSubmit()">Save</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        function viewHistory() {
            var caseID = $('#showCaseID').val();
            $.ajax({
                url: "{{ route('viewHistory') }}",
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "caseID": caseID
                },
                dataType: "json",
                success: function(response) {                    
                    var trHTML = '';
                    if (response) {
                        if (response.length > 0) {
                            $.each(response, function(i, item) {
                                trHTML += '<tr><td>' + item.previousDate + '</td><td>' + item.date +
                                    '</td><td>' + item.description + '</td></tr>';
                            });
                        } else {
                            trHTML += "<tr><td align='center' colspan='3'>No History Found</td></tr>";
                        }
                        $('#historyID').html(trHTML);
                    } else {
                        alert("Something went wrong please refresh page and try again.")
                    }
                }
            })
        }

        function hideModel() {
            $('#historyID').append("");
            $('#viewHistoryModal').modal('hide');
        }
    </script>
@endpush
