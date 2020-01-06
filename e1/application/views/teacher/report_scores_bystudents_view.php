<!-- Begin content -->
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<span class="fa fa-bar-chart-o"></span> report <?php echo "$courseInfo[code] $courseInfo[name]";?><small></small>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo anchor('teacher', '<i class="fa fa-dashboard"></i> Homepage');?></li>
			<li class="active">report</li>
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
<div class="row <?php if($this->session->flashdata('noAnim')) echo "animate-fade-up";?>">
	<div class="col-md-12">
		<div class="box box-info nav-tabs-custom">
			<ul class="nav nav-tabs  pull-right">
				<li class="pull-left header">
					<i class="glyphicon glyphicon-th"></i> <?=$pagetitle?>
				</li>
			</ul>
			<div class="tab-content">
				<!-- Search Box -->
				<div class="box-body">
					<div class="row">
						<?php
						$attr = array(
							'name' => 'mycourses',
							'class' => 'form-inline searchform',
							'role' => 'search',
							'method' => 'get'
							);
						echo form_open('teacher/reports/bystudent/'.$courseInfo['course_id'], $attr); ?>
							<div class="col-sm-6" style="z-index:500;">
								
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
											'class="form-control input-sm" onchange="submitFrm(document.forms.mycourses)"');
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
			</div>
			<div class="box-body no-padding">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>ผู้สอบ</th>
							<?php
								$ColCount = sizeof($reportCols);
								foreach ($reportCols as $col) {
									echo "<th>$col[title]</th>";
								}
							?>
							<th>รวมคะแนน</th>
						</tr>
					</thead>
					<tbody>
					<?php
						if (($reportRows)) {
							foreach ($reportRows as $item) {
								$stdGroup[$item['groupname']][] = $item;
							}
							foreach ($stdGroup as $groupkey => $groupval) {
								echo '<tr><td colspan="3" style="background-color: #fff;vertical-align: bottom; border-bottom: 2px solid #ddd; font-weight: bold;">'.$groupkey.'</td></tr>';
								foreach ($groupval as $item) {
									
									echo <<<html
									<tr>
									<td>{$item['stu_id']} {$item['title']}{$item['name']} {$item['lname']}</td>
html;
									$sum = 0;
									foreach ($reportCols as $col) {
										$colname = 'paper_'.$col['paper_id'];
										if ($item[$colname] !== null)
										{
											echo "<td>".$item[$colname]."</td>";
											$sum += $item[$colname];
										}
										else
											echo "<td><i class='fa fa-square jtooltip' title='ยังไม่ได้สอบ'></i></td>";
									}
									echo "<td>$sum</td>
									</tr>";
								}
							}
						} else {
							echo "<tr class='warning'><td colspan='7' class='text-center'>Data not found</td></tr>";
						}

					?>
					</tbody>
				</table>
			</div>
			<div class="box-footer clearfix">
				<?php //echo $pagin;?>
			</div>
		</div>
	</div>
	<div class="modal fade paperstdscore" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		
	</div>
	<script>
	function submitFrm(frm) {
		frm.submit();
	}</script>
<!-- End content -->