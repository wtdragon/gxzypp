@extends('master')
<head>
  <meta charset="utf-8">
  <title>九子高考志愿匹配网</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="为您提供全面，专业的数据库搜索功能，根据搜索结果查询专业信息">
  <meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="images/js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href={{ URL::asset('images/css/bootstrap.min.css') }} rel="stylesheet">
	<link href={{ URL::asset('images/css/style.css') }} rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="images/js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="images/img/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="images/img/favicon.png">
  
	<script type="text/javascript" src={{ URL::asset('images/js/jquery.min.js') }}></script>
	<script type="text/javascript" src={{ URL::asset('images/js/bootstrap.min.js') }}></script>
	<script type="text/javascript" src={{ URL::asset('images/js/scripts.js') }}></script>
 

<link href={{ URL::asset('images/css/sb-admin-2.css') }} rel="stylesheet">
<link href={{ URL::asset('images/css/timeline.css') }} rel="stylesheet">
<script type="text/javascript" src={{ URL::asset('images/metisMenu/dist/metisMenu.js') }}></script>
<script type="text/javascript" src={{ URL::asset('images/js/sb-admin-2.js') }}></script>
</head>
		
		@section('header.nav')	 
		@include('gxadmin.headnav')
		@overwrite
	</div>
@section('content')
{{ Notification::showAll() }}
<div class='col-md-2 text-center  slidbar_bg'>
 	@include('gxadmin.slidbar')
</div>
<div class='col-md-7 text-center'>
    <h3>管理中心</h3>
	<h4>年级列表</h4>
<table class="table table-striped">
    <thead>
    <tr>
    <th>年级</th>
    <th>年级人数</th>
    <th>年级管理</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($grades as $grade)
     <tr>
     <td>{{ $grade->gradename }}</td>
     <td>{{ $grade->stucount }}</td>
     <td>
       <a href="{{ URL::route('gxadmin.grades.edit', $grade->id ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
        {{ Form::open(array('route' => array('gxadmin.grades.destroy', $grade->id ), 'method' => 'delete', 'data-confirm' => '确定删除？')) }}
        <button type="submit" href="{{ URL::route('gxadmin.grades.destroy', $grade->id) }}" class="btn btn-danger btn-mini">删除</button>
        {{ Form::close() }}
    </td>
    </tr>
    @endforeach
    </tbody>
 </table>
 <h3>新增年级</h3>
@if ($errors->any())
<div class="alert alert-error">
{{ implode('<br>', $errors->all()) }}
</div>
@endif
 {{ Form::open(array('route' => array('Gradestore','method' => 'post'))) }}
<div class="control-group">
{{ Form::label('gradename', '年级名称') }}
{{ Form::text('gradename') }}
{{ Form::label('stucount', '年级人数') }}
{{ Form::text('stucount') }}
</div>
<div class="form-actions bottom">
{{ Form::submit('新增', array('class' => 'btn btn-success btn-save btn-large')) }}
<a href="{{ URL::route('gxadmin.classes.index') }}" class="btn btn-large">取消</a>
</div>
{{ Form::close() }}
</div>
@stop
@section('bootor')
@stop