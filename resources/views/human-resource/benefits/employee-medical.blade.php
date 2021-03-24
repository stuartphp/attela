<div>
    <div class="form-heading mt-2 ms-2 me-2">Medical Aid</div>
<table class="table ms-2" style="max-width:50%">
    <tr class="medical-heading">
        <td colspan="2">March</td>
    </tr>
    <tr>
        <td>Type of medical aid</td>
        <td><select class="form-select" id="medical_aid_type" name="medical_aid_type">
            <option value="0">None</option>
            <option value="1">Company</option>
            <option value="2">Private</option>

        </select></td>
    </tr>
    <tr>
        <td>Beneficiaries (Main member & Dependants) </td>
        <td><input type="text" class="form-control form-control-sm text-right" id="beneficiaries" name="beneficiaries" onkeyup="this.value=this.value.replace(/[^\d]/,'')" required ></td>
    </tr>
    <tr class="medical-heading">
        <td colspan="2">Private Medical Aid</td>
    </tr>
    <tr>
        <td>Private contribution </td>
        <td><input type="text" class="form-control form-control-sm text-right" id="private_contribution" name="private_contribution" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')" value="0.00"></td>
    </tr>
    <tr>
        <td>Private contribution adjustment </td>
        <td><input type="text" class="form-control form-control-sm text-right" id="private_contribution_adjustment" name="private_contribution_adjustment" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')" value="0.00"></td>
    </tr>
    <tr>
        <td>Total private contribution</td>
        <td><input type="text" class="form-control form-control-sm text-right" id="total_private_contribution"></td>
    </tr>
    <tr class="medical-heading">
        <td colspan="2">Company Medical Aid</td>
    </tr>
    <tr>
        <td>Employee contribution</td>
        <td><input type="text" class="form-control form-control-sm text-right" id="employee_contribution" name="employee_contribution" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')" value="0.00"></td>
    </tr>
    <tr>
        <td>Employee contribution adjustment</td>
        <td><input type="text" class="form-control form-control-sm text-right" id="employee_contribution_adjustment" name="employee_contribution_adjustment" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')" value="0.00"></td>
    </tr>
    <tr>
        <td>Total employee contribution</td>
        <td><input type="text" class="form-control form-control-sm text-right" id="total_employee_contribution"></td>
    </tr>
    <tr>
        <td>Company contribution</td>
        <td><input type="text" class="form-control form-control-sm text-right" id="company_contribution" name="company_contribution" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')"value="0.00"> </td>
    </tr>
    <tr>
        <td>Company contribution adjustment</td>
        <td><input type="text" class="form-control form-control-sm text-right" id="company_contribution_adjustment" name="company_contribution_adjustment" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')" value="0.00"></td>
    </tr>
    <tr>
        <td>Total company contribution</td>
        <td><input type="text" class="form-control form-control-sm text-right" id="total_company_contribution"></td>
    </tr>
    <tr class="medical-heading">
        <td colspan="2">Medical Aid Tax Credits</td>
    </tr>
    <tr>
        <td>Medical aid tax credit</td>
        <td><input type="text" class="form-control form-control-sm text-right" id="medical_aid_tax_credit"></td>
    </tr>
</table>
</div>
