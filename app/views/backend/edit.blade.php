@extends('backend.layouts.master')

@section('title')
@parent
:: Home
@stop
@section('headtitle')

@stop
@section('content')

<div class="row">
@if($college)
<table class="table table-bordered">
<thead>
<tr>
<th>院校名称</th>
<th>院校排名</th>
<th>所在地区</th>
<th>985</th>
<th>211</th>
<th>院校隶属</th>
<th>院校举办</th>
<th>办学类型</th>
<th>院校科类</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>

<tr>
<td>{{ $college->name }}</td>
<td>{{ $college->paiming }}</td>
<td>{{ $college->province->pname }}</td>
<td>{{ $college->is985 }}</td>
<td>{{ $college->is211 }}</td>
<td>{{ $college->lishu }}</td>
<td>{{ $college->juban }}</td>
<td>{{ $college->leixing }}</td>
<td>{{ $college->kelei }}</td>
<td>
<a href="{{ URL::route('backend.colleges.edit', $college->coid ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
{{ Form::open(array('route' => array('backend.colleges.destroy', $college->id ), 'method' => 'delete', 'data-confirm' => '确定删除？')) }}
<button type="submit" href="{{ URL::route('backend.colleges.destroy', $college->id) }}" class="btn btn-danger btn-mini">删除</button>
{{ Form::close() }}
</td>
</tr>
</tbody>
</table>



@elseif($specialty)

<td>{{ $specialty->college->name }}</td>
<td>{{ $specialty->bkleibie }}</td>
<td>{{ $specialty->name }}</td>
<td>{{ $specialty->wenlike }}</td>
<td>{{ $specialty->pici }}</td>
<td>{{ $specialty->teshe }}</td>
<td>{{ $specialty->paiming }}</td>




@elseif($carticle) 
{
	 carticle 
}


@elseif($mschool) 
	<div class='col-md-7 text-center'>
 <h3>修改受管理学校</h3>
@if ($errors->any())
<div class="alert alert-error">
{{ implode('<br>', $errors->all()) }}
</div>
@endif
 {{ Form::model($mschool, array('method' => 'put', 'route' => array('backend.mschools.update', $mschool->id))) }}
<div class="control-group">
{{ Form::label('schoolname', '修改学校名称') }}
{{ Form::text('schoolname') }}
{{ Form::label('teachername', '修改管理员名称') }}
{{ Form::text('teachername') }}
</div>
<div class="form-actions">
{{ Form::submit('更新', array('class' => 'btn btn-success btn-save btn-large')) }}
<a href="{{ URL::route('backend.mschools.index') }}" class="btn btn-large">取消</a>
</div>
{{ Form::close() }}
	</div>

@else


		<div class='col-md-7 text-center'>
 <h3>修改受学生ktest数据</h3>
@if ($errors->any())
<div class="alert alert-error">
{{ implode('<br>', $errors->all()) }}
</div>
@endif
 {{ Form::model($ktests, array('method' => 'put', 'route' => array('backend.ktests.update', $ktests->id))) }}
<div class="control-group">
{{ Form::label('学生姓名:') }}{{ $ktests->student->stuname }}
{{ Form::label('collegename', '修改学校') }}
{{ Form::text('collegename') }}
{{ Form::label('zymc', '修改专业') }}
{{ Form::text('zymc') }}
</div>
<div class="form-actions">
{{ Form::submit('更新', array('class' => 'btn btn-success btn-save btn-large')) }}
<a href="{{ URL::route('backend.ktests.index') }}" class="btn btn-large">取消</a>
</div>
{{ Form::close() }}
	</div>
@endif
</div>
                <!-- /.row -->

@stop