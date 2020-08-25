<?php
class Filters extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function lead()
	{
		$data['_title']			= "Lead Filter";	
		$data['result']			= false;	
		$data['branch']			= "";
		$data['area']			= "";
		$data['city']			= "";
		$data['district']		= "";
		$data['state']			= "";
		$data['source']			= "";
		$data['service']		= "";
		$data['importance']		= "";
		$data['occupation']		= "";
		$data['type']			= "";
		$data['nfdate']			= "";
		$data['fdate']			= "";
		$data['tdate']			= "";
		$this->load->theme('filters/lead/index',$data);		
	}

	public function lead_result()
	{
		if($this->input->post('service') != ""){
			$this->db->like('services', '"'.$this->input->post("service").'"');
		}	

		if($this->input->post('area') != ""){
			$this->db->where('area',$this->input->post('area'));
		}

		if($this->input->post('branch') != ""){
			$this->db->where('branch',$this->input->post('branch'));
		}

		if($this->input->post('city') != ""){
			$this->db->where('city',$this->input->post('city'));
		}

		if($this->input->post('district') != ""){
			$this->db->where('district',$this->input->post('district'));
		}

		if($this->input->post('state') != ""){
			$this->db->where('state',$this->input->post('state'));
		}

		if($this->input->post('source') != ""){
			$this->db->where('source',$this->input->post('source'));
		}

		if($this->input->post('importance') != ""){
			$this->db->where('importance',$this->input->post('importance'));
		}

		if($this->input->post('occupation') != ""){
			$this->db->where('occupation',$this->input->post('occupation'));
		}

		if($this->input->post('type') == "dump"){
			$this->db->where('dump','yes');	
			$this->db->where('status','0');	
		}else if($this->input->post('type') == "converted"){
			$this->db->where('status !=','0');	
		}else if($this->input->post('type') == "active"){
			$this->db->where('status','0');	
		}	

		if($this->input->post('nfdate') != ""){
			$this->db->where('next_followup_date',dd($this->input->post('nfdate')));	
		}

		if($this->input->post('fdate') != ""){
			$this->db->where('date >=',dd($this->input->post('fdate')));	
		}		

		if($this->input->post('tdate') != ""){
			$this->db->where('date <=',dd($this->input->post('tdate')));	
		}		
		$this->db->where('df','');	



		$data['_title']		= "Lead Filter";
		$data['result']		= true;	
		$data['leads']		= $this->db->get('leads')->result_array();



		$data['branch']			= $this->input->post('branch');
		$data['area']			= $this->input->post('area');
		$data['city']			= $this->input->post('city');
		$data['district']		= $this->input->post('district');
		$data['state']			= $this->input->post('state');
		$data['source']			= $this->input->post('source');
		$data['service']		= $this->input->post('service');
		$data['importance']		= $this->input->post('importance');
		$data['occupation']		= $this->input->post('occupation');
		$data['type']			= $this->input->post('type');
		$data['nfdate']			= $this->input->post('nfdate');
		$data['fdate']			= $this->input->post('fdate');
		$data['tdate']			= $this->input->post('tdate');
		$this->load->theme('filters/lead/index',$data);
	}


	public function client()
	{
		$data['_title']			= "Client Filter";	
		$data['result']			= false;	
		$data['branch']			= "";
		$data['fname']			= "";
		$data['mname']			= "";
		$data['lname']			= "";
		$data['area']			= "";
		$data['city']			= "";
		$data['district']		= "";
		$data['state']			= "";
		$data['source']			= "";
		$data['service']		= "";
		$data['occupation']		= "";
		$data['health_insurance']		= "";
		$data['life_insurance']		= "";
		$data['language']		= "";
		$data['industry']		= "";
		$data['sub_industry']		= "";
		$data['type']			= "";
		$data['gender']			= "";
		$data['bdate']			= "";
		$data['fdate']			= "";
		$data['tdate']			= "";
		$this->load->theme('filters/client',$data);		
	}

	public function client_result()
	{
		$clientArray = [];
		if($this->input->post('service') != ""){
			$this->db->select('client');
			$this->db->where('service',$this->input->post('service'));
			$jobs = $this->db->get('job')->result_array();
			
			foreach ($jobs as $key => $value) {
				array_push($clientArray, $value['client']);
			}
		}

		$this->db->flush_cache();

		if($this->input->post('fname') != ""){
			$this->db->like('fname',$this->input->post('fname'));
		}

		if($this->input->post('mname') != ""){
			$this->db->like('mname',$this->input->post('mname'));
		}

		if($this->input->post('lname') != ""){
			$this->db->like('lname',$this->input->post('lname'));
		}

		if($this->input->post('language') != ""){
			$this->db->like('language',$this->input->post('language'));
		}

		if($this->input->post('area') != ""){
			$this->db->where('area',$this->input->post('area'));
		}

		if($this->input->post('branch') != ""){
			$this->db->where('branch',$this->input->post('branch'));
		}

		if($this->input->post('city') != ""){
			$this->db->where('city',$this->input->post('city'));
		}

		if($this->input->post('district') != ""){
			$this->db->where('district',$this->input->post('district'));
		}

		if($this->input->post('state') != ""){
			$this->db->where('state',$this->input->post('state'));
		}

		if($this->input->post('source') != ""){
			$this->db->where('source',$this->input->post('source'));
		}

		if($this->input->post('occupation') != ""){
			$this->db->where('occupation',$this->input->post('occupation'));
		}

		if($this->input->post('health_insurance') != ""){
			$this->db->where('health_in',$this->input->post('health_insurance'));
		}

		if($this->input->post('life_insurance') != ""){
			$this->db->where('life_in',$this->input->post('life_insurance'));
		}

		if($this->input->post('industry') != ""){
			$this->db->where('industry',$this->input->post('industry'));
		}

		if($this->input->post('sub_industry') != ""){
			$this->db->where('sub_industry',$this->input->post('sub_industry'));
		}

		if($this->input->post('gender') != ""){
			$this->db->where('gender',$this->input->post('gender'));
		}

		if($this->input->post('bdate') != ""){
			$this->db->where('dob',dd($this->input->post('bdate')));	
		}

		if($this->input->post('fdate') != ""){
			$this->db->where('created_at >=',dd($this->input->post('fdate')));	
		}		

		if($this->input->post('tdate') != ""){
			$this->db->where('created_at <=',dd($this->input->post('tdate')));	
		}		

		if($this->input->post('type') != ""){
			$this->db->where('status',$this->input->post('type'));	
		}

		if($this->input->post('service') != ""){
			$this->db->where_in('id',$clientArray);
		}

		$data['result']		= true;	
		$data['client']		= $this->db->get('client')->result_array();
		$data['_title']			= "Client Filter";
		$data['branch']			= $this->input->post('branch');
		$data['fname']			= $this->input->post('fname');
		$data['mname']			= $this->input->post('mname');
		$data['lname']			= $this->input->post('lname');
		$data['area']			= $this->input->post('area');
		$data['city']			= $this->input->post('city');
		$data['district']		= $this->input->post('district');
		$data['state']			= $this->input->post('state');
		$data['source']			= $this->input->post('source');
		$data['service']		= $this->input->post('service');
		$data['occupation']		= $this->input->post('occupation');
		$data['health_insurance']		= $this->input->post('health_insurance');
		$data['life_insurance']		= $this->input->post('life_insurance');
		$data['language']		= $this->input->post('language');
		$data['type']			= $this->input->post('type');
		$data['industry']			= $this->input->post('industry');
		$data['sub_industry']			= $this->input->post('sub_industry');
		$data['gender']			= $this->input->post('gender');
		$data['bdate']			= $this->input->post('bdate');
		$data['fdate']			= $this->input->post('fdate');
		$data['tdate']			= $this->input->post('tdate');
		$this->load->theme('filters/client',$data);	
	}

	public function invoice()
	{
		$data['_title']			= "Invoice Filter";	
		$data['result']			= false;
		$data['branch']			= "";
		$data['company']			= "";
		$data['order_by']			= "";
		$data['fdate']			= "";
		$data['tdate']			= "";	
		$this->load->theme('filters/invoice',$data);		
	}

	public function invoice_result()
	{
		if($this->input->post('branch') != ""){
			$this->db->where('branch',$this->input->post('branch'));
		}

		if($this->input->post('company') != ""){
			$this->db->where('company',$this->input->post('company'));
		}

		if($this->input->post('fdate') != ""){
			$this->db->where('date >=',dd($this->input->post('fdate')));	
		}		

		if($this->input->post('tdate') != ""){
			$this->db->where('date <=',dd($this->input->post('tdate')));	
		}	

		if($this->input->post('order_by') != ""){
			$this->db->order_by('total',$this->input->post('order_by'));	
		}	

		$data['_title']			= "Invoice Filter";	
		$data['result']			= true;	
		$data['branch']			= $this->input->post('branch');
		$data['company']			= $this->input->post('company');
		$data['order_by']			= $this->input->post('order_by');
		$data['fdate']			= $this->input->post('fdate');
		$data['tdate']			= $this->input->post('tdate');
		$data['invoices']		= $this->db->get('invoice')->result_array();
		$this->load->theme('filters/invoice',$data);
	}
}