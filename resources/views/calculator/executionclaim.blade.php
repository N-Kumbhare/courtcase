 <div class="row">
     <div class="col-sm-3">
         <div class="form-group">
             <label>Decreed Amount</label>
             <input type="text" name="executionClaimDecreedAmount" id="executionClaimDecreedAmount" class="form-control"
                 value="" />
         </div>
     </div>
     <div class="col-sm-3">
         <div class="form-group">
             <label>Cost Of Suit</label>
             <input type="text" name="executionClaimCostOfinterest" id="executionClaimCostOfinterest"
                 class="form-control" value="" />
         </div>
     </div>
     <div class="col-sm-6">
         <div class="form-group">
             <label>Interest (%)</label>
             <input type="text" name="executionClaimInterest" id="executionClaimInterest" class="form-control"
                 value="" />
         </div>
     </div>
 </div>
 <div class="row">
     <div class="col-sm-6">
         <div class="form-group">
             <label>From</label>
             <div class="input-group">
                 <input type="date" name="executionClaimFromdate" id="executionClaimFromdate" class="form-control"
                     value="" />
             </div>
         </div>
     </div>
     <div class="col-sm-6">
         <div class="form-group">
             <label>To</label>
             <div class="input-group">
                 <input type="date" name="executionClaimToDate" id="executionClaimToDate" class="form-control"
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
                 <input type="text" name="executionClaimInterestDue" id="executionClaimInterestDue"
                     class="form-control text-danger" value="0" />
             </div>
         </div>
     </div>
     <div class="col-sm-6">
         <div class="form-group row">
             <label class="col-sm-4 col-form-label">Cost Of Appeal</label>
             <div class="col-sm-8">
                 <input type="text" name="executionClaimCostOfAppeal" id="executionClaimCostOfAppeal"
                     class="form-control" value="" />
             </div>
         </div>
     </div>
 </div>
 <div class="row">
     <div class="col-sm-6">
         <div class="form-group row">
             <label class="col-sm-4 col-form-label">Pleader Fee</label>
             <div class="col-sm-8">
                 <input type="text" name="executionClaimPleaderFee" id="executionClaimPleaderFee"
                     class="form-control" value="" />
             </div>
         </div>
     </div>
     <div class="col-sm-6">
         <div class="form-group row">
             <label class="col-sm-4 col-form-label">Total Claim</label>
             <div class="col-sm-8">
                 <input type="text" name="executionClaimTotalClaim" id="executionClaimTotalClaim"
                     class="form-control text-danger" value="0" />
             </div>
         </div>
     </div>
 </div>
 <div class="col-12">
     <input type="button" value="Calculate" onclick="TotalClaim()" class="btn btn-success float-left mb-2">
     <a class="btn btn-primary float-left ml-4" onclick="executaionClaimClear()">Clear</a>

 </div>
 @push('scripts')
     <script>
         function executaionClaimClear() {
             $('#executionClaimDecreedAmount').val('');
             $('#executionClaimCostOfinterest').val('');
             $('#executionClaimInterest').val('');
             $('#executionClaimCostOfAppeal').val('')
             $('#executionClaimPleaderFee').val('')
             $('#executionClaimTotalClaim').val('')
         }

         function TotalClaim() {
             var executionClaimDecreedAmount = $('#executionClaimDecreedAmount').val();
             var executionClaimCostOfinterest = $('#executionClaimCostOfinterest').val();
             var executionClaimInterest = $('#executionClaimInterest').val();
             var executionClaimCostOfAppeal = $('#executionClaimCostOfAppeal').val()
             var executionClaimPleaderFee = $('#executionClaimPleaderFee').val();
             var executionClaimTotalClaim = $('#executionClaimTotalClaim').val();
             var executionClaimInterestDue = $('#executionClaimInterestDue').val();

             


             var totalInterestDue = (Number(executionClaimDecreedAmount) * Number(executionClaimInterest) / 100);
             $('#executionClaimInterestDue').val(totalInterestDue)

             var TotalClaim = Number(totalInterestDue) + Number(executionClaimPleaderFee) + Number(executionClaimCostOfAppeal) + Number(executionClaimCostOfinterest);
             $('#executionClaimTotalClaim').val(TotalClaim)

         }
     </script>
 @endpush
