<?php
class viewstudents extends CI_Model{
	public function getdetails(){
		$this->load->database();
        $query = $this ->db->query("SELECT * FROM student;");
        return $query->result_array();
        
	}
}


?>