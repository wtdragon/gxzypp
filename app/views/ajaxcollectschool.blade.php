 <div class="col-md-12">
		 <h3 class="text-left"> {{ $collegename }}</h3>
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