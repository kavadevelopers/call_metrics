<?php
class Job extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}


	public function index()
	{
		$data['_title']		= "Active Jobs";	
		$data['jobs']		= $this->general_model->get_jobs();
		$this->load->theme('job/index',$data);
	}

	public function save()
	{
		$user = $this->general_model->_get_user($this->input->post('owner'));
		if($this->input->post('owner') != 1){
			$branch = $user['branch'];
		}else{
			$branch = '';
		}

		$data = [
			'branch'		=> $branch,
			'service'		=> explode('-',$this->input->post('service'))[0],
			'price'			=> $this->input->post('price'),
			'qty'			=> 1,
			'client'		=> $this->input->post('client'),
			'status'		=> 0,
			'owner'			=> $this->input->post('owner'),
			'importance'	=> 'NORMAL',
			'f_date'		=> null,
			'f_time'		=> null,
			'created_by'	=> get_user()['id'],
			'created_at'		=> date('Y-m-d H:i:s')
		];

		$this->db->insert('job',$data);
		$job_id = $this->db->insert_id();
		$this->db->where('id',$job_id)->update('job',['job_id' => "JOB_".$job_id]);

		$this->session->set_flashdata('msg', 'Job Added');
	    redirect(base_url('job'));
	}

	public function transfer()
	{
		$jobs = explode("-", $this->input->post('jobs'));
		foreach ($jobs as $key => $value) {
			$job = $this->db->get_where('job',['id' => $value])->row_array();

			$data = [
				'pre_owner' => $job['owner'],
				'owner' 	=> $this->input->post('owner')
			];
			$this->db->where('id',$value)->update('job',$data);
		}	

		$this->session->set_flashdata('msg', 'Jobs Transfered');
		if($this->input->post('type') == "1"){
	   		redirect(base_url('job'));
	   	}else if($this->input->post('type') == "2"){
	   		redirect(base_url('job/work_done'));
	   	}else if($this->input->post('type') == "3"){
	   		redirect(base_url('job/paid'));
	   	}else if($this->input->post('type') == "4"){
	   		redirect(base_url('job/billed'));
	   	}
	}

	public function work_done()
	{
		$data['_title']		= "Work Done Jobs";	
		$data['jobs']		= $this->general_model->get_workDone();
		$this->load->theme('job/work_done',$data);
	}

	public function billed()
	{
		$data['_title']		= "Billed Jobs";	
		$data['jobs']		= $this->general_model->get_BilledJob();
		$this->load->theme('job/billed',$data);
	}

	public function paid()
	{
		$data['_title']		= "Paid Jobs";	
		$data['jobs']		= $this->general_model->get_PaidJob();
		$this->load->theme('job/paid',$data);
	}

	public function update()
	{
		$data = [
			'service' 		=> $this->input->post('service'),
			'price' 		=> $this->input->post('price'),
			'importance' 	=> $this->input->post('importance')
		];
		$this->db->where('id',$this->input->post('id'))->update('job',$data);

		$job = $this->db->get_where('job',['id' => $this->input->post('id')])->row_array();
		echo json_encode(['price' => $job['price'],'service' => $this->general_model->_get_service($job['service'])['name'],'importance' => $job['importance']]);
	}
}