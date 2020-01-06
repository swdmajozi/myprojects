   <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><i class="icon-plus-sign icon-large"> Register New Question</i></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
								<form method="post">
										<div class="control-group">
                                          <div class="controls">
                                            <input class="input focused" name="examdesc" id="focusedInput" type="text" placeholder = "Exam Description" required>
                                          </div>
                                        </div>
										
										<div class="control-group">
                                          <div class="controls">
                                            <input class="input focused" name="questiondesc" id="focusedInput" type="text" placeholder = "Question Description" required>
                                          </div>
                                        </div>
										<div class="control-group">
                                          <div class="controls">
                                            <input class="input focused" name="valueoptions" id="focusedInput" type="text" placeholder = "A" required>
                                          </div>
                                        </div>
										<div class="control-group">
                                          <div class="controls">
                                            <input class="input focused" name="valueoptionsb" id="focusedInput" type="text" placeholder = "B" required>
                                          </div>
                                        </div>
										<div class="control-group">
                                          <div class="controls">
                                            <input class="input focused" name="valueoptionsc" id="focusedInput" type="text" placeholder = "C" required>
                                          </div>
                                        </div>
										<div class="control-group">
                                          <div class="controls">
                                            <input class="input focused" name="valueoptionsd" id="focusedInput" type="text" placeholder = "D" required>
                                          </div>
                                        </div>
										<div class="control-group">
                                          <div class="controls">
                                            <input class="input focused" name="questionanswer" id="focusedInput" type="text" placeholder = "Correct Answer" required>
                                          </div>
                                        </div>
											
										
										
											<div class="control-group">
                                          <div class="controls">
												<button name="save" class="btn btn-info" id="save" data-placement="right" title="Click to Save"><i class="icon-plus-sign icon-large"> Save</i></button>
                                                <script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#save').tooltip('show');
	                                            $('#save').tooltip('hide');
	                                            });
	                                            </script>
                                          </div>
                                        </div>
                                </form>
								</div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
								
<?php

if (isset($_POST['save'])){
$examdesc = $_POST['examdesc'];
$questiondesc = $_POST['questiondesc'];
$valueoptions = $_POST['valueoptions'];
$valueoptionsb = $_POST['valueoptionsb'];
$valueoptionsc = $_POST['valueoptionsc'];
$valueoptionsd = $_POST['valueoptionsd'];
$questionanswer = $_POST['questionanswer'];





mysql_query("insert into offering (examdesc,questiondesc,valueoptions,valueoptionsb,valueoptionsc,valueoptionsd,questionanswer) values('$examdesc','$questiondesc','$valueoptions','$valueoptionsb','$valueoptionsc','$valueoptionsd','$questionanswer')")or die(mysql_error());

?>
<script>
window.location = "add_offering.php";
$.jGrowl("The Question Successfully added", { header: 'Question added' });
</script>
<?php
}

?>