<?
$arELEMENT = $LIB['ELEMENT']->Read(false, ['BLOCK'=>1]);

?>

<h2>Список элементов</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Название</th>
    </tr>
    <? foreach($arELEMENT as $element): ?>
    <tr>
        <td><?=$element['ID']?></td>
        <td><?=$element['NAME']?></td>
    </tr>
    <? endforeach; ?>
</table>

<?
p($LIB['CURRENT']['ELEMENT']);