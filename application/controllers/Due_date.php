<?php
class Due_date extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function index()
	{
		$data['_title']		= "Due Dates";
		$data['list']		= $this->db->order_by('id','desc')->get_where('due_dates')->result_array();
		$this->load->theme('due_date',$data);
	}

	public function save()
	{
		$this->form_validation->set_error_delimiters('<div class="val-error">', '</div>');
		$this->form_validation->set_rules('remarks', 'Remarks','trim|required');
		$this->form_validation->set_rules('date', 'Date','trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$data['_title']		= "Due Dates";
			$data['list']		= $this->db->order_by('id','desc')->get_where('due_dates')->result_array();
			$this->load->theme('due_date',$data);
		}else{
			$data = [
				'date'		=> dd($this->input->post('date')),
				'remarks' 	=>	$this->input->post('remarks'),
				'dt' 		=>	date('Y-m-d')
			];
			$this->db->insert('due_dates',$data);
			$this->session->set_flashdata('msg', 'Due Date Added');
	        redirect(base_url('due_date'));
		}
	}

	public function delete($id = false)
	{
		$this->db->where('id',$id);
		$this->db->delete('due_dates');

		$this->session->set_flashdata('msg', 'Due Date Deleted');
	    redirect(base_url('due_date'));
	}

}
?>