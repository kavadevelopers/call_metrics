<?php
class Subindustry extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function index()
	{
		$data['_title']		= "Sub Industry";
		$data['_e']         = 0;
		$data['list']		= $this->db->order_by('id','desc')->get_where('sub_industry',['df' => ''])->result_array();
		$this->load->theme('master/industry/sub-index',$data);		
	}

	public function save()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required');
		$this->form_validation->set_rules('industry', 'Industry','trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Sub Industry";
			$data['_e']         = 0;
			$data['list']		= $this->db->order_by('id','desc')->get_where('sub_industry',['df' => ''])->result_array();
			$this->load->theme('master/industry/sub-index',$data);	
		}
		else
		{ 
			$data = [
				'name'		=> $this->input->post('name'),
				'industry'		=> $this->input->post('industry')
			];
			$this->db->insert('sub_industry',$data);

			$this->session->set_flashdata('msg', 'Sub Industry Added');
	        redirect(base_url('subindustry'));
		}
	}

	public function edit($id = false)
	{
		if($id){
			if($this->general_model->get_subindustry($id)){
				$data['_title']		= "Edit Sub Industry";
				$data['_e']         = 1;
				$data['ind']		= $this->general_model->get_subindustry($id);
				$data['list']		= $this->db->order_by('id','desc')->get_where('sub_industry',['df' => ''])->result_array();
				$this->load->theme('master/industry/sub-index',$data);	
			}else{
				redirect(base_url('subindustry'));
			}
		}else{
			redirect(base_url('subindustry'));
		}
	}

	public function update()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required');
		$this->form_validation->set_rules('industry', 'Industry','trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Edit Sub Industry";
			$data['_e']         = 1;
			$data['ind']		= $this->general_model->get_subindustry($this->input->post('id'));
			$data['list']		= $this->db->order_by('id','desc')->get_where('sub_industry',['df' => ''])->result_array();
			$this->load->theme('master/industry/sub-index',$data);	
		}
		else
		{ 
			$data = [
				'name'		=> $this->input->post('name'),
				'industry'		=> $this->input->post('industry')
			];
			$this->db->where('id',$this->input->post('id'))->update('sub_industry',$data);

			$this->session->set_flashdata('msg', 'Sub Industry Updated');
	        redirect(base_url('subindustry'));
		}
	}

	public function delete($id = false)
	{
		if($id){
			if($this->general_model->get_subindustry($id)){
				$data = [
					'df'		=> 'deleted'
				];
				$this->db->where('id',$id)->update('sub_industry',$data);
				$this->session->set_flashdata('msg', 'Sub Industry Deleted');
	        	redirect(base_url('subindustry'));
			}else{
				redirect(base_url('subindustry'));
			}
		}else{
			redirect(base_url('subindustry'));
		}
	}


	// public function unique_name()
	// {
	// 	if($this->db->get_where('sub_industry',['id !=' => $this->input->post('id'),'name' => $this->input->post('name'),'df' => ''])->result_array()){
	// 		$this->form_validation->set_message('unique_name', 'Name Already Exists');
 //        	return false;
	// 	}else{
	// 		return true;
	// 	}
	// }
}
?>