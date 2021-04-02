@extends('layouts.admin')
@section('title', __('global.menu.documents.title'))
@section('content')
<div class="mt-2" >
    @livewire('documents.document-edit', ['doc_id' => $id])
</div>

@endsection
