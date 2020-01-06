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
			<li><?php echo anchor('teacher/qwarehouse', 'Exam bank');?></li>
			<li class="active"><?php echo $pagetitle;?></li>
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
?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">

				<!-- Begin box -->
				<div class="box nav-tabs-custom" style="border: none;">
					<ul class="nav nav-tabs">
						<li><?php echo anchor('teacher/qwarehouse/view/'.$subjectInfo['code'], 'foundation');?>
						<li><?php echo anchor('teacher/qwarehouse/view/'.$subjectInfo['code'].'#chapter', 'Chapter');?></li>
						<li class="active"><a href="#questions" data-toggle="tab">Question</a></li>
					</ul>

					<div class="tab-content">
						<!-- Questions tab -->
						<div class="box-body tab-pane active" id="questions">
							<div class="row">
								<div class="col-md-12 text-center">
									<h3 class=""></h3>
								</div>
								<div class="col-sm-4">
									<div class="chapterListGroup">
										<h4>Chapters / episodes</h4>
										<ul id="chapterListq" class="list-group">
											<?php
												foreach ($chapterList as $item) {
													echo "<a href=\"".$this->misc->getHref("teacher/qwarehouse/viewq")."/$subjectInfo[code]/$item[chapter_id]\" class=\"list-group-item".(($item['chapter_id']==$chapterid)?" active":"")."\" data-chapter-id=\"$item[chapter_id]\">
													<span class=\"badge\"></span>
													<h4 class=\"list-group-item-heading\">$item[name]</h4>
													<div class=\"item-group-item-text\">$item[description]</div>
													</a>";
												}
											?>
										</ul>
									</div>
								</div>
								<div class="col-sm-8 pull-right">
									<h4>Question</h4>
									<div class="modal fade" id="newQuestion" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
													<h4 class="modal-title"><i class="fa fa-clipboard"></i> Add a problem</h4>
												</div>
												<div class="modal-body">
													<!-- Form wrapper -->
													<form id="qnew" name="qnew" class="form-inline form-question-item">
														<div class="form-group">
															<?php
															echo form_label('Proposition <span class="text-danger">*</span>', 'question');
															echo form_textarea('question', "", 'id="question" class="form-control"');
															// echo form_input(array(
															// 	'id'=>'question',
															// 	'name'=>'question',
															// 	'value'=>"",
															// 	'type'=>'text',
															// 	'class'=>'form-control',
															// 	));
															?>
														</div>
														<div class="form-group">
															<?php echo form_label('Type examination', 'qtype');
																$options = array(
																	'choice' => "objective",
																	'numeric' => "Fill the answer with numbers.",
																	'boolean' => "Right / wrong",
																);
																echo form_dropdown('qtype', $options, 'default', 'id="qtype" class="form-control"');
															?>
														</div>
														<div id="choice" class="question-type">
															<div class="form-group">
																<?php
																echo form_label('Options <span class="text-danger">*</span>', 'correct');
																?>
																<div class="radio">
																	<div class="col-xs-1 no-padding">
																		<label>
																			<?php
																				echo form_radio('correct', '1', false,'class="minimal-red correct-choice"')." ";
																			?>
																		</label>
																	</div>
																	<div class="col-xs-11">
																		<div class="form-inline">
																			<label id="c1" class="choice">
																				<span class="clabel">1)</span>
																				<?php
																					echo form_input(array(
																						'id'=>'choice1',
																						'name'=>'choice1',
																						'value'=>"",
																						'type'=>'text',
																						'class'=>'form-control',
																						'style'=>'width: 92%;'
																					));
																				?>
																			</label>
																		</div>
																	</div>
																</div>
																<div class="radio">
																	<div class="col-xs-1 no-padding">
																		<label>
																			<?php
																				echo form_radio('correct', '2', false,'class="minimal-red correct-choice"')." ";
																			?>
																		</label>
																	</div>
																	<div class="col-xs-11">
																		<div class="form-inline">
																			<label id="c2" class="choice">
																				<span class="clabel">2)</span>
																				<?php
																					echo form_input(array(
																						'id'=>'choice2',
																						'name'=>'choice2',
																						'value'=>"",
																						'type'=>'text',
																						'class'=>'form-control',
																						'style'=>'width: 92%;'
																					));
																				?>
																			</label>
																		</div>
																	</div>
																</div>
																<div class="radio">
																	<div class="col-xs-1 no-padding">
																		<label>
																			<?php
																				echo form_radio('correct', '3', false,'class="minimal-red correct-choice"')." ";
																			?>
																		</label>
																	</div>
																	<div class="col-xs-11">
																		<div class="form-inline">
																			<label id="c3" class="choice">
																				<span class="clabel">3)</span>
																				<?php
																					echo form_input(array(
																						'id'=>'choice3',
																						'name'=>'choice3',
																						'value'=>"",
																						'type'=>'text',
																						'class'=>'form-control',
																						'style'=>'width: 92%;'
																					));
																				?>
																			</label>
																		</div>
																	</div>
																</div>
																<div class="radio">
																	<div class="col-xs-1 no-padding">
																		<label>
																			<?php
																				echo form_radio('correct', '4', false,'class="minimal-red correct-choice"')." ";
																			?>
																		</label>
																	</div>
																	<div class="col-xs-11">
																		<div class="form-inline">
																			<label id="c4" class="choice">
																				<span class="clabel">4)</span>
																				<?php
																					echo form_input(array(
																						'id'=>'choice4',
																						'name'=>'choice4',
																						'value'=>"",
																						'type'=>'text',
																						'class'=>'form-control',
																						'style'=>'width: 92%;'
																					));
																				?>
																			</label>
																		</div>
																	</div>
																</div>
																<div class="radio">
																	<div class="col-xs-1 no-padding">
																		<label>
																			<?php
																				echo form_radio('correct', '5', false,'class="minimal-red correct-choice"')." ";
																			?>
																		</label>
																	</div>
																	<div class="col-xs-11">
																		<div class="form-inline">
																			<label id="c5" class="choice">
																				<span class="clabel">5)</span>
																				<?php
																					echo form_input(array(
																						'id'=>'choice5',
																						'name'=>'choice5',
																						'value'=>"",
																						'type'=>'text',
																						'class'=>'form-control',
																						'style'=>'width: 92%;'
																					));
																				?>
																			</label>
																		</div>
																	</div>
																</div>
																<div class="radio">
																	<div class="col-xs-1 no-padding">
																		<label>
																			<?php
																				echo form_radio('correct', '6', false,'class="minimal-red correct-choice"')." ";
																			?>
																		</label>
																	</div>
																	<div class="col-xs-11">
																		<div class="form-inline">
																			<label id="c6" class="choice">
																				<span class="clabel">6)</span>
																				<?php
																					echo form_input(array(
																						'id'=>'choice6',
																						'name'=>'choice6',
																						'value'=>"",
																						'type'=>'text',
																						'class'=>'form-control',
																						'style'=>'width: 92%;'
																					));
																				?>
																			</label>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div id="numeric" class="question-type">
															<div class="form-group">
																<?php
																echo form_label('Correct Answer <span class="text-danger">*</span>', 'correct');
																echo form_input(array(
																	'id'=>'correct-numeric',
																	'name'=>'correct',
																	'value'=>'',
																	'type'=>'text',
																	'class'=>'form-control correct-numeric',
																	));
																?>
															</div>
														</div>
														<div id="boolean" class="question-type">
															<div class="form-group">
																<?php
																echo form_label('Right / wrong <span class="text-danger">*</span>', 'correct');
																?>
																<div class="radio">
																	<div class="col-xs-1 no-padding">
																		<label>
																			<?php
																				echo form_radio('correct', 't', false,'class="minimal-red correct-boolean"')." ";
																			?>
																		</label>
																	</div>
																	<div class="col-xs-11">
																		<div class="form-inline">
																			<label class="boolean">
																				<span class="clabel">Correct</span>
																			</label>
																		</div>
																	</div>
																</div>
																<div class="radio">
																	<div class="col-xs-1 no-padding">
																		<label>
																			<?php
																				echo form_radio('correct', 'f', false,'class="minimal-red correct-boolean"')." ";
																			?>
																		</label>
																	</div>
																	<div class="col-xs-11">
																		<div class="form-inline">
																			<label class="boolean">
																				<span class="clabel">Wrong</span>
																			</label>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="form-group">
															<?php echo form_label('Status', 'status');
																$options = array(
																	'active' => "<i class=\"text-green fa fa-circle\"></i>Available",
																	'inactive' => "Unavailable",
																	'draft' => "Draft",
																);
																//echo form_dropdown('status', $options, 'default', 'id="qstatus" class="form-control"');
															?>
															<select name="status" id="qstatus" class="form-control">
																<option data-content="<i class='text-green fa fa-circle'></i> Available" value="active">Available</option>
																<option data-content="<i class='text-muted fa fa-circle'></i> Unavailable" value="inactive">Unavailable</option>
																<option data-content="<i class='fa fa-circle-o'></i> Draft" value="draft">Draft</option>
															</select>
														</div>
													</form> <!-- End  Form wrapper  -->
												</div>
												<div class="modal-footer">
													<?php
														$button = array(
															'id' => 'closeNewQuestion',
															'type' => 'button',
															'content' => 'cancel',
															'class' => 'btn btn-default',
															'data-dismiss' => 'modal'
														);
														echo form_button($button);

														$button = array(
															'id' => 'addQuestion',
															'type' => 'button',
															'content' => '<i class="fa fa-plus"></i> เพิ่ม',
															'class' => 'btn btn-primary'
														);
														echo form_button($button);
													?>
												</div>
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
									</div><!-- /.modal -->
<?php 
								if($chapterid != '')
								{
									echo <<<HTML
									<button class="btn btn-app" data-toggle="modal" data-target="#newQuestion">
										<i class="fa fa-plus"></i> Add a problem
									</button>
HTML;
								}
								else
								{
									echo "<h3>Choose chapter / episode</h3>";
								}
?>
									<div class="questionLoading" style="display: none;">
										<span><i class="fa fa-spinner fa-spin"></i> Loading...</span>
									</div>
								</div>
							</div>
							<!-- Question list as Table -->
							<div class="row">
								<div class="col-md-12">
									<h2 class="page-header"><small>show <b><?php echo $perpage;?></b> List from all <b><?php echo $total;?></b> list</small></h2>
									<table class="table table-striped table-hover rowclick ellipsis">
										<thead>
											<tr>
												<th style="width: 50px;">#</th>
												<th style="width: 40%;">proposition</th>
												<th>The format</th>
												<th style="width: 13%;">Answer</th>
												<th style="width: 20%;">by</th>
											</tr>
										</thead>
										<tbody id="questionListTable">
											<?php
												if (($questionlist)) {
													foreach ($questionlist as $item) {
														echo "
														<tr id=\"question-$item[question_id]\" href=\"".$this->misc->getHref('teacher/qwarehouse/editq/')."/$item[question_id]\">
														<td>$item[question_id]</td>
														<td>$item[question]</td>
														<td>";

														switch ($item['type']) {
															case 'choice':
																echo "objective";
																break;
															case 'numeric':
																echo "Answer with numbers";
																break;
															case 'boolean':
																echo "Right / wrong";
																break;
															case 'matching':
																echo "Match";
																break;
														}

														if ($item['type'] == "choice") {
															if ($item['answer_choice'] == "1") $answer = $item['choice1'];
															elseif ($item['answer_choice'] == "2") $answer = $item['choice2'];
															elseif ($item['answer_choice'] == "3") $answer = $item['choice3'];
															elseif ($item['answer_choice'] == "4") $answer = $item['choice4'];
															elseif ($item['answer_choice'] == "5") $answer = $item['choice5'];
															elseif ($item['answer_choice'] == "6") $answer = $item['choice6'];
														}
														if ($item['type'] == "boolean")
														{
															if (strtolower($item['answer_boolean']) == "t")
																$answer = "Correct";
															else
																$answer = "Wrong";
														}
														elseif ($item['type'] == "numeric")
														{
															$answer = $item['answer_numeric'];
														}
														list($date, $time) = explode(' ', $item['created_time']);
														echo "</td>
														<td>$answer</td>
														<td>
															<span class=\"jtooltip\" title=\"".
															$this->misc->getFullDateTH($date)."<br>เวลา ".$time."\">".
															$item['created_by'].
															"</span>
														</td>

														</tr>
														";
													}
												} else {
													$this->load->view('teacher/question_notfound_view');
												}

											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="box-footer text-right clearfix">
					<?php echo $pagin;?>
					</div>
				</div>
				<!-- End BasicInfo -->
			</div>
		</div>
		<?php form_close(); ?>
<!-- End content -->