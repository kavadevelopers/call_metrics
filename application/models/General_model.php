<?php
class General_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function get_setting()
	{
		return $this->db->get_where('setting',['id' => '1'])->row_array();
	}

	public function get_company($id)
	{
		return $this->db->get_where('company',['id'	=> $id,'df' => ''])->row_array();
	}

	public function _get_company($id)
	{
		return $this->db->get_where('company',['id'	=> $id])->row_array();
	}

	public function list_company()
	{
		return $this->db->get_where('company',['df' => ''])->result_array();
	}

	public function get_source($id)
	{
		return $this->db->get_where('source',['id'	=> $id,'df' => ''])->row_array();
	}

	public function _get_source($id)
	{
		return $this->db->get_where('source',['id'	=> $id])->row_array();
	}

	public function get_branch($id)
	{
		return $this->db->get_where('branch',['id'	=> $id,'df' => ''])->row_array();
	}

	public function _get_branch($id)
	{
		return $this->db->get_where('branch',['id'	=> $id])->row_array();
	}

	public function get_branches()
	{
		return $this->db->get_where('branch',['df'	=> ''])->result_array();
	}

	public function get_services()
	{
		return $this->db->get_where('services',['df'	=> ''])->result_array();
	}

	public function get_service($id)
	{
		return $this->db->get_where('services',['id'	=> $id,'df' => ''])->row_array();
	}

	public function _get_service($id)
	{
		return $this->db->get_where('services',['id'	=> $id])->row_array();
	}

	public function get_user($id)
	{
		return $this->db->get_where('user',['id'	=> $id,'df' => ''])->row_array();
	}

	public function _get_user($id)
	{
		return $this->db->get_where('user',['id'	=> $id])->row_array();
	}

	public function get_users()
	{
		return $this->db->get_where('user',['df' => '','user_type !=' => '0'])->result_array();
	}

	public function get_lead_owners()
	{
		if(get_user()['user_type'] == '1'){
			return $this->db->get_where('user',['df' => '','branch' => get_user()['branch'],'user_type' => '3'])->result_array();
		}else if(get_user()['user_type'] == '3'){
			return $this->db->get_where('user',['df' => '','branch' => get_user()['branch'],'user_type' => '3','id !=' => get_user()['id']])->result_array();
		}else{
			$this->db->group_start();
				$this->db->or_where('user_type',"1");
				$this->db->or_where('user_type',"3");
			$this->db->group_end();
			return $this->db->get_where('user',['df' => ''])->result_array();
		}
	}

	public function get_todo_users()
	{
		if(get_user()['user_type'] == '0'){
			return $this->db->get_where('user',['df' => ''])->result_array();
		}
		else if(get_user()['user_type'] == '1'){
			return $this->db->get_where('user',['df' => '','branch' => get_user()['branch']])->result_array();
		}
		else if(get_user()['user_type'] == '2'){
			if(get_user()['type'] == '1'){
				return $this->db->get_where('user',['df' => '','branch' => get_user()['branch'],'type >' => 1 ])->result_array();
			}else if(get_user()['type'] == '2'){
				return $this->db->get_where('user',['df' => '','branch' => get_user()['branch'],'type >' => 2 ])->result_array();
			}else{
				return [];
			}
		}
		else if(get_user()['user_type'] == '3'){
			return [];
		}
	}

	public function get_task_users()
	{
		return $this->db->get_where('user',['df' => '','id !=' => get_user()['id']])->result_array();
	}

	public function get_job_owners()
	{
		if(get_user()['user_type'] == '1'){
			return $this->db->get_where('user',['df' => '','branch' => get_user()['branch'],'user_type' => '2'])->result_array();
		}else{
			$this->db->where_in('user_type',['2','0']);
			return $this->db->get_where('user',['df' => ''])->result_array();
		}
	}

	public function get_industry($id)
	{
		return $this->db->get_where('industry',['id'	=> $id,'df' => ''])->row_array();
	}

	public function _get_industry($id)
	{
		return $this->db->get_where('industry',['id'	=> $id])->row_array();
	}

	public function list_industries()
	{
		return $this->db->order_by('id','asc')->get_where('industry',['df' => ''])->result_array();
	}

	public function get_subindustry($id)
	{
		return $this->db->get_where('sub_industry',['id'	=> $id,'df' => ''])->row_array();
	}

	public function _get_subindustry($id)
	{
		return $this->db->get_where('sub_industry',['id'	=> $id])->row_array();
	}

	public function list_subindustry()
	{
		return $this->db->get_where('sub_industry',['df' => ''])->result_array();
	}

	public function get_state($id)
	{
		return $this->db->get_where('area_state',['id'	=> $id,'df' => ''])->row_array();
	}

	public function get_states()
	{
		return $this->db->get_where('area_state',['df' => ''])->result_array();
	}

	public function list_state()
	{
		return $this->db->order_by('id','asc')->get_where('area_state',['df' => ''])->result_array();
	}

	public function _get_state($id)
	{
		return $this->db->get_where('area_state',['id'	=> $id])->row_array();
	}

	public function get_cities()
	{
		return $this->db->get_where('area_city',['df' => ''])->result_array();
	}

	public function get_city($id)
	{
		return $this->db->get_where('area_city',['id'	=> $id,'df' => ''])->row_array();
	}

	public function list_city()
	{
		return $this->db->order_by('id','asc')->get_where('area_city',['df' => ''])->result_array();
	}

	public function _get_city($id)
	{
		return $this->db->get_where('area_city',['id'	=> $id])->row_array();
	}

	public function get_districts()
	{
		return $this->db->get_where('district',['df' => ''])->result_array();
	}

	public function get_district($id)
	{
		return $this->db->get_where('district',['id'	=> $id,'df' => ''])->row_array();
	}

	public function list_district()
	{
		return $this->db->order_by('id','asc')->get_where('district',['df' => ''])->result_array();
	}

	public function _get_district($id)
	{
		return $this->db->get_where('district',['id'	=> $id])->row_array();
	}

	public function get_area($id)
	{
		return $this->db->get_where('areas',['id'	=> $id,'df' => ''])->row_array();
	}

	public function _get_area($id)
	{
		return $this->db->get_where('areas',['id'	=> $id])->row_array();
	}

	public function get_areas()
	{
		return $this->db->get_where('areas',['df' => ''])->result_array();
	}

	public function get_sources()
	{
		return $this->db->get_where('source',['df' => ''])->result_array();
	}

	public function get_lead($id)
	{
		return $this->db->get_where('leads',['id'	=> $id,'df' => ''])->row_array();	
	}

	public function _get_lead($id)
	{
		return $this->db->get_where('leads',['id'	=> $id])->row_array();	
	}

	public function get_client_types()
	{
		return $this->db->get_where('client_type',['df' => ''])->result_array();
	}

	public function _get_client_type($id)
	{
		return $this->db->get_where('client_type',['id' => $id])->row_array();
	}

	public function get_folder_name()
	{
		return $this->db->get_where('document_folders',['df'	=> ''])->result_array();
	}


	public function _get_doc_folder($id)
	{
		return $this->db->get_where('document_folders',['id'	=> $id])->row_array();
	}

	public function _get_doc_subfolder($id)
	{
		return $this->db->get_where('document_sub_folders',['id'	=> $id])->row_array();
	}

	public function _get_documents_by_folder($folder,$client)
	{
		return $this->db->get_where('documents',['folder'	=> $folder,'client' => $client])->result_array();
	}

	public function _get_documents_by_subfolder($folder,$client)
	{
		return $this->db->get_where('documents',['sub_folder'	=> $folder,'client' => $client])->result_array();
	}

	public function get_clients()
	{
		if(get_user()['user_type'] == 0){
			return $this->db->get_where('client',['status' => '0'])->result_array();
		}
		else if(get_user()['user_type'] == 3){
			return $this->db->get_where('client',['status' => '0','owner' => get_user()['id']])->result_array();
		}else{
			return $this->db->get_where('client',['branch' => get_user()['branch'],'status' => '0'])->result_array();
		}
	}

	public function get_cancel_clients()
	{
		if(get_user()['user_type'] == 0){
			return $this->db->get_where('client',['status' => '9'])->result_array();
		}else if(get_user()['user_type'] == 3){
			return $this->db->get_where('client',['status' => '9','owner' => get_user()['id']])->result_array();
		}else{
			return $this->db->get_where('client',['branch' => get_user()['branch'],'status' => '9'])->result_array();
		}
	}

	public function get_inactive_clients()
	{
		if(get_user()['user_type'] == 0){
			return $this->db->get_where('client',['status' => '8'])->result_array();
		}else if(get_user()['user_type'] == 3){
			return $this->db->get_where('client',['status' => '8','owner' => get_user()['id']])->result_array();
		}else{
			return $this->db->get_where('client',['branch' => get_user()['branch'],'status' => '8'])->result_array();
		}
	}

	public function getFilteredClients()
	{
		if(get_user()['user_type'] == 0 || get_user()['user_type'] == 2){
			return $this->db->get_where('client',['status' => '0'])->result_array();
		}else if(get_user()['user_type'] == 1){
			return $this->db->get_where('client',['branch' => get_user()['branch'],'status' => '0'])->result_array();
		}else if(get_user()['user_type'] == 3){
			return $this->db->get_where('client',['status' => '0','owner' => get_user()['id']])->result_array();
		}
	}

	public function _get_client($id)
	{
		return $this->db->get_where('client',['id' => $id])->row_array();
	}

	public function _get_invoice($id)
	{
		return $this->db->get_where('invoice',['id' => $id])->row_array();
	}

	public function _get_payment($id)
	{
		return $this->db->get_where('payment',['id' => $id])->row_array();
	}

	public function get_new_work($id)
	{
		return $this->db->get_where('newjob',['id' => $id])->row_array();
	}

	public function get_jobs()
	{
		$myId = get_user()['id'];
		$myBranch = get_user()['branch'];
		if(get_user()['user_type'] == 0){
			$this->db->order_by('status','asc');
			return $this->db->get_where('job',['status <' => 3])->result_array();
		}else if(get_user()['user_type'] == 1){
			$this->db->order_by('status','asc');
			return $this->db->get_where('job',['branch' => $myBranch,'status <' => 3])->result_array();	
		}else{
			$this->db->order_by('status','asc');
			return $this->db->get_where('job',['owner' => $myId,'status <' => 3])->result_array();
		}
	}

	public function get_fjobs()
	{
		$myId = get_user()['id'];
		$myBranch = get_user()['branch'];
		if(get_user()['user_type'] == 0){
			$this->db->order_by('fdate','asc');
			return $this->db->get_where('newjob',['status' => 0])->result_array();
		}else if(get_user()['user_type'] == 1){
			$this->db->order_by('fdate','asc');
			return $this->db->get_where('newjob',['branch' => $myBranch,'status' => 0])->result_array();	
		}else{
			$this->db->order_by('fdate','asc');
			return $this->db->get_where('newjob',['owner' => $myId,'status' => 0])->result_array();
		}
	}

	public function get_workDone()
	{
		$myId = get_user()['id'];
		$myBranch = get_user()['branch'];
		if(get_user()['user_type'] == 0){
			$this->db->order_by('status','asc');
			return $this->db->get_where('job',['status' => 3])->result_array();
		}else if(get_user()['user_type'] == 1){
			$this->db->order_by('status','asc');
			return $this->db->get_where('job',['branch' => $myBranch,'status' => 3])->result_array();
		}else{
			$this->db->order_by('status','asc');
			return $this->db->get_where('job',['owner' => $myId,'status' => 3])->result_array();
		}
	}

	public function get_PaidJob()
	{
		$myId = get_user()['id'];
		$myBranch = get_user()['branch'];
		if(get_user()['user_type'] == 0){
			$this->db->order_by('status','asc');
			return $this->db->get_where('job',['status' => 5])->result_array();
		}else if(get_user()['user_type'] == 1){
			$this->db->order_by('status','asc');
			return $this->db->get_where('job',['branch' => $myBranch,'status' => 5])->result_array();
		}else{
			$this->db->order_by('status','asc');
			return $this->db->get_where('job',['owner' => $myId,'status' => 5])->result_array();
		}
	}

	public function get_BilledJob()
	{
		$myId = get_user()['id'];
		$myBranch = get_user()['branch'];
		if(get_user()['user_type'] == 0){
			$this->db->order_by('status','asc');
			return $this->db->get_where('job',['status' => 4])->result_array();
		}else if(get_user()['user_type'] == 1){
			$this->db->order_by('status','asc');
			return $this->db->get_where('job',['branch' => $myBranch,'status' => 4])->result_array();
		}else{
			$this->db->order_by('status','asc');
			return $this->db->get_where('job',['owner' => $myId,'status' => 4])->result_array();
		}
	}

	public function getInvoices()
	{
		if(get_user()['user_type'] == 0 || get_user()['user_type'] == 2){
			return $this->db->order_by('id','desc')->get_where('invoice')->result_array();	
		}else if(get_user()['user_type'] == 1){
			return $this->db->order_by('id','desc')->get_where('invoice',['branch' => get_user()['branch']])->result_array();	
		}else if(get_user()['user_type'] == 3){
			$clients = $this->db->get_where('client',['owner' => get_user()['id']])->result_array();
			$cli = [];
			foreach ($clients as $key => $value) {
				array_push($cli, $value['id']);
			}
			$this->db->where_in('client',$cli);
			return $this->db->order_by('id','desc')->get_where('invoice')->result_array();	
		}
	}

	public function getPayments()
	{
		if(get_user()['user_type'] == 0 || get_user()['user_type'] == 2){
			return $this->db->order_by('id','desc')->get_where('payment')->result_array();	
		}else if(get_user()['user_type'] == 1){
			return $this->db->order_by('id','desc')->get_where('payment',['branch' => get_user()['branch']])->result_array();	
		}else if(get_user()['user_type'] == 3){
			$clients = $this->db->get_where('client',['owner' => get_user()['id']])->result_array();
			$cli = [];
			foreach ($clients as $key => $value) {
				array_push($cli, $value['id']);
			}
			$this->db->where_in('client',$cli);
			return $this->db->order_by('id','desc')->get_where('payment')->result_array();	
		}
	}

	public function getToDo()
	{
		$myId = get_user()['id'];
		$this->db->order_by('date','asc');
		$this->db->group_start();
			$this->db->where('to',$myId);
			$this->db->or_where('from',$myId);
		$this->db->group_end();
		return $this->db->get('todo')->result_array();
	}

	public function getDashbordTask()
	{
		$myId = get_user()['id'];
		$this->db->limit(5);
		$this->db->order_by('id','desc');
		$this->db->where('done',"0");
		$this->db->group_start();
			$this->db->where('to',$myId);
			$this->db->or_where('from',$myId);
		$this->db->group_end();
		return $this->db->get('task')->result_array();
	}

	public function getOutStandingClient($client_id)
	{
		$query = $this->db->select_sum('credit')->from('transaction')->where('client', $client_id)->get();
		$ocredit = $query->row()->credit;

		$query = $this->db->select_sum('debit')->from('transaction')->where('client', $client_id)->get();
		$odebit = $query->row()->debit;


		if($odebit > $ocredit){
			$tra = $this->db->order_by('id','desc')->get_where('transaction',['client' => $client_id,'type' => invoice()])->row_array();
			$days = daysBeetweenDates($tra['date']);
			return [number_format($odebit - $ocredit,2),$days];
		}else if($odebit < $ocredit){
			$tra = $this->db->order_by('id','desc')->get_where('transaction',['client' => $client_id,'type' => payment()])->row_array();
			$days = daysBeetweenDates($tra['date']);
			return [number_format($odebit - $ocredit ,2),$days];
		}else{
			return [0,0];
		}
	}


	public function getSubFolders($id)
	{
		$this->db->select('name,id');
		$folders = $this->db->get_where('document_sub_folders',['main' => $id])->result_array();
		return htmlspecialchars(json_encode($folders), ENT_QUOTES, 'UTF-8');
	}

	public function getTotalLeadBySales($user)
	{
		$total = $this->db->get_where('leads',['owner' => $user])->num_rows();
		$month = $this->db->get_where('leads',['owner' => $user,'date >=' => date('Y-m-1'),'date <=' => date('Y-m-t')])->num_rows();
		return [$total,$month];
	}

	public function newClientsNumAmount()
	{
		$clients = $this->db->get_where('client',['created_at >=' => date("Y-m-1"),'created_at <=' => date("Y-m-t")]);
		$count_client = $clients->num_rows();
		$amount = 0;
		foreach ($clients->result_array() as $key => $value) {
			$jobs = $this->db->get_where('job',['client' => $value['id']])->result_array();
			foreach ($jobs as $jkey => $jvalue) {
				$amount += $jvalue['price'] * $jvalue['qty'];
			}
		}
		return [$count_client,$amount];
	}

	public function pastThDaysPendingPayment()
	{
		$this->db->select_sum('total');
    	$this->db->where('date >=' , date('Y-m-d', strtotime('-30 days')));
    	$this->db->where('date <=' , date("Y-m-d"));
    	return  $this->db->get('invoice')->row()->total;
	}

	public function pastDaysPendingPayment()
	{
		$this->db->select_sum('total');
    	$this->db->from('invoice');
    	return  $this->db->get()->row()->total;
	}

	public function pendingForPaymentClient()
	{
		$this->db->where('status','3');
		$this->db->group_by('client');
    	return $this->db->get('job')->num_rows();
	}
}
?>