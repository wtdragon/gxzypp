    
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
</div>
{{ $zylbs->links() }}  

<script type="text/javascript">
$(document).ready(function() { 
$.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});  
$('.open-popup-link').click(function(){
	 
	var coid=$(this).eq(0).attr('id');;
	var postStr   = "coid="+ coid;
	 $.ajax({
	 	type: 'post',
		url: "{{ URL::to('users/ajaxcollect') }}",
		data: postStr,
		dataType:  'html',
		tryCount:0,//current retry count
		retryLimit:3,//number of retries on fail
		success: function(data) {
			 $(".modal-body").html(data);// 设置文本内容
			 
		},
		error: function(xhr, textStatus, errorThrown) {
			 if (textStatus == 'timeout') {//if error is 'timeout'
				this.tryCount++;
				if (this.tryCount < this.retryLimit) {
					$.ajax(this);//try again
					return;
				}
			}//try 3 times to get a response from server
		}
	});
}); 
} );    
</script>

	