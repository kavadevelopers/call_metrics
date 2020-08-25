<?php
class Services extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function index()
	{
		$data['_title']			= "Services";
		$data['services']		= $this->db->order_by('id','desc')->get_where('services',['df'	=> ''])->result_array();
		$this->load->theme('master/services/index',$data);	
	}

	public function add()
	{
		$data['_title']		= "Add Service";
		$this->load->theme('master/services/add',$data);	
	}

	public function save()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required');
		$this->form_validation->set_rules('wightage', 'Weightage','trim|required');
		$this->form_validation->set_rules('time', 'Time To Complete','trim|required');
		$this->form_validation->set_rules('price', 'Price','trim|required');
		$this->form_validation->set_rules('renual', 'Renual In Month','trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Add Service";
			$this->load->theme('master/services/add',$data);	
		}
		else
		{ 
			$data = [
				'name'		=> $this->input->post('name'),
				'weight'	=> $this->input->post('wightage'),
				'time'		=> $this->input->post('time'),
				'price'		=> $this->input->post('price'),
				'renual'		=> $this->input->post('renual')
			];
			$this->db->insert('services',$data);

			$this->session->set_flashdata('msg', 'Service Added');
	        redirect(base_url('services'));
		}
	}

	public function edit($id = false)
	{
		if($id){
			if($this->general_model->get_service($id)){
				$data['_title']	= 'Edit Service';
				$data['service']	= $this->general_model->get_service($id);
				$this->load->theme('master/services/edit',$data);
			}else{
				redirect(base_url('services'));
			}
		}else{
			redirect(base_url('services'));
		}
	}

	public function update()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required');
		$this->form_validation->set_rules('wightage', 'Weightage','trim|required');
		$this->form_validation->set_rules('time', 'Time To Complete','trim|required');
		$this->form_validation->set_rules('price', 'Price','trim|required');
		$this->form_validation->set_rules('renual', 'Renual In Month','trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']	= 'Edit Service';
			$data['service']	= $this->general_model->get_service($this->input->post('id'));
			$this->load->theme('master/services/edit',$data);
		}
		else
		{ 
			$data = [
				'name'		=> $this->input->post('name'),
				'weight'	=> $this->input->post('wightage'),
				'time'		=> $this->input->post('time'),
				'price'		=> $this->input->post('price'),
				'renual'		=> $this->input->post('renual')
			];
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('services',$data);

			$this->session->set_flashdata('msg', 'Service Updated');
	        redirect(base_url('services'));
		}
	}

	public function delete($id = false)
	{
		if($id){
			if($this->general_model->get_service($id)){

				$this->db->where('id',$id)->update('services',['df' => 'deleted']);			
				$this->session->set_flashdata('msg', 'Service Deleted');
		        redirect(base_url('services'));
		        
			}else{
				redirect(base_url('services'));
			}
		}else{
			redirect(base_url('services'));
		}
	}
}
?>