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
			用户名：
		</p>
		<p>会员信息：</p>
		<p>根据您的测评结果，我们为您推荐以下专业：</p>
		<div class="row top bottom marginlr">
		@foreach ($ktests as $ktest)
		 <div class="col-md-3">
         <a href="{{ URL::route('Colfilter',$ktest->zymc) }}">
         {{ $ktest->zymc }}
         </a>
        </div>
         @endforeach
        </div>
           </div>
         <div class='row top bottom bottom-border marginlr'>
        <h4>
		  {{ $ktest1st->zymc }}
		    <div class='row top bottom  marginlr'>
		  	<div class='col-md-4'>
		  	<h5>所属学科:{{ $ktest1st->colleges->province->pname }}</h5>
		  	</div>
		  	<div class='col-md-4'>
		  	<h5>所属门类:{{ $ktest1st->colleges->kelei}}</h5>
		  	</div>
		    </div>
		      <div class='row top bottom  marginlr'>
		  	<div class='col-md-4'>
		  	<h5>本科院校:{{ $ktest1st->colleges->province->pname }}</h5>
		  	</div>
		  	<div class='col-md-4'>
		  	<h5>专科院校:{{ $ktest1st->colleges->kelei}}</h5>
		  	</div>
		    </div>
		</h4>  
		</div>
<table class="table table-striped">
<thead>
<tr>
<th>开设院校</th>
<th>科类</th>
<th>招生批次</th>
<th>所在地区</th>
<th>选考科目</th>
<th>收藏</th>
</tr>
</thead>
<tbody>
@foreach ($colleges as $college)
<tr>
<td>{{ $college->yxmc }}</td>
<td>{{ $college->kelei }}</td>
<td>{{ $college->pici }}</td>
<td>{{ $college->xuezhi }}</td>
<td>{{ $college->xuezhi }}</td>
<td>{{ $college->xuezhi }}</td>
</tr>
@endforeach
</tbody>
</table>
{{ $colleges->links() }}  
            </div>
<div class='col-md-3'>
		@include('ads')
	</div>
@stop
@section('bootor')
@stop