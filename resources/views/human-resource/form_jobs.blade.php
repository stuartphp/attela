<div class="form-heading mt-2 ms-2 me-2">Positions
    <span style="float: right">
        <a href="#" onclick="$('#form_jobs').toggle()"><i class="bi bi-plus" id="add_close"></i></a>
    </span>
</div>
<form method="post" class="ms-2 me-2" id="form_jobs" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="_method" id="method" value="PUT">
    <div class="card">
        <div class="card-header">Add New Record</div>
        <div class="card-body">
            <div class="row mb-2">
                <label class="col-2">{{__('employee_jobs.fields.effective_date')}}</label>
                <div class="col-1">
                    <input type="text" name="effective_date" id="effective_date" class="form-control date form-control-sm" required>
                    <div class="invalid-feedback">{{ __('global.pleaseSelect') }}</div>
                </div>
                <label class="col-2">{{__('employee_jobs.fields.end_date')}}</label>
                <div class="col-1">
                    <input type="text" name="end_date" id="end_date" class="form-control date form-control-sm">
                    <div class="invalid-feedback">{{ __('global.pleaseSelect') }}</div>
                </div>
                <label class="col-2">{{__('employee_jobs.fields.job_title')}}</label>
                <div class="col-4">
                    <input type="text" name="job_title" id="job_title" class="form-control form-control-sm" required>
                    <div class="invalid-feedback">{{ __('global.pleaseSelect') }}</div>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-2">{{__('employee_jobs.fields.store_id')}}</label>
                <div class="col-4">
                    <select name="store_id" id="store_id" class="form-select">
                        @foreach (App\Models\Store::pluck('name', 'id')->toArray() as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <label class="col-2">{{__('employee_jobs.fields.job_position')}}</label>
                <div class="col-4">
                    <select name="job_position" id="job_position" class="form-select">
                        {!! $position_select !!}
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-2">{{__('employee_jobs.fields.reports_to')}}</label>
                <div class="col-4">@if(isset($positions[0]->reports_to) )
                    <span>{{ $positions[0]->report->surname.' '.$positions[0]->report->initials.' ('.$positions[0]->report->first_name.')' }}
                        <a href="#" onclick="$('#reports_to').prop('disabled', ! $('#reports_to').prop('disabled') )"><i class="bi bi-arrow-clockwise fa-1x"></i></a>
                    </span>
                    @endif
                    {{-- @livewire('employee-search', ['field'=>'reports_to'])--}}
                    <select name="reports_to" id="reports_to" class="form-control form-control-sm reports_to_select" @if(isset($positions[0]->reports_to) )disabled @endif></select>
                </div>
                <label class="col-2">{{__('employee_jobs.fields.change_reason')}}</label>
                <div class="col-4">
                    <input type="text" name="change_reason" id="change_reason" class="form-control form-control-sm" value="{{ $data->change_reason ?? '' }}">
                </div>
            </div>
        </div>
        <div class="card-footer text-end"><button type="submit" class="btn btn-outline-primary btn-sm" >{{ __('global.save') }}</button></div>
    </div>


</form>
<div class="table-responsive">
    <table class="table table-hover" id="jobsTable" width="100%">
    <thead>
        <tr>
            <th>{{ __('employee_jobs.fields.effective_date') }}</th>
            <th>{{ __('employee_jobs.fields.store_id') }}</th>
            <th>{{ __('employee_jobs.fields.job_title') }}</th>
            <th>{{ __('employee_jobs.fields.job_position') }}</th>
            <th>{{ __('employee_jobs.fields.change_reason') }}</th>
            <th>{{ __('employee_jobs.fields.reports_to') }}</th>
            <th>{{ __('employee_jobs.fields.end_date') }}</th>
            <th class="col-1">{{ __('global.action') }}</th>
        </tr>
    </thead>
</table>
</div>
<script>

$('#add_close').on('click', function(){
    if($('#add_close').hasClass('bi-plus')){
        $('#add_close').removeClass('bi bi-plus').addClass('bi bi-x');
    }else{
        $('#add_close').removeClass('bi bi-x').addClass('bi bi-plus');
    }
    $('#jobsTable_wrapper').toggle();
});

$(document).ready(function(){
    $('#form_jobs').hide();
    $('#jobsTable').DataTable({
        processing: true,
        serverSide: true,
        retrieve: true,
        aaSorting: [],
        ajax:{
            url: "/human-resource/employee-jobs/{{ $data->id }}"
        },
        columns: [
            {data:'effective_date', name:'effective_date'},
            {data:'store_id', name:'store_id'},
            {data:'job_title', name:'job_title'},
            {data:'job_position', name:'job_position'},
            {data:'change_reason', name:'change_reason'},
            {data:'reports_to', name:'reports_to'},
            {data:'end_date', name:'end_date'},
            {
            "render": function(d,t,r){
                if(r.end_date == null )
                {
                    let $select = $("<select></select>", {
                        'class':"form-select",
                        'onchange':'jobAction('+r.id+')',
                        'id':r.id,
                    });
                    let $option='';

                    $option = $('<option></option>', {
                        "text":'--Select--',
                        "value":''
                    });
                    $select.append($option);

                    $option = $('<option></option>', {
                        "text":'{{trans('global.edit')}}',
                        "value":'Edit'
                    });
                    $select.append($option);
                    return $select.prop("outerHTML");
                }else{
                    return "{{ __('global.closed') }}";
                }

            }},
        ],
        pageLength: 15,
        lengthMenu: [[10, 15, 25, 50, -1], [10, 15, 25, 50, "All"]],
    });
});

$('.reports_to_select').select2({
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
function updReportsTo(val){
    $.ajax({
        url: "/search/employees/"+val,
        method:'POST',
        cache: true,
        dataType: 'JSON',
        success: function(items)
        {
            $.each(items, function (i, item) {
                $('#reports_to').append($('<option>', {
                    value: item.id,
                    text : item.text
                }));
            });
        }
    });
}
$('#form_jobs').on('submit', function (event) {
    event.preventDefault();
    $('#method').val('PUT');
    let id = $('#employee_id').val();
    // Do Validation
    if($('#effective_date').val()===''){
        $('#effective_date').addClass('is-invalid');
        return false;
    }
    if($('#job_title').val()===''){
        $('#job_title').addClass('is-invalid');
        return false;
    }

    $.ajax({
        url: "/human-resource/employee-jobs/"+id,
        method:'POST',
        data: new FormData(this),
        processData:false,
        contentType: false,
        cache: false,
        dataType: 'JSON',
        success: function(response)
        {
            if(response.success){
                $('#form_jobs').toggle();
                $('.card-header').html(add);

                notice('success', '{{__('global.record_updated')}}');
                $('#jobsTable').DataTable().ajax.reload(null, false);
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
});

function jobAction(id)
{
    $('.card-header').html(update);
    $('#add_close').trigger('click');
    $('#form_jobs').toggle();
    $.ajax({
        url:'/human-resource/employee-jobs/'+id+'/edit',
        dataType:'JSON',
        method: 'GET',
        success: function (response) {
            $('#form_jobs').attr('action', '/human-resource/employee-jobs/'+id);
            $('#method').val('PUT');
            $('#id').val(response.data.id);
            $('#effective_date').val(response.data.effective_date);
            $('#job_title').val(response.data.job_title);
            $('#store_id').val(response.data.store_id);
            $('#job_position').val(response.data.job_position).trigger('change');
            //$('#reports_to').val();
            updReportsTo(response.data.reports_to);
        }
    });
    $('#'+id).val('');
}
</script>
