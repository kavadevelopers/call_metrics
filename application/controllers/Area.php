<?php
class Area extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function state()
	{
		$data['_title']		= "State";
		$data['_e']         = 0;
		$data['list']		= $this->db->order_by('id','desc')->get_where('area_state',['df' => ''])->result_array();
		$this->load->theme('master/area/state_index',$data);		
	}

	public function save_state()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required|callback_unique_name');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "State";
			$data['_e']         = 0;
			$data['list']		= $this->db->order_by('id','desc')->get_where('area_state',['df' => ''])->result_array();
			$this->load->theme('master/area/state_index',$data);	
		}
		else
		{ 
			$data = [
				'name'		=> $this->input->post('name')
			];
			$this->db->insert('area_state',$data);
			$this->session->set_flashdata('msg', 'State Added');
	        redirect(base_url('area/state'));
		}
	}

	public function edit_state($id = false)
	{
		if($id){
			if($this->general_model->get_state($id)){
				$data['_title']		= "Edit State";
				$data['_e']         = 1;
				$data['ind']		= $this->general_model->get_state($id);
				$data['list']		= $this->db->order_by('id','desc')->get_where('area_state',['df' => ''])->result_array();
				$this->load->theme('master/area/state_index',$data);	
			}else{
				redirect(base_url('area/state'));
			}
		}else{
			redirect(base_url('area/state'));
		}
	}

	public function update_state()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required|callback_e_unique_name');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Edit State";
			$data['_e']         = 1;
			$data['ind']		= $this->general_model->get_state($this->input->post('id'));
			$data['list']		= $this->db->order_by('id','desc')->get_where('area_state',['df' => ''])->result_array();
			$this->load->theme('master/area/state_index',$data);	
		}
		else
		{ 
			$data = [
				'name'		=> $this->input->post('name')
			];
			$this->db->where('id',$this->input->post('id'))->update('area_state',$data);

			$this->session->set_flashdata('msg', 'State Updated');
	        redirect(base_url('area/state'));
		}
	}

	public function delete_state($id = false)
	{
		if($id){
			if($this->general_model->get_state($id)){
				$data = [
					'df'		=> 'deleted'
				];
				$this->db->where('id',$id)->update('area_state',$data);
				$this->session->set_flashdata('msg', 'State Deleted');
	        	redirect(base_url('area/state'));
			}else{
				redirect(base_url('area/state'));
			}
		}else{
			redirect(base_url('area/state'));
		}
	}

	public function district()
	{
		$data['_title']		= "District";
		$data['_e']         = 0;
		$data['list']		= $this->db->order_by('id','desc')->get_where('district',['df' => ''])->result_array();
		$this->load->theme('master/area/district_index',$data);		
	}

	public function save_district()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required|callback_unique_district');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "State";
			$data['_e']         = 0;
			$data['list']		= $this->db->order_by('id','desc')->get_where('district',['df' => ''])->result_array();
			$this->load->theme('master/area/district_index',$data);	
		}
		else
		{ 
			$data = [
				'name'		=> $this->input->post('name')
			];
			$this->db->insert('district',$data);
			$this->session->set_flashdata('msg', 'District Added');
	        redirect(base_url('area/district'));
		}
	}

	public function edit_district($id = false)
	{
		if($id){
			if($this->general_model->get_district($id)){
				$data['_title']		= "Edit District";
				$data['_e']         = 1;
				$data['ind']		= $this->general_model->get_district($id);
				$data['list']		= $this->db->order_by('id','desc')->get_where('district',['df' => ''])->result_array();
				$this->load->theme('master/area/district_index',$data);	
			}else{
				redirect(base_url('area/district'));
			}
		}else{
			redirect(base_url('area/district'));
		}
	}

	public function update_district()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required|callback_e_unique_district');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Edit District";
			$data['_e']         = 1;
			$data['ind']		= $this->general_model->get_district($this->input->post('id'));
			$data['list']		= $this->db->order_by('id','desc')->get_where('district',['df' => ''])->result_array();
			$this->load->theme('master/area/district_index',$data);	
		}
		else
		{ 
			$data = [
				'name'		=> $this->input->post('name')
			];
			$this->db->where('id',$this->input->post('id'))->update('district',$data);

			$this->session->set_flashdata('msg', 'District Updated');
	        redirect(base_url('area/district'));
		}
	}

	public function delete_district($id = false)
	{
		if($id){
			if($this->general_model->get_district($id)){
				$data = [
					'df'		=> 'deleted'
				];
				$this->db->where('id',$id)->update('district',$data);
				$this->session->set_flashdata('msg', 'District Deleted');
	        	redirect(base_url('area/district'));
			}else{
				redirect(base_url('area/district'));
			}
		}else{
			redirect(base_url('area/district'));
		}
	}

	public function city()
	{
		$data['_title']		= "City";
		$data['_e']         = 0;
		$data['list']		= $this->db->order_by('id','desc')->get_where('area_city',['df' => ''])->result_array();
		$this->load->theme('master/area/city_index',$data);		
	}

	public function save_city()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required|callback_unique_city');
		$this->form_validation->set_rules('state', 'State','trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "City";
			$data['_e']         = 0;
			$data['list']		= $this->db->order_by('id','desc')->get_where('area_city',['df' => ''])->result_array();
			$this->load->theme('master/area/city_index',$data);	
		}
		else
		{ 
			$data = [
				'name'		=> $this->input->post('name'),
				'state'		=> $this->input->post('state')
			];
			$this->db->insert('area_city',$data);
			$this->session->set_flashdata('msg', 'City Added');
	        redirect(base_url('area/city'));
		}
	}


	public function edit_city($id = false)
	{
		if($id){
			if($this->general_model->get_city($id)){
				$data['_title']		= "Edit City";
				$data['_e']         = 1;
				$data['ind']		= $this->general_model->get_city($id);
				$data['list']		= $this->db->order_by('id','desc')->get_where('area_city',['df' => ''])->result_array();
				$this->load->theme('master/area/city_index',$data);	
			}else{
				redirect(base_url('area/city'));
			}
		}else{
			redirect(base_url('area/city'));
		}
	}

	public function update_city()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required|callback_e_unique_city');
		$this->form_validation->set_rules('state', 'State','trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Edit City";
			$data['_e']         = 1;
			$data['ind']		= $this->general_model->get_city($this->input->post('id'));
			$data['list']		= $this->db->order_by('id','desc')->get_where('area_city',['df' => ''])->result_array();
			$this->load->theme('master/area/city_index',$data);		
		}
		else
		{ 
			$data = [
				'name'		=> $this->input->post('name'),
				'state'		=> $this->input->post('state')
			];
			$this->db->where('id',$this->input->post('id'))->update('area_city',$data);

			$this->session->set_flashdata('msg', 'City Updated');
	        redirect(base_url('area/city'));
		}
	}

	public function delete_city($id = false)
	{
		if($id){
			if($this->general_model->get_city($id)){
				$data = [
					'df'		=> 'deleted'
				];
				$this->db->where('id',$id)->update('area_city',$data);
				$this->session->set_flashdata('msg', 'City Deleted');
	        	redirect(base_url('area/city'));
			}else{
				redirect(base_url('area/city'));
			}
		}else{
			redirect(base_url('area/city'));
		}
	}

	public function areas()
	{
		$data['_title']		= "Area";
		$data['_e']         = 0;
		$data['list']		= $this->db->order_by('id','desc')->get_where('areas',['df' => ''])->result_array();
		$this->load->theme('master/area/area_index',$data);		
	}

	public function save_area()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required|callback_unique_area');
		$this->form_validation->set_rules('city', 'City','trim|required');
		$this->form_validation->set_rules('pincode', 'Pincode','trim|required|numeric|max_length[6]|min_length[6]');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Area";
			$data['_e']         = 0;
			$data['list']		= $this->db->order_by('id','desc')->get_where('areas',['df' => ''])->result_array();
			$this->load->theme('master/area/area_index',$data);	
		}
		else
		{ 
			$data = [
				'name'		=> $this->input->post('name'),
				'city'		=> $this->input->post('city'),
				'pincode'	=> $this->input->post('pincode')
			];
			$this->db->insert('areas',$data);
			$this->session->set_flashdata('msg', 'Area Added');
	        redirect(base_url('area/areas'));
		}
	}

	public function edit_area($id = false)
	{
		if($id){
			if($this->general_model->get_area($id)){
				$data['_title']		= "Edit Area";
				$data['_e']         = 1;
				$data['ind']		= $this->general_model->get_area($id);
				$data['list']		= $this->db->order_by('id','desc')->get_where('areas',['df' => ''])->result_array();
				$this->load->theme('master/area/area_index',$data);	
			}else{
				redirect(base_url('area/areas'));
			}
		}else{
			redirect(base_url('area/areas'));
		}
	}

	public function update_area()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required|callback_e_unique_area');
		$this->form_validation->set_rules('city', 'City','trim|required');
		$this->form_validation->set_rules('pincode', 'Pincode','trim|required|numeric|max_length[6]|min_length[6]');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Edit Area";
			$data['_e']         = 1;
			$data['ind']		= $this->general_model->get_area($this->input->post('id'));
			$data['list']		= $this->db->order_by('id','desc')->get_where('areas',['df' => ''])->result_array();
			$this->load->theme('master/area/area_index',$data);		
		}
		else
		{ 
			$data = [
				'name'		=> $this->input->post('name'),
				'city'		=> $this->input->post('city'),
				'pincode'	=> $this->input->post('pincode')
			];
			$this->db->where('id',$this->input->post('id'))->update('areas',$data);

			$this->session->set_flashdata('msg', 'Area Updated');
	        redirect(base_url('area/areas'));
		}
	}

	public function delete_area($id = false)
	{
		if($id){
			if($this->general_model->get_area($id)){
				$data = [
					'df'		=> 'deleted'
				];
				$this->db->where('id',$id)->update('areas',$data);
				$this->session->set_flashdata('msg', 'Area Deleted');
	        	redirect(base_url('area/areas'));
			}else{
				redirect(base_url('area/areas'));
			}
		}else{
			redirect(base_url('area/areas'));
		}
	}




	public function e_unique_name()
	{
		if($this->db->get_where('area_state',['id !=' => $this->input->post('id'),'name' => $this->input->post('name'),'df' => ''])->result_array()){
			$this->form_validation->set_message('e_unique_name', 'Name Already Exists');
        	return false;
		}else{
			return true;
		}
	}

	public function unique_name()
	{
		if($this->db->get_where('area_state',['name' => $this->input->post('name'),'df' => ''])->result_array()){
			$this->form_validation->set_message('unique_name', 'Name Already Exists');
        	return false;
		}else{
			return true;
		}
	}

	public function unique_district()
	{
		if($this->db->get_where('district',['name' => $this->input->post('name'),'df' => ''])->result_array()){
			$this->form_validation->set_message('unique_district', 'Name Already Exists');
        	return false;
		}else{
			return true;
		}
	}

	public function e_unique_district()
	{
		if($this->db->get_where('district',['id !=' => $this->input->post('id'),'name' => $this->input->post('name'),'df' => ''])->result_array()){
			$this->form_validation->set_message('e_unique_district', 'Name Already Exists');
        	return false;
		}else{
			return true;
		}
	}

	public function e_unique_city()
	{
		if($this->db->get_where('area_city',['id !=' => $this->input->post('id'),'name' => $this->input->post('name'),'df' => ''])->result_array()){
			$this->form_validation->set_message('e_unique_city', 'Name Already Exists');
        	return false;
		}else{
			return true;
		}
	}

	public function unique_city()
	{
		if($this->db->get_where('area_city',['name' => $this->input->post('name'),'df' => ''])->result_array()){
			$this->form_validation->set_message('unique_name', 'Name Already Exists');
        	return false;
		}else{
			return true;
		}
	}

	public function e_unique_area()
	{
		if($this->db->get_where('areas',['id !=' => $this->input->post('id'),'name' => $this->input->post('name'),'df' => ''])->result_array()){
			$this->form_validation->set_message('e_unique_area', 'Name Already Exists');
        	return false;
		}else{
			return true;
		}
	}

	public function unique_area()
	{
		if($this->db->get_where('areas',['name' => $this->input->post('name'),'df' => ''])->result_array()){
			$this->form_validation->set_message('unique_area', 'Name Already Exists');
        	return false;
		}else{
			return true;
		}
	}
}
?>