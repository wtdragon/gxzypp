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
		<p>
		用户名：{{$user->stuname}}
		</p>
		<p>
		<h3>根据您的测评结果，我们为您推荐一下职业及专业</h3>
		</p>
		  <table class="table table-striped" id="Table1">
<thead>
<tr>
<th  data-field="zhiye" rowspan="10">职业</th>
<th>所需专业</th>
</tr>
</thead>
<tbody>
@foreach ($collects as $collect)
<tr>
<td><a href="{{ URL::route('careersearch',$collect->id) }}">{{ $collect->career_name_chinese }}</a></td>	
<td><a href="{{ URL::route('Colfilter',$collect->majorname) }}">{{ $collect->major_name_chinese }}</a></td>
</tr>
@endforeach
</tbody>
</table>
{{ $collects->links() }}  
            </div>
<div class='col-md-3'>
		@include('ads')
	</div>
@stop
@section('bootor')
	@include('users.script')
	@include('script')

 	
@stop