<!doctype html>
<html lang="th">
<head>
	<base href="<?php echo base_url(); ?>">
	<meta charset="utf-8">
	<title>
			PMP Exam Simulator & Question Bank
		</title>
	<link rel="stylesheet" href="vendor/css/bootstrap.min.css">
	<!-- iCheck for checkboxes and radio inputs -->
	<link href="vendor/css/iCheck/all.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="vendor/css/messenger.css">
	<link rel="stylesheet" href="vendor/css/messenger-theme-air.css">
	<link href="assets-student/css/main.css" rel="stylesheet" type="text/css">
	<!--Start of Zendesk Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="https://v2.zopim.com/?5lGSFsOCAGkuoHtb2hw7cwM1PjEkBZnR";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>
<!--End of Zendesk Chat Script-->
</head>
<body>
	<!-- header begin -->
	<header>
		<div class="container">
			<div class="row">
				<div class="col-md-12 top">
					<div id="logo">
						<div class="inner">
						<!--	<?php echo anchor('', '<img src="assets-student/img/logo.png" alt="">'); ?>-->
						<h1>
			PMP Exam Simulator & Question Bank
		</h1>
						</div>
					</div>

<?php $this->load->view('frontend/t_nav_view');?>

					<div class="clearfix" style="background-color: #fff;"></div>
				</div>
			</div>
		</div>

	</header>
	<!-- header close -->
<?php
	$subheader['title'] = (isset($title)?$title:'');
	$subheader['subtitle'] = (isset($subtitle)?$subtitle:'');
	if (isset($enableSlider)) $this->load->view('frontend/t_slider_view');
	else $this->load->view('frontend/t_subheader_view', $subheader);

	if ((isset($statbar)?$statbar:false))
	{
?>
	<div class="call-to-action">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="inner">
						<h1>There are subjects to take the exam <?php echo $coursesNum;?> List from all</h1>
						<!-- <a class="btn btn-large btn-blue pull-right">ลงทะเบียนเดี๋ยวนี้</a> -->
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>
<?php
	}
?>