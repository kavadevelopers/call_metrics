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
            <?php if(get_user()['user_type'] != 3){ ?>
                <button class="btn btn-warning btn-sm" type="button" id="transferLeadAll">
                    <i class="fa fa-share"></i> Transfer Lead
                </button>
            <?php } ?>
            <a href="<?= base_url('leads/add_lead') ?>" class="btn btn-info btn-sm">
                <i class="fa fa-plus"></i> Add
            </a>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="card">
        <div class="card-block dt-responsive table-responsive">
            <table class="table table-striped table-bordered table-mini table-dt">
                <thead>
                    <tr>
                        <th class="text-center">
                            <div class="checkbox-fade fade-in-primary d-">
                                <label>
                                    <input type="checkbox" value="1" class="checkAll">
                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                    <span class="text-inverse">All</span>
                                </label>
                            </div>
                        </th>
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
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($leads as $key => $value) { ?>
                        <tr id="tr-lead-<?= $value['id'] ?>">
                            <td class="text-center">
                                <div class="checkbox-fade fade-in-primary d-">
                                    <label>
                                        <input type="checkbox" class="checkBox" value="<?= $value['id'] ?>">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                    </label>
                                </div>
                            </td>
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
                            <td class="text-center">
                                <!-- <a href="<?= base_url('leads/edit/').$value['id'] ?>" class="btn btn-primary btn-mini" title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </a> -->
                                <!-- <a href="<?= base_url('leads/delete/').$value['id'] ?>" class="btn btn-danger btn-mini btn-delete" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </a> -->
                                <a href="<?= base_url('leads/view/').$value['id'] ?>" class="btn btn-success btn-mini" title="View">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="<?= base_url('leads/dump/').$value['id'] ?>" class="btn btn-warning btn-mini" title="Transfer To Dump" onclick="return confirm('Are you sure you want to transfer in dump?')">
                                    <i class="fa fa-exclamation"></i>
                                </a>
                                <?php if(get_user()['user_type'] == '0' || get_user()['user_type'] == '1' || get_user()['user_type'] == '3'){ ?>
                                    <button type="button" class="btn btn-success btn-mini add-followup" data-id="<?= $value['id'] ?>" data-stop="Lead Already Converted To Customer" data-type="lead" title="Check Followup">
                                        <i class="fa fa-question"></i>
                                    </button>
                                <?php } ?>
                                <?php if(get_user()['user_type'] == '2' || get_user()['user_type'] == '3'){ ?>
                                    <button class="btn btn-info btn-mini transfer-lead" title="Transfer To Other" type="button" data-lead="<?= $value['id'] ?>">
                                        <i class="fa fa-share"></i>
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>