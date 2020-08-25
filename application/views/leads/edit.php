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
        <form method="post" action="<?= base_url('leads/update') ?>" enctype="multipart/form-data">
            <div class="card-block">
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Date <span class="-req">*</span></label> 
                            <input name="date" type="text" placeholder="Date" class="form-control form-control-sm datepicker" value="<?= set_value('date',vd($lead['date'])); ?>" readonly>
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
                                        <option value="<?= $bvalue['id'] ?>" <?= selected($lead['branch'],$bvalue['id']) ?>><?= $bvalue['name'] ?></option>
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
                                        <option value="<?= $bvalue['id'] ?>" <?= selected($lead['owner'],$bvalue['id']) ?>><?= $bvalue['name'] ?> - <?= getRole($bvalue['user_type']) ?></option>
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
                            <input name="name" type="text" placeholder="Client Name" class="form-control form-control-sm" value="<?= set_value('name',$lead['customer']); ?>" required>
                            <?= form_error('name') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Firm Name</label> 
                            <input name="firm" type="text" placeholder="Firm Name" class="form-control form-control-sm" value="<?= set_value('firm',$lead['firm']); ?>">
                            <?= form_error('firm') ?>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Area/Village</label> 
                            <select class="form-control form-control-sm select2" name="area" onchange="otherArea(this.value);">
                                <option value="">-- Select Area/Village --</option>
                                <?php foreach ($this->general_model->get_areas() as $akey => $avalue) { ?>
                                    <option value="<?= $avalue['id'] ?>" <?= selected($lead['area'],$avalue['id']) ?>><?= $avalue['name'] ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('area') ?>
                        </div>
                    </div>

                    <div class="col-md-3" style="<?= $lead['area'] == '3244'?'':'display: none;'; ?>" id="otherArea">
                        <div class="form-group">
                            <label>Other Area/Village Name <span class="-req">*</span></label> 
                            <input type="text" name="other_area_name" class="form-control form-control-sm other-area" autocomplete="off" value="<?= $lead['other_area'] ?>" placeholder="Other Area/Village Name">   
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>City/Taluka</label> 
                            <select class="form-control form-control-sm select2" name="city" >
                                <option value="">-- Select City/Taluka --</option>
                                <?php foreach ($this->general_model->get_cities() as $ckey => $cvalue) { ?>
                                    <option value="<?= $cvalue['id'] ?>" <?= selected($lead['city'],$cvalue['id']) ?>><?= $cvalue['name'] ?></option>
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
                                    <option value="<?= $cvalue['id'] ?>" <?= selected($cvalue['id'],$lead['district']) ?>><?= $cvalue['name'] ?></option>
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
                                    <option value="<?= $svalue['id'] ?>" <?= selected($lead['state'],$svalue['id']) ?>><?= $svalue['name'] ?></option>
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
                                    <label>Services <span class="-req">*</span></label> 
                                    <div class="service-body">
                                        <?php foreach (json_decode($lead['services']) as $key => $value) { ?>
                                            <select class="form-control form-control-sm service-change m-t2 select2" name="services[]" <?= $key == '0'?'required':'' ?>>
                                                <option value="">-- Select Service --</option>
                                                <?php foreach ($this->general_model->get_services() as $sekey => $sevalue) { ?> 
                                                    <option value="<?= $sevalue['id'] ?>-<?=$sevalue['price']?>" <?= selected($sevalue['id'],$value[0]) ?>><?= $sevalue['name'] ?></option>
                                                <?php } ?>
                                            </select>       
                                        <?php } ?>
                                        <select class="form-control form-control-sm service-change m-t2 select2" name="services[]">
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
                                        <?php foreach (json_decode($lead['services']) as $key => $value) { ?>
                                            <input type="text" name="amount[]" class="form-control form-control-sm decimal-num m-t2" value="<?= $value[1] ?>" autocomplete="off" placeholder="Amount">      
                                        <?php } ?>
                                        <input type="text" name="amount[]" class="form-control form-control-sm decimal-num m-t2" autocomplete="off" placeholder="Amount">   
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
                                        <?php if($lead['landline'] != ""){ foreach (explode(',', $lead['landline']) as $key => $value) { ?>
                                            <input type="text" name="landline[]" class="form-control form-control-sm numbers landline-key-up m-t2" minlength="5" maxlength="11" autocomplete="off" placeholder="Landline" value="<?= $value ?>">   
                                        <?php }} ?>
                                            <input type="text" name="landline[]" class="form-control form-control-sm numbers landline-key-up m-t2" minlength="5" maxlength="11" autocomplete="off" placeholder="Landline">   
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Importance</label> 
                                    <select class="form-control form-control-sm" name="importance">
                                        <option value="">-- Select --</option>
                                        <option value="High" <?= selected($lead['importance'],"High") ?>>High</option>
                                        <option value="Medium" <?= selected($lead['importance'],"Medium") ?>>Medium</option>
                                        <option value="Low" <?= selected($lead['importance'],"Low") ?>>Low</option>
                                    </select>   
                                    <?= form_error('importance') ?>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Next Follow up Date <span class="-req">*</span></label> 
                                    <input name="ndate" type="text" placeholder="Next Follow up Date" class="form-control form-control-sm datepicker-new" value="<?= set_value('ndate',vd($lead['next_followup_date'])); ?>" readonly required>
                                    <?= form_error('ndate') ?>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Next Follow up Time</label> 
                                    <input name="nftime" type="text" placeholder="From" class="form-control form-control-sm hour-mask" value="<?= $lead['tfrom'] != null?$lead['tfrom']:'' ?>" >
                                    <input name="nttime" type="text" placeholder="To" class="form-control form-control-sm hour-mask" value="<?= $lead['tto'] != null?$lead['tto']:'' ?>" >
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
                                            <option value="<?= $sevalue['id'] ?>" <?= selected($lead['source'],$sevalue['id']) ?>><?= $sevalue['name'] ?></option>
                                        <?php } ?>
                                    </select>   
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Occupation</label> 
                                    <select class="form-control form-control-sm" name="occupation">
                                        <option value="">-- Select Occupation --</option>
                                        <option value="Business" <?= selected($lead['occupation'],"Business") ?>>Business</option>
                                        <option value="Job" <?= selected($lead['occupation'],"Job") ?>>Job</option>
                                        <option value="Other" <?= selected($lead['occupation'],"Other") ?>>Other</option>
                                        <option value="Both" <?= selected($lead['occupation'],"Both") ?>>Both</option>
                                    </select>   
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Special Quotation</label> 
                                    <input name="special_quote" type="text" placeholder="Special Quotation" class="form-control form-control-sm" value="<?= set_value('special_quote',$lead['quotation']); ?>">
                                    <?= form_error('special_quote') ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Remarks</label> 
                                    <textarea name="remarks" type="text" placeholder="Remarks" class="form-control form-control-sm" value=""><?= set_value('remarks',$lead['remarks']); ?></textarea>
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
                            <?php $docs = $this->db->get_where('files',['for' => 'Lead' , 'for_id' => $lead['id']])->result_array() ?>
                            <div class="col-md-6">
                                <h4>ATTACHMENTS</h4>
                                <div class="row col-md-12">
                                    <?php foreach ($docs as $key => $value) { ?>
                                        <div class="col-md-3 remove-file" style="padding: 20px;">
                                            <?php if($value['type'] == 'png' || $value['type'] == 'jpg' || $value['type'] == 'jpeg'){ ?>
                                                <img src="<?= base_url('uploads/doc/').$value['filename'] ?>" class="grid-images" style="width: 100%;"> 
                                            <?php } ?>
                                            <?php if($value['type'] == 'docx'){ ?>
                                                <img src="<?= base_url('asset/images/word.jpg') ?>" class="grid-images" style="width: 100%;"> 
                                            <?php } ?>
                                            <?php if($value['type'] == 'csv' || $value['type'] == 'xlsx'){ ?>
                                                <img src="<?= base_url('asset/images/excel.jpg') ?>" class="grid-images" style="width: 100%;"> 
                                            <?php } ?>
                                            <?php if($value['type'] == 'pdf'){ ?>
                                                <img src="<?= base_url('asset/images/pdf.jpg') ?>" class="grid-images" style="width: 100%;"> 
                                            <?php } ?>
                                            <div class="row">
                                                <marquee scrollamount="2"><?=  $value['name'] ?></marquee>
                                            </div>
                                            <div class="row" style="background: #ccc; text-align: center;">
                                                <p style="text-align: center; width: 100%; margin: 0; font-size: 16px;">
                                                    <a href="<?= base_url('uploads/doc/').$value['filename'] ?>" target="_blank" title="Download" download><i class="fa fa-download"></i></a> &nbsp;&nbsp;
                                                    <a href="javascript:;" type="button" class="remove-file-lead" data-id="<?= $value['id'] ?>" title="Delete"><i class="fa fa-trash"></i></a>
                                                </p>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <input type="hidden" name="id" value="<?= $lead['id'] ?>">
                <input type="hidden" name="dump" value="<?= $dump ?>">
                <?php if($dump  == 1){ ?>
                    <a href="<?= base_url('leads/dump_leads') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
                <?php }else{ ?>
                    <a href="<?= base_url('leads') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
                <?php } ?>
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