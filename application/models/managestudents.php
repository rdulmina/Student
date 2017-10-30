<?php
class managestudents extends CI_Model{
	public function newstudent(){
		$this->load->database();
		$new_student_data=array(
			'Fname'=>$this->input->post('fname'),
			'Lname'=>$this->input->post('lname'),
			'Tel'=>$this->input->post('tel')
	
		);
       	$insert=$this->db->insert('student',$new_student_data);
		return $insert;
        
	}
	public function deletestudent(){
		$this->load->database();
		$this->db->where('IndexNo', $this->input->post('index'));
		
		return $this->db->delete('student'); 
	}
	public function updatestudent(){
		$this->load->database();
		$this->db->where('IndexNo', $this->input->post('index'));
		$new_student_data=array(
			'Fname'=>$this->input->post('fname'),
			'Lname'=>$this->input->post('lname'),
			'Tel'=>$this->input->post('tel')
	
		);
       	$update=$this->db->update('student',$new_student_data);
		return $update;
		
	}
}


?>