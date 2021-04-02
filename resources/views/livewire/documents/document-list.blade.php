<div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-9">Documents</div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-sm-1">
                            <div x-data="{ open:false}">
                                <i class="bi bi-plus fa-1x" style="cursor:pointer" data-bs-toggle="modal" data-bs-target="#exampleModal"></i>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" wire:model.lazy="size" class="form-control form-control-sm" onkeyup="this.value=this.value.replace(/[^\d]/,'')"/>
                        </div>
                        <div class="col-sm-8">
                            <input wire:model.debounce.400ms="search" type="text" class="form-control form-control-sm mb-2" placeholder="{{ __('global.search') }}" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="col-1">{{trans('document_types.fields.action_date')}}</th>
                            <th class="col-1">{{trans('documents.fields.account_number')}}</th>
                            <th class="col-4">{{trans('documents.fields.entity_name')}}</th>
                            <th class="col-1">{{trans('document_types.fields.document_number')}}</th>
                            <th class="col-1">{{trans('document_types.fields.document_type')}}</th>
                            <th class="col-1">{{trans('document_types.fields.document_reference')}}</th>
                            <th class="col-1">{{trans('document_types.fields.reference_number')}}</th>
                            <th class="col-1 text-end pe-3">{{trans('document_types.fields.total_amount')}}</th>
                            <th class="col-1">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documents as $item)
                        <tr>
                            <td>{{ $item->action_date }}</td>
                            <td class="">{{ $item->account_number }}</td>
                            <td>{{ $item->entity_name }}</td>
                            <td>{{ $item->document_number }}</td>
                            <td class="">{{ __('global.documents.'.$item->document_type) }}</td>
                            <td class="">{{ $item->document_reference }}</td>
                            <td class="">{{ $item->reference_number }}</td>
                            <td class="text-end pe-3 {{ ($item->total_due <0.01)? 'text-green': 'text-red' }} ">
                                {{ number_format($item->total_amount,2) }}
                            </td>
                            <td><select class="action form-select" id="{{ $item->id }}">
                                <option value="">{{ __('global.select') }}</option>
                                @if($item->is_paid==1)
                                <option value="Credit">{{ __('global.credit') }}</option>
                                @endif
                                @if($item->is_locked<1)
                                <option value="Edit" wire:click="doAction({{ $item->id }}, 'edit')">{{ __('global.edit') }}</option>
                                <option value="Lock">{{ __('global.lock') }}</option>
                                @endif
                                <option value="PDF">{{ __('global.pdf') }}</option>
                                <option value="View">{{ __('global.view') }}</option>
                                </select></td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $documents->render() }}
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{ __('global.add_new_record') }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs mb-2">
                    <li class="nav-item">
                        <a href="#" class="nav-link{{ $currentStep == 1 ? ' active' : '' }}" wire:click.prevent="changeStep(1)">
                            {{ __('documents.title') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link{{ $currentStep == 2 ? ' active' : '' }}{{ $maxStep < 2 ? ' disabled' : '' }}" wire:click.prevent="changeStep(2)">
                            {{ __('documents.fields.entity_name') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link{{ $currentStep == 3 ? ' active' : '' }}{{ $maxStep < 3 ? ' disabled' : '' }}" wire:click.prevent="changeStep(3)">
                            {{ __('documents.fields.document_reference') }}
                        </a>
                    </li>
                </ul>
                @if ($currentStep == 1)
                    <div class="row mb-2">
                        <select class="form-select">
                            @foreach (__('accounting_lookup.documents') as $k=>$v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-primary btn-sm">{{ __('global.save') }}</button>
            </div>
          </div>
        </div>
      </div>
</div>

