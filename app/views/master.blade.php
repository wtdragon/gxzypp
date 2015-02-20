<!DOCTYPE html>
<html lang="en">
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
</head>

<body>
<div class="container">
	
	<div class="row clearfix header-row">
		<div class="col-md-2 column c1">
		</div>
		<div class="col-md-6 column">
		</div>
		<div class="col-md-4 column c1">
			<div class="bg2">
				 <a href="{{URL::to('/')}}"  class="btn btn-default" type="button">首页</a> 
				@if(App::make('authenticator')->getLoggedUser())
    <a href="{{URL::to('users')}}" class="btn btn-default" type="button">用户中心</a> 
@else
   <a href="{{URL::to('login')}}" class="btn btn-default" type="button">注册登录</a> 
@endif
				<a href="/about" class="btn btn-default" type="button">关于我们</a> {{{ date("Y年m月d") }}} 
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-md-2 column c1">
			<img alt="200x30" src={{ URL::asset('images/img/logo.png') }}>
		</div>
		<div class="col-md-6 column">
		</div>
		<div class="col-md-4 column">
			<div class="btn-group btn-group1">
				<a href="{{URL::to('matches')}}" class="btn btn-default" type="button">志愿匹配</a> <a href="/colleges"  class="btn btn-default" type="button">院校搜索</a> <a href="/specialties "  class="btn btn-default" type="button">专业搜索</a> <a href="/trainings" class="btn btn-default" type="button">培训信息</a>
			</div>
		</div>
		@yield('header')
	</div>

	<div class="row clearfix">
		@yield('content')
	</div>

	<div class="row clearfix b1">
		<div class="col-md-6 column">
			 <address> <strong>北京九子国际文化传播</strong><br>有限公司<br> 版权所有<br> <abbr title="Phone">京ICP证:</abbr> 1234567890号 </address>
		</div>
		<div class="col-md-6 column">
			<div class="btn-group">
				 <img alt="231x31" src={{ URL::asset('images/img/share.png') }}>	</div>
		</div>
	</div>
	@yield('bootor')
</div>
</body>
</html>
