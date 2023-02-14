<h2>Блоки раздела</h2>
<a href="/core/admin/section/block/add?sid=<?=$LIB['CURRENT']['URL']['GET']['sid']?>">Добавить блок</a>
<table>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Исходный блок</th>
        <th></th>
    </tr>
    <? foreach($LIST['CURRENT']['SECTION_BLOCK'] as $SB): ?>
    <tr>
        <td><?=$SB['ID']?></td>
        <td><a href="/core/admin/section/block/content?sb=<?=$SB['ID']?>"><?=$SB['NAME']?></a></td>
        <td><a href=""><?=$LIST['CURRENT']['BLOCK'][$SB['BLOCK']]['NAME']?></a></td>
        <td>
            <a href="/core/admin/section/block/edit?sb=<?=$SB['ID']?>">edit</a>
            <a href="/core/admin/section/block/delete?sb=<?=$SB['ID']?>">del</a>
        </td>
    </tr>
    <? endforeach; ?>
</table>