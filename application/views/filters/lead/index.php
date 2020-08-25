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
            	<form method="post" action="<?= base_url('filters/lead_result') ?>">
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
		                            <label>Area</label>
		                            <select class="form-control form-control-sm select2" name="area">
		                                <option value="">-- Select --</option>
		                                <?php foreach ($this->general_model->get_areas() as $key => $value) { ?>
		                                    <option value="<?= $value['id'] ?>" <?= selected($area,$value['id']) ?>><?= $value['name'] ?></option>
		                                <?php } ?>
		                            </select>
		                        </div>
		            		</div>
		            		<div class="col-md-3">
		                        <div class="form-group">
		                            <label>City/Taluka</label>
		                            <select class="form-control form-control-sm select2" name="city">
		                                <option value="">-- Select --</option>
		                                <?php foreach ($this->general_model->get_cities() as $key => $value) { ?>
		                                    <option value="<?= $value['id'] ?>" <?= selected($city,$value['id']) ?>><?= $value['name'] ?></option>
		                                <?php } ?>
		                            </select>
		                        </div>
		            		</div>
		            		<div class="col-md-3">
		                        <div class="form-group">
		                            <label>District</label> 
		                            <select class="form-control form-control-sm select2" name="district">
		                                <option value="">-- Select --</option>
		                                <?php foreach ($this->general_model->get_districts() as $ckey => $cvalue) { ?>
		                                    <option value="<?= $cvalue['id'] ?>" <?= selected($district,$cvalue['id']) ?>><?= $cvalue['name'] ?></option>
		                                <?php } ?>
		                            </select>
		                        </div>
		                    </div>

		                    
		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>State</label> 
		                            <select class="form-control form-control-sm select2" name="state" >
		                                <option value="">-- Select --</option>
		                                <?php foreach ($this->general_model->get_states() as $skey => $svalue) { ?>
		                                    <option value="<?= $svalue['id'] ?>" <?= selected($state,$svalue['id']) ?>><?= $svalue['name'] ?></option>
		                                <?php } ?>
		                            </select>
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Source</label> 
		                            <select class="form-control form-control-sm select2" name="source">
		                                <option value="">-- Select --</option>
		                                <?php foreach ($this->general_model->get_sources() as $skey => $svalue) { ?>
		                                    <option value="<?= $svalue['id'] ?>" <?= selected($source,$svalue['id']) ?>><?= $svalue['name'] ?></option>
		                                <?php } ?>
		                            </select>
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Service</label> 
		                            <div class="service-body">
		                            	<select class="form-control form-control-sm select2" name="service">
	                    					<option value="">-- Select --</option>
	                    					<?php foreach ($this->general_model->get_services() as $sekey => $sevalue) { ?> 
	                    						<option value="<?= $sevalue['id'] ?>" <?= selected($service,$sevalue['id']) ?>><?= $sevalue['name'] ?></option>
	                    					<?php } ?>
	                    				</select>	
		                            </div>
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Importance</label> 
                                    <select class="form-control form-control-sm" name="importance">
                                        <option value="">-- Select --</option>
                                        <option value="High" <?= selected($importance,"High") ?>>High</option>
                                        <option value="Medium" <?= selected($importance,"Medium") ?>>Medium</option>
                                        <option value="Low" <?= selected($importance,"Low") ?>>Low</option>
                                    </select>   
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Occupation</label> 
	                            	<select class="form-control form-control-sm" name="occupation">
                    					<option value="">-- Select --</option>
                    					<option value="Business" <?= selected('Business',$occupation) ?>>Business</option>
                    					<option value="Job" <?= selected('Job',$occupation) ?>>Job</option>
                    					<option value="Other" <?= selected('Other',$occupation) ?>>Other</option>
                    					<option value="Both" <?= selected('Both',$occupation) ?>>Both</option>
                    				</select>	
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Lead Type</label> 
	                            	<select class="form-control form-control-sm" name="type">
                    					<option value="">-- Select --</option>
                    					<option value="active" <?= selected('active',$type) ?>>Active</option>
                    					<option value="converted" <?= selected('converted',$type) ?>>Converted</option>
                    					<option value="dump" <?= selected('dump',$type) ?>>Dump</option>
                    				</select>	
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Next Followup Date</label> 
		                            <input name="nfdate" type="text" placeholder="Next Followup Date" autocomplete="off" class="form-control form-control-sm datepicker" value="<?= $nfdate ?>">
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
	                        <th class="">Area</th>
	                        <th class="">Importance</th>
	                        <th class="text-center">Contact</th>
	                        <th class="">Services</th>
	                        <th class="text-center">Next Followup Date</th>
	                        <?php if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){ ?>
	                            <th>User</th>
	                        <?php } ?>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php foreach ($leads as $key => $value) { ?>
	                        <tr id="tr-lead-<?= $value['id'] ?>">
	                            <td class="text-center"><?= $value['lead'] ?></td>
	                            <td class="text-center"><?= vd($value['date']) ?></td>
	                            <td>
	                                <?= $value['customer'] ?>
	                                <?= $value['firm'] != ''?'<br>-'.$value['firm']:'' ?>        
	                            </td>
	                            <td class="">
	                                <?= $this->general_model->_get_area($value['area'])['name'] ?>,<br> <?= $this->general_model->_get_city($value['city'])['name'] ?>,<br> <?= $this->general_model->_get_district($value['district'])['name'] ?>,<br> <?= $this->general_model->_get_state($value['state'])['name'] ?>
	                            </td>
	                            <th class="text-center"><?= $value['importance'] ?></th>
	                            <td class="text-center">
	                                <?php foreach (explode(",", $value['mobile']) as $mkey => $mvalue) { ?>
	                                    <?php if($mkey > 0){ ?><br><?php } ?>
	                                    <?= $mvalue ?>
	                                <?php } ?>
	                            </td>
	                            <td class="">
	                                <?php foreach (json_decode($value['services']) as $mkey => $mvalue) { ?>
	                                    <?php if($mkey > 0){ ?><br><?php } ?>
	                                    <?= $this->general_model->_get_service($mvalue[0])['name'] ?>
	                                <?php } ?>
	                            </td>
	                            <td class="text-center" id="fdate-<?= $value['id'] ?>">
	                                <?= vd($value['next_followup_date']) ?>
	                                <?= get_from_to($value['tfrom'],$value['tto']) ?>
	                            </td>
	                            <?php if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){ ?>
	                                <td>
	                                    <?= $this->general_model->_get_user($value['owner'])['name'] ?>
	                                    <br><p><b>Branch</b> : <?= $this->general_model->_get_branch($value['branch'])['name'] ?></p>        
	                                </td>
	                            <?php } ?>
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