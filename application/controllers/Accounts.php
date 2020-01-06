<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth', 'form_validation','smsportal'));
		$this->load->helper(array('url', 'language'));
      
        $this->load->library('grocery_CRUD');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');

		$this->load->model('Customers_model');
	}


	//insert  payment  DB

	// This function call from AJAX
public function SavePayment() {
	$data = array(
	'FirstName' => $this->input->post('first_name'),
	'LastName'=>$this->input->post('last_name'),
	'IdNumber' => $this->input->post('idnumber'),
	'Bank'=>$this->input->post('bank'),
	'Email' => $this->input->post('email'),
	'Phone'=>$this->input->post('phone'),
	'CreatedBy' => $this->session->userdata("user_id"),
	'CreatedDate'=> date('Y/m/d H:i:s'),
	'PaymentSatus'=> "Pending"
	);
	
	
	
	$first_name = $this->input->post('first_name');
	$last_name = $this->input->post('last_name');
	$email = $this->input->post('email');
	$phonenumbers = $this->input->post('phone');
	$productName= $this->input->post('phone');;
	
	$lastId = $this->Customers_model->SavePayment($data);
}
   function _example_output($output)
 
    {


          //print_r($output);
         

    	   $this->data['admin'] = $this->ion_auth->user()->row();
         //  $this->data['content'] = $view;
          //    $this->load->view('admin/login_template',$this->data);
    	 // 
          // $this->data['view'] = $this->load->view('our_template.php',$output);  
           $this->data['content'] = $this->load->view('our_template',$output);  
          $this->data['content'] = $view; 
           $this->_render_page('admin/layout2', $this->data);
      
     ///   $this->load->view('our_template.php',$output);    
    }
//get  all  customers  


	 public function getcustomers()
    {
       	$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('customers');
		//$crud->set_relation('officeCode','offices','city');
		//	$crud->display_as('officeCode','Office City');
		//	$crud->set_subject('Employee');

	//		$crud->required_fields('lastName');

	//		$crud->set_field_upload('file_url','assets/uploads/files');

			$output = $crud->render();

			$this->_example_output($output);
    }

		public function AddCustomer()
	{

		if ($this->ion_auth->logged_in())
		{
	
			// display the create user form
	

			$this->data['first_name'] = array(
				'name' => 'first_name',
				'id' => 'first_name',
				'type' => 'text',
                'placeholder' => 'First Name',
				'value' => $this->form_validation->set_value('first_name'),
			);
			$this->data['last_name'] = array(
				'name' => 'last_name',
				'id' => 'last_name',
				'type' => 'text',
                'placeholder' => 'Last Name',
                'value' => $this->form_validation->set_value('last_name'),
			);
			$this->data['identity'] = array(
				'name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['email'] = array(
				'name' => 'email',
				'id' => 'email',
				'type' => 'text',
                'placeholder' => 'Email',
				'value' => $this->form_validation->set_value('email'),
			);
			$this->data['idnumber'] = array(
				'name' => 'idnumber',
				'id' => 'idnumber',
				'type' => 'text',
                'placeholder' => 'ID Number',
				'value' => $this->form_validation->set_value('company'),
			);
			$this->data['phone'] = array(
				'name' => 'phone',
				'id' => 'phone',
				'type' => 'text',
                'placeholder' => 'Cell Number#',
				'value' => $this->form_validation->set_value('phone'),
			);

			$this->data['address'] = array(
				'name' => 'address',
				'id' => 'address',
				'type' => 'text',
                'placeholder' => 'Address',
				'value' => $this->form_validation->set_value('address'),
			);

			$this->data['city'] = array(
				'name' => 'city',
				'id' => 'city',
				'type' => 'text',
                'placeholder' => 'City',
				'value' => $this->form_validation->set_value('city'),
			);

			$this->data['code'] = array(
				'name' => 'code',
				'id' => 'code',
				'type' => 'text',
                'placeholder' => 'Code',
				'value' => $this->form_validation->set_value('code'),
			);
			$this->data['bank'] = array(
				'FNB' => 'FNB',
				'ABSA' => 'ABSA',
				'NEDBANK' => 'NEDBANK',
                'STANDARDBANK' => 'STANDARD BANK',
                'CAPITEC' => 'CAPITEC',
			);

			$this->data['products'] = array(
				'CreditRepair' => 'Credit Repair',
				'CreditCleanUp' => 'Credit CleanUp',
				'CreditReport' => 'Credit Report',
				'CreditAssessment' => 'Credit Assessment',
			
			);
			$this->data['amount'] = array(
				'name' => 'amount',
				'id' => 'amount',
				'type' => 'text',
                'placeholder' => 'Product Amount',
				'value' => $this->form_validation->set_value('amount'),
			);
            $this->data['admin'] = $this->ion_auth->user()->row();
            $this->data['content'] = 'customers/customers';
       //    $this->load->view('admin/login_template',$this->data);
            $this->data['view'] = 'customers/customers';
            $this->_render_page('admin/layout', $this->data);
		//	$this->_render_page('auth/' . DIRECTORY_SEPARATOR . 'create_user', $this->data);
		}

}




// This function call from AJAX
public function SaveCustomer() {
$data = array(
'FirstName' => $this->input->post('first_name'),
'LastName'=>$this->input->post('last_name'),
'IdNumber' => $this->input->post('idnumber'),
'Bank'=>$this->input->post('bank'),
'Email' => $this->input->post('email'),
'Phone'=>$this->input->post('phone'),
'Product'=>$this->input->post('products'),
'productAmount'=>$this->input->post('amount'),
'address'=>$this->input->post('address'),
'code'=>$this->input->post('code'),
'city'=>$this->input->post('city'),
'subscription_type'=>$this->input->post('subscription_type'),
'CreatedBy' => $this->session->userdata("user_id"),
'CreatedDate'=> date('Y/m/d H:i:s'),
'PaymentSatus'=> "Pending",
'cycles'=> 0,
'frequency'=> 3,
);



$first_name = $this->input->post('first_name');
$last_name = $this->input->post('last_name');
$email = $this->input->post('email');
$phonenumbers = $this->input->post('phone');
$productName= $this->input->post('products');
$banking = $this->input->post('bank');


if($banking != 'CAPITEC'){
$lastId = $this->Customers_model->SaveCustomer($data);

//get  user  details  using  last  inserted  ID  

//$CusDetails = $this->Customers_model->GetCustomerDataById($lastId);

if($lastId){

 $url = base_url().'accounts/icssubscriptioncheckout/cusid/'.$lastId.'/fname/'.$first_name.'/lname/'.$last_name.'/email/'.$email.'/pnumbers/'.$phonenumbers;
$html = '<a href= '.$url.'>LINK</a>'; 

 $test = new Smsportal();
 $message = 'Hi, Mr/Mrs '.$last_name.', Your Financial Freedom Awaits Simply Follow The '.$html.' Below And  Complete The Instructions To SUBSCRIBE your ICS '.$productName.'';
 $test->sendSms($phonenumbers, $message); //Send SMS


 $this->email->from('noreply@icswebserver.co.za','Interactive Credit Solutions Subscription');

  $toaddress = $email;
  $this->email->to($toaddress); 

  $this->email->subject('Interactive Credit Solutions Subscription');
  $this->email->message('Hi, Mr/Mrs '.$last_name.', Your Financial Freedom Awaits Simply Follow The '.$html.' Below And  Complete The Instructions To SUBSCRIBE your ICS '.$productName.'');

  $this->email->send();  
}    

}else{
	$url = base_url().'accounts/icssubscriptioncheckout/cusid/'.$lastId.'/fname/'.$first_name.'/lname/'.$last_name.'/email/'.$email.'/pnumbers/'.$phonenumbers;
$pdf = "";
	$this->email->from('noreply@icswebserver.co.za','Interactive Credit Solutions Subscription');
   
	 $toaddress = $email;
	 $this->email->to($toaddress); 
   
	 $this->email->subject('Interactive Credit Solutions Subscription');
	 $this->email->message('Hello '.$this->input->post('first_name').' '.$this->input->post('first_name').'., Please  Find PDF attached  for  Debit Order To  accept  Terms  and  Conditions');
   
	 $this->email->send(); 


}
//Either you can print value or you can send value to database


echo json_encode($lastId);


}



public function  send_email($url, $first_name, $last_name){

   $this->email->from('noreply@icswebserver.co.za','ICS  Web APP');

   $toaddress = 'swdmajozi@gmail.com';
	$this->email->to($toaddress); 

	$this->email->subject('Payment Link');
	$this->email->message('Hello '.$first_name.' '.$last_name.'., Please  Follow  This Link <a href="'.$url.'">Link </a>  To  accept  Terms  and  Conditions');

	$this->email->send();     

}


public function success(){

	$this->load->view('customers/success');  

}

public function cancel(){

     $this->load->view('customers/cancel');  

}
public function sendsms(){

	$test = new Smsportal();
	$test->sendSms('0780704148','Test Message'); //Send SMS
	//$test->checkcredits(); //Check your credit balance

}

public function IcsSubscriptionCheckout(){

       $get = $this->uri->uri_to_assoc();
       echo $get['cusid']; // value
	   echo $get['fname'];
	   echo $get['lname'];
	   echo $get['email'];
	   echo $get['pnumbers'];
       echo $get['productId'] = "SK203";

       $this->load->view('customers/checkout', $get);

}


           private function _render_page($view, $data = NULL, $returnhtml = FALSE)

//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data : $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		// This will return html on 3rd argument being true
		if ($returnhtml)
		{
			return $view_html;
		}
	}

	
    public function allcustomers(){
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('login', 'refresh');
        }
        else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
        {
            // redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        }
        else
        {
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            //list the users
			$this->data['users'] = $this->Customers_model->getAllCustomers();
			
		//	print_r($this->data['users']);
            $this->data['admin'] = $this->ion_auth->user()->row();
            $this->data['view'] = 'customers/index';
            $this->_render_page('admin/layout', $this->data);
        }

	}
	
		
    public function payments(){
        if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('login', 'refresh');
        }
        else if (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
        {
            // redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        }
        else
        {
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            //list the users
			$this->data['users'] = $this->Customers_model->getPayments();
			
		//	print_r($this->data['users']);
            $this->data['admin'] = $this->ion_auth->user()->row();
            $this->data['view'] = 'customers/payments';
            $this->_render_page('admin/layout', $this->data);
        }

    }
	


}


