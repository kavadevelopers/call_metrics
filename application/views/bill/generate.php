<div class="page-header">
    <div class="row align-items-end">
        <div class="col-md-6">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4><?= $_title ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="page-body">
    <div class="card">
        <div class="card-block dt-responsive table-responsive">

        	<?php foreach ($list as $key => $value) { ?>
        		<?php $customer = $this->db->order_by('status','desc')->get_where('job',['status <=' => 3,'client' => $value['client']])->num_rows(); ?>
        		<?php $customer_done = $this->db->order_by('status','desc')->get_where('job',['status' => 3,'client' => $value['client']])->num_rows(); ?>
        		<table class="table table-striped table-bordered table-mini m-t2">
	                <thead>
	                    <tr>
	                    	<th></th>
	                        <th class="text-center">#</th>
	                        <th>Service</th>
	                        <th class="text-right">Price</th>
	                        <th>Client</th>
	                        <th class="text-center">Status</th>
	                        <th class="text-center">Importance</th>
	                        <th class="text-center">
	                        	<button class="btn btn-info btn-mini generateFullBill<?= $value['client'] ?>" onclick="generateMultipleBill('<?= $value['client'] ?>');">		Generate Full Bill
	                        	</button>
	                        </th>
	                    </tr>
	                </thead>
	                <tbody>
	                	<?php $customer = $this->db->order_by('status','desc')->get_where('job',['status <=' => 3,'client' => $value['client']])->result_array(); ?>
	            		<?php foreach ($customer as $ckey => $cvalue) { ?>
	            			<?php $client = $this->general_model->_get_client($cvalue['client']); ?>
	            			<tr>
	            				<td class="text-center">
	                                <div class="checkbox-fade fade-in-primary d-">
	                                    <label>
	                                        <input type="checkbox" class="generateBill<?= $value['client'] ?>" value="<?= $cvalue['id'] ?>">
	                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
	                                    </label>
	                                </div>
	                            </td>
	            				<td class="text-center"><?= $cvalue['job_id'] ?></td>
	            				<td><?= $this->general_model->_get_service($cvalue['service'])['name'] ?></td>
	            				<td class="text-right"><?= $cvalue['price'] ?></td>
	                            <td><?= $client['fname'] ?> <?= $client['mname'] ?> <?= $client['lname'] ?></td>
	                            <td class="text-center" id="status-<?= $cvalue['id'] ?>"><?= getjobStatus($cvalue['status']) ?></td>
	                            <td class="text-center"><?= $cvalue['importance'] ?></td>
	                            <td class="text-center">
	                            	<?php if($cvalue['status'] == 3){ ?>
	                            		<button class="btn btn-info btn-mini generateBill" data-job="<?= $cvalue['id'] ?>">Generate Bill</button>
	                            	<?php } ?>
	                            </td>
	            			</tr>
						<?php } ?>	

	                </tbody>
	            </table>

        	<?php } ?>

    	</div>
    </div>
</div>