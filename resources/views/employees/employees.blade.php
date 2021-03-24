@extends('layouts.admin')

@section('css')
<style>
    .list-group-item :hover {
        cursor: pointer;
    }
</style>
@endsection
@section('content')
<section class="employees panel-master-detail-layout"> 
    <div class="flex-container">
        <div class="employees-panel" id="listpanel">
            <span class="title">{{ __('employees.title') }}</span>
                <form action="{{ url('human-resource/employee-benefits') }}" method="get">
                    <div class="input-group input-group-sm mb-2">
                        <input type="text" class="form-control form-control-sm" name="search" placeholder="{{ __('global.search') }}" aria-label="Search" aria-describedby="basic-addon2" @if(isset($search)) value="{{$search}}" @endif>
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-sm" type="submit">
                            <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            <div class="list-group list-group-flush">
                @foreach ($data as $item)
                    <button type="button" class="list-group-item list-group-item-action" id="{{ $item->id}}">{{ $item->employee_code }} {{ $item->surname }} {{ $item->initials }}</button>
                @endforeach
            </div>
            {{ $data->render() }}
        </div>
        <div class="main-content flex-column">
            <div id="result" class=""></div>
        </div>
    </div>
</section>

@endsection
@section('scripts')
<script>

let month=4.334;
    $('.list-group-item').on('click', function(){
        $('.list-group-item').removeClass('active');
        $(this).addClass('active');
        let id = $(this).attr('id');
        getDetail(id);
    })
$(function(){
    $('#'+{{ $data[0]->id}}).addClass('active');
    getDetail({{ $data[0]->id}});
});
function getDetail(id)
{
    $.ajax({
        url:'/employees/employees/'+id,
        method:'GET',
        dataType:'html',
        success: function(response){
            $('#result').html(response);
        }
    });
}

</script>
@endsection
