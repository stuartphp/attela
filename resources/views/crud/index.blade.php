@extends('layouts.admin')
@section('content')
<div class="card">
<form action="/crud/generate" method="post">
    @csrf
    <div class="card-body">
    <div class="form-group row">
        <label class="col-md-2">Directory</label>
        <div class="col-md-3"><input type="text" class="form-control" name="directory"/></div>
    </div>
<div class="form-group row">
    <label class="col-md-2">Table</label>
    <div class="col-md-3"><select class="form-control" name="table">
        <option value="">--Select--</option>
    @foreach ($data as $table)
        @foreach ($table as $k=>$v)
            <option value="{{ $v }}">{{ $v }}</option>
        @endforeach
    @endforeach
    </select>
</div>
<div><input type="submit"></div>
</div>
</form></div>
@endsection


