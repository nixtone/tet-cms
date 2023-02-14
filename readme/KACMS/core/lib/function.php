<?
function p($data) {
	echo '<pre style="background: #eee; padding: 5px; white-space: pre-wrap;">';
	print_r($data);
	echo '</pre>';
}

function arGag($ar) {
	return empty($ar) ? [] : $ar ;
}

function arInline($ar) {
	$line = ' ';
	foreach($ar as $key => $value) {
		if(count($ar) > 1 AND array_key_first($ar) != $key)  $line .= ' AND ';
		$line .= "`".$key."`='".$value."'";
	}
	return $line;
}

function redirect($url) {
	// include('/core/lib/redirect.php?url='.$url);
	global $CURRENT;
	?><script>window.location.href = '<?=$CURRENT['URL']['PROTOCOL'].'://'.$CURRENT['URL']['DOMAIN'].$url?>';</script><?
}