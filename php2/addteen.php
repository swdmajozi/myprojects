
  <div class="row-fluid">
                        <!-- block -->
 <div class="block">
 <div class="navbar navbar-inner block-header">
<div class="muted pull-left"><i class="icon-plus-sign icon-large"> Register New Examinee</i></div>
</div>
<div class="block-content collapse in">
                                <div class="span12">
								
								 <!--------------------form------------------->
								<form method="post">
					<div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="fname" id="focusedInput" type="text" placeholder = "First Name" required> 
                                   </p>
                                 </div>
                                  </div>
								  </p>
								  <div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="sname" id="focusedInput" type="text" placeholder = "Middle Name" required> 
                                   </p>
                                 </div>
                                  </div>
								  <div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="lname" id="focusedInput" type="text" placeholder = "Last name" required> 
                                   </p>
                                 </div>
                                  </div>
								  <div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                      <select class="input focused" name="gender" id="focusedInput" required="required" type="text">
  <option value="Select Gender">Select Gender</option>
  <option value="male">Male</option>
  <option value="Female">Female</option>

</select>   
                                   </p>
								   
                                 </div>
                                  </div>
								  <div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                      <select class="input focused" name="department" id="focusedInput" required="required" type="text">
  <option value="Select Gender">Select Department</option>
  <option value="accounting">Accounting</option>
  <option value="computer">Computer Science</option>
  <option value="management">Management</option>
  <option value="midwifery">Midwifery</option>

</select>   
                                   </p>
								   
                                 </div>
                                  </div>
								  </p>
								  								  
								 
								  	
										
										<div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="email" id="focusedInput" type="email" placeholder = "E-mail" required> 
                                   </p>
                                 </div>
                                  </div>
								  </p>
									<div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                     <input class="input focused" name="mobile" id="focusedInput" type="text" placeholder = "Mobile Number" required> 
                                   </p>
                                 </div>
                                  </div>
								  </p>
								  <div class="control-group">
                                <p> <div class="controls">
                                   <p>
                                    
                                   </p>
                                 </div>
                                  </div>
								  </p>
								 							 
								  </p>
								  <div class="control-group">
                                <p> <div class="controls">
                                   <p>
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
$fname = $_POST['fname'];
$sname = $_POST['sname'];
$lname = $_POST['lname'];
$gender = $_POST['gender'];
$department = $_POST['department'];
$email= $_POST['email'];
$mobile= $_POST['mobile'];
//$id = $_POST['id'];


$query = @mysql_query("select * from teens where  mobile = '$mobile' ")or die(mysql_error());
$count = mysql_num_rows($query);

if ($count > 0){ ?>
<script>
alert('This Examinee  Already Exists');
</script>
<?php
}else{
mysql_query("insert into teens (fname,sname,lname,gender,department,email,mobile,id) 
values('$fname','$sname','$lname','$gender','$department','$email','$mobile','$mobile')")or die(mysql_error());

mysql_query("insert into activity_log (date,username,action) values(NOW(),'$admin_username','Added member $mobile')")or die(mysql_error());
?>
<script>
window.location = "add_teen.php";
$.jGrowl("Examinee Successfully added", { header: 'Examinee add' });
</script>
<?php
}
}
?>