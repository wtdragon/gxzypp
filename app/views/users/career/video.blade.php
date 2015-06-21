@extends('master')
@section('hdsrc')
@include('users.vscript')
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
		     @if ($video)
		        <div class="player">
<video id="video-playlist" class="video-js vjs-default-skin" controls preload="auto" width="600" height="400" poster="" data-setup="{}">
     <source src="http://115.29.45.209:81/{{$video->k_sppath }}" type='video/mp4' />
 </video>
 
             	<p>   {{$video->kcontent }}	</p>
             @else
             <p>暂未收录相关视频</p>
              @endif
            </div>
              </div>
<div class='col-md-3'>
		@include('ads')
	</div>
@stop
@section('bootor')
	@include('users.script')
	@include('script')

 	
@stop