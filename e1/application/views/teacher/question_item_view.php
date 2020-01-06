<div id="question-<?php echo $question_id;?>" data-chapterid="<?php echo $chapter_id; ?>" class="box box-solid nav-tabs-custom question-item collapsed-box">
	<ul class="box-header nav nav-tabs">
		<li class="pull-left header">
			<?php 
			switch ($type) {
				case 'choice':
					echo '<i class="fa fa-list-ul"></i>';
					break;
				case 'boolean':
					echo '<i class="fa fa-check"></i>';
					break;
				case 'numeric':
					echo '<i class="fa fa-superscript"></i>';
					break;
			}
			if (isset($number))
				echo "<span class=\"question-labelno\">ข้อ</span> <span class=\"question-no\">$number</span>";
			else
				echo "<span class=\"question-labelno\"></span> <span class=\"question-no\"></span>";
			echo " <span class=\"question-chapter text-muted\" style=\"font-size: 14px\">($chapter_name)</span> <span class=\"question-text text-muted\" style=\"font-size: 14px\">".
			$this->misc->getShortText(strip_tags($question))."</span>";?>
		</li>
		<div class="box-tools pull-right">
			<button class="btn bg-info btn-sm" type="button" data-widget="collapse"><i class="fa fa-plus"></i></button>
			<button class="btn bg-aqua btn-sm" type="button" data-widget="popqup"><i class="fa fa-retweet"></i></button>
		</div>
	</ul>
	<div class="box-body" style="display: none;">
		<b>Question:</b>
		<div class="question-label"><?php echo $question;?></div>
		<b>The format:</b>
		<p class="question-type-label"><?php
			switch ($type) {
				case 'choice':
					echo "objective";
					break;
				case 'numeric':
					echo "Fill the answer with numbers.";
					break;
				case 'boolean':
					echo "Right / wrong";
					break;
				case 'matching':
					echo "Match";
					break;
			}
		?></p>
		<?php if ($type == "choice") { ?>
		<b>ตัวเลือก:</b>
		<div class="question-choices-label">
			<ul>
				<?php
					echo ((isset($choice1) && $choice1 != "") ? "<li>".$choice1."</li>" : "").
					((isset($choice2) && $choice2 != "") ? "<li>".$choice2."</li>" : "").
					((isset($choice3) && $choice3 != "") ? "<li>".$choice3."</li>" : "").
					((isset($choice4) && $choice4 != "") ? "<li>".$choice4."</li>" : "").
					((isset($choice5) && $choice5 != "") ? "<li>".$choice5."</li>" : "").
					((isset($choice6) && $choice6 != "") ? "<li>".$choice6."</li>" : "");

					if ($answer_choice == "1") $answer = $choice1;
					elseif ($answer_choice == "2") $answer = $choice2;
					elseif ($answer_choice == "3") $answer = $choice3;
					elseif ($answer_choice == "4") $answer = $choice4;
					elseif ($answer_choice == "5") $answer = $choice5;
					elseif ($answer_choice == "6") $answer = $choice6;
				?>
			</ul>
		</div>
		<?php }
			if ($type == "boolean")
			{
				if (strtolower($answer_boolean) == "t")
					$answer = "Correct";
				else
					$answer = "Wrong";
			}
			elseif ($type == "numeric")
			{
				$answer = $answer_numeric;
			}
		?>

		<b>Answer:</b>
		<p class="question-answer-label"><?php echo $answer;?></p>
	</div>
	<div class="box-footer" style="display: none;">
		<div class="row">
			<div class="col-md-12 text-right">
				<span class="text-muted">Built on <?php
	list($date, $time) = explode(' ', $created_time);
	$fullthdate = $this->misc->getFullDateTH($date);
	$date = $this->misc->chrsDateToBudDate($date,"-","/");

	echo "<span class=\"jtooltip\" title=\"$fullthdate\">$date $time</span>";
				?> <span style="white-space: nowrap;">by <?php echo $created_by ; ?></span></span>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-right">
				<?php
					switch ($status) {
						case 'active':
							echo '<span class="text-success jtooltip" title="Ready to be used with Exam set"><b>Available</b></span>';
							break;
						case 'inactive':
							echo '<span class="text-muted jtooltip" title="Temporarily unavailable"><b>Unavailable</b></span>';
							break;
						case 'inuse':
							echo '<span class="text-primary jtooltip" title="Correct used in the Exam set. Can not be changed."><b>Applied</b></span>';
							break;
						case 'draft':
							echo '<span class="jtooltip" title="Not actually used"><b>Draft</b></span>';
							break;
						default:
							echo '<span class="text-muted"><b>'.$status.'</b></span>';
							break;
					}
				?>
			</div>
		</div>
	</div>
</div>