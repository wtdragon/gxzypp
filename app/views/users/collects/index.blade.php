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
            <button class="btn btn-large btn-primary" type="button">职业收藏</button>
            <button class="btn btn-large" type="button">院校收藏</button>
            </div>
         </p>
         
<div  class='list' id="zy3">  
        	<div id="six">
        		<ul>
        	   @foreach ($careers as $career)
         <li><a href="#" >{{ $career->career_name_chinese }}</a></li>
         @endforeach
         </ul>
         </div>
      
         
         <div class='row top bottom  marginlr'>
           
        <h3  class="text-left">
		  职业名称：{{ $fcareer->career_name_chinese }}
		   </h3>
		   
        </div> 
         <div class="control-group">
        
 
          <!-- Select Basic -->
          <label class="control-label">招生地区：</label>
         
           {{ Form::select( 'area',$area,null, array('id' => 'selectpicker')) }}
          </div> 
        <div id="yxlx">
		<h4>院校类型： <a href="#" class="clicked">211</a> <a href="#">985</a> <a href="#">全部</a> </h4> 
        </div>
        <div id="yxkl">
<h4>院校科类：<a href="#" class="clicked">本科</a>   <a href="#">专科</a>  <a href="#">全部</a> </h4>
         </div>
	      <table class="table table-striped" id="Table1">
<thead>
<tr>
<th>院校名称</th>
<th>专业名称</th>
<th>层次</th>
<th>科类</th>
<th>选报科目</th>
</tr>
</thead>
<tbody>
@foreach ($zylbs as $zylb)
<tr>
<td><a href="" target="_blank">{{ $zylb->yxmc }}</a></td>	
<td><a href="" target="_blank">{{ $zylb->zymingcheng }}</a></td>
<td><a href="" target="_blank">{{ $zylb->cengci }}</a></td>	
<td><a href="" target="_blank">{{ $zylb->kelei }}</a></td>
<td><a href="" target="_blank">{{ $zylb->xuanbao }}</a></td>	
</tr>
@endforeach
</tbody>
</table>
{{ $zylbs->links() }}  
 
          
 
             
              
              
          </div>          
              
              
              
              
              
              <div  class='list notshow' id="zy4">
              
            
              <div class="control-group">
        

          <!-- Select Basic -->
          <label class="control-label">招生地区：</label>
         
           {{ Form::select( 'area',$area,null, array('id' => 'selectpicker')) }}

        </div> 
        <div id="yxlx">
		<h4>院校类型： <a href="#" class="clicked">211</a> <a href="#">985</a> <a href="#">全部</a> </h4> 
        </div>
        <div id="yxkl">
<h4>院校科类：<a href="#" class="clicked">本科</a>   <a href="#">专科</a>  <a href="#">全部</a> </h4>
         </div>
     <div id="projects">    
           @foreach ($collegenames as $college)
       <div class="col-md-4">
        <a href="#">
  
           {{ $college  }}
     
         </a>
        </div>
         @endforeach
         
    
        
  	 
	
		  <div class="col-md-12">
		 <h3 class="text-left"> {{ $fcollge->yxmc }}</h3>
	 </div> 
<table class="table table-striped">
<thead>
<tr>
<th>职业名称</th>
<th>专业名称</th>
</tr>
</thead>
<tbody>
@foreach ($careers as $career)
<tr>
<td><a href="{{ URL::route('videosearch',$career->career_name_chinese) }}" target="_blank">{{ $career->career_name_chinese }}</a></td>	
<td>{{ $career->major_name_chinese }}</td>	
</tr>
@endforeach
</tbody>
</table>
{{ $careers->links() }}  
           
            	 </div>
           

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