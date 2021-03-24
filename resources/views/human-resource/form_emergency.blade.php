<div class="form-group row">
    <label class="col-md-3">{{__('employee_emergency_contacts.fields.name')}}</label>
    <div class="col-md-9">
        <input type="text" name="emer[name]" id="emername" class="form-control form-control-sm">
    </div>
</div><div class="form-group row">
    <label class="col-md-3">{{__('employee_emergency_contacts.fields.email')}}</label>
    <div class="col-md-9">
        <input type="text" name="emer[email]" id="emeremail" class="form-control form-control-sm">
    </div>
</div><div class="form-group row">
    <label class="col-md-3">{{__('employee_emergency_contacts.fields.relationship')}}</label>
    <div class="col-md-9">
        <select name="emer[relationship]" id="emerrelationship" class="form-control form-control-sm">
            @foreach (__('employee_lookup.relationship') as $k=>$v)
            @if ($k>0)
                <option value="{{ $k }}">{{ $v }}</option>
            @endif
            @endforeach
        </select>
    </div>
</div><div class="form-group row">
    <label class="col-md-3">{{__('employee_emergency_contacts.fields.work_number')}}</label>
    <div class="col-md-9">
        <input type="text" name="emer[work_number]" id="emerwork_number" class="form-control form-control-sm">
    </div>
</div><div class="form-group row">
    <label class="col-md-3">{{__('employee_emergency_contacts.fields.home_number')}}</label>
    <div class="col-md-9">
        <input type="text" name="emer[home_number]" id="emerhome_number" class="form-control form-control-sm">
    </div>
</div><div class="form-group row">
    <label class="col-md-3">{{__('employee_emergency_contacts.fields.mobile_number')}}</label>
    <div class="col-md-9">
        <input type="text" name="emer[mobile_number]" id="emermobile_number" class="form-control form-control-sm">
    </div>
</div><div class="form-group row">
    <label class="col-md-3">{{__('employee_emergency_contacts.fields.address')}}</label>
    <div class="col-md-9">
        <textarea name="emer[address]" id="emeraddress" class="form-control form-control-sm"></textarea>
    </div>
</div>
