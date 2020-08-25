<?php
class Request extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function payment()
	{
		$data['_title']		= "Payment Requests";
		$data['invoices']	= $this->db->order_by('date','asc')->get_where('payment',['status' => '0'])->result_array();
		$this->load->theme('request/payment',$data);		
	}

	public function payment_approve()
	{
		$payment = $this->db->get_where('payment',['id' => $this->input->post('id')])->row_array();
		$data = [
			'type'		=> payment(),
			'client'	=> $payment['client'],
			'date'		=> $payment['date'],
			'main'		=> $payment['id'],
			'credit'	=> $payment['amount'],
		];
		$this->db->insert('transaction',$data);

		$this->db->where('id',$payment['id'])->update('payment',['status'=>1 ]);
	}

}
?>