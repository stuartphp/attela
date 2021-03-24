<div class="form-heading mt-2">{{ __('employee_directives.title') }}

</div>
<form method="POST" id="form_empl_directives">
    <div class="row mb-2">
        <label class="col-1">{{ __('employee_directives.fields.name') }}</label>
        <div class="col-2"><input type="text" name="name" id="empl_directive_name" class="form-control form-control-sm"></div>
        <label class="col-1">{{ __('employee_directives.fields.sars_number') }}</label>
        <div class="col-2"><input type="text" name="sars_number" id="empl_directive_sars_number" class="form-control form-control-sm"></div>
        <label class="col-1">{{ __('employee_directives.fields.percentage') }}</label>
        <div class="col-2"><input type="text" name="percentage" id="empl_directive_percentage" class="form-control form-control-sm"></div>
        <div class="col-3 text-end"><button type="submit" class="btn btn-outline-primary btn-sm" id="directive_submit">{{ __('global.save') }}</button></div>
    </div>
</form>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('employee_directives.fields.name') }}</th>
                <th>{{ __('employee_directives.fields.sars_number') }}</th>
                <th>{{ __('employee_directives.fields.percentage') }}</th>
                <th class="col-1">{{ __('global.action') }}</th>
            </tr>
        </thead>
        <tbody id="tbl_empl_directives">

        </tbody>
    </table>
</div>

<script>
    $(function()
    {
        loadDirectives();
    });
    function pushVal(id)
    {
        let val = $('#sel_direct_' + id).val();
        switch(val)
        {
            case 'Edit':
            $('#directive_submit').html(update);
            $('#empl_directive_name').val($('#name_'+id).text());
            $('#empl_directive_sars_number').val($('#sars_'+id).text());
            $('#empl_directive_percentage').val($('#perc_'+id).text());
            break;
        }
        $('#sel_direct_'+id).val('');
    }
    function loadDirectives()
    {
        $('#tbl_empl_directives').html('');
        let html='';
        $.ajax({
            url:'/human-resource/employee-directives/{{ $id }}',
            dataType: 'JSON',
            success:function(res){

                $.each(res, function(i, data){
                    html +='<tr><td id="name_'+data.id+'">'+data.name+'</td><td id="sars_'+data.id+'">'+data.sars_number+'</td><td id="perc_'+data.id+'">'+data.percentage+'</td><td><select class="form-select" onchange="pushVal('+data.id+')" id="sel_direct_'+data.id+'"><option value="">{{ __("global.select") }}</option><option value="Edit">{{ __("global.edit") }}</option><option value="Del">{{ __("global.delete") }}</option></select></td></tr>'
                })
                $('#tbl_empl_directives').html(html);
            }
        })
    }



</script>
