<div class="form-heading mt-2 ms-2 me-2">Options<span style="float: right"><a href="#"><i class="bi bi-plus" id="inv_opt_add_close"></i></a></span></div>
<form method="post" id="inv_opt_form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="inv_opt_action" value="Add"/>
    <input type="hidden" name="_method" id="inv_opt_method">
    <input type="hidden" id="inv_opt_id" value="">
    <input type="hidden" id="inv_opt_item_id" name="inventory_item_id">
    <div class="card shaddow-sm">
        <div class="card-header" id="inv_opt_header">

        </div>
        <div class="card-body">
        <div class="form-group row">
        <label class="col-md-2">{{__('inventory_options.fields.name')}}</label>
        <div class="col-md-2">
            <input type="text" name="name" id="inv_opt_name" class="form-control form-control-sm" required>
        </div>

        <label class="col-md-2">{{__('inventory_options.fields.value')}}</label>
        <div class="col-md-2">
            <input type="text" name="value" id="inv_opt_value" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')" required>
        </div>
    </div>
        </div>
        <div class="modal-footer">
        <input type="submit" class="btn btn-outline-primary btn-sm" value="{{ __('global.save') }}">
    </div>
    </div>
<br>
</form>
<div class="table-responsive ms-2 me-2">
    <table class="table table-hover" id="inv_opt_table" width="98%">
      <thead>
        <tr>
           <th class="col-8">{{__('inventory_options.fields.name')}}</th>
           <th class="col-3">{{ __('inventory_options.fields.value') }}</th>
            <th class="col-1">{{ __('global.actions') }}</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($options as $item)
            <tr id="inv_opt_r_{{ $item->id }}">
                <td>{{ $item->name}}</td>
                <td>{{ $item->value}}</td>
                <td><select class="inv_opt_action form-select" id="inv_opt_{{ $item->invenotry_item_id }}_{{ $item->id }}">
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
        $('#inv_opt_header').html(add);
        $('#inv_opt_form').hide();
    });
    $('#inv_opt_add_close').on('click', function(){
        if($('#inv_opt_add_close').hasClass('bi-plus')){
            $('#inv_opt_add_close').removeClass('bi bi-plus').addClass('bi bi-x')
        }else{
            $('#inv_opt_add_close').removeClass('bi bi-x').addClass('bi bi-plus')
        }
        $('#inv_opt_form').toggle();
        $('#inv_opt_table').toggle();
    });

    $('#inv_opt_form').on('submit', function(e){
        e.preventDefault();
        $('#inv_opt_item_id').val($('#inventory_item_id').val());
        let action = $('#inv_opt_action').val();
        if(action === 'Add')
        {
            $('#inv_opt_method').val('');
            $.ajax({
                url: "/inventory/options",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'JSON',
                success: function (response) {
                    if(response.success){
                        $('#inv_opt_table tbody').append(response.success);
                        document.getElementById("inv_opt_form").reset();
                        $('#inv_opt_header').html(add);
                        $('#inv_opt_action').val('Add');
                        $('#inv_opt_add_close').trigger('click');
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
            let id = $('#inv_opt_id').val();
            $.ajax({
                url: "/inventory/options/"+id,
                method:'POST',
                data: new FormData(this),
                processData:false,
                contentType: false,
                cache: false,
                dataType: 'JSON',
                success: function(response)
                {
                    if(response.success){
                        $("#inv_opt_r_"+id).remove();
                        $('#inv_opt_table tbody').append(response.success);
                        document.getElementById("inv_opt_form").reset();
                        $('#inv_opt_header').html(add);
                        $('#inv_opt_action').val('Add');
                        $('#inv_opt_add_close').trigger('click');
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

    $(document).on('change', '.inv_opt_action', function(){
        let id = $(this).attr('id');
        let val = $('#'+id).val();
        let _id = id.split('_');
        switch(val)
        {
            case 'Edit':
                $.ajax({
                    url:'/inventory/options/'+_id[3]+'/edit',
                    dataType:'JSON',
                    method: 'GET',
                    success: function (response) {
                        $('#inv_opt_header').html(update);
                        $('#inv_opt_action').val(update);
                        $('#inv_opt_id').val(_id[3]);
                        $('#inv_opt_name').val(response.data.name);
                        $('#inv_opt_value').val(response.data.value);
                        $('#inv_opt_method').val('PUT');
                    }
                });
                $('#inv_opt_add_close').trigger('click');
                $('#inv_opt_form').show();
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
                            url: '/inventory/options/'+_id[3],
                            data: {_method:'DELETE'},
                            dataType: 'JSON',
                            method:'POST',
                            success: function(response){
                                $('#inv_opt_r_'+_id[3]).remove();
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
