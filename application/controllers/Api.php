<?php
class Api extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function team_dashboard()
	{
		
	}

	public function set_goal()
	{
		$data = [
			'goal_calls'				=> $this->input->post('calls'),
			'goal_conversation'		=> $this->input->post('conversaction'),
			'goal_minutes'			=> $this->input->post('minutes'),
			'goal_avg_call'			=> $this->input->post('avg_call')
		];
		$this->db->where('id',$this->input->post('user'));
		$users = $this->db->update('users',$data)->row_array();
		$json = [];
		$this->response($json);	
	}

	public function get_user_goal()
	{
		$this->db->where('id',$this->input->post('user'));
		$users = $this->db->get('users')->row_array();
		$json = [
			'calls'				=> $users['goal_calls'],
			'conversations'		=> $users['goal_conversation'],
			'seconds'			=> $users['goal_minutes'],
			'avg_call'			=> $users['goal_avg_call']
		];
		$this->response($json);
	}

	public function get_goal_users()
	{
		$this->db->where('admin',$this->input->post('user'));
		$this->db->where('status','1');
		$this->db->order_by('group','desc');
		$users = $this->db->get('users');

		$list = [];
		$ar = [
			'id'			=> "",
			'name'			=> "Select member"
		];
		array_push($list, $ar);
		foreach ($users->result_array() as $key => $value) {
			$ar = [
				'id'			=> $value['id'],
				'name'			=> $value['name']." (".$this->db->get_where('group' ,['id' => $value['group']])->row_array()['name'].')'
			];
			array_push($list, $ar);
		}
		$json = [
			'count'				=> $users->num_rows(),
			'spinner_list'		=> $list
		];
		$this->response($json);
	}

	public function f_dashboard()
	{
		$_user = $this->db->get_where('users',['id' => $this->input->post('user')])->row_array();
		$user 		= $this->input->post('user');
		$type 		= $this->input->post('type');
		$date 		= date('Y-m-d' ,strtotime($this->input->post('date')));
		if($type == "today"){
			$this->db->where('date',date('Y-m-d'));
			$this->db->where('user',$user);
			$calls = $this->db->get('calls')->num_rows();

			$this->db->where('date',date('Y-m-d'));
			$this->db->where('user',$user);
			$this->db->where('seconds >','0');
			$conversations = $this->db->get('calls')->num_rows();

			$this->db->select_sum('seconds');
			$this->db->where('date',date('Y-m-d'));
			$this->db->where('user',$user);
			$seconds = $this->db->get('calls')->row()->seconds;
			if($seconds == null){ $seconds = 0; }

			$json = [
				'calls'				=> $this->getGoal($_user['goal_calls'],$calls),
				'conversations'		=> $this->getGoal($_user['goal_conversation'],$conversations),
				'seconds'			=> $this->getGoal($_user['goal_minutes'],$seconds,true),
				'avg_call'			=> $this->getGoal($_user['goal_avg_call'],0)
			];
		}else if($type == "date"){
			$this->db->where('date',$date);
			$this->db->where('user',$user);
			$calls = $this->db->get('calls')->num_rows();

			$this->db->where('date',$date);
			$this->db->where('user',$user);
			$this->db->where('seconds >','0');
			$conversations = $this->db->get('calls')->num_rows();

			$this->db->select_sum('seconds');
			$this->db->where('date',$date);
			$this->db->where('user',$user);
			$seconds = $this->db->get('calls')->row()->seconds;
			if($seconds == null){ $seconds = 0; }
			$json = [
				'calls'				=> $this->getGoal($_user['goal_calls'],$calls),
				'conversations'		=> $this->getGoal($_user['goal_conversation'],$conversations),
				'seconds'			=> $this->getGoal($_user['goal_minutes'],$seconds,true),
				'avg_call'			=> $this->getGoal($_user['goal_avg_call'],0)
			];
		}else if($type == "total"){
			$this->db->where('user',$user);
			$calls = $this->db->get('calls')->num_rows();
			$this->db->where('user',$user);
			$this->db->where('seconds >','0');
			$conversations = $this->db->get('calls')->num_rows();
			$this->db->select_sum('seconds');
			$this->db->where('user',$user);
			$seconds = $this->db->get('calls')->row()->seconds;
			if($seconds == null){ $seconds = 0; }
			$json = [
				'calls'				=> $this->getGoal($_user['goal_calls'],$calls),
				'conversations'		=> $this->getGoal($_user['goal_conversation'],$conversations),
				'seconds'			=> $this->getGoal($_user['goal_minutes'],$seconds,true),
				'avg_call'			=> $this->getGoal($_user['goal_avg_call'],0)
			];
		}else if($type == "month"){
			$this->db->where('date >=',date('Y-m-1'));
			$this->db->where('date <=',date('Y-m-t'));
			$this->db->where('user',$user);
			$calls = $this->db->get('calls')->num_rows();

			$this->db->where('date >=',date('Y-m-1'));
			$this->db->where('date <=',date('Y-m-t'));
			$this->db->where('user',$user);
			$this->db->where('seconds >','0');
			$conversations = $this->db->get('calls')->num_rows();

			$this->db->select_sum('seconds');
			$this->db->where('date >=',date('Y-m-1'));
			$this->db->where('date <=',date('Y-m-t'));
			$this->db->where('user',$user);
			$seconds = $this->db->get('calls')->row()->seconds;
			if($seconds == null){ $seconds = 0; }
			$json = [
				'calls'				=> $this->getGoal($_user['goal_calls'],$calls),
				'conversations'		=> $this->getGoal($_user['goal_conversation'],$conversations),
				'seconds'			=> $this->getGoal($_user['goal_minutes'],$seconds,true),
				'avg_call'			=> $this->getGoal($_user['goal_avg_call'],0)
			];
		}else if($type == "week"){
			$this->db->where('date >=',$this->x_week_range(date('Y-m-d'))[0]);
			$this->db->where('date <=',$this->x_week_range(date('Y-m-d'))[0]);
			$this->db->where('user',$user);
			$calls = $this->db->get('calls')->num_rows();
			$this->db->where('date >=',$this->x_week_range(date('Y-m-d'))[0]);
			$this->db->where('date <=',$this->x_week_range(date('Y-m-d'))[0]);
			$this->db->where('user',$user);
			$this->db->where('seconds >','0');
			$conversations = $this->db->get('calls')->num_rows();
			$this->db->select_sum('seconds');
			$this->db->where('date >=',$this->x_week_range(date('Y-m-d'))[0]);
			$this->db->where('date <=',$this->x_week_range(date('Y-m-d'))[0]);
			$this->db->where('user',$user);
			$seconds = $this->db->get('calls')->row()->seconds;
			if($seconds == null){ $seconds = 0; }
			$json = [
				'calls'				=> $this->getGoal($_user['goal_calls'],$calls),
				'conversations'		=> $this->getGoal($_user['goal_conversation'],$conversations),
				'seconds'			=> $this->getGoal($_user['goal_minutes'],$seconds,true),
				'avg_call'			=> $this->getGoal($_user['goal_avg_call'],0)
			];
		}

		$this->response($json);
	}

	public function call_logs()
	{
		$user 		= $this->input->post('user');
		$data 		= $this->input->post('data');
		$last_date 	= $this->input->post('last_date');

		foreach (explode("|", $data) as $key => $value) {
			$dataArray = explode("_", $value);
			$idata = [
				'number'	=> $dataArray[1],
				'seconds'	=> $dataArray[0],
				'date'		=> date("Y-m-d",strtotime($dataArray[2])),
				'datetime'	=> date("Y-m-d H:i:s",strtotime($dataArray[2])),
				'user'		=> $user
			];
			$this->db->insert('calls',$idata);
		}

		$this->db->where('id',$user)->update('users',['last_fetched' => date("Y-m-d H:i:s",strtotime($last_date))]);	
	}

	public function send_invite()
	{

		$user = $this->db->get_where('users',['email' => $this->input->post('email'),'df' => ''])->row_array();
		if(!$user){
			$data = [
				'name'			=> $this->input->post('name'),
				'company'		=> "",
				'email'			=> $this->input->post('email'),
				'phone'			=> $this->input->post('phone'),
				'code'			=> $this->input->post('code'),
				'type'			=> "individual",
				'created_at'	=> date('Y-m-d H:i:s'),
				'last_fetched'	=> date('Y-m-d H:i:s'),
				'group'			=> $this->input->post('group'), 
				'admin'			=> $this->input->post('id')
			];
			$this->db->insert('users',$data);
			$user = $this->db->get_where('users',['id' => $this->db->insert_id()])->row_array();
			$otp = $this->generate_otp($user['id'],"join");
			$link = "https://play.google.com/store/apps/details?id=".$this->input->post('application_id');
			sendMail($user['email'],"Join Invitation",$this->load->view('mail/invitation',['otp' => $otp,'link' => $link],true));
			$json = [
				'response'		=> 200,
				'_return'		=> true
			];
		}else{
			if($user['status'] != "1"){
				$data = [
					'group'			=> $this->input->post('group'), 
					'admin'			=> $this->input->post('id')
				];
				$this->db->where('id',$user['id'])->update('users',$data);
				$this->db->where('user',$user['id'])->where('for','join')->update('otp',['expired' => 'yes']);				
				$otp = $this->generate_otp($user['id'],"join");
				$link = "https://play.google.com/store/apps/details?id=".$this->input->post('application_id');
				sendMail($user['email'],"Login OTP",$this->load->view('mail/invitation',['otp' => $otp,'link' => $link],true));

				$json = [
					'response'		=> 200,
					'_return'		=> true
				];
			}else{
				$json = [
					'response'		=> 200,
					'_return'		=> false
				];		
			}
		}

		
		$this->response($json);
	}

	public function delete_group()
	{
		$this->db->where('id',$this->input->post('group'))->update('group',['df' => '1']);

		$json = [
			'response'		=> 200,
			'_return'		=> true
		];
		$this->response($json);
	}

	public function get_spinner_groups()
	{
		$groups = $this->db->order_by('id','desc')->get_where('group' ,['user' => $this->input->post('user'),'df' => '']);
		$list = [];
		$ar = [
			'id'			=> "",
			'name'			=> "Select group"
		];
		array_push($list, $ar);
		$total = $groups->num_rows();
		foreach ($groups->result_array() as $key => $value) {
			$ar = [
				'id'			=> $value['id'],
				'name'			=> $value['name']
			];
			array_push($list, $ar);
			$total--;
		}
		$json = [
			'count'				=> $groups->num_rows(),
			'spinner_list'		=> $list
		];
		$this->response($json);
	}

	public function get_groups()
	{
		$groups = $this->db->order_by('id','desc')->get_where('group' ,['user' => $this->input->post('user'),'df' => '']);
		$list = [];
		$total = $groups->num_rows();
		foreach ($groups->result_array() as $key => $value) {
			$ar = [
				'group'			=> $total,
				'id'			=> $value['id'],
				'name'			=> $value['name'],
				'created_at'	=> _vdatetime($value['created_at']),
				'member_count'	=> $this->db->get_where('users',['admin' => $this->input->post('user'),'group' => $value['id']])->num_rows()
			];
			array_push($list, $ar);
			$total--;
		}
		$json = [
			'count'		=> $groups->num_rows(),
			'list'		=> $list
		];
		$this->response($json);
	}

	public function add_group()
	{
		$data = [
			'name'			=> $this->input->post('name'),
			'created_at'	=> date('Y-m-d H:i:s'),
			'user'			=> $this->input->post('user')
		];
		$this->db->insert('group',$data);

		$json = [
			'response'		=> 200,
			'_return'		=> true
		];
		$this->response($json);
	}

	public function profile()
	{
		$data = [
			'name'			=> $this->input->post('name'),
			'company'		=> $this->input->post('company'),
			'phone'			=> $this->input->post('phone'),
			'code'			=> $this->input->post('code')
		];
		$this->db->where('id',$this->input->post('id'))->update('users',$data);
		$json = [
			'response'		=> 200,
			'_return'		=> true
		];
		$this->response($json);
	}

	public function register()
	{
		if($this->input->post('type') == "company"){
			$user = $this->db->get_where('users',['email' => $this->input->post('email'),'df' => ''])->row_array();
			if(!$user){
				$data = [
					'name'			=> $this->input->post('name'),
					'company'		=> $this->input->post('company'),
					'email'			=> $this->input->post('email'),
					'phone'			=> $this->input->post('phone'),
					'code'			=> $this->input->post('code'),
					'type'			=> $this->input->post('type'),
					'created_at'	=> date('Y-m-d H:i:s'),
					'last_fetched'	=> date('Y-m-d H:i:s')
				];
				$this->db->insert('users',$data);
				$user = $this->db->get_where('users',['id' => $this->db->insert_id()])->row_array();
				$json = [
					'response'	=> 200,
					'_return'	=> true,
					'message'	=> "register",
					'id'			=> $user['id'],	
					'name'			=> $user['name'],	
					'company'		=> $user['company'],	
					'code'			=> $user['code'],	
					'phone'			=> $user['phone'],	
					'email'			=> $user['email'],
					'type'			=> $user['type'],
					'last_upload'	=> $user['last_fetched'],
					'group_count'	=> $this->getGroupCount($user['id'])
				];
			}else{
				$otp = $this->generate_otp($user['id']);

				sendMail($user['email'],"Login OTP",$this->load->view('mail/login',['otp' => $otp],true));
				$json = [
					'response'		=> 200,
					'_return'		=> true,
					'message'		=> "login",
					'otp'			=> $otp,
					'id'			=> $user['id'],	
					'name'			=> $user['name'],	
					'company'		=> $user['company'],	
					'code'			=> $user['code'],	
					'phone'			=> $user['phone'],	
					'email'			=> $user['email'],
					'type'			=> $user['type'],
					'last_upload'	=> $user['last_fetched'],
					'group_count'	=> $this->getGroupCount($user['id'])
				];
			}
			$this->response($json);
		}else if($this->input->post('type') == "individual"){

			$user = $this->db->get_where('users',['email' => $this->input->post('email'),'df' => ''])->row_array();
			if(!$user){
				$data = [
					'name'			=> $this->input->post('name'),
					'company'		=> "",
					'email'			=> $this->input->post('email'),
					'phone'			=> $this->input->post('phone'),
					'code'			=> $this->input->post('code'),
					'type'			=> $this->input->post('type'),
					'created_at'	=> date('Y-m-d H:i:s'),
					'last_fetched'	=> date('Y-m-d H:i:s')
				];
				$this->db->insert('users',$data);
				$user = $this->db->get_where('users',['id' => $this->db->insert_id()])->row_array();
				$json = [
					'response'	=> 200,
					'_return'	=> true,
					'message'	=> "register",
					'id'			=> $user['id'],	
					'name'			=> $user['name'],	
					'company'		=> $user['company'],	
					'code'			=> $user['code'],	
					'phone'			=> $user['phone'],	
					'email'			=> $user['email'],
					'type'			=> $user['type'],
					'last_upload'	=> $user['last_fetched'],
					'group_count'	=> $this->getGroupCount($user['id'])
				];
			}else{
				$otp = $this->generate_otp($user['id']);
				sendMail($user['email'],"Login OTP",$this->load->view('mail/login',['otp' => $otp],true));
				$json = [
					'response'		=> 200,
					'_return'		=> true,
					'message'		=> "login",
					'otp'			=> $otp,
					'id'			=> $user['id'],	
					'name'			=> $user['name'],	
					'company'		=> $user['company'],	
					'code'			=> $user['code'],	
					'phone'			=> $user['phone'],	
					'email'			=> $user['email'],
					'type'			=> $user['type'],
					'last_upload'	=> $user['last_fetched'],
					'group_count'	=> $this->getGroupCount($user['id'])
				];
			}
			$this->response($json);

		}else{

			$user = $this->db->get_where('users',['email' => $this->input->post('email'),'df' => ''])->row_array();
			if($user){
				if($user['status'] == '0'){
					$cotp = $this->db->get_where('otp',['otp' => $this->input->post('otp'),'user' => $user['id'],'expired' => ''])->num_rows();
					if($cotp > 0){

						$this->db->where('user',$user['id'])->where('for','join')->update('otp',['expired' => 'yes']);
						$this->db->where('id',$user['id'])->update('users',['status' => '1']);

						$json = [
							'response'		=> 200,
							'_return'		=> true,
							'id'			=> $user['id'],	
							'name'			=> $user['name'],	
							'company'		=> $user['company'],	
							'code'			=> $user['code'],	
							'phone'			=> $user['phone'],	
							'email'			=> $user['email'],
							'type'			=> $user['type'],
							'last_upload'	=> $user['last_fetched'],
							'group_count'	=> $this->getGroupCount($user['id'])
						];	

					}else{
						$json = [
							'response'		=> 200,
							'message'		=> "otp",
							'_return'		=> false
						];	
					}
				}else{
					$json = [
						'response'		=> 200,
						'message'		=> "join",
						'_return'		=> false
					];	
				}

			}else{
				$json = [
					'response'		=> 200,
					'message'		=> "user",
					'_return'		=> false
				];
			}
			$this->response($json);
		}
	}






	public function getGroupCount($user)
	{
		return $this->db->get_where('group',['user' => $user,'df' => ''])->num_rows(); 
	}

	public function generate_otp($user_id,$type = "login")
	{
		$otp = mt_rand(111111, 999999);
		$data = [
			'otp'			=> $otp,
			'for'			=> $type,
			'user'			=> $user_id,
			'created_at'	=> date('Y-m-d H:i:s')
		];
		$this->db->insert('otp',$data);
		return $otp;
	}

	public function response($val)
	{
		header('Content-Type: application/json');
		echo json_encode($val);
	}

	function x_week_range($date) {
	  $ts = strtotime($date);
	  $start = strtotime('monday this week', $ts);
	  $end = strtotime('sunday this week', $ts);
	  return array(date('Y-m-d', $start), date('Y-m-d', $end));
	}

	public function getGoal($goal,$data,$type=false)
	{
		if($goal != 0){
			if($type){
				$data = $data / 60;
				$percent = ($data * 100) / $goal;
			}else{
				$percent = ($data * 100) / $goal;
			}
			if($percent > 100){
				$percent = 100;
			}else{
				$percent = (int)$percent;
			}
			return $data.'-'.$percent.'%';
		}else{
			if($type){
				$data = $data / 60;
			}
			return (int)$data;	
		}
		
	}
}
?>