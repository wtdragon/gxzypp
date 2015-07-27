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
            <a href="{{ URL::route('Colfilter',$ktest1st->ezymc) }}" class="btn btn-large btn-primary" type="button">专业简介</a>
            <a href="{{ URL::route('trendssearch',$ktest1st->ezymc) }}" class="btn btn-large" type="button">就业趋势</a>
            <a href="{{ URL::route('disssearch',$ktest1st->ezymc) }}" class="btn btn-large" type="button">专业评论</a>
            </div>
         </p>	
        
		 <div class='row top bottom  marginlr'>
		     {{ $ktest1st->zyjs }}
		 </div>
          <div class="control-group">
        
           <h4>开设院校</h4>
          <!-- Select Basic -->
          <label class="control-label">招生地区：</label>
         
           {{ Form::select( 'area',$area,null, array('id' => 'selectpicker')) }}

        </div> 
		</div>
 
<table class="table table-striped">
<thead>
<tr>
<th>院校名称</th>
<th>科类</th>
<th>招生批次</th>
<th>所在地区</th>
</tr>
</thead>
<tbody>
@foreach ($colleges as $college)
<tr>
<td> <a href="{{ URL::route('Specfilter',$college->coid) }}">{{ $college->yxmc }}</a></td>
<td>{{ $college->kelei }}</td>
<td>{{ $college->pici }}</td>
<td>{{ $college->province->pname }}</td>
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
@include('users.script')
@stop