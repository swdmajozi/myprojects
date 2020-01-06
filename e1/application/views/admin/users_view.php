<!-- Begin content -->
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<span class="glyphicon glyphicon-user"></span> User management
			<small>User Management</small>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo anchor('admin', '<i class="fa fa-dashboard"></i> Homepage');?></li>
			<li class="active">User management</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<h4 class="page-header">
			<small>You can User can manage all groups, such as administrators, teachers and students</small>
		</h4>

		<div class="col-md-12 <?php if(!$this->session->flashdata('noAnim')) echo "animate-fade-up";?>">
			<?php
			if ($this->session->flashdata('msg_info')) {
				// echo '
				// <div class="alert alert-success alert-dismissable">
				// <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				// <strong>เรียบร้อย!</strong> '.$this->session->flashdata('msg_info').'</div>';
				echo "
				<script>
				Messenger.options = {
					extraClasses: 'messenger-fixed messenger-on-top',
					theme: 'bootstrap'
				}
				Messenger().post({
					message: '".$this->session->flashdata('msg_info')."',
					type: 'info',
					hideAfter: 7,
					showCloseButton: true
				});
		</script>";

		}
		if ($this->session->flashdata('msg_error')) {
			echo '
			<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Error!</strong> '.$this->session->flashdata('msg_error').'</div>';
			echo "
			<script>
			Messenger.options = {
				extraClasses: 'messenger-fixed messenger-on-top',
				theme: 'bootstrap'
			}
			Messenger().post({
				message: '".$this->session->flashdata('msg_error')."',
				type: 'danger',
				hideAfter: 7,
				showCloseButton: true
			});
			</script>";
		}

		?>

		<div class="box">
			<div class="box-body">
				<p>Choose from </p>
				<div class="btn-group">
					<?php
					echo anchor('admin/users/viewgroup/all', 'Every group', 'class="'.$this->misc->btnActive($group,'all').'"').
					anchor('admin/users/viewgroup/admin', 'Moderator', 'class="'.$this->misc->btnActive($group,'admin').'"').
					anchor('admin/users/viewgroup/teacher', 'Instructor', 'class="'.$this->misc->btnActive($group,'teacher').'"').
					anchor('admin/users/viewgroup/student', 'Student', 'class="'.$this->misc->btnActive($group,'student').'"');
					?>
				</div>
			</div>
		</div>
		<div class="row <?php if($this->session->flashdata('noAnim')) echo "animate-fade-up";?>">
			<div class="col-md-12">
				<?php
				if (isset($adminlist)) {
				?>
				<div class="box box-danger">
					<div class="box-header">
						<i class="fa fa-users"></i>
						<h3 class="box-title">Admin</h3>
						<div class="box-tools pull-right">
							<div class="btn-group">
								<?php echo anchor('admin/users/adduser/admin', '<i class="fa fa-plus text-green"></i> Add','class="btn btn-default "');?>
							</div>
						</div>
					</div>
					<div class="row box-body">
						<?php
							$attr = array(
							'name' => 'searchadmin',
							'class' => 'searchform',
							'role' => 'search',
							'method' => 'get'
							);
						echo form_open('admin/users/viewgroup/admin', $attr);
						?>
							<div class="col-xs-6 col-sm-5" style="z-index:500;"></div>
							<div class="col-sm-7 ">
								<div class="col-sm-6 col-md-6 text-right" style="padding-right: 0;">
									<label>Item / Page</label>
									<label>	
										<?php
										$attr_pp = array(
											'10' => '10',
											'25' => '25',
											'50' => '50',
											'100' => '100'
											);
										if ($this->input->get('perpage')) $perpage = $this->input->get('perpage');
										//else $perpage = '25';
										echo form_dropdown('perpage', 
											$attr_pp, 
											$perpage, 
											'class="form-control input-sm" onchange="submitFrm(document.forms.searchadmin)"');
											?>
									</label>
								</div>
								<div class="input-group input-group-sm col-sm-6 col-lg-6 pull-right">
									<?php
									//echo form_hidden('p', $this->input->get('p'));
									echo form_input(array(
										'id'=>'searchtxt',
										'name'=>'q',
										'type'=>'text',
										'class'=>'form-control input-sm',
										'value'=>$this->input->get('q'),
										'placeholder'=>'Search'
										));
									?>
									<span class="input-group-btn">
										<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
									</span>
								</div>
							</div>
						<?php echo form_close(); ?>
					</div>
					<div class="box-body no-padding">
						<table class="table table-striped table-hover rowclick">
							<thead>
								<tr>
									<th style="width: 24px;">Status</th>
									<th style="width: 174px;">Username</th>
									<th style="width: 34%;">Full Name</th>
									<th style="width: 37%;">Email</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($adminlist as $item) {
									echo "
									<tr href=\"".$this->misc->getHref('admin/users/view')."/$item[id]\">
									<td class=\"status\">".$this->misc->getActiveStatusIcon($item['status'])."</td>
									<td>$item[username]</td>
									<td>$item[name] $item[lname]</td>
									<td>$item[email]</td>
									</tr>
									";
								}
								?>				
							</tbody>
						</table>
					</div>
					<div class="box-footer clearfix">
						<?php echo $paginAdmin;?>
					</div>
				</div>
				<?php } ?>

				<?php
				if (isset($teacherlist)) {
				?>
				<div class="box box-primary">
					<div class="box-header">
						<i class="fa fa-users"></i>
						<h3 class="box-title">Teacher</h3>
						<div class="box-tools pull-right">
							<div class="btn-group">
								<?php echo anchor('admin/users/adduser/teacher', '<i class="fa fa-plus text-green"></i> Add','class="btn btn-default "');?>
							</div>
						</div>
					</div>
					<div class="row box-body">
					<?php
						$attr = array(
							'name' => 'searchteacher',
							'class' => 'searchform',
							'role' => 'search',
							'method' => 'get'
						);
					echo form_open('admin/users/viewgroup/teacher', $attr);
					?>
						<div class="col-xs-6 col-sm-5" style="z-index:500;"></div>
							<div class="col-sm-7 ">
								<div class="col-sm-6 col-md-6 text-right" style="padding-right: 0;">
									<label>Item / Page</label>
									<label>	
										<?php
										$attr_pp = array(
											'10' => '10',
											'25' => '25',
											'50' => '50',
											'100' => '100'
											);
										if ($this->input->get('perpage')) $perpage = $this->input->get('perpage');
										//else $perpage = '25';
										echo form_dropdown('perpage', 
											$attr_pp, 
											$perpage, 
											'class="form-control input-sm" onchange="submitFrm(document.forms.searchteacher)"');
											?>
									</label>
								</div>
								<div class="input-group input-group-sm col-sm-6 col-lg-6 pull-right">
									<?php
									echo form_input(array(
										'id'=>'searchtxt',
										'name'=>'q',
										'type'=>'text',
										'class'=>'form-control input-sm',
										'value'=>$this->input->get('q'),
										'placeholder'=>'Search'
										));
									?>
									<span class="input-group-btn">
										<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
									</span>
								</div>
							</div>
						<?php echo form_close(); ?>
					</div>
					<div class="box-body no-padding">
						<table class="table table-striped table-hover rowclick">
							<thead>
								<tr>
									<th style="width: 24px;">Status</th>
									<th>Username</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Board</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($teacherlist as $item) {
									echo "
									<tr href=\"".$this->misc->getHref('admin/users/view')."/$item[id]\">
									<td class=\"status\">".$this->misc->getActiveStatusIcon($item['status'])."</td>
									<td>$item[username]</td>
									<td>$item[name]</td>
									<td>$item[lname]</td>
									<td>$item[fac_id]</td>
									</tr>
									";
								}
								?>
							</tbody>
						</table>
					</div>
					<div class="box-footer clearfix">
						<?php echo $paginTeacher;?>
					</div>
				</div>
				<?php } ?>

				<?php
				if (isset($studentlist)) {
					?>
					<div class="box box-info">
						<div class="box-header">
							<i class="fa fa-users"></i>
							<h3 class="box-title">Student</h3>
							<div class="box-tools pull-right">
								<div class="btn-group">
									<?php echo anchor('admin/users/adduser/student', '<i class="fa fa-plus text-green"></i> Add','class="btn btn-default"');?>
									<?php echo anchor('admin/users/import/student', '<i class="fa fa-send text-green"></i> Import','class="btn btn-default"');?>
								</div>
							</div>
						</div>
						<div class="row box-body">
					<?php
						$attr = array(
							'name' => 'searchstudent',
							'class' => 'searchform',
							'role' => 'search',
							'method' => 'get'
						);
					echo form_open('admin/users/viewgroup/student', $attr);
					?>
						<div class="col-xs-6 col-sm-5" style="z-index:500;"></div>
							<div class="col-sm-7 ">
								<div class="col-sm-6 col-md-6 text-right" style="padding-right: 0;">
									<label>Item / Page</label>
									<label>	
										<?php
										$attr_pp = array(
											'10' => '10',
											'25' => '25',
											'50' => '50',
											'100' => '100'
											);
										if ($this->input->get('perpage')) $perpage = $this->input->get('perpage');
										//else $perpage = '25';
										echo form_dropdown('perpage', 
											$attr_pp, 
											$perpage, 
											'class="form-control input-sm" onchange="submitFrm(document.forms.searchstudent)"');
											?>
									</label>
								</div>
								<div class="input-group input-group-sm col-sm-6 col-lg-6 pull-right">
									<?php
									echo form_input(array(
										'id'=>'searchtxt',
										'name'=>'q',
										'type'=>'text',
										'class'=>'form-control input-sm',
										'value'=>$this->input->get('q'),
										'placeholder'=>'Search'
										));
									?>
									<span class="input-group-btn">
										<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
									</span>
								</div>
							</div>
						<?php echo form_close(); ?>
					</div>
					<div class="box-body no-padding">
						<table class="table table-striped table-hover rowclick">
							<thead>
								<tr>
									<th style="width: 24px;">Status</th>
									<th>Username</th>
									<th>Full - Name</th>
									<th>Gender</th>
									<th>Board</th>
									<th>Branch</th>
									<th>Year</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($studentlist as $item) {
									echo "
									<tr href=\"".$this->misc->getHref('admin/users/view')."/$item[id]\">
									<td class=\"status\">".$this->misc->getActiveStatusIcon($item['status'])."</td>
									<td>$item[username]</td>
									<td>$item[name]&nbsp;&nbsp;$item[lname]</td>
									<td>";
									echo ($item['gender']=="male")?"Male":"Female";
									echo "</td>
									<td>$item[fac_id]</td>
									<td>$item[branch_id]</td>
									<td>$item[year]</td>
									</tr>
									";
								}
								?>				
								</tbody>
							</table>
						</div>
						<div class="box-footer clearfix">
							<?php echo $paginStudent;?>
						</div>
					</div>
					<?php } ?>

				</div>
			</div>
		</div>
				<script>
				function submitFrm(frm) {
					frm.submit();
				}</script>

	</section><!-- /.content -->
</aside><!-- /.right-side -->

<!-- End content -->

