<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class courses_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

	}

	function getClassName()
	{
		return $this->router->class;
	}

	function getMethodName()
	{
		return $this->router->method;
	}

	function btnSaveText()
	{
		return $this->getMethodName()=="add"?'Add info':'record';
	}

	function isEditPage()
	{
		return $this->misc->getMethodName()=="view"?true:false;
	}

	function getSubjectList($status = '')
	{
		$query = $this->db
			// ->select($fields)
			->like("status",$status)
			->order_by('code','asc')
			->get('subjects')
			->result_array();
			// die($this->db->last_query());
		return $query;
	}

	function getSubjectDesc($subject_id)
	{
		$query = $this->db
			->select("description")
			->get_where('subjects', array('subject_id'=>$subject_id))
			->row_array();
		return $query;
	}

	function getCourseList($keyword='', $perpage=0, $offset=0, $visible=null, $year=0, $status=null)
	{
// SELECT course_id, year, tea_id, startdate, name, shortname, description, visible, enabled
// FROM Course c
// LEFT JOIN subjects s on (c.subject_id = s.subject_id)
// WHERE 1
		if ($perpage=='') $perpage=0;
		if ($offset=='') $offset=0;
		settype($offset, "integer");
		settype($perpage, "integer");

		if ($perpage > 0) $this->db->limit($perpage, $offset);
		if ($visible !== null) $cause = array('visible' => $visible);
		else $cause = array('visible >=' => '0');
		if ($year != 0) $cause['year'] = $year;
		if ($status !== null) $cause['status'] = $status;
		$query = $this->db
			// ->select($fields)
			->like("CONCAT(code,name,shortname,description)",$keyword,'both')
			->where($cause)
			->order_by('year','desc')
			->order_by('code','asc')
			->get('courseslist_view')
			->result_array();
			// die($this->db->last_query().$year);
		return $query;
	}

	function getMyCourseList($teaid, $keyword='', $perpage=0, $offset=0, $year=0)
	{
		if ($perpage=='') $perpage=0;
		if ($offset=='') $offset=0;
		settype($offset, "integer");
		settype($perpage, "integer");

		if ($perpage > 0) $this->db->limit($perpage, $offset);
		$query = $this->db
			->select('*')
			->from('teacher_course_detail')
			->join('courseslist_view', 'teacher_course_detail.course_id = courseslist_view.course_id', 'left')
			->like("CONCAT(code,year,name,shortname,description)",$keyword,'both')
			->where(array('tea_id'=>$teaid))
			->order_by('year','desc')
			->order_by('code','asc')
			->get()
			->result_array();
			//die($this->db->last_query());
		return $query;
	}

	function countCourseList($keyword='', $visible=null, $year=0, $status=null)
	{
		$fields = array(
			'count(*) as scount'
		);
		if ($visible !== null) $cause = array('visible' => $visible);
		else $cause = array('visible >=' => '0');
		if ($year != 0) $cause['year'] = $year;
		if ($status !== null) $cause['status'] = $status;
		$query = $this->db
			->select($fields)
			->like("CONCAT(code,name,shortname,description)",$keyword,'both')
			->where($cause)
			->get('courseslist_view')
			->row_array();
		return $query['scount'];
	}

	function countMyCourseList($teaid, $keyword='', $year=0)
	{
		$fields = array(
			'count(*) as scount'
		);
		$query = $this->db
			->select($fields)
			->from('teacher_course_detail')
			->join('courseslist_view', 'teacher_course_detail.course_id = courseslist_view.course_id', 'left')
			->like("CONCAT(code,year,name,shortname,description)",$keyword,'both')
			->where(array('tea_id'=>$teaid))
			->get()
			->row_array();
		return $query['scount'];
	}

	function buildCourseOptions()
	{
		$subjectList = $this->getSubjectList();
		$options[''] = "- Choose -";
		foreach ($subjectList as $item) {
			$options[$item['subject_id']] = $item['code']." — ".$item['name'];
		}
		return $options;
	}

	function buildPapersOptions($courseId)
	{
		$paperList = $this->getStudentGroups($courseId);
		$options[''] = "- Choose -";
		foreach ($paperList as $item) {
			$options[$item['group_id']] = $item['name'];
		}
		return $options;
	}

	function getCourseById($CourseId)
	{
		$cause = array('course_id' => $CourseId);
		$query = $this->db
			->get_where('courseslist_view', $cause)
			->row_array();
		return $query;
	}

	function getCourseIdByPaperId($paperid)
	{
		$cause = array('paper_id' => $paperid);
		$query = $this->db
			->get_where('exam_papers', $cause)
			->row_array();
		return $query['course_id'];
	}

	function addCourse($CourseData)
	{
		$query = $this->db->insert('courses', $CourseData);
		return $query;
	}

	function updateCourse($CourseData, $CourseId)
	{
		// var_dump($CourseData);
		// echo '<br>';
		// var_dump($CourseId);
		$query = $this->db->update('courses', $CourseData, array('course_id'=>$CourseId));
		// die(var_dump($query));
		// die($this->db->last_query());
		return $query;
	}

	function getTeacherlist($CourseId, $mode='incourse')
	{
		if ($mode=='incourse')
		{
			$cause = array('course_id' => $CourseId);
			$query = $this->db
				->select('t.tea_id,name,lname,fac_id,email,pic')
				->from('teachers t')
				->join('teacher_course_detail tcd', 't.tea_id = tcd.tea_id', 'left')
				->where($cause);
			$query = $this->db->get()->result_array();
			return $query;
		}
		elseif ($mode=='exclude')
		{
			$cause = array('tcd.tea_id' => NULL);
			$query = $this->db
				->select('t.tea_id,name,lname,fac_id,email,pic')
				->from('teachers t')
				->join('(SELECT tea_id FROM teacher_course_detail WHERE course_id = '.$CourseId.') tcd', 't.tea_id = tcd.tea_id', 'left')
				->where($cause);
			$query = $this->db->get()->result_array();
			// $sub = $this->subquery->start_subquery('join');
			// $sub->select('tea_id')->from('teacher_course_detail')->where('course_id', $CourseId);
			//var_dump($query);die();
			return $query;
		}
		elseif ($mode=='all')
		{
			$query = $this->db
				->select('tea_id,name,lname,fac_id,email,pic')
				->from('teachers t');
			$query = $this->db->get()->result_array();
			return $query;
		}
	}

	function updateTeacherList($CourseId, $teasId)
	{
		$data = array();

		if ($teasId == null)
		{
			$this->db->delete('teacher_course_detail',
				array('course_id' => $CourseId));
			return 0;
		}

		for ($i=0; $i < sizeof($teasId); $i++) {
			$data[$i]['tea_id'] = $teasId[$i];
			$data[$i]['course_id'] = $CourseId;
		}

		$this->db->trans_begin();
		$this->db->delete('teacher_course_detail',
			array('course_id' => $CourseId));

		$qins = $this->db->insert_batch('teacher_course_detail', $data);
		$errno = $this->db->_error_number();
		$this->db->trans_complete();
		if ($this->db->trans_status())
		{
			return 0;
		}
		else
		{
			return $errno;
		}
	}

	function getStudentlist($CourseId, $mode='incourse', $groupId='')
	{
		if ($mode=='incourse')
		{
			$cause = array('course_id' => $CourseId);
			if ($groupId != '') $cause['group_id'] = $groupId;
			$query = $this->db
				->select('stu.stu_id,title,name,lname,birth,gender,idcard,year,fac_id,branch_id,email,pic')
				->from('students stu')
				->join('student_enroll stuen', 'stu.stu_id = stuen.stu_id', 'left')
				->where($cause);
			$query = $this->db->get()->result_array();
			return $query;
		}
		elseif ($mode=='exclude')
		{
			$cause = array('stuen.stu_id' => NULL);
			$query = $this->db
				->select('stu.stu_id,title,name,lname,birth,gender,idcard,year,fac_id,branch_id,email,pic')
				->from('students stu')
				->join('(SELECT stu_id FROM student_enroll WHERE course_id = '.$CourseId.') stuen', 'stu.stu_id = stuen.stu_id', 'left')
				->where($cause);
			$query = $this->db->get()->result_array();
			return $query;
		}
		elseif ($mode=='all')
		{
			$query = $this->db
				->select('*')
				->from('students');
			$query = $this->db->get()->result_array();
			return $query;
		}
	}

	function updateStudentList($groupId, $CourseId, $stdId)
	{
		$data = array();

		if ($stdId == null)
		{
			$this->db->delete('student_enroll',
				array('course_id' => $CourseId, 'group_id' => $groupId));
			return 0;
		}

		for ($i=0; $i < sizeof($stdId); $i++) {
			$data[$i]['group_id'] = $groupId;
			$data[$i]['stu_id'] = $stdId[$i];
			$data[$i]['course_id'] = $CourseId;
		}

		$this->db->trans_begin();
		$this->db->delete('student_enroll',
			array('course_id' => $CourseId,
						'group_id' => $groupId));

		$qins = $this->db->insert_batch('student_enroll', $data);
		$errno = $this->db->_error_number();
		$this->db->trans_complete();
		if ($this->db->trans_status())
		{
			return 0;
		}
		else
		{
			return $errno;
		}
	}

	function getStudentGroups($CourseId)
	{
		$cause = array('course_id' => $CourseId);
		$query = $this->db
			->get_where('course_students_group', $cause)
			->result_array();
		return $query;
	}

	function countStudentInGroup($groupId, $CourseId = '')
	{
		$cause['group_id'] = $groupId;
		if ($CourseId != '') $cause['course_id'] = $CourseId;
		$query = $this->db
			->select('count(stu_id) as scount')
			->get_where('student_enroll', $cause)
			->row_array();
		return $query['scount'];
	}

	function countStudentInCourse($CourseId)
	{
		// SELECT count(stu_id) as countstd FROM `student_enroll` WHERE course_id = '1'
		$cause['course_id'] = $CourseId;
		$query = $this->db
			->select('count(stu_id) as countstd')
			->get_where('student_enroll', $cause)
			->row_array();
		return $query['countstd'];
	}

	function addStudentGroup($CourseId, $gname, $gdesc)
	{
		$data = array(
			'name' => $gname,
			'description' => $gdesc,
			'course_id' => $CourseId,
		);
		$query = $this->db->insert('course_students_group', $data);
		$newid = $this->db->insert_id();
		return array(
			'result' => 'ok',
			'newid' => $newid,
			'name' => $gname,
			'desc' => $gdesc,
			'error' => $this->db->_error_number(),
		);
	}

	function deleteStudentGroup($groupId)
	{
		$query = $this->db->delete('course_students_group',
			array('group_id' => $groupId));
		$errno = $this->db->_error_number();
		return ($errno == 0?"ok":$errno);
	}

	function getExamPapersList($course_id, $keyword='')
	{
		$fields = array(
			'paper_id', 'title', 'description', 'rules', 'starttime', 'endtime', 'course_id'
		);
		$query = $this->db
			->select($fields)
			->from('exam_papers')
			->like("CONCAT(title,description,rules,starttime,endtime)",$keyword,'both')
			->where(array('course_id'=>$course_id, 'status !='=>'deleted'))
			->get()
			->result_array();
		return $query;
	}

	function getPaper($paperid)
	{
		$cause = array('paper_id' => $paperid);
		$query = $this->db
			->get_where('exam_papers', $cause)
			->row_array();
		return $query;
	}

	function addPaper($paperData)
	{

		$query = $this->db->insert('exam_papers', $paperData);
		$newid = $this->db->insert_id();
		return array(
			'result' => 'ok',
			'newid' => $newid,
			'name' => $paperData['title'],
			'error' => $this->db->_error_number(),
		);
	}

	function editPaper($paperData, $paperid)
	{

		$query = $this->db->update('exam_papers', $paperData, array('paper_id'=>$paperid));
		return array(
			'result' => 'ok',
			'name' => $paperData['title'],
			'error' => $this->db->_error_number(),
		);
	}

	function deletePaper($paperid)
	{
		$query = $this->db->update('exam_papers', array('status'=>'deleted'), array('paper_id'=>$paperid));
		return array(
			'result' => 'ok',
			'error' => $this->db->_error_number(),
		);
	}

	function getExamPaperParts($paperid)
	{
		$cause = array('paper_id' => $paperid);
		$query = $this->db
			->order_by('no','asc')
			->get_where('exam_papers_parts', $cause)
			->result_array();
		return $query;
	}

	function addPart($partData)
	{

		$query = $this->db->insert('exam_papers_parts', $partData);
		$newid = $this->db->insert_id();
		return array(
			'result' => 'ok',
			'newid' => $newid,
			'name' => $partData['title'],
			'error' => $this->db->_error_number(),
		);
	}

	function deletePart($partid)
	{
		$query = $this->db->delete('exam_papers_parts', array('part_id'=>$partid));
		$query2 = $this->db->delete('exam_papers_detail', array('part_id'=>$partid));
		return array(
			'result' => 'ok',
			'error' => $this->db->_error_number(),
		);
	}

	function getPartInfoById($partId)
	{
		$cause = array('part_id' => $partId);
		$query = $this->db
			->get_where('exam_papers_parts', $cause)
			->row_array();
		return $query;
	}

	function getCourseIdFromPartId($partId)
	{
		$query = $this->db
			->select("course_id")
			->from('exam_papers_parts')
			->join('exam_papers', 'exam_papers_parts.paper_id = exam_papers.paper_id', 'left')
			->where(array('exam_papers_parts.part_id'=>$partId))
			->limit(1)
			->get()
			->row_array();
		return $query['course_id'];
	}

	function updatePartOrder($partData)
	{
		foreach ($partData as $key => $value) {
			$query = $this->db->update('exam_papers_parts', array('no'=>$key+1), array('part_id'=>$value));
		}
	}

	function getUpcomingTest($stdId)
	{
		/*
		-- ธรรมดา
		SELECT * FROM student_enroll se
		LEFT JOIN exam_papers ep on se.course_id = ep.course_id
		WHERE stu_id = '$stdId' and starttime >= now()

		-- พร้อมรายละเอียดSubject
		SELECT stu_id,group_id,paper_id,se.course_id,title as papertitle,ep.description as paperdesc,
			rules,starttime,endtime,subject_id,code,name as subjectname,shortname,s.name as subjectdesc,ep.status
		FROM student_enroll se
		LEFT JOIN exam_papers ep on se.course_id = ep.course_id
		LEFT JOIN subjects s on s.subject_id = getSubjectIdFromCourseId(se.course_id)
		WHERE stu_id = '$stdId' and endtime >= now()
		ORDER BY starttime asc

		-- ใช้ View แทน  ไม่แสดงผลที่สอบแล้ว
		SELECT * FROM `upcomingtest` 
		WHERE stu_id = '$stdId' and paper_id not in (select paper_id from Scoreboard where stu_id = '$stdId')
		*/
		// $select = array('stu_id','group_id','paper_id','student_enroll.course_id',
		// 	'title as papertitle','exam_papers.description as paperdesc','rules','starttime','endtime',
		// 	'subject_id','code','name as subjectname','shortname','subjects.name as subjectdesc','status');
		$query = $this->db
			// ->select($select)
			->from('upcomingtest')
			->where('stu_id', $stdId)
			->where('status !=', 'deleted')
			->where('paper_id not in', "(select paper_id from scoreboard where stu_id = '$stdId')", false)
			->order_by('starttime','asc')
			->get()
			->result_array();
		//echo $this->db->last_query();
		return $query;
	}

}

/* End of file courses_model.php */
/* Location: ./application/models/courses_model.php */