<?
// ?code=section&action=edit&id=2 -- Редакция раздела
// ?code=section&action=add -- Добавление раздела
// ?code=section&action=add&id=2 -- Добавление подраздела
// $CURRENT['SECTION'] = $_GET['action'] == 'edit' ? $LIB['SECTION']->ID($_GET['id']) : [] ;
// $DESIGN = $LIB['DB']->Query("SELECT * FROM ka_design", 'rows');
// p($CURRENT);
?>
<form method="post">
	<div class="area">
		<div class="label">Название <span class="required">*</span></div>
		<input type="text" name="NAME" class="field" value="<?=$CURRENT['SECTION']['NAME']?>">
	</div>
	<div class="area">
		<div class="label">Папка</div>
		<input type="text" name="FOLDER" class="field" value="<?=$CURRENT['SECTION']['FOLDER']?>">
	</div>
	<div class="area">
		<div class="label">Макет дизайна</div>
		<select name="DESIGN" class="field">
			<? foreach($DESIGN as $item): ?>
			<option value="<?=$item['ID']?>"<?=$item['ID']==$CURRENT['SECTION']['DESIGN']?' selected':''?>><?=$item['NAME']?></option>
			<? endforeach; ?>
		</select>
	</div>
	<div class="area">
		<input type="checkbox" name="ACTIVE" id="active"<?=$CURRENT['SECTION']['ACTIVE']?' checked':''?>><label for="active">Активность</label>
	</div>
	<div class="area" style="color: #a6a6a6"><span class="required">*</span> — поля, обязательны для сохранения</div>
	<input type="hidden" name="CODE" value="<?=$_GET['code']?>">
	<input type="hidden" name="ID" value="<?=$_GET['id']?>">
	<input type="hidden" name="PARENT" value="">
	<input type="submit" value="Сохранить" name="SAVE" class="btn">
</form>