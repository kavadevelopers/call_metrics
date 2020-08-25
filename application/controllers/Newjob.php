<?php
class Newjob extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}


	public function index()
	{
		$data['_title']		= "New Work Followup";	
		$data['jobs']		= $this->general_model->get_fjobs();
		$this->load->theme('newjob/index',$data);
	}

	public function save()
	{
		if($this->input->post('from') != ""){
			$from = timeConverter($this->input->post('from'));
		}else{
			$from = null;
		}

		if($this->input->post('to') != ""){
			$to = timeConverter($this->input->post('to'));
		}else{
			$to = null;
		}

		if($this->input->post('date') != ""){
			$date = dd($this->input->post('date'));
		}else{
			$date = null;
		}

		$data = [
			'branch'	=> $this->input->post('branch'),
			'client'	=> $this->input->post('client'),
			'service'	=> explode('-',$this->input->post('service'))[0],
			'price'		=> $this->input->post('price'),
			'owner'		=> get_user()['id'],
			'fdate'		=> $date,
			'from'		=> $from,
			'to'		=> $to,
			'remarks'	=> $this->input->post('remarks'),
			'created_at'	=> date('Y-m-d H:i:s'),
			'created_by'	=> get_user()['id']
		];

		$this->db->insert('newjob',$data);
		$id = $this->db->insert_id();

		if($date != ""){
			$data = [
				'remarks'		=> "New Work Followup",
				'next_f'		=> $date,
				'customer'		=> "",
				'date'			=> date('Y-m-d H:i:s'),
				'ftime'			=> $from,
				'ttime'			=> $to,
				'type'			=> 'newWork',
				'main_id'		=> $id,
				'followup_by'	=> get_user()['id']
			];
			$this->db->insert('followup',$data);
		}

		$this->session->set_flashdata('msg', 'New Work Added');
	    redirect(base_url('newjob'));	
	}

	public function view($id = false)
	{
		if($id){
			if($this->general_model->get_new_work($id)){
				$data['_title']		= "View Work Followup";	
				$data['job']		= $this->general_model->get_new_work($id);
				$this->load->theme('newjob/view',$data);
			}else{
				redirect(base_url('newjob'));			
			}
		}else{
			redirect(base_url('newjob'));			
		}
	}

	public function update()
	{
		$data = [
			'client'	=> $this->input->post('client'),
			'service'	=> explode('-',$this->input->post('service'))[0],
			'price'		=> $this->input->post('price'),
			'remarks'	=> $this->input->post('remarks')
		];

		$this->db->where('id',$this->input->post('main_id'))->update('newjob',$data);
		$this->session->set_flashdata('msg', 'New Work Saved');
	    redirect(base_url('newjob/view/').$this->input->post('main_id'));	
	}

	public function dump($id)
	{
		$this->db->where('id',$id)->update('newjob',['status' => '2']);
		$this->session->set_flashdata('msg', 'New Work Tranfered To Dump');
	    redirect(base_url('newjob'));
	}
}
?>