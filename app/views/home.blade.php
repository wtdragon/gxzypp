@extends('master')
@section('header')
@stop
@section('content')
	<div class="col-md-12 column">
			<div class="carousel slide" id="carousel-846327">
				<ol class="carousel-indicators">
					<li data-slide-to="0" data-target="#carousel-846327">
					</li>
					<li data-slide-to="1" data-target="#carousel-846327" class="active">
					</li>
					<li data-slide-to="2" data-target="#carousel-846327">
					</li>
				</ol>
				<div class="carousel-inner">
					<div class="item">
						<img alt="" src="images/img/t1.png">
						<div class="carousel-caption">
							<h4>
								九子高校匹配
							</h4>
							<p>
								欢迎来到九子高考志愿匹配网 进行志愿匹配测试请先【注册登录】
								点击进入>>>			</p>
						</div>
					</div>
					<div class="item active">
						<img alt="" src="images/img/t1.png">
						<div class="carousel-caption">
							<h4>
								Second Thumbnail label
							</h4>
							<p>
								Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
							</p>
						</div>
					</div>
					<div class="item">
						<img alt="" src="images/img/t1.png">
						<div class="carousel-caption">
							<h4>
								Third Thumbnail label
							</h4>
							<p>
								Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
							</p>
						</div>
					</div>
				</div> <a class="left carousel-control" href="#carousel-846327" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-846327" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
			</div>
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-md-4 column t1">
				<img alt="150x150" src="images/img/colleges.jpg">
			
				<a href="{{URL::to('colleges/articles')}}"><h2>院校资讯</h2></a>
			
			<p>
				九子高考志愿匹配网为您提供权威的、全面的职业院校新闻资讯和招生信息。为您对于院校及专业的情况了解进行科学系统的导向。	</p>
			
		</div>
		<div class="col-md-4 column t1">
				<img alt="150x150" src="images/img/matches.jpg">
			<h2>
				志愿匹配
			</h2>
			<p>
				注册登录之后，您可以进行我们给您提供的一套权威的职业测评，为您推荐职业匹配，以便于您进行职业筛选和专业比较，对合适的选择可以收藏并记录。	</p>
		
		</div>
		<div class="col-md-4 column t1">
				<img alt="150x150" src="images/img/colleges_s.jpg">
			<h2>
				院校搜索
			</h2>
			<p>
				九子高考志愿匹配网为您提供全面的院校数据搜索功能，以便于您可以根据搜索结果，查询所需要的院校信息。
		</p>
			
		</div>
		<div class="col-md-4 column t1">
			<img alt="150x150" src="images/img/specialties.jpg">
			<h2>
				专业搜索
			</h2>
			<p>
				九子高考志愿匹配网为您提供全面的专业数据库搜索功能，以便于您可以根据搜索结果，查询所需要的专业信息。			</p>
			
		</div>
		<div class="col-md-4 column t1">
			<img alt="150x150" src="images/img/training.jpg">
			<h2>
				培训信息
			</h2>
			<p>
				根据我们给您做出的志愿匹配测评结果，为您提供适合您自身的职业培训课程信息和培训课程推荐。
			</p>
		</div>
@stop
@section('bootor')
@stop