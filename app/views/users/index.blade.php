@extends('master')
@section('hdsrc')
<link href={{ URL::asset('images/css/sb-admin-2.css') }} rel="stylesheet">
<link href={{ URL::asset('images/css/timeline.css') }} rel="stylesheet">
<script type="text/javascript" src={{ URL::asset('images/metisMenu/dist/metisMenu.js') }}></script>
<script type="text/javascript" src={{ URL::asset('images/js/sb-admin-2.js') }}></script>

@stop
@section('header')
@stop
@section('content')
{{ Notification::showAll() }}
	<div class='col-md-2 text-center  slidbar_bg'>
		<div class="sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
        <li><a href="{{URL::to('users')}}" class="btn btn-default btn1" type="button">我的测评</a></li>
        <li><a href="{{URL::to('users/specialties')}}" class="btn btn-default btn1" type="button">专业列表</a></li>
        <li><a href="{{URL::to('users/matches')}}" class="btn btn-default btn1" type="button">志愿匹配</a></li>
	       <li>
                <a href="{{URL::to('users/collects')}}" class="btn btn-default btn1" type="button">我的收藏</a>
               <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('users/collects/colleges')}}" >院校收藏</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('users/collects/specialites')}}">专业收藏</a>
                                </li>
                                <li>
                                   <a href="{{URL::to('users/collects/training')}}" >课程收藏</a>
                                </li>
                                <li>
                                   <a href="{{URL::to('users/collects/others')}}" >其他收藏</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
      </ul>
	</div>
	</div>
	</div>
	<div class='col-md-7'>
		<h2>
			会员中心
		</h2>
    </div>
    <div class='col-md-7'>
		<h2>
			会员名称：
		</h2>
		<p>会员信息：</p>
		姓名：
		学号：<p>{{$user->xuehao}}</p> 
		所在地：
		偏好：  <p>{{$user->xihao}}</p> 
		  <div class="panel-body">
          <p>根据您做的测试，以下为您的测试结果：</p>
  
 


          <p>专业结果：</p>
          @foreach ($zhuanye as $zhuanye)
<a>{{ $zhuanye }}</a>
@endforeach
    <p>适合职业：</p>
            @foreach ($zhiye as $zhiye)
<a>{{ $zhiye }}</a>
@endforeach
       </div>
            </div>
<div class='col-md-3'>
	 <a href="{{ $kurl }}" class="btn btn-default btn1" type="button">职业测试</a> 
	</div>
@stop
@section('bootor')
@stop