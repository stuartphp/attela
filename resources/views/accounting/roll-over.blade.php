@extends('layouts.admin')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">

    </div>
    <div class="card-body">
        {!! __('roll_over.before') !!}
    </div>
    <div class="modal-footer">
        <input type="submit" class="btn btn-primary btn-sm" value="{{ __('global.save') }}">
    </div>
</div>
@endsection
