  @foreach ($ktests as $ktest)
       <div class="col-md-4">
        <a href="{{ URL::route('Specfilter',$ktest->co_id) }}">
  
           {{ $ktest->college->name   }}
     
         </a>
        </div>
         @endforeach
         
        	<p>根据你的筛选条件，共有50所合适的本科招生院校</p>
 
        
  	 
	
		<div class='row top bottom bottom-border marginlr'>
		 <h3> {{ $ktest1st->college->name }}</h3>
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
<td>{{ $zylb->zymingcheng }}</td>	
<td>{{ $zylb->zymingcheng }}</td>
<td>{{ $zylb->kelei }}</td>
<td>{{ $zylb->pici }}</td>
<td>{{ $zylb->xuezhi }}</td>
<td><a href="#" id="c{{ $zylb->id }}" data-toggle="modal" class="open-popup-link" data-target="#modal1">收藏</a></td>
</tr>
@endforeach
</tbody>
</table>
{{ $zylbs->links() }}  
           
            	 </div>