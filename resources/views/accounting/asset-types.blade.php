@extends('layouts.admin')
@section('title', __('global.menu.accounting.title'))
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">{{ __('global.menu.accounting.title') }} / <a href="{{ route('asset-types.index') }}">{{ __('asset_types.title') }}</a> </div>
            <div class="col-md-6 text-right">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'asset_types_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ route('asset-types.index') }}" method="get">
                    <div class="input-group">
                    <input type="text" class="form-control form-control-sm" name="search" placeholder="{{ __('global.search') }}" aria-label="Search" aria-describedby="basic-addon2" @if(isset($keyword)) value="{{$keyword}}" @endif>
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
               <th>{{__('asset_types.fields.asset_group_id')}}</th>
               <th>{{__('asset_types.fields.name')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
<tbody>
    @if(count($data)>0)
    @foreach ($data as $item)
<tr>
    <td>{{ $item->asset_group_id}}</td>
    <td>{{ $item->name}}</td>
    <td><select class="action form-control form-control-sm" id="{{ $item->id }}">
        <option value="">{{ __('global.select') }}</option>
        <option value="PDF">{{ __('global.pdf') }}</option>
        <option value="View">{{ __('global.view') }}</option>
        </select></td>
</tr>
    @endforeach
    @else
    <tr><td colspan="3">{{ __('global.no_results') }}</td></tr>
    @endif
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
<input type="hidden" id="id" value=""><input type="hidden" name="company_id" id="company_id" value="{{ session()->get('company-id') }}">
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
                <label class="col-md-3">{{__('asset_types.fields.asset_group_id')}}</label>
                <div class="col-md-9">
                    <select name="asset_group_id" id="asset_group_id" class="form-control select">
                        @foreach (\App\Models\AssetGroup::where('company_id', session()->get('company_id'))->orderBy('name')->pluck('name', 'id')->toArray() as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('asset_types.fields.name')}}</label>
                <div class="col-md-9">
                    <input type="text" name="name" id="name" class="form-control">
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
    $('#action').val(add);
    $('#formModal').modal('show');
});

$(document).on('change', '.action', function(){
    let id = $(this).attr('id');
    let val = $('#' + id).val();

    switch(val)
    {
        case 'Edit':
        $.ajax({
                url:'/accounting/asset-types/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    $('.modal-title').html(update);
                    $('#action').val(update);
                    $('#id').val(response.data.id);
                    $('#main_form').attr('action', "/accounting/asset-types/"+id);
                    $('#method').val('PUT');
					$('#company_id').val(response.data.company_id);
					$('#asset_group_id').val(response.data.asset_group_id);
					$('#name').val(response.data.name);

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
                        url: '/accounting/asset-types/' + id,
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
