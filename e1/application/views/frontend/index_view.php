	<!-- content begin -->
	<div id="content">
		<div class="container">
			<div class="row fix">
				



			</div>
			<hr>
			<div class="row">
				<div class="col-md-4">
					<h3>Get to know the faculty</h3>
					<ul class="trainer-list">
											<li>
							
						<h1>OUR CERTIFIED PMP MENTOR:</h1> 

<h3>	Name: Abongile Dyariwe (Mr.)</h3>
<li>	Certifications: PfMP PgMP PMP PrCPM MScPM</li>
<li>	Experience: 15 Years </li>
<li>	Specialty: Portfolio, Program & Project Management Office (P3MO) </li>
<li>	LinkedIn profile link: https://www.linkedin.com/in/abongiledyariwe</li>

	</ul>
					
				</div>

				<div class="col-md-8">
					<h3>Latest Exam</h3>
					<div class="row fix">
						<?php 
							foreach ($coursesList as $courseItem) {
								$desc = strip_tags($courseItem['description']);
								echo <<<HTML
						<div class="span2 course-item-small center">
							<div class="inner">
								<div class="hover">
									<span>{$desc}</span>
								</div>
								<img src="assets-student/img/pic-blank-1.gif" data-original="assets-student/img/course/pic (1).jpg" alt="">
								<div class="info">
									<h5><a href="#">{$courseItem['name']}</a></h5>
									<span class="author">{$courseItem['shortname']}</span>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
HTML;
							}

						?>

					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- content close -->


	<div class="call-to-action bg-blue">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="inner">
						<h1 style="display: none;">Learn from 542 courses, from our 107 partners.</h1>
						<!-- <a class="btn btn-large btn-black pull-right">Try Now!</a> -->
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>