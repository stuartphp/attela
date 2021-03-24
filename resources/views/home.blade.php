@extends('layouts.admin')

@section('content')
<h4>{{ __('global.select') }}
    @if(is_array(session()->get('grant')))
        @if(count(array_intersect(session()->get('grant'), ['SU','companies_create']))==1)
            <a href="#" onclick="$('#formModal').modal('show')" title="{{ __('global.add_new_record') }}"><i class="bi bi-plus"></a></i>
        @endif
    @endif

</h4>
@foreach($companies as $key=>$val)
    <a href="{{ url('selection') }}/{{$key}}" class="btn btn-lg btn-outline-info">{{$val}}</a>
@endforeach
<form method="post" id="main_form" action="{{ route('companies.store') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="action"/>
    <input type="hidden" name="_method" id="method">
    <input type="hidden" id="id" value="">
    <input type="hidden" name="creator" id="creator" value="{{ Auth::id() }}">
    <div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add New Record</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 row">
                            <label class="col-md-4">{{__('companies.fields.trading_name')}}</label>
                            <div class="col-md-8">
                                <input type="text" name="trading_name" id="trading_name" class="form-control form-control-sm">
                            </div>
                        </div><div class="mb-3 row">
                            <label class="col-md-4">{{__('companies.fields.registered_as')}}</label>
                            <div class="col-md-8">
                                <input type="text" name="registered_as" id="registered_as" class="form-control form-control-sm">
                            </div>
                        </div><div class="mb-3 row">
                            <label class="col-md-4">{{__('companies.fields.registration_number')}}</label>
                            <div class="col-md-8">
                                <input type="text" name="registration_number" id="registration_number" class="form-control form-control-sm">
                            </div>
                        </div><div class="mb-3 row">
                            <label class="col-md-4">{{__('companies.fields.contact_name')}}</label>
                            <div class="col-md-8">
                                <input type="text" name="contact_name" id="contact_name" class="form-control form-control-sm">
                            </div>
                        </div><div class="mb-3 row">
                            <label class="col-md-4">{{__('companies.fields.contact_number')}}</label>
                            <div class="col-md-8">
                                <input type="text" name="contact_number" id="contact_number" class="form-control form-control-sm">
                            </div>
                        </div><div class="mb-3 row">
                            <label class="col-md-4">{{__('companies.fields.email')}}</label>
                            <div class="col-md-8">
                                <input type="text" name="email" id="email" class="form-control form-control-sm">
                            </div>
                        </div><div class="mb-3 row">
                            <label class="col-md-4">{{__('companies.fields.physical_address')}}</label>
                            <div class="col-md-8">
                                <textarea name="physical_address" id="physical_address" class="form-control form-control-sm"></textarea>
                            </div>
                        </div><div class="mb-3 row">
                            <label class="col-md-4">{{__('companies.fields.postal_address')}}</label>
                            <div class="col-md-8">
                                <textarea name="postal_address" id="postal_address" class="form-control form-control-sm"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 row">
                            <label class="col-md-4">{{__('companies.fields.domain')}}</label>
                            <div class="col-md-8">
                                <input type="text" name="domain" id="domain" class="form-control form-control-sm">
                            </div>
                        </div><div class="mb-3 row">
                            <label class="col-md-4">{{__('companies.fields.url_contact_us')}}</label>
                            <div class="col-md-8">
                                <input type="text" name="url_contact_us" id="url_contact_us" class="form-control form-control-sm">
                            </div>
                        </div><div class="mb-3 row">
                            <label class="col-md-4">{{__('companies.fields.url_terms_and_conditions')}}</label>
                            <div class="col-md-8">
                                <input type="text" name="url_terms_and_conditions" id="url_terms_and_conditions" class="form-control form-control-sm">
                            </div>
                        </div><div class="mb-3 row">
                            <label class="col-md-4">{{__('companies.fields.url_privacy_policy')}}</label>
                            <div class="col-md-8">
                                <input type="text" name="url_privacy_policy" id="url_privacy_policy" class="form-control form-control-sm">
                            </div>
                        </div><div class="mb-3 row">
                            <label class="col-md-4">{{__('companies.fields.slogan')}}</label>
                            <div class="col-md-8">
                                <input type="text" name="slogan" id="slogan" class="form-control form-control-sm">
                            </div>
                        </div><div class="mb-3 row">
                            <label class="col-md-4">{{__('companies.fields.document_logo')}}</label>
                            <div class="col-md-8">
                                <input type="text" name="document_logo" id="document_logo" class="form-control form-control-sm">
                            </div>
                        </div><div class="mb-3 row">
                            <label class="col-md-4">{{__('companies.fields.bank_name')}}</label>
                            <div class="col-md-8">
                                <input type="text" name="bank_name" id="bank_name" class="form-control form-control-sm">
                            </div>
                        </div><div class="mb-3 row">
                            <label class="col-md-4">{{__('companies.fields.bank_branch')}}</label>
                            <div class="col-md-8">
                                <input type="text" name="bank_branch" id="bank_branch" class="form-control form-control-sm">
                            </div>
                        </div><div class="mb-3 row">
                            <label class="col-md-4">{{__('companies.fields.bank_branch_code')}}</label>
                            <div class="col-md-8">
                                <input type="text" name="bank_branch_code" id="bank_branch_code" class="form-control form-control-sm">
                            </div>
                        </div><div class="mb-3 row">
                            <label class="col-md-4">{{__('companies.fields.bank_account_number')}}</label>
                            <div class="col-md-8">
                                <input type="text" name="bank_account_number" id="bank_account_number" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          <div class="modal-footer">
              <input type="submit" class="btn btn-primary btn-sm" value="{{ __('global.save') }}">
          </div></div>
        </div>
      </div>
    </form>
@endsection
