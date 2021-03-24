<div>
    <div class="form-heading mt-2 ms-2 me-2">Private Retirement Annuity</div>
        <div style="font-size: 14px" class="ms-2 me-2">
        <p><i>Private retirement annuities are paid directly by the employee to the insurance company and the employee will receive a tax benefit on the amount.</i></p>
        <div class="row row-cols-lg-auto mb-2">
            <label class="control-label" for="privateAmountInput_0">This employee contributes R</label>
            <div class="inline">
                <input type="text" class="form-control form-control-sm" id="privateAmountInput_0" name="privateAmountInput_0">
                <!-- ngIf: displayValidation('privateAmountInput_' + $index) -->
            </div>
            <!--Monthly-->
            <label class="control-label">per month to a retirement annuity</label>

        </div>
        <div class="row row-cols-lg-auto mb-2">
            <label class="control-label">from</label>
            <div class="inline">
                <input type="text" class="form-control form-control-sm date"></div>
            <label class="control-label">with clearance number</label>
            <div class="inline">
            <input type="text" id="clearanceNumber_0" name="clearanceNumber_0" class="form-control form-control-sm" maxlength="36"></div>

        </div>
        <div class="row row-cols-lg-auto mb-2">
            <div class="inline">
                <div class="form-check">
                    <input type="checkbox" name="is_fund" id="is_fund" class="form-check-input">
                </div>
            </div>
            <label class="control-label margin-right" for="fundendDate_0">I want to stop providing this benefit on</label>
            <div class="inline">
                <div class="inline">
                    <input type="text" id="clearanceNumber_0" name="clearanceNumber_0" class="form-control form-control-sm date"></div>
            </div>
        </div></div>
</div>
