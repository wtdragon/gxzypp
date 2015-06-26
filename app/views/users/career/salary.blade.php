@extends('master')
@section('hdsrc')
@include('users.cscript')
@stop
@section('content')
{{ Notification::showAll() }}
	<div class='col-md-2 text-center  slidbar_bg'>
		
       @include('users.slidbar')
        

	</div>
	<div class='col-md-7'>
		<h2>
			职业名称：
		</h2>
		<p>
		 {{$collects->careername}}
		</p>
		<p>
        	<div class="btn-group">
            <a href="{{ URL::route('videosearch',$collects->careername) }}" class="btn btn-large bg-color-orange" type="button">职业视讯</a>
          <a href="{{ URL::route('salarysearch',$collects->careername) }}" class="btn btn-large bg-color-orange" type="button">工资概况</a>
 
            </div>
         </p>
		     @if ($salary)
		     <h3>工资占比区间</h3>
		     <div style="width:60%">
			<canvas id="piearea" width="300" height="300"/>
		</div>
             	<ul>   {{$salary->srsptu }}	</ul>
             	<h3>按工作经验统计</h3>
             	<div style="width:50%">
				<canvas id="linecanva" height="400" width="300"></canvas>
			    </div>
             	<ul>   {{$salary->gzjygztj }}	</ul>
                       
             	 
             	<h3>历年工资变化趋势</h3>
             	<div style="width:50%">
				<canvas id="line2canva" height="400" width="300"></canvas>
			    </div>
             	<ul>   {{$salary->lngzbh }}	</ul>
             	 {{$salary->lnjson }}
             @else
                                            <p>暂未收录职业信息</p>
                                            @endif
            </div>
<div class='col-md-3'>
		@include('ads')
	</div>
@stop
@section('bootor')
	@include('users.script')
	@include('script')
<script>
  var t={{ $salary->josn}};
 
  var pieData = [
				{
					value: t[0],
					color:"#F7464A",
					highlight: "#FF5A5E",
					label: "2K-3K"
				},
				{
					value: t[1],
					color: "#46BFBD",
					highlight: "#5AD3D1",
					label: "4.5K-6K"
				},
				{
					value: t[2],
					color: "#FDB45C",
					highlight: "#FFC870",
					label: "6K-8K"
				},
				{
					value: t[3],
					color: "#949FB1",
					highlight: "#A8B3C5",
					label: "8K-10K"
				},
				{
					value: t[4],
					color: "#4D5360",
					highlight: "#616774",
					label: "10K-15K"
				}
				,
				{
					value: t[5],
					color: "#24CBE5",
					highlight: "#5AD3D1",
					label: "15K-20K"
				}
				,
				{
					value: t[6],
					color: "#FF9655",
					highlight: "#FFC870",
					label: "20K-30K"
				}

			];

			

    
		 var l={{ $salary->gzjson}};
		 var lineChartData = {
			labels : ["应届毕业生","0-2年","3-5年","6-7年","8-10年","10年以上"],
			datasets : [
				{
					label: "工作经验分布",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [l[0],l[2],l[5],l[11],l[8]]
				}
			]
			}
			
		var l2={{ $salary->lnjson}};	
        var lineChartData2 = {
			labels : ["2009","2010","2011","2012","2013","2014"],
			datasets : [
				{
					label: "工作经验分布",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [l2[1],l2[3],l2[5],l2[7],l2[9]]
				}
			]

		}
   window.onload = function(){
    var ctx = document.getElementById("piearea").getContext("2d");
    window.myLine = new Chart(ctx).Pie(pieData, {
    responsive: true
    });


   var ctx2 = document.getElementById("linecanva").getContext("2d");
    window.myLine = new Chart(ctx2).Line(lineChartData, {
        responsive: true
    });
    var ctx3 = document.getElementById("line2canva").getContext("2d");
    window.myLine = new Chart(ctx3).Line(lineChartData2, {
        responsive: true
    }); 

}


	</script>
@stop