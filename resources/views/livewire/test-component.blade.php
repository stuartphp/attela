@extends('layouts.admin')
@section('title', __('global.menu.inventory.title'))
@section('css')
<link href="/vendors/summernote/summernote-lite.css" rel="stylesheet">
@endsection
@section('content')

<div id="loadImg"><img src="/images/ajax-loader.gif" width="100px"/></div>
<div id="result" class="content-panel" style="background-color: #ffffff">
    <a href="#" onclick="openNav()"><i class="bi bi-list"></i></a>
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
    <livewire:inventory.inventory-list/>
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

    function getDetail(id)
    {
        $('#loadImg').show();
        closeNav();
        $('.list-group-item').removeClass('active');
        $('#I'+id).addClass('active');
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
@extends('layouts.admin')
@section('title', __('global.menu.inventory.title'))
@section('css')
<link href="/vendors/summernote/summernote-lite.css" rel="stylesheet">
@endsection
@section('content')

<div id="loadImg"><img src="/images/ajax-loader.gif" width="100px"/></div>
<div id="result" class="content-panel" style="background-color: #ffffff">
    <a href="#" onclick="openNav()"><i class="bi bi-list"></i></a>
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
    <livewire:inventory.inventory-list/>
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

    function getDetail(id)
    {
        $('#loadImg').show();
        closeNav();
        $('.list-group-item').removeClass('active');
        $('#I'+id).addClass('active');
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
