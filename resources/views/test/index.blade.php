@extends('layouts.admin')
@section('title', __('global.menu.inventory.title'))
@section('content')
<div id="result" class="content-panel" style="background-color: #ffffff">
    <livewire:inventory-list/>
</div>

@endsection

