<?php
class Managestudent extends CI_Controller{
	public function newstudent(){
		$this->load->library('form_validation');
		$this->load->model('managestudents');
		$this->form_validation->set_rules('fname','student first name','required');
		$this->form_validation->set_rules('lname','student last name','required');
		$this->form_validation->set_rules('tel','student telephone number','required|max_length[10]|min_length[10]|numeric');
		if($this->form_validation->run()==FALSE){
			echo validation_errors();
		}
		else{
		if($this->managestudents->newstudent())
			echo "success";
		}
	}
	public function deletestudent(){
		$this->load->model('managestudents');
		if($this->managestudents->deletestudent()){
			$this->load->model('viewstudents');
			$students['students']=$this->viewstudents->getdetails();
			$this->load->view('studentview',$students);
		}
	}
	public function updatestudent(){
		$this->load->library('form_validation');
		$this->load->model('managestudents');
		$this->form_validation->set_rules('fname','student first name','required');
		$this->form_validation->set_rules('lname','student last name','required');
		$this->form_validation->set_rules('tel','student telephone number','required|max_length[10]|min_length[10]|numeric');
		if($this->form_validation->run()==FALSE){
			echo validation_errors();
		}
		else{
		if($this->managestudents->updatestudent())
			echo "success";
		}
		
	}
	
	
}
?>