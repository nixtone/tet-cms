<?
$CURRENT['DESIGN'] = $LIB['DESIGN']->ID($_GET['id']);
$CURRENT['DESIGN']['LIST'] = $LIB['DESIGN']->Rows();

$DESIGN_TMP = [
	['LABEL' => 'Контроллер', 'NAME' => 'CONTROLLER', 'FILE' => 'controller.php'],
	['LABEL' => 'Верхний шаблон', 'NAME' => 'TEMPLATE', 'FILE' => 'header.php'],
	['LABEL' => 'Нижний шаблон', 'NAME' => 'TEMPLATE_FULL', 'FILE' => 'footer.php']
];

$filePath = $_SERVER['DOCUMENT_ROOT'].'/core/dev/design/'.$_GET['id'].'/';
?>
<form method="post">

	<div class="area">
		<div class="label">Название <span class="required">*</span></div>
		<input type="text" name="NAME" class="field" value="<?=$CURRENT['DESIGN']['NAME']?>">
	</div>

	<div class="area">
		<div class="label">Родительский макет</div>
		<select name="" id="" class="field">
			<option value="0">Не наследовать</option>
			<? foreach($CURRENT['DESIGN']['LIST'] as $DESIGN): if($CURRENT['DESIGN']['ID'] == $DESIGN['ID']) continue; ?>
			<option value="<?=$DESIGN['ID']?>"><?=$DESIGN['NAME']?></option>
			<? endforeach; ?>
		</select>
	</div>
	
	<? foreach($DESIGN_TMP as $TMP): ?>
	<div class="area">
		<div class="label"><?=$TMP['LABEL']?></div>
		<textarea name="<?=$TMP['NAME']?>" rows="10" class="field"><?=$_GET['action'] == 'add' ? '' : (file_exists($filePath.$TMP['FILE'])?file_get_contents($filePath.$TMP['FILE']):'') ;?></textarea>
	</div>
	<? endforeach; ?>

	<div class="area" style="color: #a6a6a6"><span class="required">*</span> — поля, обязательны для сохранения</div>
	<input type="submit" value="Сохранить" name="SAVE" class="btn">

</form>