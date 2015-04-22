@extends('master')
@section('hdsrc')
<link href={{ URL::asset('images/css/sb-admin-2.css') }} rel="stylesheet">
<link href={{ URL::asset('images/css/timeline.css') }} rel="stylesheet">
<script type="text/javascript" src={{ URL::asset('images/metisMenu/dist/metisMenu.js') }}></script>
<script type="text/javascript" src={{ URL::asset('images/js/sb-admin-2.js') }}></script>
<script type="text/javascript" src={{ URL::asset('images/js/dropzone.js') }}></script>
@stop
@section('header')
@stop
@section('content')
{{ Notification::showAll() }}
<div class='col-md-2 text-center  slidbar_bg'>
 	@include('gxadmin.slidbar')
</div>
	<div class='col-md-7 text-center'>
		<h3>管理中心</h3>
		<h4>班级列表</h4>
	<table class="table table-striped">
<thead>
<tr>
<th>班级</th>
<th>人数</th>
<th>负责老师</th>
<th>备注</th>
<th><i class="icon-cog">管理</i></th>
</tr>
</thead>
<tbody>
@foreach ($classes as $class)
<tr>
<td>{{ $class->classname }}</td>
<td>{{ $class->stucount }}</td>
<td>{{ $class->teacher->teachername }}</td>
<td>{{ $class->other }}</td>
<td>
<a href="{{ URL::route('gxadmin.classes.edit', $class->id ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
{{ Form::open(array('route' => array('gxadmin.classes.destroy', $class->id ), 'method' => 'delete', 'data-confirm' => '确定删除？')) }}
<button type="submit" href="{{ URL::route('gxadmin.classes.destroy', $class->id) }}" class="btn btn-danger btn-mini">删除</button>
{{ Form::close() }}
</td>
</tr>
@endforeach
</tbody>
</table>
 <h3>新增班级</h3>
@if ($errors->any())
<div class="alert alert-error">
{{ implode('<br>', $errors->all()) }}
</div>
@endif
 {{ Form::open(array('route' => array('Classestore','method' => 'post'))) }}
<div class="control-group">
{{ Form::label('classname', '班级名称') }}
{{ Form::text('classname') }}
{{ Form::label('other', '班级备注') }}
{{ Form::text('other') }}
</div>
<div class="form-actions">
{{ Form::submit('新增', array('class' => 'btn btn-success btn-save btn-large')) }}
<a href="{{ URL::route('gxadmin.classes.index') }}" class="btn btn-large">取消</a>
</div>
{{ Form::close() }}
	</div>
@stop
@section('bootor')
@stop