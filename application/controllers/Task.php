<?php
class Task extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function my_task()
	{
		$data['_title']		= "My Task";		
		$data['other']		= $this->db->order_by('id','desc')->get_where('task',['from' => get_user()['id'],'done' => 0])->result_array();
		$data['task']		= $this->db->order_by('id','desc')->get_where('task',['to' => get_user()['id'],'done' => 0])->result_array();
		$this->load->theme('task/my_task',$data);			
	}

	public function other()
	{
		$data['_title']		= "Other Task";		
		$data['task']		= $this->db->order_by('id','desc')->get_where('task',['from' => get_user()['id'],'done' => 0])->result_array();
		$this->load->theme('task/other',$data);			
	}

	public function save()
	{
		$data = [
			'name'	=> strtoupper($this->input->post('name')),
			'to'	=> $this->input->post('to'),
			'from'	=> get_user()['id'],
			'date'	=> date('Y-m-d')
		];

		$this->db->insert('task',$data);
		$task = $this->db->insert_id();

		$data = [
			'desc'	=> strtoupper("New Task For You"),
			'to'	=> $this->input->post('to'),
			'from'	=> get_user()['id'],
			'task'	=> $task
		];
		$this->db->insert('task_reply',$data);

		$this->session->set_flashdata('msg', 'Task Added');
	    redirect(base_url('task/my_task'));
	}

	public function done($id)
	{
		$this->db->where('id',$id)->update('task',['done' => '1']);
		$this->session->set_flashdata('msg', 'Task Completed');
	    redirect(base_url('task/my_task'));
	}

	public function view($id)
	{
		$data['_title']		= "Task";	
		$data['task']		= $this->db->get_where('task',['id' => $id])->row_array();
		$data['replys']		= $this->db->order_by('id','desc')->get_where('task_reply',['task' => $id])->result_array();
		$this->load->theme('task/view',$data);	
	}

	public function reply()
	{
		$data = [
			'desc'	=> strtoupper($this->input->post('desc')),
			'to'	=> $this->input->post('to'),
			'from'	=> $this->input->post('from'),
			'task'	=> $this->input->post('task')
		];
		$this->db->insert('task_reply',$data);

		$this->session->set_flashdata('msg', 'Task Added');
	    redirect(base_url('task/view/'.$this->input->post('task')));
	}
}
