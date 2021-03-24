<div class="form-heading mt-2">Cycles<span style="float: right"><a href="#"><i class="bi bi-plus" id="cus_cyc_add_close"></i></a></span></div>
<form method="post" id="cus_cyc_form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="cus_cyc_action"/>
    <input type="hidden" name="_method" id="cus_cyc_method">
    <input type="hidden" id="cus_cyc_id" value="">
    <input type="hidden" id="cus_cyc_customer_id" name="customer_id">
    <div class="card shaddow-sm">
        <div class="card-header" ></div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-md-2">{{__('customer_cycles.fields.activity')}}</label>
                <div class="col-md-2">
                    <input type="text" name="activity" id="cus_cyc_activity" class="form-control form-control-sm">
                </div>
                <label class="col-md-2">{{__('customer_cycles.fields.time')}}</label>
                <div class="col-md-2">
                    <input type="text" name="time" id="cus_cyc_time" class="form-control form-control-sm">
                </div>
                <label class="col-md-2">{{__('customer_cycles.fields.frequency')}}</label>
                <div class="col-md-2">
                    <input type="text" name="frequency" id="cus_cyc_frequency" class="form-control form-control-sm">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-primary btn-sm" value="{{ __('global.save') }}">
        </div>
    </div>
</form>
<div class="table-responsive">
<table class="table table-hover" id="cus_cyc_table" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th class="col-4">{{__('customer_cycles.fields.activity')}}</th>
            <th class="col-4">{{__('customer_cycles.fields.time')}}</th>
            <th class="col-3">{{__('customer_cycles.fields.frequency')}}</th>
            <th class="col-1">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($cycles as $item)
        <tr id="cuc_cyc_t_{{ $item->id }}">
        <td>{{ $item->activity}}</td>
        <td>{{ $item->time}}</td>
        <td>{{ $item->frequency}}</td>
        <td><select class="cus_cyc_action form-control form-control-sm"  id="cus_cyc_{{ $item->customer_id }}_{{ $item->id }}">
            <option value="">{{ __('global.select') }}</option>
            <option value="Edit">{{ __('global.edit') }}</option>
            <option value="Delete">{{ __('global.delete') }}</option>
            </select></td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
<script>
    $(function(){
        $('#cus_cyc_header').html(add);
        $('#cus_cyc_form').hide();
    });
    $('#cus_cyc_add_close').on('click', function(){
        if($('#cus_cyc_add_close').hasClass('bi-plus')){
            $('#cus_cyc_add_close').removeClass('bi bi-plus').addClass('bi bi-x')
        }else{
            $('#cus_cyc_add_close').removeClass('bi bi-x').addClass('bi bi-plus')
        }
        $('#cus_cyc_form').toggle();
        $('#cus_cyc_table').toggle();
    });

    $('#cus_cyc_form').on('submit', function(e){
        e.preventDefault();
        $('#cus_cyc_item_id').val($('#inventory_item_id').val());
        let action = $('#cus_cyc_action').val();
        if(action === 'Add')
        {
            $('#cus_cyc_method').val('');
            $.ajax({
                url: "/customers/cycles",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'JSON',
                success: function (response) {
                    if(response.success){
                        $('#cus_cyc_table tbody').append(response.success);
                        document.getElementById("cus_cyc_form").reset();
                        $('#cus_cyc_header').html(add);
                        $('#cus_cyc_action').val('Add');
                        $('#cus_cyc_add_close').trigger('click');
                        notice('success', '{{__("global.record_updated")}}');
                    }else{
                        let err='<ul class="text-left">';
                        for(let i=0; i<response.length; i++)
                        {
                            err += "<li>"+response[i]+"</li>";
                        }
                        err +="</ul>";
                        notice('error', '{{__("global.error_update")}}', err);
                    }
                }
            });
        }else{
            let id = $('#cus_cyc_id').val();
            $.ajax({
                url: "/customers/cycles/"+id,
                method:'POST',
                data: new FormData(this),
                processData:false,
                contentType: false,
                cache: false,
                dataType: 'JSON',
                success: function(response)
                {
                    if(response.success){
                        $("#cus_cyc_r_"+id).remove();
                        $('#cus_cyc_table tbody').append(response.success);
                        document.getElementById("cus_cyc_form").reset();
                        $('#cus_cyc_header').html(add);
                        $('#cus_cyc_action').val('Add');
                        $('#cus_cyc_add_close').trigger('click');
                        notice('success', '{{__("global.record_updated")}}');
                    }else{
                        let err='<ul class="text-left">';
                        for(let i=0; i<response.length; i++)
                        {
                            err += "<li>"+response[i]+"</li>";
                        }
                        err +="</ul>";
                        notice('error', '{{__("global.error_update")}}', err);
                    }
                }
            });
        }

    });

    $(document).on('change', '.cus_cyc_action', function(){
        let id = $(this).attr('id');
        let val = $('#'+id).val();
        let _id = id.split('_');
        switch(val)
        {
            case 'Edit':
                $.ajax({
                    url:'/customers/cycles/'+_id[3]+'/edit',
                    dataType:'JSON',
                    method: 'GET',
                    success: function (response) {
                        $('#cus_cyc_header').html(update);
                        $('#cus_cyc_action').val(update);
                        $('#cus_cyc_id').val(_id[3]);
                        $('#cus_cyc_name').val(response.data.name);
                        $('#cus_cyc_value').val(response.data.value);
                        $('#cus_cyc_method').val('PUT');
                    }
                });
                $('#cus_cyc_add_close').trigger('click');
                $('#cus_cyc_form').show();
            break;
            case 'Delete':
            Swal.fire({
                position: 'top',
                title: '{{__('global.delete')}}',
                text: "{{__('global.confirm_delete')}}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ __("global.yes") }}'
            }).then((result) => {
                if (result.value) {
                    if (result.value) {
                        $.ajax({
                            url: '/customers/cycles/'+_id[3],
                            data: {_method:'DELETE'},
                            dataType: 'JSON',
                            method:'POST',
                            success: function(response){
                                $('#cus_cyc_r_'+_id[3]).remove();
                                notice('success', '{{__('global.record_deleted')}}');
                            }
                        });
                }
                }
            });
            break;
        }
        $('#'+id).val('');
    });
</script>
