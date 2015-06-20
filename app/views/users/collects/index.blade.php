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
<td><a href="{{ URL::route('careersearch',$collect->careerid) }}">{{ $collect->careers->careername }}</a></td>	
<td>{{ $collect->careers->majorname }}</td>
</tr>
@endif
@endforeach
</tbody>
</table>
{{ $collects->links() }}  
              
              
              
              
              
              
              
              
              
              
             </div>
             
              <div  class='list notshow' id="zy4">
              
            <table class="table table-striped">
<thead>
<tr>
<th>院校名称</th>
<th>所在地区</th>
<th>院校特色</th>
<th>层次</th>
<th>种类</th>
</tr>
</thead>
<tbody>
@foreach ($collects as $collect)
@if ($collect->coid === 0)
	@else
<tr>
<td>{{ $collect->colleges->yxmc }}</td>

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