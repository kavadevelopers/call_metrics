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
            <table class="table table-striped table-bordered table-mini table-dt">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Date</th>
                        <th>Customer Name</th>
                        <th class="">Area</th>
                        <th class="text-center">Contact</th>
                        <th class="">Services</th>
                        <?php if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){ ?>
                            <th>User</th>
                        <?php } ?>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $key => $value) { $lead = $this->general_model->_get_lead($value['lead']); ?>
                        <tr>
                            <td class="text-center"><?= $value['c_id'] ?></td>
                            <td class="text-center"><?= vd($value['created_at']) ?></td>
                            <td>
                                <?= $value['fname'] ?>
                                <?= $value['firm'] != ''?'<br>-'.$value['firm']:'' ?>        
                            </td>
                            <td class="">
                                <?= $this->general_model->_get_area($value['area'])['name'] ?>,<br> <?= $this->general_model->_get_city($value['city'])['name'] ?>,<br> <?= $this->general_model->_get_state($value['state'])['name'] ?>
                            </td>
                            <td class="text-center">
                                <?php foreach (explode(",", $value['mobile']) as $mkey => $mvalue) { ?>
                                    <?php if($mkey > 0){ ?><br><?php } ?>
                                    <?= $mvalue ?>
                                <?php } ?>
                            </td>
                            <td class="">
                                <?php foreach (json_decode($lead['services']) as $mkey => $mvalue) { ?>
                                    <?php if($mkey > 0){ ?><br><?php } ?>
                                    <?= $this->general_model->_get_service($mvalue[0])['name'] ?>
                                <?php } ?>
                            </td>
                            <?php if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){ ?>
                                <td>
                                    <?= $this->general_model->_get_user($value['owner'])['name'] ?>
                                    <br><p><b>Branch</b> : <?= $this->general_model->_get_branch($value['branch'])['name'] ?></p>        
                                </td>
                            <?php } ?>
                            <td class="text-center">
                                <a href="<?= base_url('client/new_client_register/').$value['id'] ?>" class="btn btn-primary btn-mini" title="Register Client">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>