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
              <a href="{{ URL::to('users/collects') }}" class="btn btn-large btn-primary" type="button">职业收藏</a>
              <a href="{{ URL::to('users/ccolleges') }}" class="btn btn-large" type="button">院校收藏</a>
            </div>
         </p>
         
   <div class='row top bottom  marginlr'>
        	<div id="six">
        		<ul>
        	   @foreach ($careers as $career)
         <li><a href="#" >{{ $career->career_name_chinese }}</a></li>
         @endforeach
         </ul>
         </div>
      
         </div>  
        <div class='row top bottom  marginlr'>
          <div id="careers">
          	<div class='col-md-12 top bottom  marginlr'>
          	<p>   
        <h3  class="text-left">
		  职业名称：{{ $fcareer->career_name_chinese }}
		   </h3>
		   </p>  
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