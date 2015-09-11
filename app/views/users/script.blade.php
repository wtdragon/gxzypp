<script type="text/javascript">
$(".li").hover(function(){
    $(".li").removeClass("active");
    $(this).addClass("active");
});
$(".li").click(function(){
    $(".li").removeClass("active");
    $(this).addClass("active");
});
</script>
<script type="text/javascript">
$("#yxlx a").click(function() {
	 var city=$("#selectpicker").find("option:selected").text();
	var lxfilter=$(this).text();
	var klfilter=$("#yxkl .clicked").text();
	 $("#yxlx .clicked").removeClass("clicked");
    $(this).addClass("clicked");
	 getcontent(city,klfilter,lxfilter);
	  });  
$("#yxkl a").click(function() {
	 var city=$("#selectpicker").find("option:selected").text();
	var klfilter=$(this).text();
	var lxfilter=$("#yxlx .clicked").text();;
	 $("#yxkl .clicked").removeClass("clicked");
    $(this).addClass("clicked");
	getcontent(city,klfilter,lxfilter);
	
	  });  
$("#six a").click(function() {
	
	var careername=$(this).text();
    var url=window.location.href;
    var cid=$(this).attr("id");    
	getcontent2(url,careername,cid);
	
	  });  	 
$("#school a").click(function() {
	var schoolid=$(this).attr('href').split('#')[1];
    var url=window.location.href;
	getschool(url,schoolid);
	
	  }); 	   
$("#selectpicker").on('change', function() {
     var city=$(this).find("option:selected").text();
	var klfilter=$("#yxkl .clicked").text();
	var lxfilter=$("#yxlx .clicked").text();
		var zymc=$("#zymc").text().substring(20);
	 $(this).addClass("clicked");
	 var url=window.location.href;
	 getcontent(city,klfilter,lxfilter,url,zymc);
	
	  });
 function getcontent(city,klfilter,lxfilter,url,zymc)
   { 
   	
   	 var sendInfo = {
           City: city,
           Klfilter: klfilter,
           Lxfilter: lxfilter,
           Zymc:zymc,
           Url:url
       };
   	 	$.ajax({
           url: "{{ URL::to('users/ajaxfilter') }}",
          type: 'post',
          dataType: 'html',
          charset:'UTF-8', 
        data: sendInfo,
		tryCount:0,//current retry count
		retryLimit:3,//number of retries on fail
		success: function(data) {
			$("#projects").html(data);// 设置文本内容
			
			 
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
                    }	
function getcontent2(url,careername,cid)
   { 
   	 var sendInfo = {
           Careername: careername,
           Url:url,
           Cid:cid
       };
   	 	$.ajax({
           url: "{{ URL::to('users/ajaxcareer') }}",
          type: 'post',
          dataType: 'html',
          charset:'UTF-8', 
          async:false,
        data: sendInfo,
		tryCount:0,//current retry count
		retryLimit:3,//number of retries on fail
		success: function(data) {
 
			$("#careers").html(data);// 设置文本内容
			
			 
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
                    }
function getschool(url,schoolid)
   { 
   	 var sendInfo = {
           Schoolid:schoolid,
           Url:url
       };
   	 	$.ajax({
           url: "{{ URL::to('users/ajaxschool') }}",
          type: 'post',
          dataType: 'html',
          charset:'UTF-8', 
        data: sendInfo,
        async:false,
		tryCount:0,//current retry count
		retryLimit:3,//number of retries on fail
		success: function(data) {
		 
			$("#cgschool").html(data);// 设置文本内容
			
			 
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
                    }	                            	                    
function delRepeat(){
var str = $('#repeatValue').val();
var strArr=str.split(" ");//把字符串以空格分割成一个数组


var uniqueArr = [];
$.each(strArr, function(i, el){
if($.inArray(el, uniqueArr) === -1) uniqueArr.push(el);
});
$('#repeatValue').val(uniqueArr.join(" ")); //再将字符串组合

}                    	   	   
</script>	