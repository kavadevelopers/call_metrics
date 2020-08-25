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
            <button class="btn btn-primary btn-sm" type="button" id="addNewJob">
                <i class="fa fa-plus"></i> Add Job
            </button>
            <button class="btn btn-warning btn-sm" type="button" id="tranferJob"  data-type="1">
                <i class="fa fa-share"></i> Transfer Job
            </button>
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
                        <th>Service</th>
                        <th class="text-right">Price</th>
                        <th>Client</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Importance</th>
                        <th class="text-center">Next Followup Date</th>
                        <?php if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){ ?>
                            <th>Owner</th>
                        <?php } ?>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jobs as $key => $value) { ?>
                        <?php $client = $this->general_model->_get_client($value['client']); ?>
                        <tr>
                            <td class="text-center">
                                <div class="checkbox-fade fade-in-primary d-">
                                    <label>
                                        <input type="checkbox" class="checkBox" value="<?= $value['id'] ?>">
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                    </label>
                                </div>
                            </td>
                            <td class="text-center"><?= $value['job_id'] ?></td>
                            <td id="jobService<?= $value['id'] ?>"><?= $this->general_model->_get_service($value['service'])['name'] ?></td>
                            <td class="text-right" id="jobPrice<?= $value['id'] ?>"><?= $value['price'] ?></td>
                            <td>
                                #<?= $client['c_id'] ?> <br><b><?= $client['fname'] ?> <?= $client['mname'] ?> <?= $client['lname'] ?></b> <?= $client['firm'] != ""?'<br>'.$client['firm'] :'' ?> <br><small><?= $client['mobile'] ?></small>
                            </td>
                            <td class="text-center" id="status-<?= $value['id'] ?>"><?= getjobStatus($value['status']) ?></td>
                            <td class="text-center" id="jobImportance<?= $value['id'] ?>"><?= $value['importance'] ?></td>
                            <td class="text-center" id="jobFolllowupDate<?= $value['id'] ?>"><?= $value['f_date'] != null?vd($value['f_date']):'NA'; ?><?= get_from_to($value['f_time'],$value['t_time']) ?></td>
                            <?php if(get_user()['user_type'] == 0 || get_user()['user_type'] == 1){ ?>
                                <td><?= $this->general_model->_get_user($value['owner'])['name'] ?></td>
                            <?php } ?>
                            <td class="text-center">
                                <button class="btn btn-primary btn-mini edit-job" id="jobEditBtn_<?= $value['id'] ?>" title="Edit" data-importance="<?= $value['importance'] ?>" data-job="<?= $value['id'] ?>" data-service="<?= $value['service'] ?>" data-price="<?= $value['price'] ?>" data-job_id="<?= $value['job_id'] ?>" data-client="<?= $client['fname'] ?> <?= $client['mname'] ?> <?= $client['lname'] ?>">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-success btn-mini add-job-followup" id="jobFollowupBtn_<?= $value['id'] ?>" data-status="<?= $value['status'] ?>" data-id="<?= $value['id'] ?>" data-stop="Job Is Closed" data-type="job" title="Check Followup">
                                    <i class="fa fa-question"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>