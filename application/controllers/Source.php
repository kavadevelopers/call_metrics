<?php
class Source extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function index()
	{
		$data['_title']		= "Source";
		$data['_e']         = 0;
		$data['list']		= $this->db->order_by('id','desc')->get_where('source',['df' => ''])->result_array();
		$this->load->theme('master/source/index',$data);		
	}

	public function save()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required|callback_unique_name');
		$this->form_validation->set_rules('company', 'Company','trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Source";
			$data['_e']         = 0;
			$data['list']		= $this->db->order_by('id','desc')->get_where('source',['df' => ''])->result_array();
			$this->load->theme('master/source/index',$data);
		}
		else
		{ 
			$data = [
				'name'		=> $this->input->post('name'),
				'company'		=> $this->input->post('company')
			];
			$this->db->insert('source',$data);

			$this->session->set_flashdata('msg', 'Source Added');
	        redirect(base_url('source'));
		}
	}

	public function edit($id = false)
	{
		if($id){
			if($this->general_model->get_source($id)){
				$data['_title']		= "Edit Source";
				$data['_e']         = 1;
				$data['ind']		= $this->general_model->get_source($id);
				$data['list']		= $this->db->order_by('id','desc')->get_where('source',['df' => ''])->result_array();
				$this->load->theme('master/source/index',$data);
			}else{
				redirect(base_url('source'));
			}
		}else{
			redirect(base_url('source'));
		}
	}

	public function update()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required|callback_unique_namee');
		$this->form_validation->set_rules('company', 'Company','trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Edit Source";
			$data['_e']         = 1;
			$data['ind']		= $this->general_model->get_source($this->input->post('id'));
			$data['list']		= $this->db->order_by('id','desc')->get_where('source',['df' => ''])->result_array();
			$this->load->theme('master/source/index',$data);
		}
		else
		{ 
			$data = [
				'name'		=> $this->input->post('name'),
				'company'		=> $this->input->post('company')
			];
			$this->db->where('id',$this->input->post('id'))->update('source',$data);

			$this->session->set_flashdata('msg', 'Source Saved');
	        redirect(base_url('source'));
		}
	}

	public function delete($id = false)
	{
		if($id){
			if($this->general_model->get_source($id)){
				$data = [
					'df'		=> 'deleted'
				];
				$this->db->where('id',$id)->update('source',$data);
				$this->session->set_flashdata('msg', 'Source Deleted');
	        	redirect(base_url('source'));
			}else{
				redirect(base_url('source'));
			}
		}else{
			redirect(base_url('source'));
		}
	}

	public function unique_name()
	{
		if($this->db->get_where('source',['name' => $this->input->post('name'),'df' => ''])->result_array()){
			$this->form_validation->set_message('unique_name', 'Source Already Exists');
        	return false;
		}else{
			return true;
		}
	}

	public function unique_namee()
	{
		if($this->db->get_where('source',['id !=' => $this->input->post('id'),'name' => $this->input->post('name'),'df' => ''])->result_array()){
			$this->form_validation->set_message('unique_namee', 'Source Already Exists');
        	return false;
		}else{
			return true;
		}
	}
}