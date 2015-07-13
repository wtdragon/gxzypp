@extends('backend.layouts.master')

@section('title')
@parent
:: Home
@stop
@section('headtitle')
专业介绍评论管理
@stop
@section('content')
{{ Notification::showAll() }}
                <div class="row">
                	<table class="table table-bordered">
<thead>
<tr>
<th>专业名称</th>
<th>专业介绍</th>
<th>专业评论</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
@foreach ($zyjss as $zyjs)
<tr>
	

<td>{{ $zyjs->zymc}}</td>
<td>{{ $zyjs->zyjs}}</td> 
<td>{{ $zyjs->zypl}}</td> 
<td>
<a href="{{ URL::route('backend.zyjs.edit', $zyjs->id ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
{{ Form::open(array('route' => array('backend.zyjs.destroy', $zyjs->id ), 'method' => 'delete', 'data-confirm' => '确定删除？')) }}
<button type="submit" href="{{ URL::route('backend.zyjs.destroy', $zyjs->id) }}" class="btn btn-danger btn-mini">删除</button>
{{ Form::close() }}
</td>
</tr>
@endforeach
</tbody>
</table>
{{ $zyjss->links() }} 
       	   
     
                </div>
                <!-- /.row -->

@stop