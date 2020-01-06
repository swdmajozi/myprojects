<?php error_reporting(0);?>
<div class="row-fluid">				  
   <a href="add_offering.php" class="btn btn-info" id="add" data-placement="right" title="Click to Add New" ><i class="icon-plus-sign icon-large"></i> Add New Question</a>
   <script type="text/javascript">
	$(document).ready(function(){
	$('#add').tooltip('show');
	$('#add').tooltip('hide');
	});
	</script> 
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><i class="icon-pencil icon-large"></i> Edit Question Info.</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
								<?php
								$query = mysql_query("select * from offering where offeringid = '$get_offering_id'")or die(mysql_error());
								$row = mysql_fetch_array($query);
								?>
								
								 <!-- --------------------form ---------------------->						
										<form method="post">
					<div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="examdesc"  value="<?php echo $row['examdesc']; ?>" id="focusedInput" type="text" placeholder = "Exam Description" required> 
                                   </p>
                                 </div>
                                  </div>
								  </p>
								  <div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="questiondesc" value="<?php echo $row['questiondesc']; ?>" id="focusedInput" type="text" placeholder = "Question Description" required> 
                                   </p>
                                 </div>
                                  </div>
								  <div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="valueoptions" id="focusedInput" value="<?php echo $row['valueoptions']; ?>" type="text" placeholder = "Value Options" required> 
                                   </p>
                                 </div>
                                  </div>
								 
								  </p>
								  	<div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="valueoptionsb" id="focusedInput" value="<?php echo $row['valueoptionsb']; ?>" type="text" placeholder = "Value Options" required> 
                                   </p>
                                 </div>
                                  </div>
								 
								  </p>
								  <div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="valueoptionsc" id="focusedInput" value="<?php echo $row['valueoptionsc']; ?>" type="text" placeholder = "Value Options" required> 
                                   </p>
                                 </div>
                                  </div>
								 
								  </p>
								  <div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="valueoptionsd" id="focusedInput" value="<?php echo $row['valueoptionsd']; ?>" type="text" placeholder = "Value Options" required> 
                                   </p>
                                 </div>
                                  </div>
								 
								  </p>
									<div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="questionanswer" id="focusedInput" value="<?php echo $row['questionanswer']; ?>" type="text" placeholder = "Question Answer" required> 
                                   </p>
                                 </div>
                                  </div>
								  </p>
								  
								 
                                    </div>
										
                                
                                        
										<div class="control-group">
                                          <div class="controls">
 <button name="update" class="btn btn-info" id="update" data-placement="right" title="Click to Update"><i class="icon-plus-sign icon-large"> Update</i></button>
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
      
<?php		
if (isset($_POST['update'])){
$examdesc = $_POST['examdesc'];
$questiondesc = $_POST['questiondesc'];
$valueoptions = $_POST['valueoptions'];
$valueoptionsb = $_POST['valueoptionsb'];
$valueoptionsc = $_POST['valueoptionsc'];
$valueoptionsd = $_POST['valueoptionsd'];
$questionanswer = $_POST['questionanswer'];


mysql_query("UPDATE offering SET examdesc = '$examdesc',questiondesc ='$questiondesc',valueoptions='$valueoptions',valueoptionsb='$valueoptionsb',valueoptionsc='$valueoptionsc',valueoptionsd='$valueoptionsd',questionanswer='$questionanswer'  where offeringid='$get_offering_id'") 
or die(mysql_error());

mysql_query ("insert into activity_log (date,username,action)
 values(NOW(),'$admin_username','Edited Visitor $sname')")or die(mysql_error());
?>
<script>
  window.location = "add_offering.php";
 $.jGrowl(" Question Successfully Updated", { header: 'Question Update' });  
</script>
<?php
}
?>
