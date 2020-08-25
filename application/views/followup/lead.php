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
                        <th class="text-center">Date</th>
                        <th class="text-center">Followup Date</th>
                        <th>Client Name</th>
                        <th class="text-center">Mobile</th>
                        <th>Email</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($leads as $key => $value) { ?>
                        <tr>
                            <td class="text-center"><?= vd($value['date']) ?></td>
                            <td class="text-center"><?= vd($value['next_followup_date']) ?></td>
                            <td><?= $value['customer'] ?></td>
                            <td class="text-center">
                                <?php foreach (explode(",", $value['mobile']) as $mkey => $mvalue) { ?>
                                    <?php if($mkey > 0){ ?><br><?php } ?>
                                    <?= $mvalue ?>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <?php foreach (explode(",", $value['email']) as $mkey => $mvalue) { ?>
                                    <?php if($mkey > 0){ ?><br><?php } ?>
                                    <?= $mvalue ?>
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <?php if(get_user()['user_type'] != "0"){ ?> 
                                    <button type="button" class="btn btn-info btn-mini add-followup" data-id="<?= $value['id'] ?>" data-stop="Lead Already Converted To Customer" data-type="lead" title="Add Followup">
                                        <i class="fa fa-plus"></i>
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