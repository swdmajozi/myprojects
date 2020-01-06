<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Qwarehouse_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();

	}

	function getsubjectstatus($str)
	{
		switch ($str) {
			case 'true':
				return '<i class="text-green fa fa-circle jtooltip" title="Have content"></i>';
				break;

			case 'false':
				return '<i class="fa fa-circle-o jtooltip" title="No content"></i>';
				break;

			default:
				break;
		}
		return "";
	}


	function getSubjectList($keyword='', $perpage=0, $offset=0)
	{
		$fields = array(
			'subject_id', 'code', 'name', 'shortname', 'description',
			'status', 'isHasQuestion(subject_id) as hasQuestion',
		);
		// $cause = array('role' => 'admin');

		if ($perpage=='') $perpage=0;
		if ($offset=='') $offset=0;
		settype($offset, "integer");
		settype($perpage, "integer");

		if ($perpage > 0) $this->db->limit($perpage, $offset);
		$query = $this->db
			->select($fields)
			->like("CONCAT(code,name,shortname,description)",$keyword,'both')
			->get('subjects')
			->result_array();
			// die($this->db->last_query());
		return $query;
	}

	function countSubjectList($keyword='')
	{
		$fields = array(
			'count(*) as scount'
		);
		$query = $this->db
			->select($fields)
			->like("CONCAT(code,name,shortname,description)",$keyword,'both')
			->get('subjects')
			->row_array();
		return $query['scount'];
	}

	function getchapterList($subject_id)
	{
		$cause = array('subject_id' => $subject_id);
		$query = $this->db
			->get_where('chapter', $cause)
			->result_array();
		return $query;
	}

	function addchapter($subject_id, $chapterName)
	{
		$data = array(
			'name' => $chapterName,
			'subject_id' => $subject_id,
		);
		$this->db->trans_start();
			$chins = $this->db->insert('chapter', $data);
			$newid = $this->db->insert_id();
			$errno = $this->db->_error_number();
		$this->db->trans_complete();

		return array(
			'result' => $chins,
			'id' => $newid,
			'errno' => $errno
		);
	}

	function renchapter($chapter_id, $chapterName)
	{
		$data = array(
			'name' => $chapterName,
		);
		$chupd = $this->db
							->where('chapter_id', $chapter_id)
							->update('chapter', $data);
		return $this->db->_error_number();
	}

	function delchapter($chapter_id)
	{

		$cause = array('questions.chapter_id' => $chapter_id);
		$this->db->trans_start();
			$countchapter = $this->db
				->select("count(questions.chapter_id) as c")
				->join('questions', 'chapter.chapter_id = questions.chapter_id', 'LEFT')
				->get_where('chapter', $cause)
				->row_array();
			$errno = $this->db->_error_number();
		$this->db->trans_complete();

// SELECT count(q.chapter_id) as C
// FROM chapter ch
// left join questions q on (ch.chapter_id = q.chapter_id)
// WHERE ch.chapter_id = 1

		if ($errno == 0)
		{
			if (intval($countchapter['c']) > 0)
			{
				return array(
					'result' => "Error, can't delete.",
					'msg' => "Cannot delete chapter because there is a problem.",
					'errno' => 0
				);
			}
			else
			{
				$this->db->trans_start();
					$delCh = $this->db->delete('chapter', array('chapter_id' => $chapter_id));
					$errno = $this->db->_error_number();
				$this->db->trans_complete();
				if ($errno == 0)
				{
					return array(
						'result' => "deleted",
						'msg' => "Successfully deleted the chapter.",
						'errno' => 0
					);
				}
				else
				{
					return array(
						'result' => "Error, db",
						'msg' => " : " . $errno,
						'errno' => $errno
					);
				}
			}
		}
		else
		{
			return array(
				'result' => "Error, db",
				'msg' => "Database errors : " . $errno,
				'errno' => $errno
			);
		}

		$data = array(
			'name' => $chapterName,
		);
		$chupd = $this->db
							->where('chapter_id', $chapter_id)
							->update('chapter', $data);
		return $this->db->_error_number();
	}

	function addQuestion($chapter_id, $dataQuestion, $dataQuestionDetail)
	{
		$hasError = false;
		$newqdid = -1;
		$dataQuestion['chapter_id'] = $chapter_id;
		$this->db->trans_begin();
			$qins = $this->db->insert('questions', $dataQuestion);
			$newid = $this->db->insert_id();
			$errno = $this->db->_error_number();

			$dataQuestionDetail['question_id'] = $newid;
			switch ($dataQuestion['type']) {
				case 'choice':
					$qdins = $this->db->insert('Question_choice', $dataQuestionDetail);
					$newqdid = $this->db->insert_id();
					break;

				case 'numeric':
					$qdins = $this->db->insert('Question_numerical', $dataQuestionDetail);
					$newqdid = $this->db->insert_id();
					break;

				case 'boolean':
					$qdins = $this->db->insert('Question_boolean', $dataQuestionDetail);
					$newqdid = $this->db->insert_id();
					break;

				case 'matching': // No Implement code !!!!
					$qdins = $this->db->insert('Question_matching', $dataQuestionDetail);
					$newqdid = $this->db->insert_id();
					break;

				default:
					$hasError = true;
					$this->db->trans_rollback();
					return array(
						'result' => 'failed',
						'errno' => $errno
					);
					break;
			}
		if (! $hasError) $this->db->trans_commit();
		return array(
			'result' => 'completed',
			'id' => $newid,
			'errno' => $errno
		);
	}

	function QuestionList($keyword='',$chapter_id, $perpage=0, $offset=0)
	{
		if ($perpage=='') $perpage=0;
		if ($offset=='') $offset=0;
		settype($offset, "integer");
		settype($perpage, "integer");

		if ($perpage > 0) $this->db->limit($perpage, $offset);
		$this->db->order_by('question_id','desc');
		$query = $this->db
			// ->select($fields)
			->like("CONCAT(question)",$keyword,'both')
			->get_where('question_list', array('chapter_id'=>$chapter_id))
			->result_array();
			// die($this->db->last_query());
		return $query;
	}

	function countQuestionList($keyword='',$chapter_id)
	{
		$fields = array(
			'count(*) as qcount'
		);
		$this->db->order_by('question_id','desc');
		$query = $this->db
			->select($fields)
			->like("CONCAT(question)",$keyword,'both')
			->get_where('question_list', array('chapter_id'=>$chapter_id))
			->row_array();
			// die($this->db->last_query());
		return $query['qcount'];
	}

}

/* End of file qwarehouse_model.php */
/* Location: ./application/models/qwarehouse_model.php */