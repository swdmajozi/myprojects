<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="myModalLabel"><?=$paperInfo['title']?></h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12">
					<?php echo <<<html
				<p class="summary text-center">
					Take the exam <span class="badge bg-blue">{$paperCalc['enrollcount']}</span> - Take the  exam <span class="badge bg-aqua">{$paperCalc['testedcount']}</span> - AVG <span class="badge bg-yellow">{$paperCalc['average']}</span> - MIN <span class="badge bg-red">{$paperCalc['minimum']}</span> - MAX <span class="badge bg-green">{$paperCalc['maximum']}</span>
				</p>
html;
?>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Code</th>
						<th>Name - Family</th>
						<th>Score</th>
					</tr>
				</thead>
				<tbody>
				<?php
				//var_dump($reportRows);
					if ($reportRows) {
						foreach ($reportRows as $item) {
							$stdGroup[$item['groupname']][] = $item;
						}

						foreach ($stdGroup as $groupkey => $groupval) {
							echo '<tr><td colspan="3" style="background-color: #fff;vertical-align: bottom; border-bottom: 2px solid #ddd; font-weight: bold;">'.$groupkey.'</td></tr>';
							foreach ($groupval as $item) {
								echo <<<html
								<tr>
								<td>{$item['stu_id']}</td>
								<td>{$item['title']}{$item['name']} {$item['lname']}</td>
								<td>{$item['Score']}</td>
								</tr>
html;
							}
						}
						
					} else {
						echo "<tr class='warning'><td colspan='3' class='text-center'>Data not found</td></tr>";
					}

				?>
				</tbody>
			</table>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>
