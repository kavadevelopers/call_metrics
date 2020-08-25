<?php
class Branch extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function index()
	{
		$data['_title']		= "Branch";
		$data['branch']		= $this->db->order_by('id','asc')->get_where('branch',['df'	=> ''])->result_array();
		$this->load->theme('branch/index',$data);	
	}

	public function add()
	{
		$data['_title']		= "Add Branch";
		$this->load->theme('branch/add',$data);	
	}

	public function save()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required');
		$this->form_validation->set_rules('code', 'Branch Code','trim|required|callback_check_code');
		$this->form_validation->set_rules('mobile', 'Mobile','trim|required|regex_match[/^[0-9]{10}$/]|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('email', 'Email','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('address', 'Address','trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']	= 'Add Branch';
			$this->load->theme('branch/add',$data);
		}
		else
		{ 
			$data = [
				'code'		=> $this->input->post('code'),
				'name'		=> $this->input->post('name'),
				'mobile'	=> $this->input->post('mobile'),
				'email'		=> $this->input->post('email'),
				'address'	=> $this->input->post('address')
			];
			$this->db->insert('branch',$data);

			$this->session->set_flashdata('msg', 'Branch Added');
	        redirect(base_url('branch'));
		}
	}

	public function edit($id = false)
	{
		if($id){
			if($this->general_model->get_branch($id)){
				$data['_title']	= 'Edit Branch';
				$data['branch']	= $this->general_model->get_branch($id);
				$this->load->theme('branch/edit',$data);
			}else{
				redirect(base_url('branch'));
			}
		}else{
			redirect(base_url('branch'));
		}
	}

	public function update()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required');
		$this->form_validation->set_rules('code', 'Branch Code','trim|required|callback_check_code_edit');
		$this->form_validation->set_rules('mobile', 'Mobile','trim|required|regex_match[/^[0-9]{10}$/]|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('email', 'Email','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('address', 'Address','trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']	= 'Edit Branch';
			$data['branch']	= $this->general_model->get_branch($this->input->post('id'));
			$this->load->theme('branch/edit',$data);
		}
		else
		{ 
			$data = [
				'code'		=> $this->input->post('code'),
				'name'		=> $this->input->post('name'),
				'mobile'	=> $this->input->post('mobile'),
				'email'		=> $this->input->post('email'),
				'address'	=> $this->input->post('address')
			];
			$this->db->where('id',$this->input->post('id'))->update('branch',$data);
			$this->session->set_flashdata('msg', 'Branch Saved');
	        redirect(base_url('branch'));
		}
	}

	public function delete($id = false)
	{
		if($id){
			if($this->general_model->get_branch($id)){
				$this->db->where('id',$id)->update('branch',['df' => 'deleted']);			
				$this->session->set_flashdata('msg', 'Branch Deleted');
		        redirect(base_url('branch'));
			}else{
				redirect(base_url('branch'));
			}
		}else{
			redirect(base_url('branch'));
		}
	}

	public function check_code()
	{
		if($this->db->get_where('branch',['df' => "",'code' => $this->input->post('code')])->result_array()){
			$this->form_validation->set_message('check_code', 'Branch Code Already Exists');
        	return false;
		}else{
			return true;
		}
	}

	public function check_code_edit()
	{
		if($this->db->get_where('branch',['df' => "",'code' => $this->input->post('code'),'id !=' => $this->input->post('id')])->result_array()){
			$this->form_validation->set_message('check_code_edit', 'Branch Code Already Exists');
        	return false;
		}else{
			return true;
		}
	}
}