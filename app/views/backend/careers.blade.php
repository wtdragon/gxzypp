@extends('backend.layouts.master')

@section('title')
@parent
:: Home
@stop
@section('headtitle')
职业管理
@stop
@section('content')
{{ Notification::showAll() }}
                <div class="row">
                	<table class="table table-bordered">
<thead>
<tr>
<th>城市</th>
<th>职业名称</th>
<th>收入水平</th>
<th>工作经验统计</th>
<th>历年工作变化</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
@foreach ($careersalays as $careersalay)
<tr>
	

<td>{{ $careersalay->chengshi}}</td>
<td>{{ $careersalay->zhiye}}</td> 
<td>{{ $careersalay->srsptu}}</td> 
<td>{{ $careersalay->gzjygztj}}</td>
<td>{{ $careersalay->lngzbh}}</td>
<td>
<a href="{{ URL::route('backend.careers.edit', $careersalay->id ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
{{ Form::open(array('route' => array('backend.careers.destroy', $careersalay->id ), 'method' => 'delete', 'data-confirm' => '确定删除？')) }}
<button type="submit" href="{{ URL::route('backend.careers.destroy', $careersalay->id) }}" class="btn btn-danger btn-mini">删除</button>
{{ Form::close() }}
</td>
</tr>
@endforeach
</tbody>
</table>
{{ $careersalays->links() }} 
       	   
     
                </div>
                <!-- /.row -->

@stop