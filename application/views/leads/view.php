<div class="page-header">
    <div class="row align-items-end">
        <div class="col-md-6">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4><?= $_title ?> - <?= $lead['customer'] ?></h4> 
                </div>
            </div>
        </div>
        <div class="col-md-6 text-right">
            <?php if($lead['status'] == "2"){ ?>
                <a href="<?= base_url('leads/converted_leads') ?>" class="btn btn-danger btn-mini"><i class="fa fa-arrow-left"></i> Back</a>
            <?php } ?>

            <?php if($lead['status'] == "1"){ ?>
                <a href="<?= base_url('leads/dump_leads') ?>" class="btn btn-danger btn-mini"><i class="fa fa-arrow-left"></i> Back</a>
            <?php } ?>

            <?php if($lead['status'] == "0"){ ?>
                <a href="<?= base_url('leads') ?>" class="btn btn-danger btn-mini"><i class="fa fa-arrow-left"></i> Back</a>
            <?php } ?>

            <?php if($lead['status'] == "0"){ ?>
                <a href="<?= base_url('leads/edit/').$lead['id'] ?>" class="btn btn-primary btn-mini"><i class="fa fa-pencil"></i> Edit</a>
            <?php } ?>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-block">
                    <div class="row kava-bottom-border">
                        <div class="col-md-6">
                            <div class="form-group row kava-form-group">
                                <label class="col-sm-5 col-form-label">Date</label>
                                <div class="col-sm-7">
                                    <p class="view-p-kava"><?= vd($lead['date']) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row kava-form-group">
                                <label class="col-sm-5 col-form-label">Branch</label>
                                <div class="col-sm-7">
                                    <p class="view-p-kava"><?= $this->general_model->_get_branch($lead['branch'])['name'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row kava-bottom-border">
                        <div class="col-md-6">
                            <div class="form-group row kava-form-group">
                                <label class="col-sm-5 col-form-label">Client Name</label>
                                <div class="col-sm-7">
                                    <p class="view-p-kava"><?= $lead['customer'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                            <div class="form-group row kava-form-group">
                                <label class="col-sm-5 col-form-label">Firm Name</label>
                                <div class="col-sm-7">
                                    <p class="view-p-kava"><?= $lead['firm'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row kava-bottom-border">
                        <div class="col-md-12">
                            <div class="form-group row kava-form-group">
                                <label class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <p class="view-p-kava">aaa
                                        <?php if($lead['area'] != ""){ ?>
                                        <?= $lead['area'] == "3244" ? $lead['other_area'] . ' - ':$this->general_model->_get_area($lead['area'])['name'] . ' - '; ?>   
                                        <?php } ?>
                                        <?= $lead['city'] == "" ? $this->general_model->_get_city($lead['city'])['name'] . ' - ':''; ?>   
                                        <?= $lead['district'] == "" ? $this->general_model->_get_district($lead['district'])['name'] . ' - ':''; ?> 
                                        <?= $lead['state'] == "" ? $this->general_model->_get_state($lead['state'])['name'] . ' - ':''; ?> 
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row kava-bottom-border">
                        <div class="col-md-6">
                            <div class="form-group row kava-form-group">
                                <label class="col-sm-5 col-form-label">Mobile</label>
                                <div class="col-sm-7">
                                    <p class="view-p-kava"><?= $lead['mobile'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row kava-form-group">
                                <label class="col-sm-5 col-form-label">Email</label>
                                <div class="col-sm-7">
                                    <p class="view-p-kava"><?= $lead['email'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row kava-bottom-border">
                        <div class="col-md-6">
                            <div class="form-group row kava-form-group">
                                <label class="col-sm-5 col-form-label">Landline</label>
                                <div class="col-sm-7">
                                    <p class="view-p-kava"><?= $lead['landline'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row kava-form-group">
                                <label class="col-sm-5 col-form-label">Importance</label>
                                <div class="col-sm-7">
                                    <p class="view-p-kava"><?= $lead['importance'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row kava-bottom-border">
                        <div class="col-md-6">
                            <div class="form-group row kava-form-group">
                                <label class="col-sm-5 col-form-label">Source</label>
                                <div class="col-sm-7">
                                    <p class="view-p-kava"><?= $this->general_model->_get_source($lead['source'])['name'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row kava-form-group">
                                <label class="col-sm-5 col-form-label">Occupation</label>
                                <div class="col-sm-7">
                                    <p class="view-p-kava"><?= $lead['occupation'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row kava-bottom-border">
                        <div class="col-md-6">
                            <div class="form-group row kava-form-group">
                                <label class="col-sm-5 col-form-label">Special Quotation</label>
                                <div class="col-sm-7">
                                    <p class="view-p-kava"><?= $lead['quotation'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row kava-form-group">
                                <label class="col-sm-5 col-form-label">Remarks</label>
                                <div class="col-sm-7">
                                    <p class="view-p-kava"><?= $lead['remarks'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row kava-bottom-border">
                        <div class="col-md-12">
                            <div class="form-group row kava-form-group">
                                <label class="col-sm-3 col-form-label">Next Followup Date</label>
                                <div class="col-sm-9">
                                    <p class="view-p-kava"><?= vd($lead['next_followup_date']) ?> - <?= get_from_to_wbr($lead['tfrom'],$lead['tto']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row kava-bottom-border">
                        <div class="col-md-12">
                            <div class="form-group row kava-form-group">
                                <label class="col-sm-2 col-form-label">Service</label>
                                <div class="col-sm-10">
                                    <p class="view-p-kava">
                                        <?php foreach (json_decode($lead['services']) as $key => $value) { ?>
                                            <?= $this->general_model->_get_service($value[0])['name'] ?> - <?= rs().$value[1] ?><br> 
                                        <?php } ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $docs = $this->db->get_where('files',['for' => 'Lead' , 'for_id' => $lead['id']])->result_array() ?>
                    <?php if($docs){ ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row kava-form-group">
                                    <label class="col-sm-12 col-form-label">ATTACHMENT</label>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="row">
                        <div class="col-md-12">
                            <?php if($docs){ ?>
                                <table class="table table-bordered">
                                    <?php foreach ($docs as $key => $value) { ?>
                                        <tr class="remove-file">
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
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <?php if($lead['status'] == 0){ ?>
                <div class="card-block">
                    <form method="post" action="<?= base_url('followup/save_lead') ?>">
                        <div class="row">   
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Remarks <span class="-req">*</span></label> 
                                    <textarea class="form-control" placeholder="Remarks" name="remarks" id="" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Next Followup Date <span class="-req">*</span></label> 
                                    <input name="date" type="text" placeholder="Next Followup Date" class="form-control form-control-sm datepicker-new" value="<?= set_value('date',date('d-m-Y')); ?>" id="" readonly required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="checkbox-fade fade-in-primary d-">
                                    <label>
                                        <input type="checkbox" value="1" name="customer" id="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">Client ?</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Next Follow up Time</label> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <input name="nftime" type="text" placeholder="From" class="form-control form-control-sm hour-mask" value="" id="">
                                    </div>
                                    <div class="col-md-6">
                                        <input name="nttime" type="text" placeholder="To" class="form-control form-control-sm hour-mask" value="" id="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group text-right">
                                <input type="hidden" name="id" value="<?= $lead['id'] ?>">
                                <button type="submit" class="btn btn-primary" id="">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-block">
                            <table class="table table-bordered table-mini table-no-padding" id="" style="max-width: 100%;">
                                <thead>
                                    <th class="text-center">Next Followup</th>
                                    <th class="text-center">Date</th>
                                    <th>Remarks</th>
                                    <th class="text-center">Is Client ?</th>
                                    <?php if(get_user()['user_type'] == '0' || get_user()['user_type'] == '1'){ ?>
                                        <th>Followup By</th>
                                    <?php } ?>
                                </thead>
                                <tbody>
                                    <?php $followups = $this->db->order_by('id','desc')->get_where('followup',['main_id' => $lead['id'],'type' => 'lead'])->result_array(); ?>

                                    <?php foreach ($followups as $key => $followup) { $customer = $followup['customer'] == '1'?'Yes':'No'; ?>
                                        <tr>
                                            <td class="text-center"><?= vd($followup['next_f']).get_from_to($followup['ftime'],$followup['ttime']) ?></td>
                                            <td class="text-center"><?= _vdatetime($followup['date']) ?></td>
                                            <td><?= nl2br($followup['remarks']) ?></td>
                                            <td class="text-center"><?= $customer ?></td>
                                            <?php if(get_user()['user_type'] == '0' || get_user()['user_type'] == '1'){ ?>
                                                <td><?= $this->general_model->_get_user($followup['followup_by'])['name'] ?></td>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>