<!-- Begin content -->
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<span class="fa fa-plus-circle"></span> <?php echo $pagetitle;?>
			<small><?php echo $pagesubtitle;?></small>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo anchor('admin', '<i class="fa fa-dashboard"></i> Homepage');?></li>
			<li><?php echo anchor('admin/users', 'User management');?></li>
			<li class="active"><?php echo $pagetitle;?></li>
		</ol>
	</section>
	<section class="content">
		<h4 class="page-header">
			<small></small>
		</h4>

		<?php
		if (isset($msg_error)) {
			// echo '
			// <div class="alert alert-danger alert-dismissable">
			// <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			// <strong>Error!</strong> '.$msg_error.'</div>';
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
			'role' => 'form',
			'method' => 'post'
			);
		echo form_open($formlink, $attr);
		?>
		<div class="row">
			<div class="col-md-5 col-lg-6 col-lg-offset-3">
				<div class="alert alert-info hidden-xs" style="min-width: 343px">
					<i class="fa fa-info"></i>
					<b>A suggestion :</b> <b>mark</b> <span class="text-danger">*</span>
					Required
				</div>
				<div class="alert alert-info visible-xs">
					<i class="fa fa-info"></i>
					<b>A suggestion :</b> <b>mark</b> <span class="text-danger">*</span>
					Required
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-md-6 col-lg-4 col-lg-offset-2">
				<!-- Begin LoginInfo -->
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">
						Identification
						</h3>
					</div>
					<div class="box-body">
						<div class="form-group<?php if(form_error('username')) echo ' has-error';?>">
							<?php 
							echo form_label('Username <span class="text-danger">*</span>', 'username');
							echo form_input(array(
								'id'=>'username',
								'name'=>'username',
								'value'=>$userData['username'],
								'type'=>'text',
								'class'=>'form-control',
								$this->Users->Userfield()=>'',
								'placeholder'=>'Username'));
							echo form_error('username', '<span class="label label-danger">', '</span>');
							?>
						</div>
						<?php
						if($this->Users->isEditPage())
						{
							echo '<div class="callout callout-warning">
								<h4>Password</h4>
								<p>If unchanged, leave blank</p>
						</div>';
						}
						?>
						<div class="form-group<?php if(form_error('password')) echo ' has-error';?>">
							<?php 
							echo form_label('Password <span class="text-danger">*</span>', 'password');
							echo form_input(array(
								'id'=>'password',
								'name'=>'password',
								'type'=>'password',
								'class'=>'form-control',
								'placeholder'=>'Password'));
							echo form_error('password', '<span class="label label-danger">', '</span>');
							?>
						</div>
						<div class="form-group<?php if(form_error('passwordconfirm')) echo ' has-error';?>">
							<?php 
							echo form_label(' Confirm <span class="text-danger">*</span>', 'passwordconfirm');
							echo form_input(array(
								'id'=>'passwordconfirm',
								'name'=>'passwordconfirm',
								'type'=>'password',
								'class'=>'form-control',
								'placeholder'=>'Confirm'));
							echo form_error('passwordconfirm', '<span class="label label-danger">', '</span>');
							?>
						</div>
						<?php if($this->Users->isEditPage()) { ?>
						<div class="callout callout-info">
							<h4>Status</h4>
							<p>Means enable or disable this user</p>
						</div>
						<div class="form-group<?php if(form_error('status')) echo ' has-error';?>">
							<?php 
							echo form_label('Status <span class="text-danger">*</span>', 'status');
							?>
								<div>
									<label class="radio-inline">
										<?php echo form_radio('status', 'active', ($userData['status']=="active"?true:false),'class="minimal-red"')." Enable";?>
									</label>
									<label class="radio-inline">
										<?php echo form_radio('status', 'inactive', ($userData['status']=="inactive"?true:false),'class="minimal-red"')." Disabled";?>
									</label>
								</div>
								<?php echo form_error('status', '<span class="label label-danger">', '</span>'); ?>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		<!-- End LoginInfo -->

		<!-- Begin UserInfo -->
			<div class="col-sm-6 col-md-6 col-lg-4">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">
						Personal information
						</h3>
					</div>
					<div class="box-body">
						<div class="form-group<?php if(form_error('fname')) echo ' has-error';?>">
							<?php 
							echo form_label('Name <span class="text-danger">*</span>', 'fname');
							echo form_input(array(
								'id'=>'fname',
								'name'=>'fname',
								'value'=>$userData['name'],
								'type'=>'text',
								'class'=>'form-control',
								'placeholder'=>'Name'));
							echo form_error('fname', '<span class="label label-danger">', '</span>');
							?>
						</div>
						<div class="form-group<?php if(form_error('surname')) echo ' has-error';?>">
							<?php 
							echo form_label('Surname <span class="text-danger">*</span>', 'surname');
							echo form_input(array(
								'id'=>'surname',
								'name'=>'surname',
								'value'=>$userData['lname'],
								'type'=>'text',
								'class'=>'form-control',
								'placeholder'=>'Surname'));
							echo form_error('surname', '<span class="label label-danger">', '</span>');
							?>
						</div>
						<div class="form-group<?php if(form_error('birth')) echo ' has-error';?>">
							<?php 
							echo form_label('DOB', 'birth');
							echo form_input(array(
								'id'=>'birth',
								'name'=>'birth',
								'value'=>$userData['birth'],
								'type'=>'date',
								'class'=>'form-control',
								'placeholder'=>'DOB'));
							echo form_error('birth', '<span class="label label-danger">', '</span>');
							?>
						</div>
						<div class="form-group<?php if(form_error('gender')) echo ' has-error';?>">
							<?php 
							echo form_label('Gender <span class="text-danger">*</span>', 'gender');
							?>
								<div>
									<label class="radio-inline">
										<?php echo form_radio('gender', 'male', ($userData['gender']=="male"?true:false),'class="minimal-red"')." Male";?>
									</label>
									<label class="radio-inline">
										<?php echo form_radio('gender', 'female', ($userData['gender']=="female"?true:false),'class="minimal-red"')." Female";?>
									</label>
								</div>
								<?php echo form_error('gender', '<span class="label label-danger">', '</span>'); ?>
						</div>
						<div class="form-group<?php if(form_error('year')) echo ' has-error';?>">
							<?php 
							echo form_label('Year <span class="text-danger">*</span>', 'year');
							echo form_input(array(
								'id'=>'year',
								'name'=>'year',
								'value'=>$userData['year'],
								'type'=>'text',
								'class'=>'form-control',
								'placeholder'=>'year'));
							echo form_error('year', '<span class="label label-danger">', '</span>');
							?>
						</div>
						<div class="form-group<?php if(form_error('faculty')) echo ' has-error';?>">
							<?php 
							echo form_label('Faculty <span class="text-danger">*</span>', 'faculty');
							echo form_input(array(
								'id'=>'faculty',
								'name'=>'faculty',
								'value'=>$userData['fac_id'],
								'type'=>'text',
								'class'=>'form-control',
								'placeholder'=>'Faculty'));
							echo form_error('faculty', '<span class="label label-danger">', '</span>');
							?>
						</div>
						<div class="form-group<?php if(form_error('branch')) echo ' has-error';?>">
							<?php 
							echo form_label('Branch <span class="text-danger">*</span>', 'branch');
							echo form_input(array(
								'id'=>'branch',
								'name'=>'branch',
								'value'=>$userData['branch_id'],
								'type'=>'text',
								'class'=>'form-control',
								'placeholder'=>'Branch'));
							echo form_error('branch', '<span class="label label-danger">', '</span>');
							?>
						</div>
						<div class="form-group<?php if(form_error('email')) echo ' has-error';?>">
							<?php 
							echo form_label('Email', 'email');
							echo form_input(array(
								'id'=>'email',
								'name'=>'email',
								'value'=>(isset($userData['email'])?$userData['email']:''),
								'type'=>'text',
								'class'=>'form-control',
								'placeholder'=>'Email'));
							echo form_error('email', '<span class="label label-danger">', '</span>');
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row row-centered">
				<div class="col-sm-12">
					<?php
					echo form_submit('submit', $this->Users->btnUserfield(), 'class="btn btn-primary"');
					?>
				</div>
			</div>
		</div>
		<?php form_close(); ?>
<!-- End content -->