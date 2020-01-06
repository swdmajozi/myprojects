<?php error_reporting(0);?>
<div class="row-fluid">				  
   <a href="add_visitor.php" class="btn btn-info" id="add" data-placement="right" title="Click to Add New" ><i class="icon-plus-sign icon-large"></i> Add New Exam</a>
   <script type="text/javascript">
	$(document).ready(function(){
	$('#add').tooltip('show');
	$('#add').tooltip('hide');
	});
	</script> 
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><i class="icon-pencil icon-large"></i> Edit Exam Info.</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
								<?php
								$query = mysql_query("select * from visitor where id = '$get_visitor_id'")or die(mysql_error());
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
                                     <input class="input focused" name="startdate" value="<?php echo $row['startdate']; ?>" id="focusedInput" type="date" placeholder = "Start Date" required> 
                                   </p>
                                 </div>
                                  </div>
								  <div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="enddate" id="focusedInput" value="<?php echo $row['enddate']; ?>" type="date" placeholder = "End Date" required> 
                                   </p>
                                 </div>
                                  </div>
								 
								  </p>
								  
								  	
										
										
									<div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="duration" id="focusedInput" value="<?php echo $row['duration']; ?>" type="time" placeholder = "Duration" required> 
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
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];
$duration = $_POST['duration'];


mysql_query("UPDATE visitor SET examdesc = '$examdesc',startdate ='$startdate',enddate='$enddate',duration='$duration'  where id='$get_visitor_id'") 
or die(mysql_error());

mysql_query ("insert into activity_log (date,username,action)
 values(NOW(),'$admin_username','Edited Visitor $sname')")or die(mysql_error());
?>
<script>
  window.location = "visitor.php";
 $.jGrowl(" Exam Successfully Update", { header: 'Exam Update' });  
</script>
<?php
}
?>
