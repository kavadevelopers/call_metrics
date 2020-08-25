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
            <button class="btn btn-primary btn-mini add-payment"><i class="fa fa-plus"></i> Add Receipt</button>
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
                        <th class="text-left">Payment Type</th>
                        <th class="text-right">Amount</th>
                        <th>Remarks</th>
                        <th class="text-center">Approved</th>
                        <?php if(get_user()['user_type'] == 0){ ?>
                            <th>Created By</th>
                        <?php } ?>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($invoices as $key => $value) { ?>
                        <?php $client = $this->general_model->_get_client($value['client']); ?>
                        <tr>
                            <td class="text-center"><?= $value['invoice'] ?></td>
                            <td class="text-center"><?= vd($value['date']) ?></td>
                            <td>#<?= $client['c_id'] ?> <br><b><?= $client['fname'] ?> <?= $client['mname'] ?> <?= $client['lname'] ?></b> <?= $client['firm'] != ""?'<br>'.$client['firm'] :'' ?> <br><small><?= $client['mobile'] ?></small></td>
                            <td class="text-left"><?= $value['pay_type'] ?><?= $value['pay_remarks'] != "" ? '<br>'.$value['pay_remarks']:''; ?></td>
                            <td class="text-right"><?= $value['amount'] ?></td>
                            <td><?= nl2br($value['remarks']) ?></td>
                            <td class="text-center">
                                <?php if($value['status'] == 1){ ?>
                                    <span class="pcoded-badge label label-success">Yes</span>
                                <?php }else{ ?>
                                    <span class="pcoded-badge label label-danger">No</span>
                                <?php } ?>
                            </td>
                            <?php if(get_user()['user_type'] == 0){ ?>
                                <td><?= $this->general_model->_get_user($value['created_by'])['name'] ?></td>
                            <?php } ?>
                            <td class="text-center">
                                <?php if($value['status'] != 1){ ?>
                                    <button class="btn btn-primary btn-mini edit-payment" data-id="<?= $value['id'] ?>" data-client="<?= $value['client'] ?>" data-date="<?= vd($value['date']) ?>" data-amount="<?= $value['amount'] ?>" data-remarks="<?= $value['remarks'] ?>" data-pay_type="<?= $value['pay_type'] ?>" data-pay_remarks="<?= $value['pay_remarks'] ?>" title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <a href="<?= base_url('payment/delete/').$value['id'] ?>" class="btn btn-danger btn-mini btn-delete" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                <?php } ?>
                                <a href="<?= base_url('pdf/receipt/').$value['id'] ?>" target="_blank" class="btn btn-primary btn-mini" title="PDF">
                                    <i class="fa fa-file-pdf-o"></i>
                                </a>
                                <a href="<?= base_url('pdf/receiptD/').$value['id'] ?>" target="_blank" class="btn btn-secondary btn-mini" title="Download PDF">
                                    <i class="fa fa-download"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>