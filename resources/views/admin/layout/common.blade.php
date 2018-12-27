<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://onface.live/admin/admin.css" />
    <link rel="stylesheet" href="{{asset('/common/index.css')}}" />    
    @yield('header')
</head>
<body> 
	@include('admin.layout.header')  
	@include('admin.layout.menu')      
    @yield('content')    
	@include('admin.layout.footer')  
    <script src="https://onface.live/admin/admin-deps.js"></script>
    <script src="https://onface.live/admin/admin.js"></script>
    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
    </script>
    
    @yield('footer')
</body>
</html>
