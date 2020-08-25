<?php
class Generate_bill extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth->check_session();
	}

	public function index()
	{
		$data['_title']		= "Job List";
		$this->db->select('client');
		$this->db->order_by('id','asc');
		$this->db->group_by('client');
		$this->db->where('status','3');
		$data['list'] = $this->db->get('job')->result_array();
		$this->load->theme('bill/generate',$data);		
	}

	public function all()
	{

		$date = date('Y-m-d');

		foreach ($this->input->post('jobId') as $key => $value) {
			$this->db->where('id',$this->input->post('jobId')[$key]);
			$this->db->update('job',['price' => $this->input->post('price')[$key],'qty' => $this->input->post('qty')[$key]]);
		}
		$jobIds = "";
		foreach ($this->input->post('jobId') as $key => $value) {
			$jobIds .= $value.',';
		}

		$jobIds = explode(',',rtrim($jobIds,','));

		$this->db->where_in('id',$jobIds);
		$jobs = $this->db->get('job')->result_array();

		$client = $this->general_model->_get_client($this->input->post('client'));


		$invoice = $this->db->get_where('invoice',['company' => $client['company']])->num_rows();

		$data = [
			'inv'				=> $this->general_model->_get_company($client['company'])['prefix']."_".($invoice + 1),
			'company'			=> $client['company'],
			'branch'			=> $client['branch'],
			'client'			=> $this->input->post('client'),
			'date'				=> $date,
			'remarks'			=> $this->input->post('remarks'),
			'created_at'		=> date('Y-m-d H:i:s'),
			'created_by'		=> get_user()['id']
		];
		$this->db->insert('invoice',$data);
		$inv_id = $this->db->insert_id();
		$total = 0;
		foreach ($jobs as $key => $value) {
			$total += $value['price'] * $value['qty'];

			$data = [
				'service'			=> $value['service'],
				'price'				=> $value['price'],
				'qty'				=> $value['qty'],
				'total'				=> $value['price'] * $value['qty'],
				'invoice'			=> $inv_id
			];
			$this->db->insert('invoice_details',$data);

			if($value['service'] == 1 || $value['service'] == 2 || $value['service'] == 3){
				$this->db->where('id',$this->input->post('client'))->update('client',['itr_amount' => $value['price']]);
			}

			$data = [
				'remarks'		=> "Bill Generated",
				'next_f'		=> $date,
				'customer'		=> $this->input->post('client'),
				'date'			=> date('Y-m-d H:i:s'),
				'ftime'			=> null,
				'ttime'			=> null,
				'type'			=> "job",
				'main_id'		=> $value['id'],
				'needed'		=> 0,
				'followup_by'	=> get_user()['id']
			];
			$this->db->insert('followup',$data);

			$this->db->where('id',$value['id'])->update('job',['f_date' => $date,'f_time'	=> null,'t_time' => null,'status'	=> 4]);
		}

		$this->db->where('id',$inv_id)->update('invoice',['total' => $total]);


		$data = [
			'type'		=> invoice(),
			'client'	=> $this->input->post('client'),
			'date'		=> $date,
			'main'		=> $inv_id,
			'debit'		=> $total,
		];
		$this->db->insert('transaction',$data);

		$this->session->set_flashdata('msg', 'Bill Generated');
	    redirect(base_url('generate_bill'));
	}

	public function single()
	{
		$date = date('Y-m-d');

		$this->db->where('id',$this->input->post('job'));
		$this->db->update('job',['price' => $this->input->post('price'),'qty' => $this->input->post('qty')]);

		$this->db->where('id',$this->input->post('job'));
		$jobs = $this->db->get('job')->row_array();

		$client = $this->general_model->_get_client($jobs['client']);


		$invoice = $this->db->get_where('invoice',['company' => $client['company']])->num_rows();

		$data = [
			'inv'				=> $this->general_model->_get_company($client['company'])['prefix']."_".($invoice + 1),
			'company'			=> $client['company'],
			'branch'			=> $client['branch'],
			'client'			=> $client['id'],
			'remarks'			=> $this->input->post('remarks'),
			'date'				=> $date,
			'created_at'		=> date('Y-m-d H:i:s'),
			'created_by'		=> get_user()['id']
		];
		$this->db->insert('invoice',$data);
		$inv_id = $this->db->insert_id();
		$total = 0;
		$total += $jobs['price'] * $jobs['qty'];

		$data = [
			'service'			=> $jobs['service'],
			'price'				=> $jobs['price'],
			'qty'				=> $jobs['qty'],
			'total'				=> $jobs['price'] * $jobs['qty'],
			'invoice'			=> $inv_id
		];
		$this->db->insert('invoice_details',$data);

		$data = [
			'remarks'		=> "Bill Generated",
			'next_f'		=> $date,
			'customer'		=> $client['id'],
			'date'			=> date('Y-m-d H:i:s'),
			'ftime'			=> null,
			'ttime'			=> null,
			'type'			=> "job",
			'main_id'		=> $jobs['id'],
			'needed'		=> 0,
			'followup_by'	=> get_user()['id']
		];
		$this->db->insert('followup',$data);

		$this->db->where('id',$jobs['id'])->update('job',['f_date' => $date,'f_time'	=> null,'t_time' => null,'status'	=> 4]);

		$this->db->where('id',$inv_id)->update('invoice',['total' => $total]);


		$data = [
			'type'		=> invoice(),
			'client'	=> $client['id'],
			'date'		=> $date,
			'main'		=> $inv_id,
			'debit'		=> $total,
		];
		$this->db->insert('transaction',$data);

		$this->session->set_flashdata('msg', 'Bill Generated');
	    redirect(base_url('generate_bill'));
	}


	public function getJob()
	{
		$this->db->where('id',$this->input->post('job'));
		$jobs = $this->db->get('job')->row_array();

		$service = $this->general_model->_get_service($jobs['service']);

		echo json_encode(['job' => $this->input->post('job'),'qty' => $jobs['qty'],'price' => $jobs['price'],'service' => $service['name']]);
	}

	public function getJobs()
	{
		$job = explode(',', rtrim($this->input->post('job'),','));
		
		$this->db->where_in('id',$job);
		$jobs = $this->db->get('job')->result_array();


		$str = "";
		foreach ($jobs as $key => $job) {
			$service = $this->general_model->_get_service($job['service']);
			
			$str .= '<div class="col-md-3"><input type="hidden" class="generateFullBillJobList" value="'.$job['id'].'" name="jobId[]">';
				$str .= '<div class="form-group">';
					$str .= '<label>Service <span class="-req">*</span></label> ';
					$str .= '<input name="" type="text" placeholder="Service" class="form-control form-control-sm" id="" value="'.$service["name"].'" title="'.$service["name"].'" readonly>';
					$str .= '</div></div>';
			$str .= '<div class="col-md-3">';
                $str .= '<div class="form-group">';
                    $str .= '<label>Qty <span class="-req">*</span></label>';
                    $str .= '<input name="qty[]" type="text" placeholder="Qty" class="form-control form-control-sm numbers" onkeyup="invoiceTotal ();" id="generateBillQty'.$job['id'].'" value="'.$job['qty'].'" required>';
					$str .= '</div></div> ';
			$str .= '<div class="col-md-3">';
                $str .= '<div class="form-group">';
                    $str .= '<label>Price <span class="-req">*</span></label>';
                    $str .= '<input name="price[]" type="text" placeholder="Price" class="form-control form-control-sm decimal-num" onkeyup="invoiceTotal ();" id="generateBillPrice'.$job['id'].'" value="'.$job['price'].'" required></div></div>';
                    $str .= '<div class="col-md-3">
                              <div class="form-group">
                                <label>Total</label>
                                <input name="" type="text" placeholder="Total" class="form-control form-control-sm" id="generateBillTotal'.$job['id'].'" value="" readonly>
                            </div>';
                	$str .= '</div></div>';
		}

		echo json_encode(['client' => $this->input->post('client'),'list' => $str]);
	}
}

?>