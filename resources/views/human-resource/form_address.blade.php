
<fieldset class="scheduler-border">
<div class="row">
    <div class="col"><legend class="scheduler-border">{{ __('employee_addresses.fields.physical_address') }}</legend>
    <div class="form-group row">
    <label class="col-md-3">{{__('employee_addresses.fields.physical_address_unit_number')}}</label>
    <div class="col-md-9">
        <input type="text" name="addr[physical_address_unit_number]" id="physical_address_unit_number" class="form-control form-control-sm">
    </div>
</div><div class="form-group row">
    <label class="col-md-3">{{__('employee_addresses.fields.physical_address_complex_name')}}</label>
    <div class="col-md-9">
        <input type="text" name="addr[physical_address_complex_name]" id="physical_address_complex_name" class="form-control form-control-sm">
    </div>
</div><div class="form-group row">
    <label class="col-md-3">{{__('employee_addresses.fields.physical_address_street_number')}}</label>
    <div class="col-md-9">
        <input type="text" name="addr[physical_address_street_number]" id="physical_address_street_number" class="form-control form-control-sm">
    </div>
</div><div class="form-group row">
    <label class="col-md-3">{{__('employee_addresses.fields.physical_address_street_name')}}</label>
    <div class="col-md-9">
        <input type="text" name="addr[physical_address_street_name]" id="physical_address_street_name" class="form-control form-control-sm">
    </div>
</div><div class="form-group row">
    <label class="col-md-3">{{__('employee_addresses.fields.physical_address_suburb')}}</label>
    <div class="col-md-9">
        <input type="text" name="addr[physical_address_suburb]" id="physical_address_suburb" class="form-control form-control-sm">
    </div>
</div><div class="form-group row">
    <label class="col-md-3">{{__('employee_addresses.fields.physical_address_city')}}</label>
    <div class="col-md-9">
        <input type="text" name="addr[physical_address_city]" id="physical_address_city" class="form-control form-control-sm">
    </div>
</div><div class="form-group row">
    <label class="col-md-3">{{__('employee_addresses.fields.physical_address_code')}}</label>
    <div class="col-md-9">
        <input type="text" name="addr[physical_address_code]" id="physical_address_code" class="form-control form-control-sm">
    </div>
</div><div class="form-group row">
    <label class="col-md-3">{{__('employee_addresses.fields.physical_address_country')}}</label>
    <div class="col-md-9">
        <select name="addr[physical_address_country]" id="physical_address_country" class="form-control form-control-sm">
            @foreach (App\Models\Country::orderBy('country')->pluck('country', 'iso_code_3')->toArray() as $k=>$v)
                <option value="{{ $k }}">{{ $v }}</option>
            @endforeach
        </select>
    </div>
</div></div>
    <div class="col"><legend class="scheduler-border">{{ __('employee_addresses.fields.postal_address') }}</legend>
    <div class="form-group row">
    <label class="col-md-3">{{__('employee_addresses.fields.postal_street_box_number')}}</label>
    <div class="col-md-9">
        <input type="text" name="addr[postal_street_box_number]" id="postal_street_box_number" class="form-control form-control-sm">
    </div>
</div><div class="form-group row">
    <label class="col-md-3">{{__('employee_addresses.fields.postal_street_post_office_name')}}</label>
    <div class="col-md-9">
        <input type="text" name="addr[postal_street_post_office_name]" id="postal_street_post_office_name" class="form-control form-control-sm">
    </div>
</div><div class="form-group row">
    <label class="col-md-3">{{__('employee_addresses.fields.postal_suburb')}}</label>
    <div class="col-md-9">
        <input type="text" name="addr[postal_suburb]" id="postal_suburb" class="form-control form-control-sm">
    </div>
</div><div class="form-group row">
    <label class="col-md-3">{{__('employee_addresses.fields.postal_city')}}</label>
    <div class="col-md-9">
        <input type="text" name="addr[postal_city]" id="postal_city" class="form-control form-control-sm">
    </div>
</div><div class="form-group row">
    <label class="col-md-3">{{__('employee_addresses.fields.postal_code')}}</label>
    <div class="col-md-9">
        <input type="text" name="addr[postal_code]" id="postal_code" class="form-control form-control-sm">
    </div>
</div><div class="form-group row">
    <label class="col-md-3">{{__('employee_addresses.fields.postal_country')}}</label>
    <div class="col-md-9">
        <select name="addr[postal_country]" id="postal_country" class="form-control form-control-sm">
            @foreach (App\Models\Country::orderBy('country')->pluck('country', 'iso_code_3')->toArray() as $k=>$v)
                <option value="{{ $k }}">{{ $v }}</option>
            @endforeach
        </select>
    </div>
</div><div class="form-group row">
    <label class="col-md-3">{{__('employee_addresses.fields.postal_care_of')}}</label>
    <div class="col-md-9">
        <input type="text" name="addr[postal_care_of]" id="postal_care_of" class="form-control form-control-sm">
    </div>
</div><div class="form-group row">
    <label class="col-md-3">{{__('employee_addresses.fields.postal_care_of_details')}}</label>
    <div class="col-md-9">
        <input type="text" name="addr[postal_care_of_details]" id="postal_care_of_details" class="form-control form-control-sm">
    </div>
</div></div>
</div>


</fieldset>
