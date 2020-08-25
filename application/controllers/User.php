<?php
class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function admin()
	{
		$data['_title']		= "Admin";
		$data['user']		= $this->db->order_by('id','desc')->get_where('user',['user_type' => '1','df' => ''])->result_array();
		$this->load->theme('user/admin/index',$data);
	}

	public function new_admin()
	{
		$data['_title']		= "Add Admin";
		$this->load->theme('user/admin/add',$data);	
	}

	public function save_admin()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile','trim|required|regex_match[/^[0-9]{10}$/]|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('email', 'Email','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('gender', 'Gender','trim|required');
		$this->form_validation->set_rules('branch', 'Branch','trim|required');
		$this->form_validation->set_rules('password', 'Password','trim|required|min_length[5]');
		$this->form_validation->set_rules('username', 'Username','trim|required|alpha_dash|min_length[5]|max_length[10]|is_unique[user.username]',array('is_unique' => 'Username Is Already Exists','alpha_dash' => "Only numbers,characters,`-` and `_` allowed in username"));

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Add Admin";
			$this->load->theme('user/admin/add',$data);	
		}
		else
		{ 
			$data = [
				'user_type'		=> '1',
				'branch'		=> $this->input->post('branch'),
				'name'			=> $this->input->post('name'),
				'username'		=> $this->input->post('username'),
				'password'		=> md5($this->input->post('password')),
				'email'			=> $this->input->post('email'),
				'mobile'		=> $this->input->post('mobile'),
				'gender'		=> $this->input->post('gender')
			];

			$this->db->insert('user',$data);

			$this->session->set_flashdata('msg', 'Admin Added');
	        redirect(base_url('user/admin'));
		}
	}

	public function edit_admin($id = false)
	{
		if($id){
			if($this->general_model->get_user($id)){
				$data['_title']	= 'Edit Admin';
				$data['user']	= $this->general_model->get_user($id);
				$this->load->theme('user/admin/edit',$data);
			}else{
				redirect(base_url('user/admin'));
			}
		}else{
			redirect(base_url('user/admin'));
		}
	}

	public function update_admin()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile','trim|required|regex_match[/^[0-9]{10}$/]|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('email', 'Email','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('gender', 'Gender','trim|required');
		$this->form_validation->set_rules('branch', 'Branch','trim|required');
		$this->form_validation->set_rules('password', 'Password','trim|min_length[5]');
		$this->form_validation->set_rules('username', 'Username','trim|required|alpha_dash|min_length[5]|max_length[10]|callback_check_username',array('alpha_dash' => "Only numbers,characters,`-` and `_` allowed in username"));

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']	= 'Edit Admin';
			$data['user']	= $this->general_model->get_user($this->input->post('id'));
			$this->load->theme('user/admin/edit',$data);
		}
		else
		{ 
			$data = [
				'user_type'		=> '1',
				'branch'		=> $this->input->post('branch'),
				'name'			=> $this->input->post('name'),
				'username'		=> $this->input->post('username'),
				'email'			=> $this->input->post('email'),
				'mobile'		=> $this->input->post('mobile'),
				'gender'		=> $this->input->post('gender')
			];

			$this->db->where('id',$this->input->post('id'))->update('user',$data);

			if(!empty($this->input->post('password'))){
				$data = [
					'password'	=> md5($this->input->post('password'))
				];
				$this->db->where('id',$this->input->post('id'))->update('user',$data);				
			}

			$this->session->set_flashdata('msg', 'Admin Updated');
	        redirect(base_url('user/admin'));
		}
	}

	public function delete_admin($id = false)
	{
		if($id){
			if($this->general_model->get_user($id)){
				
				$data = [
					'df'	=> 'deleted'
				];
				$this->db->where('id',$id)->update('user',$data);	

				$this->session->set_flashdata('msg', 'Admin Deleted');
	       	 	redirect(base_url('user/admin'));

			}else{
				redirect(base_url('user/admin'));
			}
		}else{
			redirect(base_url('user/admin'));
		}
	}

	public function back_office()
	{
		$data['_title']		= "Back Office";
		$data['user']		= $this->db->order_by('id','desc')->get_where('user',['user_type' => '2','df' => ''])->result_array();
		$this->load->theme('user/back_office/index',$data);
	}

	public function new_back_office()
	{
		$data['_title']		= "Add Back Office";
		$this->load->theme('user/back_office/add',$data);	
	}

	public function save_back_office()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile','trim|required|regex_match[/^[0-9]{10}$/]|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('email', 'Email','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('gender', 'Gender','trim|required');
		$this->form_validation->set_rules('branch', 'Branch','trim|required');
		$this->form_validation->set_rules('type', 'Type','trim|required');
		$this->form_validation->set_rules('password', 'Password','trim|required|min_length[5]');
		$this->form_validation->set_rules('username', 'Username','trim|required|alpha_dash|min_length[5]|max_length[10]|is_unique[user.username]',array('is_unique' => 'Username Is Already Exists','alpha_dash' => "Only numbers,characters,`-` and `_` allowed in username"));

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Add Back Office";
			$this->load->theme('user/back_office/add',$data);
		}
		else
		{ 
			$data = [
				'user_type'		=> '2',
				'branch'		=> $this->input->post('branch'),
				'name'			=> $this->input->post('name'),
				'username'		=> $this->input->post('username'),
				'password'		=> md5($this->input->post('password')),
				'email'			=> $this->input->post('email'),
				'type'			=> $this->input->post('type'),
				'mobile'		=> $this->input->post('mobile'),
				'gender'		=> $this->input->post('gender')
			];

			$this->db->insert('user',$data);

			$this->session->set_flashdata('msg', 'Back Office Added');
	        redirect(base_url('user/back_office'));
		}
	}

	public function edit_back_office($id = false)
	{
		if($id){
			if($this->general_model->get_user($id)){
				$data['_title']	= 'Edit Back Office';
				$data['user']	= $this->general_model->get_user($id);
				$this->load->theme('user/back_office/edit',$data);
			}else{
				redirect(base_url('user/back_office'));
			}
		}else{
			redirect(base_url('user/back_office'));
		}
	}

	public function update_back_office()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile','trim|required|regex_match[/^[0-9]{10}$/]|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('email', 'Email','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('gender', 'Gender','trim|required');
		$this->form_validation->set_rules('type', 'Type','trim|required');
		$this->form_validation->set_rules('branch', 'Branch','trim|required');
		$this->form_validation->set_rules('password', 'Password','trim|min_length[5]');
		$this->form_validation->set_rules('username', 'Username','trim|required|alpha_dash|min_length[5]|max_length[10]|callback_check_username',array('alpha_dash' => "Only numbers,characters,`-` and `_` allowed in username"));

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']	= 'Edit Back Office';
			$data['user']	= $this->general_model->get_user($this->input->post('id'));
			$this->load->theme('user/back_office/edit',$data);
		}
		else
		{ 
			$data = [
				'user_type'		=> '2',
				'branch'		=> $this->input->post('branch'),
				'name'			=> $this->input->post('name'),
				'username'		=> $this->input->post('username'),
				'type'			=> $this->input->post('type'),
				'email'			=> $this->input->post('email'),
				'mobile'		=> $this->input->post('mobile'),
				'gender'		=> $this->input->post('gender')
			];

			$this->db->where('id',$this->input->post('id'))->update('user',$data);

			if(!empty($this->input->post('password'))){
				$data = [
					'password'	=> md5($this->input->post('password'))
				];
				$this->db->where('id',$this->input->post('id'))->update('user',$data);				
			}

			$this->session->set_flashdata('msg', 'Back Office Updated');
	        redirect(base_url('user/back_office'));
		}
	}

	public function delete_back_office($id = false)
	{
		if($id){
			if($this->general_model->get_user($id)){
				
				$data = [
					'df'	=> 'deleted'
				];
				$this->db->where('id',$id)->update('user',$data);	

				$this->session->set_flashdata('msg', 'Back Office Deleted');
	       	 	redirect(base_url('user/back_office'));

			}else{
				redirect(base_url('user/back_office'));
			}
		}else{
			redirect(base_url('user/back_office'));
		}
	}

	public function sales_person()
	{
		$data['_title']		= "Sales Person";
		$data['user']		= $this->db->order_by('id','desc')->get_where('user',['user_type' => '3','df' => ''])->result_array();
		$this->load->theme('user/sales_person/index',$data);
	}

	public function new_sales_person()
	{
		$data['_title']		= "Add Sales Person";
		$this->load->theme('user/sales_person/add',$data);	
	}

	public function save_sales_person()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile','trim|required|regex_match[/^[0-9]{10}$/]|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('email', 'Email','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('gender', 'Gender','trim|required');
		$this->form_validation->set_rules('branch', 'Branch','trim|required');
		$this->form_validation->set_rules('type', 'Type','trim|required');
		$this->form_validation->set_rules('password', 'Password','trim|required|min_length[5]');
		$this->form_validation->set_rules('username', 'Username','trim|required|alpha_dash|min_length[5]|max_length[10]|is_unique[user.username]',array('is_unique' => 'Username Is Already Exists','alpha_dash' => "Only numbers,characters,`-` and `_` allowed in username"));

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Add Sales Person";
			$this->load->theme('user/sales_person/add',$data);	
		}
		else
		{ 
			$data = [
				'user_type'		=> '3',
				'branch'		=> $this->input->post('branch'),
				'name'			=> $this->input->post('name'),
				'username'		=> $this->input->post('username'),
				'password'		=> md5($this->input->post('password')),
				'email'			=> $this->input->post('email'),
				'type'			=> $this->input->post('type'),
				'mobile'		=> $this->input->post('mobile'),
				'gender'		=> $this->input->post('gender')
			];

			$this->db->insert('user',$data);

			$this->session->set_flashdata('msg', 'Sales Person Added');
	        redirect(base_url('user/sales_person'));
		}
	}

	public function edit_sales_person($id = false)
	{
		if($id){
			if($this->general_model->get_user($id)){
				$data['_title']	= 'Edit Sales Person';
				$data['user']	= $this->general_model->get_user($id);
				$this->load->theme('user/sales_person/edit',$data);
			}else{
				redirect(base_url('user/sales_person'));
			}
		}else{
			redirect(base_url('user/sales_person'));
		}
	}

	public function update_sales_person()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile','trim|required|regex_match[/^[0-9]{10}$/]|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('email', 'Email','trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('gender', 'Gender','trim|required');
		$this->form_validation->set_rules('type', 'Type','trim|required');
		$this->form_validation->set_rules('branch', 'Branch','trim|required');
		$this->form_validation->set_rules('password', 'Password','trim|min_length[5]');
		$this->form_validation->set_rules('username', 'Username','trim|required|alpha_dash|min_length[5]|max_length[10]|callback_check_username',array('alpha_dash' => "Only numbers,characters,`-` and `_` allowed in username"));

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']	= 'Edit Sales Person';
			$data['user']	= $this->general_model->get_user($this->input->post('id'));
			$this->load->theme('user/sales_person/edit',$data);
		}
		else
		{ 
			$data = [
				'user_type'		=> '3',
				'branch'		=> $this->input->post('branch'),
				'name'			=> $this->input->post('name'),
				'username'		=> $this->input->post('username'),
				'email'			=> $this->input->post('email'),
				'type'			=> $this->input->post('type'),
				'mobile'		=> $this->input->post('mobile'),
				'gender'		=> $this->input->post('gender')
			];

			$this->db->where('id',$this->input->post('id'))->update('user',$data);

			if(!empty($this->input->post('password'))){
				$data = [
					'password'	=> md5($this->input->post('password'))
				];
				$this->db->where('id',$this->input->post('id'))->update('user',$data);				
			}

			$this->session->set_flashdata('msg', 'Sales Person Updated');
	        redirect(base_url('user/sales_person'));
		}
	}

	public function delete_sales_person($id = false)
	{
		if($id){
			if($this->general_model->get_user($id)){
				
				$data = [
					'df'	=> 'deleted'
				];
				$this->db->where('id',$id)->update('user',$data);	

				$this->session->set_flashdata('msg', 'Sales Person Deleted');
	       	 	redirect(base_url('user/sales_person'));

			}else{
				redirect(base_url('user/sales_person'));
			}
		}else{
			redirect(base_url('user/sales_person'));
		}
	}


	public function check_username()
	{
		if($this->db->get_where('user',['id !=' => $this->input->post('id'),'username' => $this->input->post('username'),'df' => ''])->result_array()){
			$this->form_validation->set_message('check_username', 'Username Already Exists');
        	return false;
		}else{
			return true;
		}
	}
}
?>