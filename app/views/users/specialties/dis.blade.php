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
           </div>
           <div class='row top bottom  marginlr'>
         	<h3>
		           专业名称：{{ $ktest1st->zymc }}
		    </h3>
         <p>
        	<div class="btn-group">
            <a href="{{ URL::route('Colfilter',$ktest1st->ezymc) }}" class="btn btn-large " type="button">专业简介</a>
            <a href="{{ URL::route('trendssearch',$ktest1st->ezymc) }}" class="btn btn-large" type="button">就业趋势</a>
            <a href="{{ URL::route('disssearch',$ktest1st->ezymc) }}" class="btn btn-large btn-primary" type="button">专业评论</a>
            </div>
         </p>	
        
		 <div class='row top bottom  marginlr'>
		     {{ $ktest1st->zyjs }}
		 </div>
  
		</div>
            </div>
<div class='col-md-3'>
		@include('ads')
	</div>
@stop
@section('bootor')
@include('users.script')
@stop