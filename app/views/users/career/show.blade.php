@extends('master')
@section('header')
@stop
@section('content')
{{ Notification::showAll() }}
	<div class='col-md-2 text-center  slidbar_bg'>
		
       @include('users.slidbar')
        

	</div>
	<div class='col-md-7'>
		<h2>
			职业名称：
		</h2>
		<p>
		 {{$collects->careername}}
		</p>
		<p>
        	<div class="btn-group">
              <a href="{{ URL::route('videosearch',$collects->careername) }}" class="btn btn-large" type="button">职业视讯</a>
              <a href="{{ URL::route('salarysearch',$collects->careername) }}" class="btn btn-large" type="button">工资概况</a>
            </div>
         </p>
		 
 
            </div>
<div class='col-md-3'>
		@include('ads')
	</div>
@stop
@section('bootor')
	@include('users.script')
	@include('script')

 	
@stop