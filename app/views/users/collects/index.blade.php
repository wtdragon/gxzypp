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
			会员中心
		</h2>
		<h3>
			我的收藏
		</h3>
		 <p>
	<div class="btn-group">
  <button class="btn btn-large btn-primary" type="button">职业收藏</button>
  <button class="btn btn-large" type="button">院校收藏</button>
 </div>
</p>

            </div>
<div class='col-md-3'>
		@include('ads')
	</div>
@stop
@section('bootor')
@stop