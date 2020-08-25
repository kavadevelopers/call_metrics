<?php
class Leads extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function index()
	{
		$data['_title']		= "Manage Leads";
		if(get_user()['user_type'] == '1'){
			$data['leads']		= $this->db->get_where('leads',['status' => '0','df' => '','dump' => '','branch' => get_user()['branch']])->result_array();
		}
		else if(get_user()['user_type'] == '2'){
			$data['leads']		= $this->db->get_where('leads',['status' => '0','df' => '','dump' => '','owner' => get_user()['id']])->result_array();
		}
		else if(get_user()['user_type'] == '3'){
			$data['leads']		= $this->db->get_where('leads',['status' => '0','df' => '','dump' => '','owner' => get_user()['id']])->result_array();
		}
		else{
			$data['leads']		= $this->db->get_where('leads',['status' => '0','df' => '','dump' => ''])->result_array();
		}
		$this->load->theme('leads/index',$data);
	}

	public function add_lead()
	{
		$data['_title']		= "Add Lead";	
		$this->load->theme('leads/add',$data);
	}

	public function view($id = false,$red = false)
	{
		if($id){
			if($red){
				$reda = $red;
			}else{
				$reda = "";
			}
			$lead = $this->general_model->_get_lead($id);
			if($lead){	

				$data['_title']		= "LEAD #".$lead['lead'];
				$data['lead']		= $lead;
				$data['red']		= $reda;
				$this->load->theme('leads/view',$data);

			}else{
				if($red){
					redirect(base_url('leads'));
				}else{
					redirect(base_url('leads'));
				}
			}

		}else{
			if($red){
				redirect(base_url('leads'));
			}else{
				redirect(base_url('leads'));
			}
		}
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
				$emails .= $value.',';
			}
		}

		$services = [];
		foreach ($this->input->post('services') as $key => $value) {
			if($value != '' || $this->input->post('amount')[$key] != ""){
				$services[] = [explode('-',$value)[0],$this->input->post('amount')[$key]];
			}
		}

		$landline = '';
		foreach ($this->input->post('landline') as $key => $value) {
			if($value != ''){
				$landline .= $value.',';
			}
		}	

		if($this->input->post('nftime') != ""){
			$ftime = timeConverter($this->input->post('nftime'));
		}else{
			$ftime = null;
		}

		if($this->input->post('nttime') != ""){
			$ttime = timeConverter($this->input->post('nttime'));
		}else{
			$ttime = null;
		}

		$data = [
			'owner'							=> $this->input->post('owner'),
			'branch'						=> $this->input->post('branch'),
			'date'							=> dd($this->input->post('date')),
			'customer'						=> strtoupper($this->input->post('name')),
			'firm'							=> strtoupper($this->input->post('firm')),
			'state'							=> $this->input->post('state'),
			'city'							=> $this->input->post('city'),
			'area'							=> $this->input->post('area'),
			'district'						=> $this->input->post('district'),
			'other_area'					=> strtoupper($this->input->post('other_area_name')),
			'mobile'						=> rtrim($mobiles,','),
			'email'							=> strtoupper(rtrim($emails,',')),
			'services'						=> json_encode($services),
			'importance'					=> $this->input->post('importance'),
			'remarks'						=> strtoupper($this->input->post('remarks')),
			'next_followup_date'			=> dd($this->input->post('ndate')),
			'tfrom'							=> $ftime,
			'tto'							=> $ttime,
			'source'						=> $this->input->post('source'),
			'occupation'					=> $this->input->post('occupation'),
			'quotation'						=> strtoupper($this->input->post('special_quote')),
			'landline'						=> rtrim($landline,',')
		];

		$this->db->insert('leads',$data);
		$id = $this->db->insert_id();
		$count_lead = $this->db->get_where('leads',['branch' => $this->input->post('branch')])->num_rows();
		$lead_id = substr($this->general_model->_get_branch($this->input->post('branch'))['name'],0,2).'_'.($count_lead);
		$this->db->where('id',$id)->update('leads',['lead' => $lead_id]);


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
		    			'name'		=> $this->input->post('fileName')[$key],
			        	'filename'	=> $fname,
			        	'for' 		=> 'Lead',
			        	'type' 		=> pathinfo($_FILES['file']['name'][$key], PATHINFO_EXTENSION),
			        	'for_id' 	=> $id
			        ];

			        $this->db->insert('files',$data);
		    	}
		    }
	    }

		$this->session->set_flashdata('msg', 'Lead Added');
	    redirect(base_url('leads'));
	}

	public function edit($id = false)
	{
		if($id){
			if($this->general_model->get_lead($id)){
				
				$data['lead']		= $this->general_model->get_lead($id);
				$data['_title']		= "Edit Lead - ".$data['lead']['lead'];	
				$data['dump']		= 0;
				$this->load->theme('leads/edit',$data);

			}else{
				redirect(base_url('leads'));	
			}
		}else{
			redirect(base_url('leads'));
		}
	}

	public function update()
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
				$emails .= $value.',';
			}
		}

		$services = [];
		foreach ($this->input->post('services') as $key => $value) {
			if($value != '' || $this->input->post('amount')[$key] != ""){
				$services[] = [explode('-',$value)[0],$this->input->post('amount')[$key]];
			}
		}

		$landline = '';
		foreach ($this->input->post('landline') as $key => $value) {
			if($value != ''){
				$landline .= $value.',';
			}
		}	

		if($this->input->post('nftime') != ""){
			$ftime = timeConverter($this->input->post('nftime'));
		}else{
			$ftime = null;
		}

		if($this->input->post('nttime') != ""){
			$ttime = timeConverter($this->input->post('nttime'));
		}else{
			$ttime = null;
		}
		
		$data = [
			'owner'							=> $this->input->post('owner'),
			'branch'						=> $this->input->post('branch'),
			'date'							=> dd($this->input->post('date')),
			'customer'						=> strtoupper($this->input->post('name')),
			'firm'							=> strtoupper($this->input->post('firm')),
			'state'							=> $this->input->post('state'),
			'city'							=> $this->input->post('city'),
			'area'							=> $this->input->post('area'),
			'district'						=> $this->input->post('district'),
			'other_area'					=> strtoupper($this->input->post('other_area_name')),
			'mobile'						=> rtrim($mobiles,','),
			'email'							=> strtoupper(rtrim($emails,',')),
			'services'						=> json_encode($services),
			'importance'					=> $this->input->post('importance'),
			'remarks'						=> strtoupper($this->input->post('remarks')),
			'next_followup_date'			=> dd($this->input->post('ndate')),
			'tfrom'							=> $ftime,
			'tto'							=> $ttime,
			'source'						=> $this->input->post('source'),
			'occupation'					=> $this->input->post('occupation'),
			'quotation'						=> strtoupper($this->input->post('special_quote')),
			'landline'						=> rtrim($landline,',')
		];

		$this->db->where('id',$this->input->post('id'))->update('leads',$data);

		$id = $this->input->post('id');

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
		    			'name'		=> $this->input->post('fileName')[$key],
			        	'filename'	=> $fname,
			        	'for' 		=> 'Lead',
			        	'type' 		=> pathinfo($_FILES['file']['name'][$key], PATHINFO_EXTENSION),
			        	'for_id' 	=> $id
			        ];

			        $this->db->insert('files',$data);
		    	}
		    }
	    }

		$this->session->set_flashdata('msg', 'Lead Updated');
	    redirect(base_url('leads/view/').$this->input->post('id'));
	}

	public function transfer()
	{
		$this->db->where('id',$this->input->post('lead'))->update('leads',['owner' => $this->input->post('owner')]);
		$this->session->set_flashdata('msg', 'Lead Transfered');
	   	redirect(base_url('leads'));
	}

	public function transfer_all()
	{
		$leads = explode("-", $this->input->post('leads'));
		foreach ($leads as $key => $value) {
			$data = [
				'owner' => $this->input->post('owner')
			];
			$this->db->where('id',$value)->update('leads',$data);
		}	

		$this->session->set_flashdata('msg', 'Leads Transfered');
	   	redirect(base_url('leads'));
	}

	public function delete($id = false,$type = false)
	{
		if($id){
			if($this->general_model->get_lead($id)){
				$this->db->where('id',$id)->update('leads',['df' => 'deleted']);
				$this->session->set_flashdata('msg', 'Lead Deleted');
				if(!$type){
	    			redirect(base_url('leads'));			
	    		}else if($type == 1){
	    			redirect(base_url('leads/dump_leads'));			
	    		}else if($type == 2){
	    			redirect(base_url('leads/converted_leads'));			
	    		}
			}else{
				if(!$type){
	    			redirect(base_url('leads'));			
	    		}else if($type == 1){
	    			redirect(base_url('leads/dump_leads'));			
	    		}else if($type == 2){
	    			redirect(base_url('leads/converted_leads'));			
	    		}
			}
		}else{
			if(!$type){
    			redirect(base_url('leads'));			
    		}else if($type == 1){
    			redirect(base_url('leads/dump_leads'));			
    		}else if($type == 2){
    			redirect(base_url('leads/converted_leads'));			
    		}
		}
	}

	public function dump($id = false)
	{
		if($id){
			if($this->general_model->get_lead($id)){
				$this->db->where('id',$id)->update('leads',['dump' => 'yes']);
				$this->session->set_flashdata('msg', 'Lead Tranfered to Dump');
	    		redirect(base_url('leads'));			
			}else{
				redirect(base_url('leads'));	
			}
		}else{
			redirect(base_url('leads'));
		}
	}

	public function dump_leads()
	{
		$data['_title']		= "Dump Leads";
		if(get_user()['user_type'] == '1'){
			$data['leads']		= $this->db->get_where('leads',['df' => '','dump' => 'yes','branch' => get_user()['branch']])->result_array();
		}
		else if(get_user()['user_type'] == '2'){
			$data['leads']		= $this->db->get_where('leads',['df' => '','dump' => 'yes','owner' => get_user()['id']])->result_array();
		}
		else if(get_user()['user_type'] == '3'){
			$data['leads']		= $this->db->get_where('leads',['df' => '','dump' => 'yes','owner' => get_user()['id']])->result_array();
		}
		else{
			$data['leads']		= $this->db->get_where('leads',['df' => '','dump' => 'yes'])->result_array();
		}
		$this->load->theme('leads/dump',$data);
	}

	public function converted_leads()
	{
		$data['_title']		= "Converted Leads";
		if(get_user()['user_type'] == '1'){
			$data['leads']		= $this->db->get_where('leads',['df' => '','status !=' => '0','branch' => get_user()['branch']])->result_array();
		}
		else if(get_user()['user_type'] == '2'){
			$data['leads']		= $this->db->get_where('leads',['df' => '','status !=' => '0','owner' => get_user()['id']])->result_array();
		}
		else if(get_user()['user_type'] == '3'){
			$data['leads']		= $this->db->get_where('leads',['df' => '','status !=' => '0','owner' => get_user()['id']])->result_array();
		}
		else{
			$data['leads']		= $this->db->get_where('leads',['df' => '','status !=' => '0'])->result_array();
		}
		$this->load->theme('leads/converted',$data);
	}

	public function edit_dump($id = false)
	{
		if($id){
			if($this->general_model->get_lead($id)){
				
				$data['lead']		= $this->general_model->get_lead($id);
				$data['_title']		= "Edit Lead - ".$data['lead']['lead'];	
				$data['dump']		= 1;
				$this->load->theme('leads/edit',$data);

			}else{
				redirect(base_url('leads'));	
			}
		}else{
			redirect(base_url('leads'));
		}
	}

	public function edit_converted($id = false)
	{
		if($id){
			if($this->general_model->get_lead($id)){
				
				$data['lead']		= $this->general_model->get_lead($id);
				$data['_title']		= "Edit Lead - ".$data['lead']['lead'];	
				$data['dump']		= 2;
				$this->load->theme('leads/edit',$data);

			}else{
				redirect(base_url('leads'));	
			}
		}else{
			redirect(base_url('leads'));
		}
	}

	public function file_delete()
	{
		$data = $this->db->get_where('files',['id' => $this->input->post('id')])->row_array();
		if(file_exists(FCPATH.'uploads/doc/'.$data['filename'])){
            unlink(FCPATH.'/uploads/doc/'.$data['filename']);   
        }

        $this->db->where('id',$data['id'])->delete('files');
	}

	public function normal($id = false)
	{
		if($id){
			if($this->general_model->get_lead($id)){
				$this->db->where('id',$id)->update('leads',['dump' => '']);
				$this->session->set_flashdata('msg', 'Lead Tranfered to Normal');
	    		redirect(base_url('leads/dump_leads'));			
			}else{
				redirect(base_url('leads/dump_leads'));	
			}
		}else{
			redirect(base_url('leads/dump_leads'));
		}
	}

	private function set_upload_options()
	{   
	    //upload an image options
	    $config = array();
	    $config['upload_path'] = './uploads/doc/';
	    $config['allowed_types']	= '*';
	    $config['max_size']      = '0';
	    $config['overwrite']     = FALSE;

	    return $config;
	}
}