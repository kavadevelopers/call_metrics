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
        <form method="post" action="<?= base_url('client/save') ?>" enctype="multipart/form-data" id="new_client_form">
            <div class="card-block">
                <div class="row">

                	<div class="col-md-3">
                        <div class="form-group">
                            <label>First Name<span class="-req">*</span></label> 
                            <input name="fname" type="text" placeholder="First Name" class="form-control form-control-sm" value="<?= set_value('fname',$lead['customer']); ?>" required>
                            <?= form_error('fname') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Middle Name</label> 
                            <input name="mname" type="text" placeholder="Middle Name" class="form-control form-control-sm" value="<?= set_value('mname'); ?>">
                            <?= form_error('mname') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Last Name<span class="-req">*</span></label> 
                            <input name="lname" type="text" placeholder="Last Name" class="form-control form-control-sm" value="<?= set_value('lname'); ?>" required>
                            <?= form_error('lname') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Firm Name</label> 
                            <input name="firm" type="text" placeholder="Firm Name" class="form-control form-control-sm" value="<?= set_value('firm',$lead['firm']); ?>" >
                            <?= form_error('firm') ?>
                        </div>
                    </div>

                    <div class="col-md-12">
	                    <div class="row">

	                    	<div class="col-md-3">
                                <div class="form-group">
                                    <label>Mobile <span class="-req">*</span></label> 
                                    <div class="mobile-body">
                                        <?php foreach (explode(',', $lead['mobile']) as $key => $value) { ?>
                                            <input type="text" name="mobile[]" class="form-control form-control-sm numbers mobile-key-up m-t2" minlength="10" autocomplete="off" maxlength="10" placeholder="Mobile" value="<?= $value ?>" <?= $key == '0'?'required':'' ?>>        
                                        <?php } ?>
                                        <input type="text" name="mobile[]" class="form-control form-control-sm numbers mobile-key-up m-t2" minlength="10" autocomplete="off" maxlength="10" placeholder="Mobile" >   
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Email</label> 
                                    <div class="email-body">
                                        <?php if($lead['email'] != ""){ foreach (explode(',', $lead['email']) as $key => $value) { ?>
                                            <input type="email" name="email[]" class="form-control form-control-sm email-key-up m-t2" placeholder="Email" value="<?= $value ?>" autocomplete="off">    
                                        <?php } } ?>
                                        <input type="email" name="email[]" class="form-control form-control-sm email-key-up m-t2" placeholder="Email" autocomplete="off">
                                    </div>
                                </div>
                            </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>PAN No.<span class="-req">*</span></label> 
		                            <input name="pan" type="text" placeholder="PAN No." class="form-control form-control-sm" value="<?= set_value('pan'); ?>" minlength="10" maxlength="10" pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}" id="panNo" required>
		                            <?= form_error('pan') ?>
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Date Of Birth <span class="-req">*</span></label> 
		                            <input name="dob" type="text" placeholder="Date Of Birth" class="form-control form-control-sm birth-date" value="" >
		                            <?= form_error('dob') ?>
		                        </div>
		                    </div>

	                    </div>
	                </div>

	                <div class="col-md-3">
                        <div class="form-group">
                            <label>Gender<span class="-req">*</span></label> 
                            <select class="form-control form-control-sm" name="gender" required>
                                <option value="">-- Select --</option>
                                <option value="MALE">MALE</option>
                                <option value="FEMALE">FEMALE</option>
                                <option value="NONE">NONE</option>
                            </select>   
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Address Line-1<span class="-req">*</span></label> 
                            <input name="add1" type="text" placeholder="Address Line-1" class="form-control form-control-sm" value="<?= set_value('add1'); ?>" required>
                            <?= form_error('add1') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Address Line-2</label> 
                            <input name="add2" type="text" placeholder="Address Line-2" class="form-control form-control-sm" value="<?= set_value('add2'); ?>" >
                            <?= form_error('add2') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Area/Village<span class="-req">*</span></label> 
                            <select class="form-control form-control-sm select2" name="area" required>
                            	<option value="">-- Select Area/Village --</option>
                            	<?php foreach ($this->general_model->get_areas() as $akey => $avalue) { ?>
                            		<option value="<?= $avalue['id'] ?>" <?= selected($lead['area'],$avalue['id']) ?>><?= $avalue['name'] ?></option>
                            	<?php } ?>
                            </select>
                            <?= form_error('area') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>City/Taluka<span class="-req">*</span></label> 
                            <select class="form-control form-control-sm select2" name="city" required>
                            	<option value="">-- Select City/Taluka --</option>
                            	<?php foreach ($this->general_model->get_cities() as $ckey => $cvalue) { ?>
                            		<option value="<?= $cvalue['id'] ?>" <?= selected($cvalue['id'],$lead['city'],1) ?>><?= $cvalue['name'] ?></option>
                            	<?php } ?>
                            </select>
                            <?= form_error('city') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>District<span class="-req">*</span></label> 
                            <select class="form-control form-control-sm select2" name="district" required>
                                <option value="">-- Select District --</option>
                                <?php foreach ($this->general_model->get_districts() as $ckey => $cvalue) { ?>
                                    <option value="<?= $cvalue['id'] ?>" <?= selected($cvalue['id'],$lead['district'],1) ?>><?= $cvalue['name'] ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('district') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>State<span class="-req">*</span></label> 
                            <select class="form-control form-control-sm select2" name="state" required>
                            	<option value="">-- Select State --</option>
                            	<?php foreach ($this->general_model->get_states() as $skey => $svalue) { ?>
                            		<option value="<?= $svalue['id'] ?>" <?= selected($svalue['id'],$lead['state'],1) ?>><?= $svalue['name'] ?></option>
                            	<?php } ?>
                            </select>
                            <?= form_error('state') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Pin</label> 
                            <input name="pin" type="text" placeholder="Pin" maxlength="6" minlength="6" class="form-control form-control-sm" value="<?= set_value('pin'); ?>" >
                            <?= form_error('pin') ?>
                        </div>
                    </div>

                    <div class="col-md-12">
	                    <div class="row">

	                    	<div class="col-md-3">
		                        <div class="form-group">
		                            <label>Language<span class="-req">*</span></label> 
		                            <div class="language-body">
			                            <select class="form-control form-control-sm language-change" name="language[]" required>
			                                <option value="">-- Select Language --</option>
			                                <option value="Gujarati" >Gujarati</option>
			                                <option value="Hindi">Hindi</option>
			                                <option value="English">English</option>
			                            </select>   
			                        </div>
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                        	<label>Prefered Time To Call</label> 
		                        	<div class="time-body">
		                        		<input name="time_to_call[]" type="text" placeholder="Add From To Time Here" class="form-control form-control-sm from-to-time" value="" >
		                        	</div>
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Health Insurance</label> 
		                            <select class="form-control form-control-sm" name="health_insurance">
		                                <option value="">-- Select --</option>
		                                <option value="YES">YES</option>
		                                <option value="NO">NO</option>
		                            </select>   
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Life Insurance</label> 
		                            <select class="form-control form-control-sm" name="life_insurance">
		                                <option value="">-- Select --</option>
		                                <option value="YES">YES</option>
		                                <option value="NO">NO</option>
		                            </select>   
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>ITR CLIENT<span class="-req">*</span></label> 
		                            <select class="form-control form-control-sm" name="itr_client" required>
		                                <option value="">-- Select --</option>
		                                <option value="YES">YES</option>
		                                <option value="NO">NO</option>
		                            </select>   
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>GST CLIENT<span class="-req">*</span></label> 
		                            <select class="form-control form-control-sm gst_client" name="gst_client" required>
		                                <option value="">-- Select --</option>
		                                <option value="YES">YES</option>
		                                <option value="NO">NO</option>
		                            </select>   
		                        </div>
		                    </div>

		                    <div class="col-md-3 gst_type_div" style="display: none;">
		                        <div class="form-group">
		                            <label>GST TYPE<span class="-req">*</span></label> 
		                            <select class="form-control form-control-sm gst_type" name="gst_type">
		                                <option value="">-- Select --</option>
		                                <option value="COMPOSITION">COMPOSITION</option>
		                                <option value="REGULAR">REGULAR</option>
		                            </select>   
		                        </div>
		                    </div>

		                    <div class="col-md-3 month_quater_div" style="display: none;">
		                        <div class="form-group">
		                            <label>Monthly/Quarterly<span class="-req">*</span></label> 
		                            <select class="form-control form-control-sm month_quater" name="month_quater">
		                                <option value="">-- Select --</option>
		                                <option value="MONTHLY">MONTHLY</option>
		                                <option value="QUATERLY">QUATERLY</option>
		                            </select>   
		                        </div>
		                    </div>


		                    <div class="col-md-12">
		                    	<h4>Profile</h4>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Occupation<span class="-req">*</span></label> 
		                            <select class="form-control form-control-sm occupation-onchange" name="occupation" required>
		                                <option value="">-- Select Occupation --</option>
		                                <option value="BUSINESS" <?= selected($lead['occupation'],"BUSINESS") ?>>BUSINESS</option>
		                                <option value="JOB" <?= selected($lead['occupation'],"JOB") ?>>JOB</option>
		                                <option value="OTHER" <?= selected($lead['occupation'],"OTHER") ?>>OTHER</option>
		                                <option value="BOTH" <?= selected($lead['occupation'],"BOTH") ?>>BOTH</option>
		                            </select>   
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Industry <span class="-req industry-required">*</span></label> 
		                            <select class="form-control form-control-sm customer-industry-select2" name="industry" required>
		                            	<option value="">-- Select Industry --</option>
		                            	<?php foreach ($this->general_model->list_industries() as $skey => $svalue) { ?>
		                            		<option value="<?= $svalue['id'] ?>"><?= $svalue['name'] ?></option>
		                            	<?php } ?>
		                            </select>
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Sub Industry<span class="-req sub-industry-required">*</span></label> 
		                            <select class="form-control form-control-sm select2 customer-sub-industry-select2" name="sub_industry" required>
		                            	<option value="">-- Select Sub Industry --</option>
		                            	<?php foreach ($this->general_model->list_subindustry() as $skey => $svalue) { ?>
		                            		<option value="<?= $svalue['id'] ?>"><?= $svalue['name'] ?></option>
		                            	<?php } ?>
		                            </select>
		                        </div>
		                    </div>

		                    <div class="col-md-3">
		                        <div class="form-group">
		                            <label>Industry Remarks</label> 
		                            <textarea name="ind_remaarks" type="text" placeholder="Industry Remarks" class="form-control form-control-sm" value="" ></textarea>
		                        </div>
		                    </div>

		                    

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Source <span class="-req">*</span></label> 
                                    <select class="form-control form-control-sm select2" name="source" required>
                                        <option value="">-- Select Source --</option>
                                        <?php foreach ($this->general_model->get_sources() as $sekey => $sevalue) { ?> 
                                            <option value="<?= $sevalue['id'] ?>" <?= selected($lead['source'], $sevalue['id']) ?>><?= $sevalue['name'] ?></option>
                                        <?php } ?>
                                    </select>   
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Client Type <span class="-req">*</span></label> 
                                    <select class="form-control form-control-sm select2" name="client_type" required>
                                        <option value="">-- Select --</option>
                                        <?php foreach ($this->general_model->get_client_types() as $sekey => $sevalue) { ?> 
                                            <option value="<?= $sevalue['id'] ?>" ><?= $sevalue['name'] ?></option> 
                                        <?php } ?>
                                    </select>   
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Profile Introduction</label> 
                                    <textarea name="profile_intro" type="text" placeholder="Profile Introduction" class="form-control form-control-sm" value="" ></textarea>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Actual Turnover & Stock & Other</label> 
                                    <textarea name="turnover_notes" type="text" placeholder="Actual Turnover & Stock & Other" class="form-control form-control-sm" value="" ></textarea>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Future Specific Goal</label> 
                                    <textarea name="goal" type="text" placeholder="Future Specific Goal" class="form-control form-control-sm" value="" ></textarea>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Special Quotation</label> 
                                    <textarea name="quotation" type="text" placeholder="Special Quotation" class="form-control form-control-sm" value="" ></textarea>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Referal Code</label> 
                                    <input name="refered_by" type="text" placeholder="Referal Code" class="form-control form-control-sm" value="<?= set_value('refered_by'); ?>">
                                    <?= form_error('refered_by') ?>
                                </div>
                            </div>

		                    <div class="col-md-12">
		                    	<h4>Services</h4>
		                    </div>

		                    <div class="col-md-3">
                                <div class="form-group">
                                    <label>Services <span class="-req">*</span></label> 
                                    <div class="cus-service-body">
                                        <?php foreach (json_decode($lead['services']) as $key => $value) { ?>
                                            <select class="form-control form-control-sm cus-service-change m-t2 select2" name="services[]" <?= $key == '0'?'required':'' ?>>
                                                <option value="">-- Select Service --</option>
                                                <?php foreach ($this->general_model->get_services() as $sekey => $sevalue) { ?> 
                                                    <option value="<?= $sevalue['id'] ?>-<?=$sevalue['price']?>" <?= selected($sevalue['id'],$value[0]) ?>><?= $sevalue['name'] ?></option>
                                                <?php } ?>
                                            </select>       
                                        <?php } ?>
                                        <select class="form-control form-control-sm cus-service-change m-t2 select2" name="services[]">
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
                                    <label>Quantity </label> 
                                    <div class="cus-qty-body">
                                        <?php foreach (json_decode($lead['services']) as $key => $value) { ?>
                                            <input type="text" name="qty[]" class="form-control form-control-sm numbers m-t2" value="1" autocomplete="off" placeholder="Quantity">      
                                        <?php } ?>
                                        <input type="text" name="qty[]" class="form-control form-control-sm numbers m-t2" autocomplete="off" placeholder="Quantity">   
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Amount </label> 
                                    <div class="cus-amount-body">
                                        <?php foreach (json_decode($lead['services']) as $key => $value) { ?>
                                            <input type="text" name="amount[]" class="form-control form-control-sm decimal-num m-t2" value="<?= $value[1] ?>" autocomplete="off" placeholder="Amount">      
                                        <?php } ?>
                                        <input type="text" name="amount[]" class="form-control form-control-sm decimal-num m-t2" autocomplete="off" placeholder="Amount">   
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <h4>Contact Persons</h4>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-bordered table-mini">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>Birth Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="contact_person_row">
                                        <tr>
                                            <td>
                                                <input type="text" name="con_name[]" class="form-control form-control-sm" placeholder="Name">
                                            </td>
                                            <td>
                                                <input type="text" name="con_mobile[]" class="form-control form-control-sm numbers" placeholder="Mobile" minlength="10" maxlength="10" >
                                            </td>
                                            <td>
                                                <textarea class="form-control" placeholder="Address" name="con_address[]"></textarea>
                                            </td>
                                            <td>
                                                <input type="text" name="con_birth[]" class="form-control form-control-sm birth-date" value="" placeholder="Birth Date" readonly>
                                            </td>
                                            <td>
                                                
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-right">
                                                <button class="btn btn-info btn-mini add_contact_personRow" type="button"><i class="fa fa-plus"></i> Add Row</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <input type="hidden" name="lead" value="<?= $lead['id'] ?>">
                            <input type="hidden" name="branch" value="<?= $lead['branch'] ?>">
                            <input type="hidden" name="owner" value="<?= $lead['owner'] ?>">
		                    <input type="hidden" name="client_id" value="<?= $client['id'] ?>">
	                    </div>
	                </div>

                </div>
            </div>
            <div class="card-footer text-right">
                <a href="<?= base_url('client/new_clients') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-save"></i> Save
                </button>
            </div>
        </form>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function($) {
        $('.service-body .select2-container').addClass('m-t2');  
    });
</script>