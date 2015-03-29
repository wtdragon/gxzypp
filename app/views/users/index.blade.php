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
        <li><a href="{{URL::to('users/matches')}}" class="btn btn-default btn1" type="button">院校列表</a></li>
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
                                   <a课程收藏</a>
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
		<h2>
			会员名称：
		</h2>
		<p>会员信息：</p>
		姓名：
		学号：<p>{{$user->stuname}}</p> 
		所在地：
		偏好：  <p>{{$user->stuno}}</p> 
		  <div class="panel-body">
          
        
@if ($kresult === "你还没做过测试" )
    <p> {{ $kresult }}</p>
@else
   <p>根据您做的测试，以下为您的测试结果：</p>
  <iframe style="width: 800px; height: 600px;"
            src="<?php echo $kresult ?>"
            frameBorder="0">
            
          </iframe>
@endif
 

       </div>
            </div>
<div class='col-md-3'>
	 <a href="{{ $kurl }}" class="btn btn-default btn1" type="button">职业测试</a> 
	</div>
@stop
@section('bootor')
@stop