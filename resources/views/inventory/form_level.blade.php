<div class="form-heading mt-2 ms-2">Level<span style="float: right"><a href="#"><i class="bi bi-plus me-2" id="inv_lev_add_close"></i></a></span></div>
<form method="post" id="inv_lev_form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="inv_lev_action" value="Add"/>
    <input type="hidden" name="_method" id="inv_lev_method">
    <input type="hidden" id="inv_lev_id" value="">
    <input type="hidden" id="inv_lev_item_id" name="inventory_item_id">
    <div class="card shaddow-sm">
        <div class="card-header" id="inv_lev_header"></div>
        <div class="card-body">
            <div class="row mb-2">
            <label class="col-2">{{__('inventory_levels.fields.store_id')}}</label>
            <div class="col-2">
                <select name="store_id" id="store_id" class="form-select">
                    @foreach ($stores as $k=>$v)
                    <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select>
            </div>

        <label class="col-2">{{__('inventory_levels.fields.on_hand')}}</label>
        <div class="col-2">
            <input type="text" name="on_hand" id="on_hand" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')" required>
        </div>
    </div><div class="row">
        <label class="col-2">{{__('inventory_levels.fields.min_order_level')}}</label>
        <div class="col-2">
            <input type="text" name="min_order_level" id="min_order_level" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')" required>
        </div>

        <label class="col-2">{{__('inventory_levels.fields.min_order_quantity')}}</label>
        <div class="col-2">
            <input type="text" name="min_order_quantity" id="min_order_quantity" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')" required>
        </div>
    </div>
        </div>
        <div class="modal-footer">
        <input type="submit" class="btn btn-outline-primary btn-sm" value="{{ __('global.save') }}">
    </div>
</div>
</form>
<div class="table-responsive ms-2 me-2">
    <table class="table table-hover" id="inv_lev_table" width="98%">
      <thead>
        <tr>
           <th class="col-5">{{__('inventory_levels.fields.store_id')}}</th>
           <th class="col-2 text-center">{{__('inventory_levels.fields.on_hand')}}</th>
           <th class="col-2 text-center">{{__('inventory_levels.fields.min_order_level')}}</th>
           <th class="col-2 text-center">{{__('inventory_levels.fields.min_order_quantity')}}</th>
           <th class="col-1">{{ __('global.actions') }}</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($level as $item)
          <tr id="inv_lev_r_{{ $item->id }}">
            <td>{{ $item->store->name}}</td>
            <td class="text-center">{{ $item->on_hand}}</td>
            <td class="text-center">{{ $item->min_order_level}}</td>
            <td class="text-center">{{ $item->min_order_quantity}}</td>
            <td><select class="inv_lev_action form-select" id="inv_lev_{{ $item->inventory_item_id }}_{{ $item->id }}">
                <option value="">{{ __('global.select') }}</option>
                <option value="Edit">{{ __('global.edit') }}</option>
                </select></td>
          </tr>
          @endforeach
      </tbody>
    </table>
</div>
<script>
    $(function(){
        $('#inv_lev_header').html(add);
        $('#inv_lev_form').toggle();
    });
    $('#inv_lev_add_close').on('click', function(){
        if($('#inv_lev_add_close').hasClass('bi-plus')){
            $('#inv_lev_add_close').removeClass('bi bi-plus').addClass('bi bi-x');

        }else{
            $('#inv_lev_add_close').removeClass('bi bi-x').addClass('bi bi-plus');
        }
        $('#inv_lev_form').toggle();
        $('#inv_lev_table').toggle();
    });
    $('#inv_lev_form').on('submit', function(e){
        e.preventDefault();
        $('#inv_lev_item_id').val($('#inventory_item_id').val());
        let action = $('#inv_lev_action').val();
        if(action === 'Add')
        {
            $.ajax({
                url: "/inventory/levels",
                method:'POST',
                data: new FormData(this),
                processData:false,
                contentType: false,
                cache: false,
                dataType: 'JSON',
                success: function(response)
                {
                    if(response.success){
                $('#inv_lev_table tbody').append(response.success);
                    document.getElementById("inv_lev_form").reset();

                    notice('success', '{{__('global.record_updated')}}');
                }else{
                    let err='<ul class="text-left">';
                    for(let i=0; i<response.error.length; i++)
                    {
                        err += "<li>"+response.error[i]+"</li>";
                    }
                    err +="</ul>";
                    notice('error', '{{__('global.error_update')}}', err);
                }
                }
            });
        }else{
            let id = $('#inv_lev_id').val();

            $.ajax({
                url: "/inventory/levels/"+id,
                method:'POST',
                data: new FormData(this),
                processData:false,
                contentType: false,
                cache: false,
                dataType: 'JSON',
                success: function(response)
                {
                    if(response.success){
                        $("#inv_lev_r_"+id).remove();
                        $('#inv_lev_table tbody').append(response.success);
                        document.getElementById('on_hand').readOnly = false;
                        document.getElementById("inv_lev_form").reset();
                        $('#inv_lev_header').html(add);
                        $('#inv_lev_action').val('Add');

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
        $('#inv_lev_add_close').trigger('click');
    });
    $(document).on('change', '.inv_lev_action', function(){
        let id = $(this).attr('id');
        let val = $('#'+id).val();
        let _id = id.split('_');
        switch(val)
        {
            case 'Edit':
                $.ajax({
                    url:'/inventory/levels/'+_id[3]+'/edit',
                    dataType:'JSON',
                    method: 'GET',
                    success: function (response) {
                        $('#inv_lev_header').html(update);
                        $('#inv_lev_action').val(update);
                        $('#inv_lev_id').val(_id[3]);
                        document.getElementById('on_hand').readOnly = true;
                        $('#on_hand').val(response.data.on_hand);
                        $('#min_order_level').val(response.data.min_order_level);
                        $('#min_order_quantity').val(response.data.min_order_quantity);
                        $('#inv_lev_method').val('PUT');
                    }
                });
                $('#inv_lev_add_close').trigger('click');
                $('#inv_lev_form').show();
            break;

        }
        $('#'+id).val('');
    });
</script>
