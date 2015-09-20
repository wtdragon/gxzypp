<script type="text/javascript">
$(".btn-group > .btn").click(function(){
    $(".btn-group > .btn").removeClass("btn-primary");
    $(this).addClass("btn-primary");
     $("#zy1").toggleClass("notshow");
     $("#zy2").toggleClass("notshow");
       $("#zy3").toggleClass("notshow");
         $("#zy4").toggleClass("notshow");
});
var seen = {};
$('a').each(function() {
    var txt = $(this).text();
    if (seen[txt])
        $(this).remove();
    else
        seen[txt] = true;
});
$(document).ready(function(){
 
    function smk_jump_to_it( _selector, _speed ){
        
        _speed = parseInt(_speed, 10) === _speed ? _speed : 300;
 
        $( _selector ).on('click', function(event){
            event.preventDefault();
            var url = $(this).attr('href'); //cache the url.
 
            // Animate the jump
            $("html, body").animate({ 
                scrollTop: parseInt( $(url).offset().top )
            }, _speed);
 
        });
    }
     // Function call
     smk_jump_to_it( '.link_classname', 500);
 
});

 $(function() {
		var offsetPixels = 250; // change with your sidebar height

		$(window).scroll(function() {
			if ($(window).scrollTop() > offsetPixels) {
				$(".scrollingBox").css({
					"position": "fixed",
					"top": "0px",
					"width": "47.5%"
				});
			} else {
				$(".scrollingBox").css({
					"position": "relative",
					"top": "0",
					"width": "100%"
				});
			}
		});
	});
</script>
<script>
$(function() {	
//Created By: Brij Mohan
//Website: http://techbrij.com
function groupTable($rows, startIndex, total){
if (total === 0){
return;
}
var i , currentIndex = startIndex, count=1, lst=[];
var tds = $rows.find('td:eq('+ currentIndex +')');
var ctrl = $(tds[0]);
lst.push($rows[0]);
for (i=1;i<=tds.length;i++){
if (ctrl.text() ==  $(tds[i]).text()){
count++;
$(tds[i]).addClass('deleted');
lst.push($rows[i]);
}
else{
if (count>1){
ctrl.attr('rowspan',count);
groupTable($(lst),startIndex+1,total-1)
}
count=1;
lst = [];
ctrl=$(tds[i]);
lst.push($rows[i]);
}
}
}
groupTable($('#Table1 tr:has(td)'),0,3);
$('#Table1 .deleted').remove();
});
</script>
