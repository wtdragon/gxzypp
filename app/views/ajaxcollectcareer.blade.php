    
        <h3  class="text-left">
		  职业名称：{{ $cname }}
		   </h3>
		    <div class='row top bottom  marginlr'> 
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
</div>
{{ $zylbs->links() }}  
	