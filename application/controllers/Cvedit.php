<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cvedit extends CV_Controller {
	var $fields;
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->fields = $this->user_model->getField();
	}

	public function index()
	{
		//$this->user_model->inputData();
		$data = array('content'=>'select_tpl');
		$this->load->view('home_template', $data);
	}
	public function cvlogin($tpl=null)
	{
		if($tpl != null)
			$this->session->set_userdata('tpl_id', $tpl);
		if($this->session->userdata('user_id')){
			redirect('cvedit/overview');
			return;
		}
		$data = array('content'=>'login_form');
		if($this->input->post('email')){
			$input = array('email' => $this->input->post('email'),
							'password' => $this->input->post('password')
						);
			$userinfo = $this->user_model->authUser($input);
			if($userinfo){
				$tpl = $this->session->userdata('tpl_id');
				$listID = $this->user_model->setCv($userinfo['id'],$tpl);

				$this->session->set_userdata('email', $userinfo['email']);
				$this->session->set_userdata('user_id', $userinfo['id']);
				$this->session->set_userdata('fullname', $userinfo['firstname']." ".$userinfo['lastname']);
				$this->session->set_userdata('list_id', $listID);
				redirect('cvedit/overview');
				return;
			}
			$data['error'] = "Incorrect username or password provided.";
		}
		$this->load->view('home_template', $data);
	}
	public function cvlogout()
	{
		$this->session->sess_destroy();
		redirect('welcome','refresh');
	}
	public function cvheader($tpl=null)
	{
		if($tpl != null)
			$this->session->set_userdata('tpl_id', $tpl);
			
		if($this->input->post('fname')){
			$input = array('firstname' => $this->input->post('fname'),
							'lastname' => $this->input->post('lname'),
							'email' => $this->input->post('email'),
							'street' => $this->input->post('street'),
							'city' => $this->input->post('city'),
							'country' => $this->input->post('country'),
							'postcode' => $this->input->post('postcode'),
							'phone' => $this->input->post('phone'),
							'password' => sha1($this->input->post('password')),
						);
			$userinfo = $this->user_model->setUser($input);

			$tpl = $this->session->userdata('tpl_id');
			$listID = $this->user_model->setCv($userinfo['id'],$tpl);

			$this->session->set_userdata('email', $userinfo['email']);
			$this->session->set_userdata('user_id', $userinfo['id']);
			$this->session->set_userdata('list_id', $listID);
			$this->session->set_userdata('fullname', $userinfo['firstname']." ".$userinfo['lastname']);
			redirect('cvedit/index');
			return;
		}
		$data = array('content'=>'header_form');
		$this->load->view('home_template', $data);
	}
	public function getSubCareer($career)
	{
		$html = "";
		$subcareer = $this->user_model->getSubCareer($career);
		foreach ($subcareer as $value) {
			$html .= "<option value='".$value['id']."'>".$value['sub_name']."</option>";
		}
		echo $html;
		exit;
	}
	public function career($tpl=null)
	{
		$exp_lv = $this->user_model->getExtLvl();
		$career = $this->user_model->getCareer();
		$subcareer = $this->user_model->getSubCareer();
		$data = array('content'=>'select_career',
						'exp_lv' => $exp_lv,
						'career' => $career,
						'subcareer' => $subcareer);
		$this->load->view('home_template', $data);
	}
	public function work_his()
	{
		$data = array('content'=>'work_history_form');
		if($this->input->post('postype') && $this->input->post('postype')!=''){
			$inputData = array('job_title'=> $this->input->post('job_title'),
							'employer'	=> $this->input->post('employer'),
							'city'		=> $this->input->post('city'),
							'country'	=> $this->input->post('country'),
							's_date'	=> $this->input->post('s_year')."-".$this->input->post('s_month'),
							'e_date'	=> $this->input->post('e_year')."-".$this->input->post('e_month'),
							'desc'		=> $this->input->post('work_detail'),
							'user_id'	=> $this->session->userdata('user_id'),
							'list_id'	=> $this->session->userdata('list_id'),
						);

			$job_id = $this->input->post('job_id')?$this->input->post('job_id'):null;
			$this->user_model->setWorkHis($inputData, $job_id);
			if($this->input->post('postype')!='more'){
				redirect('cvedit/education');
				return;
			}
		}
		$this->load->view('home_template', $data);
	}

	public function education()
	{
		$data = array('content'=>'education_form');
		if($this->input->post('postype') && $this->input->post('postype')!=''){
			$inputData = array('inst_name'=> $this->input->post('inst_name'),
							'inst_loc'	=> $this->input->post('inst_loc'),
							'degree'	=> $this->input->post('degree'),
							'study_field'=> $this->input->post('study_field'),
							'graduated_year'=> $this->input->post('graduated_year'),
							'desc'		=> $this->input->post('edu_detail'),
							'user_id'	=> $this->session->userdata('user_id'),
							'list_id'	=> $this->session->userdata('list_id'),
						);

			$edu_id = $this->input->post('edu_id')?$this->input->post('edu_id'):null;
			$this->user_model->setEduHis($inputData, $edu_id);
			if($this->input->post('postype')!='more'){
				redirect('cvedit/skills');
				return;
			}
		}
		$this->load->view('home_template', $data);
	}
	public function skills()
	{
		$data = array('content'=>'skills_form');
		if($this->input->post('skill_detail') && $this->input->post('skill_detail')!=''){
			$inputData = array('skill_content'=> $this->input->post('skill_detail'));
			$this->user_model->updateCv($inputData);
			redirect('cvedit/summary');
			return;
		}
		$this->load->view('home_template', $data);
	}

	public function summary()
	{
		$data = array('content'=>'summary_form');
		if($this->input->post('summary_detail') && $this->input->post('summary_detail')!=''){
			$inputData = array('summary_content'=> $this->input->post('summary_detail'));
			$this->user_model->updateCv($inputData);
			redirect('cvedit/weblink');
			return;
		}
		$this->load->view('home_template', $data);
	}
	public function weblink()
	{
		$data = array('content'=>'weblink_form');
		if($this->input->post('link1') && $this->input->post('link1')!=''){
			$inputData = array('link1'=> $this->input->post('link1'),
								'link2'=> $this->input->post('link2'),
								'link3'=> $this->input->post('link3'));
			$this->user_model->updateUser($inputData);
			redirect('cvedit/others');
			return;
		}
		$this->load->view('home_template', $data);
	}
	public function others()
	{
		$data = array('content'=>'others_form');
		if($this->input->post('others')=='others'){
			$inputData = array('acc_content'=> $this->input->post('acc_detail'),
								'aff_content'=> $this->input->post('aff_detail'),
								'cert_content'=> $this->input->post('cert_detail'),
								'other_content'=> $this->input->post('other_detail'),
								'other_name'=> $this->input->post('other_name'),
							);
			$this->user_model->updateCv($inputData);
			redirect('cvedit/overview');
			return;
		}
		$this->load->view('home_template', $data);
	}
	public function overview($tpl=15)
	{
		$tpl = $this->session->userdata('tpl_id');
		if(! $tpl || $tpl =='') $tpl = 4;
		$cvdata = $this->user_model->getCvData();
		$userdata = $this->user_model->getUserData();
		$edudata = $this->user_model->getEduData();
		$workdata = $this->user_model->getWorkData();
		$data = array('content'=>'templates/template'.$tpl.'/paper',
					'userdata' => $userdata,
					'cvdata' => $cvdata,
					'edudata' => $edudata,
					'workdata' => $workdata,
					'btnflag' => 1
				);
		$data['lsidebar'] = 'sidebar';
		if($this->input->post('htmlcontent')!=''){
			$this->exportPDF($this->input->post('htmlcontent'));
			return;
		}
		$this->load->view('home_template', $data);
	}

	public function exportPDF($html)
	{
		$tpl = $this->session->userdata('tpl_id');
		$this->load->library('M_pdf');
		$this->m_pdf->pdf->SetDisplayMode('fullpage');
		$this->m_pdf->pdf->layerDetails[z]['state'] = 'hidden';
		$stylesheet = file_get_contents(FCPATH.'assets/css/template/paper'.$tpl.'.css'); // 
		$this->m_pdf->pdf->WriteHTML($stylesheet,1);
		$this->m_pdf->pdf->WriteHTML($html,2);
		$this->m_pdf->pdf->Output("cv.pdf","D");
	}
}