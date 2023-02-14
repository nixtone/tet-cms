<?
$CURRENT['DESIGN']['LIST'] = DB::Query("SELECT * FROM ka_design", 'rows');
?>
<a href="/admin/dev/design?action=add">Добавить шаблон</a>
<table>
	<tr>
		<th style="width: 1%;">ID</th>
		<th>Название</th>
		<th>Родительский макет</th>
		<th style="width: 1%">Действия</th>
	</tr>
	<? foreach($CURRENT['DESIGN']['LIST'] as $DESIGN): ?>
	<tr>
		<td><?=$DESIGN['ID']?></td>
		<td><?=$DESIGN['NAME']?></td>
		<td><?=$DESIGN['PARENT'] ? $CURRENT['DESIGN']['LIST'][$DESIGN['PARENT']]['NAME'] : '-' ?></td>
		<td class="action">
			<a href="/admin/dev/design?id=<?=$DESIGN['ID']?>&action=del" class="item del"></a>
			<a href="/admin/dev/design?id=<?=$DESIGN['ID']?>&action=edit" class="item edit"></a>
		</td>
	</tr>
	<? endforeach; ?>
</table>

<div class="pagination">
	<div class="links">
		<a href="" class="page">1</a>
		<a href="" class="page active">2</a>
		<a href="" class="page">3</a>
		<a href="" class="page">12</a>
		<a href="" class="page">4</a>
	</div>
	<div class="view_count">
		<div>Вывод по: </div>
		<select name="" id="">
			<option value="">10</option>
			<option value="">20</option>
			<option value="">50</option>
			<option value="">100</option>
		</select>
	</div>
</div>