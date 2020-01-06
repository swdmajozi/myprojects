<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Parteditor_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

	}

	function getQuestionList($chapterid, $subjectId, $paperId, $qtype='all')
	{
		// เรียกรายการ question ในคลังที่ไม่มีใน exam_papers_detail
		/*

		ใหม่  ใช้งานได้  แยกExam set
		SELECT * FROM `question_list` 
		where `chapter_id` in (SELECT chapter_id from chapter where subject_id = 1) 
		and question_id not in ( SELECT question_id FROM question_detail_list qd where qd.paper_id = 1 ) 
		ORDER BY `question_id` ASC


		เก่า ๆๆๆ  ใช้ไม่ได้เรื่อง  
		SELECT * FROM question_list q 
		LEFT JOIN exam_papers_detail epd on q.question_id = epd.question_id 
		WHERE epd.question_id IS NULL 
		ORDER BY `q`.`question_id` ASC
		*/

		// $query = $this->db
			// ->select(array(
			// 	'no','question_list.question_id','question','type','status','chapter_id',
			// 	'created_by','created_time',
			// 	'choice1','choice2','choice3','choice4','choice5','choice6',
			// 	'answer_choice','answer_numeric','answer_boolean','chapter_name'))
			// ->from('question_list')
			// ->join('exam_papers_detail', 
			// 	'question_list.question_id = exam_papers_detail.question_id', 'left')
			// ->where(array(
			// 	'exam_papers_detail.question_id'=>NULL,
			// 	'question_list.chapter_id'=>$chapterid
			// ))
			// ->get()
			// ->result_array();

		if ($qtype == 'all' or $qtype == '') $qqtype = "";
		else $qqtype = "and type = '$qtype'";

		$query = $this->db->query("SELECT * FROM `question_list` 
		where `chapter_id` in (SELECT chapter_id from chapter where subject_id = $subjectId) 
		and question_id not in ( SELECT question_id FROM question_detail_list qd where qd.paper_id = $paperId) 
		and chapter_id = $chapterid $qqtype 
		ORDER BY `question_id` ASC")->result_array();

			//die($this->db->last_query());
		return $query;
	}

	function getQuestionDetailList($partid)
	{
		$query = $this->db
			->select('*')
			->from('question_detail_list')
			->where(array(
				//'paper_id' => $paperid,
				'part_id' => $partid,
				'status !=' => 'inactive'
			))
			->get()
			->result_array();
		return $query;
	}

	function addQuestionDetail($questionData)
	{
		// add inuse to question
		$this->db->update('questions', array('status' => 'inuse'), 
			array('question_id'=>$questionData['question_id']));
		$query = $this->db
			->insert('exam_papers_detail', $questionData);
		return $query;
	}

	function reorderquestions($questionData)
	{
		foreach ($questionData as $key => $value) {
			$query = $this->db->update('exam_papers_detail', array('no'=>$key+1), array('question_id'=>$value));
		}
		// No checking yet
		return 0;
	}

	function removeQuestion($questionId,$partid,$paperid)
	{
		$this->db->delete('exam_papers_detail',
				array(
					'question_id' => $questionId,
					'part_id' => $partid,
					'paper_id' => $paperid
				));

		// No checking yet
		return 0;
	}

	function getchapterList($subjectId)
	{
		$query = $this->db
			->select('*')
			->get_where('chapter', array('subject_id' => $subjectId))
			->result_array();
		return $query;
	}

	function buildchapterOptions($subjectId)
	{
		$chapterList = $this->getchapterList($subjectId);
		//$options['all'] = "ทั้งหมด";
		foreach ($chapterList as $item) {
			$options[$item['chapter_id']] = $item['name'];
		}
		if (!isset($options))
			$options[''] = "-- No chapter -- ";
		return $options;
	}

}

/* End of file parteditor_model.php */
/* Location: ./application/models/parteditor_model.php */