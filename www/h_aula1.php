<?php
$datarequest = array();
$_REQUEST['maildi']= 'sendpwd';

if ((count($_REQUEST) > 0))
	$datarequest = $_REQUEST;
$op = $datarequest['op'];
unset($datarequest['op']);
unset($_REQUEST['op']);

require_once 'db_handler.php';


unset($datarequest['maildi']);
switch($op) {
case 'c' : {
	if (isset($datarequest['op'])) 
		unset($datarequest['op']);

	$res = insertTable("aula1", $datarequest);

	break;
}
case 'r' : {
	$res = readdb_embedded("Cliente", $_REQUEST['xtra'], "contactos");
	break;
}
case 'u' : {
	if (isset($datarequest['op'])) 
		unset($datarequest['op']);
	$res = updatedb_embedded('Cliente', $_REQUEST['xtra'], "contactos", $_REQUEST['pos']);
	break;
}
case 'd' : {
	if (isset($datarequest['op'])) 
		unset($datarequest['op']);
	$res = deletedb_embedded('Cliente', $_REQUEST['xtra'], "contactos", $_REQUEST['pos']);
	break;
}
}
if (isset($res)){
	echo json_encode($res);
}
