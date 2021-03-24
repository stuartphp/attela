<div class="form-heading mt-2 ms-2">Images<span style="float: right"><a href="#" onclick="$('#form_image').toggle()"><i class="bi bi-plus me-2" id="inv_img_add_close"></i></a></span></div>
<form method="post" id="form_image" enctype="multipart/form-data">
    <input type="hidden" name="inventory_item_id" id="image_item_id"/>
    <input type="hidden" name="_method" id="img_method">
    @csrf
    <div class="card shadow-sm">
        <div class="card-header">Add Image</div>
        <div class="card-body">
            <div class="form-group row">
        <label class="col-md-2">{{__('inventory_images.fields.file_name')}}</label>
        <div class="col-md-4">
            <div class="input-group">
                <input type="file"  name="file_name" id="file_name" class="form-control form-control-sm"  aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-primary btn-sm disabled" type="button">
                        {{ __('global.size') }} Max:1MB
                        </button>
                </div>
              </div>
        </div>
        <label class="col-md-2">{{__('inventory_images.fields.sort_order')}}</label>
        <div class="col-md-2">
            <input type="text" name="sort_order" id="sort_order" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d]/,'')" required>
        </div>
    </div>
        </div>
        <div class="modal-footer">
        <input type="submit" class="btn btn-outline-primary btn-sm" value="{{ __('global.save') }}">
    </div>
    </div>


</form>
<div class="table-responsive ms-2 me-2">
    <table class="table table-hover" id="imagesTable" width="98%">
      <thead>
        <tr>
            <th class="col-6">{{__('inventory_images.fields.file_name')}}</th>
            <th class="col-2">{{__('inventory_images.fields.sort_order')}}</th>
            <th class="col-3">{{__('inventory_images.fields.image')}}</th>
            <th class="col-1">Actions</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($images as $item)
          <tr id="img_r_{{ $item->id }}">
          <td>{{ $item->file_name }}</td>
          <td>{{ $item->sort_order }}</td>
          <td><img src="/{{ $item->file_name }}" style="height: 80px"></td>
          <td><select class="img_action form-select" id="img_{{ $item->inventory_item_id }}_{{ $item->id }}">
            <option value="">{{ __('global.select') }}</option>
            <option value="Delete">{{ __('global.delete') }}</option>
            </select></td>
          </tr>
          @endforeach
      </tbody>
    </table>
</div>
<script>
    $(function(){
        $('#form_image').hide();
    });
    $('#inv_img_add_close').on('click', function(){
        if($('#inv_img_add_close').hasClass('bi-plus')){
            $('#inv_img_add_close').removeClass('bi bi-plus').addClass('bi bi-x');
        }else{
            $('#inv_img_add_close').removeClass('bi bi-x').addClass('bi bi-plus');
        }
        $('#imagesTable').toggle();
    });

    $('#form_image').on('submit', function(e){
        e.preventDefault();
        $('#image_item_id').val($('#inventory_item_id').val());
        $.ajax({
            url: "/inventory/images",
            method:'POST',
            data: new FormData(this),
            processData:false,
            contentType: false,
            cache: false,
            dataType: 'JSON',
            success: function(response)
            {
                if(response.success){
                html = '<tr id="img_r_'+response.success.id+'"><td>'+response.success.file_name+'</td><td>'+response.success.sort_order+'</td><td><img src="/'+response.success.file_name+'" style="height: 80px"></td><td><select class="img_action form-select" id="img_'+response.success.inventory_item_id+'_'+response.success.id+'"><option value="">{{ __('global.select') }}</option><option value="Delete">{{ __('global.delete') }}</option></select></td></tr>';
                $('#imagesTable tbody').append(html);
                document.getElementById("form_image").reset();
                $('#form_image').toggle()
                notice('success', '{{__('global.record_updated')}}');
            }else{
                let err='<ul class="text-left">';
                for(let i=0; i<response.length; i++)
                {
                    err += "<li>"+response[i]+"</li>";
                }
                err +="</ul>";
                notice('error', '{{__('global.error_update')}}', err);
            }
            }
        });
    });
    $(document).on('change', '.img_action', function(){
        let id = $(this).attr('id');
        let val = $('#'+id).val();
        let img_id = id.split('_');
        switch(val)
        {
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
                                url: '/inventory/images/'+img_id[2],
                                data: {_method:'DELETE'},
                                dataType: 'JSON',
                                method:'POST',
                                success: function(response){
                                    $('#img_r_'+img_id[2]).remove();
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
