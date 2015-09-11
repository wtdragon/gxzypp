 <table class="table table-striped" id="Table1">
<thead>
<tr>
<th>院校名称</th>
<th>科类</th>
<th>招生批次</th>
<th>所在地区</th>
</tr>
</thead>
<tbody>
@foreach ($colleges as $college)
<tr>
<td> <a href="{{ URL::route('Specfilter',$college->coid) }}">{{ $college->yxmc }}</a></td>
<td>{{ $college->kelei }}</td>
<td>{{ $college->pici }}</td>
<td>{{ $college->province->pname }}</td>
</tr>
@endforeach
</tbody>
</table>
{{ $colleges->links() }}  
</div>
<script>
	var seen = {};
$('table tr').each(function() {
    var txt = $(this).text();
    if (seen[txt])
        $(this).remove();
    else
        seen[txt] = true;
});
</script> 