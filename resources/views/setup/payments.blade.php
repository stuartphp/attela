@extends('layouts.iframe')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-6">{{ __('setup_payment.title') }}</div>
            <div class="col-6 text-end">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'setup_payment_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('/setup/payments') }}" method="get">
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
                <th class="col-8">{{__('ledgers.fields.account_description')}}</th>
                <th class="col-2">{{__('ledgers.fields.group_name')}}</th>
                <th class="col-1">{{__('ledgers.fields.ledger_number')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($data as $item)
                <tr>
                    <td>{{ $item->account_description}}</td>
                    <td>{{ $item->group_name}}</td>
                    <td>{{ $item->ledger_number}}</td>
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

<div class="modal" id="formModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-2">
                <label class="col-5">{{__('setup_payment.fields.account_description')}}</label>
                <div class="col-7">
                    <input type="text" name="account_description" id="account_description" class="form-control form-control-sm" required>
                </div>
            </div><div class="row mb-2">
                <label class="col-5">{{__('setup_payment.fields.ledger_number')}}</label>
                <div class="col-7">
                    <input type="text" name="ledger_number" id="ledger_number" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d]/,'')" value="84"  pattern=".{7,7}" required title="7 characters" required>
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
        document.getElementById("main_form").reset();
        $('#main_form').attr('action', '/setup/payments');
        $('#method').val('');
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
                    url:'/setup/payments/'+id+'/edit',
                    dataType:'JSON',
                    method: 'GET',
                    success: function (response) {
                        $('.modal-title').html(update);
                        $('#action').val('Update');
                        $('#id').val(response.id);
                        $('#account_description').val(response.account_description);
                        $('#ledger_number').val(response.ledger_number);
                        $('#main_form').attr('action', '/setup/payments/'+id);
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
                        $('#main_form').attr('action', '/setup/payments/'+id);
                        $('#method').val('DELETE');
                        $('#main_form').trigger('submit');
                    }
                });
                break;

        }
        $('#'+id).val('');
    });</script>
@endsection
