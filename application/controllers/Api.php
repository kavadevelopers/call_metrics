<?php
class Api extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function analitics()
	{
		$user = $this->input->post('user');
		$type = $this->input->post('type');
		if($type == 'Month'){

			$dates = $this->date_range(date('Y-m-1'),date('Y-m-t'),'+1 day','d');
			$calls = [];
			foreach ($dates as $key => $value) {
				$call = $this->db->get_where('calls',['date' => date('Y-m-'.$value),'user' => $user])->num_rows();
				array_push($calls, ['string' => $value,'value' => $call]);
			}

			$conversations = [];
			foreach ($dates as $key => $value) {
				$call = $this->db->get_where('calls',['date' => date('Y-m-'.$value),'user' => $user, 'seconds >' => '0'])->num_rows();
				array_push($conversations, ['string' => $value,'value' => $call]);
			}


			$days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];

			$callsPerDay = [];
			foreach ($days as $dkey => $dvalue) {
				$day = $this->getWeekDayInRange($dvalue, date('Y-m-1'),date('Y-m-t'));	
				$call = 0;
				foreach ($day as $key => $value) {
					$call += $this->db->get_where('calls',['date' => $value,'user' => $user])->num_rows();
				}
				array_push($callsPerDay, ['string' => $dvalue,'value' => $call]);
			}

			$conversationsPerDay = [];
			foreach ($days as $dkey => $dvalue) {
				$day = $this->getWeekDayInRange($dvalue, date('Y-m-1'),date('Y-m-t'));	
				$call = 0;
				foreach ($day as $key => $value) {
					$call += $this->db->get_where('calls',['date' => $value,'user' => $user, 'seconds >' => '0'])->num_rows();
				}
				array_push($conversationsPerDay, ['string' => $dvalue,'value' => $call]);
			}
			

			$data = [];
			array_push($data,	['data' => $calls,'title' => 'Calls in this month','yTitle' => 'Calls','xTitle' => 'Date'] );
			array_push($data, 	['data' => $callsPerDay,'title' => 'Calls per day','yTitle' => 'Calls','xTitle' => 'Days']);
			array_push($data, 	['data' => $conversations,'title' => 'Conversations in this month','yTitle' => 'Conversations','xTitle' => 'Date']);
			array_push($data, 	['data' => $conversationsPerDay,'title' => 'Conversations per day','yTitle' => 'Conversations','xTitle' => 'Days']);
			

			$json = [
				'list'		=> $data
			];

		}else if($type == 'Trimester'){
			$start_first = date('Y-m-01',strtotime('-2 month'));
			$end_first = date('Y-m-t',strtotime('-2 month'));
			$month_first = date('F',strtotime('-2 month'));

			$start_second = date('Y-m-01',strtotime('-1 month'));
			$end_second = date('Y-m-t',strtotime('-1 month'));
			$month_second = date('F',strtotime('-1 month'));

			$start_third = date('Y-m-01');
			$end_third = date('Y-m-t');
			$month_third = date('F');

			$calls = [];
			$this->db->where('date >=', $start_first);
			$this->db->where('date <=', $end_first);
			$call = $this->db->get_where('calls',['user' => $user])->num_rows();
			array_push($calls, ['string' => $month_first,'value' => $call]);

			$this->db->where('date >=', $start_second);
			$this->db->where('date <=', $end_second);
			$call = $this->db->get_where('calls',['user' => $user])->num_rows();
			array_push($calls, ['string' => $month_second,'value' => $call]);

			$this->db->where('date >=', $start_third);
			$this->db->where('date <=', $end_third);
			$call = $this->db->get_where('calls',['user' => $user])->num_rows();
			array_push($calls, ['string' => $month_third,'value' => $call]);


			$conversations = [];
			$this->db->where('date >=', $start_first);
			$this->db->where('date <=', $end_first);
			$call = $this->db->get_where('calls',['user' => $user,'seconds >' => '0'])->num_rows();
			array_push($conversations, ['string' => $month_first,'value' => $call]);

			$this->db->where('date >=', $start_second);
			$this->db->where('date <=', $end_second);
			$call = $this->db->get_where('calls',['user' => $user,'seconds >' => '0'])->num_rows();
			array_push($conversations, ['string' => $month_second,'value' => $call]);
			
			$this->db->where('date >=', $start_third);
			$this->db->where('date <=', $end_third);
			$call = $this->db->get_where('calls',['user' => $user,'seconds >' => '0'])->num_rows();
			array_push($conversations, ['string' => $month_third,'value' => $call]);


			$days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];

			$callsPerDay = [];
			foreach ($days as $dkey => $dvalue) {
				$day = $this->getWeekDayInRange($dvalue, $start_first,$end_third);	
				$call = 0;
				foreach ($day as $key => $value) {
					$call += $this->db->get_where('calls',['date' => $value,'user' => $user])->num_rows();
				}
				array_push($callsPerDay, ['string' => $dvalue,'value' => $call]);
			}

			$conversationsPerDay = [];
			foreach ($days as $dkey => $dvalue) {
				$day = $this->getWeekDayInRange($dvalue, $start_first,$end_third);	
				$call = 0;
				foreach ($day as $key => $value) {
					$call += $this->db->get_where('calls',['date' => $value,'user' => $user, 'seconds >' => '0'])->num_rows();
				}
				array_push($conversationsPerDay, ['string' => $dvalue,'value' => $call]);
			}


			//exit;
			$data = [];
			array_push($data,	['data' => $calls,'title' => 'Calls in this tremester','yTitle' => 'Calls','xTitle' => 'Months'] );
			array_push($data, 	['data' => $callsPerDay,'title' => 'Calls per day','yTitle' => 'Calls','xTitle' => 'Days']);
			array_push($data, 	['data' => $conversations,'title' => 'Conversations in this tremester','yTitle' => 'Conversations','xTitle' => 'Months']);
			array_push($data, 	['data' => $conversationsPerDay,'title' => 'Conversations per day','yTitle' => 'Conversations','xTitle' => 'Days']);
			

			$json = [
				'list'		=> $data
			];

		}else if($type == 'Quarter'){

			$start_first = date('Y-m-01',strtotime('-3 month'));
			$end_first = date('Y-m-t',strtotime('-3 month'));
			$month_first = date('F',strtotime('-3 month'));

			$start_second = date('Y-m-01',strtotime('-2 month'));
			$end_second = date('Y-m-t',strtotime('-2 month'));
			$month_second = date('F',strtotime('-2 month'));

			$start_third = date('Y-m-01',strtotime('-1 month'));
			$end_third = date('Y-m-t',strtotime('-1 month'));
			$month_third = date('F',strtotime('-1 month'));

			$start_fourth = date('Y-m-01');
			$end_fourth = date('Y-m-t');
			$month_fourth = date('F');

			$calls = [];
			$this->db->where('date >=', $start_first);
			$this->db->where('date <=', $end_first);
			$call = $this->db->get_where('calls',['user' => $user])->num_rows();
			array_push($calls, ['string' => $month_first,'value' => $call]);

			$this->db->where('date >=', $start_second);
			$this->db->where('date <=', $end_second);
			$call = $this->db->get_where('calls',['user' => $user])->num_rows();
			array_push($calls, ['string' => $month_second,'value' => $call]);

			$this->db->where('date >=', $start_third);
			$this->db->where('date <=', $end_third);
			$call = $this->db->get_where('calls',['user' => $user])->num_rows();
			array_push($calls, ['string' => $month_third,'value' => $call]);

			$this->db->where('date >=', $start_fourth);
			$this->db->where('date <=', $end_fourth);
			$call = $this->db->get_where('calls',['user' => $user])->num_rows();
			array_push($calls, ['string' => $month_fourth,'value' => $call]);


			$conversations = [];
			$this->db->where('date >=', $start_first);
			$this->db->where('date <=', $end_first);
			$call = $this->db->get_where('calls',['user' => $user,'seconds >' => '0'])->num_rows();
			array_push($conversations, ['string' => $month_first,'value' => $call]);

			$this->db->where('date >=', $start_second);
			$this->db->where('date <=', $end_second);
			$call = $this->db->get_where('calls',['user' => $user,'seconds >' => '0'])->num_rows();
			array_push($conversations, ['string' => $month_second,'value' => $call]);
			
			$this->db->where('date >=', $start_third);
			$this->db->where('date <=', $end_third);
			$call = $this->db->get_where('calls',['user' => $user,'seconds >' => '0'])->num_rows();
			array_push($conversations, ['string' => $month_third,'value' => $call]);

			$this->db->where('date >=', $start_fourth);
			$this->db->where('date <=', $end_fourth);
			$call = $this->db->get_where('calls',['user' => $user,'seconds >' => '0'])->num_rows();
			array_push($conversations, ['string' => $month_fourth,'value' => $call]);


			$days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];

			$callsPerDay = [];
			foreach ($days as $dkey => $dvalue) {
				$day = $this->getWeekDayInRange($dvalue, $start_first,$end_fourth);	
				$call = 0;
				foreach ($day as $key => $value) {
					$call += $this->db->get_where('calls',['date' => $value,'user' => $user])->num_rows();
				}
				array_push($callsPerDay, ['string' => $dvalue,'value' => $call]);
			}

			$conversationsPerDay = [];
			foreach ($days as $dkey => $dvalue) {
				$day = $this->getWeekDayInRange($dvalue, $start_first,$end_fourth);	
				$call = 0;
				foreach ($day as $key => $value) {
					$call += $this->db->get_where('calls',['date' => $value,'user' => $user, 'seconds >' => '0'])->num_rows();
				}
				array_push($conversationsPerDay, ['string' => $dvalue,'value' => $call]);
			}


			//exit;
			$data = [];
			array_push($data,	['data' => $calls,'title' => 'Calls in this quarter','yTitle' => 'Calls','xTitle' => 'Months'] );
			array_push($data, 	['data' => $callsPerDay,'title' => 'Calls per day','yTitle' => 'Calls','xTitle' => 'Days']);
			array_push($data, 	['data' => $conversations,'title' => 'Conversations in this quarter','yTitle' => 'Conversations','xTitle' => 'Months']);
			array_push($data, 	['data' => $conversationsPerDay,'title' => 'Conversations per day','yTitle' => 'Conversations','xTitle' => 'Days']);
			

			$json = [
				'list'		=> $data
			];
			
		}else if($type == 'Year'){
			
			$start_first = date('Y-m-01',strtotime('-11 month'));
			$end_first = date('Y-m-t',strtotime('-11 month'));
			$month_first = date('F',strtotime('-11 month'));

			$start_second = date('Y-m-01',strtotime('-10 month'));
			$end_second = date('Y-m-t',strtotime('-10 month'));
			$month_second = date('F',strtotime('-10 month'));

			$start_third = date('Y-m-01',strtotime('-9 month'));
			$end_third = date('Y-m-t',strtotime('-9 month'));
			$month_third = date('F',strtotime('-9 month'));

			$start_forth = date('Y-m-01',strtotime('-8 month'));
			$end_forth = date('Y-m-t',strtotime('-8 month'));
			$month_forth = date('F',strtotime('-8 month'));

			$start_fifth = date('Y-m-01',strtotime('-7 month'));
			$end_fifth = date('Y-m-t',strtotime('-7 month'));
			$month_fifth = date('F',strtotime('-7 month'));

			$start_sixth = date('Y-m-01',strtotime('-6 month'));
			$end_sixth = date('Y-m-t',strtotime('-6 month'));
			$month_sixth = date('F',strtotime('-6 month'));

			$start_seven = date('Y-m-01',strtotime('-5 month'));
			$end_seven = date('Y-m-t',strtotime('-5 month'));
			$month_seven = date('F',strtotime('-5 month'));

			$start_eight = date('Y-m-01',strtotime('-4 month'));
			$end_eight = date('Y-m-t',strtotime('-4 month'));
			$month_eight = date('F',strtotime('-4 month'));

			$start_nine = date('Y-m-01',strtotime('-3 month'));
			$end_nine = date('Y-m-t',strtotime('-3 month'));
			$month_nine = date('F',strtotime('-3 month'));

			$start_ten = date('Y-m-01',strtotime('-2 month'));
			$end_ten = date('Y-m-t',strtotime('-2 month'));
			$month_ten = date('F',strtotime('-2 month'));

			$start_eleven = date('Y-m-01',strtotime('-1 month'));
			$end_eleven = date('Y-m-t',strtotime('-1 month'));
			$month_eleven = date('F',strtotime('-1 month'));

			$start_twelve = date('Y-m-01');
			$end_twelve = date('Y-m-t');
			$month_twelve = date('F');

			$calls = [];
			$this->db->where('date >=', $start_first);
			$this->db->where('date <=', $end_first);
			$call = $this->db->get_where('calls',['user' => $user])->num_rows();
			array_push($calls, ['string' => $month_first,'value' => $call]);

			$this->db->where('date >=', $start_second);
			$this->db->where('date <=', $end_second);
			$call = $this->db->get_where('calls',['user' => $user])->num_rows();
			array_push($calls, ['string' => $month_second,'value' => $call]);

			$this->db->where('date >=', $start_third);
			$this->db->where('date <=', $end_third);
			$call = $this->db->get_where('calls',['user' => $user])->num_rows();
			array_push($calls, ['string' => $month_third,'value' => $call]);

			$this->db->where('date >=', $start_forth);
			$this->db->where('date <=', $end_forth);
			$call = $this->db->get_where('calls',['user' => $user])->num_rows();
			array_push($calls, ['string' => $month_forth,'value' => $call]);

			$this->db->where('date >=', $start_fifth);
			$this->db->where('date <=', $end_fifth);
			$call = $this->db->get_where('calls',['user' => $user])->num_rows();
			array_push($calls, ['string' => $month_fifth,'value' => $call]);

			$this->db->where('date >=', $start_sixth);
			$this->db->where('date <=', $end_sixth);
			$call = $this->db->get_where('calls',['user' => $user])->num_rows();
			array_push($calls, ['string' => $month_sixth,'value' => $call]);

			$this->db->where('date >=', $start_seven);
			$this->db->where('date <=', $end_seven);
			$call = $this->db->get_where('calls',['user' => $user])->num_rows();
			array_push($calls, ['string' => $month_seven,'value' => $call]);

			$this->db->where('date >=', $start_eight);
			$this->db->where('date <=', $end_eight);
			$call = $this->db->get_where('calls',['user' => $user])->num_rows();
			array_push($calls, ['string' => $month_eight,'value' => $call]);

			$this->db->where('date >=', $start_nine);
			$this->db->where('date <=', $end_nine);
			$call = $this->db->get_where('calls',['user' => $user])->num_rows();
			array_push($calls, ['string' => $month_nine,'value' => $call]);

			$this->db->where('date >=', $start_ten);
			$this->db->where('date <=', $end_ten);
			$call = $this->db->get_where('calls',['user' => $user])->num_rows();
			array_push($calls, ['string' => $month_ten,'value' => $call]);

			$this->db->where('date >=', $start_eleven);
			$this->db->where('date <=', $end_eleven);
			$call = $this->db->get_where('calls',['user' => $user])->num_rows();
			array_push($calls, ['string' => $month_eleven,'value' => $call]);

			$this->db->where('date >=', $start_twelve);
			$this->db->where('date <=', $end_twelve);
			$call = $this->db->get_where('calls',['user' => $user])->num_rows();
			array_push($calls, ['string' => $month_twelve,'value' => $call]);

			$conversations = [];
			$this->db->where('date >=', $start_first);
			$this->db->where('date <=', $end_first);
			$call = $this->db->get_where('calls',['user' => $user,'seconds >' => '0'])->num_rows();
			array_push($conversations, ['string' => $month_first,'value' => $call]);

			$this->db->where('date >=', $start_second);
			$this->db->where('date <=', $end_second);
			$call = $this->db->get_where('calls',['user' => $user,'seconds >' => '0'])->num_rows();
			array_push($conversations, ['string' => $month_second,'value' => $call]);

			$this->db->where('date >=', $start_third);
			$this->db->where('date <=', $end_third);
			$call = $this->db->get_where('calls',['user' => $user,'seconds >' => '0'])->num_rows();
			array_push($conversations, ['string' => $month_third,'value' => $call]);

			$this->db->where('date >=', $start_forth);
			$this->db->where('date <=', $end_forth);
			$call = $this->db->get_where('calls',['user' => $user,'seconds >' => '0'])->num_rows();
			array_push($conversations, ['string' => $month_forth,'value' => $call]);

			$this->db->where('date >=', $start_fifth);
			$this->db->where('date <=', $end_fifth);
			$call = $this->db->get_where('calls',['user' => $user,'seconds >' => '0'])->num_rows();
			array_push($conversations, ['string' => $month_fifth,'value' => $call]);

			$this->db->where('date >=', $start_sixth);
			$this->db->where('date <=', $end_sixth);
			$call = $this->db->get_where('calls',['user' => $user,'seconds >' => '0'])->num_rows();
			array_push($conversations, ['string' => $month_sixth,'value' => $call]);

			$this->db->where('date >=', $start_seven);
			$this->db->where('date <=', $end_seven);
			$call = $this->db->get_where('calls',['user' => $user,'seconds >' => '0'])->num_rows();
			array_push($conversations, ['string' => $month_seven,'value' => $call]);

			$this->db->where('date >=', $start_eight);
			$this->db->where('date <=', $end_eight);
			$call = $this->db->get_where('calls',['user' => $user,'seconds >' => '0'])->num_rows();
			array_push($conversations, ['string' => $month_eight,'value' => $call]);

			$this->db->where('date >=', $start_nine);
			$this->db->where('date <=', $end_nine);
			$call = $this->db->get_where('calls',['user' => $user,'seconds >' => '0'])->num_rows();
			array_push($conversations, ['string' => $month_nine,'value' => $call]);

			$this->db->where('date >=', $start_ten);
			$this->db->where('date <=', $end_ten);
			$call = $this->db->get_where('calls',['user' => $user,'seconds >' => '0'])->num_rows();
			array_push($conversations, ['string' => $month_ten,'value' => $call]);

			$this->db->where('date >=', $start_eleven);
			$this->db->where('date <=', $end_eleven);
			$call = $this->db->get_where('calls',['user' => $user,'seconds >' => '0'])->num_rows();
			array_push($conversations, ['string' => $month_eleven,'value' => $call]);

			$this->db->where('date >=', $start_twelve);
			$this->db->where('date <=', $end_twelve);
			$call = $this->db->get_where('calls',['user' => $user,'seconds >' => '0'])->num_rows();
			array_push($conversations, ['string' => $month_twelve,'value' => $call]);

			$days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];

			$callsPerDay = [];
			foreach ($days as $dkey => $dvalue) {
				$day = $this->getWeekDayInRange($dvalue, $start_first,$end_twelve);	
				$call = 0;
				foreach ($day as $key => $value) {
					$call += $this->db->get_where('calls',['date' => $value,'user' => $user])->num_rows();
				}
				array_push($callsPerDay, ['string' => $dvalue,'value' => $call]);
			}

			$conversationsPerDay = [];
			foreach ($days as $dkey => $dvalue) {
				$day = $this->getWeekDayInRange($dvalue, $start_first,$end_twelve);	
				$call = 0;
				foreach ($day as $key => $value) {
					$call += $this->db->get_where('calls',['date' => $value,'user' => $user, 'seconds >' => '0'])->num_rows();
				}
				array_push($conversationsPerDay, ['string' => $dvalue,'value' => $call]);
			}


			$data = [];
			array_push($data,	['data' => $calls,'title' => 'Calls in this year','yTitle' => 'Calls','xTitle' => 'Months'] );
			array_push($data, 	['data' => $callsPerDay,'title' => 'Calls per day','yTitle' => 'Calls','xTitle' => 'Days']);
			array_push($data, 	['data' => $conversations,'title' => 'Conversations in this year','yTitle' => 'Conversations','xTitle' => 'Months']);
			array_push($data, 	['data' => $conversationsPerDay,'title' => 'Conversations per day','yTitle' => 'Conversations','xTitle' => 'Days']);
			

			$json = [
				'list'		=> $data
			];

		}
		$this->response($json);
	}

	public function getWeekDayInRange($weekday, $dateFromString, $dateToString, $format = 'Y-m-d')
    {
        $dateFrom = new \DateTime($dateFromString);
        $dateTo = new \DateTime($dateToString);
        $dates = [];

        if ($dateFrom > $dateTo) {
            return $dates;
        }

        if (date('N', strtotime($weekday)) != $dateFrom->format('N')) {
            $dateFrom->modify("next $weekday");
        }

        while ($dateFrom <= $dateTo) {
            $dates[] = $dateFrom->format($format);
            $dateFrom->modify('+1 week');
        }

        return $dates;
    }

	function date_range($first, $last, $step = '+1 day', $output_format = 'd/m/Y' ) {

	    $dates = array();
	    $current = strtotime($first);
	    $last = strtotime($last);

	    while( $current <= $last ) {

	        $dates[] = date($output_format, $current);
	        $current = strtotime($step, $current);
	    }

	    return $dates;
	}

	public function delete_member()
	{
		$this->db->where('id',$this->input->post('user'))->update('users',['group' => '','admin' => '','status' => '0']);

		$json = [
			'response'		=> 200,
			'_return'		=> true
		];
		$this->response($json);
	}

	public function get_members()
	{
		$users = $this->db->order_by('id','desc')->get_where('users' ,['group' => $this->input->post('group'),'df' => '','status' => '1']);
		$list = [];
		foreach ($users->result_array() as $key => $value) {
			$ar = [
				'id'			=> $value['id'],
				'name'			=> $value['name'],
				'email'			=> $value['email'],
				'phone'			=> $value['code'].$value['phone'],
				'date'			=> _vdatetime($value['created_at'])
			];
			array_push($list, $ar);
		}
		$json = [
			'count'		=> $users->num_rows(),
			'list'		=> $list
		];
		$this->response($json);
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

	public function goal_dashboard()
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
				'calls'				=> $calls,
				'conversations'		=> $conversations,
				'seconds'			=> $this->getMinuts($seconds),
				'avg_call'			=> $this->getAvgCall($calls, 1),
				'goal_calls'		=> $this->getGoal($_user['goal_calls'],$calls,"30"),
				'goal_conver'		=> $this->getGoal($_user['goal_conversation'],$conversations,"30"),
				'goal_minute'		=> $this->getGoal($_user['goal_minutes'],$seconds,"30",true),
				'goal_avg_call'		=> $this->getGoal($_user['goal_avg_call'],$this->getAvgCall($calls, 1),"30")
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
				'calls'				=> $calls,
				'conversations'		=> $conversations,
				'seconds'			=> $this->getMinuts($seconds),
				'avg_call'			=> $this->getAvgCall($calls, 1),
				'goal_calls'		=> $this->getGoal($_user['goal_calls'],$calls,"30"),
				'goal_conver'		=> $this->getGoal($_user['goal_conversation'],$conversations,"30"),
				'goal_minute'		=> $this->getGoal($_user['goal_minutes'],$seconds,"30",true),
				'goal_avg_call'		=> $this->getGoal($_user['goal_avg_call'],$this->getAvgCall($calls, 1),"30")
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
				'calls'				=> $calls,
				'conversations'		=> $conversations,
				'seconds'			=> $this->getMinuts($seconds),
				'avg_call'			=> 0,
				'goal_calls'		=> "0%",
				'goal_conver'		=> "0%",
				'goal_minute'		=> "0%",
				'goal_avg_call'		=> "0%"
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
				'calls'				=> $calls,
				'conversations'		=> $conversations,
				'seconds'			=> $this->getMinuts($seconds),
				'avg_call'			=> $this->getAvgCall($calls, 30),
				'goal_calls'		=> $this->getGoal($_user['goal_calls'],$calls,"1"),
				'goal_conver'		=> $this->getGoal($_user['goal_conversation'],$conversations,"1"),
				'goal_minute'		=> $this->getGoal($_user['goal_minutes'],$seconds,"1",true),
				'goal_avg_call'		=> $this->getGoal($_user['goal_avg_call'],$this->getAvgCall($calls, 1),"1")
			];
		}else if($type == "week"){
			$this->db->where('date >=',$this->x_week_range(date('Y-m-d'))[0]);
			$this->db->where('date <=',$this->x_week_range(date('Y-m-d'))[1]);
			$this->db->where('user',$user);
			$calls = $this->db->get('calls')->num_rows();
			$this->db->where('date >=',$this->x_week_range(date('Y-m-d'))[0]);
			$this->db->where('date <=',$this->x_week_range(date('Y-m-d'))[1]);
			$this->db->where('user',$user);
			$this->db->where('seconds >','0');
			$conversations = $this->db->get('calls')->num_rows();
			$this->db->select_sum('seconds');
			$this->db->where('date >=',$this->x_week_range(date('Y-m-d'))[0]);
			$this->db->where('date <=',$this->x_week_range(date('Y-m-d'))[1]);
			$this->db->where('user',$user);
			$seconds = $this->db->get('calls')->row()->seconds;
			if($seconds == null){ $seconds = 0; }
			$json = [
				'calls'				=> $calls,
				'conversations'		=> $conversations,
				'seconds'			=> $this->getMinuts($seconds),
				'avg_call'			=> $this->getAvgCall($calls, 7),
				'goal_calls'		=> $this->getGoal($_user['goal_calls'],$calls,"7"),
				'goal_conver'		=> $this->getGoal($_user['goal_conversation'],$conversations,"7"),
				'goal_minute'		=> $this->getGoal($_user['goal_minutes'],$seconds,"7",true),
				'goal_avg_call'		=> $this->getGoal($_user['goal_avg_call'],$this->getAvgCall($calls, 1),"7")
			];
		}

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
				'calls'				=> $calls,
				'conversations'		=> $conversations,
				'seconds'			=> $this->getMinuts($seconds),
				'avg_call'			=> $this->getAvgCall($calls, 1)
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
				'calls'				=> $calls,
				'conversations'		=> $conversations,
				'seconds'			=> $this->getMinuts($seconds),
				'avg_call'			=> $this->getAvgCall($calls, 1)
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
				'calls'				=> $calls,
				'conversations'		=> $conversations,
				'seconds'			=> $this->getMinuts($seconds),
				'avg_call'			=> 0
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
				'calls'				=> $calls,
				'conversations'		=> $conversations,
				'seconds'			=> $this->getMinuts($seconds),
				'avg_call'			=> $this->getAvgCall($calls, 30)
			];
		}else if($type == "week"){
			$this->db->where('date >=',$this->x_week_range(date('Y-m-d'))[0]);
			$this->db->where('date <=',$this->x_week_range(date('Y-m-d'))[1]);
			$this->db->where('user',$user);
			$calls = $this->db->get('calls')->num_rows();
			$this->db->where('date >=',$this->x_week_range(date('Y-m-d'))[0]);
			$this->db->where('date <=',$this->x_week_range(date('Y-m-d'))[1]);
			$this->db->where('user',$user);
			$this->db->where('seconds >','0');
			$conversations = $this->db->get('calls')->num_rows();
			$this->db->select_sum('seconds');
			$this->db->where('date >=',$this->x_week_range(date('Y-m-d'))[0]);
			$this->db->where('date <=',$this->x_week_range(date('Y-m-d'))[1]);
			$this->db->where('user',$user);
			$seconds = $this->db->get('calls')->row()->seconds;
			if($seconds == null){ $seconds = 0; }
			$json = [
				'calls'				=> $calls,
				'conversations'		=> $conversations,
				'seconds'			=> $this->getMinuts($seconds),
				'avg_call'			=> $this->getAvgCall($calls, 7)
			];
		}

		$this->response($json);
	}

	public function call_logs()
	{
		$user 		= $this->input->post('user');
		$data 		= $this->input->post('data');
		$last_date 	= $this->input->post('last_date');

		if($data != ""){
			foreach (explode("|", $data) as $key => $value) {
				$dataArray = explode("_", $value);
				$check = $this->db->get_where('calls',['user' => $user,'number' => $dataArray[1],'seconds' => $dataArray[1],'datetime' => date("Y-m-d H:i:s",strtotime($dataArray[2]))])->row_array();
				if($check == 0){
					$idata = [
						'number'	=> $dataArray[1],
						'seconds'	=> $dataArray[0],
						'date'		=> date("Y-m-d",strtotime($dataArray[2])),
						'datetime'	=> date("Y-m-d H:i:s",strtotime($dataArray[2])),
						'user'		=> $user
					];
					$this->db->insert('calls',$idata);
				}
			}

			$this->db->where('id',$user)->update('users',['last_fetched' => date("Y-m-d H:i:s",strtotime($last_date))]);	
		}
	}

	public function send_invite()
	{

		$user = $this->db->get_where('users',['email' => $this->input->post('email') ,'id !=' => $this->input->post('id')])->row_array();

		if(!$user){
			$data = [
				'name'			=> ucfirst($this->input->post('name')),
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
			$admin = $this->db->get_where('users',['id' => $admin['admin']])->row_array();
			$otp = $this->generate_otp($user['id'],"join");
			sendMail($user['email'],"Join Invitation",$this->load->view('mail/invitation',['otp' => $otp,'name' => ucfirst($user['name']),'admin' => $admin['name']],true));
			$json = [
				'response'		=> 200,
				'_return'		=> true
			];
		}else if($user['status'] == "1"){

			$json = [
				'response'		=> 200,
				'_return'		=> false,
				'message'		=> ""
			];	

		}else{
			if($user['type'] == "company"){
				$json = [
					'response'		=> 200,
					'_return'		=> false,
					'message'		=> 'company'
				];	
			}else if($user['type'] == "individual"){
				if($user['status'] != "1"){
					$data = [
						'group'			=> $this->input->post('group'), 
						'admin'			=> $this->input->post('id')
					];
					$this->db->where('id',$user['id'])->update('users',$data);
					$this->db->where('user',$user['id'])->where('for','join')->update('otp',['expired' => 'yes']);				
					$otp = $this->generate_otp($user['id'],"join");
					$link = "https://play.google.com/store/apps/details?id=".$this->input->post('application_id');
					sendMail($user['email'],"Login OTP",$this->load->view('mail/invitation',['otp' => $otp'name' => ucfirst($user['name']),'admin' => $admin['name']],true));

					$json = [
						'response'		=> 200,
						'_return'		=> true
					];
				}else{
					$json = [
						'response'		=> 200,
						'_return'		=> false,
						'message'		=> ""
					];			
				}
			}else{
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
					'_return'		=> false,
					'message'		=> ""
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
					'name'			=> ucfirst($this->input->post('name')),
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
				$otp = $this->generate_otp($user['id']);
				sendMail($user['email'],"Registration OTP",$this->load->view('mail/registration',['otp' => $otp,'name' => ucfirst($this->input->post('name'))],true));
				$json = $this->loginResponse($user,$otp);
			}else{
				$json = [
					'response'		=> 200,
					'_return'		=> false,
					'message'		=> "user"
				];
			}
			$this->response($json);
		}else if($this->input->post('type') == "individual"){

			$user = $this->db->get_where('users',['email' => $this->input->post('email'),'df' => ''])->row_array();
			if(!$user){
				$data = [
					'name'			=> ucfirst($this->input->post('name')),
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
				$otp = $this->generate_otp($user['id']);
				sendMail($user['email'],"Registration OTP",$this->load->view('mail/registration',['otp' => $otp,'name' => ucfirst($this->input->post('name')));
				$json = $this->loginResponse($user,$otp);
			}else{
				$json = [
					'response'		=> 200,
					'_return'		=> false,
					'message'		=> "user"
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

						$json = $this->loginResponse($user,"");	

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


	public function login()
	{
		$user = $this->db->get_where('users',['email' => $this->input->post('email'),'df' => ''])->row_array();
		if($user){

			$otp = $this->generate_otp($user['id']);
			sendMail($user['email'],"Login OTP",$this->load->view('mail/login',['otp' => $otp,'name' => ucfirst($user['name'])],true));
			$json = $this->loginResponse($user,$otp);

		}else{
			$json = [
				'response'		=> 200,
				'_return'		=> false
			];
		}
		$this->response($json);
	}

	public function refresh_session()
	{
		$user = $this->db->get_where('users',['id' => $this->input->post('id')])->row_array();
		$json = $this->loginResponse($user,"");
		$this->response($json);
	}


	public function loginResponse($user,$otp)
	{
		$data = [
				'response'				=> 200,
				'_return'				=> true,
				'otp'					=> $otp,
				'id'					=> $user['id'],	
				'name'					=> $user['name'],	
				'company'				=> $user['company'],	
				'code'					=> $user['code'],	
				'phone'					=> $user['phone'],	
				'email'					=> $user['email'],
				'type'					=> $user['type'],
				'last_upload'			=> $user['last_fetched'],
				'goal_calls'			=> $user['goal_calls'],
				'group_name'			=> $this->getGroupName($user),
				'group_count'			=> $this->getGroupCount($user['id'])
			];

		return $data;
	}


	public function getGroupCount($user)
	{
		return $this->db->get_where('group',['user' => $user,'df' => ''])->num_rows(); 
	}

	public function getGroupName($user)
	{
		if($user['status'] == "1" && $user['group'] != ""){
			return $this->db->get_where('group',['id' => $user['group']])->row_array()['name']; 
		}
		else{
			return "";
		}
	}

	public function generate_otp($user_id,$type = "login")
	{
		$otp = strtoupper($this->random_strings(8));
		$data = [
			'otp'			=> $otp,
			'for'			=> $type,
			'user'			=> $user_id,
			'created_at'	=> date('Y-m-d H:i:s')
		];
		$this->db->insert('otp',$data);
		return $otp;
	}

	function random_strings($length_of_string) 
	{ 
	  
	    // String of all alphanumeric character 
	    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
	  
	    // Shufle the $str_result and returns substring 
	    // of specified length 
	    return substr(str_shuffle($str_result),  
	                       0, $length_of_string); 
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

	public function getGoal($goal,$data,$time,$type = false)
	{
		if($goal != 0){
			if($type){
				$data = $data / 60;
			}
			$goal = $goal / $time;
			$percent = ($data * 100) / $goal;
			if($percent > 100){
				$percent = 100;
			}
			return $this->printDecimal($percent).'%';
		}else{
			return '0%';
		}
		
	}

	public function getMinuts($str)
	{
		$str = $str / 60;
		if($this->containsDecimal($str)){
			return $this->printDecimal($str);
		}
		return $str;
	}

	public function getAvgCall($value,$time)
	{
		$str = $value / $time;
		if($this->containsDecimal($str)){
			return $this->printDecimal($str);
		}
		return $str;
	}

	public function printDecimal($str)
	{
		if($this->containsDecimal($str)){
			return number_format($str, 2, ',', '');
		}
		return $str;	
	}

	function containsDecimal( $value ) {
	    if ( strpos( $value, "." ) !== false ) {
	        return true;
	    }
	    return false;
	}
}
?>