<?php
class Tasks extends CI_Model{
	public function index(){
		parent::__construct();
	}
	public function login($u,$p){
		$this->load->database();
		$query=$this->db->select("*")->from("administrator")->where('username',$u)->where('password',$p)->get()->result();
		return (!empty($query))? $query:false;
	}
	public function login_emp($u,$p){
		$this->load->database();
		$query=$this->db->select("*")->from("employee")->where('username',$u)->where('password',$p)->get()->result();
		return (!empty($query))? $query:false;
	}
	public function register_employee($array){
		$this->load->database();
		$data['fullnames']=$array[0];
		$data['username']=$array[1];
		$data['password']=$array[2];
		$data['email']=$array[3];
		$data['contact']=$array[4];
		$data['salary']=$array[5];
		$data['section']=$array[6];
		return ($this->db->insert("employee",$data))? true:false;
	}
	public function register_load($array){
		$this->load->database();
$data['loan_interest']=$array[1];
$data['loan_range']=$array[2];
$data['type']=$array[0];
$data['loan_period']=$array[3];
return ($this->db->insert("loan",$data))? true:false;
	}
	public function emps(){
		$query=$this->db->select("*")->from("employee")->get()->result();
		return $query;
	}
	public function emp_profile($id){
		$query=$this->db->select("*")->from("employee")->where("EPN",$id)->get()->result();
		return $query;
	}
	public function delete($EPN){
		$query=$this->db->query("DELETE FROM employee WHERE EPN='$EPN' ");
		return ($query)? true:false;
	}
	public function loans_details(){
		$q=$this->db->select("*")->from("loan")->get()->result();
		return $q;
	}
	public function edit($array,$EPN){
		$query=$this->db->query("UPDATE employee SET fullnames='$array[0]',salary='$array[1]' WHERE EPN='$EPN' ");
		return ($this->db->affected_rows() == 1)? true:false;
	}
	public function loan_application_form($array){
		// $form['EPN']=$array[0];
		// $form['fullnames']=$array[1];
		// $form['section']=$array[2];
		// $form['salary']=$array[6];
		// $form['loan_type']=$array[3];
		// $form['loan_amount']=$array[4];
		// $form['status']="pending";
		// $form['reason']=$array[5];
		// return $form;
		// exit();
		return ($this->db->insert("loan_applications",$array))? true:false;
	}
	public function emp_activity($id){
		$query=$this->db->select("*")->from("loan_applications")->where("EPN",$id)->where("status","pending")->get()->result();
		return $query;
	}
	public function loan($id){
		$query=$this->db->query("SELECT * FROM loan INNER JOIN loan_applications ON loan_applications.loan_type=loan.type INNER JOIN employee ON loan_applications.EPN=employee.EPN WHERE loan_applications.EPN='$id' ")->result();
		return (!empty($query))? $query:array();
	}
	public function pending_loans(){
		return $this->db->select("*")->from("loan_applications")->where("status","pending")->get()->result();
	}
	public function approve_loan($array){
		$query=$this->db->query("UPDATE loan_applications SET status='$array[0]' WHERE loan_applications.id='$array[1]' ");
	}
	public function applications(){
		return $this->db->select("*")->from("loan_applications")->get()->result();
	}
	public function rejected(){
		return $this->db->select("*")->from("loan_applications")->where("status","Rejected")->get()->result();
	}
	public function approved(){
		return $this->db->select("*")->from("loan_applications")->where("status","Approved")->get()->result();
	}
	public function rejected_emp($id){
		return $this->db->select("*")->from("loan_applications")->where("status","Rejected")->where("EPN",$id)->get()->result();
	}
	public function approved_emp($id){
		return $this->db->select("*")->from("loan_applications")->where("status","Approved")->where("EPN",$id)->get()->result();
	}
}
?>
