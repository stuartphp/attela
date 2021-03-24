@extends('layouts.admin')
@section('title', __('customers.title'))
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">{{ __('customers.title') }} / <a href="{{ route('tasks.index') }}">{{ __('customer_tasks.title') }}</a> </div>
            <div class="col-md-6 text-right">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'customer_tasks_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('/customers/tasks') }}" method="get">
                    <div class="input-group">
                    <input type="text" class="form-control form-control-sm" name="search" placeholder="{{ __('global.search') }}" aria-label="Search" aria-describedby="basic-addon2" @if(isset($search)) value="{{$search}}" @endif>
                    <div class="input-group-append">
                        <button class="btn btn-primary btn-sm" type="submit">
                        <i class="bi bi-search"></i>
                        </button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
               <th>{{__('customer_tasks.fields.customer_id')}}</th>
               <th>{{__('customer_tasks.fields.action_date')}}</th>
               <th>{{__('customer_tasks.fields.title')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
<tbody>
    @foreach ($data as $item)
<tr>
    <td>{{ $item->customer_id}}</td>
    <td>{{ $item->action_date}}</td>
    <td>{{ $item->title}}</td>
    <td><select class="dropdown-action form-control form-control-sm" id="{{ $item->id }}">
        <option value="">{{ __('global.select') }}</option>
        <option value="Edit">{{ __('global.edit') }}</option>
        <option value="Delete">{{ __('global.delete') }}</option>
        <option value="PDF">{{ __('global.pdf') }}</option>
        </select></td>
</tr>
    @endforeach
</tbody>
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
                <label class="col-md-3">{{__('customer_tasks.fields.customer_id')}}</label>
                <div class="col-md-9">
                    <input type="number" name="customer_id" id="customer_id" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('customer_tasks.fields.action_date')}}</label>
                <div class="col-md-9">
                    <input type="text" name="action_date" id="action_date" class="form-control date">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('customer_tasks.fields.title')}}</label>
                <div class="col-md-9">
                    <input type="text" name="title" id="title" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('customer_tasks.fields.customer_contact_id')}}</label>
                <div class="col-md-9">
                    <input type="number" name="customer_contact_id" id="customer_contact_id" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('customer_tasks.fields.deadline')}}</label>
                <div class="col-md-9">
                    <input type="text" name="deadline" id="deadline" class="form-control date">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('customer_tasks.fields.tags')}}</label>
                <div class="col-md-9">
                    <input type="text" name="tags" id="tags" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('customer_tasks.fields.status')}}</label>
                <div class="col-md-9">
                    <input type="text" name="status" id="status" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('customer_tasks.fields.user_id')}}</label>
                <div class="col-md-9">
                    <input type="number" name="user_id" id="user_id" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('customer_tasks.fields.assigned_to')}}</label>
                <div class="col-md-9">
                    <input type="number" name="assigned_to" id="assigned_to" class="form-control">
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
            url: "/customers/tasks",
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
            url: "/customers/tasks/"+id,
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
                url:'/customers/tasks/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    $('.modal-title').html(update);
                    $('#action').val('Update');
                    $('#id').val(response.data.id);
					$('#customer_id').val(response.data.customer_id);
					$('#action_date').val(response.data.action_date);
					$('#title').val(response.data.title);
					$('#customer_contact_id').val(response.data.customer_contact_id);
					$('#deadline').val(response.data.deadline);
					$('#tags').val(response.data.tags);
					$('#status').val(response.data.status);
					$('#user_id').val(response.data.user_id);
					$('#assigned_to').val(response.data.assigned_to);

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
                        url: '/customers/tasks/' + id,
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
