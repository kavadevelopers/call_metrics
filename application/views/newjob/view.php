<div class="page-header">
    <div class="row align-items-end">
        <div class="col-md-6">
            <div class="page-header-title">
                <div class="d-inline">
                    <h4><?= $_title ?></h4> 
                </div>
            </div>
        </div>
        <div class="col-md-6 text-right">
            <a href="<?= base_url('newjob') ?>" class="btn btn-danger btn-mini"><i class="fa fa-arrow-left"></i> Back</a>

            <?php if($job['status'] == "0"){ ?>
                <a href="<?= base_url('newjob/dump/').$job['id'] ?>" class="btn btn-warning btn-mini" onclick="return confirm('Are you sure you want to tranfer to dump?')"><i class="fa fa-question"></i> Dump</a>
            <?php } ?>
            <?php if($job['status'] == "0"){ ?>
                <button href="" class="btn btn-primary btn-mini" id="editNewWorkBtn"><i class="fa fa-pencil"></i> Edit</button>
            <?php } ?>
        </div>
    </div>
</div>
<?php $client = $this->general_model->_get_client($job['client']); ?>
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
                                    <p class="view-p-kava"><?= vd($job['created_at']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row kava-bottom-border">
                        <div class="col-md-6">
                            <div class="form-group row kava-form-group">
                                <label class="col-sm-5 col-form-label">Client Name</label>
                                <div class="col-sm-7">
                                    <p class="view-p-kava"><?= $client['fname'] ?> <?= $client['mname'] ?> <?= $client['lname'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                            <div class="form-group row kava-form-group">
                                <label class="col-sm-5 col-form-label">Firm Name</label>
                                <div class="col-sm-7">
                                    <p class="view-p-kava"><?= $client['firm'] ?></p>
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
                                        <?php if($client['area'] != ""){ ?>
                                        <?= $client['area'] == "3244" ? $client['other_area'] . ' - ':$this->general_model->_get_area($client['area'])['name'] . ' - '; ?>   
                                        <?php } ?>
                                        <?= $client['city'] == "" ? $this->general_model->_get_city($client['city'])['name'] . ' - ':''; ?>   
                                        <?= $client['district'] == "" ? $this->general_model->_get_district($client['district'])['name'] . ' - ':''; ?> 
                                        <?= $client['state'] == "" ? $this->general_model->_get_state($client['state'])['name'] . ' - ':''; ?> 
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
                                    <p class="view-p-kava"><?= $client['mobile'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row kava-form-group">
                                <label class="col-sm-5 col-form-label">Email</label>
                                <div class="col-sm-7">
                                    <p class="view-p-kava"><?= $client['email'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row kava-bottom-border">
                        <div class="col-md-6">
                            <div class="form-group row kava-form-group">
                                <label class="col-sm-5 col-form-label">Occupation</label>
                                <div class="col-sm-7">
                                    <p class="view-p-kava"><?= $client['occupation'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row kava-form-group">
                                <label class="col-sm-5 col-form-label">Special Quotation</label>
                                <div class="col-sm-7">
                                    <p class="view-p-kava"><?= $client['quotation'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row kava-bottom-border">
                        <div class="col-md-12">
                            <div class="form-group row kava-form-group">
                                <label class="col-sm-3 col-form-label">Next Followup Date</label>
                                <div class="col-sm-9">
                                    <p class="view-p-kava"><?= $job['fdate']!=""?vd($job['fdate']):'NA' ?> - <?= get_from_to_wbr($job['from'],$job['to']) ?></p>
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
                                        <?= $this->general_model->_get_service($job['service'])['name'] ?> - <?= rs().$job['price'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row kava-bottom-border">
                        <div class="col-md-12">
                            <div class="form-group row kava-form-group">
                                <label class="col-sm-5 col-form-label">Remarks</label>
                                <div class="col-sm-7">
                                    <p class="view-p-kava"><?= $job['remarks'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <?php if($job['status'] == 0){ ?>
                <div class="card-block">
                    <form method="post" action="<?= base_url('followup/save_newwork') ?>">
                        <div class="row">   
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Remarks <span class="-req">*</span></label> 
                                    <textarea class="form-control" placeholder="Remarks" name="remarks" id="" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Next Followup Date</label> 
                                    <input name="date" type="text" autocomplete="off" placeholder="Next Followup Date" class="form-control form-control-sm datepicker-new" value="" id="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="checkbox-fade fade-in-primary d-">
                                    <label>
                                        <input type="checkbox" value="1" name="customer" id="">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">Transfer To Job ?</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Next Follow up Time</label> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <input name="from" type="text" placeholder="From" class="form-control form-control-sm hour-mask" value="" id="">
                                    </div>
                                    <div class="col-md-6">
                                        <input name="to" type="text" placeholder="To" class="form-control form-control-sm hour-mask" value="" id="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group text-right">
                                <input type="hidden" name="id" value="<?= $job['id'] ?>">
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
                                    <th class="text-center">Transfered To Job?</th>
                                    <?php if(get_user()['user_type'] == '0' || get_user()['user_type'] == '1'){ ?>
                                        <th>Followup By</th>
                                    <?php } ?>
                                </thead>
                                <tbody>
                                    <?php $followups = $this->db->order_by('id','desc')->get_where('followup',['main_id' => $job['id'],'type' => 'newWork'])->result_array(); ?>

                                    <?php foreach ($followups as $key => $followup) { $customer = $followup['customer'] == '1'?'Yes':'No'; ?>
                                        <tr>
                                            <td class="text-center"><?= $followup['next_f']!=""?vd($followup['next_f']):'NA' ?><?= get_from_to($followup['ftime'],$followup['ttime']) ?></td>
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

<div class="modal fade" id="editNewFollowupJobModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form method="post" action="<?= base_url('newjob/update') ?>">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit New Work Followup</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select Client <span class="-req">*</span></label> 
                                <select class="form-control form-control-sm select2n" name="client" required>
                                    <option value="">-- Select --</option>
                                    <?php foreach ($this->general_model->getFilteredClients() as $bkey => $bvalue) { ?>
                                        <option value="<?= $bvalue['id'] ?>" <?= selected($bvalue['id'],$job['client']) ?>><?= $bvalue['c_id'] ?> - <?= $bvalue['fname'] ?> <?= $bvalue['mname'] ?> <?= $bvalue['lname'] ?> - <?= $bvalue['mobile'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Select Service <span class="-req">*</span></label> 
                                <select class="form-control form-control-sm select2n serviceToPrice" name="service" required>
                                    <option value="">-- Select Service --</option>
                                    <?php foreach ($this->general_model->get_services() as $sekey => $sevalue) { ?> 
                                        <option value="<?= $sevalue['id'] ?>-<?= $sevalue['price'] ?>" <?= selected($sevalue['id'],$job['service']) ?>><?= $sevalue['name'] ?></option>
                                    <?php } ?>
                                </select>   
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Price <span class="-req">*</span></label> 
                                <input type="text" class="form-control form-control-sm decimal-num serviewFromPrice" name="price" autocomplete="off" placeholder="Price" value="<?= $job['price']; ?>" required>   
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks</label> 
                                <textarea class="form-control" placeholder="Remarks" name="remarks"><?= $job['remarks']; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="main_id" value="<?= $job['id'] ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>