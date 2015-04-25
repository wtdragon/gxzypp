<div class='col-md-7'>
<h2>
会员中心
</h2>
		<p>
		用户名：{{$user->stuname}}
		</p>
		<p>学号：</p><p>{{$user->stuno}}</p> 
		  <div class="panel-body">
		  	
@if ($kresult === "你还没做过测试" )
</div>
    <p> {{ $kresult }}</p>
    <div class='col-md-3'>
	 <a href="{{ $kurl }}" class="btn btn-default btn1" type="button">职业测试</a> 
	 </div>
@else
   <p>根据您做的测试，以下为您的测试结果：</p>
  <iframe style="width: 800px; height: 600px;"
            src="<?php echo $kresult ?>"
            frameBorder="0">
          </iframe>
@endif
       </div>
</div>