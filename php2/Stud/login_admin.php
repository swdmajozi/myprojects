<?php
include('dbconn.php');
?>
	
	<form id="login_form1" class="form-signin" method="post">
				<h3 class="form-signin-heading">
					<i class="icon-lock"></i> Student Login
				</h3>
				<input type="text"      class="input-block-level"   id="email" name="email" placeholder="Username" required>
				<input type="password"  class="input-block-level"   id="mobile" name="mobile" placeholder="Password" required>
				
				<button data-placement="right" title="Click Here to Sign In" id="signin" name="login" class="btn btn-info" type="submit"><i class="icon-signin icon-large"></i> Sign in</button>
				<script type="text/javascript">
				$(document).ready(function(){
				$('#signin').tooltip('show');
				$('#signin').tooltip('hide');
				});
				</script>		
			</form>
	</br>
	<div class="error">
	<?php

if (isset($_POST['login'])){

$email=$_POST['email'];
$mobile=$_POST['mobile'];

$login_query=mysql_query("select * from teens where email='$email' and mobile='$mobile'");
$count=mysql_num_rows($login_query);
$row=mysql_fetch_array($login_query);


if ($count > 0){
session_start();
$_SESSION['id']=$row['id'];
header('location:dashboard.php');
}//else if($countStudent > 0){
	//$_SESSION['id']=$row_student['id'];
//header('location:upcoming.php');
//}

else{
	header('location:index.php');
}
}

?>
   


</div>
