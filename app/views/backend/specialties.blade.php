@extends('backend.layouts.master')

@section('title')
@parent
:: Home
@stop
@section('headtitle')
专业管理
@stop
@section('content')

<div class="row"><table class="table table-bordered">
<thead>
<tr>
<th>院校名称</th>
<th>本科类别</th>
<th>本科专业名称</th>
<th>文理科</th>
<th>批次</th>
<th>专业特色</th>
<th>专业排名</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
@foreach ($specialties as $specialty)
<tr>
<td>{{ $specialty->college->name }}</td>
<td>{{ $specialty->bkleibie }}</td>
<td>{{ $specialty->name }}</td>
<td>{{ $specialty->wenlike }}</td>
<td>{{ $specialty->pici }}</td>
<td>{{ $specialty->teshe }}</td>
<td>{{ $specialty->paiming }}</td>
<td>
<a href="{{ URL::route('backend.specialties.edit', $specialty->scid ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
{{ Form::open(array('route' => array('backend.specialties.destroy', $specialty->scid ), 'method' => 'delete', 'data-confirm' => '确定删除？')) }}
<button type="submit" href="{{ URL::route('backend.specialties.destroy', $specialty->scid) }}" class="btn btn-danger btn-mini">删除</button>
{{ Form::close() }}
</td>
</tr>
@endforeach
</tbody>
</table>
{{ $specialties->links() }} 
                    <div class="col-lg-6">

                        <form role="form">
                            <div class="form-group">
                                <label>批量上传学校信息</label>
                                <input type="file">
                            </div>
                        </form>

                    </div>
                    <div class="col-lg-6">
                        <h1>Disabled Form States</h1>

                        <form role="form">
                            <div class="form-group input-group">
                                <input type="text" class="form-control">
                                <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="fa fa-search"></i></button></span>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->

@stop