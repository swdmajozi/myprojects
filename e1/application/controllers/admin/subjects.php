<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subjects extends CI_Controller {

	/* Scripts */
	private $scriptList;
	private $ckeditor;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model', 'Users');
		$this->load->model('misc_model', 'misc');
		$this->load->model('subjects_model','subjects');

		// Permissions List for this Class
		$perm = array('admin');
		// Check
		if ($this->Users->_checkLogin())
		{
			if ( ! $this->Users->_checkRole($perm)) redirect('main');
		} else {
			redirect('auth/login');
		}

		$this->ckeditor = "CKEDITOR.replace('editor');";

		$this->scriptList = array(
			'ckeditor' => $this->ckeditor,
		);
		define('useEditor', true);
	}

	private function getAddScripts()
	{
		return $this->scriptList;
	}

	public function index()
	{
		$this->load->view('admin/t_header_view');
		$this->load->view('admin/t_headerbar_view');
		$this->load->view('admin/t_sidebar_view');

		// SET Default Per page
		$data['perpage'] = '10';
		if ($this->input->get('perpage')!='') $data['perpage'] = $this->input->get('perpage');

		$data['total'] = $this->subjects->countSubjectList($this->input->get('q'));
		$data['subjectlist'] = $this->subjects->getSubjectList($this->input->get('q'),
			$data['perpage'],
			$this->misc->PageOffset($data['perpage'],$this->input->get('p')));

		$this->misc->PaginationInit(
			'admin/subjects?perpage='.
			$data['perpage'].'&q='.$this->input->get('q'),
			$data['total'],$data['perpage']);

		$data['pagin'] = $this->pagination->create_links();


		$this->load->view('admin/subjects_view', $data);
		$this->load->view('admin/t_footer_view');
	}

	public function view($subjectId='')
	{
		$this->session->set_flashdata('noAnim', true);
		$this->load->view('admin/t_header_view');
		$this->load->view('admin/t_headerbar_view');
		$this->load->view('admin/t_sidebar_view');

		if ($this->input->post('submit'))
		{
			$this->edit($subjectId);
		}
		else
		{
			if ($subjectId == '')
			{
				redirect('admin/subjects');
			}
			else
			{
				$data['subjectInfo'] = $this->subjects->getSubjectById($subjectId);
				//die(var_dump($data['subjectInfo']));
				if (empty($data['subjectInfo']))
				{
					show_404();
				}
				else
				{
					$data['formlink'] = 'admin/subjects/view/'.$data['subjectInfo']['code'];
					$data['pagetitle'] = "Course Details ".$data['subjectInfo']['code']." ".$data['subjectInfo']['name'];
					$data['pagesubtitle'] = "";
					$this->load->view('admin/field_subject_view', $data);
				}

			}
		}
		// Send additional script to footer
		$footdata['additionScript'] = $this->getAddScripts();
		$this->load->view('admin/t_footer_view', $footdata);
	}

	public function add()
	{
		$this->load->view('admin/t_header_view');
		$this->load->view('admin/t_headerbar_view');
		$this->load->view('admin/t_sidebar_view');

		$data['formlink'] = 'admin/subjects/add';
		$data['pagetitle'] = "addSubject";
		$data['pagesubtitle'] = "ในระบบ";
		$data['subjectInfo'] = array(
			'code' => set_value('code'),
			'name' => set_value('name'),
			'shortname' => set_value('shortname'),
			'description' => set_value('description'),
		);

		if ($this->input->post('submit'))
		{
			$this->form_validation->set_rules('code', 'Course code', 'required');
			$this->form_validation->set_rules('name', 'Course name', 'required');
			$this->form_validation->set_rules('shortname', 'Subject Abbreviations', 'required');
			$this->form_validation->set_message('required', 'You must fill out %s');
			if ($this->form_validation->run())
			{
				# Form check completed
				$subjectData['subject_id'] = $this->input->post('subject_id');
				$subjectData['code'] = $this->input->post('code');
				$subjectData['name'] = $this->input->post('name');
				$subjectData['shortname'] = $this->input->post('shortname');

				// HTMLPurifier
				require_once 'application/libraries/htmlpurifier/HTMLPurifier.auto.php';
				$purifier = new HTMLPurifier();
				$clean_html = $purifier->purify($this->input->post('description'));

				$subjectData['description'] = $clean_html;

				if ($this->subjects->addSubject($subjectData))
				{
					# Add success
					$this->session->set_flashdata('msg_info',
						'ปรับปรุง <b>'.$subjectData['code'].' '.$subjectData['name'].'</b> neat');
					redirect('admin/subjects');
				} else {
					# Failed
					$this->session->set_flashdata('msg_error',
						'Something went wrong Cant add '.$subjectData['code'].' '.$subjectData['name'].' ได้');
					redirect('admin/subjects');
				}
			}
			else
			{
				$data['msg_error'] = 'Please fill out all information.';
				//$data['subjectInfo'] = $this->subjects->getSubjectById($subjectId);
				$data['subjectInfo']['code'] = $this->input->post('code');
				$data['subjectInfo']['name'] = $this->input->post('name');
				$data['subjectInfo']['shortname'] = $this->input->post('shortname');
				$data['subjectInfo']['description'] = $this->input->post('description');
				$this->load->view('admin/field_subject_view', $data);
			}
		}
		else
		{
			$this->load->view('admin/field_subject_view', $data);
			// Send additional script to footer
			$footdata['additionScript'] = $this->getAddScripts();
			$this->load->view('admin/t_footer_view', $footdata);
		}
	}

	public function edit($subjectId)
	{
		$this->form_validation->set_rules('code', 'Course code', 'required');
		$this->form_validation->set_rules('name', 'nameSubject', 'required');
		$this->form_validation->set_rules('shortname', 'Subject Abbreviations', 'required');
		//$this->form_validation->set_rules('description', 'The description', 'required');
		$this->form_validation->set_message('required', 'You must fill out %s');
		if ($this->form_validation->run())
		{
			# Form check completed
			//$subjectData['subject_id'] = $subjectId;
			$subjectData['code'] = $this->input->post('code');
			$subjectData['name'] = $this->input->post('name');
			$subjectData['shortname'] = $this->input->post('shortname');

			// HTMLPurifier
			require_once 'application/libraries/htmlpurifier/HTMLPurifier.auto.php';
			$purifier = new HTMLPurifier();
			$clean_html = $purifier->purify($this->input->post('description'));

			$subjectData['description'] = $clean_html;
			// die(var_dump($subjectData));
			if ($this->subjects->updateSubject($subjectData, $subjectId))
			{
				# modify success
				$this->session->set_flashdata('msg_info',
					'ปรับปรุง <b>'.$subjectData['code'].' '.$subjectData['name'].'</b> neat');
				redirect('admin/subjects');
			} else {
				# Failed
				$this->session->set_flashdata('msg_error',
					'Something went wrong ไม่สามารถปรับปรุง '.$subjectData['code'].' '.$subjectData['name'].' ได้');
				redirect('admin/subjects');
			}
		}
		else
		{
			$data['msg_error'] = 'Please fill out all information.';
			$data['subjectInfo'] = $this->subjects->getSubjectById($subjectId);
			$data['formlink'] = 'admin/subjects/view/'.$data['subjectInfo']['code'];
			$data['pagetitle'] = "Course Details ".$data['subjectInfo']['code']." ".$data['subjectInfo']['name'];
			$data['pagesubtitle'] = "";

			$data['subjectInfo']['code'] = $this->input->post('code');
			$data['subjectInfo']['name'] = $this->input->post('name');
			$data['subjectInfo']['shortname'] = $this->input->post('shortname');
			$data['subjectInfo']['description'] = $this->input->post('description');
			$this->load->view('admin/field_subject_view', $data);
		}
	}

}

/* End of file subjects.php */
/* Location: ./application/controllers/subjects.php */