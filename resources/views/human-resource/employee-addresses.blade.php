@extends('layouts.admin')
@section('title', __('global.menu.employees.title'))
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">{{ __('global.menu.employees.title') }} / <a href="/human-resource/employee-addresses">{{ __('employee_addresses.title') }}</a></div>
            <div class="col-md-6 text-right">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'employee_addresses_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('human-resource/employee-addresses') }}" method="get">
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
               <th>{{__('employee_addresses.fields.employee_id')}}</th>
               <th>{{__('employee_addresses.fields.physical_address')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
          <tbody>
              @if(count($data)>0)
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->employee->surname.' '.$item->employee->initials.' ('.$item->employee->first_name.')'}}</td>
                    <td>{{ $item->physical_address_unit_number.','.$item->physical_address_complex_name.','.$item->physical_address_street_number.','.$item->physical_address_street_name.','.$item->physical_address_suburb.','.$item->physical_address_city.','.$item->physical_address_code.','.$item->physical_address_country}}</td>
                    <td class="col-1"><select class="dropdown-action form-control form-control-sm" id="{{ $item->id }}">
                        <option value="">{{ __('global.select') }}</option>
                        <option value="Edit">{{ __('global.edit') }}</option>
                        <option value="Delete">{{ __('global.delete') }}</option>
                        </select></td>
                </tr>
                @endforeach
              @else

              @endif
          </tbody>
        </table>
    </div>
  </div>
<!-- /.box-footer-->
<div class="card-footer">{{ $data->render() }}</div>
</div>
<form method="post" id="main_form" enctype="multipart/form-data">
@csrf
<input type="hidden" id="action"/>
<input type="hidden" name="_method" id="method">
<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Record</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group row" id="employee">
                <label class="col-md-3">{{__('employee_addresses.fields.employee_id')}}</label>
                <div class="col-md-9">
                    <select name="employee_id" id="employee_id" class="form-control form-control-sm employee_select"></select>
                </div>
            </div>
            <fieldset class="scheduler-border">
            <div class="row">
                <div class="col"><legend class="scheduler-border">{{ __('employee_addresses.fields.physical_address') }}</legend>
                <div class="form-group row">
                <label class="col-md-3">{{__('employee_addresses.fields.physical_address_unit_number')}}</label>
                <div class="col-md-9">
                    <input type="text" name="physical_address_unit_number" id="physical_address_unit_number" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_addresses.fields.physical_address_complex_name')}}</label>
                <div class="col-md-9">
                    <input type="text" name="physical_address_complex_name" id="physical_address_complex_name" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_addresses.fields.physical_address_street_number')}}</label>
                <div class="col-md-9">
                    <input type="text" name="physical_address_street_number" id="physical_address_street_number" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_addresses.fields.physical_address_street_name')}}</label>
                <div class="col-md-9">
                    <input type="text" name="physical_address_street_name" id="physical_address_street_name" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_addresses.fields.physical_address_suburb')}}</label>
                <div class="col-md-9">
                    <input type="text" name="physical_address_suburb" id="physical_address_suburb" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_addresses.fields.physical_address_city')}}</label>
                <div class="col-md-9">
                    <input type="text" name="physical_address_city" id="physical_address_city" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_addresses.fields.physical_address_code')}}</label>
                <div class="col-md-9">
                    <input type="text" name="physical_address_code" id="physical_address_code" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_addresses.fields.physical_address_country')}}</label>
                <div class="col-md-9">
                    <select name="physical_address_country" id="physical_address_country" class="form-control form-control-sm">
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
                    <input type="text" name="postal_street_box_number" id="postal_street_box_number" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_addresses.fields.postal_street_post_office_name')}}</label>
                <div class="col-md-9">
                    <input type="text" name="postal_street_post_office_name" id="postal_street_post_office_name" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_addresses.fields.postal_suburb')}}</label>
                <div class="col-md-9">
                    <input type="text" name="postal_suburb" id="postal_suburb" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_addresses.fields.postal_city')}}</label>
                <div class="col-md-9">
                    <input type="text" name="postal_city" id="postal_city" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_addresses.fields.postal_code')}}</label>
                <div class="col-md-9">
                    <input type="text" name="postal_code" id="postal_code" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_addresses.fields.postal_country')}}</label>
                <div class="col-md-9">
                    <select name="postal_country" id="postal_country" class="form-control form-control-sm">
                        @foreach (App\Models\Country::orderBy('country')->pluck('country', 'iso_code_3')->toArray() as $k=>$v)
                <option value="{{ $k }}">{{ $v }}</option>
            @endforeach</select>
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_addresses.fields.postal_care_of')}}</label>
                <div class="col-md-9">
                    <input type="text" name="postal_care_of" id="postal_care_of" class="form-control form-control-sm">
                </div>
            </div><div class="form-group row">
                <label class="col-md-3">{{__('employee_addresses.fields.postal_care_of_details')}}</label>
                <div class="col-md-9">
                    <input type="text" name="postal_care_of_details" id="postal_care_of_details" class="form-control form-control-sm">
                </div>
            </div></div>
            </div>



            </fieldset>
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
    $('#employee').show();
    document.getElementById("employee_id").disabled = false;
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
                url:'/human-resource/employee-addresses/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    let t = response.data.employee.title+' '+response.data.employee.surname+' '+response.data.employee.initials;
                    $('#employee').hide();
                    document.getElementById("employee_id").disabled = true;
                    $('.modal-title').html(update+' : '+t);
                    $('#action').val('Update');
                    $('#main_form').attr('action', '/human-resource/employee-addresses/'+id);
                    $('#method').val('PUT');
                    $('#id').val(response.data.id);
					$('#physical_address_unit_number').val(response.data.physical_address_unit_number);
					$('#physical_address_complex_name').val(response.data.physical_address_complex_name);
					$('#physical_address_street_number').val(response.data.physical_address_street_number);
					$('#physical_address_street_name').val(response.data.physical_address_street_name);
					$('#physical_address_suburb').val(response.data.physical_address_suburb);
					$('#physical_address_city').val(response.data.physical_address_city);
					$('#physical_address_code').val(response.data.physical_address_code);
					$('#physical_address_country').val(response.data.physical_address_country);
					$('#postal_street_box_number').val(response.data.postal_street_box_number);
					$('#postal_street_post_office_name').val(response.data.postal_street_post_office_name);
					$('#postal_suburb').val(response.data.postal_suburb);
					$('#postal_city').val(response.data.postal_city);
					$('#postal_code').val(response.data.postal_code);
					$('#postal_country').val(response.data.postal_country);
					$('#postal_care_of').val(response.data.postal_care_of);
					$('#postal_care_of_details').val(response.data.postal_care_of_details);

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
                confirmButtonText: '{{ __("global.yes")}}'
            }).then((result) => {
                if (result.value) {
                    $('#main_form').attr('action', '/human-resource/employee-addresses/'+id);
                    $('#method').val('DELETE');
                }
            });
            break;

    }
    $('#'+id).val('');
});
$('.employee_select').select2({
    dropdownParent: '#formModal',
    ajax: {
        url: '/search/employees',
        method: 'POST',
        data: function (params) {
            var query = {
                search: params.term,
            };
            // Query parameters will be ?search=[term]&type=public
            return query;
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
    }
});
</script>
@endsection
