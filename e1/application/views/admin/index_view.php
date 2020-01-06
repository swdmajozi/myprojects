<!-- Begin content -->
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<ol class="breadcrumb">
		<li class="active">Homepage</li>
	</ol>
	<h2>Online Examination System </h2>
<?php
	echo "Welcome to login, ".$this->session->userdata('fullname').
	br().
	"Birthday: ".$this->session->userdata('birth').br().
	"Gender: ".$this->session->userdata('gender').br(3);

	echo anchor('auth/logout', 'Log out');
?>
</div>
<!-- End content -->