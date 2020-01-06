<!-- Begin content -->
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<span class="fa fa-rss"></span> Manage exam subjects
			<small>Courses Management</small>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo anchor('admin', '<i class="fa fa-dashboard"></i> Homepage');?></li>
			<li class="active">Manage exam subjects</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<h4 class="page-header">
			<!-- <small>listExam subjectในขณะนี้</small> -->
		</h4>

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
<div class="row">
	<div class="col-md-12">
		<div class="box box-info nav-tabs-custom">
			<!-- <ul class="nav nav-tabs  pull-right">
				<li class="dropdown pull-right">
					<a href="#" class="text-muted" data-toggle="dropdown"><i class="fa fa-gear"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li><?php echo anchor('admin/courses/add', 'Add');?></li>
					</ul>
				</li>
				<li class="pull-left header">
					<i class="glyphicon glyphicon-th"></i> listExam subject
				</li>
			</ul> -->
			<div class="box-header">
				<i class="fa fa-newspaper-o"></i>
				<h3 class="box-title">Manage Courses</h3>
				<div class="box-tools pull-right">
					<div class="btn-group">
						<?php echo anchor('admin/courses/add', '<i class="fa fa-plus text-green"></i> Add','class="btn btn-default "');?>
					</div>
				</div>
			</div>
			<div class="tab-content">
				<!-- Search Box -->
				<div class="box-body">
					<div class="row">
						<?php
						$attr = array(
							'name' => 'searchsubject',
							'class' => 'form-inline searchform',
							'role' => 'search',
							'method' => 'get'
							);
						echo form_open('admin/courses', $attr); ?>
							<div class="col-sm-6" style="z-index:500;">
								<label for="faculty" class="hidden-xs visible-md-inline-block visible-lg-inline-block">Choose from </label>
								<label><?php
									$options = array(
										'all' => 'all',
										'Management' =>
										array(
											'all' => 'All Management (all)',
											'pm' => 'Project Management',
											'at' => 'Agricultural technology',
											'is' => 'Information system',
											'ba' => 'Business Admin',
											'lbt' => 'Logistics and border trade management'
										),
										'marine' => 'Marine technology',
										'gem' =>
										array(
											'all' => 'gem (all)',
											'g1' => 'gem and jewelry',
											'g2' => 'Gem and jewelry business',
											'g3' => 'Designer jewelry'
										)
									);
									echo form_dropdown('faculty', $options, 'default', 'id="faculty" class="form-control input-sm"');
							?></label>
								<label>
									<?php
									$attr_year = array(
										'2019' => '2019',
										'2020' => '2020',
										
										);
									echo form_dropdown('perpage',
										$attr_year,
										"2020",
										'class="form-control input-sm" onchange="submitFrm(document.forms.searchsubject)"');
										?>
								</label>
							</div>
							<div class="col-sm-6">
								<div class="col-xs-6 col-sm-6 col-md-6 text-right" style="padding-right: 0;">
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
											'class="form-control input-sm" onchange="submitFrm(document.forms.searchsubject)"');
											?>
									</label>
								</div>
								<div class="input-group input-group-sm col-xs-6 col-sm-6 col-lg-6 pull-right">
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
						<?php echo form_close();?>
					</div>
				</div>
				<!-- /Search box -->
				<div class="box-body no-padding">
					<table class="table table-striped table-hover rowclick">
						<thead>
							<tr>
								<th>Status</th>
								<th style="width: 70px;">Course code</th>
								<th style="width: 87px;">year</th>
								<th style="width: 95px;">???</th>
								<th style="width: 25%;">Name</th>
								<th style="width: 88px;">Code</th>
								<th class="hidden-xs">The description</th>
							</tr>
						</thead>
						<tbody>
						<?php
							if (($courseslist)) {
								foreach ($courseslist as $item) {
									echo "
									<tr href=\"".$this->misc->getHref('admin/courses/view')."/$item[course_id]\">
									<td class=\"status\">".$this->misc->getActiveStatusIcon($item['status']).
									' '.$this->misc->getVisibilityStatusIcon($item['visible'])."</td>
									<td>$item[code]</td>
									<td>".($item['year']+543)."</td>
									<td>".
										// <span class=\"jtooltip\" title=\"".
										// $this->misc->getFullDateTH($item['startdate'])."\">".
										// $this->misc->chrsDateToBudDate($item['startdate'],'-','/').
										// "</span>
									"</td>
									<td>$item[name]</td>
									<td>$item[shortname]</td>
									<td class=\"hidden-xs\">".$this->misc->getShortText(strip_tags($item['description']))."</td>
									</tr>
									";
								}
							} else {
								echo "<tr class='warning'><td colspan='4' class='text-center'>Data not found</td></tr>";
							}

						?>
						</tbody>
					</table>
				</div>
				<div class="box-footer clearfix">
					<?php echo $pagin;?>
				</div>
			</div>
		</div>
	</div>
	<script>
	function submitFrm(frm) {
		frm.submit();
	}</script>
<!-- End content -->