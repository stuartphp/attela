@extends('layouts.admin')
@section('title', __('global.menu.employees.title'))
@section('content')
<div class="card shadow mb-4">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">{{ __('global.menu.employees.title') }} / <a href="/human-resource/employee-benefits">Employee Benefits</a></div>
            <div class="col-md-6 text-right">
                @if(count(array_intersect(session()->get('grant'), ['SU', 'employee_benefits_create']))==1)
                <a href="#"><i id="create_record" class="bi bi-plus fa-1x"></i></a>
                @endif
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="{{ url('human-resource/employee-benefits') }}" method="get">
                    <div class="input-group">
                    <input type="text" class="form-control form-control-sm" name="search" placeholder="{{ __('global.search') }}" aria-label="Search" aria-describedby="basic-addon2" @if(isset($search)) value="{{$search}}" @endif>
                    <div class="input-group-append">
                        <button class="btn btn-primary btn-sm" type="submit">
                        <i class="bi bi-search"></i>
                        </button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <div class="list-group">
                @foreach ($data as $item)
                    <button type="button" class="list-group-item list-group-item-action" id="{{ $item->id }}">{{ $item->surname.' '.$item->initials.' ('.$item->first_name.')'}}</button>
                @endforeach
                </div>
            </div>
            <div class="col-md-10">
                <div class="row">
                    
                </div>
            </div>
        </div>
    </div>
  </div>

@endsection
@section('scripts')
<script>
$('.list-group-item').on('click',function(){
    $('.list-group-item').removeClass('active');
    $(this).addClass('active');
    alert($(this).attr('id'));
})
</script>
@endsection
