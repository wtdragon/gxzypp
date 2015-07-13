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
$("#selectpicker").on('change', function() {
     var city=$(this).find("option:selected").text();
	var klfilter=$("#yxkl .clicked").text();
	var lxfilter=$("#yxlx .clicked").text();
	 $(this).addClass("clicked");
	 getcontent($(this).find("option:selected").text(),$("#yxkl .clicked").text(),$("#yxlx .clicked").text());
	
	  });
 function getcontent(city,klfilter,lxfilter)
   { 
   	 var sendInfo = {
           City: city,
           Klfilter: klfilter,
           Lxfilter: lxfilter
       };
   	 	$.ajax({
           url: "{{ URL::to('users/ajaxfilter') }}",
          type: 'post',
          dataType: 'html',
          charset='UTF-8', 
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
</script>	