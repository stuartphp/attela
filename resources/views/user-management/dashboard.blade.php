@extends('layouts.admin')
@section('title' , __('global.menu.users.title'))

@section('content')
<div class="app-menu"><!-- react-text: 232 --><!-- /react-text -->

        <span class="">
        <a class="app-link hvr-bob" href="{{ route('users.index') }}">
            <button type="button" class="app-button" id="items" data-toggle="tooltip" title="{{trans('users.title')}}">
                <div class="app-button-img">
                    <i class="bi bi-people"></i>
                </div>
            </button>
        </a>
    </span>
        <span class="">
        <a class="app-link hvr-bob" onclick="loadData('roles')">
            <button type="button" class="app-button" data-toggle="tooltip" title="{{trans('roles.title')}}">
                <div class="app-button-img">
                    <i class="bi bi-list"></i>
                </div>
            </button>
        </a>
    </span>
        <span class="">
        <a class="app-link hvr-bob" onclick="loadData('permissions')">
            <button type="button" class="app-button" data-toggle="tooltip" title="{{trans('permissions.title')}}">
                <div class="app-button-img">
                    <i class="bi bi-paperclip"></i>
                </div>
            </button>
        </a>
    </span>

</div>

<div class="container-fluid">
    <div id="result">

    </div>
</div>
@endsection
@section('scripts')
<script>
    function sendInvite()
    {
        $('#formModal').modal('show');
    }
    $('.app-button').click(function (event) {
        $('.app-link .hovered').removeClass('hovered');
        $(this).addClass('hovered');
        $('#result').html('<div class="text-center"> <img src="/images/ajax-loader.gif"/></div>');
    });
    function loadData(v) {
        $('#result').load('/user-management/'+v);
    }
</script>
@endsection

