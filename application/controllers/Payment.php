<?php
class Payment extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function index()
	{
		$data['_title']		= "Receipt";
		$data['invoices']	= $this->general_model->getPayments();
		$this->load->theme('payment/index',$data);		
	}

	public function save()
	{
		$date = dd($this->input->post('date'));
		if(get_user()['user_type'] == 0){
			$status = 1;
		}else{
			$status = 0;
		}
		$client = $this->general_model->_get_client($this->input->post('client'));

		$company = $this->general_model->_get_company($client['company']);
		$payment_count = $this->db->get_where('payment',['company' => $company['id']])->num_rows();
		$data = [
			'date'			=> $date,
			'invoice'		=> $company['receipt_prefix'].'_'.($payment_count + 1),
			'client'		=> $this->input->post('client'),
			'branch'		=> $client['branch'],
			'company'		=> $client['company'],
			'amount'		=> $this->input->post('amount'),
			'pay_type'		=> $this->input->post('payment_type'),
			'pay_remarks'		=> $this->input->post('pay_remarks'),
			'remarks'		=> $this->input->post('remarks'),
			'status'		=> $status,
			'created_by'	=> get_user()['id'],
			'created_at'	=> date('Y-m-d H:i:s')
		];

		$this->db->insert('payment',$data);
		$inv_id = $this->db->insert_id();

		if(get_user()['user_type'] == 0){
			$data = [
				'type'		=> payment(),
				'client'	=> $this->input->post('client'),
				'date'		=> $date,
				'main'		=> $inv_id,
				'credit'		=> $this->input->post('amount'),
			];
			$this->db->insert('transaction',$data);
		}

		$this->session->set_flashdata('msg', 'Payment Added');
	    redirect(base_url('payment'));
	}

	public function update()
	{
		$date = dd($this->input->post('date'));
		
		$client = $this->general_model->_get_client($this->input->post('client'));

		$company = $this->general_model->_get_company($client['company']);
		
		$data = [
			'date'			=> $date,
			'client'		=> $this->input->post('client'),
			'branch'		=> $client['branch'],
			'company'		=> $client['company'],
			'pay_type'		=> $this->input->post('payment_type'),
			'pay_remarks'		=> $this->input->post('pay_remarks'),
			'amount'		=> $this->input->post('amount'),
			'remarks'		=> $this->input->post('remarks')
		];

		$this->db->where('id',$this->input->post('id'))->update('payment',$data);

		$this->session->set_flashdata('msg', 'Payment Updated');
	    redirect(base_url('payment'));
	}

	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('payment');
		$this->session->set_flashdata('msg', 'Payment Deleted');
	    redirect(base_url('payment'));	
	}
}
?>