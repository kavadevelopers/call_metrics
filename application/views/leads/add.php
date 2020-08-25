<div class="page-header">
    <div class="row align-items-end">
        <div class="col-md-12">
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
        <form method="post" action="<?= base_url('leads/save') ?>" enctype="multipart/form-data">
            <div class="card-block">
                <div class="row">

                	<div class="col-md-3">
                        <div class="form-group">
                            <label>Date <span class="-req">*</span></label> 
                            <input name="date" type="text" placeholder="Date" class="form-control form-control-sm datepicker" value="<?= set_value('date',date('d-m-Y')); ?>" readonly>
                            <?= form_error('date') ?>
                        </div>
                    </div>

                    <?php if(get_user()['user_type'] == "0"){ ?>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Branch <span class="-req">*</span></label> 
                                <select class="form-control form-control-sm select2" name="branch" required>
                                	<option value="">-- Select Branch --</option>
                                	<?php foreach ($this->general_model->get_branches() as $bkey => $bvalue) { ?>
                                		<option value="<?= $bvalue['id'] ?>"><?= $bvalue['name'] ?></option>
                                	<?php } ?>
                                </select>
                                <?= form_error('branch') ?>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <input type="hidden" name="branch" value="<?= get_user()['branch'] ?>">
                    <?php } ?>

                    <?php if(get_user()['user_type'] == "0" || get_user()['user_type'] == "1"){ ?>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Lead Owner <span class="-req">*</span></label> 
                                <select class="form-control form-control-sm select2" name="owner" required>
                                    <option value="">-- Select --</option>
                                    <?php foreach ($this->general_model->get_lead_owners() as $bkey => $bvalue) { ?>
                                        <option value="<?= $bvalue['id'] ?>"><?= $bvalue['name'] ?> - <?= getRole($bvalue['user_type']) ?></option>
                                    <?php } ?>
                                </select>
                                <?= form_error('owner') ?>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <input type="hidden" name="owner" value="<?= get_user()['id'] ?>">
                    <?php } ?>    


                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Client Name<span class="-req">*</span></label> 
                            <input name="name" type="text" placeholder="Client Name" class="form-control form-control-sm" value="<?= set_value('name'); ?>" required>
                            <?= form_error('name') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Firm Name</label> 
                            <input name="firm" type="text" placeholder="Firm Name" class="form-control form-control-sm" value="<?= set_value('firm'); ?>">
                            <?= form_error('firm') ?>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Area/Village</label> 
                            <select class="form-control form-control-sm select2" name="area" onchange="otherArea(this.value);">
                                <option value="">-- Select Area/Village --</option>
                                <?php foreach ($this->general_model->get_areas() as $akey => $avalue) { ?>
                                    <option value="<?= $avalue['id'] ?>"><?= $avalue['name'] ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('area') ?>
                        </div>
                    </div>

                    <div class="col-md-3" style="display: none;" id="otherArea">
                        <div class="form-group">
                            <label>Other Area/Village Name <span class="-req">*</span></label> 
                            <input type="text" name="other_area_name" class="form-control form-control-sm other-area" autocomplete="off" placeholder="Other Area/Village Name">   
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>City/Taluka</label> 
                            <select class="form-control form-control-sm select2" name="city" >
                                <option value="">-- Select City/Taluka --</option>
                                <?php foreach ($this->general_model->get_cities() as $ckey => $cvalue) { ?>
                                    <option value="<?= $cvalue['id'] ?>" <?= selected($cvalue['id'],1) ?>><?= $cvalue['name'] ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('city') ?>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>District</label> 
                            <select class="form-control form-control-sm select2" name="district">
                                <option value="">-- Select District --</option>
                                <?php foreach ($this->general_model->get_districts() as $ckey => $cvalue) { ?>
                                    <option value="<?= $cvalue['id'] ?>" <?= selected($cvalue['id'],1) ?>><?= $cvalue['name'] ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('district') ?>
                        </div>
                    </div>

                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>State</label> 
                            <select class="form-control form-control-sm select2" name="state" >
                                <option value="">-- Select State --</option>
                                <?php foreach ($this->general_model->get_states() as $skey => $svalue) { ?>
                                    <option value="<?= $svalue['id'] ?>" <?= selected($svalue['id'],1) ?>><?= $svalue['name'] ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('state') ?>
                        </div>
                    </div>
                    

                    

                    <div class="col-md-12">
	                    <div class="row">

	                    	<div class="col-md-3">
		                        <div class="form-group">
		                            <label>Mobile <span class="-req">*</span></label> 
		                            <div class="mobile-body">
		                            	<input type="text" name="mobile[]" class="form-control form-control-sm numbers mobile-key-up" minlength="10" autocomplete="off" maxlength="10" placeholder="Mobile" required>	
		                            </div>
		                        </div>
		                    </div>
							
		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Email</label> 
		                            <div class="email-body">
		                            	<input type="email" name="email[]" class="form-control form-control-sm email-key-up" placeholder="Email" autocomplete="off">	
		                            </div>
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Services <span class="-req">*</span></label> 
		                            <div class="service-body">
		                            	<select class="form-control form-control-sm service-change select2" name="services[]" required>
	                    					<option value="">-- Select Service --</option>
	                    					<?php foreach ($this->general_model->get_services() as $sekey => $sevalue) { ?> 
	                    						<option value="<?= $sevalue['id'] ?>-<?=$sevalue['price']?>"><?= $sevalue['name'] ?></option>
	                    					<?php } ?>
	                    				</select>	
		                            </div>
		                        </div>
		                    </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Amount </label> 
                                    <div class="amount-body">
                                        <input type="text" name="amount[]" class="form-control form-control-sm decimal-num" autocomplete="off" placeholder="Amount">   
                                    </div>
                                </div>
                            </div>

	                    </div>
                    </div>

                    <div class="col-md-12">
	                    <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Landline</label> 
                                    <div class="landline-body">
                                        <input type="text" name="landline[]" class="form-control form-control-sm numbers landline-key-up" minlength="5" maxlength="11" autocomplete="off" placeholder="Landline">   
                                    </div>
                                </div>
                            </div>
	                    	<div class="col-md-3">
		                        <div class="form-group">
		                            <label>Importance</label> 
                                    <select class="form-control form-control-sm" name="importance">
                                        <option value="">-- Select --</option>
                                        <option value="High">High</option>
                                        <option value="Medium" selected>Medium</option>
                                        <option value="Low">Low</option>
                                    </select>   
		                            <?= form_error('importance') ?>
		                        </div>
		                    </div>
		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Next Follow up Date <span class="-req">*</span></label> 
		                            <input name="ndate" type="text" placeholder="Next Follow up Date" class="form-control form-control-sm datepicker-new" value="<?= set_value('ndate',date('d-m-Y')); ?>" readonly required>
		                            <?= form_error('ndate') ?>
		                        </div>
		                    </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Next Follow up Time</label> 
                                    <input name="nftime" type="text" placeholder="From" class="form-control form-control-sm hour-mask" value="" >
                                    <input name="nttime" type="text" placeholder="To" class="form-control form-control-sm hour-mask" value="" >
                                </div>
                            </div>

	                    </div>
	                </div>

	                <div class="col-md-12">
	                    <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Source <span class="-req">*</span></label> 
                                    <select class="form-control form-control-sm" name="source" required>
                                        <option value="">-- Select Source --</option>
                                        <?php foreach ($this->general_model->get_sources() as $sekey => $sevalue) { ?> 
                                            <option value="<?= $sevalue['id'] ?>" <?= get_user()['user_type'] == '3' ? $sevalue['id'] == '10' ?'selected':'':''  ?>><?= $sevalue['name'] ?></option>
                                        <?php } ?>
                                    </select>   
                                </div>
                            </div>
	                    	<div class="col-md-3">
		                        <div class="form-group">
		                            <label>Occupation</label> 
	                            	<select class="form-control form-control-sm" name="occupation">
                    					<option value="">-- Select Occupation --</option>
                    					<option value="Business">Business</option>
                    					<option value="Job">Job</option>
                    					<option value="Other">Other</option>
                    					<option value="Both">Both</option>
                    				</select>	
		                        </div>
		                    </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Special Quotation</label> 
                                    <input name="special_quote" type="text" placeholder="Special Quotation" class="form-control form-control-sm" value="<?= set_value('special_quote'); ?>">
                                    <?= form_error('special_quote') ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Remarks</label> 
                                    <textarea name="remarks" type="text" placeholder="Remarks" class="form-control form-control-sm" value=""><?= set_value('remarks'); ?></textarea>
                                    <?= form_error('remarks') ?>
                                </div>
                            </div>
	                    </div>
	                </div>


                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>ATTACHMENT</h4>
                                <table class="table table-bordered table-mini">
                                    <thead>
                                        <tr>
                                            <th>File Name</th>
                                            <th>File</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="body-attchment">
                                        <tr>
                                            <td>
                                                <input type="text" name="fileName[]" class="form-control" placeholder="File Name">
                                            </td>
                                            <td>
                                                <input type="file" name="file[]" class="form-control fileupload-change" onchange="readFile(this)">
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-danger btn-mini remove-row"><i class="fa fa-remove"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-right">
                                                <button type="button" class="btn btn-info btn-mini add-attechment-row"><i class="fa fa-plus"></i> Add Row</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
            	</div>
            </div>
            <div class="card-footer text-right">
                <a href="<?= base_url('leads') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-plus"></i> Add
                </button>
            </div>
        </form>
    </div>
</div>