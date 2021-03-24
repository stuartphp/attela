
    <form id="empl_comp_hours" method="POST">
        @csrf
        <input type="hidden" id="empl_hours_worked_id" name="empl_hours_worked_id"/>
        <input type="hidden" id="employee_benefit_id " name="employee_benefit_id "/>
        <input type="hidden" id="empl_hours_method" name="_method"/>
    <div class="form-heading">{{ __('employee_hours_worked.compensation') }}
        <span style="float: right">
            <a href="#" id="create_comp"><i class="bi bi-plus" id="add_close"></i></a>
        </span>
    </div>
        <div class="row mb-2">
            <label class="col-2">{{__('employees.fields.compensation_pay_type')}}</label>
            <div class="col-2">
                <select name="compensation_pay_type" id="compensation_pay_type" class="form-select">
                    @foreach (__('employee_lookup.compensation_pay_type') as $k=>$v)
                    <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <label class="col-2">{{__('employees.fields.compensation_pay_schedule')}}</label>
            <div class="col-2">
                <select name="compensation_pay_schedule" id="compensation_pay_schedule" class="form-select">
                    @foreach (__('employee_lookup.compensation_pay_schedule') as $k=>$v)
                    <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-heading">{{ __('employee_hours_worked.hours') }}</div>
                <div class="row mb-2">
                    <label class="col-6">{{ __('employee_hours_worked.fields.hours_per_day') }}</label>
                    <div class="col-3"><input type="text" onchange="calcHours()" name="hours_per_day" id="hours_per_day" class="form-control form-control-sm" desimal="1" value="8"></div>
                </div>
                <div class="row mb-2">
                    <label class="col-6">{{ __('employee_hours_worked.fields.days_per_week') }}</label>
                    <div class="col-3"><input type="text" onchange="calcHours()" name="days_per_week" id="days_per_week" class="form-control form-control-sm" value="5">
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-6">{{ __('employee_hours_worked.days_per_bw') }}</label>
                    <div class="col-3"><input type="text" onchange="calcHours()" name="days_per_bw" id="days_per_bw" class="form-control form-control-sm" value="10"></div>
                </div>
            </div>
            <div class="col">
                <div class="form-heading">{{ __('employee_hours_worked.average') }}</div>
            <div class="row mb-2">
                <label class="col-6">{{ __('employee_hours_worked.fields.ave_days_pm') }}</label>
                <div class="col-3"><input type="text" onchange="calcWork('ave_days_pm')" name="ave_days_pm" id="ave_days_pm" class="form-control form-control-sm"></div>
            </div>
            <div class="row mb-2">
                <label class="col-6">{{ __('employee_hours_worked.ave_hours_pw') }}</label>
                <div class="col-3"><input type="text" onchange="calcWork('ave_hours_pw')" name="ave_hours_pw" id="ave_hours_pw" class="form-control form-control-sm"></div>
            </div>
            <div class="row mb-2">
                <label class="col-6">{{ __('employee_hours_worked.ave_hours_bw') }}</label>
                <div class="col-3"><input type="text" onchange="calcWork('ave_hours_bw')" name="ave_hours_bw" id="ave_hours_bw" class="form-control form-control-sm"></div>
            </div>
            <div class="row mb-2">
                <label class="col-6">{{ __('employee_hours_worked.ave_hours_pm') }}</label>
                <div class="col-3"><input type="text" onchange="calcWork('ave_hours_pm')" name="ave_hours_pm" id="ave_hours_pm" class="form-control form-control-sm"></div>
            </div>
            </div>
            <div class="col">
                <div class="form-heading">{{ __('employee_hours_worked.rates') }}</div>
            <div class="row mb-2">
                <label class="col-6">{{ __('employee_hours_worked.fields.annual_salary') }}</label>
                <div class="col-3"><input type="text" onchange="calcWork('annual_salary')" name="annual_salary" id="annual_salary"class="form-control form-control-sm"></div>

            </div>
            <div class="row mb-2">
                <label class="col-6">{{ __('employee_hours_worked.fields.fixed_salary') }}</label>
                <div class="col-3"><input type="text" onchange="calcWork('fixed_salary')" name="fixed_salary" id="fixed_salary" class="form-control form-control-sm"></div>

            </div>
            <div class="row mb-2">
                <label class="col-6">{{ __('employee_hours_worked.rate_pd') }}</label>
                <div class="col-3"><input type="text" onchange="calcWork('rate_pd')" id="rate_pd" name="rate_per_day" class="form-control form-control-sm">        </div> </div>
            <div class="row mb-2">
                <label class="col-6">{{ __('employee_hours_worked.rate_ph') }}</label>
                <div class="col-3"><input type="text" onchange="calcWork('rate_ph')" id="rate_ph" name="rate_per_hour" class="form-control form-control-sm">        </div>

            </div>
        </div>
            <div class="row mb-2">
                <label class="col-10 text-end">{{ __('employee_hours_worked.fields.is_advised') }}</label>
                <div class="col-2">
                    <div class="inline">
                        <div class="form-check">
                            <input type="checkbox" name="is_advised" id="is_advised" class="form-check-input">
                        </div>
                    </div>
                </div>
                </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-outline-primary btn-sm">{{ __('global.save') }}</button>
        </div>
        </div>
    </form>
    <div class="modal" tabindex="-1" id="modal_empl_comp">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ __('global.add').' '.__('employee_hours_worked.compensation') }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <label class="col-sm-2 col-form-label">Category</label>
                    <div class="col-10">
                        <select class="form-select" onchange="addModalFields(this.value)">
                            <option value="">{{ __('global.pleaseSelect') }}</option>
                            <option value="travel">Travel 80%</option>
                            <option value="commission">Commission</option>
                            <option value="overtime15">Overtime 1.5</option>
                            <option value="overtime20">Overtime 2.0</option>
                            <option value="allowance">Allowance</option>
                            <option value="bonus">Bonus</option>
                            <option value="leave_paid_out">Leave Paid out</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="modal_empl_com_fields">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-outline-primary btn-sm">{{ __('global.save') }}</button>
            </div>
          </div>
        </div>
      </div>

<script>


    $(function(){
        calcHours();
        loadCompensation();
        if($('#empl_hours_worked_id').val() <1){
            $('#create_comp').hide();
        }
});

$('#create_comp').on('click', function(){
    $('#modal_empl_comp').modal('show');
})
function loadCompensation()
{
    $.ajax({
        url:'/human-resource/employee-hours-worked/{{ $id }}',
        method:'GET',
        dataType:'JSON',
        processData:false,
        contentType: false,
        cache: false,
        success: function(ret)
        {
            if(ret.id>0 && typeof ret.id !== 'undefined')
            {
                $('#compensation_pay_type').val(ret.compensation_pay_type);
                $('#compensation_pay_schedule').val(ret.compensation_pay_schedule);
                $('#employee_benefit_id ').val(ret.employee_benefit_id );
                $('#hours_per_day').val(ret.hours_per_day/100);
                $('#days_per_week').val(ret.days_per_week/100);
                $('#days_per_bw').val(ret.days_per_bw/100);
                $('#ave_days_pm').val(ret.ave_days_pm/100);
                $('#ave_hours_pw').val(ret.ave_hours_pw/100);
                $('#ave_hours_bw').val(ret.ave_hours_bw/100);
                $('#ave_hours_pm').val(ret.ave_hours_pm/100);
                $('#annual_salary').val(ret.annual_salary/100);
                $('#fixed_salary').val(ret.fixed_salary/100);
                $('#rate_pd').val(ret.rate_per_day/100);
                $('#rate_ph').val(ret.rate_per_hour/100);
                $('#empl_hours_worked_id').val(ret.id);
                $('#create_comp').show();
            }
        }
    });

}

function calcHours()
{
    hours_pd = parseFloat($('#hours_per_day').val());
    days_pw = parseFloat($('#days_per_week').val());
    days_per_bw = days_pw*2;
    cal_days_pm = 0;
    cal_hours_pw =0;
    cal_hours_bw = 0;
    cal_hours_pm = 0;
    pay_periods = 12;

    cal_days_pm = (days_pw*month).toFixed(0);
    // Ave hours per week
    cal_hours_pw = hours_pd*days_pw;
    // Ave hours per biweek
    cal_hours_bw = days_per_bw*hours_pd;
    // Ave hours per month
    cal_hours_pm = hours_pd*cal_days_pm;
    pay_periods = (month*6).toFixed(0);

    working_days = (working_days_per_year/2).toFixed(0);
    $('#days_per_bw').val(days_per_bw);
    $('#ave_days_pm').val(cal_days_pm);
    $('#ave_hours_pw').val(cal_hours_pw);
    $('#ave_hours_bw').val(cal_hours_bw);
    $('#ave_hours_pm').val(cal_hours_pm);
}

$('#empl_comp_hours').on('submit', function(e){
    e.preventDefault();
    let id= $('#employee_id').val();
    let method = ($('#empl_hours_worked_id').val()>0) ? 'PUT':'POST';
    let data = new FormData(this);
        data.append('empl_id', id);
    let url= '/human-resource/employee-hours-worked';
    if(method==='PUT'){
        url +='/'+$('#empl_hours_worked_id').val();
    }
    $('#empl_hours_method').val(method);
    $.ajax({
        url:url,
        data: data,
        processData:false,
        contentType: false,
        cache: false,
        dataType: 'JSON',
        method:'POST',
        success: function(ret)
        {
            if(ret.success){
                $('#empl_hours_worked_id').val(ret.id);
                $('#employee_benefit_id ').val();
                $('#create_comp').show();
                notice('success', ret.success);
            }else{
                let err='<ul class="text-start">';
                for(let i=0; i<ret.length; i++)
                {
                    err += "<li>"+ret[i]+"</li>";
                }
                err +="</ul>";
                notice('error', '{{__('global.error_update')}}', err);
            }
        }
    });
});
function calcWork(field){
    let comp_type = parseFloat($('#compensation_pay_schedule').val());
/**
    1=>'Every day',
    2=>'Every week',
    3=>'Every second week',
    4=>'Monthly',
    5=> 'Every other month',
    6=> 'Every third month',
    7=> 'Every fourth month',
    8=> 'Every six months',
    9 => 'Yearly',
*/
    salary = parseFloat($('#annual_salary').val());
    fixed_salary = parseFloat($('#fixed_salary').val());
    rate_pd = parseFloat($('#rate_pd').val());
    rate_ph = parseFloat($('#rate_ph').val());

    // Ave working days pm
    cal_days_pm = (days_pw*month).toFixed(0);
    // Ave hours per week
    cal_hours_pw = hours_pd*days_pw;
    // Ave hours per biweek
    cal_hours_bw = days_per_bw*hours_pd;
    // Ave hours per month
    cal_hours_pm = hours_pd*cal_days_pm;
    working_days = cal_days_pm*12;
    $('#ave_days_pm').val(cal_days_pm);
    $('#ave_hours_pw').val(cal_hours_pw);
    $('#ave_hours_bw').val(cal_hours_bw);
    $('#ave_hours_pm').val(cal_hours_pm);

    switch(field)
    {
        case 'annual_salary':
            rate_pd = salary/working_days;
            $('#rate_pd').val(rate_pd.toFixed(2));
            $('#rate_ph').val((rate_pd/hours_pd).toFixed(2));
            $('#fixed_salary').val((salary/12).toFixed(2));
        break;

        case 'fixed_salary':
            salary = fixed_salary*12;
            rate_pd = salary/working_days;
            $('#rate_pd').val(rate_pd.toFixed(2));
            $('#rate_ph').val((rate_pd/hours_pd).toFixed(2));
            $('#annual_salary').val(salary.toFixed(2));
        break;
        case 'rate_pd':
            salary = rate_pd*working_days;
            $('#annual_salary').val(salary.toFixed(2));
            $('#rate_ph').val((rate_pd/hours_pd).toFixed(2));
            $('#fixed_salary').val((salary/12).toFixed(2));
        break;
        case 'rate_ph':
            rate_pd = rate_ph*hours_pd;
            salary = rate_pd*working_days;
            $('#annual_salary').val(salary.toFixed(2));
            $('#rate_pd').val(rate_pd.toFixed(2));
            $('#fixed_salary').val((salary/12).toFixed(2));
        break;
        default:
    }

}

function addModalFields(val)
{
    let html='';
    $('.modal_empl_com_fields').html(html);

    switch(val)
    {
        case 'travel':
            html ='<div class="row mb-2"><div class="col-3">{{ __("employee_hours_worked.i_want_to_pay") }}</div><div class="col-4"><input type="text" class="form-control form-control-sm"></div></div><div class="row mb-2"><label class="col-1">for</label><div class="col-4"><input type="text" class="form-control form-control-sm"></div><div class="col-7 form-check"><div class="row"><div class="col-8"><label class="form-check-label">months or every month</label></div><div class="col-1"><input type="checkbox" name="is_asylum_seeker" id="is_asylum_seeker" class="form-check-input"></div></div></div></div>';
        break;
        case 'allowance':
            html ='<div class="row mb-2"><div class="col-3">{{ __("employee_hours_worked.i_want_to_pay") }}</div><div class="col-4"><input type="text" class="form-control form-control-sm"></div></div><div class="row mb-2"><label class="col-1">for</label><div class="col-4"><input type="text" class="form-control form-control-sm"></div><div class="col-7 form-check"><div class="row"><div class="col-8"><label class="form-check-label">months or every month</label></div><div class="col-1"><input type="checkbox" name="is_asylum_seeker" id="is_asylum_seeker" class="form-check-input"></div></div></div></div>';
        break;
        case 'commission':
            html ='<div class="row mb-2"><div class="col-3">{{ __("employee_hours_worked.i_want_to_pay") }}</div><div class="col-4"><input type="text" class="form-control form-control-sm"></div></div><div class="row mb-2"><label class="col-1">for</label><div class="col-4"><input type="text" class="form-control form-control-sm"></div><div class="col-7 form-check"><div class="row"><div class="col-8"><label class="form-check-label">months or every month</label></div><div class="col-1"><input type="checkbox" name="is_asylum_seeker" id="is_asylum_seeker" class="form-check-input"></div></div></div></div>';
        break;
        case 'overtime15':
            let ot15 = (parseFloat($('#rate_ph').val())*1.5).toFixed(2);
            html ='<div class="row mb-2"><div class="col-3">{{ __("employee_hours_worked.i_want_to_pay") }}</div><div class="col-4"><input type="text" class="form-control form-control-sm"> </div><div class="col-2">hours @</div></div><div class="row mb-2"><label class="col-12"><h5>'+ot15+' ('+$('#rate_ph').val()+' * 1.5)</h5></label></div>';
        break;
        case 'overtime20':
            let ot20 = (parseFloat($('#rate_ph').val())*2).toFixed(2);
            html ='<div class="row mb-2"><div class="col-3">{{ __("employee_hours_worked.i_want_to_pay") }}</div><div class="col-4"><input type="text" class="form-control form-control-sm"> </div><div class="col-2">hours @</div></div><div class="row mb-2"><label class="col-12"><h5>'+ot20+' ('+$('#rate_ph').val()+' * 2.0)</h5></label></div>';
        break;
        case 'leave_paid_out':
            html ='<div class="row mb-2"><div class="col-3">{{ __("employee_hours_worked.i_want_to_pay") }}</div><div class="col-4"><input type="text" class="form-control form-control-sm"></div><div class="col-4"><select class="form-select"><option value="days">Days</option><option value="hours">Hours</option></select></div></div>';
        break;
    }
    $('.modal_empl_com_fields').html(html);
}
</script>
