@extends('layouts.iframe')
@section('content')
<form method="post" id="set_com_form" action="@if(isset($data->id)){{ route('companies.update', $data->id) }}@else {{ route('companies.store') }} @endif" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="action"/>
    <input type="hidden" name="_method" id="method" value="PUT">
    <input type="hidden" id="id" value="">
    <input type="hidden" name="creator" id="creator" value="{{ Auth::id() }}">
    <div class="card shadow mb-4">
        <div class="card-header">Company</div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="row mb-2">
                        <label class="col-3">{{__('companies.fields.trading_name')}}</label>
                        <div class="col-9">
                            <input type="text" name="trading_name" id="trading_name" value="{{ $data->trading_name }}" class="form-control form-control-sm">
                        </div>
                    </div><div class="row mb-2">
                        <label class="col-3">{{__('companies.fields.registered_as')}}</label>
                        <div class="col-9">
                            <input type="text" name="registered_as" id="registered_as" value="{{ $data->registered_as }}" class="form-control form-control-sm">
                        </div>
                    </div><div class="row mb-2">
                        <label class="col-3">{{__('companies.fields.registration_number')}}</label>
                        <div class="col-9">
                            <input type="text" name="registration_number" id="registration_number" value="{{ $data->registration_number }}" class="form-control form-control-sm">
                        </div>
                    </div><div class="row mb-2">
                        <label class="col-3">{{__('companies.fields.contact_name')}}</label>
                        <div class="col-9">
                            <input type="text" name="contact_name" id="contact_name" value="{{ $data->contact_name }}" class="form-control form-control-sm">
                        </div>
                    </div><div class="row mb-2">
                        <label class="col-3">{{__('companies.fields.contact_number')}}</label>
                        <div class="col-9">
                            <input type="text" name="contact_number" id="contact_number" value="{{ $data->contact_number }}" class="form-control form-control-sm">
                        </div>
                    </div><div class="row mb-2">
                        <label class="col-3">{{__('companies.fields.email')}}</label>
                        <div class="col-9">
                            <input type="text" name="email" id="email" class="form-control form-control-sm" value="{{ $data->email }}">
                        </div>
                    </div><div class="row mb-2">
                        <label class="col-3">{{__('companies.fields.physical_address')}}</label>
                        <div class="col-9">
                            <textarea name="physical_address" id="physical_address" class="form-control form-control-sm">{!! $data->physical_address !!}</textarea>
                        </div>
                    </div><div class="row mb-2">
                        <label class="col-3">{{__('companies.fields.postal_address')}}</label>
                        <div class="col-9">
                            <textarea name="postal_address" id="postal_address" class="form-control form-control-sm">{!! $data->postal_address !!}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row mb-2">
                        <label class="col-3">{{__('companies.fields.domain')}}</label>
                        <div class="col-9">
                            <input type="text" name="domain" id="domain" class="form-control form-control-sm" value="{{ $data->domain }}">
                        </div>
                    </div><div class="row mb-2">
                        <label class="col-3">{{__('companies.fields.url_contact_us')}}</label>
                        <div class="col-9">
                            <input type="text" name="url_contact_us" id="url_contact_us" value="{{ $data->url_contact_us }}" class="form-control form-control-sm">
                        </div>
                    </div><div class="row mb-2">
                        <label class="col-3">{{__('companies.fields.url_terms_and_conditions')}}</label>
                        <div class="col-9">
                            <input type="text" name="url_terms_and_conditions" id="url_terms_and_conditions" value="{{ $data->url_terms_and_conditions }}" class="form-control form-control-sm">
                        </div>
                    </div><div class="row mb-2">
                        <label class="col-3">{{__('companies.fields.url_privacy_policy')}}</label>
                        <div class="col-9">
                            <input type="text" name="url_privacy_policy" id="url_privacy_policy" value="{{ $data->url_privacy_policy }}" class="form-control form-control-sm">
                        </div>
                    </div><div class="row mb-2">
                        <label class="col-3">{{__('companies.fields.slogan')}}</label>
                        <div class="col-9">
                            <input type="text" name="slogan" id="slogan" class="form-control form-control-sm" value="{{ $data->slogan }}">
                        </div>
                    </div><div class="row mb-2">
                        <label class="col-3">{{__('companies.fields.document_logo')}}</label>
                        <div class="col-9">
                            <div class="input-group">
                                <input type="file"  name="document_logo" id="document_logo" class="form-control form-control-sm" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-primary btn-sm disabled" type="submit">
                                        {{ __('global.size') }} 800x200 Max:850Kb
                                        </button>
                                </div>
                              </div>
                              @if($data->document_logo>'')
                              <img src="/{{ $data->document_logo }}" style="height: 75px"/>
                              @endif


                        </div>

                    </div>
                    <div class="row mb-2">
                        <label class="col-3">{{__('companies.fields.bank_name')}}</label>
                        <div class="col-9">
                            <input type="text" name="bank_name" id="bank_name" class="form-control form-control-sm" value="{{ $data->bank_name }}">
                        </div>
                    </div><div class="row mb-2">
                        <label class="col-3">{{__('companies.fields.bank_branch')}}</label>
                        <div class="col-9">
                            <input type="text" name="bank_branch" id="bank_branch" class="form-control form-control-sm" value="{{ $data->bank_branch }}">
                        </div>
                    </div><div class="row mb-2">
                        <label class="col-3">{{__('companies.fields.bank_branch_code')}}</label>
                        <div class="col-9">
                            <input type="text" name="bank_branch_code" id="bank_branch_code" class="form-control form-control-sm" value="{{ $data->bank_branch_code }}">
                        </div>
                    </div><div class="row mb-2">
                        <label class="col-3">{{__('companies.fields.bank_account_number')}}</label>
                        <div class="col-9">
                            <input type="text" name="bank_account_number" id="bank_account_number" class="form-control form-control-sm" value="{{ $data->bank_account_number }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer"><input type="submit" class="btn btn-primary btn-sm" value="{{ __('global.save') }}"></div>
    </div>

    </form>
    @endsection
