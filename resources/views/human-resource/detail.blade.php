<input type="hidden" id="employee_id" value="{{ $data->id }}">
    <nav class="navbar navbar-expand-lg navbar-light"  style="background-color: #EDF1ED">
        <div class="container-fluid">
            <div class="navbar-brand"><span style="cursor:pointer" onclick="openNav()">&#9776;</span> {{ $data->employee_code }} {{ $data->surname }} {{ $data->initials }} ({{ $data->known_as }})</div>
        <ul class="nav nav-pills" id="detailTab">
        <li class="nav-item">
          <a class="nav-link active" id="detail-tab" data-bs-toggle="tab" href="#detail" role="tab" aria-controls="detail" aria-selected="true">{{ __('employee_lookup.menu.details') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="jobs-tab" data-bs-toggle="tab" href="#jobs" role="tab" aria-controls="jobs" aria-selected="false" >{{ __('employee_lookup.menu.position') }}</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" id="documents-tab" data-bs-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">{{ __('employee_lookup.menu.documents') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="disciplinary-tab" data-bs-toggle="tab" href="#disciplinary" role="tab" aria-controls="disciplinary" aria-selected="false">
              {{ __('employee_lookup.menu.disciplinary') }}
            </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" id="payment_detail-tab" data-bs-toggle="tab" href="#payment_detail" role="tab" aria-controls="payment_detail" aria-selected="false">{{ __('employee_lookup.menu.payment_detail') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="benefits-tab" data-bs-toggle="tab" href="#benefits" role="tab" aria-controls="benefits" aria-selected="false">{{ __('employee_lookup.menu.benefits.title') }}</a>
          </li>
        <li class="nav-item">
            <a class="nav-link" id="payslip-tab" data-bs-toggle="tab" href="#payslip" role="tab" aria-controls="payslip" aria-selected="false">{{ __('employee_lookup.menu.payslip') }}</a>
          </li>
        <li class="nav-item">
          <a class="nav-link" id="tran-tab" data-bs-toggle="tab" href="#tran" role="tab" aria-controls="tran" aria-selected="false">{{ __('employee_lookup.menu.transactions') }}</a>
        </li>
      </ul>
    </div>
</nav>
      <div class="tab-content pr-2 pl-2">
        <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
            @include('human-resource.form_detail', $data)
        </div>

        <div class="tab-pane fade" id="jobs" role="tabpanel" aria-labelledby="jobs-tab">
            @include('human-resource.form_jobs')
        </div>
        <div class="tab-pane fade" id="disciplinary" role="tabpanel" aria-labelledby="disciplinary-tab">
            @include('human-resource.form_disciplinary')
        </div>
        <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
            @include('human-resource.form_documents')
        </div>
        <div class="tab-pane fade" id="payment_detail" role="tabpanel" aria-labelledby="payment_detail-tab">
          @include('human-resource.form_payment_detail')
      </div>
        <div class="tab-pane fade" id="benefits" role="tabpanel" aria-labelledby="benefits-tab">
          @include('human-resource.form_benefits')
      </div>
        <div class="tab-pane fade" id="payslip" role="tabpanel" aria-labelledby="payslip-tab">
            <div class="ratio ratio-16x9">
                <iframe id="result" src="/payroll/payslip/{{ $data->id }}" allowfullscreen></iframe>
            </div>
        </div>
        <div class="tab-pane fade" id="tran" role="tabpanel" aria-labelledby="tran-tab">
            @include('human-resource.form_transactions')
        </div>

      </div>

