<?
// p($LIST['BLOCK']);
?>
<form method="post" action="/core/admin/action.php">
    <h2><?=$LIB['CURRENT']['TITLE']?></h2>
    <div class="line">
        <label>Список блоков <span class="false">*</span></label>
        <select name="BLOCK" class="field">
            <? foreach($LIST['BLOCK'] as $BLOCK): ?>
            <option value="<?=$BLOCK['ID']?>"><?=$BLOCK['NAME']?></option>
            <? endforeach; ?>
        </select>
    </div>
    <div class="line">
        <label>Название <span class="false">*</span></label>
        <input type="text" name="NAME" class="field" value="<?//=$LIST['CURRENT']['SECTION_BLOCK']['NAME']?>">
    </div>
    <div class="line">
        <label><input type="checkbox" name="ACTIVE" checked> Активность</label>
    </div>
    <div class="btn_wrap">
        <input type="hidden" name="SORT" value="10">
        <input type="hidden" name="SECTION" value="<?=$LIB['CURRENT']['URL']['GET']['sid']?>">
        <input type="hidden" name="CODE" value="SECTION_BLOCK_ADD">
        <input type="submit" class="btn" value="Сохранить">
    </div>
</form>