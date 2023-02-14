<?
// ?code=element&action=edit&id=1 -- Редакция элемента
// ?code=element&action=add&sb= -- Добавление элемента
// ?code=element&sb=

// str_replace(search, replace, subject)
// $arElement = $LIB['ELEMENT']->Rows();

$CURRENT['ELEMENT']['LIST'] = $LIB['ELEMENT']->Rows($CURRENT['SECTION_BLOCK']['BLOCK'], ['SECTION_BLOCK' => $CURRENT['SECTION_BLOCK']['ID']]);
// p($CURRENT);

?>
<a href="/admin/element?sid=<?=$_GET['id']?>&section_block=<?=$_GET['section_block']?>&action=add" class="add">Добавить элемент</a>
<table>
	<tr>
		<th style="width: 1%"><input type="checkbox" name="" id=""></th>
		<th style="width: 1%; text-align: center;">ID</th>
		<th>Активность</th>
		<th>Сортировка</th>
		<th>Заголовок</th>
		<th>Текст</th>
		<th style="width: 1%">Действия</th>
	</tr>
	<? foreach($CURRENT['ELEMENT']['LIST'] as $ELEMENT): ?>
	<tr>
		<td><input type="checkbox" name="" id=""></td>
		<td style="width: 1%; text-align: center;"><?=$ELEMENT['ID']?></td>
		<td style="text-align: center;"><?=$ELEMENT['ACTIVE']?'Да':'Нет'?></td>
		<td style="text-align: center;"><?=$ELEMENT['SORT']?></td>
		<td><?=preg_match("/((\S+[\s-]+){18})/s", $ELEMENT['NAME'], $m)? rtrim($m[1]). '...' : $ELEMENT['NAME'];?></td>
		<td><?=preg_match("/((\S+[\s-]+){18})/s", $ELEMENT['TEXT'], $m)? rtrim($m[1]). '...' : $ELEMENT['TEXT'];?></td>
		<td class="action">
			<a href="/admin/element?sid=<?=$_GET['id']?>&section_block=<?=$_GET['section_block']?>&id=<?=$ELEMENT['ID']?>&action=del" class="item del"></a>
			<a href="/admin/element?sid=<?=$_GET['id']?>&section_block=<?=$_GET['section_block']?>&id=<?=$ELEMENT['ID']?>&action=edit" class="item edit"></a>
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