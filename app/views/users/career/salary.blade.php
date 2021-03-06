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
			<h3 id="careername">
		 {{$collects->career_name_chinese}}
		 </h3>
		</p>
		<div class="control-group">
        

          <!-- Select Basic -->
          <label class="control-label">选择地区：</label>
         
           {{ Form::select( 'area',$area,null, array('id' => 'selectpicker')) }}

        </div> 
		<p>
        	<div class="btn-group">
            <a href="{{ URL::route('videosearch',$collects->career_name_chinese) }}" class="btn btn-large" type="button">职业视讯</a>
          <a href="{{ URL::route('salarysearch',$collects->career_name_chinese) }}" class="btn btn-large btn-primary" type="button">工资概况</a>
 
            </div>
         </p>
         <div id="project">
		     @if ($salary)
		     <h3>工资占比区间</h3>
		     <div style="width:60%">
			<canvas id="piearea" width="300" height="300"/>
		     </div>
             	<ul id="pieinfo">   {{$salary->srsptu }}	</ul>
              	<h3>按工作经验统计</h3>
             	<div style="width:50%">
				<canvas id="linecanva" height="400" width="300"></canvas>
			    </div>
             	<ul id="l1info">   {{$salary->gzjygztj }}	</ul>
                       
             	 
             	<h3>历年工资变化趋势</h3>
             	<div style="width:50%">
				<canvas id="line2canva" height="400" width="300"></canvas>
			    </div>
             	<ul id="l2info">   {{$salary->lngzbh }}	</ul>
        
             @else
             <p>暂未收录职业薪资信息</p>
             @endif
            </div>
           </div>
<div class='col-md-3'>
		@include('ads')
	</div>
@stop
@section('bootor')
@if ($salary)	
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
   		
    //Get context with jQuery - using jQuery's .get() method.
var ctx = $("#piearea").get(0).getContext("2d");
//This will get the first returned node in the jQuery collection.
var mypiearea = new Chart(ctx).Pie(pieData, {
    responsive: true
    });
 


 var  ctx2 = $("#linecanva").get(0).getContext("2d");
 var myline1 = new Chart(ctx2).Line(lineChartData, {
        responsive: true
    });
 var  ctx3 = $("#line2canva").get(0).getContext("2d");
  var  myline2 = new Chart(ctx3).Line(lineChartData2, {
        responsive: true
    });  
 




	 
	$(document).ready(function(){ 
 $("#selectpicker").on('change', function() {
 var sendInfo = {
           City: $(this).find("option:selected").text(),
           Careername:$("#careername").text()
       };
   	 	$.ajax({
           url: "{{ URL::to('users/ajaxjson') }}",
          type: 'post',
          dataType: 'html',
          async:false,
          charset:'UTF-8', 
        data: sendInfo,
		tryCount:0,//current retry count
		retryLimit:3,//number of retries on fail
		success: function(data) {
			$("#project").html(data);// 设置文本内容
		
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
	});
</script>	
	 @else
     @endif
	     
@stop