    
        <h3  class="text-left">
		  职业名称：{{ $cname }}
		   </h3>
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
<th>收藏</th>
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
<td><a href="#" id="c{{ $zylb->coid }}" data-toggle="modal" class="open-popup-link" data-target="#modal1">收藏</a></td>
</tr>
@endforeach
</tbody>
</table>
{{ $zylbs->links() }}  
	