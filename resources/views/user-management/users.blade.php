@extends('layouts.admin')
@section('title' , __('global.menu.users.title'))
@section('content')

<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">{{ __('global.menu.users.title') }} / <a href="{{ route('users.index') }}">{{ __('users.title') }}</a></div>
            <div class="col-md-6 text-right">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'users_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
            </div>
        </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
               <th>Name</th><th>Email</th><th>Contact Number</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
          <body>
              @foreach ($data as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->contact_number }}</td>
                    <td></td>
                </tr>
              @endforeach
          </body>
        </table>
    </div>
  </div>
<!-- /.box-footer-->
</div>
<form method="post" id="main_form" enctype="multipart/form-data">
@csrf
<input type="hidden" id="action"/>
<input type="hidden" name="_method" id="method">
<input type="hidden" id="id" value="">
<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Record</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

                <div class="form-group row">
                <label class="col-md-3">{{__('users.name')}}</label>
                <div class="col-md-9">
                    <input type="text" name="name" id="name" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('users.email')}}</label>
                <div class="col-md-9">
                    <input type="text" name="email" id="email" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('users.contact_number')}}</label>
                <div class="col-md-9">
                    <input type="text" name="contact_number" id="contact_number" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('users.image')}}</label>
                <div class="col-md-9">
                    <input type="text" name="image" id="image" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('users.password')}}</label>
                <div class="col-md-9">
                    <input type="text" name="password" id="password" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('users.language')}}</label>
                <div class="col-md-9">

                    <select name="language" id="language" class="form-control">
                        @foreach(__('global.available_languages') as $langLocale => $langName)
                        <option value="{{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</option>
                        @endforeach
                    </select>

                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('users.is_active')}}</label>
                <div class="col-md-9">
                    <input type="text" name="is_active" id="is_active" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('users.email_verified_at')}}</label>
                <div class="col-md-9">
                    <input type="text" name="email_verified_at" id="email_verified_at" class="form-control date">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('users.email_host')}}</label>
                <div class="col-md-9">
                    <input type="text" name="email_host" id="email_host" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('users.email_username')}}</label>
                <div class="col-md-9">
                    <input type="text" name="email_username" id="email_username" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('users.email_password')}}</label>
                <div class="col-md-9">
                    <input type="text" name="email_password" id="email_password" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('users.email_port')}}</label>
                <div class="col-md-9">
                    <input type="text" name="email_port" id="email_port" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('users.email_ssl')}}</label>
                <div class="col-md-9">
                    <input type="text" name="email_ssl" id="email_ssl" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('users.email_signature')}}</label>
                <div class="col-md-9">
                    <textarea name="email_signature" id="email_signature" class="form-control"></textarea>
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('users.remember_token')}}</label>
                <div class="col-md-9">
                    <input type="text" name="remember_token" id="remember_token" class="form-control">
                </div>
            </div>

          <div class="form-group" align="right">

        </div>

      </div>
      <div class="modal-footer">
          <input type="submit" class="btn btn-primary btn-sm" value="{{ __('global.save') }}">
      </div>
    </div>
  </div>
</form>
@endsection
@section('scripts')
<script>

    $('#create_record').click(function () {
        $('#main_form')[0].reset();
        $('.modal-title').html(add);
        $('#action').val('Add');
        $('#formModal').modal('show');
    });
    $('#main_form').on('submit', function (event) {
        event.preventDefault();
        if($('#action').val() === 'Add')
        {
            $('#method').val('');
            $.ajax({
                url: "/user-management/users",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'JSON',
                success: function (response) {
                    if(response.success){
                        $('#main_form')[0].reset();
                        $('#formModal').modal('hide');
                        $('#dataTable').DataTable().ajax.reload(null, false);
                        notice('success', '{{__('global.record_added')}}');
                    }else{
                        let err='<ul class="text-left">';
                        for(let i=0; i<response.errors.length; i++)
                        {
                            err += "<li>"+response.errors[i]+"</li>";
                        }
                        err +="</ul>";
                        notice('error', '{{__('global.error_add')}}', err);
                    }
                }
            });
        }
        if($('#action').val() === 'Update')
        {
            let id = $('#id').val();
            $('#method').val('PUT');
            $.ajax({
                url: "/user-management/users/"+id,
                method:'POST',
                data: new FormData(this),
                processData:false,
                contentType: false,
                cache: false,
                dataType: 'JSON',
                success: function(response)
                {
                    if(response == 'success'){
                        $('#formModal').modal('hide');
                        $('#dataTable').DataTable().ajax.reload(null, false);
                        notice('success', '{{__('global.record_updated')}}');
                    }else{
                        let err='<ul class="text-left">';
                        for(let i=0; i<response.errors.length; i++)
                        {
                            err += "<li>"+response.errors[i]+"</li>";
                        }
                        err +="</ul>";
                        notice('error', '{{__('global.error_update')}}', err);
                    }
                }
            });
        }
    });
    $(document).on('change', '.dropdown-action', function(){
        let id = $(this).attr('id');
        let val = $('#' + id).val();

        switch(val)
        {
            case 'Edit':
            $.ajax({
                    url:'/user-management/users/'+id+'/edit',
                    dataType:'JSON',
                    method: 'GET',
                    success: function (response) {
                        $('.modal-title').html(update);
                        $('#action').val('Update');
                        $('#id').val(response.data.id);
                        $('#name').val(response.data.name);
                        $('#email').val(response.data.email);
                        $('#contact_number').val(response.data.contact_number);
                        $('#image').val(response.data.image);
                        $('#password').val(response.data.password);
                        $('#language').val(response.data.language);
                        $('#is_active').val(response.data.is_active);
                        $('#email_verified_at').val(response.data.email_verified_at);
                        $('#email_host').val(response.data.email_host);
                        $('#email_username').val(response.data.email_username);
                        $('#email_password').val(response.data.email_password);
                        $('#email_port').val(response.data.email_port);
                        $('#email_ssl').val(response.data.email_ssl);
                        $('#email_signature').val(response.data.email_signature);
                        $('#remember_token').val(response.data.remember_token);

                    }
                });
                $('#formModal').modal('show');
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
                        $.ajax({
                            url: '/user-management/users/' + id,
                            dataType: 'JSON',
                            data: {_method: 'DELETE', _token:'{{ csrf_token() }}'},
                            method: 'POST',
                            success: function (response) {
                                if (response.success) {
                                    notice('success', '{{__('global.record_deleted')}}');
                                    $('#dataTable').DataTable().ajax.reload(null, false);
                                }
                            }
                        });
                    }
                });
                break;

        }
        $('#'+id).val('');
    });
    </script>
@endsection


