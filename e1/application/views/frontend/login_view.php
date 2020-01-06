<?php
	$attrLabel = array(
		'class' => 'col-sm-3 control-label'
	);

?>
<!-- Begin login -->
<div class="row animate-fade-up">
	<div class="col-sm-4 col-sm-offset-4">
		<div class="panel panel-<?php if(!isset($msg_error)) echo "primary"; else echo "danger";?>">
			<div class="panel-heading">
				<h3 class="panel-title"><span class="
glyphicon glyphicon-th-list"></span>&nbsp;&nbsp;Login</h3>
			</div>
			<div class="panel-body">
<?php
	if (isset($msg_error)) {
		echo "
		<script>
		Messenger.options = {
			extraClasses: 'messenger-fixed messenger-on-top',
			theme: 'bootstrap'
		}
		Messenger().post({
			message: '".$msg_error."',
			type: 'danger',
			hideAfter: 7,
			showCloseButton: true
		});
		</script>";
	}

	$attr = array(
		'class' => 'form-horizontal',
		'role' => 'form',
		'method' => 'post'
	);
	echo form_open('auth/dologin', $attr);
?>
					<div class="form-group<?php if(form_error('username')) echo ' has-error';?>">
<?php 
	echo form_label('Username', 'username', $attrLabel);
?>
						<div class="col-sm-8">
<?php
	echo form_input(array(
		'id'=>'username',
		'name'=>'username',
		'value'=>set_value('username'),
		'type'=>'text',
		'class'=>'form-control',
		'placeholder'=>'Enter Username'));
	echo form_error('username', '<span class="label label-danger">', '</span>');
?>
						</div>
					</div>
					<div class="form-group<?php if(form_error('password')) echo ' has-error';?>">
<?php 
	echo form_label('Password', 'password', $attrLabel);
?>
						<div class="col-sm-8">
<?php
	echo form_input(array(
		'id'=>'password',
		'name'=>'password',
		//'value'=>set_value('password'),
		'type'=>'password',
		'class'=>'form-control',
		'placeholder'=>'Password'));
	echo form_error('password', '<span class="label label-danger">', '</span>');
?>
						</div>
					</div>
					<!-- <div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
							<div class="checkbox">
								<label>
									<input type="checkbox"> จดจำPassword
								</label>
							</div>
						</div>
					</div> -->
					<div class="form-group">
						<div class="col-sm-12" style="text-align: center;">
<?php
echo form_submit('submit', 'LOGIN', 'class="btn btn-primary"');
?>
						</div>
					</div>
				<?php echo form_close(); ?>


<?php
/*
	echo form_open('auth/dologin').
		form_label('ผู้ใช้งาน: ', 'username').
		form_error('username', '<span class="label label-danger">', '</span>'.br()).
		form_input('username', set_value('username')).br().
		form_label('Password: ', 'password').
		form_error('password', '<font color=red>', '</font>'.br()).
		form_password('password', set_value('password')).br().
		form_submit('submit', 'เข้าสู่ระบบ');
		*/
?>

			</div>
		</div>
	</div>
</div>





<!-- End login -->