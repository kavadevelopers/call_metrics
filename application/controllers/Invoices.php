<?php
class Invoices extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function index()
	{
		$data['_title']		= "Invoice";
		$data['invoices']	= $this->general_model->getInvoices();
		$this->load->theme('invoice/index',$data);		
	}


}
?>