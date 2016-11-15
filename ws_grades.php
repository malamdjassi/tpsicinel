<?php
$datarequest = array();

if ((count($_REQUEST) > 0))
	$datarequest = $_REQUEST;
$op = $datarequest['op'];
unset($datarequest['op']);
unset($_REQUEST['op']);

require_once 'db_handler.php';
$table = "grades";



unset($datarequest['maildi']);
switch($op) {
case 'c' : {
	if (isset($datarequest['op'])) 
		unset($datarequest['op']);

	$res = insertTable($table, $datarequest);

	break;
}
case 'r' : {
	$res = readTable($table, null);
	break;
}
case 'u' : {
	if (isset($datarequest['op'])) 
		unset($datarequest['op']);
	$res = updatedb_embedded($table, $_REQUEST['xtra'], "contactos", $_REQUEST['pos']);
	break;
}
case 'd' : {
	if (isset($datarequest['op'])) 
		unset($datarequest['op']);
	$res = deletedb_embedded($table, $_REQUEST['xtra'], "contactos", $_REQUEST['pos']);
	break;
}
}
if (isset($res)){
	echo json_encode($res);
}
