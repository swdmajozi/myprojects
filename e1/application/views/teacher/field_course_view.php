<!-- Begin content -->
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<span class="fa fa-briefcase"></span> <?php echo $pagetitle;?>
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><?php echo anchor('teacher', '<i class="fa fa-dashboard"></i> Homepage');?></li>
			<li><?php echo anchor('teacher/courses', 'Exam subject');?></li>
			<li class="active"><?php echo $pagesubtitle;?></li>
		</ol>
	</section>
	<section class="content">
		<h4 class="page-header">
			<small><?php echo $pagesubtitle;?></small>
		</h4>

		<?php
		$attr = array(
			'name' => 'course',
			'role' => 'form',
			'method' => 'post'
			);
		echo form_open($formlink, $attr);
		?>
		<div class="row">
			<div class="col-md-6 col-lg-6 col-md-offset-3">
<?php
if (isset($msg_error))
{
	echo <<<EOL
<div class="alert alert-danger hidden-xs alert-dismissable" style="min-width: 343px">
	<i class="fa fa-ban"></i>
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<b>Error</b> : $msg_error
</div>
<div class="alert alert-danger visible-xs alert-dismissable">
	<i class="fa fa-ban"></i>
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<b>Error</b> : $msg_error
</div>
EOL;
	}
	else
	{
		echo <<<EOL
<div class="alert alert-info hidden-xs" style="min-width: 343px">
	<i class="fa fa-info"></i>
	<b>A suggestion :</b> <b>Mark</b> <span class="text-danger">*</span>
	Required
</div>
<div class="alert alert-info visible-xs">
	<i class="fa fa-info"></i>
	<b>A suggestion :</b> <b>Mark</b> <span class="text-danger">*</span>
	Required
</div>
EOL;
	}
?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">

				<!-- Begin BasicInfo -->
				<div class="box nav-tabs-custom" style="border: none;">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#basic" data-toggle="tab">Foundation</a></li>
						<li><a href="#teachers" data-toggle="tab">Instructor</a></li>
						<li><a href="#students" data-toggle="tab">Student</a></li>
						<li><a href="#papers" data-toggle="tab">Exam set</a></li>
					</ul>
					<!-- Tab Content 1 -->
					<div class="tab-content">
						<div class="box-body tab-pane active" id="basic">
							<div class="form-group<?php if(form_error('subjectid')) echo ' has-error';?>">
								<?php
								echo form_label('Subject <span class="text-danger">*</span>', 'subjectid');
								$options = $this->courses->buildCourseOptions();
								echo form_dropdown('subjectid', $options, (isset($courseInfo['subject_id'])?$courseInfo['subject_id']:'default'), 'id="subjectid" class="form-control"');
								?>
							</div>
							<div class="form-group<?php if(form_error('description')) echo ' has-error';?>">
								<label>Course Description</label>
								<div id="courseDesc" class="text-justify">
									<?php echo (isset($courseInfo['description'])?$courseInfo['description']:'');?>
								</div>
							</div>
							<div class="form-group<?php if(form_error('year')) echo ' has-error';?>">
								<?php
								echo form_label('year <span class="text-danger">*</span>', 'year');
								$options = $this->misc->buildYearOptions();
								echo form_dropdown('year', $options, $courseInfo['year'], 'class="form-control"');
								?>
							</div>
							<div class="form-group<?php if(form_error('password')) echo ' has-error';?>">
								<?php
								echo form_label('Password', 'password');
								if ($this->courses->isEditPage()) $pwdinfo = "Password to change Leave blank. Will use the same password.";
								else $pwdinfo = "่";
								echo form_input(array(
									'id'=>'password',
									'name'=>'password',
									'type'=>'password',
									'class'=>'form-control '.($this->courses->isEditPage()?'jtooltip':''),
									'title'=>$pwdinfo));
								if ($this->courses->isEditPage())
								{
									echo '<label id="removepwdlbl" class="jtooltip" title="This action is effective when editing data.">';
									echo form_checkbox('removepass', '1', FALSE,'id="removepass" class="minimal-red"');
									echo " Password</label>";
								}

								?>
							</div>
							<!--
							<div class="form-group<?php if(form_error('startdate')) echo ' has-error';?>">
								<?php
								echo form_label('Open day <span class="text-danger">*</span>', 'startdate');
								?>
								<div class="input-group">
									<div class="input-group-addon add-on" style="cursor: pointer">
										<i class="fa fa-calendar"></i>
									</div>
									<div id="dp1p"></div>
									<?php
									echo form_input(array(
										'id'=>'startdate',
										'name'=>'startdate',
										'value'=>($courseInfo['startdate']!=""?$this->misc->chrsDateToBudDate($courseInfo['startdate'],"-","/"):$this->misc->chrsDateToBudDate(date("Y-m-d"),"-","/")),
										'type'=>'text',
										'class'=>'form-control date',
										'placeholder'=>'Open day',
										//'data-date-format'=>'dd/mm/yyyy',
										'readonly'=>'readonly'));
									?>
								</div>
								<?php echo form_error('startdate', '<span class="label label-danger">', '</span>');?>
							</div>
							-->
							<div class="form-group<?php if(form_error('visible')) echo ' has-error';?>">
								<?php echo form_label('More options'); ?><br>
								<label>
									<?php
									echo form_checkbox('visible', 'hidden', (isset($courseInfo['visible'])?$courseInfo['visible']=='1'?FALSE:TRUE:FALSE),'class="minimal-red"');
									?>
									Hide subjects
								</label>
							</div>
							<div class="form-group<?php if(form_error('status')) echo ' has-error';?>">
								<?php
								echo form_label('Status', 'status');
								?>
									<div>
										<label class="radio-inline">
											<?php echo form_radio('status', 'active', (isset($courseInfo['status'])?$courseInfo['status']=="active"?true:false:true),'class="minimal-red"')." Enable";?>
										</label>
										<label class="radio-inline">
											<?php echo form_radio('status', 'inactive', (isset($courseInfo['status'])?$courseInfo['status']=="inactive"?true:false:false),'class="minimal-red"')." Disabled";?>
										</label>
									</div>
									<?php echo form_error('status', '<span class="label label-danger">', '</span>'); ?>
							</div>
						</div>
						<!-- Teacher tab -->
						<div class="box-body tab-pane" id="teachers">
							<div class="row">
								<div class="col-md-12 text-center">
									<h3 class="" contenteditable="false">Choose a subject</h3>
								</div>
								<select name="teaselected[]" id="teacherList" class="def" size="10" multiple style="width:200px;height:300px">
									<?php
										foreach ($teacherListAvaliable as $item) {
											echo
											'<option value="'.$item['tea_id'].'">'.$item['name'].' '.$item['lname'].
											'</option>';
										}
										foreach ($teacherListinCourse as $item) {
											echo
											'<option value="'.$item['tea_id'].'" selected="selected">'.$item['name'].' '.$item['lname'].
											'</option>';
										}

									?>
								</select>

							</div>
						</div>
						<!-- Students tab -->
						<div class="box-body tab-pane" id="students">
							<div class="row">
								<div class="col-md-12 text-center">
									<h3 class="" contenteditable="false">Take the exam <?php echo $courseInfo['code'] . ' ' . $courseInfo['name']; ?></h3>
								</div>
								<div class="col-md-12">
									<a href="#addstdgroup" class="btn btn-app">
										<i class="fa fa-plus"></i> Add Group
									</a>

									<div class="sectorListGroup">
										<h4>Take the exam group in Subject </h4>
										<ul id="sectorListq" class="list-group">
											<?php
												foreach ($studentListGroups as $item) {
													echo "<a href=\"#group/".$item['group_id']."\" class=\"list-group-item\" data-group-id=\"$item[group_id]\">
													<span class=\"badge\">".$this->courses->countStudentInGroup($item['group_id'], $item['course_id'])."</span>
													<h4 class=\"list-group-item-heading\">$item[name]</h4>
													<div class=\"item-group-item-text\">$item[description]</div>
													</a>";
												}
											?>
										</ul>
									</div>
								</div>

								<!-- Group Dialog -->
								<div class="modal fade" id="stugroup">
									<div class="modal-dialog" style="width: 750px;">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
												<h4 class="modal-title">Student group</h4>
											</div>
											<div class="modal-body">
												<div class="row">
													<div class="col-md-12">
														<h4 id="stdgroupname"></h4>
														<div id="stdgroupdesc" style="padding-bottom: 20px"></div>
													</div>
													<div class="col-md-12">
														<div class="questionLoading" style="display: none;">
															<span><i class="fa fa-spinner fa-spin"></i> Loading...</span>
														</div>

														<select name="stdselected[]" id="studentList" class="def" size="10" multiple style="width:200px;height:300px">
															<?php
																foreach ($studentListAvaliable as $item) {
																	echo
																	'<option value="'.$item['stu_id'].'">'.$item['name'].' '.$item['lname'].
																	'</option>';
																}
																foreach ($studentListinCourse as $item) {
																	echo
																	'<option value="'.$item['stu_id'].'" selected="selected">'.$item['name'].' '.$item['lname'].
																	'</option>';
																}
															?>
														</select>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal" id="stdListDel"><i class="fa fa-trash-o"></i> Delete  Group</button>
												<button type="button" class="btn btn-primary" id="stdListSave"><i class="fa fa-save"></i> Save</button>
											</div>
										</div><!-- /.modal-content -->
									</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->

								<!-- add Group Dialog -->
								<div class="modal fade" id="addstugroup">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
												<h4 class="modal-title">Add Group students</h4>
											</div>
											<div class="modal-body">
												<div class="row">
													<div class="col-md-12">
														<div class="alert alert-danger alert-dismissable" style="display: none;">
															<i class="fa fa-ban"></i>
															<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
															<b>Please</b> Correct examination is required.
														</div>
													</div>
													<div class="col-md-12">
														<form id="addstugroupfrm" action="" class="form-inline">
															<div class="form-group">
																<?php
																echo form_label('Name Group <span class="text-danger">*</span>', 'name');
																echo form_input(array(
																	'id'=>'stdgname',
																	'name'=>'stdgname',
																	'type'=>'text',
																	'class'=>'form-control',
																	'placeholder'=>''));
																?>
															</div>
															<div class="form-group">
																<?php
																echo form_label('The description group', 'stdgdescription');
																echo form_textarea('stdgdescription', "", 'id="stdgdescription" class="form-control vert" style="height: 90px"');
																?>
															</div>
														</form>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
												<button type="button" class="btn btn-primary" id="stdListAdd"><i class="fa fa-plus"></i> Add</button>
											</div>
										</div><!-- /.modal-content -->
									</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->

								<div class="modal fade" id="delstdgask" data-backdrop="static">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> Are you sure ?</h4>
											</div>
											<div class="modal-body">
												<p>Would like to remove members and delete <b><span id="askstdgname"></span></b> Or not ?</p>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
												<button type="button" class="btn btn-danger" id="askstdgdelsure">Delete group</button>
											</div>
										</div><!-- /.modal-content -->
									</div><!-- /.modal-dialog -->
								</div><!-- /.modal -->
							</div>
						</div>
						<div class="box-body tab-pane" id="papers">
							<h3>Exam set</h3>
							<div class="row">
								<div class="col-md-12">
									<button type="button" class="btn btn-app" id="addPaper"><i class="fa fa-plus"></i>Add Exam set</button>
								</div>
								<div class="col-md-12">
									<ul class="list-group paper-list">
									<?php
										if(isset($examPapersList))
										{
											foreach ($examPapersList as $item) {
												list($startdate, $starttime) = explode(' ', $item['starttime']);
												list($enddate, $endtime) = explode(' ', $item['endtime']);
												$datetooltip = $this->misc->getFullDateTH($startdate)." ".$starttime.
												' ถึง '.$this->misc->getFullDateTH($enddate)." ".$endtime;
												$datediff = $this->misc->dateDifference($item['starttime'], $item['endtime']);
												/*
												echo <<<HTML
										<li>
											<span class="handle">
												<i class="fa fa-ellipsis-v"></i>
												<i class="fa fa-ellipsis-v"></i>
											</span>
											<span class="text"><b>{$item['title']}</b> <small>{$item['description']}</small></span>
											<span class="label label-info jtooltip" title="{$datetooltip}"><i class="fa fa-clock-o"></i> {$datediff}</span>
											<div class="tools">
												<i class="fa fa-edit"></i>
												<i class="fa fa-trash-o"></i>
											</div>
										</li>
HTML;
*/

												$paperparts = "";

												$paperPartsList = $this->courses->getExamPaperParts($item['paper_id']);
												foreach ($paperPartsList as $itemPart) {
													$paperparts .= <<<HTML
													<li data-partid="{$itemPart['part_id']}" id="part_{$itemPart['part_id']}">
														<span class="handle">
															<i class="fa fa-ellipsis-v"></i>
															<i class="fa fa-ellipsis-v"></i>
														</span>
														<span class="text"><b>{$itemPart['title']}</b> <small>{$itemPart['description']}</small></span>
														<div class="tools">
															<a href="{$this->misc->getHref('teacher/courses/editpart/')}/{$itemPart['part_id']}" class="jtooltip" title="Increase / decrease examination"><i class="fa fa-edit"></i></a>
															<a href="#remove" class="text-danger jtooltip" title="Delete episode"><i class="fa fa-trash-o"></i></a>
														</div>
													</li>
HTML;
												}
												$fullpagelink = anchor($role.'/courses/exampaper/'.$item['paper_id'], '<i class="fa fa-file-text-o"></i>','class="jtooltip" title="ดูExam set"');
												echo <<<HTML
												<li class="list-group-item" data-paperid="{$item['paper_id']}">
													<span class="badge"><i class="fa fa-clock-o"></i> {$datediff}</span>
													<div class="optionlinks">
														<span class="badge jtooltip" title="{$datetooltip}"><i class="fa fa-clock-o"></i> {$datediff}</span>
														<a href="#add" class="add jtooltip" title="Add episode">
															<i class="fa fa-plus"></i>
														</a>
														<a href="#edit" class="edit jtooltip" title="Edit Exam set">
															<i class="fa fa-edit"></i>
														</a>
														{$fullpagelink}
														<a href="#remove" class="remove text-danger jtooltip" title="Delete Exam set">
															<i class="fa fa-trash-o"></i>
														</a>
													</div>
													<div class="content-toggle-click">
														<h4 class="list-group-item-heading">{$item['title']}</h4>
														<div class="item-group-item-text">{$item['description']}</div>
													</div>
													<div class="content-toggle" style="display: none;">
														<ul class="todo-list part-list">
														{$paperparts}
														</ul>
													</div>
												</li>
HTML;
											}
										}
									?>
									</ul>
								</div>
							</div>

							<div class="modal fade" id="delpaperask" data-backdrop="static">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> Are you sure ?</h4>
										</div>
										<div class="modal-body">
											<p>Want to delete <b><span id="askpapername"></span></b> ?</p>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
											<a href="" data-link-paper="<?php echo $this->misc->getHref($this->session->userdata('role').'/courses/removepaper/'.$courseId).'/'; ?>" 
												data-link-part="<?php echo $this->misc->getHref($this->session->userdata('role').'/courses/removepart/'.$courseId).'/'; ?>" class="btn btn-danger" id="askpaperdelsure">Delete this set</a>
										</div>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
						</div>

					</div>
					<div class="box-footer text-right">
					<?php
					echo form_submit('submit', $this->courses->btnSaveText(), 'class="btn btn-primary"');
					?>
					</div>
				</div>
				<!-- End BasicInfo -->
			</div>
		</div>
		<?php form_close(); ?>
		<div class="modal fade" id="modaladdpaper" data-backdrop="static">
			<?php
				$attr = array(
					'name' => 'addpaper',
					'role' => 'form',
					'method' => 'post'
				);
				echo form_open($formlinkaddpaper, $attr);
				echo form_hidden('method', 'add');
				echo form_hidden('paper', '');
			?>
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">
								<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
							</button>
							<h4 class="modal-title"><i class="fa fa-plus"></i> Create Exam set</h4>
						</div>
						<div class="modal-body">
							<div class="alert alert-danger alert-dismissable" style="display: none;">
								<i class="fa fa-ban"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<b>Please</b> Correct examination is required.
							</div>
							<div class="form-group">
								<?php
								echo form_label('Name <span class="text-danger">*</span>', 'title');
								echo form_input(array(
									'id'=>'title',
									'name'=>'title',
									'type'=>'text',
									'class'=>'form-control',
									'placeholder'=>'Name'));
								?>
							</div>
							<div class="form-group">
								<?php
								echo form_label('The description', 'description');
								echo form_textarea('description', "", 'id="paperdesc" class="form-control vert" style="height: 90px"');
								?>
							</div>
							<div class="form-group">
								<?php
								echo form_label('Rules In The exam', 'rules');
								echo form_textarea('rules', "", 'id="paperrules" class="form-control vert" style="height: 90px"');
								?>
							</div>
							<div class="form-group">
								<?php
								echo form_label('Term <span class="text-danger">*</span>', 'semester');
								$options = $this->misc->buildsemesterOptions();
								echo form_dropdown('semester', $options, 'default', 'class="form-control"');
								?>
							</div>
							<div class="form-group" >
								<?php
								echo form_label('Date range <span class="text-danger">*</span>', '');
								?>
								<div class="input-daterange input-group col-xs-12" id="datepicker">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" class="input-md form-control" name="startdate" value="<?php echo date('d/m/Y');?>" autocomplete="off">
									<span class="input-group-addon" style="border-left-width: 0;border-right-width: 0;">To</span>
									<input type="text" class="input-md form-control" name="enddate" value="<?php echo date('d/m/Y');?>" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label>ช่วงเวลา <span class="text-danger">*</span></label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-clock-o"></i>
									</div>
									<div class="bootstrap-timepicker">
										<input type="text" class="form-control timepicker" name="starttime" value="<?php echo date('H:i');?>" autocomplete="off">
									</div>
									<span class="input-group-addon" style="border-left-width: 0;border-right-width: 0;">To</span>
									<div class="bootstrap-timepicker">
										<input type="text" class="form-control timepicker" name="endtime" value="<?php echo date('H:i');?>" autocomplete="off">
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="reset" class="btn btn-default" data-dismiss="modal">cancel</button>
							<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Create</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			<?php echo form_close(); ?>
		</div><!-- /.modal -->

		<div class="modal fade" id="modaladdpart" data-backdrop="static">
			<?php
				$attr = array(
					'name' => 'addpart',
					'role' => 'form',
					'method' => 'post'
				);
				echo form_open($formlinkaddpart, $attr);
				echo form_hidden('paper_id', '-1');
			?>
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">
								<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
							</button>
							<h4 class="modal-title"><i class="fa fa-plus"></i> Add episode</h4>
						</div>
						<div class="modal-body">
							<div class="alert alert-danger alert-dismissable" style="display: none;">
								<i class="fa fa-ban"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<b>Please</b> Correct examination is required
							</div>
							<div class="form-group">
								<?php
								echo form_label('Order <span class="text-danger">*</span>', 'no');
								echo form_input(array(
									'id'=>'no',
									'name'=>'no',
									'type'=>'text',
									'class'=>'form-control',
									'placeholder'=>''));
								?>
							</div>
							<div class="form-group">
								<?php
								echo form_label('The topic <span class="text-danger">*</span>', 'title');
								echo form_input(array(
									'id'=>'title',
									'name'=>'title',
									'type'=>'text',
									'class'=>'form-control',
									'placeholder'=>''));
								?>
							</div>
							<div class="form-group">
								<?php
								echo form_label('The description', 'description');
								echo form_textarea('description', "", 'id="paperdesc" class="form-control vert" style="height: 90px"');
								?>
							</div>
							<div class="form-group">
								<?php
								echo form_label('Pattern examination', 'qtype');
								$options = null;
								$options['any'] = "Indeterminate";
								$options['choice'] = "objective";
								$options['boolean'] = "Right / wrong";
								$options['numeric'] = "Answer numbers";
								echo form_dropdown('qtype', $options, 'default', 'class="form-control"');
								?>
							</div>
							<div class="form-group">
								<label><?php
								echo form_checkbox('random', 'true', FALSE,'class="minimal-red"');
								?> Random examination</label>
							</div>
						</div>
						<div class="modal-footer">
							<button type="reset" class="btn btn-default" data-dismiss="modal">cancel</button>
							<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> add</button>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			<?php echo form_close(); ?>
		</div><!-- /.modal -->
<!-- End content -->