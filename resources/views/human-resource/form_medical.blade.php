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

<script>
    $('#medical_aid_type').on('change', function(){
        if(this.value==='1'){
            // disable private
            document.getElementById("private_contribution").disabled = true;
            document.getElementById("private_contribution_adjustment").disabled = true;
            document.getElementById("total_private_contribution").disabled = true;
            document.getElementById("employee_contribution").disabled = false;
            document.getElementById("employee_contribution_adjustment").disabled = false;
            document.getElementById("total_employee_contribution").disabled = false;
            document.getElementById("company_contribution").disabled = false;
            document.getElementById("company_contribution_adjustment").disabled = false;
            document.getElementById("total_company_contribution").disabled = false;

        }else{
            // disable company
            document.getElementById("private_contribution").disabled = false;
            document.getElementById("private_contribution_adjustment").disabled = false;
            document.getElementById("total_private_contribution").disabled = false;
            document.getElementById("employee_contribution").disabled = true;
            document.getElementById("employee_contribution_adjustment").disabled = true;
            document.getElementById("total_employee_contribution").disabled = true;
            document.getElementById("company_contribution").disabled = true;
            document.getElementById("company_contribution_adjustment").disabled = true;
            document.getElementById("total_company_contribution").disabled = true;
        }
    })
$('#beneficiaries').on('change', function(){
    let val = parseFloat(this.value);
    let matc = 0;
    let calc =val-2;

    if(val ===1)
    {
        matc=319;
    }else if(val===2){
        matc=638
    }else{
        matc = 638+(215*calc);
    }
    $('#medical_aid_tax_credit').val(matc.toFixed(2));
})

$('#private_contribution').on('change', function(){
    let pt = parseFloat(this.value)+parseFloat($('#private_contribution_adjustment').val());
    $('#total_private_contribution').val(pt.toFixed(2));
})
$('#private_contribution_adjustment').on('change', function(){
    let pt = parseFloat(this.value)+parseFloat($('#private_contribution').val());
    $('#total_private_contribution').val(pt.toFixed(2));
})
</script>

