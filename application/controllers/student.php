<?php
class student extends CI_Controller{
	
	public function index(){
		$this->load->model('viewstudents');
		$students['students']=$this->viewstudents->getdetails();
		$this->load->view('studentview',$students);
	}
	
}


?>