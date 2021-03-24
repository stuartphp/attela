@extends('layouts.admin')
@section('title', 'New Employee')
@section('content')
<form method="POST" action="/human-resource/new-employee/step1" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="company_id" id="company_id" value="{{ session()->get('company_id') }}">
    <div class="card">
        <div class="card-header">{{ __('global.add').' '.__('employees.title').' '.__('global.step').' 1' }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.certificate_number')}}</label>
                        <div class="col-md-8">
                            <input type="text" name="certificate_number" id="certificate_number" class="form-control form-control-sm">

                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.type_of_certificate')}}</label>
                        <div class="col-md-8">
                            <select name="type_of_certificate" id="type_of_certificate" class="form-control form-control-sm">
                                <option value="">{{ __('global.pleaseSelect') }}</option>
                                @foreach (__('employee_lookup.type_of_certificate') as $k=>$v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.nature_of_person')}}</label>
                        <div class="col-md-8">
                            <select type="text" name="nature_of_person" id="nature_of_person" class="form-control form-control-sm">
                                <option value="">{{ __('global.pleaseSelect') }}</option>
                                @foreach (__('employee_lookup.nature_of_person') as $k=>$v)
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.employee_code')}}</label>
                        <div class="col-md-8">
                            <input type="text" name="employee_code" id="employee_code" class="form-control form-control-sm" required>
                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.title')}}</label>
                        <div class="col-md-8">
                            <select name="title" id="title" class="form-control form-control-sm" required>
                                @foreach (__('employee_lookup.title') as $k=>$v)
                                    <option value="{{ $k }}">{{ $v }} ({{ $k }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.surname')}}</label>
                        <div class="col-md-8">
                            <input type="text" name="surname" id="surname" class="form-control form-control-sm" required>
                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.first_name')}}</label>
                        <div class="col-md-8">
                            <input type="text" name="first_name" id="first_name" class="form-control form-control-sm" required>
                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.second_name')}}</label>
                        <div class="col-md-8">
                            <input type="text" name="second_name" id="second_name" class="form-control form-control-sm">
                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.initials')}}</label>
                        <div class="col-md-8">
                            <input type="text" name="initials" id="initials" class="form-control form-control-sm" required>
                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.known_as')}}</label>
                        <div class="col-md-8">
                            <input type="text" name="known_as" id="known_as" class="form-control form-control-sm" required>
                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.gender')}}</label>
                        <div class="col-md-8">
                            <select name="gender" id="gender" class="form-control form-control-sm">
                                @foreach (__('global.gender') as $k=>$v)
                                <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.id_number')}}</label>
                        <div class="col-md-8">
                            <input type="text" name="id_number" id="id_number" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.passport_number')}}</label>
                        <div class="col-md-8">
                            <input type="text" name="passport_number" id="passport_number" class="form-control form-control-sm">
                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.passport_country')}}</label>
                        <div class="col-md-8">
                            <input type="text" name="passport_country" id="passport_country" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                <div class="col">
<div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.date_of_birth')}}</label>
                        <div class="col-md-8">
                            <input type="text" name="date_of_birth" id="date_of_birth" class="form-control date form-control-sm" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.tax_reference_number')}}</label>
                        <div class="col-md-8">
                            <input type="text" name="tax_reference_number" id="tax_reference_number" class="form-control form-control-sm">
                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.tax_type')}}</label>
                        <div class="col-md-8">
                            <select name="tax_type" id="tax_type" class="form-control form-control-sm" required>
                                <option value="">{{ __('global.pleaseSelect') }}</option>
                                @foreach (__('payroll_lookup.tax_type') as $k=>$v)
                                <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.directive_1')}}</label>
                        <div class="col-md-8">
                            <input type="text" name="directive_1" id="directive_1" class="form-control form-control-sm">
                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.directive_2')}}</label>
                        <div class="col-md-8">
                            <input type="text" name="directive_2" id="directive_2" class="form-control form-control-sm">
                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.directive_3')}}</label>
                        <div class="col-md-8">
                            <input type="text" name="directive_3" id="directive_3" class="form-control form-control-sm">
                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.reason_no_uif')}}</label>
                        <div class="col-md-8">
                            <select name="reason_no_uif" id="reason_no_uif" class="form-control form-control-sm">
                                <option value="">{{ __('global.pleaseSelect') }}</option>
                                @foreach (__('payroll_lookup.reason_no_uif') as $k=>$v)
                                <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.retired')}}</label>
                        <div class="col-md-8">
                            <select name="retired" id="retired" class="form-control form-control-sm">
                                @foreach (__('global.yesno') as $k=>$v)
                                <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.registered_medical_aid')}}</label>
                        <div class="col-md-8">
                            <select name="registered_medical_aid" id="registered_medical_aid" class="form-control form-control-sm">
                                @foreach (__('global.yesno') as $k=>$v)
                                <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.medical_aid_members')}}</label>
                        <div class="col-md-8">
                            <input type="text" name="medical_aid_members" id="medical_aid_members" class="form-control form-control-sm">
                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.employed_from')}}</label>
                        <div class="col-md-8">
                            <input type="text" name="employed_from" id="employed_from" class="form-control date form-control-sm" required>
                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.employed_to')}}</label>
                        <div class="col-md-8">
                            <input type="text" name="employed_to" id="employed_to" class="form-control date form-control-sm">
                        </div>
                    </div><div class="form-group row">
                        <label class="col-md-4">{{__('employees.fields.is_active')}}</label>
                        <div class="col-md-8">
                            <select name="is_active" id="is_active" class="form-control form-control-sm">
                                @foreach (__('global.yesno') as $k=>$v)
                                <option value="{{ $k }}">{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
        </div> </div>
        <div class="card-footer">
            <div class="text-right">
                <input type="submit" class="btn btn-primary btn-sm" value="{{ __('global.save') }}">
            </div>

        </div>


        </div>

    </form>
@endsection
