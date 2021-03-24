@extends('layouts.admin')
@section('title', __('global.menu.inventory.title'))
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
    <livewire:payroll-list/>
</div>

@endsection
@section('scripts')
<script type="text/javascript" src="/vendors/summernote/summernote-lite.js"></script>
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
    // $('.list-group-item').on('click', function(){
    //     alert($(this).attr('id'));
    //     $('#loadImg').toggle();
    //     closeNav();
    //     $('.list-group-item').removeClass('active');
    //     $(this).addClass('active');
    //     let id = $(this).attr('id').substring(1);
    //     getDetail(id);
    // })

    function getDetail(id)
    {
        closeNav();
        $('.list-group-item').removeClass('active');
        $('#I'+id).addClass('active');
        $('#loadImg').show();
        $.ajax({
            url:'/inventory/items/'+id,
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
            url:'/inventory/items/create',
            method:'GET',
            dataType:'html',
            success: function(response){
                $('#result').html(response);
            }
        });
    })


</script>
@endsection