<form method="post" action="/core/admin/action.php">
    <h2><?=$LIB['CURRENT']['TITLE']?></h2>
    <div class="line">Исходны блок: <strong><?=$LIST['CURRENT']['BLOCK']['NAME']?></strong></div>
    <div class="line">
        <label>Название <span class="false">*</span></label>
        <input type="text" name="NAME" class="field" value="<?=$LIST['CURRENT']['SECTION_BLOCK']['NAME']?>">
    </div>
    <div class="line">
        <label><input type="checkbox" name="ACTIVE" checked> Активность</label>
    </div>
    <div class="btn_wrap">
        <input type="hidden" name="SB" value="<?=$LIST['CURRENT']['SECTION_BLOCK']['ID']?>">
        <input type="hidden" name="SID" value="<?=$LIST['CURRENT']['SECTION_BLOCK']['SECTION']?>">
        <input type="hidden" name="CODE" value="SECTION_BLOCK_EDIT">
        <input type="submit" class="btn" value="Сохранить">
    </div>
</form>