					<ul id="mainmenu">
						<li><?php echo anchor('', 'Homepage'); ?></li>
						<li><a href="#">Courses</a>
							<ul>
								<li><?php echo anchor('courses/upcoming', 'Upcoming'); ?></li>
								<li><?php echo anchor('courses', 'Exam subject'); ?></li>
								<li><?php echo anchor('subject-list', 'All Courses'); ?></li>
							</ul>
						</li>
						<li><?php echo anchor('student/stats', 'Statistics'); ?></li>
						<li><?php echo anchor('main/aboutus', 'About Us'); ?></li>
						<li><?php echo anchor('news', 'News Feed'); ?></li>
						<li><?php echo anchor('contact', 'Contact'); ?></li>
						<li class="sign-in-btn"><?php
							$mnprofile = anchor('student/profile', 'Profile');
							$mnlogout = anchor('auth/logout', 'Logout');
							if ($this->session->userdata('fname') != null)
							{
								echo <<<HTML
								<a href="#">{$this->session->userdata('fname')}</a>
								<ul>
									<li>
										{$mnprofile}
									</li>
									<li>
										{$mnlogout}
									</li>
								</ul>
HTML;
							}
							else
							{
								echo anchor('auth/login', 'Login'); 
							}

						?></li>
					</ul>