@extends('master')
@section('header')
@stop
@section('content')
{{ Notification::showAll() }}
	<div class='col-md-2 text-center  slidbar_bg'>
		
       @include('users.slidbar')
        

	</div>
	<div class='col-md-8'>
		<h2>
			会员中心
		</h2>
		<h3>
			我的收藏
		</h3>
		 <p>
        	<div class="btn-group">
              <a href="{{ URL::to('users/collects') }}" class="btn btn-large" type="button">职业收藏</a>
              <a href="{{ URL::to('users/ccolleges') }}" class="btn btn-large  btn-primary" type="button">院校收藏</a>
            </div>
         </p>
        
        @if (count($collegenames))          
              
       <div  class='list'>
        
     <div id="projects">    
           @foreach ($collegenames as $college)
       <div class="col-md-4" id="school">
        <a href="#{{ $college->coid   }}">
  
           {{ $college->yxmc   }}
     
         </a>
        </div>
         @endforeach
         
    
        
  	 
	  <div id="cgschool">
		  <div class="col-md-12">
		  	
		 <h3 class="text-left col-md-4"> {{ $fcollge->yxmc }}</h3>
		  <div   class='col-md-4'>
	   {{ Form::open(['method' => 'delete','action'=>['cdestroy',$fcollge->coid]]) }}
<button type="submit" class="btn btn-danger btn-sm">取消收藏</button>
{{ Form::close() }}
		   </div> 
	 </div> 
<table class="table table-striped">
<thead>
<tr>
<th>职业名称</th>
<th>专业名称</th>
<th>层次</th>
<th>科类</th>
<th>选报科目</th> 
</tr>
</thead>
<tbody>
@foreach ($zylbs as $zylb)
<tr>
<td><a href="{{ URL::route('videosearch',$zylb->career_name_chinese) }}" target="_blank">{{ $zylb->career_name_chinese }}</a></td>	
<td><a href="{{ URL::route('colfreal',$zylb->zymingcheng) }}" target="_blank">{{ $zylb->zymingcheng }}</a></td>	
<td>{{ $zylb->kelei }}</td>
<td>{{ $zylb->pici }}</td>
<td>{{ $zylb->xuanbao }}</td>
</tr>
@endforeach
</tbody>
</table>
{{ $zylbs->links() }}  
      
            	 </div>
                 </div>
                 </div>
   @else 
                 <h3  class='text-left col-md-4'>
		 您还没有院校收藏   
		   </h3>
		   @endif
              </div>
  
             
              
           
<div class='col-md-3'>
		@include('ads')
	</div>
@stop
@section('bootor')
	@include('users.script')
 @include('script')

	
@stop