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
		<nav class="navbar navbar-default btn-group1" role="navigation">
		 <ul class="nav navbar-nav">
		 <li><a href="" class="hb">年级管理</a></li> 
		 <li><a href="" class="hb">班级管理</a></li>
		 <li><a href="" class="hb">教师管理</a></li>
		<li><a class='hb'>历史记录</a></li>
		<li><a class='hb'>回到首页</a></li>
		</ul>
		</nav>
		@overwrite
	</div>
@section('content')
{{ Notification::showAll() }}
<div class='col-md-2 text-center  slidbar_bg'>
  <div class="sidebar" role="navigation">
    <ul class="nav nav-pills nav-stacked">
    	 <li><a href="">管理中心首页</a></li>
     <li><a href="">年级管理</a></li>
    
     <li><a href="{{URL::to('gxadmin/classes')}}" >班级管理</a></li>
       <li> <a href="{{URL::to('gxadmin/students')}}">教师管理</a></li>
       <li> <a href="{{URL::to('gxadmin/students')}}">历史记录</a>  </li>   
     </ul>
  </div>
	</div>
<div class='col-md-7 text-center'>
 <h3>管理中心</h3>
		<h4>年级列表</h4>
		<table class="table table-striped">
<thead>
<tr>
<th>年级</th>
<th>年级人数</th>
<th>备注</th>
</tr>
</thead>
<tbody>
@foreach ($class_tongjis as $class_tongji)
<tr>
<td>{{ $class_tongji->classname }}</td>
<td>{{ $class_tongji->stucount }}</td>
<td></td>
</tr>
@endforeach
</tbody>
</table>

		<h4>班级列表</h4>
	<table class="table table-striped">
<thead>
<tr>
<th>班级名称</th>
<th>班级人数</th>
<th>备注</th>
</tr>
</thead>
<tbody>
@foreach ($students as $student)
<tr>
<td>{{ $student->stuname }}</td>
<td>{{ $student->stuno }}</td>
<td></td>
</tr>
@endforeach
</tbody>
</table>


<h4>教师列表</h4>
<table class="table table-striped">
<thead>
<tr>
<th>教师姓名</th>
<th>邮箱地址</th>
<th>联系方式</th>
</tr>
</thead>
<tbody>
@foreach ($students as $student)
<tr>
<td>{{ $student->stuname }}</td>
<td>{{ $student->stuno }}</td>
<td></td>
</tr>
@endforeach
</tbody>
</table>
	</div>
@stop
@section('bootor')
@stop