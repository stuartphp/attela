<div class="form-heading mt-2 ms-2">{{ __('employee_disciplinary_actions.title') }}
    <span style="float: right"><a href="#" onclick="$('#form_disciplinary').toggle()"><i class="bi bi-plus" id="inv_activity_add_close"></i></a></span>
</div>
<div class="table-responsive">
    <table class="table table-hover" id="emplDisciplinaryTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>{{__('employee_disciplinary_actions.fields.action_date')}}</th>
            <th>{{__('employee_disciplinary_actions.fields.incident')}}</th>
            <th>{{__('employee_disciplinary_actions.fields.disciplinary_reasons_id')}}</th>
            <th>{{__('employee_disciplinary_actions.fields.expire_date')}}</th>
            <th class="col-1">Actions</th>
        </tr>
    </thead>

    </table>
</div>
<script>
$(document).ready(function(){
    $('#emplDisciplinaryTable').DataTable({
        processing: true,
        serverSide: true,
        retrieve: true,
        aaSorting: [],
        ajax:{
            url: "/human-resource/employee-disciplinary-actions/{{ $data->id }}"
        },

        columns: [
            {data:'action_date', name:'action_date'},
            {data:'incident', name:'incident'},
            {data:'disciplinary_reasons_id', name:'disciplinary_reasons_id'},
            {data:'expire_date', name:'expire_date'},
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