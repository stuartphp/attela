@extends('layouts.iframe')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-6">{{ __('settings.documents.title') }}</div>
            <div class="col-6 text-end">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'documents_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('/setup/documents') }}" method="get">
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
                <th class="col-2">{{__('settings.documents.fields.user_id')}}</th>
                <th class="col-2">{{__('settings.documents.fields.document_type')}}</th>
                <th class="col-2">{{__('settings.documents.fields.sales_code')}}</th>
                <th class="col-4">{{__('settings.documents.fields.note')}}</th>
                <th class="col-1">{{__('settings.documents.fields.options')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($data as $item)
                <tr>
                    <td>{{ $item->user_id}}</td>
                    <td>{{ $item->document_type}}</td>
                    <td>{{ $item->sales_code}}</td>
                    <td>{{ $item->note}}</td>
                    <td>{{ $item->options}}</td>
                    <td><select class="dropdown-action form-select" id="{{ $item->id }}">
                        <option value="">{{ __('global.select') }}</option>
                        <option value="Edit">{{ __('global.edit') }}</option>
                        <option value="Delete">{{ __('global.delete') }}</option>
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
<input type="hidden" id="id" value=""><input type="hidden" name="company_id" id="company_id" value="{{ session()->get('company_id') }}">

<div class="modal fade" id="formModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-2">
                <label class="col-5">{{__('settings.documents.fields.user_id')}}</label>
                <div class="col-7">
                    <input type="text" name="user_id" id="user_id" class="form-control form-control-sm">
                </div>
            </div><div class="row mb-2">
                <label class="col-5">{{__('settings.documents.fields.document_type')}}</label>
                <div class="col-7">
                    <input type="text" name="document_type" id="document_type" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
            </div><div class="row mb-2">
                <label class="col-5">{{__('settings.documents.fields.sales_code')}}</label>
                <div class="col-7">
                    <input type="text" name="sales_code" id="sales_code" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                </div>
            </div><div class="row mb-2">
                <label class="col-5">{{__('settings.documents.fields.note')}}</label>
                <div class="col-7">
                    <input type="text" name="note" id="note" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d*(\.\d{0,2})?$]/,'')">
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-5">{{__('settings.documents.fields.options')}}</label>
                <div class="col-7">
                    <input type="text" name="options" id="options" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-5">{{__('settings.documents.fields.project')}}</label>
                <div class="col-7">
                    <input type="text" name="project" id="project" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-5">{{__('settings.documents.fields.store')}}</label>
                <div class="col-7">
                    <input type="text" name="store" id="store" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-5">{{__('settings.documents.fields.unit_price')}}</label>
                <div class="col-7">
                    <input type="text" name="unit_price" id="unit_price" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-5">{{__('settings.documents.fields.tax_type')}}</label>
                <div class="col-7">
                    <input type="text" name="tax_type" id="tax_type" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-5">{{__('settings.documents.fields.price_excl')}}</label>
                <div class="col-7">
                    <input type="text" name="price_excl" id="price_excl" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-5">{{__('settings.documents.fields.discount_perc')}}</label>
                <div class="col-7">
                    <input type="text" name="discount_perc" id="discount_perc" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-primary btn-sm" value="{{ __('global.save') }}">
        </div>
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

    $(document).on('change', '.dropdown-action', function(){
        let id = $(this).attr('id');
        let val = $('#' + id).val();

        switch(val)
        {
            case 'Edit':
            $.ajax({
                    url:'/setup/documents/'+id+'/edit',
                    dataType:'JSON',
                    method: 'GET',
                    success: function (response) {
                        $('.modal-title').html(update);
                        $('#action').val('Update');
                        $('#id').val(response.data.id);
                        $('#company_id').val(response.data.company_id);
                        $('#name').val(response.data.name);
                        $('#standard_rate').val(response.data.standard_rate);
                        $('#standard_weight_gram').val(response.data.standard_weight_gram);
                        $('#additional_cost').val(response.data.additional_cost);
                        $('#additional_weight_per_gram').val(response.data.additional_weight_per_gram);
                        $('#main_form').attr('action', '/setup/documents/'+id);
                        $('#method').val('PUT');
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
                        $('#main_form').attr('action', '/setup/documents/'+id);
                        $('#method').val('DELETE');
                        $('#main_form').trigger('submit');
                    }
                });
                break;

        }
        $('#'+id).val('');
    });</script>
@endsection



