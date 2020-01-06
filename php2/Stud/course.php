<?php include('header.php'); ?>
<?php
	@session_start();		

     if( isset($_POST["courses"]) ){
		 @$_SESSION["course"] = $_POST["courses"];	

		$members_query = mysql_query("SELECT `duration` FROM `visitor` where `examdesc`='".$_POST["courses"]."'")or die(mysql_error());
		while($row = mysql_fetch_array($members_query)){			
			$duration = $row['duration'];
			@$_SESSION["controller"] = "1";
		}
		
			@$_SESSION["timer"] = $duration;
			$_SESSION["start_time"] = date("Y-m-d H:i:s");
			@$end_time = date("Y-m-d H:i:s", strtotime('+'.$_SESSION["timer"].'minutes', strtotime($_SESSION["start_time"])));

		if( $end_time != ""){
			$_SESSION["end_time"] = @$end_time;		

			 header("Location: events.php");
		}	
	}   	
?>

<script type="text/javascript">
	window.location = "events.php";
</script>