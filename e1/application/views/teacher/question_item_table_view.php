		<tr id="question-<?php echo $question_id;?>" href="<?php echo $this->misc->getHref('teacher/qwarehouse/editq/')."/$question_id";?>">
			<td><?php echo $question_id;?></td>
			<td><?php echo $question;?></td>
			<td><?php
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
			if ($type == "choice") {
				if ($answer_choice == "1") $answer = $choice1;
				elseif ($answer_choice == "2") $answer = $choice2;
				elseif ($answer_choice == "3") $answer = $choice3;
				elseif ($answer_choice == "4") $answer = $choice4;
				elseif ($answer_choice == "5") $answer = $choice5;
				elseif ($answer_choice == "6") $answer = $choice6;
			}
			if ($type == "boolean")
			{
				if (strtolower($answer_boolean) == "b")
					$answer = "Correct";
				else
					$answer = "Wrong";
			}
			elseif ($type == "numeric")
			{
				$answer = $answer_numeric;
			}
			list($date, $time) = explode(' ', $created_time);
		?></td>
			<td><?php echo $answer;?></td>
			<td><span class="jtooltip" title="<?php
				echo $this->misc->getFullDateTH($date)."<br>เวลา ".$time."\">".
				$created_by; ?>
				</span>
			</td>
		</tr>
<?php


	// list($date, $time) = explode(' ', $created_time);
	// $fullthdate = $this->misc->getFullDateTH($date);
	// $date = $this->misc->chrsDateToBudDate($date,"-","/");

	// echo "<span class=\"jtooltip\" title=\"$fullthdate\">$date $time</span>";
	// 			 echo $created_by ;
	// 				switch ($status) {
	// 					case 'active':
	// 						echo '<span class="text-success jtooltip" title="Ready to be used with Exam set"><b>Available</b></span>';
	// 						break;
	// 					case 'inactive':
	// 						echo '<span class="text-muted jtooltip" title="Temporarily unavailable"><b>Unavailable</b></span>';
	// 						break;
	// 					case 'inuse':
	// 						echo '<span class="text-primary jtooltip" title="Correct used in the Exam set. Can not be changed."><b>Applied</b></span>';
	// 						break;
	// 					case 'draft':
	// 						echo '<span class="jtooltip" title="Not actually used"><b>Draft</b></span>';
	// 						break;
	// 					default:
	// 						echo '<span class="text-muted"><b>'.$status.'</b></span>';
	// 						break;
	// 				}
	//