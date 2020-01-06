<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();

	}

	function getQuestionCount()
	{
		$query = $this->db
			->select('count(question_id) as qcount')
			->get('questions')
			->row_array();
		return $query['qcount'];
	}

	function getcoursesListCount($teaid='', $keyword='', $perpage=0, $offset=0, $year=0)
	{
		if ($perpage=='') $perpage=0;
		if ($offset=='') $offset=0;
		settype($offset, "integer");
		settype($perpage, "integer");

		if ($perpage > 0) $this->db->limit($perpage, $offset);
		$cause = array();
		if ($year != 0) $cause['year'] = $year;
		if ($teaid != '') $this->db->where('course_id IN', "( SELECT course_id FROM teacher_course_detail WHERE tea_id = '$teaid')", false);

		$query = $this->db
			->like("CONCAT(code,name,shortname,description)",$keyword,'both')
			->where($cause)
			->order_by('year','desc')
			->order_by('examcount','desc')
			->order_by('code','asc')
			->get('report_courses')
			->result_array();
			// die( $this->db->last_query());
		return $query;
	}

	function countcoursesListCount($teaid='', $keyword='', $year=0)
	{

		$cause = array();
		if ($year != 0) $cause['year'] = $year;
		if ($teaid != '') $this->db->where('course_id IN', "( SELECT course_id FROM teacher_course_detail WHERE tea_id = '$teaid')", false);

		$query = $this->db
			->select("count(*) as scount")
			->like("CONCAT(code,name,shortname,description)",$keyword,'both')
			->where($cause)
			->get('report_courses')
			->row_array();
		return $query['scount'];
	}

	function getReportCourseCalc($course_id, $paperid=null)
	{
		$criteria['course_id'] = $course_id;
		if ($paperid !== null) $criteria['paper_id'] = $paperid;
		$criteria['paper_id >='] = '0';
		$query = $this->db
			->where($criteria)
			->get('report_course_calc')
			->result_array();
		// die( $this->db->last_query());
		return $query;
	}

	function getStdScoreByPaper($paperid)
	{
		/*
			SELECT sco_id, scoreboard.stu_id, title, name, lname, course_id, paper_id, Score, getStudentGroupByCourseId(course_id, scoreboard.stu_id) as groupname
			FROM scoreboard
			LEFT JOIN students ON scoreboard.stu_id = students.stu_id
			WHERE paper_id =  '6'
			ORDER BY scoreboard.stu_id asc
		*/
		$query = $this->db
			->select(array('sco_id','scoreboard.stu_id','title','name','lname','course_id',
				'paper_id','Score', 'getStudentGroupByCourseId(course_id, scoreboard.stu_id) as groupname'))
			->from('scoreboard')
			->join('students','scoreboard.stu_id = students.stu_id','left')
			->where('paper_id', $paperid)
			->order_by('groupname', 'asc')
			->order_by('scoreboard.stu_id', 'asc')
			->get()
			->result_array();
		// echo $this->db->last_query();
		return $query;
	}

	function getPapersByCourseId($courseid)
	{
		$query = $this->db
			->select('*')
			->from('exam_papers')
			->where('course_id', $courseid)
			->get()
			->result_array();
		return $query;
	}

	function getReportByStudent($courseid)
	{
/*
SELECT stu_id, getScoreByPaperId(11,stu_id) as paper_1 FROM `student_enroll` WHERE `course_id` = 6
*/
		$selcol[] = "students.stu_id";
		$selcol[] = "title";
		$selcol[] = "name";
		$selcol[] = "lname";
		foreach ($this->getPapersByCourseId($courseid) as $item) {
			$selcol[] = "getScoreByPaperId($item[paper_id],student_enroll.stu_id) as paper_$item[paper_id]";
		}
		$selcol[] = "getStudentGroupByCourseId(course_id, student_enroll.stu_id) as groupname";
		$query = $this->db
			->select($selcol)
			->join('students','student_enroll.stu_id = students.stu_id','left')
			->where('course_id', $courseid)
			->order_by('groupname', 'asc')
			->get('student_enroll')
			->result_array();
		return $query;
	}

	// =================
	// STUDENT's STATS
	// =================
	function getReportTestedcourses($stu_id)
	{
		$query = $this->db
			->select(array('scoreboard.course_id','code','year','name','shortname','description'))
			->join('courseslist_view','scoreboard.course_id = courseslist_view.course_id','left')
			->where('stu_id',$stu_id)
			->group_by('scoreboard.paper_id')
			->get('scoreboard')
			->result_array();
		// echo $this->db->last_query();
		return $query;
	}

	function getReportTestedPapers($stu_id, $courseid)
	{
		$query = $this->db
			->select(array('sco_id','stu_id','scoreboard.course_id','scoreboard.paper_id','papername','starttime','endtime', 'Score','average'))
			->join('report_course_calc', 'scoreboard.paper_id = report_course_calc.paper_id','left')
			->where('stu_id', $stu_id)
			->where('scoreboard.course_id', $courseid)
			->get('scoreboard')
			->result_array();
		// echo $this->db->last_query();
		return $query;
	}

	function testedCount()
	{
		$query = $this->db
			->select('count(sco_id) as scorecount')
			->get('scoreboard')
			->row_array();
		return $query['scorecount'];
	}

}

/* End of file report_model.php */
/* Location: ./application/models/report_model.php */