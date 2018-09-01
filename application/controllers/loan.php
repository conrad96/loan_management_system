<?php
class Loan extends CI_Controller{

	public function assets(){
		$data['bootstrap']=$this->config->item("bootstrap");
		$data['base_url']=$this->config->item("base_url");
		$data['image']=$this->config->item("image");
		$data['jquery']=$this->config->item("jquery");
		$data['bootstrap_js']=$this->config->item("bootstrap_js");
		$data['css']=$this->config->item("css");
		$data['scripts']=$this->config->item("scripts");
		return $data;
	}

	public function index(){
		$data['assets']=$this->assets();
		$data['msg']="";
		$this->load->view("index",$data);
	}
	public function login(){
		$this->load->model("Tasks");
		$username=$this->input->post("username");
		$password=$this->input->post("password");
		$check=$this->Tasks->login($username,$password);
		if($check){
			foreach($check as $r){
				$this->admin($r->id,trim($r->username));
			}
		}else{
			$emp=$this->Tasks->login_emp($username,$password);
			if($emp){
				foreach($emp as $r){
					$this->employee($r->EPN,trim($r->username));
				}
			}else{
				$data['msg']="<div class='row alert alert-danger'>
				<span id='msg'>Incorrect password or Username</span>
				</div>";
				$data['assets']=$this->assets();
				$this->load->view("index",$data);
			}
		}
	}
	public function admin($id,$name){
		$this->load->model("Tasks");
		$data['id']=$id;
		$data['uname']=$name;
		$data['msg']="";
		$data['assets']=$this->assets();
		$data['emps']=$this->Tasks->emps();
		$data['pending']=$this->Tasks->pending_loans();
		$data['rejected']=$this->Tasks->rejected();
		$data['approved']=$this->Tasks->approved();
		$this->load->view('admin',$data);
	}
	public function approve_loan_btn(){
		$val=array($this->input->post("status"),$this->input->post("loan_id"));
		$this->Tasks->approve_loan($val);
	}
	public function approve_loan_success($id,$name){
		$data['msg']="<div class='row alert alert-success'><center>Loan application Status changed </center></div>";
		$data['id']=$id;
		$data['uname']=$name;
		$data['emps']=$this->Tasks->emps();
		$data['pending']=$this->Tasks->pending_loans();
		$data['assets']=$this->assets();
		$data['rejected']=$this->Tasks->rejected();
		$data['approved']=$this->Tasks->approved();
		$this->load->view("admin",$data);
	}
	//loan approval process fails
	public function approve_loan_fail($id,$name){
		$data['msg']="<div class='row alert alert-danger'><center>Loan Application Status Failed to update</center></div>";
		$data['id']=$id;
		$data['uname']=$name;
		$data['emps']=$this->Tasks->emps();
		$data['pending']=$this->Tasks->pending_loans();
		$data['rejected']=$this->Tasks->rejected();
		$data['approved']=$this->Tasks->approved();
		$this->load->view("admin",$data);
	}
	public function employee($id,$name){
		$data['id']=$id;
		$data['uname']=$name;
		$data['msg']="";
		$data['assets']=$this->assets();
		$data['activity']=$this->Tasks->emp_activity($id);
		$data['loan']=$this->Tasks->loan($id);
		$data['rejected']=$this->Tasks->rejected_emp($id);
		$data['approved']=$this->Tasks->approved_emp($id);
		$this->load->view('employee',$data);
	}
	public function reg_emp($id,$name){
		$data['id']=$id;
		$data['uname']=$name;
		$data['assets']=$this->assets();
		$this->load->view("reg-emp",$data);
	}
	public function register_employee($id,$name){
		if($this->input->post("password") == $this->input->post("cpassword")){
			$package=array(
$this->input->post("fullnames"),
$this->input->post("username"),
$this->input->post("password"),
$this->input->post("email"),
$this->input->post("contact"),
$this->input->post("salary"),
$this->input->post("section")
		);
		$this->load->model("Tasks");
		$reg=$this->Tasks->register_employee($package);
		if($reg){
			$data['msg']="<div class='row alert alert-success'>
<span id='msg'>Employee Registered Successfully</span>
			</div>";
			$data['assets']=$this->assets();
			$data['id']=$id;
			$data['uname']=$name;
			$this->load->view("reg-emp",$data);
		}else{
		$data['msg']="<div class='row alert alert-danger'>
<span id='msg'>an error occured , employee not registered </span>
			</div>";
			$data['assets']=$this->assets();
			$data['id']=$id;
			$data['uname']=$name;
			$this->load->view("reg-emp",$data);
		}
		}else{
		$data['msg']="<div class='row alert alert-danger'>
<span id='msg'>Password Mismatch. try again </span>
			</div>";
			$data['assets']=$this->assets();
			$data['id']=$id;
			$data['uname']=$name;
			$this->load->view("reg-emp",$data);
		}
	}
	public function interest($id,$name){
		$data['id']=$id;
		$data['uname']=$name;
		$data['assets']=$this->assets();
		$data['msg']="";
		$this->load->view("reg-interest",$data);
	}

	public  function reports($id,$name){
		$data['id']=$id;
		$data['uname']=$name;
		$data['assets']=$this->assets();
		$data['msg']="";
		$data['rejected']=$this->Tasks->rejected();
		$data['approved']=$this->Tasks->approved();
		$data['applications']=$this->Tasks->applications();
		$this->load->view("reports",$data);
	}

	public function register_loan($id,$name){
		$package=array(
$this->input->post("type"),
$this->input->post("interest"),
$this->input->post("loan_range"),
$this->input->post("period")
		);
		$this->load->model("Tasks");
		$bool=$this->Tasks->register_load($package);
		if($bool){
			$data['id']=$id;
		$data['uname']=$name;
		$data['assets']=$this->assets();
		$data['msg']="<div class='row alert alert-success'>
<span id='msg'>Loan Added Successfully</span>
			</div>";
		$this->load->view("reg-interest",$data);
		}else{
		$data['id']=$id;
		$data['uname']=$name;
		$data['assets']=$this->assets();
		$data['msg']="<div class='row alert alert-danger'>
<span id='msg'>An Error occured. Loan Not Added</span>
			</div>";
		$this->load->view("reg-interest",$data);
		}
	}
	public function delete($id,$name,$EPN){
		$this->load->model("Tasks");
		$bool=$this->Tasks->delete($EPN);
		if($bool){
			$data['id']=$id;
		$data['uname']=$name;
		$data['msg']="<div class='row alert alert-success'>
<span id='msg'>Employee Deleted</span>
			</div>";
		$data['assets']=$this->assets();
		$data['emps']=$this->Tasks->emps();
		$data['rejected']=$this->Tasks->rejected();
		$data['approved']=$this->Tasks->approved();
		$this->load->view('admin',$data);
		}else{
		$data['id']=$id;
		$data['uname']=$name;
		$data['msg']="<div class='row alert alert-danger'>
<span id='msg'>Employee Not Deleted</span>
			</div>";
		$data['assets']=$this->assets();
		$data['emps']=$this->Tasks->emps();
		$data['rejected']=$this->Tasks->rejected();
		$data['approved']=$this->Tasks->approved();
		$this->load->view('admin',$data);
		}
	}
	public function edit($id,$name,$EPN){
$package=array($this->input->post("edit_names"),
$this->input->post("edit_salary"));
$bool=$this->Tasks->edit($package,$EPN);
if($bool){
		$data['id']=$id;
		$data['uname']=$name;
		$data['msg']="<div class='row alert alert-success'>
<span id='msg'>Employee Record Edited Successfully</span>
			</div>";
		$data['assets']=$this->assets();
		$data['emps']=$this->Tasks->emps();
		$data['rejected']=$this->Tasks->rejected();
		$data['approved']=$this->Tasks->approved();
		$this->load->view('admin',$data);
	}else{
		$data['id']=$id;
		$data['uname']=$name;
		$data['msg']="<div class='row alert alert-danger'>
<span id='msg'>Employee Record Not Edited </span>
			</div>";
		$data['assets']=$this->assets();
		$data['emps']=$this->Tasks->emps();
		$data['rejected']=$this->Tasks->rejected();
		$data['approved']=$this->Tasks->approved();
		$this->load->view('admin',$data);
	}
}
public function employee_forms($id,$name){
	$data['id']=$id;
	$data['uname']=$name;
	$data['msg']="";
	$data['assets']=$this->assets();
	$data['profile']=$this->Tasks->emp_profile($id);
	$data['loans']=$this->Tasks->loans_details();
	$this->load->view('employee-forms',$data);
}
public function loan_applications($id,$name){
	$package=array($this->input->post("epn"),$this->input->post("names"),$this->input->post("section"),$this->input->post("type"),$this->input->post("loan_amount"),$this->input->post("reason"),$this->input->post("sal"));
	$bool=$this->Tasks->loan_application_form($package);
	if($bool){
		$data['id']=$id;
		$data['uname']=$name;
		$data['assets']=$this->assets();
		$data['msg']="<div class='row alert alert-success'><center>Application Sent Successfully</center></div>";
		$data['profile']=$this->Tasks->emp_profile($id);
		$data['loans']=$this->Tasks->loans_details();
		$this->load->view('employee-forms',$data);
	}else{
		$data['id']=$id;
		$data['uname']=$name;
		$data['msg']="<div class='row alert alert-success'><center>Application Not Sent. An Error Occured. please Report to ur IT administrator</center></div>";
		$data['assets']=$this->assets();
		$data['profile']=$this->Tasks->emp_profile($id);
		$data['loans']=$this->Tasks->loans_details();
		$this->load->view('employee-forms',$data);
	}
}
	public function logout(){
		$this->index();
	}
}
?>
