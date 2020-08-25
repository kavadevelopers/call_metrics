<div class="page-header">
    <div class="row align-items-end">
        <div class="col-md-6">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4>#<?= $client['c_id'] ?> - <?= $client['fname'] .' '.$client['mname'].' '.$client['lname'] ?></h4> 
                </div>
            </div>
        </div>
        <div class="col-md-6 text-right">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4 class="text-right">
                        OUTSTANDING : RS. <?= $this->general_model->getOutStandingClient($client['id'])[0]; ?> SINCE <?= $this->general_model->getOutStandingClient($client['id'])[1]; ?> DAYS
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="card">
        <div class="card-block dt-responsive table-responsive">

        	<div class="row">
        		<div class="col-md-12">
        			<ul class="nav nav-tabs tabs" role="tablist" >
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#basicTab" role="tab">Basic Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profileTab" role="tab">Profile</a>
                        </li>
                        <?php if( $client['contact_persons'] != "" && count(json_decode($client['contact_persons'])) > 0){ ?>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#contactPerson" role="tab">Contact Persons</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#addInfoTab" role="tab">Additional Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#invoiceTab" role="tab">Invoices</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#paymentsTab" role="tab">Payments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#activeJobTab" role="tab">Active Jobs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#jobHistoryTab" role="tab">Job History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#docTab" role="tab">Documents</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-danger" href="<?= base_url('client') ?>"><i class="fa fa-arrow-left"></i> Back</a>
                        </li>
                    </ul>
                    <div class="tab-content tabs card-block">
                        <?php if( $client['contact_persons'] != "" && count(json_decode($client['contact_persons'])) > 0){ ?>
                            <div class="tab-pane" id="contactPerson" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered small-table-kava">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Mobile</th>
                                                    <th>Address</th>
                                                    <th>Birth Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach (json_decode($client['contact_persons']) as $key => $value) { ?>
                                                    <tr>
                                                        <td><?= $value->name ?></td>
                                                        <td><?= $value->mobile ?></td>
                                                        <td><?= $value->name ?></td>
                                                        <td><?= $value->bdate ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>    
                        <?php } ?>
                    	<div class="tab-pane active" id="basicTab" role="tabpanel">
	                        <div class="row">
	                        	<div class="col-md-6">
	                        		<div class="table-responsive">
                                        <table class="table m-0 small-table-kava">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Full Name</th>
                                                    <td><?= $client['fname'] .' '.$client['mname'].' '.$client['lname'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Firm Name</th>
                                                    <td><?= $client['firm'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Mobile</th>
                                                    <td><?= $client['mobile'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Email</th>
                                                    <td><?= $client['email'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Address Line-1</th>
                                                    <td><?= $client['add1'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Address Line-2</th>
                                                    <td><?= $client['add2'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Area/Village</th>
                                                    <td><?= $this->general_model->_get_area($client['area'])['name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">City/Taluka</th>
                                                    <td><?= $this->general_model->_get_city($client['city'])['name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">District</th>
                                                    <td><?= $this->general_model->_get_district($client['district'])['name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">State</th>
                                                    <td><?= $this->general_model->_get_state($client['state'])['name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Pin</th>
                                                    <td><?= $client['pin'] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
	                        	</div>
	                        	<div class="col-md-6">
	                        		<div class="table-responsive">
                                        <table class="table m-0 small-table-kava">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">CLIENT ID</th>
                                                    <td><?= $client['c_id'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Client Type</th>
                                                    <td><?= $this->general_model->_get_client_type($client['client_type'])['name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">PAN</th>
                                                    <td><?= $client['pan'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Gender</th>
                                                    <td><?= $client['gender'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Birth Date</th>
                                                    <td><?= date('F d Y',strtotime($client['dob'])) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Language</th>
                                                    <td><?= $client['language'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Prefer Time To Call</th>
                                                    <td><?= $client['time_to_call'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Health Insurance</th>
                                                    <td><?= $client['health_in'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Life Insurance</th>
                                                    <td><?= $client['life_in'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">ITR CLIENT</th>
                                                    <td><?= $client['itr_client'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">GST CLIENT</th>
                                                    <td><?= $client['gst_client'] ?> <?= $client['gst_type'] != ""?"- ".$client['gst_type']:''; ?><?= $client['month_quater'] != ""?" - ".$client['month_quater']:''; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
	                        	</div>
	                        </div>
	                    </div>


	                    <div class="tab-pane" id="profileTab" role="tabpanel">
	                        <div class="row">
	                        	<div class="col-md-6">
	                        		<div class="table-responsive">
                                        <table class="table m-0 small-table-kava">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Occupation</th>
                                                    <td><?= $client['occupation'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Industry</th>
                                                    <td><?= $this->general_model->_get_industry($client['industry'])['name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Sub Industry</th>
                                                    <td><?= $this->general_model->_get_subindustry($client['sub_industry'])['name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Industry Remarks</th>
                                                    <td><?= nl2br($client['ind_remarks']) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Created By</th>
                                                    <td><?= $this->general_model->_get_user($client['created_by'])['name'] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
	                        	</div>
	                        	<div class="col-md-6">
	                        		<div class="table-responsive">
                                        <table class="table m-0 small-table-kava">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Profile Introduction</th>
                                                    <td><?= nl2br($client['profile_intro']) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Actual Turnover & Stock & Other</th>
                                                    <td><?= nl2br($client['turnover_notes']) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Future Specific Goal</th>
                                                    <td><?= nl2br($client['goal']) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Special Quotation</th>
                                                    <td><?= nl2br($client['quotation']) ?></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Created At</th>
                                                    <td><?= _vdatetime($client['created_at']) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
	                        	</div>
	                        </div>
	                    </div>

	                    <div class="tab-pane" id="invoiceTab" role="tabpanel">
	                        <div class="row">
	                        	<div class="col-md-12">
	                        		<div class="table-responsive">
                                        <?php $invoices = $this->db->order_by('date','desc')->get_where('invoice',['client' => $client['id']])->result_array(); ?>
                                        <table class="table table-striped table-bordered table-mini table-dt">
							                <thead>
							                    <tr>
							                        <th class="text-center">#</th>
							                        <th class="text-center">Date</th>
							                        <th>Customer Name</th>
							                        <th class="text-right">Amount</th>
							                        <th class="text-center">Action</th>
							                    </tr>
							                </thead>
							                <tbody>
							                    <?php foreach ($invoices as $key => $value) { ?>
							                        <?php $nclient = $this->general_model->_get_client($value['client']); ?>
							                        <tr>
							                            <td class="text-center"><?= $value['inv'] ?></td>
							                            <td class="text-center"><?= vd($value['date']) ?></td>
							                            <td><?= $nclient['fname'] ?> <?= $nclient['mname'] ?> <?= $nclient['lname'] ?></td>
							                            <td class="text-right"><?= $value['total'] ?></td>
							                            <td class="text-center">
							                                <a href="<?= base_url('pdf/invoice/').$value['id'] ?>" target="_blank" class="btn btn-primary btn-mini" title="PDF">
							                                    <i class="fa fa-file-pdf-o"></i>
							                                </a>
                                                            <a href="<?= base_url('pdf/invoiceD/').$value['id'] ?>" target="_blank" class="btn btn-secondary btn-mini" title="Download PDF">
                                                                <i class="fa fa-download"></i>
                                                            </a>
							                            </td>
							                        </tr>
							                    <?php } ?>
							                </tbody>
							            </table>
                                    </div>
	                        	</div>
	                        </div>
	                    </div>

	                    <div class="tab-pane" id="paymentsTab" role="tabpanel">
	                        <div class="row">
	                        	<div class="col-md-12">
	                        		<div class="table-responsive">
                                        <?php $invoices = $this->db->order_by('date','desc')->get_where('payment',['client' => $client['id']])->result_array(); ?>
                                        <table class="table table-striped table-bordered table-mini table-dt">
							                <thead>
							                    <tr>
							                        <th class="text-center">#</th>
							                        <th class="text-center">Date</th>
							                        <th>Customer Name</th>
							                        <th class="text-right">Amount</th>
							                        <th>Remarks</th>
							                        <th class="text-center">Approved</th>
							                        <?php if(get_user()['user_type'] == 0){ ?>
							                            <th>Payment By</th>
							                        <?php } ?>
							                        <th class="text-center">Action</th>
							                    </tr>
							                </thead>
							                <tbody>
							                    <?php foreach ($invoices as $key => $value) { ?>
							                        <?php $nclient = $this->general_model->_get_client($value['client']); ?>
							                        <tr>
							                            <td class="text-center"><?= $value['invoice'] ?></td>
							                            <td class="text-center"><?= vd($value['date']) ?></td>
							                            <td><?= $nclient['fname'] ?> <?= $nclient['mname'] ?> <?= $nclient['lname'] ?></td>
							                            <td class="text-right"><?= $value['amount'] ?></td>
							                            <td><?= nl2br($value['remarks']) ?></td>
							                            <td class="text-center">
							                                <?php if($value['status'] == 1){ ?>
							                                    <span class="pcoded-badge label label-success">Yes</span>
							                                <?php }else{ ?>
							                                    <span class="pcoded-badge label label-danger">No</span>
							                                <?php } ?>
							                            </td>
							                            <?php if(get_user()['user_type'] == 0){ ?>
							                                <td><?= $this->general_model->_get_user($value['created_by'])['name'] ?></td>
							                            <?php } ?>
							                            <td class="text-center">
							                                <a href="<?= base_url('pdf/receipt/').$value['id'] ?>" target="_blank" class="btn btn-primary btn-mini" title="PDF">
							                                    <i class="fa fa-file-pdf-o"></i>
							                                </a>
                                                            <a href="<?= base_url('pdf/receiptD/').$value['id'] ?>" target="_blank" class="btn btn-secondary btn-mini" title="Download PDF">
                                                                <i class="fa fa-download"></i>
                                                            </a>
							                            </td>
							                        </tr>
							                    <?php } ?>
							                </tbody>
							            </table>
                                    </div>
	                        	</div>
	                        </div>
	                    </div>

	                    <div class="tab-pane" id="activeJobTab" role="tabpanel">
	                        <div class="row">
	                        	<div class="col-md-12">
	                        		<div class="table-responsive">

	                        			<table class="table table-striped table-bordered table-mini table-dt">
							                <thead>
							                    <tr>
							                        <th class="text-center">#</th>
							                        <th>Service</th>
							                        <th class="text-right">Price</th>
							                        <th>Client</th>
							                        <th class="text-center">Status</th>
							                        <th class="text-center">Importance</th>
                                                    <th class="text-center">Next Followup Date</th>
							                        <?php if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){ ?>
							                            <th>Owner</th>
							                        <?php } ?>
							                        <th class="text-center">Action</th>
							                    </tr>
							                </thead>
							                <tbody>
							                	<?php $jobs = $this->db->get_where('job',['status <' => 3,'client' => $client['id']])->result_array(); ?>
							                    <?php foreach ($jobs as $key => $value) { ?>
							                        <?php $nclient = $this->general_model->_get_client($value['client']); ?>
							                        <tr>
							                            <td class="text-center"><?= $value['job_id'] ?></td>
							                            <td id="jobService<?= $value['id'] ?>"><?= $this->general_model->_get_service($value['service'])['name'] ?></td>
							                            <td class="text-right" id="jobPrice<?= $value['id'] ?>"><?= $value['price'] ?></td>
							                            <td><?= $nclient['fname'] ?> <?= $nclient['mname'] ?> <?= $nclient['lname'] ?></td>
							                            <td class="text-center" id="status-<?= $value['id'] ?>"><?= getjobStatus($value['status']) ?></td>
							                            <td class="text-center" id="jobImportance<?= $value['id'] ?>"><?= $value['importance'] ?></td>
                                                        <td class="text-center" id="jobFolllowupDate<?= $value['id'] ?>"><?= $value['f_date'] != null?vd($value['f_date']):'NA'; ?><?= get_from_to($value['f_time'],$value['t_time']) ?></td>
                                                        <?php if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){ ?>
							                                 <td><?= $this->general_model->_get_user($value['owner'])['name'] ?></td>
                                                        <?php } ?>
							                            <td class="text-center">
							                                <button class="btn btn-primary btn-mini edit-job" title="Edit" data-importance="<?= $value['importance'] ?>" data-job="<?= $value['id'] ?>" data-service="<?= $value['service'] ?>" data-price="<?= $value['price'] ?>" data-job_id="<?= $value['job_id'] ?>" data-client="<?= $nclient['fname'] ?> <?= $nclient['mname'] ?> <?= $nclient['lname'] ?>">
							                                    <i class="fa fa-pencil"></i>
							                                </button>
							                                <button type="button" class="btn btn-success btn-mini add-job-followup" data-status="<?= $value['status'] ?>" data-id="<?= $value['id'] ?>" data-stop="Job Is Closed" data-type="job" title="Check Followup">
							                                    <i class="fa fa-question"></i>
							                                </button>
							                            </td>
							                        </tr>
							                    <?php } ?>
							                </tbody>
							            </table>

	                        		</div>
	                        	</div>
	                        </div>
	                    </div>

	                    <div class="tab-pane" id="jobHistoryTab" role="tabpanel">
	                        <div class="row">
	                        	<div class="col-md-12">
	                        		<div class="table-responsive">

	                        			<table class="table table-striped table-bordered table-mini table-dt">
							                <thead>
							                    <tr>
							                        <th class="text-center">#</th>
							                        <th>Service</th>
							                        <th class="text-right">Price</th>
							                        <th>Client</th>
							                        <th class="text-center">Status</th>
							                        <th class="text-center">Importance</th>
							                        <?php if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){ ?>
							                            <th>Owner</th>
							                        <?php } ?>
							                        <th class="text-center">Action</th>
							                    </tr>
							                </thead>
							                <tbody>
							                	<?php $jobs = $this->db->get_where('job',['status >=' => 3,'client' => $client['id']])->result_array(); ?>
							                    <?php foreach ($jobs as $key => $value) { ?>
							                        <?php $nclient = $this->general_model->_get_client($value['client']); ?>
							                        <tr>
							                            <td class="text-center"><?= $value['job_id'] ?></td>
							                            <td><?= $this->general_model->_get_service($value['service'])['name'] ?></td>
							                            <td class="text-right"><?= $value['price'] ?></td>
							                            <td><?= $nclient['fname'] ?> <?= $nclient['mname'] ?> <?= $nclient['lname'] ?></td>
							                            <td class="text-center" id="status-<?= $value['id'] ?>"><?= getjobStatus($value['status']) ?></td>
							                            <td class="text-center"><?= $value['importance'] ?></td>
                                                        <?php if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){ ?>
							                                 <td><?= $this->general_model->_get_user($value['owner'])['name'] ?></td>
                                                        <?php } ?>
							                            <td class="text-center">
							                                <button type="button" class="btn btn-success btn-mini add-job-followup" data-status="<?= $value['status'] ?>" data-id="<?= $value['id'] ?>" data-stop="Job Is Closed" data-type="job" title="Check Followup">
							                                    <i class="fa fa-question"></i>
							                                </button>
							                            </td>
							                        </tr>
							                    <?php } ?>
							                </tbody>
							            </table>

	                        		</div>
	                        	</div>
	                        </div>
	                    </div>

	                    <div class="tab-pane" id="docTab" role="tabpanel">
	                        <div class="row">
	                        	<div class="col-md-12">
	                        		<div class="table-responsive">

                                        <?php if($client['lead'] != ""){ ?>
                                            <?php $lead = $this->general_model->_get_lead($client['lead']);
                                            $docs = $this->db->get_where('files',['for' => 'Lead' , 'for_id' => $lead['id']])->result_array() ?>
                                            <?php if($docs){ ?>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th colspan="2">Lead</th>
                                                </tr>
                                                <?php foreach ($docs as $key => $value) { ?>
                                                    <tr class="remove-file">
                                                        <td width="5%"></td>
                                                        <td>
                                                            <div class="row col-md-12">
                                                                <?php if($value['type'] == 'png' || $value['type'] == 'jpg' || $value['type'] == 'jpeg'){ ?>
                                                                    <img src="<?= base_url('uploads/doc/').$value['filename'] ?>" class="list-images" style="width: 20px;"> 
                                                                <?php } ?>
                                                                <?php if($value['type'] == 'docx'){ ?>
                                                                    <img src="<?= base_url('asset/images/word.jpg') ?>" class="list-images" style="width: 20px;"> 
                                                                <?php } ?>
                                                                <?php if($value['type'] == 'csv' || $value['type'] == 'xlsx'){ ?>
                                                                    <img src="<?= base_url('asset/images/excel.jpg') ?>" class="list-images" style="width: 20px;"> 
                                                                <?php } ?>
                                                                <?php if($value['type'] == 'pdf'){ ?>
                                                                    <img src="<?= base_url('asset/images/pdf.jpg') ?>" class="list-images" style="width: 20px;"> 
                                                                <?php } ?>
                                                                <span class="list-image-span"><?=  $value['name'] ?></span>
                                                                <a href="<?= base_url('uploads/doc/').$value['filename'] ?>" target="_blank" title="Download" download><i class="fa fa-download"></i></a> &nbsp;&nbsp;
                                                                <a href="javascript:;" type="button" class="remove-file-lead" data-id="<?= $value['id'] ?>" title="Delete"><i class="fa fa-trash"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </table>
                                        <?php } } ?>



                                        <?php  
                                        $this->db->order_by('date','desc');
                                        $this->db->distinct();
                                        $this->db->select('folder');
                                        $this->db->where('client', $client['id']); 
                                        $docs = $this->db->get('documents')->result_array();
                                        if($docs){
                                        ?>
                                            <table class="table table-bordered">
                                                <?php foreach ($docs as $dkey => $dvalue) { ?>
                                                    <?php 
                                                    $this->db->distinct();
                                                    $this->db->select('sub_folder');
                                                    $this->db->where('client', $client['id']); 
                                                    $this->db->where('folder', $dvalue['folder']); 
                                                    $subdocs = $this->db->get('documents')->result_array();
                                                    if($subdocs){
                                                    ?>
                                                    <tr>
                                                        <th colspan="3"><?= $this->general_model->_get_doc_folder($dvalue['folder'])['name']; ?></th>
                                                    </tr>
                                                    <?php foreach ($subdocs as $sdkey => $sdvalue) { ?>
                                                        <tr>
                                                            <td width="5%"></td>
                                                            <th colspan="2"><?= $this->general_model->_get_doc_subfolder($sdvalue['sub_folder'])['name']; ?></th>
                                                        </tr>
                                                        <?php $documents = $this->general_model->_get_documents_by_subfolder($sdvalue['sub_folder'],$client['id']) ?>
                                                        <?php foreach ($documents as $dokey => $dovalue) { ?>
                                                            <tr class="remove-doc-tr">
                                                                <td width="5%"></td>
                                                                <td width="5%"></td>
                                                                <td>
                                                                    <div class="row col-md-12">
                                                                        <?php if($dovalue['type'] == 'png' || $dovalue['type'] == 'jpg' || $dovalue['type'] == 'jpeg'){ ?>
                                                                            <img src="<?= base_url('uploads/doc/').$dovalue['file'] ?>" class="list-images" style="width: 20px;"> 
                                                                        <?php } ?>
                                                                        <?php if($dovalue['type'] == 'docx'){ ?>
                                                                            <img src="<?= base_url('asset/images/word.jpg') ?>" class="list-images" style="width: 20px;"> 
                                                                        <?php } ?>
                                                                        <?php if($dovalue['type'] == 'csv' || $dovalue['type'] == 'xlsx'){ ?>
                                                                            <img src="<?= base_url('asset/images/excel.jpg') ?>" class="list-images" style="width: 20px;"> 
                                                                        <?php } ?>
                                                                        <?php if($dovalue['type'] == 'pdf'){ ?>
                                                                            <img src="<?= base_url('asset/images/pdf.jpg') ?>" class="list-images" style="width: 20px;"> 
                                                                        <?php } ?>
                                                                        <span class="list-image-span"><?=  $dovalue['name'] ?></span>
                                                                        <a href="<?= base_url('uploads/doc/').$dovalue['file'] ?>" target="_blank" title="Download" download="CLIENT-<?= $client['c_id'] ?>-<?=  $dovalue['name'] ?>.<?=  $dovalue['type'] ?>">
                                                                            <i class="fa fa-download"></i>
                                                                        </a>
                                                                        &nbsp;&nbsp;
                                                                        <a href="javascript:;" type="button" class="remove-file-client" data-id="<?= $dovalue['id'] ?>" title="Delete">
                                                                            <i class="fa fa-trash"></i>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } } ?>
                                                <?php } ?>
                                            </table>
                                        <?php } ?>


                                        <form method="post" action="<?= base_url('client/uploadDoc/').$client['id'] ?>" enctype="multipart/form-data">
                                            <table class="table table-bordered table-mini">
                                                <thead>
                                                    <tr>
                                                        <th>Folder Name</th>
                                                        <th>Sub Folder Name</th>
                                                        <th>File Name</th>
                                                        <th>File</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="body-attchment-client">
                                                    <tr id="docTr0">
                                                        <td>
                                                            <select class="form-control form-control-sm select2 docMainFolder" id="docFolder0" name="folder[]" required>
                                                                <option value="">-- Select Folder Name --</option>
                                                                <?php foreach ($this->general_model->get_folder_name() as $key => $value) { ?>
                                                                    <option value="<?= $value['id'] ?>" data-sub="<?= $this->general_model->getSubFolders($value['id']) ?>"><?= $value['name'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="form-control form-control-sm select2 docSubFolder" id="docSubFolder0" name="sub_folder[]" required>
                                                                <option value="">-- Select Sub-Folder Name --</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="fileName[]" class="form-control" placeholder="File Name" required>
                                                        </td>
                                                        <td>
                                                            <input type="file" name="file[]" class="form-control fileupload-change" onchange="readFile(this)" required>
                                                        </td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-danger btn-mini remove-row"><i class="fa fa-remove"></i></button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="5" class="text-right">
                                                            <button type="button" class="btn btn-info btn-mini add-attechment-row-client"><i class="fa fa-plus"></i> Add Row</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5" class="text-right">
                                                            <button type="submit" class="btn btn-info btn-mini"><i class="fa fa-upload"></i> Upload</button>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </form>

	                        		</div>
	                        	</div>
	                        </div>
	                    </div>

	                    <div class="tab-pane" id="addInfoTab" role="tabpanel">
	                        <div class="row">
	                        	<div class="col-md-12">
	                        		<div class="table-responsive">

                                        <?php $parentGet = $this->db->get_where('grouping',['child' => $client['id']])->row_array() ?>
                                        <?php if($parentGet){ ?>
                                            <div class="col-md-12">
                                                <h5>Parent Group</h5>
                                                <br>

                                                <table class="table table-striped table-bordered table-mini">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Parent Client</th>
                                                            <th>Child Name</th>
                                                            <th class="text-center">Relation</th>
                                                            <th class="text-center">Child Id</th>
                                                            <th>Remarks</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $group = $this->db->get_where('grouping',['main' => $parentGet['main']])->result_array(); ?>
                                                        <?php foreach ($group as $key => $value) { ?>
                                                            <?php $nclient = $this->general_model->_get_client($value['child']); ?>
                                                            <tr>
                                                                <td class="text-center"><?= $client['group'] ?></td>
                                                                <td><?= $nclient['fname'].' '.$nclient['mname'].' '.$nclient['lname'] ?></td>
                                                                <td class="text-center"><?= $value['relation'] ?></td>
                                                                <td class="text-center"><?= $nclient['c_id'] ?></td>
                                                                <td><?= nl2br($value['remarks']) ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>               
                                        <?php } ?>                         

                                        <div class="col-md-12">
                                            <h5>Child Group</h5>
                                            <br>
                                            <form type="post" id="addGroupForm">
    	                                        <table class="table table-striped table-bordered table-mini">
    								                <thead>
    								                    <tr>
    								                        <th class="text-center">Parent Client</th>
                                                            <th>Child Name</th>
                                                            <th class="text-center">Relation</th>
                                                            <th class="text-center">Child Id</th>
                                                            <th>Remarks</th>
    								                    </tr>
    								                </thead>
    								                <tbody id="addGroupTbody">
    								                	<?php $group = $this->db->get_where('grouping',['main' => $client['id']])->result_array(); ?>
    								                    <?php foreach ($group as $key => $value) { ?>
    								                    	<?php $nclient = $this->general_model->_get_client($value['child']); ?>
    									                	<tr>
    									                		<td class="text-center"><?= $client['group'] ?></td>
    									                		<td><?= $nclient['fname'].' '.$nclient['mname'].' '.$nclient['lname'] ?></td>
    									                		<td class="text-center"><?= $value['relation'] ?></td>
    									                		<td class="text-center"><?= $nclient['c_id'] ?></td>
    									                		<td><?= nl2br($value['remarks']) ?></td>
    									                	</tr>
    								                	<?php } ?>
    								                </tbody>
    								                <tfoot>
    								                	<tr>
    								                		<td>
    								                			<input type="text" name="" class="form-control" value="<?= $client['group'] ?>" readonly>
    								                			<input type="hidden" id="addGroupChild" class="form-control" value="<?= $client['id'] ?>" readonly>
    								                		</td>
    								                		<td>
    								                			<select class="form-control form-control-sm select2" id="addGroupMain" required>
    							                                    <option value="">-- Select Child Client--</option>
    							                                    <?php foreach ($this->general_model->getFilteredClients() as $bkey => $bvalue) { ?>
    							                                        <option value="<?= $bvalue['id'] ?>"><?= $bvalue['fname'] ?> <?= $bvalue['mname'] ?> <?= $bvalue['lname'] ?> - <?= $bvalue['mobile'] ?></option>
    							                                    <?php } ?>
    							                                </select>
    								                		</td>
    								                		<td>
    								                			<input type="text" id="addGroupRelation" class="form-control" placeholder="Relation" value=""  required>
    								                		</td>
    								                		<td>
    								                			<textarea class="form-control" id="addGroupRemarks" placeholder="remarks"></textarea>
    								                		</td>
    								                		<td>
    								                			<button class="btn btn-mini btn-success" type="submit" id="addGroupSubmitBtn"><i class="fa fa-plus"></i></button>
    								                		</td>
    								                	</tr>
    								                </tfoot>
    								            </table>
    							            </form>
                                        </div>

                                        <div class="col-md-12">
                                            <form method="post" action="<?= base_url('client/add_family_person') ?>">
                                            <h5>Earning Person In Family</h5>
                                            <br>
                                            <table class="table table-striped table-bordered table-mini">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th>Name</th>
                                                        <th class="text-center">Relation</th>
                                                        <th class="text-center">Mobile</th>
                                                        <th class="text-center">Email</th>
                                                        <th>Filling ITR</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $fMamber = $this->db->get_where('family',['client' => $client['id']])->result_array(); ?>
                                                    <?php foreach ($fMamber as $fmkey => $fmvalue) { ?>
                                                        <tr>
                                                            <td><?= $fmkey + 1 ?></td>
                                                            <td><?= $fmvalue['name'] ?></td>
                                                            <td style="text-align: center;"><?= $fmvalue['relation'] ?></td>
                                                            <td style="text-align: center;"><?= $fmvalue['mobile'] ?></td>
                                                            <td><?= $fmvalue['email'] ?></td>
                                                            <td style="text-align: center;"><?= $fmvalue['itr'] ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td></td>
                                                        <td><input type="text" name="name" class="form-control form-control-sm" placeholder="Name" required></td>
                                                        <td><input type="text" name="relation" class="form-control form-control-sm" placeholder="Relation" required></td>
                                                        <td><input type="text" name="mobile" class="form-control form-control-sm numbers" maxlength="10" minlength="10" placeholder="Mobile" required></td>
                                                        <td><input type="email" name="email" class="form-control form-control-sm" placeholder="Email" required></td>
                                                        <td>
                                                            <select name="itr" class="form-control" required>
                                                                <option value="">Select</option>
                                                                <option value="YES">YES</option>
                                                                <option value="NO">NO</option>
                                                            </select>
                                                            <input type="hidden" name="client" value="<?= $client['id'] ?>">
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-mini btn-success" type="submit"><i class="fa fa-plus"></i></button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            </form>
                                        </div>


	                        		</div>
	                        	</div>
	                        </div>
	                    </div>

                    </div>
        		</div>
        	</div>

    	</div>
    </div>
</div>


<script type="text/javascript">
	$(document).on('click','.nav-item', function(){
		$('.tab-pane').removeClass('active');
		$('#'+$(this).children('.nav-link').attr('href').substr(1)).addClass('active');
	});
</script>


