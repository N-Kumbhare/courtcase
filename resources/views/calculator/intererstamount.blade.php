 <div class="row">
     <div class="col-sm-3">
         <div class="form-group">
             <label>Principal Amount</label>
             <input type="text" name="interestAmoutPrincipalAmount" id="interestAmoutPrincipalAmount"
                 class="form-control" value="" />
         </div>
     </div>
     <div class="col-sm-3">
         <div class="form-group">
             <label>Interest (%)</label>
             <input type="text" name="interestAmoutInterest" id="interestAmoutInterest" class="form-control"
                 value="" />
         </div>
     </div>
     <div class="col-sm-3">
         <div class="form-group">
             <label>From</label>
             <div class="input-group">
                 <input type="date" name="interestAmoutFromdate" id="interestAmoutFromdate" class="form-control"
                     value="" />
             </div>
         </div>
     </div>
     <div class="col-sm-3">
         <div class="form-group">
             <label>To</label>
             <div class="input-group">
                 <input type="date" name="interestAmoutToDate" id="interestAmoutToDate" class="form-control"
                     value="" />
             </div>
         </div>
     </div>
 </div>

 <div class="row">
     <div class="col-sm-6">
         <div class="form-group row">
             <label class="col-sm-4 col-form-label">Interest Amount</label>
             <div class="col-sm-8">
                 <input type="text" name="interestAmoutInterestAmount" id="interestAmoutInterestAmount"
                     class="form-control text-danger" value="0" />
             </div>
         </div>
     </div>
 </div>
 <div class="col-12">
     <input type="button" value="Calculate" onclick="InterestAmt()" class="btn btn-success float-left mb-2">
     <a class="btn btn-primary float-left ml-4" onclick="interestAmountClear()">Clear</a>
 </div>
 @push('scripts')
     <script>
         function interestAmountClear() {
            $('#interestAmoutPrincipalAmount').val('');
            $('#interestAmoutInterest').val('');
            $('#interestAmoutFromdate').val('dd-mm-yyyy');
            $('#interestAmoutToDate').val('dd-mm-yyyy');
            $('#interestAmoutInterestAmount').val(0);
         }

         function InterestAmt() {
             var interestAmoutPrincipalAmount = $('#interestAmoutPrincipalAmount').val();
             var interestAmoutInterest = $('#interestAmoutInterest').val();
             var interestAmoutInterestAmount = $('#interestAmoutInterestAmount').val();

             var InterestAmt = Number(interestAmoutPrincipalAmount) * Number(interestAmoutInterest) / 100;
             $('#interestAmoutInterestAmount').val(InterestAmt);

         }
     </script>
 @endpush
