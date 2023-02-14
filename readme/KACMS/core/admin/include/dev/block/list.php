<?
$LIB['BLOCK']->Delete(5);
// redirect('/admin/dev/block');

if(isset($_GET['ACTION'])) {
	switch ($_GET['ACTION']) {
		case 'edit': {
			
		} break;
		case 'del': {
			$LIB['BLOCK']->Delete($_GET['id']);
			redirect('/admin/dev/block');
		} break;
	}
}
?>
<div class="block list">
	<?
	$CURRENT['BLOCK']['LIST'] = $LIB['BLOCK']->Rows();
	?>
	<a href="/admin/dev/block?action=add" class="add">Добавить блок</a>
	<table>
		<tr>
			<th style="width: 1%;">ID</th>
			<th>Название</th>
			<th style="width: 1%">Действия</th>
		</tr>
		<? foreach($CURRENT['BLOCK']['LIST'] as $BLOCK): ?>
		<tr>
			<td style="text-align: center;"><?=$BLOCK['ID']?></td>
			<td><a href="/admin/dev/block?id=<?=$BLOCK['ID']?>&action=edit"><?=$BLOCK['NAME']?></a></td>
			<td class="action">
				<a href="/admin/dev/block?id=<?=$BLOCK['ID']?>&action=del" class="item del"></a>
				<a href="/admin/dev/block?id=<?=$BLOCK['ID']?>&action=edit" class="item edit"></a>
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
</div>