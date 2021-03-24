
<div class="form-heading mt-2 ms-2">{{ __('employee_leaves.title') }}
    <span style="float: right"><a href="#" onclick="$('#form_leave').toggle()"><i class="bi bi-plus" id="inv_activity_add_close"></i></a></span>
</div>
<div class="table-responsive">
    <table class="table table-hover" id="emplLeaveTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>{{__('employee_leaves.fields.balance')}}</th>
            <th>{{__('employee_leaves.fields.days_accrued')}}</th>
            <th>{{__('employee_leaves.fields.type')}}</th>
            <th>{{__('employee_leaves.fields.cycle')}}</th>
            <th class="col-1">Actions</th>
        </tr>
    </thead>

    </table>
</div>


<div class="form-heading mt-2 ms-2">{{ __('employee_leave_registers.title') }}
    <span style="float: right"><a href="#" onclick="$('#form_leave_register').toggle()"><i class="bi bi-plus" id="inv_activity_add_close"></i></a></span>
</div>
<div class="table-responsive">
    <table class="table table-hover" id="emplLeaveRegisterTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>{{__('employee_leave_registers.fields.leave_type')}}</th>
            <th>{{__('employee_leave_registers.fields.from_date')}}</th>
            <th>{{__('employee_leave_registers.fields.to_date')}}</th>
            <th>{{__('employee_leave_registers.fields.total_days')}}</th>
            <th>{{__('employee_leave_registers.fields.reason')}}</th>
            <th class="col-1">Actions</th>
        </tr>
    </thead>

    </table>
</div>
    


<script>
$(document).ready(function(){

    $('#emplLeaveRegisterTable').DataTable({
        processing: true,
        serverSide: true,
        retrieve: true,
        aaSorting: [],
        ajax:{
            url: "/human-resource/employee-leave-registers/{{ $data->id }}"
        },

        columns: [
            {data:'leave_type', name:'leave_type'},
            {data:'from_date', name:'from_date'},
            {data:'to_date', name:'to_date'},
            {data:'total_days', name:'total_days'},
            {data:'reason', name:'reason'},
            {
            "render": function(d,t,r){
                if(r.end_date == null )
                {
                    let $select = $("<select></select>", {
                        'class':"form-select",
                        'onchange':'jobAction('+r.id+')',
                        'id':r.id,
                    });
                    let $option='';
                
                    $option = $('<option></option>', {
                        "text":'--Select--',
                        "value":''
                    });
                    $select.append($option);
                    
                    $option = $('<option></option>', {
                        "text":'{{trans('global.edit')}}',
                        "value":'Edit'
                    });
                    $select.append($option); 
                    return $select.prop("outerHTML");
                }else{
                    return "{{ __('global.closed') }}";
                }                  
                
            }},
        ],
        pageLength: 15,
        lengthMenu: [[10, 15, 25, 50, -1], [10, 15, 25, 50, "All"]],
    });
});

</script>