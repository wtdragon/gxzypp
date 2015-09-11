 <div class="col-md-12">
  <h3 class="text-left"> {{ $collegename->yxmc }}</h3>
		 
	 		
		
 
	 </div> 
<table class="table table-striped">
<thead>
<tr>
<th>职业名称</th>
<th>专业名称</th>
<th>层次</th>
<th>科类</th>
<th>选报科目</th>
<th>收藏</th>
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
<td><a href="#" id="{{ $zylb->career_id }}" data-toggle="modal" class="open-popup-link" data-target="#modal1">收藏</a></td>
</tr>
@endforeach
</tbody>
</table>
{{ $zylbs->links() }}  