@extends('master')
@section('header')
@stop
@section('content')
{{ Notification::showAll() }}
	<div class='col-md-2 text-center  slidbar_bg'>
		
       @include('users.slidbar')
        

	</div>
	<div class='col-md-8'>
		<div class="row top bottom marginlr">
		<h2>
			会员中心
		</h2>
		<p>
        	<div class="btn-group">
            <button class="btn btn-large btn-primary" type="button">职业信息</button>
            <button class="btn btn-large" type="button">院校信息</button>
            </div>
         </p>
		<div class="control-group">

          <!-- Select Basic -->
          <label class="control-label">招生地区：</label>
           {{ Form::select( 'area',$area,null, array('class' => 'input-xlarge')) }}

        </div> 
		<h4>院校类型：<a>211</a><a>985</a><a>全部</a></h4> 
        <h4>院校科类：<a>本科</a>   <a>专科</a>  <a>全部</a> </h4>
         @foreach ($ktests as $ktest)
       <div class="col-md-4">
        <a href="{{ URL::route('Specfilter',$ktest->co_id) }}">
           {{ $ktest->college->yxmc }}
         </a>
        </div>
         @endforeach
         
        	<p>根据你的筛选条件，共有50所合适的本科招生院校</p>
 
        
   
		</div>
		 <div class='row top bottom bottom-border marginlr'>
        <h4>
		  {{ $ktest1st->college->yxmc }}
		  <div class='row top bottom  marginlr'>
		  	<div class='col-md-4'>
		  	<h5>所属地区:</h5>
		  	</div>
		  	<div class='col-md-4'>
		  	<h5>所属科类:{{ $ktest1st->college->kelei}}</h5>
		  	</div>
		  	<div class='col-md-4'>
		  	<h5><a>收藏</a></h5>
		  	</div>
		  </div>
		</h4> 
		</div>
<table class="table table-striped">
<thead>
<tr>
<th>职业名称</th>
<th>专业名称</th>
<th>层次</th>
<th>科类</th>
<th>选报科目</th>
<th>收藏</th>
</tr>
</thead>
<tbody>
@foreach ($zylbs as $zylb)
<tr>
<td>{{ $zylb->zymingcheng }}</td>	
<td>{{ $zylb->zymingcheng }}</td>
<td>{{ $zylb->kelei }}</td>
<td>{{ $zylb->pici }}</td>
<td>{{ $zylb->xuezhi }}</td>
<td>收藏</td>
</tr>
@endforeach
</tbody>
</table>
{{ $zylbs->links() }}  
            </div>
<div class='col-md-3'>
		@include('ads')
	</div>
@stop
@section('bootor')
	@include('users.script')
	@include('script')
@stop