<div class="form-heading mt-2 ms-2">{{ __('inventory_activities.title') }}
    <span style="float: right"><a href="#" onclick="$('#form_activity').toggle()"><i class="bi bi-plus" id="inv_activity_add_close"></i></a></span>
</div>

    <div class="table-responsive">
    <table class="table table-hover" id="inventory_activities_table" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>{{ __('inventory_activities.fields.action_date') }}</th>
            <th>{{__('inventory_activities.fields.action')}}</th>
            <th>{{__('inventory_activities.fields.document_reference')}}</th>
            <th>{{__('inventory_activities.fields.store_id')}}</th>
            <th class="text-center">{{__('inventory_activities.fields.down')}}</th>
            <th class="text-center">{{__('inventory_activities.fields.up')}}</th>

        </tr>
        </thead>
        <tfoot>
        <tr> 
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>

        </tr>
        </tfoot>

    </table>
    </div>

<form method="post" id="form_activity" enctype="multipart/form-data">
@csrf
<input type="hidden" id="activity_action" value="add"/>
<input type="hidden" name="_method" id="method">
<input type="hidden" id="id" value="">
<input type="hidden" name="company_id" id="company_id" value="{{ session()->get('company_id') }}">
<div class="card shaddow-sm">
    <div class="card-header" id="inv_act_header">{{ __('inventory_activities.title') }}</div>
    <div class="card-body">
        <div class="mb-2 row">
            <label class="col-md-2">{{__('inventory_activities.fields.action_date')}}</label>
            <div class="col-md-2">
                <input type="text" name="action_date" id="action_date" class="form-control form-control-sm date">
            </div>
            <label class="col-md-2">{{__('inventory_activities.fields.action')}}</label>
            <div class="col-md-2">
                <select name="action" id="action" class="form-select">
                    @foreach (__('inventory_activities.action') as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <label class="col-md-2">{{__('inventory_activities.fields.document_reference')}}</label>
            <div class="col-md-2">
                <input type="text" name="document_reference" id="document_reference" class="form-control form-control-sm">
            </div>
        </div>
        <div class="mb-2 row">
            <label class="col-md-2">{{__('inventory_activities.fields.store_id')}}</label>
            <div class="col-md-2">
                <select name="store_id" id="store_id" class="form-select">
                    @foreach ($stores as $k=>$v)
                        <option value="{{ $k }}">{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <label class="col-md-2">{{__('inventory_activities.fields.down')}}</label>
            <div class="col-md-2">
                <input type="text" name="down" id="down" class="form-control form-control-sm">
            </div>
            <label class="col-md-2">{{__('inventory_activities.fields.up')}}</label>
            <div class="col-md-2">
                <input type="text" name="up" id="up" class="form-control form-control-sm">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="submit" class="btn btn-outline-primary btn-sm" value="{{ __('global.save') }}">
    </div>
</div>
</form>

 <script>
$('#inv_activity_add_close').on('click', function(){
    if($('#inv_activity_add_close').hasClass('bi-plus')){
        $('#inv_activity_add_close').removeClass('bi bi-plus').addClass('bi bi-x');
        $('#inv_act_header').html(add);
        $('#activity_action').val('Add');
    }else{
        $('#inv_activity_add_close').removeClass('bi bi-x').addClass('bi bi-plus')
        document.getElementById("form_activity").reset();
    }
    $('#inventory_activities_table_wrapper').toggle();
});
$(document).ready(function(){
    $('#form_activity').hide();
        $('.datetime').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            locale: 'en',
            sideBySide: true
        })
    $('#inventory_activities_table').DataTable({
        processing: true,
        serverSide: true,
        retrieve: true,
        aaSorting: [],
        ajax:{
            url: "/inventory/activities-data/{{ $data->id }}"
        },
        columnDefs: [
            {
                targets: 4,
                className: 'dt-body-center',
            },
            {
                targets: 5,
                className: 'dt-body-center',
            }
        ],
        columns: [
            {data:'action_date', name:'action_date'},
            {data:'action', name:'action'},
            {data:'document_reference', name:'document_reference'},
            {data:'store_id', name:'store_id'},
            {data:'down', name:'down'},
            {data:'up', name:'up'},
        ],
        pageLength: 15,
        lengthMenu: [[10, 15, 25, 50, -1], [10, 15, 25, 50, "All"]],
        initComplete: function () {
            this.api().columns([1,3]).every( function () {
                var column = this;
                var select = $('<select class="form-select"><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    });
});

$(document).on('change', '.action', function(){
let id = $(this).attr('id');
let val = $('#' + id).val();

switch(val)
{
    case 'Edit':
    $.ajax({
            url:'/inventory/activities/'+id+'/edit',
            dataType:'JSON',
            method: 'GET',
            success: function (response) {
                $('.modal-title').html(update);
                $('#action').val('Update');
                $('#id').val(response.data.id);
                $('#company_id').val(response.data.company_id);
                $('#inventory_item_id').val(response.data.inventory_item_id);
                $('#action_date').val(response.data.action_date);
                $('#action').val(response.data.action);
                $('#document_reference').val(response.data.document_reference);
                $('#store_id').val(response.data.store_id);
                $('#down').val(response.data.down);
                $('#up').val(response.data.up);

            }
        });
        $('#active_formModal').modal('show');
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
                $.ajax({
                    url: '/inventory/activities/' + id,
                    dataType: 'JSON',
                    data: {_method: 'DELETE', _token:'{{ csrf_token() }}'},
                    method: 'POST',
                    success: function (response) {
                        if (response.success) {
                            notice('success', '{{__('global.record_deleted')}}');
                            $('#dataTable').DataTable().ajax.reload(null, false);
                        }
                    }
                });
            }
        });
        break;

}
$('#'+id).val('');
});
</script>
