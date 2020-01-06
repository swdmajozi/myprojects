<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class subjects_model extends CI_Model {

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
		return $this->getMethodName()=="add"?'Add info':'Save data';
	}

	function getSubjectList($keyword='', $perpage=0, $offset=0)
	{
		// $fields = array(
		// 	'users.id', 'username', 'role', 'status'
		// );
		// $cause = array('role' => 'admin');

		if ($perpage=='') $perpage=0;
		if ($offset=='') $offset=0;
		settype($offset, "integer");
		settype($perpage, "integer");

		if ($perpage > 0) $this->db->limit($perpage, $offset);
		$query = $this->db
			// ->select($fields)
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

	function getSubjectById($subjectId)
	{
		$cause = array('code' => $subjectId);
		$query = $this->db
			->get_where('subjects', $cause)
			->row_array();
		//die(var_dump($query));
		return $query;
	}

	function addSubject($subjectData)
	{
		$query = $this->db->insert('subjects', $subjectData);
		return $query;
	}

	function updateSubject($subjectData, $subjectId)
	{
		// var_dump($subjectData);
		// echo '<br>';
		// var_dump($subjectId);
		$query = $this->db->update('subjects', $subjectData, array('code'=>$subjectId));
		// die(var_dump($query));
		// die($this->db->last_query());
		return $query;
	}

}

/* End of file subjects_model.php */
/* Location: ./application/models/subjects_model.php */