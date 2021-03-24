<div class="form-heading mt-2 ms-2 me-2">Contacts<span style="float: right"><a href="#"><i class="bi bi-plus" id="cus_con_add_close"></i></a></span></div>
<form method="post" class="ms-2 me-2" id="cus_con_form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="cus_con_action" value="Add"/>
    <input type="hidden" name="_method" id="cus_con_method">
    <input type="hidden" id="cus_con_id">
    <input type="hidden" id="cus_con_customer_id" name="customer_id">
    <div class="card shaddow-sm">
        <div class="card-header" id="cus_con_header"></div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="row mb-2">
                        <label class="col-4">{{__('customer_contacts.fields.job_title')}}</label>
                        <div class="col-8">
                            <input type="text" name="job_title" id="cus_con_job_title" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-4">{{__('customer_contacts.fields.name')}}</label>
                        <div class="col-8">
                            <input type="text" name="name" id="cus_con_name" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-4">{{__('customer_contacts.fields.mobile')}}</label>
                        <div class="col-8">
                            <input type="text" name="mobile" id="cus_con_mobile" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-4">{{__('customer_contacts.fields.telephone')}}</label>
                        <div class="col-8">
                            <input type="text" name="telephone" id="cus_con_telephone" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-4">{{__('customer_contacts.fields.email')}}</label>
                        <div class="col-8">
                            <input type="email" name="email" id="cus_con_email" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row mb-2">
                        <label class="col-4">{{__('customer_contacts.fields.notes')}}</label>
                        <div class="col-8">
                            <textarea name="notes" id="cus_con_notes" class="form-control form-control-sm"></textarea>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-4">{{__('customer_contacts.fields.gender')}}</label>
                        <div class="col-8">
                            <select name="gender" id="cus_con_gender" class="form-control form-control-sm">
                                @foreach (__('global.gender') as $k=>$v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-4">{{__('customer_contacts.fields.date_of_birth')}}</label>
                        <div class="col-2">
                            <input type="text" name="date_of_birth" id="cus_con_date_of_birth" class="form-control form-control-sm date">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-outline-primary btn-sm" value="{{ __('global.save') }}">
        </div>
    </div>
</form>

<div class="table-responsive ms-2 me-2">
    <table class="table table-hover" id="cus_con_table" width="100%" cellspacing="0">
      <thead>
        <tr>
           <th class="col-2">{{__('customer_contacts.fields.name')}}</th>
           <th class="col-2">{{__('customer_contacts.fields.job_title')}}</th>
           <th class="col-3">{{__('customer_contacts.fields.email')}}</th>
           <th class="col-2">{{__('customer_contacts.fields.mobile')}}</th>
           <th class="col-2">{{__('customer_contacts.fields.telephone')}}</th>
            <th class="col-1">Actions</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($contacts as $item)
            <tr id="cus_con_r_{{ $item->id }}">
            <td>{{ $item->name}}</td>
            <td>{{ $item->job_title}}</td>
            <td>{{ $item->email}}</td>
            <td>{{ $item->mobile}}</td>
            <td>{{ $item->telephone}}</td>
            <td><select class="cus_con_action form-select" id="cus_con_{{ $item->customer_id }}_{{ $item->id }}">
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
        $('#cus_con_header').html(add);
        $('#cus_con_form').hide();
    });
    $('.date').datetimepicker({
        format: 'YYYY-MM-DD',
        locale: 'en'
    })
    $('#cus_con_add_close').on('click', function(){
        if($('#cus_con_add_close').hasClass('bi-plus')){
            $('#cus_con_add_close').removeClass('bi bi-plus').addClass('bi bi-x')
        }else{
            $('#cus_con_add_close').removeClass('bi bi-x').addClass('bi bi-plus')
        }
        $('#cus_con_form').toggle();
        $('#cus_con_table').toggle();
    });
    $('#cus_con_form').on('submit', function(e){
        e.preventDefault();

        let action = $('#cus_con_action').val();
        if(action === 'Add')
        {
            $('#cus_con_method').val('');
            $('#cus_con_customer_id').val($('#customer_id').val());
            $.ajax({
                url: "/customers/contacts",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'JSON',
                success: function (response) {
                    if(response.success){
                        $('#cus_con_table tbody').append(response.success);
                        document.getElementById("cus_con_form").reset();
                        $('#cus_con_header').html(add);
                        $('#cus_con_action').val('Add');
                        $('#cus_con_add_close').trigger('click');
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
            let id = $('#cus_con_id').val();
            $.ajax({
                url: "/customers/contacts/"+id,
                method:'POST',
                data: new FormData(this),
                processData:false,
                contentType: false,
                cache: false,
                dataType: 'JSON',
                success: function(response)
                {
                    if(response.success){
                        $("#cus_con_r_"+id).remove();
                        $('#cus_con_table tbody').append(response.success);
                        document.getElementById("cus_con_form").reset();
                        $('#cus_con_header').html(add);
                        $('#cus_con_action').val('Add');
                        $('#cus_con_add_close').trigger('click');
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
    $(document).on('change', '.cus_con_action', function(){
        let id = $(this).attr('id');
        let val = $('#'+id).val();
        let _id = id.split('_');
        switch(val)
        {
            case 'Edit':
                $.ajax({
                    url:'/customers/contacts/'+_id[3]+'/edit',
                    dataType:'JSON',
                    method: 'GET',
                    success: function (response) {
                        $('#cus_con_header').html(update);
                        $('#cus_con_action').val(update);
                        $('#cus_con_id').val(_id[3]);
                        $('#cus_con_name').val(response.data.name);
						$('#cus_con_job_title').val(response.data.job_title);
						$('#cus_con_email').val(response.data.email);
						$('#cus_con_mobile').val(response.data.mobile);
						$('#cus_con_telephone').val(response.data.telephone);
						$('#cus_con_date_of_birth').val(response.data.date_of_birth);
						$('#cus_con_gender').val(response.data.gender);
						$('#cus_con_notes').val(response.data.notes);
                        $('#cus_con_method').val('PUT');
                    }
                });
                $('#cus_con_add_close').trigger('click');
                $('#cus_con_form').show();
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
                            url: '/customers/contacts/'+_id[3],
                            data: {_method:'DELETE'},
                            dataType: 'JSON',
                            method:'POST',
                            success: function(response){
                                $('#cus_con_r_'+_id[3]).remove();
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
