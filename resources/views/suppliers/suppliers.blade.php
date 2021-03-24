@extends('layouts.admin')
@section('title', __('global.menu.suppliers.title'))
@section('content')
<div id="loadImg"><img src="/images/ajax-loader.gif" width="100px"/></div>
<div id="result" class="content-panel" style="background-color: #ffffff">
    <span style="font-size:1.25rem; cursor:pointer" onclick="openNav()">&#9776;</span>
    <!-- Display Dashboard stuff-->
    <div class="row ms-2 mt-2">
        <div class="card me-3 mb-2" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
        <div class="card me-3 mb-2" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
        <div class="card me-3 mb-2" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
        <div class="card me-3 mb-2" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
        <div class="card me-3 mb-2" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
        <div class="card me-3 mb-2" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
        <div class="card me-3 mb-2" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div>
</div>
<div id="mySidenav" class="sidenav">
    
<div class="head mb-1 ms-2 me-2">
    {{ __('global.menu.suppliers.title') }}<span style="float:right"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></span>
</div>
<div class="list-group ms-3 me-3">
    <form action="{{ url('/suppliers/suppliers') }}" method="get">
        <div class="input-group input-group-sm mb-2">
            <input type="text" class="form-control form-control-sm" name="search" placeholder="{{ __('global.search') }}" aria-label="Search" aria-describedby="basic-addon2" @if(isset($search)) value="{{$search}}" @endif>
            <div class="input-group-append">
                <button class="btn btn-primary btn-sm" type="submit">
                <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
    </form>
    @foreach ($data as $item)
    <button type="button" class="list-group-item list-group-item-action @if($item->is_active==0) list-group-item-danger @else  list-group-item-success @endif" id="S{{ $item->id}}">{{ strlen($item->description)>48 ? substr($item->description,0,46).'...' : $item->description }}</button>
    @endforeach
    {{ $data->onEachSide(1)->links() }}
<div class="d-grid pt-1">
    <button class="btn btn-outline-success btn-sm btn-block" id="create_record" type="button">{{ __('global.add_new_record') }}</button>
    <a class="btn btn-outline-warning btn-sm btn-block mt-3 mb-10" id="inventory_help" type="button" href="{{ url('suppliers/help') }}">{{ __('global.help') }}</a>
    <p>&nbsp;</p>
</div>
</div>


</div>
<!-- -->
@endsection
@section('scripts')
<script>
    function openNav() {
  document.getElementById("mySidenav").style.width = ""+sideMenu+"px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
    $(function(){
        $('#loadImg').hide();
        openNav();
    });
    $('.list-group-item').on('click', function(){
        $('#loadImg').show();
        closeNav();
        $('.list-group-item').removeClass('active');
        $(this).addClass('active');
        let id = $(this).attr('id').substring(1);
        getDetail(id);
    })

    function getDetail(id)
    {
        $('#loadImg').show();
        $.ajax({
            url:'/suppliers/suppliers/'+id,
            method:'GET',
            dataType:'html',
            success: function(response){
                $('#result').html(response);
            }
        });
        $('#loadImg').hide();
    }
    $('#create_record').click(function(){
        closeNav();
        $('.list-group-item').removeClass('active');
        $.ajax({
            url:'/suppliers/suppliers/create',
            method:'GET',
            dataType:'html',
            success: function(response){
                $('#result').html(response);
            }
        });
    })
// $('#create_record').click(function () {
//     $('#main_form')[0].reset();
//     $('.modal-title').html(add);
//     $('#action').val('Add');
//     $('#formModal').modal('show');
// });
// $('#main_form').on('submit', function (event) {
//     event.preventDefault();
//     if($('#action').val() === 'Add')
//     {
//         $('#method').val('');
//         $.ajax({
//             url: "/suppliers/suppliers",
//             method: "POST",
//             data: new FormData(this),
//             contentType: false,
//             cache: false,
//             processData: false,
//             dataType: 'JSON',
//             success: function (response) {
//                 if(response.success){
//                     $('#main_form')[0].reset();
//                     $('#formModal').modal('hide');
//                     $('#dataTable').DataTable().ajax.reload(null, false);
//                     notice('success', '{{__('global.record_added')}}');
//                 }else{
//                     let err='<ul class="text-left">';
//                     for(let i=0; i<response.errors.length; i++)
//                     {
//                         err += "<li>"+response.errors[i]+"</li>";
//                     }
//                     err +="</ul>";
//                     notice('error', '{{__('global.error_add')}}', err);
//                 }
//             }
//         });
//     }
//     if($('#action').val() === 'Update')
//     {
//         let id = $('#id').val();
//         $('#method').val('PUT');
//         $.ajax({
//             url: "/suppliers/suppliers/"+id,
//             method:'POST',
//             data: new FormData(this),
//             processData:false,
//             contentType: false,
//             cache: false,
//             dataType: 'JSON',
//             success: function(response)
//             {
//                 if(response == 'success'){
//                     $('#formModal').modal('hide');
//                     $('#dataTable').DataTable().ajax.reload(null, false);
//                     notice('success', '{{__('global.record_updated')}}');
//                 }else{
//                     let err='<ul class="text-left">';
//                     for(let i=0; i<response.errors.length; i++)
//                     {
//                         err += "<li>"+response.errors[i]+"</li>";
//                     }
//                     err +="</ul>";
//                     notice('error', '{{__('global.error_update')}}', err);
//                 }
//             }
//         });
//     }
// });
// $(document).on('change', '.dropdown-action', function(){
//     let id = $(this).attr('id');
//     let val = $('#' + id).val();

//     switch(val)
//     {
//         case 'Edit':
//         $.ajax({
//                 url:'/suppliers/suppliers/'+id+'/edit',
//                 dataType:'JSON',
//                 method: 'GET',
//                 success: function (response) {
//                     $('.modal-title').html(update);
//                     $('#action').val('Update');
//                     $('#id').val(response.data.id);
// 					$('#company_id').val(response.data.company_id);
// 					$('#account_number').val(response.data.account_number);
// 					$('#description').val(response.data.description);
// 					$('#postal_address').val(response.data.postal_address);
// 					$('#business_address').val(response.data.business_address);
// 					$('#category').val(response.data.category);
// 					$('#contact_person').val(response.data.contact_person);
// 					$('#telephone').val(response.data.telephone);
// 					$('#fax').val(response.data.fax);
// 					$('#mobile_phone').val(response.data.mobile_phone);
// 					$('#email').val(response.data.email);
// 					$('#credit_limit').val(response.data.credit_limit);
// 					$('#current_balance').val(response.data.current_balance);
// 					$('#currency_code').val(response.data.currency_code);
// 					$('#payment_terms').val(response.data.payment_terms);
// 					$('#vat_reference').val(response.data.vat_reference);
// 					$('#default_tax').val(response.data.default_tax);
// 					$('#is_open_item').val(response.data.is_open_item);
// 					$('#is_active').val(response.data.is_active);
// 					$('#deleted_at').val(response.data.deleted_at);

//                 }
//             });
//             $('#formModal').modal('show');
//             break;

//         case 'Delete':
//             Swal.fire({
//                 position: 'top',
//                 title: '{{__('global.delete')}}',
//                 text: "{{__('global.confirm_delete')}}",
//                 icon: 'warning',
//                 showCancelButton: true,
//                 confirmButtonColor: '#3085d6',
//                 cancelButtonColor: '#d33',
//                 confirmButtonText: '{{ __("global.yes") }}'
//             }).then((result) => {
//                 if (result.value) {
//                     $.ajax({
//                         url: '/suppliers/suppliers/' + id,
//                         dataType: 'JSON',
//                         data: {_method: 'DELETE', _token:'{{ csrf_token() }}'},
//                         method: 'POST',
//                         success: function (response) {
//                             if (response.success) {
//                                 notice('success', '{{__('global.record_deleted')}}');
//                                 $('#dataTable').DataTable().ajax.reload(null, false);
//                             }
//                         }
//                     });
//                 }
//             });
//             break;

//     }
//     $('#'+id).val('');
// });
</script>
@endsection
