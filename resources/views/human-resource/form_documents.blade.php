<div class="form-heading mt-2">Documents <span style="float: right"><a href="#"><i  id="create_record" class="bi bi-plus fa-1x" ></i></a></span></div>

<div class="table-responsive">
    <table class="table table-hover" id="documentsTable" width="100%" cellspacing="0">
      <thead>
        <tr>
            <th class="col-6">{{__('employee_documents.fields.document_type')}}</th>
            <th class="col-2">{{__('global.updated_at')}}</th>
            <th class="col-3">{{__('employee_documents.fields.user_id')}}</th>
            <th class="col-1">Actions</th>
        </tr>
      </thead>
      <tbody>
          @if(count($documents)>0)
            @foreach ($documents as $item)
            <tr>
                <td><a href="/{{ $item->file_name }}" target="_blank">{{ __('employee_lookup.documents.'.$item->document_type)}}</a></td>
                <td>{{ $item->updated_at}}</td>
                <td>{{ $item->user_id}}</td>
                <td><select class="dropdown-action form-select" id="{{ $item->id }}">
                    <option value="">{{ __('global.select') }}</option>
                    <option value="Delete">{{ __('global.delete') }}</option>
                    </select></td>
            </tr>
            @endforeach
          @else

          @endif
      </tbody>
    </table>
</div>

<form method="post" id="form_documents" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="action"/>
    <input type="hidden" name="_method" id="method">
    <input type="hidden" id="document_employee_id" name="employee_id" >
      <div class="modal fade" id="formModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add New Record</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <label class="col-3">{{__('employee_documents.fields.document_type')}}</label>
                    <div class="col-9">
                        <select name="document_type" id="document_type" class="form-select">
                            @foreach (__('employee_lookup.documents') as $k=>$v)
                            <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                    </div>
                </div><div class="row mb-2">
                    <label class="col-3">{{__('employee_documents.fields.file_name')}}</label>
                    <div class="col-9">
                        <div class="input-group">
                            <input type="file"  name="file_name" id="file_name" class="form-control form-control-sm"  aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-primary btn-sm" type="submit">
                                    {{ __('global.size') }} Max:1MB
                                    </button>
                            </div>
                          </div>
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
<script>
    $('#create_record').click(function () {
    $('#form_documents')[0].reset();
    $('.modal-title').html(add);
    $('#action').val('Add');
    $('#formModal').modal('show');
});
$('#form_documents').on('submit', function(e){
    e.preventDefault();
    let id = $('#employee_id').val();
    $('#document_employee_id').val(id);
    $.ajax({
        url: '/human-resource/employee-documents',
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        success: function(response){
            if(response.success){
                html = '<tr><td><a href="/'+response.success.file_name+'" target="_blank">Document</a></td><td>'+response.success.updated_at+'</td></td><td><select></select></td></tr>';
                $('#documentsTable tbody').append(html);
                $('#formModal').modal('hide');
                notice('success', '{{__('global.record_updated')}}');
            }else{
                let err='<ul class="text-left">';
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
</script>
