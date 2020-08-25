<?php
class Industry extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function index()
	{
		$data['_title']		= "Industry";
		$data['_e']         = 0;
		$data['list']		= $this->db->order_by('id','desc')->get_where('industry',['df' => ''])->result_array();
		$this->load->theme('master/industry/index',$data);		
	}

	public function save()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required|is_unique[industry.name]');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Industry";
			$data['_e']         = 0;
			$data['list']		= $this->db->order_by('id','desc')->get_where('industry',['df' => ''])->result_array();
			$this->load->theme('master/industry/index',$data);	
		}
		else
		{ 
			$data = [
				'name'		=> $this->input->post('name')
			];
			$this->db->insert('industry',$data);

			$this->session->set_flashdata('msg', 'Industry Added');
	        redirect(base_url('industry'));
		}
	}

	public function edit($id = false)
	{
		if($id){
			if($this->general_model->get_industry($id)){
				$data['_title']		= "Edit Industry";
				$data['_e']         = 1;
				$data['ind']		= $this->general_model->get_industry($id);
				$data['list']		= $this->db->order_by('id','desc')->get_where('industry',['df' => ''])->result_array();
				$this->load->theme('master/industry/index',$data);	
			}else{
				redirect(base_url('industry'));
			}
		}else{
			redirect(base_url('industry'));
		}
	}

	public function update()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required|callback_unique_name');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Edit Industry";
			$data['_e']         = 1;
			$data['ind']		= $this->general_model->get_industry($this->input->post('id'));
			$data['list']		= $this->db->order_by('id','desc')->get_where('industry',['df' => ''])->result_array();
			$this->load->theme('master/industry/index',$data);	
		}
		else
		{ 
			$data = [
				'name'		=> $this->input->post('name')
			];
			$this->db->where('id',$this->input->post('id'))->update('industry',$data);

			$this->session->set_flashdata('msg', 'Industry Updated');
	        redirect(base_url('industry'));
		}
	}

	public function delete($id = false)
	{
		if($id){
			if($this->general_model->get_industry($id)){
				$data = [
					'df'		=> 'deleted'
				];
				$this->db->where('id',$id)->update('industry',$data);
				$this->session->set_flashdata('msg', 'Industry Deleted');
	        	redirect(base_url('industry'));
			}else{
				redirect(base_url('industry'));
			}
		}else{
			redirect(base_url('industry'));
		}
	}


	public function unique_name()
	{
		if($this->db->get_where('industry',['id !=' => $this->input->post('id'),'name' => $this->input->post('name'),'df' => ''])->result_array()){
			$this->form_validation->set_message('unique_name', 'Name Already Exists');
        	return false;
		}else{
			return true;
		}
	}
}
?>