<?php
//core
function dbcon(){
	$user = "root";
	$pass = "";
	$host = "localhost";
	$db = "php";
	$table = "admin";
	$conn = mysqli_connect($host,$user,$pass);
	mysqli_select_db($conn,'admin');
}

function host(){
	$h = "http://".$_SERVER['HTTP_HOST']."/php2/";
	return $h;
}

function hRoot(){
	$url = $_SERVER['DOCUMENT_ROOT']."/php2/";
	return $url;
}

//parse string
function gstr(){
    $qstr = $_SERVER['QUERY_STRING'];
    parse_str($qstr,$dstr);
    return $dstr;
}

?>
