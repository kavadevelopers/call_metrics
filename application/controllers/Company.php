<?php
class Company extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function index()
	{
		$data['_title']		= "Company";
		$data['company']		= $this->db->order_by('id','asc')->get_where('company',['df'	=> ''])->result_array();
		$this->load->theme('master/company/index',$data);
	}

	public function add()
	{
		$data['_title']		= "Add Company";
		$this->load->theme('master/company/add',$data);	
	}

	public function save()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required');
		$this->form_validation->set_rules('gst', 'GST','trim');
		$this->form_validation->set_rules('pan', 'PAN','trim');
		$this->form_validation->set_rules('prefix', 'Invoice Prefix','trim|required');
		$this->form_validation->set_rules('payment_prefix', 'Payment Prefix','trim|required');
		$this->form_validation->set_rules('add1', 'Address Line-1','trim|required');
		$this->form_validation->set_rules('add2', 'Address Line-2','trim');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']	= 'Add Company';
			$this->load->theme('master/company/add',$data);
		}
		else
		{ 
			$data = [
				'name'				=> strtoupper($this->input->post('name')),
				'gst'				=> strtoupper($this->input->post('gst')),
				'pan'				=> strtoupper($this->input->post('pan')),
				'prefix'			=> strtoupper($this->input->post('prefix')),
				'receipt_prefix'	=> strtoupper($this->input->post('payment_prefix')),
				'add1'				=> strtoupper($this->input->post('add1')),
				'add2'				=> strtoupper($this->input->post('add2'))
			];
			$this->db->insert('company',$data);

			$this->session->set_flashdata('msg', 'Company Added');
	        redirect(base_url('company'));
		}
	}

	public function edit($id = false)
	{
		if($id){
			if($this->general_model->get_company($id)){
				$data['_title']	= 'Edit Branch';
				$data['company']	= $this->general_model->get_company($id);
				$this->load->theme('master/company/edit',$data);
			}else{
				redirect(base_url('company'));
			}
		}else{
			redirect(base_url('company'));
		}
	}

	public function update()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('name', 'Name','trim|required');
		$this->form_validation->set_rules('gst', 'GST','trim');
		$this->form_validation->set_rules('pan', 'PAN','trim');
		$this->form_validation->set_rules('prefix', 'Invoice Prefix','trim|required');
		$this->form_validation->set_rules('payment_prefix', 'Payment Prefix','trim|required');
		$this->form_validation->set_rules('add1', 'Address Line-1','trim|required');
		$this->form_validation->set_rules('add2', 'Address Line-2','trim');
		$this->form_validation->set_rules('bank', 'Bank Name','trim|required');
		$this->form_validation->set_rules('ac_name', 'Account Holder Name','trim|required');
		$this->form_validation->set_rules('ac_no', 'Account No.','trim|required');
		$this->form_validation->set_rules('ifsc', 'IFSC Code','trim|required');
		$this->form_validation->set_rules('upi', 'G-PAY,PAYTM,PHONE-PAY MOBILE','trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']	= 'Edit Branch';
			$data['company']	= $this->general_model->get_company($this->input->post('id'));
			$this->load->theme('master/company/edit',$data);
		}
		else
		{ 
			$data = [
				'name'		=> strtoupper($this->input->post('name')),
				'gst'		=> strtoupper($this->input->post('gst')),
				'pan'		=> strtoupper($this->input->post('pan')),
				'prefix'			=> strtoupper($this->input->post('prefix')),
				'receipt_prefix'	=> strtoupper($this->input->post('payment_prefix')),
				'add1'				=> strtoupper($this->input->post('add1')),
				'add2'				=> strtoupper($this->input->post('add2')),
				'bank'				=> strtoupper($this->input->post('bank')),
				'ac_name'				=> strtoupper($this->input->post('ac_name')),
				'ac_no'				=> strtoupper($this->input->post('ac_no')),
				'ifsc'				=> strtoupper($this->input->post('ifsc')),
				'upi'				=> strtoupper($this->input->post('upi'))
			];
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('company',$data);
			
			$config['upload_path'] = './uploads/company/';
		    $config['allowed_types']	= '*';
		    $config['max_size']      = '0';
		    $config['overwrite']     = FALSE;
		    $this->load->library('upload', $config);
			if($_FILES['file']['name'] != ""){
		    	$fname = microtime(true).".".pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		    	$_FILES['doc']['name'] 		= $fname;
		    	$_FILES['doc']['type'] 		= $_FILES['file']['type'];
		    	$_FILES['doc']['tmp_name'] 	= $_FILES['file']['tmp_name'];
		    	$_FILES['doc']['error'] 	= $_FILES['file']['error'];
		    	$_FILES['doc']['size'] 		= $_FILES['file']['size'];

		    	
		    	$this->upload->initialize($config);
		    	if($this->upload->do_upload('doc')){
		    		$this->db->where('id',$this->input->post('id'));
					$this->db->update('company',['letter_head' => $fname]);
		    	}

		    	if(file_exists(FCPATH.'uploads/company/'.$this->input->post('oldFile'))){
		            unlink(FCPATH.'/uploads/company/'.$this->input->post('oldFile'));   
		        }
		    }

			$this->session->set_flashdata('msg', 'Company Saved');
	        redirect(base_url('company'));
		}
	}

	public function delete($id = false)
	{
		if($id){
			if($this->general_model->get_company($id)){
				$this->db->where('id',$id)->update('company',['df' => 'deleted']);			
				$this->session->set_flashdata('msg', 'Company Deleted');
		        redirect(base_url('company'));
			}else{
				redirect(base_url('company'));
			}
		}else{
			redirect(base_url('company'));
		}
	}
}