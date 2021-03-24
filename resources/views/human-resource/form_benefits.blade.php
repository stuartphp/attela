<nav class="nav nav-tabs mt-2" id="myTab" role="tablist">
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <button class="nav-link active" id="nav-leave-tab" data-bs-toggle="tab" data-bs-target="#nav-leave" type="button" role="tab" aria-controls="nav-leave" aria-selected="true">{{ __('employee_lookup.menu.benefits.submenu.leave') }}</button>
      <button class="nav-link" id="nav-loans-tab" data-bs-toggle="tab" data-bs-target="#nav-loans" type="button" role="tab" aria-controls="nav-loans" aria-selected="false">{{ __('employee_lookup.menu.benefits.submenu.loans') }}</button>
      <button class="nav-link" id="nav-directives-tab" data-bs-toggle="tab" data-bs-target="#nav-directives" type="button" role="tab" aria-controls="nav-directives" aria-selected="false">{{ __('employee_lookup.menu.benefits.submenu.directives') }}</button>
      <button class="nav-link" id="nav-compensation-tab" data-bs-toggle="tab" data-bs-target="#nav-compensation" type="button" role="tab" aria-controls="nav-compensation" aria-selected="false">{{ __('employee_lookup.menu.benefits.submenu.compensation') }}</button>
      <button class="nav-link" id="nav-ra-tab" data-bs-toggle="tab" data-bs-target="#nav-ra" type="button" role="tab" aria-controls="nav-ra" aria-selected="false">{{ __('employee_lookup.menu.benefits.submenu.ra') }}</button>
      <button class="nav-link" id="nav-medical-tab" data-bs-toggle="tab" data-bs-target="#nav-medical" type="button" role="tab" aria-controls="nav-medical" aria-selected="false">{{ __('employee_lookup.menu.benefits.submenu.medical') }}</button>
      <button class="nav-link" id="nav-deductions-tab" data-bs-toggle="tab" data-bs-target="#nav-deductions" type="button" role="tab" aria-controls="nav-deductions" aria-selected="false">{{ __('employee_lookup.menu.benefits.submenu.descutions') }}</button>

    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-leave" role="tabpanel" aria-labelledby="nav-leave-tab">
        @include('human-resource.benefits.employee-leave', ['id'=>$data->id])
    </div>
    <div class="tab-pane fade" id="nav-loans" role="tabpanel" aria-labelledby="nav-loans-tab">
        @include('human-resource.benefits.employee-loans', ['id'=>$data->id])
    </div>
    <div class="tab-pane fade" id="nav-compensation" role="tabpanel" aria-labelledby="nav-compensation-tab">
        @include('human-resource.benefits.employee-compensation', ['id'=>$data->id])
    </div>
    <div class="tab-pane fade" id="nav-directives" role="tabpanel" aria-labelledby="nav-directives-tab">
        @include('human-resource.benefits.employee-directives', ['id'=>$data->id])
    </div>
    <div class="tab-pane fade" id="nav-ra" role="tabpanel" aria-labelledby="nav-ra-tab">
        @include('human-resource.benefits.employee-ras', ['id'=>$data->id])
    </div>
    <div class="tab-pane fade" id="nav-medical" role="tabpanel" aria-labelledby="nav-medical-tab">
        @include('human-resource.benefits.employee-medical', ['id'=>$data->id])
    </div>
    <div class="tab-pane fade" id="nav-deductions" role="tabpanel" aria-labelledby="nav-deductions-tab">...</div>
  </div>







