@extends('backend.layouts.master')

@section('title')
@parent
:: Home
@stop
@section('headtitle')
登录学校管理
@stop
@section('content')

                <div class="row">
                	<table class="table table-bordered">
<thead>
<tr>
<th>院校名称</th>
<th>院校排名</th>
<th>院校举办</th>
<th>办学类型</th>
<th>院校科类</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
@foreach ($ktests as $ktest)
<tr>
<td>{{ $ktest->name }}</td>
<td>{{ $ktest->paiming }}</td>
<td>
<a href="{{ URL::route('backend.ktests.edit', $ktest->coid ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
{{ Form::open(array('route' => array('backend.ktests.destroy', $ktest->id ), 'method' => 'delete', 'data-confirm' => '确定删除？')) }}
<button type="submit" href="{{ URL::route('backend.ktests.destroy', $ktest->id) }}" class="btn btn-danger btn-mini">删除</button>
{{ Form::close() }}
</td>
</tr>
@endforeach
</tbody>
</table>
{{ $ktests->links() }} 
<form class="form-inline">
  <div class="form-group">
    <label for="exampleInputEmail2">同步用户测试数据</label>
  </div>
  <button type="submit" class="btn btn-default">同步</button>
</form>
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