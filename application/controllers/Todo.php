<?php
class Todo extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function index()
	{
		$data['_title']		= "To-Do";
		$data['todo']		= $this->general_model->getToDo();
		$this->load->theme('todo/index',$data);		
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
			'to'	=> $this->input->post('owner'),
			'from'	=> get_user()['id'],
			'ftime'	=> $ftime,
			'ttime'	=> $ttime,
			'remarks'	=>  $this->input->post('remarks'),
			'date'	=>  dd($this->input->post('date'))
		];

		$this->db->insert('todo',$data);

		$this->session->set_flashdata('msg', 'To-Do Added');
	    redirect(base_url('todo'));
	}

	public function delete()
	{
		$this->db->where('id',$this->input->post('id'))->delete('todo');
	}
}
?>