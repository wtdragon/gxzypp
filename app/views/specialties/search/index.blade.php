@extends('master')
@section('header')

@stop
@section('content')
{{ Notification::showAll() }}
	<div class='col-md-2 text-center  slidbar_bg'>
		<h3 class="acolor">
			专业搜索
		</h3>
		<p class='t1'>九子高考志愿匹配网为您提供全面的专业数据库搜索功能，以便于您可以根据搜索结果，查询所需要的专业信息。</p>
			
	</div>
	<div class='col-md-7 bottom top'>
     <div class="input-group">
       <span class="input-group-btn">
{{ Form::open(array('route' => array('PostSpecialtiysearch','method' => 'post'))) }}
      	     <div class="col-xs-2">
        <button type="submit" class="btn btn-default" type="button">专业搜索</button>
        </div>
      </span>
       <div class="col-xs-9">
      {{Form::text('specialty', null, array('class'=>'fc_search form-control','placeholder'=>'专业搜索'))}}
      </div>
    </div><!-- /input-group -->
{{ Form::close() }}
<div class='row top bottom marginlr'>
<p>
	<div class="btn-group">
  <button class="btn btn-large btn-primary" type="button">本科专业列表</button>
  <button class="btn btn-large" type="button">专科专业列表</button>
 </div>
</p>
<ul class="list-inline">
    <li><a href="#a1" class="h6">哲学</a></li>
    <li><a href="#a2" class="h6">经济学</a></li>
    <li><a href="#a3" class="h6">法学</a></li>
    <li><a href="#a4" class="h6">教育学</a></li>
    <li><a href="#a5" class="h6">文学</a></li>
    <li><a href="#a6" class="h6">历史学</a></li>
    <li><a href="#a7" class="h6" >理学</a></li>
    <li><a href="#a8" class="h6">工学</a></li>
    <li><a href="#a9" class="h6">农学</a></li>
    <li><a href="#a10" class="h6">医学</a></li>
    <li><a href="#a11" class="h6">管理学</a></li>
    <li class="last"><a href="#a12" class="h6">艺术学</a></li>
  </ul>
</div>
<table class="table table-striped">
<thead>
<tr>
<th>专业名称</th>
<th>院校</th>
<th>科类</th>
<th>层次</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
@foreach ($schools as $school)
<tr>
<td>{{ $school->zymingcheng }}</td>
<td>{{ $school->yxmc }}</td>
<td>{{ $school->kelei }}</td>
<td>{{ $school->cengci }}</td>
</tr>
@endforeach
</tbody>
</table>
{{ $schools->links() }}  
</div>
<div class='col-md-3'>
	<div class='row top bottom'>
		@include('ads')
	</div>
	</div>
@stop


@section('bootor')
	@include('script')
@stop