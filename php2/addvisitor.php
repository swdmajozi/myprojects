
  <div class="row-fluid">
                        <!-- block -->
 <div class="block">
 <div class="navbar navbar-inner block-header">
<div class="muted pull-left"><i class="icon-plus-sign icon-large"> Register New Exam</i></div>
</div>
<div class="block-content collapse in">
                                <div class="span12">
								
								 <!--------------------form------------------->
								<form method="post">
					<div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="examdesc" id="focusedInput" type="text" placeholder = "Exam Description" required> 
                                   </p>
                                 </div>
                                  </div>
								  </p>
								  							 
								  <div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="startdate" id="focusedInput" type="date" placeholder = "Start Date" required> 
                                   </p>
                                 </div>
                                  </div>
								  </p>
								  
								   <div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="enddate" id="focusedInput" type="date" placeholder = "End Date" required> 
                                   </p>
                                 </div>
                                  </div>
								  </p>
								  
								<div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="duration" id="focusedInput" type="text" placeholder = "Duration" required> 
                                   </p>
                                 </div>
                                  </div>
								 
								 							 
								  </p>
								  
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
                  				 
<?php
if (isset($_POST['save'])){
$examdesc = $_POST['examdesc'];
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];
$duration = $_POST['duration'];



$query = @mysql_query("select * from visitor where  id = '$id'  ")or die(mysql_error());
$count = mysql_num_rows($query);

if ($count > 0){ ?>
<script>
alert('This Visitor  Already Exists');
</script>
<?php
}else{
mysql_query("insert into Visitor(examdesc,startdate,enddate,duration) 
values('$examdesc','$startdate','$enddate','$duration')")or die(mysql_error());

mysql_query("insert into activity_log (date,username,action) values(NOW(),'$admin_username','Added member $mobile')")or die(mysql_error());
?>
<script>
window.location = "add_visitor.php";
$.jGrowl("member Successfully added", { header: 'member add' });
</script>
<?php
}
}
?>