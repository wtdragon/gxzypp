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
		<h4>
			会员名称：
		</h4>
		<p>会员信息：</p>
		
		 
        <p>根据您的测评结果，我们为您推荐以下院校：</p>
      @foreach ($ktests as $ktest)
         <a href="#">
         {{ $ktest->colleges->yxmc }}
         </a>
         @endforeach
         <div class='row top bottom bottom-border'>
        <h4>
		  {{ $ktest1st->colleges->yxmc }}
		</h4> 
		</div>
<table class="table table-striped">
<thead>
<tr>
<th>专业名称</th>
<th>科类</th>
<th>招生批次</th>
<th>学制</th>
<th>收藏</th>
</tr>
</thead>
<tbody>
@foreach ($zylbs as $zylb)
<tr>
<td>{{ $zylb->zymingcheng }}</td>
<td>{{ $zylb->kelei }}</td>
<td>{{ $zylb->pici }}</td>
<td>{{ $zylb->xuezhi }}</td>
<td><a href="{{ URL::route('specialties.search.show', $zylb->id) }}">添加</a></td>
</tr>
@endforeach
</tbody>
</table>
            </div>
<div class='col-md-3'>
		@include('ads')
	</div>
@stop
@section('bootor')
@stop