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
            <a href="{{ URL::to('users/matches') }}" class="btn btn-large btn-primary" type="button">职业信息</a>
          <a href="{{ URL::to('users/college') }}" class="btn btn-large" type="button">院校信息</a>
 
            </div> 
         </p>
        <div  class='list'>
    
          <div class='row top bottom  marginlr'>
        <h2>院校名称：
		  {{ $ktest1st->college->name }}
		   </h2>
		   
	      <table class="table table-striped" id="Table1">
<thead>
<tr>
<th>职业名称</th>
<th>专业名称</th>
<th>收藏</th>
</tr>
</thead>
<tbody>
@foreach ($careers as $career)
<tr>
<td><a href="{{ URL::route('careersearch',$career->id) }}">{{ $career->career_name_chinese }}</a></td>	
<td><a href="{{ URL::route('Colfilter',$career->major_name_chinese) }}">{{ $career->major_name_chinese }}</a></td>
<td><a href="#" id="{{ $career->id }}" data-toggle="modal" class="open-popup-link" data-target="#modal1">收藏</a></td>
</tr>
@endforeach
</tbody>
</table>
{{ $careers->links() }}  
		</div>
         
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