<form id="form_detail" class="ms-2 me-2" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="_method" id="method">
<div class="form-heading mt-2">Personal Detail <span style="float: right">&nbsp;<button type="button" class="btn btn-outline-info btn-sm">Generate Payslip</button>
    {{-- &nbsp;<button class="btn btn-outline-success btn-sm">View Tax Calculation</button> --}}
    &nbsp;<button type="button" class="btn btn-outline-danger btn-sm">End Employee</button></span></div>
<div class="row mt-1">
    <div class="col-md-1 text-center">
        @if (isset($data->image) && $data->image>'')       
            <img src="/companies/{{ session()->get('company_id') }}/employees/{{ $data->image }}" height="80px" id="empl_img" class="payslip-image pb-2"/>
        @else
        <img src="/images/no-profile-pic.png" height="80px" id="empl_img" class="payslip-image pb-2"/>
        @endif
        
        @if(date('m-d') == substr($data->date_of_birth, 5,5) )<img src='/images/birthday.gif' height="80px"> @endif
        <div><button type="button" class="btn btn-outline-success btn-block btn-sm" data-bs-toggle="modal" data-bs-target="#empImgUpload"><i class="bi bi-arrow-repeat"></i> Image</button></div>
        <div><div class="mt-4">&nbsp;</div>@php            
           echo '<h1>'.date_diff(date_create($data->date_of_birth), date_create('now'))->y.'</h1>';
        @endphp</div>
    </div>
    <div class="col-md-11">
        <div class="row mb-2">
            <label class="col-md-2">{{__('employees.fields.nature_of_person')}}</label>
            <div class="col-md-4">
                <select type="text" name="nature_of_person" id="nature_of_person" class="form-select">
                    <option value="">{{ __('global.pleaseSelect') }}</option>
                    @foreach (__('employee_lookup.nature_of_person') as $k=>$v)
                        <option value="{{ $k }}" @if($data->nature_of_person==$k) selected @endif>{{ $v }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ __('global.pleaseSelect') }}</div>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-md-2">{{__('employees.fields.id_number')}}</label>
            <div class="col-md-4">
                <input type="text" name="id_number" id="id_number" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d]/,'')" required value="{{ $data->id_number ?? '' }}">
                <div class="invalid-feedback">{{ __('employees.help.id_number') }}</div>
            </div>
            <label class="col-md-2">{{__('employees.fields.date_of_birth')}}</label>
            <div class="col-md-4">
                <input type="text" name="date_of_birth" id="date_of_birth" class="form-control date form-control-sm" required value="{{ $data->date_of_birth ?? '' }}">
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-md-2">{{__('employees.fields.employee_code')}}</label>
            <div class="col-md-4">
                <input type="text" name="employee_code" id="employee_code" class="form-control form-control-sm" required value="{{ $data->employee_code ?? '' }}">
                <div class="invalid-feedback"></div>
            </div>
            <label class="col-md-2">{{__('employees.fields.gender')}}</label>
            <div class="col-md-4">
                <select name="gender" id="gender" class="form-select">
                    @foreach (__('global.gender') as $k=>$v)
                    <option value="{{ $k }}" @if($data->gender==$k) selected @endif>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-md-2">{{__('employees.fields.title')}}</label>
            <div class="col-md-4">
                <select name="title" id="title" class="form-select" required>
                    @foreach (__('employee_lookup.title') as $k=>$v)
                        <option value="{{ $k }}" @if($data->title==$k) selected @endif>{{ $v }} ({{ $k }})</option>
                    @endforeach
                </select>
            </div>

            <label class="col-md-2">{{__('employees.fields.initials')}}</label>
            <div class="col-md-4">
                <input type="text" name="initials" id="initials" class="form-control form-control-sm" required value="{{ $data->initials ?? '' }}">
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-md-2">{{__('employees.fields.first_name')}}</label>
            <div class="col-md-4">
                <input type="text" name="first_name" id="first_name" class="form-control form-control-sm" required value="{{ $data->first_name ?? '' }}">
            </div>
            <label class="col-md-2">{{__('employees.fields.second_name')}}</label>
            <div class="col-md-4">
                <input type="text" name="second_name" id="second_name" class="form-control form-control-sm" value="{{ $data->second_name ?? '' }}">
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-md-2">{{__('employees.fields.surname')}}</label>
            <div class="col-md-4">
                <input type="text" name="surname" id="surname" class="form-control form-control-sm" required value="{{ $data->surname ?? '' }}">
            </div>
            <label class="col-md-2">{{__('employees.fields.known_as')}}</label>
            <div class="col-md-4">
                <input type="text" name="known_as" id="known_as" class="form-control form-control-sm" required value="{{ $data->known_as ?? '' }}">
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-md-2">{{__('employees.fields.is_refugee')}}</label>
            <div class="col-md-4">
                <div class="inline">
                    <div class="form-check">
                        <input type="checkbox" name="is_refugee" id="is_refugee" class="form-check-input" @if(isset($data->is_refugee) && $data->is_refugee==1) checked @endif>
                    </div>
                </div>
            </div>
            <label class="col-md-2">{{__('employees.fields.is_active')}}</label>
            <div class="col-md-4">
                <div class="inline">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input"  @if(isset($data->is_active) && $data->is_active==1) checked @endif>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-md-2">{{__('employees.fields.is_asylum_seeker')}}</label>
            <div class="col-md-4">
                <div class="inline">
                    <div class="form-check">
                        <input type="checkbox" name="is_asylum_seeker" id="is_asylum_seeker" class="form-check-input" onclick="$('.asylum').toggle()" @if(isset($data->is_asylum_seeker) && $data->is_asylum_seeker==1) checked @endif>
                    </div>
                </div>
            </div>
            <label class="col-md-2 asylum" @if($data->is_asylum_seeker !=1)style="display: none"@endif>{{__('employees.fields.asylum_permint')}}</label>
            <div class="col-md-4 asylum" @if($data->is_asylum_seeker !=1)style="display: none"@endif>
                <input type="text" name="asylum_permint" id="asylum_permint" class="form-control form-control-sm">
            </div>
        </div>
        
    </div>
</div>
<div class="row mt-1">
    <div class="col-md-6">
        <div class="form-heading">Physical/Residential Address</div>
        <div class="row mb-2">
            <label class="col-md-4">{{__('employee_addresses.fields.physical_address_unit_number')}}</label>
            <div class="col-md-4">
                <input type="text" name="physical_address_unit_number" id="physical_address_unit_number" class="form-control form-control-sm" value="{{ $data->physical_address_unit_number ?? '' }}">
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-md-4">{{__('employee_addresses.fields.physical_address_complex_name')}}</label>
            <div class="col-md-8">
                <input type="text" name="physical_address_complex_name" id="physical_address_complex_name" class="form-control form-control-sm" value="{{ $data->physical_address_complex_name ?? '' }}">
            </div>
        </div><div class="row mb-2">
            <label class="col-md-4">{{__('employee_addresses.fields.physical_address_street_number')}}</label>
            <div class="col-md-4">
                <input type="text" name="physical_address_street_number" id="physical_address_street_number" class="form-control form-control-sm" value="{{ $data->physical_address_street_number ?? '' }}">
            </div>
        </div><div class="row mb-2">
            <label class="col-md-4">{{__('employee_addresses.fields.physical_address_street_name')}}</label>
            <div class="col-md-8">
                <input type="text" name="physical_address_street_name" id="physical_address_street_name" class="form-control form-control-sm" value="{{ $data->physical_address_street_name ?? '' }}">
            </div>
        </div><div class="row mb-2">
            <label class="col-md-4">{{__('employee_addresses.fields.physical_address_suburb')}}</label>
            <div class="col-md-8">
                <input type="text" name="physical_address_suburb" id="physical_address_suburb" class="form-control form-control-sm" value="{{ $data->physical_address_suburb ?? '' }}">
            </div>
        </div><div class="row mb-2">
            <label class="col-md-4">{{__('employee_addresses.fields.physical_address_city')}}</label>
            <div class="col-md-8">
                <input type="text" name="physical_address_city" id="physical_address_city" class="form-control form-control-sm" value="{{ $data->physical_address_city ?? '' }}">
            </div>
        </div><div class="row mb-2">
            <label class="col-md-4">{{__('employee_addresses.fields.physical_address_code')}}</label>
            <div class="col-md-4">
                <input type="text" name="physical_address_code" id="physical_address_code" class="form-control form-control-sm" value="{{ $data->physical_address_code ?? '' }}">
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-md-4">{{__('employee_addresses.fields.physical_address_country')}}</label>
            <div class="col-md-8">
                <select name="physical_address_country" id="physical_address_country" class="form-select">
                    @foreach ($countries as $k=>$v)
            <option value="{{ $k }}" @if($data->physical_address_country==$k) selected @endif>{{ $v }}</option>
        @endforeach
                </select>
            </div>
        </div></div>

    <div class="col-md-6">
        <div class="form-heading">Postal Address</div>
        <div class="row mb-2">
        <label class="col-md-3">{{__('employee_addresses.fields.postal_street_box_number')}}</label>
        <div class="col-md-9">
            <input type="text" name="postal_street_box_number" id="postal_street_box_number" class="form-control form-control-sm">
        </div>
    </div><div class="row mb-2">
        <label class="col-md-3">{{__('employee_addresses.fields.postal_street_post_office_name')}}</label>
        <div class="col-md-9">
            <input type="text" name="postal_street_post_office_name" id="postal_street_post_office_name" class="form-control form-control-sm">
        </div>
    </div><div class="row mb-2">
        <label class="col-md-3">{{__('employee_addresses.fields.postal_suburb')}}</label>
        <div class="col-md-9">
            <input type="text" name="postal_suburb" id="postal_suburb" class="form-control form-control-sm">
        </div>
    </div><div class="row mb-2">
        <label class="col-md-3">{{__('employee_addresses.fields.postal_city')}}</label>
        <div class="col-md-9">
            <input type="text" name="postal_city" id="postal_city" class="form-control form-control-sm">
        </div>
    </div><div class="row mb-2">
        <label class="col-md-3">{{__('employee_addresses.fields.postal_code')}}</label>
        <div class="col-md-9">
            <input type="text" name="postal_code" id="postal_code" class="form-control form-control-sm">
        </div>
    </div><div class="row mb-2">
        <label class="col-md-3">{{__('employee_addresses.fields.postal_country')}}</label>
        <div class="col-md-9">
            <select name="postal_country" id="postal_country" class="form-control form-control-sm">
                @foreach ($countries as $k=>$v)
        <option value="{{ $k }}" @if($data->postal_country==$k) selected @endif>{{ $v }}</option>
    @endforeach</select>
        </div>
    </div>
    <div class="row mb-2">
        <label class="col-md-3">{{__('employee_addresses.fields.postal_care_of')}}</label>
        <div class="col-md-9">
            <input type="text" name="postal_care_of" id="postal_care_of" class="form-control form-control-sm">
        </div>
    </div><div class="row mb-2">
        <label class="col-md-3">{{__('employee_addresses.fields.postal_care_of_details')}}</label>
        <div class="col-md-9">
            <input type="text" name="postal_care_of_details" id="postal_care_of_details" class="form-control form-control-sm">
        </div>
    </div>
</div>

</div>
<div class="row mt-1">
    <div class="col-md-6">
        <div class="form-heading">Contact Details</div>
        <div class="row mb-2">
            <label class="col-md-4">{{__('employees.fields.contact_mobile_number')}}</label>
            <div class="col-md-4">
                <input type="text" name="contact_mobile_number" id="contact_mobile_number" class="form-control form-control-sm" value="{{ $data->contact_mobile_number ?? '' }}">
            </div>
        </div><div class="row mb-2">
            <label class="col-md-4">{{__('employees.fields.contact_email')}}</label>
            <div class="col-md-4">
                <input type="email" name="contact_email" id="contact_email" class="form-control form-control-sm" value="{{ $data->contact_email ?? '' }}">
            </div>
        </div><div class="row mb-2">
            <label class="col-md-4">{{__('employees.fields.contact_home_number')}}</label>
            <div class="col-md-4">
                <input type="text" name="contact_home_number" id="contact_home_number" class="form-control form-control-sm" value="{{ $data->contact_home_number ?? '' }}">
            </div>
        </div><div class="row mb-2">
            <label class="col-md-4">{{__('employees.fields.contact_work_number')}}</label>
            <div class="col-md-4">
                <input type="text" name="contact_work_number" id="contact_work_number" class="form-control form-control-sm" value="{{ $data->contact_work_number ?? '' }}">
            </div>
        </div><div class="row mb-2">
            <label class="col-md-4">{{__('employees.fields.contact_fax_number')}}</label>
            <div class="col-md-4">
                <input type="text" name="contact_fax_number" id="contact_fax_number" class="form-control form-control-sm" value="{{ $data->contact_fax_number ?? '' }}">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-heading">Emergency Contacts</div>
        <div class="row mb-2">
            <label class="col-md-4">{{__('employees.fields.emergency_name')}}</label>
            <div class="col-md-4">
                <input type="text" name="emergency_name" id="emergency_name" class="form-control form-control-sm" value="{{ $data->emergency_name ?? '' }}">
            </div>
        </div><div class="row mb-2">
            <label class="col-md-4">{{__('employees.fields.emergency_number1')}}</label>
            <div class="col-md-4">
                <input type="text" name="emergency_number1" id="emergency_number1" class="form-control form-control-sm" value="{{ $data->emergency_number1 ?? '' }}">
            </div>
        </div><div class="row mb-2">
            <label class="col-md-4">{{__('employees.fields.emergency_number2')}}</label>
            <div class="col-md-4">
                <input type="text" name="emergency_number2" id="emergency_number2" class="form-control form-control-sm" value="{{ $data->emergency_number2 ?? '' }}">
            </div>
        </div>
    </div>
    <div class="modal-footer col-md-12">
        <button type="submit" class="btn btn-outline-primary btn-sm" id="submit_detail">{{ __('global.save') }}</button>
    </div>
</div>
    </form>
    <form method="post" id="form_employee_image" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $data->id }}"/>
    <div class="modal" id="empImgUpload" tabindex="-1" aria-labelledby="empImgUploadLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ __('global.upload_image') }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input type="file"  name="file_name" id="file_name" class="form-control form-control-sm"  aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-primary btn-sm disabled" type="button">
                            {{ __('global.size') }} Max:1MB
                            </button>
                    </div>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-outline-primary btn-sm">{{ __('global.upload') }}</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <script type="text/javascript" src="/js/validate_rsa_id.js"></script>    
<script>
@if(isset($data->is_asylum_seeker) && $data->is_asylum_seeker==1)
$('.asylum').toggle()
@endif
$('#id_number').on('change', function(){
    ValidateID($('#id_number').val())
})
$('#is_asylum_seeker').on('click', function(){
    $('#is_refugee').prop('checked', false);
})
$('#is_refugee').on('click', function(){
    $('#is_asylum_seeker').prop('checked', false);
    $('.asylum').hide();
    ValidateID($('#id_number').val())
})

$('#physical_address_country').select2();
$('#postal_country').select2();

$('#form_employee_image').on('submit', function(e){
    e.preventDefault();
    if($('#file_name').val()==='')
    {
        return false;
    }

    $.ajax({
        url: "/human-resource/employee/image",
        method:'POST',
        data: new FormData(this),
        processData:false,
        contentType: false,
        cache: false,
        dataType: 'JSON',
        success: function(response)
        {
            if(response.success){
            $('#empl_img').attr('src', "/companies/{{ session()->get('company_id') }}/employees/"+response.success);
            notice('success', '{{__('global.record_updated')}}');
        }else{
            let err='<ul class="text-start">';
            for(let i=0; i<response.length; i++)
            {
                err += "<li>"+response[i]+"</li>";
            }
            err +="</ul>";
            notice('error', '{{__('global.error_update')}}', err);
        }
        }
    });
    $('#empImgUpload').modal('hide')
});

$('#form_detail').on('submit', function (event) {
    event.preventDefault();
    $('#method').val('PUT');
    let id = $('#employee_id').val();
    // Do Validation
    if(ValidateID($('#id_number').val())===false){
        $('#id_number').addClass('is-invalid');
        return false;
    }else{
        $('#id_number').addClass('is-valid');
    }

    $.ajax({
        url: "/employees/employees/"+id,
        method:'POST',
        data: new FormData(this),
        processData:false,
        contentType: false,
        cache: false,
        dataType: 'JSON',
        success: function(response)
        {
            if(response.success){
                $('#E'+id).removeClass('list-group-item-danger');
                $('#E'+id).removeClass('list-group-item-success');
                $('#E'+id).html($('#employee_code').val()+' '+$('#surname').val()+' '+$('#initials').val());                     
                if(parseFloat(response.success.is_active)===1){                            
                    $('#E'+id).addClass('list-group-item-success');
                }else{
                    $('#E'+id).addClass('list-group-item-danger');
                }        
                notice('success', '{{__('global.record_updated')}}');
            }else{
                let err='<ul class="text-start">';
                for(let i=0; i<response.errors.length; i++)
                {
                    err += "<li>"+response.errors[i]+"</li>";
                }
                err +="</ul>";
                notice('error', '{{__('global.error_update')}}', err);
            }
        }
    });
});
</script>
