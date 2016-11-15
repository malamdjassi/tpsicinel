<?php

$fileprop = pathinfo($_SERVER['SCRIPT_NAME']);
// $configpath = substr($_SERVER['DOCUMENT_ROOT'], 0, -1).$fileprop['dirname']."/config.inc";
// $configpath = $_SERVER['DOCUMENT_ROOT'].$fileprop['dirname']."/config.inc";
$path = ($_SERVER['DOCUMENT_ROOT'] == null) ? $_SERVER['DOCUMENT_ROOT']: $fileprop;
$configpath = dirname(__FILE__)."/config.inc";

include_once $configpath;


function readTable($table, $where) {
	$con = connectDb();

	$sel = "SELECT * FROM $table ";
	if ($where != null) {
		$sel .= " WHERE ";
		$count = 0;
		foreach($where as $key=>$val) {
			if (strpos($val, "\"") !==0 && !is_int($val))
				$val = "\"$val\"";
			$sel .= (($count == 0) ? "" : " AND ") . "$key=$val";
			$count++;
		}
	}

	if(isSafeDelete($table))
		$sel .= " AND deleted is null OR deleted = 0;";

//   echo $sel;
//	die($sel);

	$stmt = $con->prepare($sel);
	$stmt->execute();
	$arRes = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $arRes;
}

function updateInsert($table, $where, $vals) {
	$vals = readTable($table, $where);
	if (count($vals > 0))
		updateTable($table, $vals, $where);
	else
		insertTable($table, $vals);
}

function insertTable($table, $arvalues) {

	$con = connectDb();

	$sel = "INSERT INTO $table (";
	$secpart = "";
	$count = 0;
	foreach($arvalues as $key=>$val) {
		$sel .=(($count == 0) ? "" : ", ") . $key;
		if (strpos($val, "\"") !==0)
			$val = "\"$val\"";
		$secpart .= (($count == 0) ? "" : ", ") . $val;
		$count++;
	}
	$sel .= ") VALUES ($secpart);";
//	 echo $sel;
	$stmt = $con->prepare($sel);
	$stmt->execute();

	return $con->lastInsertId();
}

function updateTable($table, $arvalues, $where) {
	$con = connectDb();

	$sel = "UPDATE $table SET ";
	$count = 0;
	foreach($arvalues as $key=>$val) {
		if (strpos($val, "\"") !==0)
			$val = "\"$val\"";
		$sel .= (($count == 0) ? "" : ", ") ."$key=$val";
		$count++;
	}

	$sel .= " WHERE ";
	$count = 0;
	foreach($where as $key=>$val) {
		if (strpos($val, "\"") !==0)
			$val = "\"$val\"";
		$sel .= (($count == 0) ? "" : " AND ") . "$key=$val";
		$count++;
	}

//	echo $sel;
//	die($sel);

	$stmt = $con->prepare($sel);
	return $stmt->execute();
}

function deleteTable($table, $where) {
	$con = connectDb();

	$sel = "DELETE FROM $table";
	$count = 0;

	$sel .= " WHERE ";
	$count = 0;
	foreach($where as $key=>$val) {
		$sel .= (($count == 0) ? "" : " AND ") . "$key=$val";
		$count++;
	}

//	echo $sel;
	// die($sel);

	$stmt = $con->prepare($sel);
	return $stmt->execute();
}


function safeDeleteTable($table, $where) {
	$con = connectDb();

	if(isSafeDelete($table))
		return updateTable($table, array("deleted"=>"true"), $where);
	else
		return false;
}

function isSafeDelete($table) {
	$con = connectDb();
	$sel = "SELECT COUNT(*) FROM information_schema.COLUMNS where table_schema = '".DBNAME."' and table_name='$table' AND column_name='deleted';"; 

	if($res = $con->query($sel)) {
		return ($res->fetchColumn() > 0);
	} else
		return false;
}

function getUser($activetoken) {

	$tok = readTable("active_token", array("token"=>$activetoken));

	// $usr = readTable("user", array("id_user"=>"'".$tok[0]['id_user']."'"));
	if (count($tok) > 0) {
		$user = readTable("user", array("id_user"=> $tok[0]['id_user']));

	return $user[0];
	}
		else
	return null;
}


function getSql($sql) {
	$con = connectDb();

	$stmt = $con->prepare($sql);
	$stmt->execute();
	$arRes = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $arRes;
}

function connectDb() {
	try {
		$con = new PDO(sprintf('mysql:host=localhost;dbname=%s;charset=utf8',DBNAME), USERDB, PWDDB, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
		$con->exec("set names utf8");
	}
	catch (PDOException $e) {

		echo "An error occurred: ". $e->getMessage();
	}
	return $con;
}
?>
