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
			<div class="btn-group">
            <a href="{{ URL::to('users/matches') }}" class="btn btn-large" type="button">职业信息</a>
            <a href="{{ URL::to('users/college') }}" class="btn btn-large  btn-primary" type="button">院校信息</a>
 
            </div> 
         </p>    
       <div  class='list'>
		<div class="control-group">

          <!-- Select Basic -->
          <label class="control-label">招生地区：</label>
           {{ Form::select( 'area',$area,null, array('class' => 'input-xlarge')) }}

        </div> 
		<h4>院校类型：<a>211</a><a>985</a><a>全部</a></h4> 
        <h4>院校科类：<a>本科</a>   <a>专科</a>  <a>全部</a> </h4>
         @foreach ($ktests as $ktest)
       <div class="col-md-4">
        <a href="{{ URL::route('Specfilter',$ktest->co_id) }}">
  
           {{ $ktest->college->name   }}
     
         </a>
        </div>
         @endforeach
         
        	<p>根据你的筛选条件，共有50所合适的本科招生院校</p>
 
        
   
	
		 <div class='row top bottom bottom-border marginlr'>
        <h4>
		  {{ $ktest1st->college->yxmc }}
		  <div class='row top bottom  marginlr'>
		  	<div class='col-md-4'>
		  	<h5>所属地区:</h5>
		  	</div>
		  	<div class='col-md-4'>
		  	<h5>所属科类:{{ $ktest1st->college->kelei}}</h5>
		  	</div>
		  	<div class='col-md-4'>
		  	<h5><a>收藏</a></h5>
		  	</div>
		  </div>
		</h4> 
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
            	</div>
                 </div>
<div class='col-md-3'>
		@include('ads')
	</div>
	
@stop
@section('bootor')
   @include('users.script')
	@include('script')

<div class="modal fade" id="modal1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-primary"></h4>
      </div>
      <div class="modal-body">
         收藏成功
      </div>
      <div class="modal-footer">
        <button type="button" id="modal-button1" class="btn btn-default" data-dismiss="modal">返回</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
		timeout: 2000,//time before retry on fail
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
@stop