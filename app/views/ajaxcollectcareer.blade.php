		   <h3  class='text-left col-md-4'>
		  职业名称：{{ $cname }} 
		   </h3>
		   <div   class='col-md-4'>
	   {{ Form::open(array('route' => array('users.collects.destroy', $collect->careerid ), 'method' => 'delete', 'data-confirm' => '确定取消？')) }}
<button type="submit" href="{{ URL::route('users.collects.destroy', $collect->careerid) }}" class="btn btn-danger btn-sm">取消收藏</button>
{{ Form::close() }}
		   </div> 
		    <div class='row top bottom  marginlr'> 
	      <table class="table table-striped" id="Table1">
<thead>
<tr>
<th>院校名称</th>
<th>专业名称</th>
<th>层次</th>
<th>科类</th>
<th>选报科目</th> 
</tr>
</thead>
<tbody>
@foreach ($zylbs as $zylb)
<tr>
<td><a href="{{ URL::route('Specfilter',$zylb->yxmc ) }}" target="_blank">{{ $zylb->yxmc }}</a></td>	
<td><a href="" target="_blank">{{ $zylb->zymingcheng }}</a></td>
<td>{{ $zylb->cengci }}</a></td>	
<td>{{$zylb->kelei }}</a></td>
<td>{{ $zylb->xuanbao }}</a></td>	
</tr>
@endforeach
</tbody>
</table>
</div>
{{ $zylbs->links() }}  
<script>
	var maxRows = 20;
$('#Table1').each(function() {
    var cTable = $(this);
    var cRows = cTable.find('tr:gt(0)');
    var cRowCount = cRows.size();
    
    if (cRowCount < maxRows) {
        return;
    }

    cRows.each(function(i) {
        $(this).find('td:first').text(function(j, val) {
           return (i + 1) + " - " + val;
        }); 
    });

    cRows.filter(':gt(' + (maxRows - 1) + ')').hide();


    var cPrev = cTable.siblings('.prev');
    var cNext = cTable.siblings('.next');

    cPrev.addClass('disabled');

    cPrev.click(function() {
        var cFirstVisible = cRows.index(cRows.filter(':visible'));
        
        if (cPrev.hasClass('disabled')) {
            return false;
        }
        
        cRows.hide();
        if (cFirstVisible - maxRows - 1 > 0) {
            cRows.filter(':lt(' + cFirstVisible + '):gt(' + (cFirstVisible - maxRows - 1) + ')').show();
        } else {
            cRows.filter(':lt(' + cFirstVisible + ')').show();
        }

        if (cFirstVisible - maxRows <= 0) {
            cPrev.addClass('disabled');
        }
        
        cNext.removeClass('disabled');

        return false;
    });

    cNext.click(function() {
        var cFirstVisible = cRows.index(cRows.filter(':visible'));
        
        if (cNext.hasClass('disabled')) {
            return false;
        }
        
        cRows.hide();
        cRows.filter(':lt(' + (cFirstVisible +2 * maxRows) + '):gt(' + (cFirstVisible + maxRows - 1) + ')').show();

        if (cFirstVisible + 2 * maxRows >= cRows.size()) {
            cNext.addClass('disabled');
        }
        
        cPrev.removeClass('disabled');

        return false;
    });

});
</script>	