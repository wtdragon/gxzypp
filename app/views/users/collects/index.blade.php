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
         
             <div  class='list' id="zy3">
               <table class="table table-striped">
<thead>
<tr>
<th>职业名称</th>
<th>所需专业</th>
</tr>
</thead>
<tbody>
@foreach ($collects as $collect)
@if ($collect->careerid === 0)
	@else
<tr>
<td><a href="{{ URL::route('careersearch',$collect->careerid) }}" target="_blank">{{ $collect->careers->careername }}</a></td>	
<td><a href="{{ URL::route('colfreal',$collect->careers->majorname) }}" target="_blank">{{ $collect->careers->majorname }}</a></td>
</tr>
@endif
@endforeach
</tbody>
</table>
{{ $collects->links() }}  
              
              
              
              
              
              
              
              
              
              
             </div>
             
              <div  class='list notshow' id="zy4">
              
            <table class="table table-striped" id="Table1">
<thead>
<tr>
<th>院校名称</th>
<th>所在地区</th>
<th>批次</th>
<th>层次</th>
</tr>
</thead>
<tbody>
@foreach ($collects as $collect)
@if ($collect->coid === 0)
	@else
<tr>
<td><a href="{{ URL::route('Specfilter',$collect->colleges->coid) }}" target="_blank">{{ $collect->colleges->yxmc }}</a></td>
<td>{{ $collect->colleges->province->pname }}</td>
<td>{{ $collect->colleges->pici }}</td>
<td>{{ $collect->colleges->cengci }}</td>
</tr>
@endif
@endforeach
</tbody>
</table>
{{ $collects->links() }}  
              


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