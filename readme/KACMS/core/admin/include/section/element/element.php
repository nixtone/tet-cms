<?
if(isset($_POST['SAVE'])) {
	switch ($_GET['action']) {
		case 'add': {
			$LIB['ELEMENT']->Add();
		} break;
		case 'edit': {
			// $LIB['ELEMENT']->Edit();
		} break;
	}
	redirect('/admin/section?id='.$_GET['sid'].'&section_block='.$_GET['section_block']);
}
// p($CURRENT);
?>
<form method="post">
	
	

	<div class="area">
		<div class="label">Название <span class="required">*</span></div>
		<input type="text" name="NAME" class="field" value="<?=htmlspecialchars($CURRENT['ELEMENT']['NAME'])?>">
	</div>

	<!--  -->
	<div class="area">
		<input type="checkbox" name="" id="CHNAME"><label for="CHNAME">Чекбокс</label>
	</div>

	<div class="area">
		<div class="label">Файл</div>
		<input type="file" name="" id="" class="field">
	</div>

	<div class="area">
		<div class="label">Текст</div>
		<textarea name="TEXT" rows="10" class="field"><?=htmlspecialchars($CURRENT['ELEMENT']['TEXT'])?></textarea>
	</div>
	<!--  -->

	<div class="area">
		<div class="label">Сортировка</div>
		<input type="text" name="" id="" class="field" value="<?=$CURRENT['ELEMENT']['SORT']?>">
	</div>
	<div class="area">
		<input type="checkbox" name="" id="active"<?=$CURRENT['ELEMENT']['ACTIVE']?' checked':''?>><label for="active">Активность</label>
	</div>
	<div class="area" style="color: #a6a6a6"><span class="required">*</span> — поля, обязательны для сохранения</div>

	<!-- div.area(div.label+input.field:t) -->
	
	<input type="submit" value="Сохранить" name="SAVE" class="btn">
</form>