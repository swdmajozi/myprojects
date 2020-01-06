<?php
	session_start();
	if( @$_SESSION["controller"] != "" ){
		if( @$_SESSION["controller"] == "1" ){
			$from_time = date("Y-m-d H:i:s");
			$to_time = @$_SESSION["end_time"];

			if( $to_time != "" ){
				$start_at = strtotime($from_time);
				$seconds = strtotime($to_time);
				$diffrence = $seconds - $start_at;
				echo gmdate("H:i:s",$diffrence);
				
			}
		}else{
			echo "TIME IS UP";
		}
	}

	
?>