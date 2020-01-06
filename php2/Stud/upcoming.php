
<?php include('header.php'); ?>
<?php include('session.php'); ?>
    <body>
		<?php include('navbar.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('sidebar.php'); ?>
								<div class="span9" id="content">
                     <div class="row-fluid">
					
					  <script type="text/javascript">
		              $(document).ready(function(){
		              $('#add').tooltip('show');
		              $('#add').tooltip('hide');
		              });
		             </script> 
					 <div id="sc" align="center"><image src="images/sclogo.png" width="45%" height="45%"/></div>
				<?php	
	             $count_members=mysql_query("select * from offering");
	             $count = mysql_num_rows($count_members);
                 ?>	 
				   <div id="block_bg" class="block">
                        <div class="navbar navbar-inner block-header">
                             <div class="muted pull-left"><i class="icon-reorder icon-large"></i> Exam Result</div>
                         
						  </div>





	
<div class="block-content collapse in">
    <div class="span12">
	
<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
		
<tbody>
	<tr>
	<th>#</th>
	<th>Course</th>
	<th>Result</th>
	
	<tr>											
						                  
<?php
$numberofcourse = 0;		
$members_query = mysql_query("SELECT `examdesc`FROM `visitor`")or die(mysql_error());
while($rows = mysql_fetch_array($members_query)){
	$numberofcourse +=1;
	$counter = 0;
	$queries = mysql_query("SELECT * FROM `offering` WHERE `examdesc`='".$rows['examdesc']."'")or die(mysql_error());
	$total_Q = mysql_num_rows($queries);

	$members_query = mysql_query("SELECT * FROM `answers` WHERE `student_id`='".$_SESSION['id']."' and `courses`='".$rows['examdesc']."'")or die(mysql_error());
	while($row = mysql_fetch_array($members_query)){
		//echo "Course: ".$row['courses']." QID: ".$row['qnumber']." Answer: ".$row['answer'];			

		$query = mysql_query("SELECT * FROM `offering` WHERE `examdesc`='".$row['courses']."' and `offeringid`='".$row['qnumber']."' and `questionanswer`='".$row['answer']."'");
		$counts = mysql_num_rows($query);
		if($counts == 1){
			$counter += 1;
		}

	}

	echo "<tr>";
	echo "<td>".$numberofcourse."</td>";
	echo "<td>".$rows['examdesc']."</td>";
	echo "<td>".$counter."/".$total_Q."</td>";
	//echo "<td>".$total_Q."</td>";
	echo "<tr>";


}
		
                 


	

	
?>	

 	
</tbody>
</table>

<div class="container-fluid">
  <div class="row-fluid"> 
     <div class="empty">
	     <div class="pull-left">
		   <a href="print_Visitors.php" class="btn btn-info" id="print" data-placement="left" title="Click to Print"><i class="icon-print icon-large"></i> Print List</a> 		      
		   <script type="text/javascript">
		     $(document).ready(function(){
		     $('#print').tooltip('show');
		     $('#print').tooltip('hide');
		     });
		   </script>        	   
         </div>
      </div>
    </div> 
</div>
	
		
		  		
</div>
</div>
</div>
</div>
</div>
						
                        <!-- /block -->
                    </div>


                </div>
            </div>
		<?php include('footer.php'); ?>
        </div>
		<?php include('script.php'); ?>
		
    </body>

</html>