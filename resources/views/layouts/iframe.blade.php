<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Attela</title>
    <link rel="stylesheet" href="{{ asset('icons/bootstrap-icons.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{asset('vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}" rel="stylesheet" />
    <link href="{{asset('vendors/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}?<?php echo md5(time())?>" rel="stylesheet" />
    @yield('css')
</head>
<body style="background-color: white; height: 85vh" class="ms-2 me-2">
@yield('content')
<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendors/jquery/dist/popper.min.js') }}"></script>
<script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{asset('vendors/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('vendors/moment.min.js')}}"></script>
<script src="{{asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('vendors/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
<script src="{{ asset('js/accounting.min.js') }}"></script>
{{-- <script src="{{ asset('js/jbvalidator.min.js') }}"></script> --}}
<script src="{{ asset('js/main.js') }}"></script>
<script>
    let add='{{ __('global.add_new_record') }}';
let update='{{ __('global.update') }}';
    @if(session()->get('success'))
//https://sweetalert.js.org/guides/
Swal.fire({
    position: 'top-end',
    toast: true,
    title:'{!! session()->get('success') !!}',
    text:"",
    icon: 'success',
    showConfirmButton: false,
    timer: 1500
});
@endif
@if(session()->get('error'))
Swal.fire({
    position: 'top-end',
    toast: true,
    title:'{!! session()->get('error') !!}',
    text:"",
    icon: "error",
    showConfirmButton: false,
    timer: 1500
});
@endif
</script>
@yield('scripts')
</body>
</html>
