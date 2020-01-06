<?php
include('./lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_member'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysql_query("DELETE FROm visitor where id='$id[$i]'");
}
header("location: membersDetail.php");
}
?>