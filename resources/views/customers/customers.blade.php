@extends('layouts.admin')
@section('title', __('customers.title'))
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
    <livewire:customer-list/>
</div>


@endsection
@section('scripts')
<script>
    function openNav() {
  document.getElementById("mySidenav").style.width = ""+sideMenu+"px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
$(function () {
    $('#loadImg').hide();
        openNav();
});

function getDetail(id)
{
    $('#loadImg').show();
    closeNav();
    $('.list-group-item').removeClass('active');
    $('#C'+id).addClass('active');
    $.ajax({
        url:'/customers/customers/'+id,
        method:'GET',
        dataType:'html',
        success: function(response){
            $('#result').html(response);
        }
    });
    $('#loadImg').hide();
}
$('#create_record').click(function(){
        $('.list-group-item').removeClass('active');
        $.ajax({
            url:'/customers/customers/create',
            method:'GET',
            dataType:'html',
            success: function(response){
                $('#result').html(response);
            }
        });
    })

$(document).on('change', '.dropdown-action', function(){
    let id = $(this).attr('id');
    let val = $('#' + id).val();

    switch(val)
    {
        case 'Edit':
            $.ajax({
                url:'/customers/customers/'+id+'/edit',
                dataType:'JSON',
                method: 'GET',
                success: function (response) {
                    $('.modal-title').html(update);
                    $('#action').val('Update');
                    $('#id').val(response.data.id);
					$('#company_id').val(response.data.company_id);
					$('#account_number').val(response.data.account_number);
					$('#description').val(response.data.description);
					$('#physical_address').val(response.data.physical_address);
					$('#delivery_address').val(response.data.delivery_address);
					$('#category').val(response.data.category);
					$('#contact_person').val(response.data.contact_person);
					$('#telephone').val(response.data.telephone);
					$('#fax').val(response.data.fax);
					$('#mobile_phone').val(response.data.mobile_phone);
					$('#email').val(response.data.email);
					$('#credit_limit').val(response.data.credit_limit);
					$('#current_balance').val(response.data.current_balance);
					$('#cash_sale_account').val(response.data.cash_sale_account);
					$('#currency_code').val(response.data.currency_code);
					$('#payment_terms').val(response.data.payment_terms);
					$('#price_excl').val(response.data.price_excl);
					$('#is_open_item').val(response.data.is_open_item);
					$('#delivery_group_id').val(response.data.delivery_group_id);
					$('#vat_reference').val(response.data.vat_reference);
					$('#default_tax').val(response.data.default_tax);
					$('#accept_electronic_document').val(response.data.accept_electronic_document);
					$('#documents_contact').val(response.data.documents_contact);
					$('#documents_email').val(response.data.documents_email);
					$('#statement_message').val(response.data.statement_message);
					$('#statement_contact').val(response.data.statement_contact);
					$('#statement_email').val(response.data.statement_email);
					$('#price_list').val(response.data.price_list);
					$('#sales_person_id').val(response.data.sales_person_id);
					$('#discount').val(response.data.discount);
					$('#psw').val(response.data.psw);
					$('#password').val(response.data.password);
					$('#twitter_id').val(response.data.twitter_id);
					$('#facebook_id').val(response.data.facebook_id);
					$('#is_active').val(response.data.is_active);
					$('#deleted_at').val(response.data.deleted_at);
                    $('#main_form').attr('action', '/customers/customers/'+id);
                    $('#method').val('PUT');
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
                    $('#main_form').attr('action', '/customers/customers/'+id);
                    $('#method').val('DELETE');
                }
            });
            break;

    }
    $('#'+id).val('');
});
</script>
@endsection
