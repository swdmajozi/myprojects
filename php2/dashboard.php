<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="St.Lukes Boys School management System">
    <meta name="author" content="Kithinji Godfrey">
	<link href="bootstrap/css/index_background.css" rel="stylesheet" media="screen"/>

</head>
<?php  include('header.php'); ?>
<?php  include('session.php'); ?>
    <body>
		<?php include('navbar.php') ?>
        <div class="container-fluid">
            <div class="row-fluid">
			 <?php include('sidebar.php'); ?>		
                <div class="span9" id="content">
                    <div class="row-fluid">
         	         <?php $query= mysql_query("select * from admin where admin_id = '$session_id'")or die(mysql_error());
			         $row = mysql_fetch_array($query);			
			         ?>
                    <div class="col-lg-12">
                      <div class="alert alert-success alert-dismissable">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <img id="avatar1" class="img-responsive" src="<?php echo $row['adminthumbnails']; ?>"><strong> Welcome! <?php echo $user_row['firstname']." ".$user_row['lastname'];  ?></strong>
                      </div>
                    </div>
     
                      <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><i class="icon-dashboard">&nbsp;</i>Home </div>
								<div class="muted pull-right"><i class="icon-time"></i>&nbsp;<?php include('time.php'); ?></div>
                            </div>
                            <div class="block-content collapse in">
							        <div class="span12">
									
<div class="block-content collapse in">
<div id="page-wrapper">
        <?php 
	     $student = mysql_query("select * from teens ")or die(mysql_error());
		 $student = mysql_num_rows($student);
		 ?>
                <div class="row-fluid">				
                    <div class="span6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
							  <div class="container-fluid">
                                <div class="row-fluid">
                                    <div class="span3"><br/>
                                        <i class="fa fa-users fa-5x"></i><br/>
                                    </div>
                                    <div class="span8 text-right"><br/>
                                        <div class="huge"><?php echo $student; ?></div>
                                        <div>All Examinee</div><br/>
                                    </div>
                                </div>
							 </div>	
                            </div>
                            <a href="add_teen.php">							  
                                <div class="modal-footer">
                                    <span class="pull-left">Add Examinee</span>
                                    <span class="pull-right"><i class="icon-chevron-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                        </div>
                    </div>
	<?php 
	     $student = mysql_query("select * from visitor ")or die(mysql_error());
		 $student = mysql_num_rows($student);
		 ?>		
                     <div class="span6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
							  <div class="container-fluid">
                                <div class="row-fluid">
                                    <div class="span3"><br/>
                                     <i class="fa fa-plus-circle  fa-5x" aria-hidden="true"></i><br/>
                                    </div>
                                    <div class="span8 text-right"><br/>
                                        <div class="huge"><?php echo $student;?></div>
                                        <div>Exams</div><br/>
                                    </div>
                                </div>
							 </div>	
                            </div>
                            <a href="add_visitor.php">							  
                                <div class="modal-footer">
                                    <span class="pull-left">Add Exam</span>
                                    <span class="pull-right"><i class="icon-chevron-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                        </div>
                    </div>
				 </div>
 </div> 				 							
<div id="page-wrapper">
        <?php 
	     $student = mysql_query("select * from offering ")or die(mysql_error());
		 $student = mysql_num_rows($student);
		 ?>
                <div class="row-fluid">				
                    <div class="span6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
							  <div class="container-fluid">
                                <div class="row-fluid">
                                    <div class="span3"><br/>
                                     <i class="fa fa-money  fa-5x" aria-hidden="true"></i>
                                    </div>
                                    <div class="span8 text-right"><br/>
                                        <div class="huge"><?php echo $student; ?></div>
                                        <div>Questions</div><br/>
                                    </div>
                                </div>
							 </div>	
                            </div>
                            <a href="add_offering.php">							  
                                <div class="modal-footer">
                                    <span class="pull-left">Add Question</span>
                                    <span class="pull-right"><i class="icon-chevron-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
                        </div>
                    </div>
		<?php 
	     $student = mysql_query("select * from admin ")or die(mysql_error());
		 $student = mysql_num_rows($student);
		 ?>			
                     <div class="span6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
							  <div class="container-fluid">
                                <div class="row-fluid">
                                    <div class="span3"><br/>
                                      <i class="fa fa-users  fa-5x"></i><br/>
                                    </div>
                                    <div class="span8 text-right"><br/>
                                        <div class="huge"><?php echo $student;?></div>
                                        <div>Total Accounts</div><br/>
                                    </div>
                                </div>
							 </div>	
                            </div>
                            <a href="admin_user.php">							  
                                <div class="modal-footer">
                                    <span class="pull-left">Accounts</span>
                                    <span class="pull-right"><i class="icon-chevron-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>							  
                            </a>
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
            </div>
    
         <?php include('footer.php'); ?>
        </div>
	<?php include('script.php'); ?>
    </body>
