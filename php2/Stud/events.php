
<?php include('header.php'); ?>
<?php include('session.php'); ?>
    <body>
		<?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('sidebar.php'); ?>
				<form name="course" id="course" method="post" action="course.php"> 
				<select  name="courses" id="courses">
								<option value="">Select Course</option>
				<?php	
		            $members_query = mysql_query("SELECT `examdesc` FROM `visitor`")or die(mysql_error());
					while($row = mysql_fetch_array($members_query)){
						echo "<option value='".$row['examdesc']."'>".$row['examdesc']."</option>";					
					}

					$members_query = mysql_query("SELECT * FROM `offering` WHERE `examdesc`='".@$_SESSION["course"]."'")or die(mysql_error());
		            $count = mysql_num_rows($members_query);	
                 ?>	
							</select>	
				</form>	
				


							<div class="span9" id="content">
                     <div class="row-fluid">
					

					 <div id="sc" align="center"><image src="images/sclogo.png" width="45%" height="45%"/></div>
				
				
				   <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                             <div class="muted pull-left"><i class="icon-reorder icon-large">
                             </i> Course Name: <b><?php echo @$_SESSION["course"]; ?></b>
                        	 Number of Question: <span class="badge badge-info"><?php  echo @$count; ?></span>
                 
                             </div>
                          <div class="pull-right">
								<b>Duration: <p style="display: inline-block;" id="response"></p></b>
							 </div>
						  </div>
						  
                 

<script type="text/javascript">
	
	var times = setInterval(function(){
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","response.php",false);
		xmlhttp.send(null);

		if( xmlhttp.responseText == "00:00:00" ){
			
			document.getElementById("response").innerHTML ="Time is UP";
			document.getElementById("save").click();
			clearInterval(times);
						
		}else{
			document.getElementById("response").innerHTML = xmlhttp.responseText;
		}
		
	},1000);
	
	
</script>
													




	
<div class="block-content collapse in">
    <div class="span12">
<form name="exam" id="exam" action="" method="post">
  	<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
		
		<!-- <thead>		
		        <tr>			        
                	<th>Exam Description</th>
					<th>Question Description </th>
					<th>Answer</th>
			        				                   	
                   		
                    				
		    </tr>
		</thead> -->
<tbody>
<!-----------------------------------Content------------------------------------>
<?php   $counter = 0;
		$members_query = mysql_query("SELECT * FROM `offering` WHERE `examdesc`='".@$_SESSION["course"]."'")or die(mysql_error());
		while($row = mysql_fetch_array($members_query)){
		$username = $row['offeringid'];
		$counter +=1;
		?>
		
			<tr>
			<th><?php  echo $row['offeringid']; ?> <?php echo $row['questiondesc']; ?></th>  
			</tr>
			
			<tr>
			<td><input id="radio"  class="uniform-on" type="radio" name="<?php echo $counter; ?>" value="<?php echo $row['valueoptions']; ?>"> <?php echo $row['valueoptions']; ?></td>
			<td><input id="radio"  class="uniform-on" type="radio" name="<?php echo $counter; ?>" value="<?php echo $row['valueoptionsb']; ?>"> <?php echo $row['valueoptionsb']; ?></td>
			<td><input id="radio"  class="uniform-on" type="radio" name="<?php echo $counter; ?>" value="<?php echo $row['valueoptionsc']; ?>"> <?php echo $row['valueoptionsc']; ?></td>
			<td><input id="radio"  class="uniform-on" type="radio" name="<?php echo $counter; ?>" value="<?php echo $row['valueoptionsd']; ?>"> <?php echo $row['valueoptionsd']; ?></td>
			
			<input id="radio"  class="uniform-on" type="radio" name="<?php echo $counter; ?>QID" value="<?php echo $row['offeringid']; ?>" checked=true; style="display: none;">			
           
            </tr>
											
	<?php } ?>  

 	
										

</tbody>
</table>
<div class="control-group">
                                          <div class="controls">
 <button id="save" name="save" class="btn btn-info" id="save" data-placement="right" title="Click to Save"><i class="icon-save icon-large">  Submit</i></button>
												<script type="text/javascript">
	                                            $(document).ready(function(){
	                                            $('#save').tooltip('show');
	                                            $('#save').tooltip('hide');
	                                            });
	                                            </script>
												
											</div>
                                        </div>	
</form>		
		
	<?php
		$ltest = 0;
		if(isset($_POST["save"])){
			
			for( $i=1; $i <= $counter; $i++ ){				
				$qid = $i."QID";				
				$query = "INSERT INTO `answers`(`student_id`, `courses`, `qnumber`, `answer`) 
					VALUES ('".@$_SESSION['id']."','".@$_SESSION["course"]."','".@$_POST[$qid]."','".@$_POST[$i]."')";
				$members_query = mysql_query($query)or die(mysql_error());
				if( $members_query ){
					$ltest += 1;
				}
			}
			
			if( $ltest == $counter ){
				echo "Your Answer is Submitted Successfuly";
				@$_SESSION["course"] = "";
				@$_SESSION["controller"] = "0";
			}else{
				echo "Your Answer is not Submitted";
			}			
		}
	?>		  		
</div>
</div>
</div>
</div>
</div>
						
                        <!-- /block -->
                    </div>


                </div>
            </div>

<script type="text/javascript">
  $(document).ready(function(){
  	$('select[name=courses]').change(function(){
		  $('form[name=course]').submit();
	});
  	
  $('#add').tooltip('show');
  $('#add').tooltip('hide');
  });
 </script> 
		<?php include('footer.php'); ?>
        </div>
		<?php include('script.php'); ?>

		
</body>
</html>