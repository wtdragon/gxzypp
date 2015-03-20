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
  <div class="sidebar" role="navigation">
      <div class="sidebar-nav navbar-collapse">
         <ul class="nav" id="side-menu">
          <li>
            <a href="{{URL::to('users/collects')}}" class="btn btn-default btn1" type="button">学生班级管理</a>
            <ul class="nav nav-second-level">
              <li> <a href="{{URL::to('gxadmin/classes')}}" >班级管理</a>
                </li>
                <li>
                 <a href="{{URL::to('gxadmin/students')}}">学生管理</a>
                  </li>
              </ul>
               </li>
      </ul>
	</div>
	</div>
	</div>
	<div class='col-md-7 text-center'>
		<h3>管理的班级</h3>
	<table class="table table-striped">
<thead>
<tr>
<th>学生班级</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
@foreach ($classes as $class)
<tr>
<td>{{ $class->classname }}</td>
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