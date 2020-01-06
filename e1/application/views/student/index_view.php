<!-- Begin content -->
<div class="span12">
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