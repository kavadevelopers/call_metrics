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
    <div class="row">
    	<div class="col-md-12">
            <div class="card">
            	<form method="post" action="<?= base_url('filters/invoice_result') ?>">
            		<div class="card-block">
		            	<div class="row">
		            		<?php if(get_user()['user_type'] == "0"){ ?>
		                        <div class="col-md-3">
		                            <div class="form-group">
		                                <label>Branch</label> 
		                                <select class="form-control form-control-sm select2" name="branch" >
		                                	<option value="">-- Select Branch --</option>
		                                	<?php foreach ($this->general_model->get_branches() as $bkey => $bvalue) { ?>
		                                		<option value="<?= $bvalue['id'] ?>" <?= selected($branch,$bvalue['id']) ?>><?= $bvalue['name'] ?></option>
		                                	<?php } ?>
		                                </select>
		                            </div>
		                        </div>
		                    <?php }else{ ?>
		                        <input type="hidden" name="branch" value="<?= get_user()['branch'] ?>">
		                    <?php } ?>
		                    
		                    <div class="col-md-3">
	                            <div class="form-group">
	                                <label>Company</label> 
	                                <select class="form-control form-control-sm select2" name="company" >
	                                	<option value="">-- Select --</option>
	                                	<?php foreach ($this->general_model->list_company() as $bkey => $bvalue) { ?>
	                                		<option value="<?= $bvalue['id'] ?>" <?= selected($company,$bvalue['id']) ?>><?= $bvalue['name'] ?></option>
	                                	<?php } ?>
	                                </select>
	                            </div>
	                        </div>

	                        <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Amount Order</label> 
		                            <select class="form-control form-control-sm" name="order_by">
		                                <option value="">-- Select --</option>
		                                <option value="desc" <?= selected($order_by,"desc") ?>>High</option>
		                                <option value="asc" <?= selected($order_by,"asc") ?>>Low</option>
		                            </select>   
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>From Date</label> 
		                            <input name="fdate" type="text" placeholder="From Date" autocomplete="off" class="form-control form-control-sm datepicker" value="<?= $fdate ?>">
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>To Date</label> 
		                            <input name="tdate" type="text" placeholder="To Date" autocomplete="off" class="form-control form-control-sm datepicker" value="<?= $tdate ?>">
		                        </div>
		                    </div>
		            	</div>
	            	</div>
	            	<div class="card-footer text-right">
	            		<button class="btn btn-success" type="submit"><i class="fa fa-filter"></i> Filter</button>
	            	</div>
            	</form>
            </div>
        </div>
	</div>
</div>

<?php if($result){ ?>


	<div class="page-body">
	    <div class="card">
	        <div class="card-block dt-responsive table-responsive">
	            <table class="table table-striped table-bordered table-mini" id="res">
	                <thead>
	                    <tr>
	                        <th class="text-center">#</th>
	                        <th class="text-center">Date</th>
	                        <th>Customer Name</th>
	                        <th class="text-right">Amount</th>
	                        <th>Created By</th>
	                        <th class="text-center">Action</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php foreach ($invoices as $key => $value) { ?>
	                        <?php $client = $this->general_model->_get_client($value['client']); ?>
	                        <tr>
	                            <td class="text-center"><?= $value['inv'] ?></td>
	                            <td class="text-center"><?= vd($value['date']) ?></td>
	                            <td><?= $client['fname'] ?> <?= $client['mname'] ?> <?= $client['lname'] ?></td>
	                            <td class="text-right"><?= $value['total'] ?></td>
	                            <td>
	                                <?= $this->general_model->_get_user($value['created_by'])['name'] ?>
	                                <?php if(get_user()['user_type'] == 0 && $value['created_by'] != 1){ ?>
	                                    <br><p><b>Branch</b> : <?= $this->general_model->_get_branch($value['branch'])['name'] ?></p>  
	                                <?php } ?>
	                            </td>
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

<?php } ?>


<script type="text/javascript" language="javascript" >  
 $(function(){ 
    $('#res').DataTable({
            "paging": false,
           "dom": "<'row'<'col-md-6'i>>",
            order : []
        }); 
    });
</script>