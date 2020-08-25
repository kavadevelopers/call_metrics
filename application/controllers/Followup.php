<?php
class Followup extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function lead()
	{
		$data['_title']		= "Lead Followup";
		if(get_user()['user_type'] != '0'){
			$this->db->where('owner',$this->session->userdata('id'));
		}
		$this->db->where('df',"");
		$this->db->where('dump',"");
		$this->db->where('status',0);
		$this->db->where('next_followup_date <=', date('Y-m-d'));
		$data['leads']		= $this->db->get('leads')->result_array();
		$this->load->theme('followup/lead',$data);	
	}

	public function job()
	{
		$data['_title']		= "Job Followup";
		if(get_user()['user_type'] != '0'){
			$this->db->where('owner',$this->session->userdata('id'));
		}
		$this->db->where('fstatus',0);
		$this->db->where('status <','4');
		$this->db->where('f_date <=', date('Y-m-d'));
		$data['jobs']		= $this->db->get('job')->result_array();
		$this->load->theme('followup/job',$data);	
	}

	public function payment()
	{
		$from = "";$to = "";
		if($this->input->post('from') && $this->input->post('from') != ""){
			$this->db->where('date >=',dd($this->input->post('from')));
			$from = $this->input->post('from');
		}

		if($this->input->post('to') && $this->input->post('to') != ""){
			$this->db->where('date <=',dd($this->input->post('to')));	
			$to = $this->input->post('to');
		}
		$this->db->where('done','0');
		$data['_title']			= "Payment Followup";
		$data['invoices'] = $this->db->get('invoice')->result_array();
		$data['from']		= $from;
		$data['to']			= $to;
		$this->load->theme('followup/payment',$data);

	}

	public function get()
	{
		$followups = $this->db->order_by('id','desc')->get_where('followup',['main_id' => $this->input->post('id'),'type' => $this->input->post('type')])->result_array();
		$string = '';
		$cus = 0;
		foreach ($followups as $key => $followup) {
			$customer = $followup['customer'] == '1'?'Yes':'No';
			if($followup['customer'] == 1){
				$cus++;
			}
			$str = '<tr>';
			$str .= '<td class="text-center">'.vd($followup['next_f']).get_from_to($followup['ftime'],$followup['ttime']).'</td>';
			$str .= '<td class="text-center">'._vdatetime($followup['date']).'</td>';
			$str .= '<td>'.nl2br($followup['remarks']).'</td>';
			$str .= '<td class="text-center">'.$customer.'</td>';
			if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){
				$str .= '<td>'.$this->general_model->_get_user($followup['followup_by'])['name'].'</td>';
			}
			$str .= '</tr>';
			$string .= $str;
		}
		if($cus > 0){
			$cus = "1";
		}else{
			$cus = "";
		}
		echo json_encode([$string,$cus]);
	}

	public function save()
	{
		if($this->input->post('ftime') != ""){
			$ftime = timeConverter($this->input->post('ftime'));
		}else{
			$ftime = null;
		}

		if($this->input->post('ttime') != ""){
			$ttime = timeConverter($this->input->post('ttime'));
		}else{
			$ttime = null;
		}
		$data = [
			'remarks'		=> $this->input->post('remarks'),
			'next_f'		=> dd($this->input->post('date')),
			'customer'		=> $this->input->post('cus'),
			'date'			=> date('Y-m-d H:i:s'),
			'ftime'			=> $ftime,
			'ttime'			=> $ttime,
			'type'			=> $this->input->post('type'),
			'main_id'		=> $this->input->post('id'),
			'followup_by'	=> $this->session->userdata('id')
		];
		$this->db->insert('followup',$data);
		$fId = $this->db->insert_id();

		$status = $this->input->post('cus') == '1'?1:0;
		$this->db->where('id',$this->input->post('id'))->update('leads',['next_followup_date' => dd($this->input->post('date')),'tfrom'	=> $ftime,'tto' => $ttime,'status'	=> $status,'fstatus' => 0]);


		$followup = $this->db->get_where('followup',['id' => $fId])->row_array();
		$customer = $followup['customer'] == '1'?'Yes':'No';
		$str = '<tr>';
			$str .= '<td class="text-center">'.vd($followup['next_f']).get_from_to($followup['ftime'],$followup['ttime']).'</td>';
			$str .= '<td class="text-center">'._vdatetime($followup['date']).'</td>';
			$str .= '<td>'.nl2br($followup['remarks']).'</td>';
			$str .= '<td class="text-center">'.$customer.'</td>';
			if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){
				$str .= '<td>'.$this->general_model->_get_user($followup['followup_by'])['name'].'</td>';
			}
		$str .= '</tr>';


		$lead = $this->db->get_where('leads',['id' => $this->input->post('id')])->row_array();
		$date_str = vd($lead['next_followup_date']).get_from_to($lead['tfrom'],$lead['tto']);
		echo json_encode([$str,$date_str]);


		if($this->input->post('cus') == '1'){
			$lead = $this->general_model->_get_lead($this->input->post('id'));
			$source = $this->general_model->_get_source($lead['source']);

			$client_count = $this->db->get_where('client',['branch' => $lead['branch']])->num_rows();
			$branch = $this->general_model->_get_branch($lead['branch']);
			$data = [
				'c_id'				=> $branch['code'].getClientId($client_count + 1),
				'lead'				=> $this->input->post('id'),
				'group'				=> "GROUP_".$branch['code'].getClientId($client_count + 1),
				'company'			=> $source['company'],
				'branch'			=> $lead['branch'],
				'fname'				=> strtoupper($lead['customer']),
				'created_by'		=> get_user()['id'],
				'created_at'		=> date('Y-m-d H:i:s'),
				'owner'				=> $lead['owner'],
				'status'			=> 1
			];
			$this->db->insert('client',$data);
			$clientId = $this->db->insert_id();

			$lead = $this->general_model->_get_lead($this->input->post('id'));


			foreach (json_decode($lead['services']) as $key => $value) {
				$qty = 1;
				$amount = $value[1];
				$service = $value[0];

				$this->db->order_by('rand()');
			    $this->db->limit(1);
			    $this->db->where('user_type','2');
			    $this->db->where('type !=','3');
			    $this->db->where('df','');
			    $user = $this->db->get('user')->row_array();

			    $data = [
					'branch'		=> $lead['branch'],
					'service'		=> $service,
					'price'			=> $amount,
					'qty'			=> $qty,
					'client'		=> $clientId,
					'status'		=> 0,
					'owner'			=> $user['id'],
					'importance'	=> 'NORMAL',
					'f_date'		=> null,
					'f_time'		=> null,
					'created_by'	=> get_user()['id'],
					'created_at'		=> date('Y-m-d H:i:s')
				];
				$this->db->insert('job',$data);
				$job_id = $this->db->insert_id();
				$this->db->where('id',$job_id)->update('job',['job_id' => "JOB_".$job_id]);	
			}
		}
	}

	public function save_lead()
	{
		if($this->input->post('ftime') != ""){
			$ftime = timeConverter($this->input->post('ftime'));
		}else{
			$ftime = null;
		}

		if($this->input->post('ttime') != ""){
			$ttime = timeConverter($this->input->post('ttime'));
		}else{
			$ttime = null;
		}

		$cus = 0;
		if($this->input->post('customer')){
			$cus = 1;
		}

		$data = [
			'remarks'		=> $this->input->post('remarks'),
			'next_f'		=> dd($this->input->post('date')),
			'customer'		=> $cus,
			'date'			=> date('Y-m-d H:i:s'),
			'ftime'			=> $ftime,
			'ttime'			=> $ttime,
			'type'			=> 'lead',
			'main_id'		=> $this->input->post('id'),
			'followup_by'	=> $this->session->userdata('id')
		];
		$this->db->insert('followup',$data);
		$fId = $this->db->insert_id();

		$status = $cus;
		$this->db->where('id',$this->input->post('id'))->update('leads',['next_followup_date' => dd($this->input->post('date')),'tfrom'	=> $ftime,'tto' => $ttime,'status'	=> $status,'fstatus' => 0]);


		$followup = $this->db->get_where('followup',['id' => $fId])->row_array();


		if($cus == '1'){
			$lead = $this->general_model->_get_lead($this->input->post('id'));
			$source = $this->general_model->_get_source($lead['source']);

			$client_count = $this->db->get_where('client',['branch' => $lead['branch']])->num_rows();
			$branch = $this->general_model->_get_branch($lead['branch']);
			$data = [
				'c_id'				=> $branch['code'].getClientId($client_count + 1),
				'lead'				=> $this->input->post('id'),
				'group'				=> "GROUP_".$branch['code'].getClientId($client_count + 1),
				'company'			=> $source['company'],
				'branch'			=> $lead['branch'],
				'fname'				=> strtoupper($lead['customer']),
				'created_by'		=> get_user()['id'],
				'created_at'		=> date('Y-m-d H:i:s'),
				'owner'				=> $lead['owner'],
				'status'			=> 1
			];
			$this->db->insert('client',$data);
			$clientId = $this->db->insert_id();

			$lead = $this->general_model->_get_lead($this->input->post('id'));


			foreach (json_decode($lead['services']) as $key => $value) {
				$qty = 1;
				$amount = $value[1];
				$service = $value[0];

				$this->db->order_by('rand()');
			    $this->db->limit(1);
			    $this->db->where('user_type','2');
			    $this->db->where('type !=','3');
			    $this->db->where('df','');
			    $user = $this->db->get('user')->row_array();

			    $data = [
					'branch'		=> $lead['branch'],
					'service'		=> $service,
					'price'			=> $amount,
					'qty'			=> $qty,
					'client'		=> $clientId,
					'status'		=> 0,
					'owner'			=> $user['id'],
					'importance'	=> 'NORMAL',
					'f_date'		=> null,
					'f_time'		=> null,
					'created_by'	=> get_user()['id'],
					'created_at'		=> date('Y-m-d H:i:s')
				];
				$this->db->insert('job',$data);
				$job_id = $this->db->insert_id();
				$this->db->where('id',$job_id)->update('job',['job_id' => "JOB_".$job_id]);	
			}
		}


		$this->session->set_flashdata('msg', 'Followup Added');
	    redirect(base_url('leads/view/'.$this->input->post('id')));
	}

	public function save_newwork()
	{
		if($this->input->post('from') != ""){
			$from = timeConverter($this->input->post('from'));
		}else{
			$from = null;
		}

		if($this->input->post('to') != ""){
			$to = timeConverter($this->input->post('to'));
		}else{
			$to = null;
		}

		if($this->input->post('date') != ""){
			$date = dd($this->input->post('date'));
		}else{
			$date = null;
		}

		$cus = 0;
		if($this->input->post('customer')){
			$cus = 1;
		}

		$data = [
			'remarks'		=> $this->input->post('remarks'),
			'next_f'		=> $date,
			'customer'		=> $cus,
			'date'			=> date('Y-m-d H:i:s'),
			'ftime'			=> $from,
			'ttime'			=> $to,
			'type'			=> 'newWork',
			'main_id'		=> $this->input->post('id'),
			'followup_by'	=> $this->session->userdata('id')
		];
		$this->db->insert('followup',$data);

		$status = $cus;
		$this->db->where('id',$this->input->post('id'))->update('newjob',['fdate' => $date,'from'	=> $from,'to' => $to,'status'	=> $status]);

		if($cus == 1){
			$newWork = $this->db->get_where('newjob',['id' => $this->input->post('id')])->row_array();
			$qty = 1;
			$amount = $newWork['price'];
			$service = $newWork['service'];

			$this->db->order_by('rand()');
		    $this->db->limit(1);
		    $this->db->where('user_type','2');
		    $this->db->where('type !=','3');
		    $this->db->where('df','');
		    $user = $this->db->get('user')->row_array();

		    $data = [
				'branch'		=> $newWork['branch'],
				'service'		=> $service,
				'price'			=> $amount,
				'qty'			=> $qty,
				'client'		=> $newWork['client'],
				'status'		=> 0,
				'owner'			=> $user['id'],
				'importance'	=> 'NORMAL',
				'f_date'		=> null,
				'f_time'		=> null,
				'created_by'	=> get_user()['id'],
				'created_at'		=> date('Y-m-d H:i:s')
			];
			$this->db->insert('job',$data);
			$job_id = $this->db->insert_id();
			$this->db->where('id',$job_id)->update('job',['job_id' => "JOB_".$job_id]);	
		}

		$this->session->set_flashdata('msg', 'Followup Added');
	    redirect(base_url('newjob/view/'.$this->input->post('id')));
	}

	public function saveJob()
	{	
		$customer = 0;
		if($this->input->post('status') == "5"){
			$customer = 1;
		}

		if($this->input->post('ftime') != ""){
			$ftime = timeConverter($this->input->post('ftime'));
		}else{
			$ftime = null;
		}

		if($this->input->post('ttime') != ""){
			$ttime = timeConverter($this->input->post('ttime'));
		}else{
			$ttime = null;
		}
		if($this->input->post('needed') == 1){
			$ndate = dd($this->input->post('date'));
		}else{
			$ndate = null;
		}
		$data = [
			'remarks'		=> $this->input->post('remarks'),
			'next_f'		=> $ndate,
			'customer'		=> 0,
			'date'			=> date('Y-m-d H:i:s'),
			'ftime'			=> $ftime,
			'ttime'			=> $ttime,
			'type'			=> $this->input->post('type'),
			'main_id'		=> $this->input->post('id'),
			'needed'		=> $this->input->post('needed'),
			'followup_by'	=> $this->session->userdata('id')
		];
		$this->db->insert('followup',$data);
		$fId = $this->db->insert_id();

		$status = $this->input->post('status');
		$fstatus = 1;
		if($ndate != null){
			$fstatus = 0;
		}
		$this->db->where('id',$this->input->post('id'))->update('job',['f_date' => $ndate,'f_time'	=> $ftime,'t_time' => $ttime,'status'	=> $status,'fstatus'	=> $fstatus]);


		$followup = $this->db->get_where('followup',['id' => $fId])->row_array();
		$customer = $followup['customer'] == '1'?'Yes':'No';
		$needed = $followup['needed'] == '1'?'Yes':'No';
		$str = '<tr>';
			$str .= '<td class="text-center">'.followupVD($followup['next_f']).get_from_to($followup['ftime'],$followup['ttime']).'</td>';
			$str .= '<td class="text-center">'._vdatetime($followup['date']).'</td>';
			$str .= '<td>'.nl2br($followup['remarks']).'</td>';
			$str .= '<td class="text-center">'.$customer.'</td>';
			$str .= '<td class="text-center">'.$needed.'</td>';
			if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){
				$str .= '<td>'.$this->general_model->_get_user($followup['followup_by'])['name'].'</td>';
			}
		$str .= '</tr>';


		
		$status = getjobStatus($this->input->post('status'));
		$date_str = vd($ndate).get_from_to($ftime,$ttime);
		echo json_encode([$str,$status,$date_str]);
	}

	public function job_get()
	{
		$followups = $this->db->order_by('id','desc')->get_where('followup',['main_id' => $this->input->post('id'),'type' => $this->input->post('type')])->result_array();
		$string = '';
		$cus = 0;
		foreach ($followups as $key => $followup) {
			$customer = $followup['customer'] == '1'?'Yes':'No';
			$needed = $followup['needed'] == '1'?'Yes':'No';
			if($followup['customer'] == 1){
				$cus++;
			}
			$str = '<tr>';
			$str .= '<td class="text-center">'.followupVD($followup['next_f']).get_from_to($followup['ftime'],$followup['ttime']).'</td>';
			$str .= '<td class="text-center">'._vdatetime($followup['date']).'</td>';
			$str .= '<td>'.nl2br($followup['remarks']).'</td>';
			$str .= '<td class="text-center">'.$customer.'</td>';
			$str .= '<td class="text-center">'.$needed.'</td>';
			if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){
				$str .= '<td>'.$this->general_model->_get_user($followup['followup_by'])['name'].'</td>';
			}
			$str .= '</tr>';
			$string .= $str;
		}
		if($cus > 0){
			$cus = "1";
		}else{
			$cus = "";
		}
		echo json_encode([$string,$cus]);
	}

	public function payment_get()
	{
		$followups = $this->db->order_by('id','desc')->get_where('followup',['main_id' => $this->input->post('id'),'type' => "payment"])->result_array();
		$string = '';
		foreach ($followups as $key => $followup) {
			$str = '<tr>';
			$str .= '<td class="text-center">'.followupVD($followup['next_f']).get_from_to($followup['ftime'],$followup['ttime']).'</td>';
			$str .= '<td class="text-center">'._vdatetime($followup['date']).'</td>';
			$str .= '<td>'.nl2br($followup['remarks']).'</td>';
			$str .= '<td class="text-center">NO</td>';
			if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){
				$str .= '<td>'.$this->general_model->_get_user($followup['followup_by'])['name'].'</td>';
			}
			$str .= '</tr>';
			$string .= $str;
		}
		echo json_encode([$string]);
	}

	public function payment_save()
	{
		
		$ndate = dd($this->input->post('date'));
		
		$data = [
			'remarks'		=> $this->input->post('remarks'),
			'next_f'		=> $ndate,
			'customer'		=> 0,
			'date'			=> date('Y-m-d H:i:s'),
			'ftime'			=> null,
			'ttime'			=> null,
			'type'			=> $this->input->post('type'),
			'main_id'		=> $this->input->post('id'),
			'followup_by'	=> $this->session->userdata('id')
		];
		$this->db->insert('followup',$data);
		$fId = $this->db->insert_id();

		if($this->input->post('cus') == 1){
			$done = 1;
		}else{
			$done = 0;
		}
		$this->db->where('id',$this->input->post('id'))->update('invoice',['fdate' => $ndate,'done'	=> $done]);


		$followup = $this->db->get_where('followup',['id' => $fId])->row_array();
		$str = '<tr>';
			$str .= '<td class="text-center">'.followupVD($followup['next_f']).get_from_to($followup['ftime'],$followup['ttime']).'</td>';
			$str .= '<td class="text-center">'._vdatetime($followup['date']).'</td>';
			$str .= '<td>'.nl2br($followup['remarks']).'</td>';
			$str .= '<td class="text-center">NO</td>';
			if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){
				$str .= '<td>'.$this->general_model->_get_user($followup['followup_by'])['name'].'</td>';
			}
		$str .= '</tr>';


		
		echo json_encode([$str]);
	}

	public function getNotifications()
	{
		$array = []; $strArray = ""; $leadcounter = 0;
		if(get_user()['user_type'] == "3"){
			$this->db->where('owner',get_user()['id']);
			$this->db->where('df','');
			$this->db->where('fstatus',0);
			$this->db->where('status',0);
			$this->db->where('date',date('Y-m-d'));
			$this->db->where('tfrom <=',date('H:i:s'));
			$data = $this->db->get('leads')->result_array();
			foreach ($data as $key => $value) {
				if($value['tfrom'] != null){
					$desc = "Followup At ".vt($value['tfrom']);
				}else{
					$desc = "New Followup";
				}
				$ar = [
					'title'	=> "#".$value['lead'],
					'desc'	=> $desc,
					'url'	=> base_url('followup/lead')
				];
				array_push($array, $ar);
				$this->db->where('id',$value['id'])->update('leads',['fstatus' => 1]);
			}

			
			foreach ($data as $key => $value) {
				$leadcounter++;
				if($value['tfrom'] != null){
					$desc = "Followup At ".vt($value['tfrom']);
				}else{
					$desc = "New Followup";
				}
				$url = base_url('followup/lead');
				$list = "";
	    		$list .= "<li onclick='redirectUrl(".'"'.$url.'"'.");'><div class='media'>";
                    $list .= '<div class="media-body">';
                        $list .= '<h5 class="notification-user">'."#".$value['lead'].'</h5>';
                        $list .= '<p class="notification-msg">'.$desc.'</p>';
                        $list .= '<span class="notification-time timeago" date="'.date('Y-m-d H:i:s').'">'.time_elapsed_string(date('Y-m-d H:i:s')).'</span>';
                    $list .= '</div>';
                $list .= '</div></li>';
    			$list .= '<div class="dropdown-divider"></div>';
				$strArray .= $list;
				$this->db->where('id',$value['id'])->update('leads',['fstatus' => 1]);
			}			
		}

		if(get_user()['user_type'] == "2" || get_user()['user_type'] == "0"){
			$this->db->where('owner',get_user()['id']);
			$this->db->where('status <',3);
			$this->db->where('fstatus',0);
			$this->db->where('f_date',date('Y-m-d'));
			$this->db->where('f_time <=',date('H:i:s'));
			$data = $this->db->get('job')->result_array();
			foreach ($data as $key => $value) {
				if($value['f_time'] != null){
					$desc = "Followup At ".vt($value['f_time']);
				}else{
					$desc = "New Followup";
				}
				$ar = [
					'title'	=> "#".$value['job_id'],
					'desc'	=> $desc,
					'url'	=> base_url('job')
				];
				array_push($array, $ar);
				$this->db->where('id',$value['id'])->update('job',['fstatus' => 1]);
			}

			foreach ($data as $key => $value) {
				$leadcounter++;
				if($value['f_time'] != null){
					$desc = "Followup At ".vt($value['f_time']);
				}else{
					$desc = "New Followup";
				}
				$url = base_url('job');
				$list = "";
	    		$list .= "<li onclick='redirectUrl(".'"'.$url.'"'.");'><div class='media'>";
                    $list .= '<div class="media-body">';
                        $list .= '<h5 class="notification-user">'."#".$value['job_id'].'</h5>';
                        $list .= '<p class="notification-msg">'.$desc.'</p>';
                        $list .= '<span class="notification-time timeago" date="'.date('Y-m-d H:i:s').'">'.time_elapsed_string(date('Y-m-d H:i:s')).'</span>';
                    $list .= '</div>';
                $list .= '</div></li>';
    			$list .= '<div class="dropdown-divider"></div>';
				$strArray .= $list;
				$this->db->where('id',$value['id'])->update('job',['fstatus' => 1]);
			}			
		}

		if(get_user()['user_type'] == "3"){
			$this->db->where('owner',get_user()['id']);
			$this->db->where('fstatus',0);
			$this->db->where('status',0);
			$this->db->where('fdate <=',date('Y-m-d'));
			$this->db->where('from <=',date('H:i:s'));
			$data = $this->db->get('newjob')->result_array();
			foreach ($data as $key => $value) {
				if($value['from'] != null){
					$desc = "Followup At ".vt($value['from']);
				}else{
					$desc = "New Followup";
				}
				$ar = [
					'title'	=> "#NEW_WORK_".$value['id'],
					'desc'	=> $desc,
					'url'	=> base_url('newjob')
				];
				array_push($array, $ar);
				$this->db->where('id',$value['id'])->update('newjob',['fstatus' => 1]);
			}

			
			foreach ($data as $key => $value) {
				$leadcounter++;
				if($value['from'] != null){
					$desc = "Followup At ".vt($value['from']);
				}else{
					$desc = "New Followup";
				}
				$url = base_url('newjob');
				$list = "";
	    		$list .= "<li onclick='redirectUrl(".'"'.$url.'"'.");'><div class='media'>";
                    $list .= '<div class="media-body">';
                        $list .= '<h5 class="notification-user">'."#NEW_WORK_".$value['id'].'</h5>';
                        $list .= '<p class="notification-msg">'.$desc.'</p>';
                        $list .= '<span class="notification-time timeago" date="'.date('Y-m-d H:i:s').'">'.time_elapsed_string(date('Y-m-d H:i:s')).'</span>';
                    $list .= '</div>';
                $list .= '</div></li>';
    			$list .= '<div class="dropdown-divider"></div>';
				$strArray .= $list;
				$this->db->where('id',$value['id'])->update('newjob',['fstatus' => 1]);
			}			
		}

		echo json_encode([$array,$strArray,$leadcounter]);
	}

	public function getTodoNotification()
	{
		$this->db->where('to',get_user()['id']);
		$this->db->where('status',0);
		$this->db->where('fstatus',0);
		$this->db->where('date',date('Y-m-d'));
		$this->db->where('ftime <=',date('H:i:s'));
		$data = $this->db->get('todo')->result_array();
		$array = []; $strArray = ""; $todocounter = 0;
		foreach ($data as $key => $value) {
			if($value['ftime'] != null){
				$desc = "Task At ".vt($value['ftime']);
			}else{
				$desc = "New Task";
			}
			$ar = [
				'title'	=> $desc,
				'desc'	=> $value['remarks'],
				'url'	=> base_url('todo')
			];
			array_push($array, $ar);
			$this->db->where('id',$value['id'])->update('todo',['fstatus' => 1]);
		}

		foreach ($data as $key => $value) {
			$todocounter++;
			if($value['ftime'] != null){
				$desc = "Task At ".vt($value['ftime']);
			}else{
				$desc = "New Task";
			}
			$url = base_url('todo');
			$list = "";
    		$list .= "<li onclick='redirectUrl(".'"'.$url.'"'.");'><div class='media'>";
                $list .= '<div class="media-body">';
                    $list .= '<h5 class="notification-user">'.$desc.'</h5>';
                    $list .= '<p class="notification-msg">'.$value['remarks'].'</p>';
                    $list .= '<span class="notification-time timeago" date="'.date('Y-m-d H:i:s').'">'.time_elapsed_string(date('Y-m-d H:i:s')).'</span>';
                $list .= '</div>';
            $list .= '</div></li>';
			$list .= '<div class="dropdown-divider"></div>';
			$strArray .= $list;
			$this->db->where('id',$value['id'])->update('todo',['fstatus' => 1]);
		}		
		echo json_encode([$array,$strArray,$todocounter]);
	}
}


