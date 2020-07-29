<?php
class User_model extends CI_Model{
	function __construct()
	{
		parent::__construct();
	}

	function inputData()
	{
		/*$this->db->truncate('subcareer');
		$myfile = fopen("/var/www/html/career.html", "r") or die("Unable to open file!");
		$i = 1;
		while(!feof($myfile)) {
		  $line = fgets($myfile);
		  if(strlen($line) < 3){
		  	$i++;
		  } else {
		  	$this->db->insert('subcareer', array('parent_id'=>$i, 'sub_name'=>trim($line, "\r \n")));
		  }
		}
		fclose($myfile);*/
	}
	function getExtLvl()
	{
		$this->db->select('*');
		$this->db->from('exp_level');
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return false;
	}
	function getCareer()
	{
		$this->db->select('*');
		$this->db->from('career');
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return false;
	}
	function getSubCareer($career=null)
	{
		$this->db->select('*');
		if($career != null)
			$this->db->where('parent_id', $career);
		$this->db->from('subcareer');
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->result_array();
		else
			return false;
	}
	function setUser($user)
	{
		$this->db->from('user');
		$this->db->where('email', $user['email']);
		$query = $this->db->get();
		if($query->num_rows()>0){
			$res = $query->row_array();
			$this->db->update('user', $user, array('id'=>$res['id']));
			return $res;
		} else{
			$this->db->insert('user', $user);
			//-----------------
			$this->db->from('user');
			$this->db->where('email', $user['email']);
			$query = $this->db->get();
			$res = $query->row_array();
			return $res;
		}
	}
	function authUser($user)
	{
		$this->db->from('user');
		$this->db->where('email', $user['email']);
		$this->db->where('password', sha1($user['password']));
		$query = $this->db->get();
		if($query->num_rows()>0){
			$res = $query->row_array();
			return $res;
		}
		return false;
	}
	function getUserData()
	{
		$this->db->from('user');
		$this->db->where('id', $this->session->userdata('user_id'));
		$query = $this->db->get();
		if($query->num_rows()>0){
			$res = $query->row_array();
			return $res;
		} else{
			return false;
		}
	}
	function updateUser($data)
	{
		$this->db->update('user', $data, array('id'=>$this->session->userdata('user_id')));
	}

	function setWorkHis($inputData, $job_id)
	{
		if($job_id!=null)
			$this->db->update('workhistory', $inputData, array('id' => $job_id));
		else
			$this->db->insert('workhistory', $inputData);
	}
	function setEduHis($inputData, $edu_id){
		if($edu_id!=null)
			$this->db->update('education', $inputData, array('id' => $edu_id));
		else
			$this->db->insert('education', $inputData);
	}
	function setCv($user,$tpl)
	{
		$this->db->from('list');
		$this->db->where('user_id', $user);
		$this->db->where('tpl_id', $tpl);

		$query = $this->db->get();
		if($query->num_rows()>0){
			$res = $query->row_array();
			return $res['id'];
		} else{
			$this->db->insert('list', array('user_id' => $user, 'tpl_id' => $tpl));
			//-----------------
			$this->db->from('list');
			$this->db->where('user_id', $user);
			$this->db->where('tpl_id', $tpl);
			$query = $this->db->get();
			$res = $query->row_array();
			return $res['id'];
		}
	}
	function updateCv($data)
	{
		$this->db->update('list', $data, array('id'=>$this->session->userdata('list_id')));
	}
	function getCvData()
	{
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$this->db->from('list');
		$query = $this->db->get();
		if($query->num_rows()>0){
			$res = $query->row_array();
			return $res;
		} else {
			return false;
		}
	}
	function getEduData()
	{
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$this->db->from('education');
		$query = $this->db->get();
		if($query->num_rows()>0){
			$res = $query->result_array();
			return $res;
		} else {
			return false;
		}
	}
	function getWorkData()
	{
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$this->db->from('workhistory');
		$query = $this->db->get();
		if($query->num_rows()>0){
			$res = $query->result_array();
			return $res;
		} else {
			return false;
		}
	}
	function addDb($data){
		$this->db->insert('workfield', array('field_name'=>$data));
	}
	function addWorkField($id, $data){
		$this->db->insert('worksubfield', array('parent_id'=>$id, 'content'=>$data));
	}
	function addsummary($id, $data){
		$this->db->insert('summary', array('parent_id'=>$id, 'content'=>$data));
	}
	function addeducation($id, $data){
		$this->db->insert('educationEx', array('parent_id'=>$id, 'content'=>$data));
	}
	function addskillsEx($id, $data){
		$this->db->insert('skills', array('parent_id'=>$id, 'content'=>$data));
	}
	function getContent($type, $search){
		$this->db->select("t1.content");
		switch ($type) {
			case 'edu':
				$this->db->from("educationEx AS t1");
				break;
			case 'work':
				$this->db->from("worksubfield AS t1");
				break;
			case 'skill':
				$this->db->from("skills AS t1");
				break;
			case 'summary':
				$this->db->from("summary AS t1");
				break;
			default:
				# code...
				break;
		}
		$this->db->join('workfield AS t2', 't1.parent_id=t2.id','left');
		$this->db->where("t2.field_name", $search);
		$query = $this->db->get();
		return $query->result_array();
	}
	function getField(){
		$this->db->select("field_name");
		$this->db->from("workfield");
		$query = $this->db->get();
		$res = $query->result_array();
		$result = array();
		foreach($res as $each){
			$result[] = $each['field_name'];
		}
		return $result;
	}
	function modifyCVContent($type, $data){
		switch ($type) {
			case 'work':
				if($data['flag']=='update'){
					$id = $data['id'];
					unset($data['flag']);
					unset($data['id']);
					$this->db->update('workhistory', $data, array('id' =>$id));
				} else {
					unset($data['flag']);
					unset($data['id']);
					$this->db->insert('workhistory', $data);
					$sql = 'SELECT LAST_INSERT_ID();';
					$query = $this->db->query($sql);
					$result = $query->row_array();
					foreach ($result as $value) {
						$id = $value;
					}
					return $id;
				}
				break;
			case 'edu':
				if($data['flag']=='update'){
					$id = $data['id'];
					unset($data['flag']);
					unset($data['id']);
					$this->db->update('education', $data, array('id' =>$id));
				} else {
					unset($data['flag']);
					unset($data['id']);
					$this->db->insert('education', $data);
					$sql = 'SELECT LAST_INSERT_ID();';
					$query = $this->db->query($sql);
					$result = $query->row_array();
					foreach ($result as $value) {
						$id = $value;
					}
					return $id;
				}
				break;
			case 'summary':
			case 'skill':
			case 'acc':
			case 'aff':
			case 'cert':
			case 'add':
			case 'other':
				$data['tpl_id'] = $this->session->userdata('tpl_id');
				$this->db->select("*");
				$this->db->from("list");
				$this->db->where("user_id", $data['user_id']);
				$query = $this->db->get();
				if($query->num_rows()>0){
					$this->db->update('list', $data, array('user_id'=>$data['user_id']));
				} else {
					$this->db->insert('list', $data);
				}
				break;
		}
		return true;
	}
	function trashCVContent($type, $data){
		switch ($type) {
			case 'work':
				$this->db->where("id", $data['id']);
				$this->db->delete('workhistory');
				break;
			case 'edu':
				$this->db->where("id", $data['id']);
				$this->db->delete('education');
				break;
			case 'summary':
				$this->db->update("list", array("summary_content"=>""), array("user_id" => $data['user_id']));
				break;
			case 'skill':
				$this->db->update("list", array("skill_content"=>""), array("user_id" => $data['user_id']));
				break;
			case 'acc':
				$this->db->update("list", array("acc_content"=>""), array("user_id" => $data['user_id']));
				break;
			case 'aff':
				$this->db->update("list", array("aff_content"=>""), array("user_id" => $data['user_id']));
				break;
			case 'cert':
				$this->db->update("list", array("cert_content"=>""), array("user_id" => $data['user_id']));
				break;
			case 'add':
				$this->db->update("list", array("add_content"=>""), array("user_id" => $data['user_id']));
				break;
			case 'other':
				$this->db->update("list", array("other_content"=>"", "other_name"=>""), array("user_id" => $data['user_id']));
				break;
		}
		return true;
	}
}