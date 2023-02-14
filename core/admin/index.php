<?
require_once($_SERVER['DOCUMENT_ROOT'].'/core/bootstrap/index.php');


if(isset($_POST['AUTH'])) {
	$CORE['USER']->Auth($_POST['NAME'], $_POST['PASSWORD']);
	header("location: /core/admin");
}

if(isset($_GET['exit'])) {
	$CORE['USER']->Exit();
	header("location: /core/admin");
}

if(isset($CORE['CURRENT']['USER']) AND $CORE['CURRENT']['USER']['PERMISSION'] == 3) {
	require_once($_SERVER['DOCUMENT_ROOT']."/core/admin/design.php");
}
else {
	
	require_once($_SERVER['DOCUMENT_ROOT']."/core/admin/auth.php");
}
