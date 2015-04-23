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
		<div class="row top bottom marginlr">
		<h2>
			会员中心
		</h2>
		<p>
			用户名：
		</p>
		<p>会员信息：</p>
		
		 
        <h4>根据您的测评结果，我们为您推荐以下院校：</h4>
        	<div class="row top bottom  marginlr">
        <a>本科院校</a>   <a>专科院校</a>  <a>全部</a> 
        </div>
        <div class='row top bottom bottom-border marginlr'>
      @foreach ($ktests as $ktest)
        <a href="{{ URL::route('Specfilter',$ktest->co_id) }}">
         {{ $ktest->colleges->name }}
         </a>
         @endforeach
        </div>
          </div>
         <div class='row top bottom bottom-border marginlr'>
        <h4>
		  {{ $ktest1st->colleges->name }}
		  <div class='row top bottom  marginlr'>
		  	<div class='col-md-4'>
		  	<h5>所属地区:{{ $ktest1st->colleges->province->pname }}</h5>
		  	</div>
		  	<div class='col-md-4'>
		  	<h5>所属科类:{{ $ktest1st->colleges->kelei}}</h5>
		  	</div>
		  	<div class='col-md-4'>
		  	<h5><a>添加收藏</a></h5>
		  	</div>
		  </div>
		</h4> 
		</div>
<table class="table table-striped">
<thead>
<tr>
<th>专业名称</th>
<th>科类</th>
<th>招生批次</th>
<th>学制</th>
</tr>
</thead>
<tbody>
@foreach ($zylbs as $zylb)
<tr>
<td>{{ $zylb->zymingcheng }}</td>
<td>{{ $zylb->kelei }}</td>
<td>{{ $zylb->pici }}</td>
<td>{{ $zylb->xuezhi }}</td>
</tr>
@endforeach
</tbody>
</table>
{{ $zylbs->links() }}  
            </div>
<div class='col-md-3'>
		@include('ads')
	</div>
@stop
@section('bootor')
@stop