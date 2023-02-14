<?
if(isset($_POST['SAVE'])) {
	$LIB['BLOCK']->Add($_POST);
	redirect('/admin/dev/block');
}

$CURRENT['BLOCK'] = $LIB['BLOCK']->ID($_GET['id']);

$BLOCK_TMP = [
	['LABEL' => 'Контроллер', 'NAME' => 'CONTROLLER', 'FILE' => 'controller.php'],
	['LABEL' => 'Шаблон', 'NAME' => 'TEMPLATE', 'FILE' => 'template.php'],
	['LABEL' => 'Шаблон полного вывода', 'NAME' => 'TEMPLATE_FULL', 'FILE' => 'template-full.php']
];

$filePath = $_SERVER['DOCUMENT_ROOT'].'/core/dev/block/'.$_GET['id'].'/';
?>
<form method="post">

	<div class="area">
		<div class="label">Название <span class="required">*</span></div>
		<input type="text" name="NAME" class="field" value="<?=$CURRENT['BLOCK']['NAME']?>">
	</div>

	<? foreach($BLOCK_TMP as $TMP): ?>
	<div class="area">
		<div class="label"><?=$TMP['LABEL']?></div>
		<textarea name="<?=$TMP['NAME']?>" rows="10" class="field"><?=$_GET['action'] == 'add' ? '' : (file_exists($filePath.$TMP['FILE'])?file_get_contents($filePath.$TMP['FILE']):'') ;?></textarea>
	</div>
	<? endforeach; ?>

	<div class="area" style="color: #a6a6a6"><span class="required">*</span> — поля, обязательны для сохранения</div>
	<input type="submit" value="Сохранить" name="SAVE" class="btn">

</form>