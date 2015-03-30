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
                                   <a>课程收藏</a>
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
		<p>根据您的测评结果，我们为您推荐以下专业：</p>
		@foreach ($ktests as $ktest)
         <a href="#">
         {{ $ktest->zymc }}
         </a>
         @endforeach
         <div class='row top bottom bottom-border'>
        <h4>
		  {{ $ktest1st->zymc }}
		</h4> 
		</div>
<table class="table table-striped">
<thead>
<tr>
<th>开设院校</th>
<th>科类</th>
<th>招生批次</th>
<th>学制</th>
<th>平均分</th>
<th>详情</th>
</tr>
</thead>
<tbody>
@foreach ($colleges as $college)
<tr>
<td>{{ $college->yxmc }}</td>
<td>{{ $college->kelei }}</td>
<td>{{ $college->pici }}</td>
<td>{{ $college->xuezhi }}</td>
<td>{{ $college->kelei }}</td>
<td><a href="{{ URL::route('specialties.search.show', $college->id) }}">查看</a></td>
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