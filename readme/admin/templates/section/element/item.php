<?
$ELEMENT = $LIB['ELEMENT']->Read(4, ['BLOCK'=>1]);

?>

<form method="post" action="/core/admin/action.php">
    <h2>Редакция элемента</h2>

    <div class="line">
        <label>Название <span class="false">*</span></label>
        <input type="text" name="NAME" class="field" value="<?=$ELEMENT['NAME']?>">
    </div>
    <div class="line">
        <label>Адрес</label>
        <input type="text" name="NAME" class="field" value="<?=$ELEMENT['URL']?>">
    </div>
    <div class="line">
        <div class="label">Текст</div>
        <textarea name="" id="" cols="10" rows="3" class="field"><?=$ELEMENT['TEXT']?></textarea>
    </div>
    <div class="line">
        <label><input type="checkbox" name="ACTIVE" checked> Активность</label>
    </div>
    <div class="btn_wrap">
        <input type="hidden" name="CODE" value="SECTION_ADD">
        <input type="submit" class="btn" value="Сохранить">
    </div>

</form>