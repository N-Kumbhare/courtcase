 <div class="row">
     <div class="col-sm-3">
         <div class="form-group">
             <label>Outstanding Amount</label>
             <input type="text" name="suitValueOutstandingAmount" id="suitValueOutstandingAmount" class="form-control"
                 value="" />
         </div>
     </div>
     <div class="col-sm-3">
         <div class="form-group">
             <label>Interest (%)</label>
             <input type="text" name="suitValueInterest" id="suitValueInterest" class="form-control"
                 value="" />
         </div>
     </div>
     <div class="col-sm-3">
         <div class="form-group">
             <label>From</label>
             <div class="input-group">
                 <input type="date" name="suitClaimFromdate" id="suitClaimFromdate" class="form-control"
                     value="" />
             </div>
         </div>
     </div>
     <div class="col-sm-3">
         <div class="form-group">
             <label>To</label>
             <div class="input-group">
                 <input type="date" name="suitClaimToDate" id="suitClaimToDate" class="form-control"
                     value="" />
             </div>
         </div>
     </div>
 </div>
 <div class="row">
     <div class="col-sm-6">
         <div class="form-group row">
             <label class="col-sm-4 col-form-label">Interest Due</label>
             <div class="col-sm-8">
                 <input type="text" name="suitClaimInterestDue" id="suitClaimInterestDue"
                     class="form-control text-danger" value="0" />
             </div>
         </div>
     </div>
     <div class="col-sm-6">
         <div class="form-group row">
             <label class="col-sm-4 col-form-label">Notice Charges</label>
             <div class="col-sm-8">
                 <input type="text" name="suitClaimNoticeCharges" id="suitClaimNoticeCharges" class="form-control"
                     value="" />
             </div>
         </div>
     </div>
 </div>
 <div class="row">
     <div class="col-sm-6">
         <div class="form-group row">
             <label class="col-sm-4 col-form-label">Misc Expenses</label>
             <div class="col-sm-8">
                 <input type="text" onchange="handleSuitValueCalculate()" name="suitClaimMiscExpense" id="suitClaimMiscExpense" class="form-control"
                     value="" />
             </div>
         </div>
     </div>
     <div class="col-sm-6">
         <div class="form-group row">
             <label class="col-sm-4 col-form-label">Total Claim In Suit</label>
             <div class="col-sm-8">
                 <input type="text" name="suitClaimTotalClaimInSuit" id="suitClaimTotalClaimInSuit"
                     class="form-control text-danger" value="0" />
             </div>
         </div>
     </div>
 </div>
 <div class="col-12">
     <input type="button" value="Calculate" onclick="handleSuitValueCalculate()"
         class="btn btn-success float-left mb-2">
     <a class="btn btn-primary float-left ml-4" onclick="clearSuitvalue()">Clear</a>
 </div>
 @push('scripts')
     <script>

         function clearSuitvalue() {
             $('#suitValueOutstandingAmount').val('');
             $('#suitValueInterest').val('');
             $('#suitClaimFromdate').val('');
             $('#suitClaimToDate').val('');
             $('#suitClaimInterestDue').val('');
             $('#suitClaimNoticeCharges').val('');
             $('#suitClaimMiscExpense').val('');
             $('#suitClaimTotalClaimInSuit').val('');
         }

         function handleSuitValueCalculate() {
             var suitValueOutstandingAmount = $('#suitValueOutstandingAmount').val();
             var suitValueInterest = $('#suitValueInterest').val();
             var suitClaimFromdate = $('#suitClaimFromdate').val();
             var suitClaimToDate = $('#suitClaimToDate').val();
             var suitClaimInterestDue = $('#suitClaimInterestDue').val();
             var suitClaimNoticeCharges = $('#suitClaimNoticeCharges').val();
             var suitClaimMiscExpense = $('#suitClaimMiscExpense').val();
             var suitClaimTotalClaimInSuit = $('#suitClaimTotalClaimInSuit').val();
             
             $('#suitClaimInterestDue').val(Number(suitValueOutstandingAmount * suitValueInterest / 100))

             var TotalSuitValue = Number(suitValueOutstandingAmount * suitValueInterest / 100) + Number(
                 suitClaimNoticeCharges) + Number(suitClaimMiscExpense)
             console.log(TotalSuitValue);
             $('#suitClaimTotalClaimInSuit').val(TotalSuitValue);

         }
     </script>
 @endpush
