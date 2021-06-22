@extends('layouts.admin')
@section('title', __('global.menu.inventory.title'))
@section('content')

@livewire('test-component')
<form method="post" id="form_price" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="price_action" value="add"/>
    <input type="hidden" name="_method" id="price_method">
    <input type="hidden" id="id" value="">
    <input type="hidden" name="inventory_item_id" id="price_item_id"/>
    <div class="card shaddow-sm">
        <div class="card-header" id="inv_pri_header">Add Price</div>
        <div class="card-body">
            <div class="mb-2  row">
                <label class="col-md-2">{{__('inventory_prices.fields.store_id')}}</label>
                <div class="col-md-2">
                    <select name="store_id" id="store_id" class="form-select">
                        @foreach ($stores as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.price_list1')}}</label>
                <div class="col-md-2">
                    <input type="text" name="price_list1" id="price_list1" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.special')}}</label>
                <div class="col-md-2">
                    <input type="text" name="special" id="special" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
            </div>
            <div class="mb-2  row">
                <label class="col-md-2">{{__('inventory_prices.fields.cost_price')}}</label>
                <div class="col-md-2">
                    <input type="text" name="cost_price" id="cost_price" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.price_list2')}}</label>
                <div class="col-md-2">
                    <input type="text" name="price_list2" id="price_list2" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.special_from')}}</label>
                <div class="col-md-2">
                    <input type="text" name="special_from" id="special_from" class="form-control form-control-sm datetime">
                </div>
            </div>
            <div class="mb-2  row">
                <label class="col-md-2">{{__('inventory_prices.fields.retail')}}</label>
                <div class="col-md-2">
                    <input type="text" name="retail" id="retail" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.price_list3')}}</label>
                <div class="col-md-2">
                    <input type="text" name="price_list3" id="price_list3" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.special_to')}}</label>
                <div class="col-md-2">
                    <input type="text" name="special_to" id="special_to" class="form-control form-control-sm datetime">
                </div>
            </div>
            <div class="mb-2  row">
                <label class="col-md-2">{{__('inventory_prices.fields.dealer')}}</label>
                <div class="col-md-2">
                    <input type="text" name="dealer" id="dealer" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.price_list4')}}</label>
                <div class="col-md-2">
                    <input type="text" name="price_list4" id="price_list4" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
            </div><div class="mb-2  row">
                <label class="col-md-2">{{__('inventory_prices.fields.whole_sale')}}</label>
                <div class="col-md-2">
                    <input type="text" name="whole_sale" id="whole_sale" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
                <label class="col-md-2">{{__('inventory_prices.fields.price_list5')}}</label>
                <div class="col-md-2">
                    <input type="text" name="price_list5" id="price_list5" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-outline-primary btn-sm" value="{{ __('global.save') }}">
        </div>
    </div>
</form>

@endsection
@section('scripts')
<script>
    $(function(){
        $('#form_price').hide();
        $('.datetime').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            locale: 'en',
            sideBySide: true
        })
    });
    $('#inv_price_add_close').on('click', function(){
        if($('#inv_price_add_close').hasClass('bi-plus')){
            $('#inv_price_add_close').removeClass('bi bi-plus').addClass('bi bi-x');
            $('#inv_pri_header').html(add);
            $('#price_action').val('Add');
        }else{
            $('#inv_price_add_close').removeClass('bi bi-x').addClass('bi bi-plus')
            document.getElementById("form_price").reset();
        }
        $('#priceTable').toggle();
    });
    $('#form_price').on('submit', function(e){
        e.preventDefault();
        let action = $('#price_action').val();

        $('#price_item_id').val($('#inventory_item_id').val());
        if(action === 'Update')
        {
            let id = $('#id').val();
            $('#price_method').val('PUT');
            $.ajax({
                url: "/inventory/prices/"+id,
                method:'POST',
                data: new FormData(this),
                processData:false,
                contentType: false,
                cache: false,
                dataType: 'JSON',
                success: function(response)
                {
                    if(response.success){
                        $("#pri_r_"+id).remove();
                        $('#priceTable tbody').append(response.success);
                        document.getElementById("form_price").reset();
                        $('#inv_pri_header').html(add);
                        $('#price_action').val('Add');
                        $('#inv_price_add_close').trigger('click');
                        $('#form_price').toggle();
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
            $.ajax({
                url: "/inventory/prices",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'JSON',
                success: function (response) {
                    if(response.success){
                        $('#priceTable tbody').append(response.success);
                        document.getElementById("form_price").reset();
                        $('#inv_pri_header').html(add);
                        $('#price_action').val('Add');
                        $('#inv_price_add_close').trigger('click');
                        $('#form_price').toggle();
                        notice('success', '{{trans('global.record_added')}}');
                    }else{
                        let err='<ul class="text-left">';
                        for(let i=0; i<response.error.length; i++)
                        {
                            err += "<li>"+response.error[i]+"</li>";
                        }
                        err +="</ul>";
                        notice('error', '{{trans('global.error_add')}}', err);
                    }
                }
            });
        }
    });

    $(document).on('change', '.inv_price_action', function(){
        let id = $(this).attr('id');
        let val = $('#'+id).val();
        let _id = id.split('_');
        switch(val)
        {
            case 'Edit':
                $.ajax({
                    url:'/inventory/prices/'+_id[2]+'/edit',
                    dataType:'JSON',
                    method: 'GET',
                    success: function (response) {
                        $('#inv_pri_header').html(update);
                        $('#price_action').val('Update');
                        $('#id').val(response.data.id);
                        $('#store_id').val(response.data.store_id);
                        $('#cost_price').val(response.data.cost_price);
                        $('#retail').val(response.data.retail);
                        $('#dealer').val(response.data.dealer);
                        $('#whole_sale').val(response.data.whole_sale);
                        $('#price_list1').val(response.data.price_list1);
                        $('#price_list2').val(response.data.price_list2);
                        $('#price_list3').val(response.data.price_list3);
                        $('#price_list4').val(response.data.price_list4);
                        $('#price_list5').val(response.data.price_list5);
                        $('#special').val(response.data.special);
                        $('#special_from').val(response.data.special_from);
                        $('#special_to').val(response.data.special_to);
                        $('#method').val('PUT');
                    }
                });
                $('#inv_price_add_close').trigger('click');
                $('#form_price').toggle();
            break;
            case 'Copy':
            $.ajax({
                    url:'/inventory/prices/'+_id[2]+'/edit',
                    dataType:'JSON',
                    method: 'GET',
                    success: function (response) {
                        $('#inv_pri_header').html(add);
                        $('#price_action').val('Add');
                        $('#store_id').val(response.data.store_id);
                        $('#cost_price').val(response.data.cost_price);
                        $('#retail').val(response.data.retail);
                        $('#dealer').val(response.data.dealer);
                        $('#whole_sale').val(response.data.whole_sale);
                        $('#price_list1').val(response.data.price_list1);
                        $('#price_list2').val(response.data.price_list2);
                        $('#price_list3').val(response.data.price_list3);
                        $('#price_list4').val(response.data.price_list4);
                        $('#price_list5').val(response.data.price_list5);
                        $('#special').val(response.data.special);
                        $('#special_from').val(response.data.special_from);
                        $('#special_to').val(response.data.special_to);
                    }
                });
                $('#inv_price_add_close').trigger('click');
                $('#form_price').toggle();
            break;
            case 'Delete':
                alert('del');
            break;
        }
        $('#'+id).val('');
    });
</script>
@endsection

