@extends('layouts.admin')
@section('title', __('global.menu.accounting.title') )
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">{{ __('global.menu.accounting.title') }} / <a href="{{ route('journal-entries.index') }}">{{ __('journal_entries.title') }}</a></div>
            <div class="col-md-6 text-right">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'journal_entries_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('/accounting/journal-entries') }}" method="get">
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
                <th>{{trans('journal_entries.fields.action_date')}}</th>
                <th>{{trans('journal_entries.fields.account_number')}}</th>
                <th>{{trans('journal_entries.fields.entity_name')}}</th>
                <th>{{trans('journal_entries.fields.description')}}</th>
                <th>{{trans('journal_entries.fields.reference')}}</th>
                <th>{{trans('journal_entries.fields.type')}}</th>
                <th>{{trans('journal_entries.fields.ledger')}}</th>
                <th class="text-right">{{trans('journal_entries.fields.debit_amount')}}</th>
                <th class="text-right">{{trans('journal_entries.fields.credit_amount')}}</th>
            </tr>
          </thead>
<tbody>
    @foreach ($data as $item)
<tr>
    <td>{{ $item->action_date}}</td>
    <td>{{ $item->account_number}}</td>
    <td>{{ $item->entity_name}}</td>
    <td>{{ $item->description}}</td>
    <td>{{ $item->reference}}</td>
    <td>{{ $item->type}}</td>
    <td>{{ $item->ledger}}</td>
    <td class="text-right">{{ ($item->debit_amount>0) ?number_format($item->debit_amount,2):''}}</td>
    <td class="text-right">{{ ($item->credit_amount>0)?number_format($item->credit_amount,2):''}}</td>
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
                <label class="col-md-3">{{__('journal_entries.fields.journal_code')}}</label>
                <div class="col-md-9">
                    <select name="journal_code" id="journal_code" class="form-control">
                        {!! $cats !!}
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3">{{__('journal_entries.fields.journal_type')}}</label>
                <div class="col-md-9">
                    <select id="journal_type" class="form-control">
                        @foreach (__('journal_entries.journal_groups') as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3">{{__('journal_entries.fields.action_date')}}</label>
                <div class="col-md-9">
                    <input type="text" name="action_date" id="action_date" class="form-control date">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('journal_entries.fields.document_id')}}</label>
                <div class="col-md-9">
                    <input type="number" name="document_id" id="document_id" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('journal_entries.fields.account_number')}}</label>
                <div class="col-md-9">
                    <input type="text" name="account_number" id="account_number" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('journal_entries.fields.entity_name')}}</label>
                <div class="col-md-9">
                    <input type="text" name="entity_name" id="entity_name" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('journal_entries.fields.description')}}</label>
                <div class="col-md-9">
                    <input type="text" name="description" id="description" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('journal_entries.fields.reference')}}</label>
                <div class="col-md-9">
                    <input type="text" name="reference" id="reference" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('journal_entries.fields.type')}}</label>
                <div class="col-md-9">
                    <input type="text" name="type" id="type" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('journal_entries.fields.tax_type')}}</label>
                <div class="col-md-9">
                    <input type="text" name="tax_type" id="tax_type" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('journal_entries.fields.affect_journal')}}</label>
                <div class="col-md-9">
                    <input type="text" name="affect_journal" id="affect_journal" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('journal_entries.fields.ledger')}}</label>
                <div class="col-md-9">
                    <input type="text" name="ledger" id="ledger" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('journal_entries.fields.debit_amount')}}</label>
                <div class="col-md-9">
                    <input type="text" name="debit_amount" id="debit_amount" class="form-control">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('journal_entries.fields.credit_amount')}}</label>
                <div class="col-md-9">
                    <input type="text" name="credit_amount" id="credit_amount" class="form-control">
                </div>
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
            url: "/accounting/journal-entries",
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
            url: "/accounting/journal-entries/"+id,
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
function viewEntries(v) {
        $('#result').load('/accounting/api/view/' + v);
    }
</script>
@endsection
