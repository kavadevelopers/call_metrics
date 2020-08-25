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
            	<form method="post" action="<?= base_url('filters/client_result') ?>">
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
		                            <label>First Name</label> 
		                            <input name="fname" type="text" placeholder="First Name" class="form-control form-control-sm" value="<?= $fname ?>" >
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Middle Name</label> 
		                            <input name="mname" type="text" placeholder="Middle Name" class="form-control form-control-sm" value="<?= $mname ?>">
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Last Name</label> 
		                            <input name="lname" type="text" placeholder="Last Name" class="form-control form-control-sm" value="<?= $lname ?>">
		                        </div>
		                    </div>
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
		                            <label>Health Insurance</label> 
		                            <select class="form-control form-control-sm" name="health_insurance">
		                                <option value="">-- Select --</option>
		                                <option value="YES" <?= selected('YES',$health_insurance) ?>>YES</option>
		                                <option value="NO" <?= selected('NO',$health_insurance) ?>>NO</option>
		                            </select>   
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Life Insurance</label> 
		                            <select class="form-control form-control-sm" name="life_insurance">
		                                <option value="">-- Select --</option>
		                                <option value="YES" <?= selected('YES',$life_insurance) ?>>YES</option>
		                                <option value="NO" <?= selected('NO',$life_insurance) ?>>NO</option>
		                            </select>   
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Language</label>
		                            <select class="form-control form-control-sm" name="language">
		                                <option value="">-- Select Language --</option>
		                                <option value="Gujarati" <?= selected('Gujarati',$language) ?>>Gujarati</option>
		                                <option value="Hindi" <?= selected('Hindi',$language) ?>>Hindi</option>
		                                <option value="English" <?= selected('English',$language) ?>>English</option>
		                            </select>   
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Industry </label> 
		                            <select class="form-control form-control-sm customer-industry-select2" name="industry">
		                            	<option value="">-- Select Industry --</option>
		                            	<?php foreach ($this->general_model->list_industries() as $skey => $svalue) { ?>
		                            		<option value="<?= $svalue['id'] ?>" <?= selected($industry,$svalue['id']) ?>><?= $svalue['name'] ?></option>
		                            	<?php } ?>
		                            </select>
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Sub Industry</label> 
		                            <select class="form-control form-control-sm select2 customer-sub-industry-select2" name="sub_industry">
		                            	<option value="">-- Select Sub Industry --</option>
		                            	<?php foreach ($this->general_model->list_subindustry() as $skey => $svalue) { ?>
		                            		<option value="<?= $svalue['id'] ?>" <?= selected($sub_industry,$svalue['id']) ?>><?= $svalue['name'] ?></option>
		                            	<?php } ?>
		                            </select>
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Gender</label> 
		                            <select class="form-control form-control-sm" name="gender">
		                                <option value="">-- Select --</option>
		                                <option value="MALE" <?= selected('MALE',$gender) ?>>MALE</option>
		                                <option value="FEMALE" <?= selected('FEMALE',$gender) ?>>FEMALE</option>
		                                <option value="NONE" <?= selected('NONE',$gender) ?>>NONE</option>
		                            </select>   
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Client Type</label> 
		                            <select class="form-control form-control-sm" name="type">
		                                <option value="">-- Select --</option>
		                                <option value="0" <?= selected('0',$type) ?>>Active</option>
		                                <option value="8" <?= selected('8',$type) ?>>In-Active</option>
		                                <option value="9" <?= selected('9',$type) ?>>Canceled</option>
		                            </select>   
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Birth Date</label> 
		                            <input name="bdate" type="text" placeholder="Birth Date" autocomplete="off" class="form-control form-control-sm birth-date" value="<?= $bdate ?>">
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
	                        <th>Customer Name</th>
	                        <th class="text-center">Contact</th>
	                        <th class="text-center">PAN</th>
	                        <th class="">Address</th>
	                        <?php if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){ ?>
	                            <th class="text-center">Created By</th>
	                        <?php } ?>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php foreach ($client as $key => $value) { ?>
	                        <tr>
	                            <td class="text-center"><?= $value['c_id'] ?></td>
	                            <td>
	                                <?= $value['fname'] ?> <?= $value['mname'] ?> <?= $value['lname'] ?>
	                                <?php if($value['firm']){ ?>
	                                    <br><b>Firm : </b><?= $value['firm'] ?>
	                                <?php } ?>
	                                <br>-<?= $value['gender'] ?>
	                            </td>
	                            <td class="text-center">
	                                <?php foreach (explode(",", $value['mobile']) as $mkey => $mvalue) { ?>
	                                    <?php if($mkey > 0){ ?><br><?php } ?>
	                                    <?= $mvalue ?>
	                                <?php } ?>
	                            </td>
	                            <td class="text-center"><?= $value['pan'] ?></td> 
	                            <td>
	                                <?= $value['add1'] ?>,<br>
	                                <?php if(!empty($value['add2'])){ ?><?= $value['add2'] ?>,<br> <?php } ?>
	                                <?=  $this->general_model->_get_area($value['area'])['name'] ?>, <?= $this->general_model->_get_city($value['city'])['name'] ?>, <?= $this->general_model->_get_district($value['district'])['name'] ?>, <?= $this->general_model->_get_state($value['state'])['name'] ?> <?= $value['pin'] != ''?",".$value['pin']:''; ?>
	                            </td>
	                            <?php if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){ ?>
	                                <td class="text-center">
	                                    <?= $this->general_model->_get_user($value['created_by'])['name'] ?>
	                                    <p class="text-center"><?= _vdatetime($value['created_at']) ?></p>
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