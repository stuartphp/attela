@extends('layouts.iframe')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-6"><a href="{{ url('setup/disciplinary-reasons') }}">Disciplinary Reasons</a></div>
            <div class="col-6 text-end">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'disciplinary_reasons_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('setup/disciplinary-reasons') }}" method="get">
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
                <th class="col-4">{{__('disciplinary_reasons.fields.incident')}}</th>
                <th>{{__('disciplinary_reasons.fields.first')}}</th>
                <th>{{__('disciplinary_reasons.fields.second')}}</th>
                <th>{{__('disciplinary_reasons.fields.third')}}</th>
                <th>{{__('disciplinary_reasons.fields.fourth')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
          <tbody>
              @if(count($data)>0)
                @foreach ($data as $item)
                <tr>
                    <td>{{ (strlen($item->incident)>90) ? substr($item->incident,0,90).'...':$item->incident}}</td>
                    <td>{{ ($item->first >NULL) ?__('disciplinary_reasons.actions.'.$item->first):''}}</td>
                    <td>{{ ($item->second > NULL)? __('disciplinary_reasons.actions.'.$item->second):''}}</td>
                    <td>{{ ($item->third > NULL)? __('disciplinary_reasons.actions.'.$item->third):''}}</td>
                    <td>{{ ($item->fourth>NULL)? __('disciplinary_reasons.actions.'.$item->fourth):''}}</td>
                    <td class="col-1"><select class="dropdown-action form-select" id="{{ $item->id }}">
                        <option value="">{{ __('global.select') }}</option>
                        @if($item->company_id>0)
                        <option value="Edit">{{ __('global.edit') }}</option>
                        <option value="Delete">{{ __('global.delete') }}</option>
                        @else
                        <option value="System">{{ __('global.system') }}</option>
                        @endif
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
<input type="hidden" id="id" value=""><input type="hidden" name="company_id" id="company_id" value="{{ session()->get('company_id') }}">

  <div class="modal fade" id="formModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row mb-2">
                <label class="col-3">Search</label>
                <div class="col-9">
                    <select id="incedent" class="form-control form-control-sm "></select>
                </div>
            </div>
            <div class="row mb-2">
                <label class="col-3">{{__('disciplinary_reasons.fields.incident')}}</label>
                <div class="col-9">
                    <textarea name="incident" id="incident" class="form-control form-control-sm" required></textarea>
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('disciplinary_reasons.fields.first')}}</label>
                <div class="col-9">
                    <select name="first" id="first" class="form-select" required>
                        <option value="">{{ __('global.pleaseSelect') }}</option>
                        @foreach (__('disciplinary_reasons.actions') as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('disciplinary_reasons.fields.second')}}</label>
                <div class="col-9">
                    <select name="second" id="second" class="form-select">
                        <option value="">{{ __('global.pleaseSelect') }}</option>
                        @foreach (__('disciplinary_reasons.actions') as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('disciplinary_reasons.fields.third')}}</label>
                <div class="col-9">
                    <select name="third" id="third" class="form-select">
                        <option value="">{{ __('global.pleaseSelect') }}</option>
                        @foreach (__('disciplinary_reasons.actions') as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div><div class="row mb-2">
                <label class="col-3">{{__('disciplinary_reasons.fields.fourth')}}</label>
                <div class="col-9">
                    <select name="fourth" id="fourth" class="form-select">
                        <option value="">{{ __('global.pleaseSelect') }}</option>
                        @foreach (__('disciplinary_reasons.actions') as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
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
                url:'/setup/disciplinary-reasons/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    $('.modal-title').html(update);
                    $('#action').val('Update');
                    $('#main_form').attr('action', '/setup/disciplinary-reasons/'+id);
                    $('#method').val('PUT');
                    $('#id').val(response.data.id);
					$('#company_id').val(response.data.company_id);
					$('#incident').val(response.data.incident);
					$('#first').val(response.data.first);
					$('#second').val(response.data.second);
					$('#third').val(response.data.third);
					$('#fourth').val(response.data.fourth);

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
                confirmButtonText: '{{ __("global.yes") }}'
            }).then((result) => {
                if (result.value) {
                    $('#main_form').attr('action', '/setup/disciplinary-reasons/'+id);
                    $('#method').val('DELETE');
                }
            });
            break;

    }
    $('#'+id).val('');
});
$('#incedent').select2({
    dropdownParent: '#formModal',
    ajax: {
        url: '/search/disciplinary',
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
$('#incedent').on('change', function(){
    let data = $(this).val().split('~');
    $('#incident').val(data[1]);
    $('#first').val(data[2]);
    $('#second').val(data[3]);
    $('#third').val(data[4]);
    $('#fourth').val(data[5]);
})
</script>
@endsection


