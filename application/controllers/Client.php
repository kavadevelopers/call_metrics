<?php
class Client extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function index()
	{
		$data['_title']		= "Clients";	
		$data['client']		= $this->general_model->get_clients();
		$this->load->theme('client/index',$data);
	}

	public function new_clients()
	{
		$data['_title']		= "New Clients";
		$data['clients']		= $this->db->get_where('client',['status' => '1'])->result_array();
		$this->load->theme('client/new_client',$data);	
	}

	public function new_client_register($id)
	{
		$data['_title']		= "Register Client";
		$data['client']		= $this->general_model->_get_client($id);
		$data['lead']		= $this->general_model->_get_lead($data['client']['lead']);
		$this->load->theme('client/register',$data);		
	}

	public function save()
	{
		$mobiles = '';
		foreach ($this->input->post('mobile') as $key => $value) {
			if($value != ''){
				$mobiles .= $value.',';
			}
		}

		$emails = '';
		foreach ($this->input->post('email') as $key => $value) {
			if($value != ''){
				$emails .= strtoupper($value).',';
			}
		}

		$language = '';
		foreach ($this->input->post('language') as $key => $value) {
			if($value != ''){
				$language .= $value.',';
			}
		}

		$time_to_call = '';
		foreach ($this->input->post('time_to_call') as $key => $value) {
			if($value != ''){
				$time_to_call .= strtoupper($value).',';
			}
		}

		$contact_persons = [];
		foreach ($this->input->post('con_name') as $key => $value) {
			if($this->input->post('con_name')[$key] != "" && $this->input->post('con_mobile')[$key] != "" && $this->input->post('con_address')[$key] != ""){
				if($this->input->post('con_birth')[$key] != ""){
					$cpbdate = $this->input->post('con_birth')[$key];
				}else{
					$cpbdate = "";
				}
				$ar = [
					'name' => $this->input->post('con_name')[$key],
					'mobile' => $this->input->post('con_mobile')[$key],
					'address' => $this->input->post('con_address')[$key],
					'bdate'	=> $cpbdate
				];
				array_push( $contact_persons, $ar);
			}
		}


		$lead = $this->general_model->_get_lead($this->input->post('lead'));
		$source = $this->general_model->_get_source($lead['source']);
		$referal_code = "";
		$referal_get = $this->db->get_where('client' ,['c_id' => $this->input->post('refered_by')])->row_array();
		if($referal_get){
			$referal_code = $referal_get['c_id'];
		}

		$data = [
			'client_type'	=> $this->input->post('client_type'),
			'source'	=> $this->input->post('source'),
			'fname'		=> strtoupper($this->input->post('fname')),
			'mname'		=> strtoupper($this->input->post('mname')),
			'lname'		=> strtoupper($this->input->post('lname')),
			'firm'		=> strtoupper($this->input->post('firm')),
			'mobile'	=> rtrim($mobiles,','),
			'email'		=> rtrim($emails,','),
			'pan'		=> strtoupper($this->input->post('pan')),
			'dob'		=> dd($this->input->post('dob')),
			'gender'	=> $this->input->post('gender'),
			'add1'		=> strtoupper($this->input->post('add1')),
			'add2'		=> strtoupper($this->input->post('add2')),
			'area'		=> $this->input->post('area'),
			'city'		=> $this->input->post('city'),
			'district'	=> strtoupper($this->input->post('district')),
			'state'		=> $this->input->post('state'),
			'pin'		=> $this->input->post('pin'),
			'occupation'		=> $this->input->post('occupation'),
			'language'		=> rtrim($language,','),	
			'time_to_call'	=> rtrim($time_to_call,','),	
			'health_in'		=> $this->input->post('health_insurance'),
			'life_in'		=> $this->input->post('life_insurance'),
			'itr_client'		=> $this->input->post('itr_client'),
			'gst_client'		=> $this->input->post('gst_client'),
			'gst_type'			=> $this->input->post('gst_type'),
			'month_quater'		=> $this->input->post('month_quater'),
			'industry'			=> $this->input->post('industry'),
			'sub_industry'		=> $this->input->post('sub_industry'),
			'ind_remarks'		=> strtoupper($this->input->post('ind_remaarks')),
			'profile_intro'		=> strtoupper($this->input->post('profile_intro')),
			'turnover_notes'	=> strtoupper($this->input->post('turnover_notes')),
			'turnover_notes'	=> strtoupper($this->input->post('turnover_notes')),
			'turnover_notes'	=> strtoupper($this->input->post('goal')),
			'quotation'			=> strtoupper($this->input->post('quotation')),
			'contact_persons'	=> json_encode($contact_persons),
			'status'			=> 0,
			'refered_by'		=> $referal_code
		];

		$this->db->where('id',$this->input->post('client_id'))->update('client',$data);

		if($referal_code != ""){
			$this->db->where_in('service',[1,2,3]);
			$jobs = $this->db->get_where('job' ,['client' => $this->input->post('client_id'),'status <' => 3])->result_array();
			$amount = 0;
			foreach ($jobs as $key => $value) {
				$amount += $value['price'];
			}

			$rClient = $this->db->get_where('client' ,['c_id' => $this->input->post('refered_by')])->row_array();

			$this->db->where('id',$rClient)->update('client',['referal_amount' => ($rClient->referal_amount + $amount)]);

			$rClient = $this->db->get_where('client' ,['c_id' => $this->input->post('refered_by')])->row_array();


			if($rClient['itr_amount'] != "0.00"){
				if( ($rClient['referal_amount'] / 3) == $rClient['itr_amount']){
					$data = [
						'type'		=> referal(),
						'client'	=> $rClient['id'],
						'date'		=> date('Y-m-d'),
						'main'		=> "",
						'credit'	=> $rClient['itr_amount']
					];
					$this->db->insert('transaction',$data);
				}
			}			
		}



		// foreach ($this->input->post('services') as $key => $value) {
		// 	if($value != ''){
		// 		$service = explode('-',$value)[0];
		// 		$price = $this->input->post('amount')[$key];
		// 		if($this->input->post('qty')[$key] != ""){
		// 			$qty = $this->input->post('qty')[$key];
		// 		}else{
		// 			$qty = 1;
		// 		}
				
		// 		$this->db->order_by('rand()');
		// 	    $this->db->limit(1);
		// 	    $this->db->where('user_type','2');
		// 	    $this->db->where('df','');
		// 	    $user = $this->db->get('user')->row_array();
		// 		$data = [
		// 			'branch'		=> $this->input->post('branch'),
		// 			'service'		=> $service,
		// 			'price'			=> $price,
		// 			'qty'			=> $qty,
		// 			'client'		=> $this->input->post('client_id'),
		// 			'status'		=> 0,
		// 			'owner'			=> $user['id'],
		// 			'importance'	=> 'NORMAL',
		// 			'f_date'		=> null,
		// 			'f_time'		=> null,
		// 			'created_by'	=> get_user()['id'],
		// 			'created_at'		=> date('Y-m-d H:i:s')
		// 		];
		// 		$this->db->insert('job',$data);
		// 		$job_id = $this->db->insert_id();
		// 		$this->db->where('id',$job_id)->update('job',['job_id' => "JOB_".$job_id]);			
		// 	}
		// }

		$this->db->where('id',$this->input->post('lead'))->update('leads',['status' => 2]);		

		$this->session->set_flashdata('msg', 'Client Saved');
	    redirect(base_url('client/new_clients'));
	}


	public function view($id = false)
	{
		if($id){
			if($this->general_model->_get_client($id)){
				$data['_title']		= "View Client";	
				$data['client']		= $this->general_model->_get_client($id);
				$this->load->theme('client/view',$data);
			}else{
				redirect(base_url('client'));			
			}
		}else{
			redirect(base_url('client'));
		}
	}

	public function cancel($id = false)
	{
		if($id){
			if($this->general_model->_get_client($id)){
				$this->db->where('id',$id);
				$this->db->update('client',['status' => 9]);
				$this->session->set_flashdata('msg', 'Client Cancel Success');
	    		redirect(base_url('client'));
			}else{
				redirect(base_url('client'));			
			}
		}else{
			redirect(base_url('client'));
		}
	}

	public function in_activate($id = FALSE)
	{
		if($id){
			if($this->general_model->_get_client($id)){
				$this->db->where('id',$id);
				$this->db->update('client',['status' => 8]);
				$this->session->set_flashdata('msg', 'Client In Activated');
	    		redirect(base_url('client'));
			}else{
				redirect(base_url('client'));			
			}
		}else{
			redirect(base_url('client'));
		}
	}

	public function active($id,$type)
	{
		$this->db->where('id',$id);
		$this->db->update('client',['status' => 0]);
		$this->session->set_flashdata('msg', 'Client Activated');
		if($type == '1'){
			redirect(base_url('client/canceled'));
		}else if($type == '2'){
			redirect(base_url('client/in_active'));
		}
	}

	public function canceled()
	{
		$data['_title']		= "Cancled Clients";	
		$data['client']		= $this->general_model->get_cancel_clients();
		$this->load->theme('client/cancel',$data);
	}

	public function in_active()
	{
		$data['_title']		= "In-Active Clients";	
		$data['client']		= $this->general_model->get_inactive_clients();
		$this->load->theme('client/in_active',$data);
	}

	public function add_group()
	{
		$data = [
			'main'		=> $this->input->post('main'),
			'child'		=> $this->input->post('child'),
			'relation'		=> strtoupper($this->input->post('relation')),
			'remarks'		=> $this->input->post('remarks')
		];
		$this->db->insert('grouping',$data);
		$main = $this->general_model->_get_client($this->input->post('main'));
		$child = $this->general_model->_get_client($this->input->post('child'));
		echo json_encode(['group' => $main['group'],'name' => $child['fname'].' '.$child['mname'].' '.$child['lname'],'relation' => strtoupper($this->input->post('relation')),'remarks' => nl2br($this->input->post('remarks')),'client' => $child['c_id']]);
	}

	public function uploadDoc($id)
	{

		$config['upload_path'] = './uploads/doc/';
	    $config['allowed_types']	= '*';
	    $config['max_size']      = '0';
	    $config['overwrite']     = FALSE;
	    $this->load->library('upload', $config);
		
		foreach ($_FILES['file']['name'] as $key => $value) {
	    	if($_FILES['file']['name'] != ""){
		    	$fname = microtime(true).".".pathinfo($_FILES['file']['name'][$key], PATHINFO_EXTENSION);
		    	$_FILES['doc']['name'] 		= $fname;
		    	$_FILES['doc']['type'] 		= $_FILES['file']['type'][$key];
		    	$_FILES['doc']['tmp_name'] 	= $_FILES['file']['tmp_name'][$key];
		    	$_FILES['doc']['error'] 	= $_FILES['file']['error'][$key];
		    	$_FILES['doc']['size'] 		= $_FILES['file']['size'][$key];

		    	$config['file_name'] = $fname;
		    	$this->upload->initialize($config);
		    	if($this->upload->do_upload('doc')){
		    		$data = [
		    			'folder'		=> $this->input->post('folder')[$key],
		    			'sub_folder'		=> $this->input->post('sub_folder')[$key],
		    			'name'		=> $this->input->post('fileName')[$key],
			        	'file'		=> $fname,
			        	'type' 		=> pathinfo($_FILES['file']['name'][$key], PATHINFO_EXTENSION),
			        	'client' 	=> $id
			        ];

			        $this->db->insert('documents',$data);
		    	}
		    }
	    }

	    $this->session->set_flashdata('msg', 'Document Uploaded');
	    redirect(base_url('client/view/').$id);
	}

	public function add_family_person()
	{
		$data = [
			'name'		=> strtoupper($this->input->post('name')),
			'relation'	=> strtoupper($this->input->post('relation')),
			'mobile'	=> strtoupper($this->input->post('mobile')),
			'email'		=> strtoupper($this->input->post('email')),
			'itr'		=> strtoupper($this->input->post('itr')),
			'client'	=> strtoupper($this->input->post('client'))
		];
		$this->db->insert('family',$data);

		$this->session->set_flashdata('msg', 'Family Member Added');
	    redirect(base_url('client/view/').$this->input->post('client'));	
	}

	public function file_delete()
	{
		$data = $this->db->get_where('documents',['id' => $this->input->post('id')])->row_array();
		if(file_exists(FCPATH.'uploads/doc/'.$data['file'])){
            unlink(FCPATH.'uploads/doc/'.$data['file']);   
        }

        $this->db->where('id',$data['id'])->delete('documents');
	}

	public function panCheck()
	{
		$client = $this->db->get_where('client' ,['pan' => $this->input->post('pan')])->row_array();
		if($client){
			if($client['status'] == 0){ $type = "Active"; }else if($client['status'] == 9){ $type = "Canceled"; }else if($client['status'] == 8){ $type = "In-Active"; }
			echo json_encode(['1','This PAN No. is already exists in '.$type.' Clients']);
		}else{
			echo json_encode(['0']);
		}
	}
}