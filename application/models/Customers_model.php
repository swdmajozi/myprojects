<?php
class Customers_model extends CI_Model{
function __construct() {
parent::__construct();
}



function SavePayment($data){
	// Inserting in Table(students) of Database(college)
	$this->db->insert('payments_payfast', $data);
	
	$insert_id = $this->db->insert_id();
	
	   return  $insert_id;
	}

function SaveCustomer($data){
// Inserting in Table(students) of Database(college)
$this->db->insert('customers', $data);

$insert_id = $this->db->insert_id();

   return  $insert_id;
}


function GetCustomerDataById($id){


   $query = $this->db->select('CustomerId, PaymentStatus')
		                  ->where('CustomerId', $id)
		                  ->limit(1)
		                  ->order_by('id', 'desc')
		                  ->get($this->tables['customers']);
}

//get  all  customers
function getAllCustomers(){

	$this->db->select('*');
	$this->db->from('customers');
///	$this->db->join('comments', 'comments.id = articles.id','left');
	
	$query = $this->db->get();
	return $query->result();
}


//get  payments

function getPayments(){

	$this->db->select('*');
	$this->db->from('payments_payfast');
///	$this->db->join('comments', 'comments.id = articles.id','left');
	
	$query = $this->db->get();
	return $query->result();
}

}
?>