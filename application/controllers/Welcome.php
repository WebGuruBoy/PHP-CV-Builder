<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CV_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		if(! $this->session->userdata("searchField"))
			$this->session->set_userdata("searchField", "Accountants");
	}
	public function index()
	{
		/*$this->load->model('user_model');
		$myfile = fopen("/var/www/html/skill.txt", "r") or die("Unable to open file!");
		$i = 1;
		while(!feof($myfile)) {
		  $data = trim(fgets($myfile));
		  if($data=="") continue;
		  if(strpos($data, "----")>-1){
		  	$i++;
		  	continue;
		  }
		  $this->user_model->addDb($i, $data);
		}
		fclose($myfile);
		echo "success";*/
		$data = array('firstpage'=>'first_page');
		$this->load->view('home_template',$data);
	}
	public function getSampleContent($type)
	{
		$search = $this->input->post("search");
		if($search){
			$this->session->set_userdata("searchField", $search);
		} else {
			$search = $this->session->userdata("searchField");
		}
		$this->load->model('user_model');
		$data = $this->user_model->getContent($type, $search);
		$html = '';
		foreach($data as $each){
			$html.="<div class='cv-item' onclick='addSampleContent(this)'>".$each['content']."</div>";
		}
		echo $html;
		exit;
	}
	public function modifyContent()
	{
		$this->load->model('user_model');
		$type = $this->input->post("type");
		$data['user_id'] = $this->session->userdata('user_id');
		//$data['tpl_id'] = $this->session->userdata('tpl_id');
		switch ($type) {
			case 'work':
				$data['desc'] = $this->input->post('html');
				$data['job_title'] = $this->input->post('jobtitle');
				$data['employer'] = $this->input->post('employer');
				$data['city'] = $this->input->post('workcity');
				$data['country'] = $this->input->post('workcountry');
				$data['s_date'] = $this->input->post('s_date');
				$data['e_date'] = $this->input->post('e_date');
				$data['flag'] = $this->input->post('flag');
				$data['id'] = $this->input->post('cvid');
				break;
			case 'edu':
				$data['desc'] = $this->input->post('html');
				$data['inst_name'] = $this->input->post('schoolname');
				$data['inst_loc'] = $this->input->post('schoolcity');
				$data['degree'] = $this->input->post('degree');
				$data['study_field'] = $this->input->post('study_field');
				$data['graduated_year'] = $this->input->post('grad_year');
				$data['flag'] = $this->input->post('flag');
				$data['id'] = $this->input->post('cvid');
				break;
			case 'summary':
				$data['summary_content'] = $this->input->post('html');
				break;
			case 'skill':
				$data['skill_content'] = $this->input->post('html');
				break;
			case 'acc':
				$data['acc_content'] = $this->input->post('html');
				break;
			case 'aff':
				$data['aff_content'] = $this->input->post('html');
				break;
			case 'cert':
				$data['cert_content'] = $this->input->post('html');
				break;
			case 'add':
				$data['add_content'] = $this->input->post('html');
				break;
			case 'other':
				$data['other_content'] = $this->input->post('html');
				$data['other_name'] = $this->input->post('title');
				break;
		}
		$return = $this->user_model->modifyCVContent($type, $data);
		echo $return;
		exit;
	}
	public function trashContent()
	{
		$this->load->model('user_model');
		$type = $this->input->post("type");
		$data['user_id'] = $this->session->userdata('user_id');
		switch ($type) {
			case 'work':
				$data['id'] = $this->input->post('cvid');
				break;
			case 'edu':
				$data['id'] = $this->input->post('cvid');
				break;
		}
		$return = $this->user_model->trashCVContent($type, $data);
		echo $return;
		exit;
	}
}
