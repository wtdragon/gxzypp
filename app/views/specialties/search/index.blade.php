@extends('master')
@section('header')
@stop
@section('content')
{{ Notification::showAll() }}
	<div class='col-md-2 text-center  slidbar_bg'>
		<h2>
			专业搜索
		</h2>
		<p class='p-wid'>九子高考志愿匹配网为您提供全面的专业数据库搜索功能，以便于您可以根据搜索结果，查询所需要的专业信息。</p>
			
	</div>
	<div class='col-md-7'>
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
</div>
	<div class='col-md-7'>
<h4>基本专业</h4>
<h4>特设专业</h4>
</div>
	<div class='col-md-7'>
<table class="table table-striped">
<thead>
<tr>
<th>专业名称</th>
<th>学科</th>
<th>门类</th>
<th>详情</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
@foreach ($schools as $school)
<tr>
<td>{{ $school->name }}</td>
<td>{{ $school->xueke }}</td>
<td>{{ $school->menlei }}</td>
<td><a href="{{ URL::route('specialties.search.show', $school->scid) }}">查看</a></td>
</tr>
@endforeach
</tbody>
</table>
{{ $schools->links() }}  
</div>
<div class='col-md-3'>
		@include('ads')
	</div>
@stop
@section('bootor')
@stop