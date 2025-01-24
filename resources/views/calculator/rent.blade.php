 <div class="row">
     <div class="col-sm-3">
         <div class="form-group">
             <label>Rent Per Month</label>
             <input type="text" name="rentPerMonth" id="rentPerMonth" class="form-control" value="" />
         </div>
     </div>
     <div class="col-sm-3">
         <div class="form-group">
             <label>Interest (%)</label>
             <input type="text" name="rentinterest" id="rentinterest" class="form-control" value="" />
         </div>
     </div>
     <div class="col-sm-6">
         <div class="form-group">
             <label>Outstanding Month</label>
             <input type="text" name="rentOutstandingMonth" id="rentOutstandingMonth" class="form-control"
                 value="" />
         </div>
     </div>
 </div>
 <div class="col-sm-12">
     <div class="form-group row">
         <label class="col-sm-4 col-form-label">Interest Amount</label>
         <div class="col-sm-8 ">
             <input type="text" name="rentInterestAmount" id="rentInterestAmount" class="form-control text-danger"
                 value="0" />
         </div>
     </div>

 </div>
 <div class="row">
     <div class="col-sm-6">
         <div class="form-group row">
             <label class="col-sm-4 col-form-label">Notice Charges</label>
             <div class="col-sm-8">
                 <input type="text" name="rentNoticeCharges" id="rentNoticeCharges" class="form-control"
                     value="" />
             </div>
         </div>
     </div>
     <div class="col-sm-6">
         <div class="form-group row">
             <label class="col-sm-4 col-form-label">Misc Expenses</label>
             <div class="col-sm-8">
                 <input type="text" name="rentMiscExpenses" id="rentMiscExpenses" class="form-control"
                     value="" />
             </div>
         </div>
     </div>
 </div>
 <div class="row">
     <div class="col-sm-6">
         <div class="form-group row">
             <label class="col-sm-4 col-form-label">Total Claim In Suit</label>
             <div class="col-sm-8">
                 <input type="text" name="rentTotalClaimInSuit" id="rentTotalClaimInSuit"
                     class="form-control text-danger" value="0" />
             </div>
         </div>
     </div>
 </div>
 <div class="col-12">
     <input type="button" value="Calculate" onclick="handleTotalClaimInSuit()" class="btn btn-success float-left mb-2">
     <a class="btn btn-primary float-left ml-4" onclick="clearRentWithInterest()">Clear</a>
 </div>
 @push('scripts')
     <script>
        function clearRentWithInterest () {
            var rentPerMonth = $('#rentPerMonth').val('');
             var rentinterest = $('#rentinterest').val('');
             var rentOutstandingMonth = $('#rentOutstandingMonth').val('');
             var rentInterestAmount = $('#rentInterestAmount').val(0);
             var rentNoticeCharges = $('#rentNoticeCharges').val('');
             var rentMiscExpenses = $('#rentMiscExpenses').val('');
             var rentTotalClaimInSuit = $('#rentTotalClaimInSuit').val(0);
        }
         function handleTotalClaimInSuit() {
             var rentPerMonth = $('#rentPerMonth').val();
             var rentinterest = $('#rentinterest').val();
             var rentOutstandingMonth = $('#rentOutstandingMonth').val();
             var rentInterestAmount = $('#rentInterestAmount').val();
             var rentNoticeCharges = $('#rentNoticeCharges').val();
             var rentMiscExpenses = $('#rentMiscExpenses').val();
             var rentTotalClaimInSuit = $('#rentTotalClaimInSuit').val();

             var TotalClaimInSuit = (Number(rentPerMonth) * Number(rentinterest) / 100) + Number(rentOutstandingMonth) +
                 Number(rentNoticeCharges) + Number(rentMiscExpenses)                 
             $('#rentInterestAmount').val((Number(rentPerMonth) * Number(rentinterest) / 100) + Number(rentOutstandingMonth));
             $('#rentTotalClaimInSuit').val(TotalClaimInSuit); 

         }
     </script>
 @endpush
