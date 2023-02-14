<form method="post" action="/core/admin/action.php">
    <h2><?=$LIB['CURRENT']['TITLE']?></h2>
    <div class="line">
        <label>Название <span class="false">*</span></label>
        <input type="text" name="NAME" class="field" value="<?=($LIB['CURRENT']['SECTION']['NAME'] ?? '')?>">
    </div>
    <div class="line">
        <label>Папка <span class="false">*</span></label>
        <input type="text" name="FOLDER" class="field" value="<?=($LIB['CURRENT']['SECTION']['FOLDER'] ?? '')?>">
    </div>
    <div class="line">
        <label>Макет дизайна <span class="false">*</span></label>
        <select name="DESIGN" class="field">
            <? foreach($LIST['DESIGN'] as $design): ?>
            <option value="<?=$design['ID']?>"><?=$design['NAME']?></option>
            <? endforeach; ?>
        </select>
    </div>
    <div class="line">
        <label><input type="checkbox" name="ACTIVE" checked> Активность</label>
    </div>
    <div class="btn_wrap">
        <input type="hidden" name="CODE" value="SECTION_ADD">
        <input type="hidden" name="PARENT" value="<?=($LIB['CURRENT']['PARENT'] ?? 0)?>">
        <input type="submit" class="btn" value="Сохранить">
    </div>
</form>