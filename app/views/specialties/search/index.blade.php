@extends('master')
@section('header')
<script type="text/javascript">
$(document).ready(function (){ 								    //  等待DOM加载完毕.
	var $category = $('#mylist ul a:gt(15):not(:last)');     	    //  获得索引值大于5的品牌集合对象(除最后一条)	
	$category.hide();							    //  隐藏上面获取到的jQuery对象。
	var $toggleBtn = $('div.showmore > a');             //  获取“显示全部品牌”按钮
	$toggleBtn.click(function(){
		  if($category.is(":visible")){
				$category.hide();                   		 //  隐藏$category
				$(this).find('span')
					.css("background","url(img/down.gif) no-repeat 0 0")      
					.text("显示全部");                  //改变背景图片和文本		// 去掉高亮样式
		  }else{
				$category.show();                   		 //  显示$category
				$(this).find('span')
					.css("background","url(img/up.gif) no-repeat 0 0")      
					.text("精简显示");                  //改变背景图片和文本			//添加高亮样式
		  }
		return false;					      	//超链接不跳转
	})
})
</script>
<script type="text/javascript">
$(document).ready(function (){ 								    //  等待DOM加载完毕.
	var $category = $('#mylist1 ul a:gt(15):not(:last)');     	    //  获得索引值大于5的品牌集合对象(除最后一条)	
	$category.hide();							    //  隐藏上面获取到的jQuery对象。
	var $toggleBtn = $('div.showmore1 > a');             //  获取“显示全部品牌”按钮
	$toggleBtn.click(function(){
		  if($category.is(":visible")){
				$category.hide();                   		 //  隐藏$category
				$(this).find('span')
					.css("background","url(img/down.gif) no-repeat 0 0")      
					.text("显示全部");                  //改变背景图片和文本		// 去掉高亮样式
		  }else{
				$category.show();                   		 //  显示$category
				$(this).find('span')
					.css("background","url(img/up.gif) no-repeat 0 0")      
					.text("精简显示");                  //改变背景图片和文本			//添加高亮样式
		  }
		return false;					      	//超链接不跳转
	})
})
</script>
@stop
@section('content')
{{ Notification::showAll() }}
	<div class='col-md-2 text-center  slidbar_bg'>
		<h3 class="acolor">
			专业搜索
		</h3>
		<p class='t1'>九子高考志愿匹配网为您提供全面的专业数据库搜索功能，以便于您可以根据搜索结果，查询所需要的专业信息。</p>
			
	</div>
	<div class='col-md-7 bottom top'>
     <div class="input-group">
       <span class="input-group-btn">
{{ Form::open(array('route' => array('PostSpecialtiysearch','method' => 'post'))) }}
      	     <div class="col-xs-2">
        <button type="submit" class="btn btn-default" type="button">专业搜索</button>
        </div>
      </span>
       <div class="col-xs-9">
      {{Form::text('specialty', null, array('class'=>'fc_search form-control','placeholder'=>'专业搜索'))}}
      </div>
    </div><!-- /input-group -->
{{ Form::close() }}
<div class='row top bottom'>
<h4>基本专业</h4>
<div id="mylist1">
<ul>
@foreach ($ptzys as $ptzy)
<a href="#">
{{ $ptzy->mkml }}
</a>
@endforeach
</ul>
</div>
<div class="showmore1">
	<a href='#'><span>全部专业</span></a>
</div>
</div>
<div class='row top bottom'>
<h4>特设专业</h4>
<div id="mylist">
<ul>
	
@foreach ($tszys as $tszy)
<a href="#">
{{ $tszy->mkml }}
</a>
@endforeach
</ul>
<div class="showmore">
<a><span>全部专业</span></a>
</div>
</div>
</div>
<table class="table table-striped">
<thead>
<tr>
<th>专业名称</th>
<th>科类</th>
<th>层次</th>
<th>详情</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
@foreach ($schools as $school)
<tr>
<td>{{ $school->zymingcheng }}</td>
<td>{{ $school->kelei }}</td>
<td>{{ $school->cengci }}</td>
<td><a href="{{ URL::route('specialties.search.show', $school->scid) }}">查看</a></td>
</tr>
@endforeach
</tbody>
</table>
{{ $schools->links() }}  
</div>
<div class='col-md-3'>
	<div class='row top bottom'>
		@include('ads')
	</div>
	</div>
@stop
@section('bootor')
@stop