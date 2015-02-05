<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>高校信息</title>
<link rel="stylesheet" href="{{asset('images/css/bootstrap.min.css')}}">
</head>
<body>
<div class="container">
<div class="page-header">
@yield('header')
</div>
@if(Session::has('message'))
<div class="alert alert-success">
{{Session::get('message')}}
</div>
@endif
@yield('content')
</div>
</body>
</html>