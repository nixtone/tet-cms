<?
function sectionTree($menuItems = array(), $parentID = 0, $viewChild = true) {
	global $CURRENT;

	foreach($menuItems as $item) if($item['PARENT'] == $parentID) $secItems[] = $item;
	
	if($secItems) {
		echo "<ul class=\"list\">";
		foreach($secItems as $sItem): ?>
			<li class="item"><a href="/admin/section/?id=<?=$sItem['ID']?>"><?=$sItem['NAME']?></a><? if($viewChild) sectionTree($menuItems, $sItem['ID']); ?></li>
		<? endforeach;
		echo "</ul>";
	}
}
