@extends('layouts.admin')
@section('title', __('global.menu.employees.title'))
@section('css')

@endsection
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
    <livewire:employees.employee-list/>
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
let month=4.334;
let hours_pd = 0;
let days_pw = 0;
let days_per_bw = 0;
let cal_days_pm = 0;
let cal_hours_pw =0;
let cal_hours_bw = 0;
let cal_hours_pm = 0;
let pay_periods = 12;
let salary = 0;
let fixed_salary = 0;
let rate_pd = 0;
let rate_ph = 0;

let working_days_per_year = ((month*12)*days_pw).toFixed(0);
$(function(){
    $('#loadImg').hide();
        openNav();
});

function getDetail(id)
{
    $('#loadImg').show();
    closeNav();
    $('.list-group-item').removeClass('active');
    $('#E'+id).addClass('active');
    $.ajax({
        url:'/human-resource/employees/'+id,
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
        url:'/human-resource/employees/create',
        method:'GET',
        dataType:'html',
        success: function(response){
            $('#result').html(response);
        }
    });
})
</script>
@endsection
