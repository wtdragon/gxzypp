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
		<p>
			用户名：{{$user->stuname}}
		</p>
           </div>
         <div class='row top bottom bottom-border marginlr'>
        <h4>
		  {{ $ktest1st->zymc }}
		  		</h4>
		    <div class='row top bottom  marginlr'>
		     {{ $ktest1st->zyjs }}
		    </div>
  
		</div>
 
<table class="table table-striped">
<thead>
<tr>
<th>开设院校</th>
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