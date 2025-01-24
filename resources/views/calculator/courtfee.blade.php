<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label>Case Type</label>
            <select class="form-control" onchange="onCaseTypeChange()" name="casetypes" id="casetypes">
                <option value="Civil"> Civil </option>
                <option value="Criminal"> Criminal </option>
                <option value="Consumer"> Consumer </option>
                <option value="LA"> LA </option>
                <option value="Mact"> Mact </option>
            </select>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label>Suit Value</label>
            <div class="input-group">
                <input type="text" onchange="OnSuitValueChange()" name="suitValue" id="suitValue"
                    class="form-control" value="" />
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label>%</label>
            <select class="form-control" onchange="handlePercentChange(this.value)" name="percentIn" id="percentIn">
                <option value="Full"> Full </option>
                <option value="OneHalf"> One Half </option>
                <option value="OneThird"> One Third </option>
                <option value="OneFourth"> One Fourth </option>
                <option value="OneSixth"> One Sixth </option>
            </select>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label>Court Fee</label>
            <div class="input-group">
                <input type="text" name="courtFee" id="courtFee" class="form-control" value="" />
            </div>
        </div>
    </div>
</div>
<div class="row">
    <input type="button" id="add" value="Add" onclick="handleAdd()" class="btn btn-sm btn-success float-left">
    <a onclick="onCourtFeeClear()" class="btn btn-sm btn-primary float-left ml-4">Clear</a>
</div>
<div class="row">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8">
        <div class="card-body">
            <table class="table table-bordered table-sm" id="myTable">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Valuation</th>
                        <th>%</th>
                        <th style="width: 100px">Court Fees</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-2">
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">Total Suit Value</label>
            <div class="col-sm-8">
                <input type="text" name="totalSuitValue" id="totalSuitValue" class="form-control" value="" />
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">Total Court Fee</label>
            <div class="col-sm-8">
                <input type="text" name="totalCourtFee" id="totalCourtFee" class="form-control" value="" />
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        var counter = 1;

        function onCaseTypeChange() {
            var suitValue = $('#suitValue').val('');
            var percentIn = $('#percentIn').val('Full');
            var courtFee = $('#courtFee').val('');
        }

        function onCourtFeeClear() {
            var suitValue = $('#suitValue').val('');
            var casetypes = $('#casetypes').val('Civil');
            var percentIn = $('#percentIn').val('Full');
            var courtFee = $('#courtFee').val('');
        }

        function handleFunctionForSuitPercentCalculator(caseTypes, suitValue) {
            var calculateCourtFee = 0;

            switch (caseTypes) {
                case "Civil":
                    calculateCourtFee = Number(suitValue) * 6.63 / 100;
                    break;
                case "Criminal":
                    calculateCourtFee = Number(suitValue) * 6.63 / 100;
                    break;
                case "Consumer":
                    calculateCourtFee = Number(suitValue) * 1 / 100;
                    break;
                case "LA":
                    calculateCourtFee = Number(suitValue) * 3.215 / 100;
                    break;
                case "Mact":
                    if (Number(suitValue) <= 100000) {
                        calculateCourtFee = 372.50;
                    } else if (Number(suitValue) > 100000) {
                        calculateCourtFee = 372.50 * 1 / 100;
                    }
                    break;
                default:
            }
            return calculateCourtFee;
        }

        function handlePercentChange(value) {
            var casetypes = $('#casetypes').val();
            var suitValue = $('#suitValue').val();
            var calculateCourtFee = handleFunctionForSuitPercentCalculator(casetypes, suitValue);
            var totalCourtFeeValue = 0;
            switch (value) {
                case "Full":
                    totalCourtFeeValue = calculateCourtFee;
                    break;
                case "OneHalf":
                    totalCourtFeeValue = calculateCourtFee / 2;
                    break;
                case "OneThird":
                    totalCourtFeeValue = calculateCourtFee / 3;
                    break;
                case "OneFourth":
                    totalCourtFeeValue = calculateCourtFee / 4;
                    break;
                case "OneSixth":
                    totalCourtFeeValue = calculateCourtFee / 6;
                    break;
                default:
                    break;
            }
            $('#courtFee').val(totalCourtFeeValue);
        }

        function OnSuitValueChange() {
            var casetypes = $('#casetypes').val();
            var suitValue = $('#suitValue').val();
            var calculateCourtFee = handleFunctionForSuitPercentCalculator(casetypes, suitValue);

            $('#courtFee').val(calculateCourtFee);
        }

        $("#myTable").on('click', '.btnDelete', function() {
            $(this).closest('tr').remove();
            var table = document.getElementById("myTable"),
                sumValuation = 0;
            sumCourtFees = 0;
            for (var i = 1; i < table.rows.length; i++) {
                sumValuation = sumValuation + parseInt(table.rows[i].cells[1].innerHTML);
                sumCourtFees = sumCourtFees + parseInt(table.rows[i].cells[3].innerHTML);
            }
            $('#totalSuitValue').val(Number(sumValuation));
            $('#totalCourtFee').val(sumCourtFees);
        });

        function handleAdd() {
            var casetypes = $('#casetypes').val();
            var suitValue = $('#suitValue').val();
            var percentIn = $('#percentIn').val();
            var courtFee = $('#courtFee').val();
            var calculateCourtFee = handleFunctionForSuitPercentCalculator(casetypes, suitValue);


            $("#myTable > tbody").append(" <tr> <td> " + counter +
                "</td> <td>" + suitValue + "</td> <td>" + percentIn + "</td> <td>" + courtFee +
                "</td><td class='btnDelete' style='cursor: pointer'>Delete</td> </tr> ");
            counter += 1;
            var table = document.getElementById("myTable"),
                sumValuation = 0;
            sumCourtFees = 0;
            for (var i = 1; i < table.rows.length; i++) {
                sumValuation = sumValuation + parseInt(table.rows[i].cells[1].innerHTML);
                sumCourtFees = sumCourtFees + parseInt(table.rows[i].cells[3].innerHTML);
            }
            $('#totalSuitValue').val(Number(sumValuation));
            $('#totalCourtFee').val(sumCourtFees);
        }
    </script>
@endpush
