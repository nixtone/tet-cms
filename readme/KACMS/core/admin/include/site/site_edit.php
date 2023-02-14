<?
$CURRENT['SITE'] = $LIB['SITE']->ID($_GET['id']);
$CURRENT['SECTION']['LIST'] = $LIB['SECTION']->Rows();
?>
<form method="post">

	<div class="area">
		<input type="checkbox" name="" id="active"<?=$CURRENT['SITE']['ACTIVE']?' checked':''?>><label for="active">Активность</label>
	</div>

	<div class="area">
		<div class="label">Главная страница <span class="required">*</span></div>
		<select name="" id="" class="field">
			<? foreach($CURRENT['SECTION']['LIST'] as $SECTION): ?>
			<option value="<?=$SECTION['ID']?>"<?=$SECTION['ID']==$CURRENT['SITE']['SECTION_INDEX']?' selected':''?>><?=$SECTION['NAME']?></option>
			<? endforeach; ?>
		</select>
	</div>

	<div class="area">
		<div class="label">Страница не найдена <span class="required">*</span></div>
		<select name="" id="" class="field">
			<? foreach($CURRENT['SECTION']['LIST'] as $SECTION): ?>
			<option value="<?=$SECTION['ID']?>"<?=$SECTION['ID']==$CURRENT['SITE']['SECTION_404']?' selected':''?>><?=$SECTION['NAME']?></option>
			<? endforeach; ?>
		</select>
	</div>

	<div class="area" style="color: #a6a6a6"><span class="required">*</span> — поля, обязательны для сохранения</div>
	<input type="submit" value="Сохранить" name="SAVE" class="btn">

</form>