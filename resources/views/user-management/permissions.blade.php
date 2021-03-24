@extends('layouts.admin')
@section('title' , __('global.menu.users.title'))
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">{{ __('global.menu.users.title') }} / <a href="{{ route('permissions.index') }}">{{ __('permissions.title') }}</a> </div>
            <div class="col-md-6 text-right">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'permissions_create']))==1)
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
               <th>Title</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>

        </table>
    </div>
  </div>
<!-- /.box-footer-->
</div>

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
            <form method="post" id="main_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="method">
                <input type="hidden" id="id" value="">
                <div class="form-group row">
                <label class="col-md-3">Title</label>
                <div class="col-md-9">
                    <input type="text" name="title" id="title" class="form-control">
                </div>
            </div>

          <div class="form-group" align="right">
            <input type="submit" name="action_button" id="action" class="btn btn-primary btn-sm" value="Add">
        </div>
            </form>
      </div>
    </div>
  </div>

@endsection
@section('scripts')
<script>

$(function () {
    var table = $('#dataTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "/user-management/permissions/get-data",
    columnDefs: [

    ],
    columns: [

		{data:'title', name:'title'},
		{
        "render": function(d,t,r){
            let $select = $("<select></select>", {
                'class':"form-control dropdown-action",
                'id':r.id,
            });
            let $option='';

            $option = $('<option></option>', {
                "text":'--Select--',
                "value":''
            });
            $select.append($option);
            @if(count(array_intersect(session()->get('grant'), ['SU', 'permissions_edit']))==1)
            $option = $('<option></option>', {
                "text":'{{__('global.edit')}}',
                "value":'Edit'
            });
            $select.append($option);
            @endif
            @if(count(array_intersect(session()->get('grant'), ['SU', 'permissions_delete']))==1)
            $option = $('<option></option>', {
                "text":'{{__('global.delete')}}',
                "value":'Delete'
            });
            $select.append($option);
            @endif
            return $select.prop("outerHTML");
        }},
    ],
    pageLength: 15,
    lengthMenu: [[10, 15, 25, 50, -1], [10, 15, 25, 50, "All"]]
    });
});

$('#create_record').click(function () {
    $('#main_form')[0].reset();
    $('.modal-title').html('Add');
    $('#action').val('Add');
    $('#formModal').modal('show');
});
$('#main_form').on('submit', function (event) {
    event.preventDefault();
    if($('#action').val() === 'Add')
    {
        $('#method').val('');
        $.ajax({
            url: "/user-management/permissions",
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
            url: "/user-management/permissions/"+id,
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
                url:'/user-management/permissions/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    $('.modal-title').html('Update');
                    $('#action').val('Update');
                    $('#id').val(response.data.id);
					$('#title').val(response.data.title);

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
                        url: '/user-management/permissions/' + id,
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

