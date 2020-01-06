<?php
include('./lib/dbcon.php'); 
dbcon(); 
if (isset($_POST['delete_offering'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysql_query("DELETE FROm offering where id='$id[$i]'");
}
header("location: add_offering.php");
}
?>