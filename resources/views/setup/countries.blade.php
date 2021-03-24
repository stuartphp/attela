@extends('layouts.iframe')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6"><a href="{{ url('/setup/countries') }}">{{ __('countries.title') }}</a> </div>
            <div class="col-md-6 text-end">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'countries_create']))==1)
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('/setup/countries') }}" method="get">
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
                <th class="col-7">{{__('countries.fields.name')}}</th>
                <th class="col-2">{{__('countries.fields.iso_code_2')}}</th>
                <th class="col-2">{{__('countries.fields.iso_code_3')}}</th>
                <th class="col-1">Actions</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($data as $item)
                <tr @if($item->own_id) class="bg-success" @endif id="r_{{ $item->id }}">
                    <td> {{ $item->name}}</td>
                    <td>{{ $item->iso_code_2}}</td>
                    <td>{{ $item->iso_code_3}}</td>
                    <td><select class="dropdown-action form-select" id="{{ $item->id }}">
                        <option value="">{{ __('global.select') }}</option>
                        @if($item->own_id)
                            <option value="Delete">{{ __('global.delete') }}</option>
                        @else
                            <option value="Add">{{ __('global.add') }}</option>
                        @endif
                        </select></td>
                </tr>
              @endforeach
          </tbody>
        </table>
    </div>
  </div>
<!-- /.box-footer-->
<div class="card-footer">{{ $data->onEachSide(1)->render() }}</div>
</div>

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
        case 'Add':
        $.ajax({
            url:'/setup/countries',
            dataType:'JSON',
            data: { id:id},
            method: 'POST',
            success: function (response) {
                $('#r_'+id).addClass('bg-success');
                $("#r_"+id+" option[value='Add']").remove();
                $('#' + id).append($('<option>', {
                    value: 'Delete',
                    text: "{{ __('global.delete') }}"
                }));
                notify('success', "{{ __('global.record_added') }}");
            }
        });
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
                cancelButtonText: '{{ __('global.no')}}',
                confirmButtonText: '{{ __("global.yes") }}'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url:'/setup/countries/'+id,
                        dataType:'JSON',
                        data: { id:id, _method:'DELETE'},
                        method: 'POST',
                        success: function (response) {
                            $('#r_'+id).removeClass('bg-success');
                            $("#r_"+id+" option[value='Delete']").remove();
                            $('#' + id).append($('<option>', {
                                value: 'Add',
                                text: "{{ __('global.add') }}"
                            }));
                            notify('success', "{{ __('global.record_deleted') }}");
                        }
                    });
                }
            });
            break;

    }
    $('#'+id).val('');
});
</script>
@endsection
