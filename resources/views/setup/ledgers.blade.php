@extends('layouts.iframe')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-6"><a href="/setup/ledgers">{{ __('ledgers.title') }}</a></div>
            <div class="col-6 text-end">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'ledgers_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('/setup/ledgers') }}" method="get">
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
                <th class="col-1">{{__('ledgers.fields.ledger_number')}}</th>
                <th class="col-2">{{__('ledgers.fields.group_name')}}</th>
                <th class="col-1">{{__('ledgers.fields.normal_balance')}}</th>
                <th class="col-2">{{__('ledgers.fields.financial_category')}}</th>
                <th class="col-5">{{__('ledgers.fields.account_description')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
            <tbody>
                @foreach ($data as $item)
            <tr>
                <td>{{ substr($item->ledger_number,0,4)}}/{{ substr($item->ledger_number,4,3) }}</td>
                <td>{{ __('accounting_lookup.ledger.groups.'.$item->group_name)}} {{ $item->id }}{{ $item->ledger_id }}</td>
                <td>{{ __('accounting_lookup.ledger.balance.'.$item->normal_balance)}}</td>
                <td>{{ __('accounting_lookup.ledger.category.'.$item->financial_category)}}</td>
                <td>{{ $item->account_description}}</td>
                <td><select class="action form-select" id="{{ $item->id }}">
                    <option value="">{{ __('global.select') }}</option>
                    <option value="PDF">{{ __('global.pdf') }}</option>
                    <option value="View">{{ __('global.view') }}</option>
                    </select></td>
            </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
  <div class="card-footer">{{ $data->render() }}</div>
<!-- /.box-footer-->
</div>
<form method="post" id="main_form" enctype="multipart/form-data">
@csrf
<input type="hidden" id="action"/>
<input type="hidden" name="_method" id="method">
<input type="hidden" id="id" value="">
<input type="hidden" name="company_id" id="company_id" value="{{ session()->get('company_id') }}">

<div class="modal" id="formModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-2">
                <label class="col-3">{{__('ledgers.fields.ledger_number')}}</label>
                <div class="col-9">
                    <input type="text" name="ledger_number" id="ledger_number" class="form-control form-control-sm">
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('ledgers.fields.group_name')}}</label>
                <div class="col-9">
                    <select name="group_name" id="group_name" class="form-select">
                        @foreach (__('accounting_lookup.ledger.groups') as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('ledgers.fields.normal_balance')}}</label>
                <div class="col-9">
                    <select name="normal_balance" id="normal_balance" class="form-select">
                        @foreach (__('accounting_lookup.ledger.balance') as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('ledgers.fields.financial_category')}}</label>
                <div class="col-9">
                    <select name="financial_category" id="financial_category" class="form-select">
                        <option value="">{{ __('global.select') }}</option>
                        @foreach (__('accounting_lookup.ledger.category') as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('ledgers.fields.account_description')}}</label>
                <div class="col-9">
                    <input type="text" name="account_description" id="account_description" class="form-control form-control-sm">
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('ledgers.fields.is_active')}}</label>
                <div class="col-9">
                    <select name="is_active" id="is_active" class="form-select">
                        @foreach (__('global.yesno') as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
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
$('#main_form').on('submit', function (event) {
    event.preventDefault();
    if($('#action').val() === 'Add')
    {
        $('#method').val('');
        $.ajax({
            url: "/setup/ledgers",
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
            url: "/setup/ledgers/"+id,
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
                url:'/setup/ledgers/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    $('.modal-title').html(update);
                    $('#action').val('Update');
                    $('#id').val(response.data.id);
					$('#company_id').val(response.data.company_id);
					$('#ledger_number').val(response.data.ledger_number);
					$('#group_name').val(response.data.group_name);
					$('#normal_balance').val(response.data.normal_balance);
					$('#financial_category').val(response.data.financial_category);
					$('#account_description').val(response.data.account_description);
					$('#is_active').val(response.data.is_active);

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
                        url: '/setup/ledgers/' + id,
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
