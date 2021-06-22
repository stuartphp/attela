@extends('layouts.admin')
@section('title',  __('global.menu.inventory.title'))
@section('content')
@livewire('inventory.inventory-detail')
@endsection
@section('scripts')
<script>
    function openNav() {
        document.getElementById("mySidenav").style.width = ""+sideMenu+"px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
    window.addEventListener('modal', event=>{
        $('#'+event.detail.modal).modal(event.detail.action);
    })
</script>
@endsection
