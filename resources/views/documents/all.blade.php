@extends('layouts.iframe')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6"><a href="{{ url('documents/all') }}">{{ __('global.all') }} ({{ $data->total() }})</a></div>
             <div class="col-md-6 text-end">
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('/documents/all') }}" method="get">
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
        <table class="table table-hover" id="dataTable" cellspacing="0">
          <thead>
            <tr>
                <th class="col-1">{{trans('document_types.fields.action_date')}}</th>
                <th class="col-1">{{trans('documents.fields.account_number')}}</th>
                <th class="col-5">{{trans('documents.fields.entity_name')}}</th>
                <th class="col-1">{{trans('document_types.fields.document_number')}}</th>
                <th class="col-1">{{trans('document_types.fields.document_reference')}}</th>
                <th class="col-1">{{trans('document_types.fields.reference_number')}}</th>
                <th class="col-1 text-end pe-3">{{trans('document_types.fields.total_amount')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
          <tbody>
              @if(count($data)>0)
              @foreach ($data as $item)
                <tr>
                    <td>{{ $item->action_date }}</td>
                    <td class="">{{ $item->account_number }}</td>
                    <td>{{ $item->entity_name }}</td>
                    <td>{{ $item->document_number }}</td>
                    <td class="">{{ __('global.documents.'.$item->document_type) }}</td>
                    <td class="">{{ $item->reference_number }}</td>
                    <td class="text-end pe-3 {{ ($item->total_due <0.01)? 'text-green': 'text-red' }} ">
                        {{ number_format($item->total_amount,2) }}
                    </td>
                    <td><select class="action form-select" id="{{ $item->id }}">
                        <option value="">{{ __('global.select') }}</option>
                        @if($item->is_paid==1)
                        <option value="Credit">{{ __('global.credit') }}</option>
                        @endif
                        @if($item->is_locked<1)
                        <option value="Edit">{{ __('global.edit') }}</option>
                        <option value="Lock">{{ __('global.lock') }}</option>
                        @endif
                        <option value="PDF">{{ __('global.pdf') }}</option>
                        <option value="View">{{ __('global.view') }}</option>
                        </select></td>
                </tr>
              @endforeach
              @else
                <tr>
                    <td colspan="7">{{ __('global.no_results') }}</td>
                </tr>
              @endif
          </tbody>
        </table>
    </div>
  </div>
<!-- /.box-footer-->
<div class="card-footer">{{ $data->render() }}</div>
</div>

@endsection
