<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mycourses extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'Users');
		$this->load->model('misc_model', 'misc');
		$this->load->model('courses_model', 'courses');

		// Permissions List for this Class
		$perm = array('admin', 'teacher');
		// Check
		if ($this->Users->_checkLogin())
		{
			if ( ! $this->Users->_checkRole($perm)) redirect('main');
		} else {
			redirect('auth/login');
		}
	}

	public function index()
	{
		$this->load->view('teacher/t_header_view');
		$this->load->view('teacher/t_headerbar_view');
		$this->load->view('teacher/t_sidebar_view');

		// SET Default Per page
		$data['perpage'] = '10';
		if ($this->input->get('perpage')!='') $data['perpage'] = $this->input->get('perpage');

		$uid = $this->session->userdata('uid');
		$data['total'] = $this->courses->countMyCourseList($uid, $this->input->get('q'));
		$data['courseslist'] = $this->courses->getMyCourseList($uid, $this->input->get('q'),
			$data['perpage'], 
			$this->misc->PageOffset($data['perpage'],$this->input->get('p')));

		$this->misc->PaginationInit(
			'teacher/mycourses?perpage='.
			$data['perpage'].'&q='.$this->input->get('q'),
			$data['total'],$data['perpage']);

		$data['pagin'] = $this->pagination->create_links();

		
		$this->load->view('teacher/mycourses_view', $data);
		$this->load->view('teacher/t_footer_view');
	}



}

/* End of file mycourses.php */
/* Location: ./application/controllers/mycourses.php */