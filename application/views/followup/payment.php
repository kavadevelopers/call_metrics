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

        </div>
    </div>
</div>

<div class="page-body">
    <div class="card">
        <form method="post" action="<?= base_url('followup/payment') ?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>From Date</label> 
                                    <input name="from" type="text" placeholder="From Date" autocomplete="off" class="form-control form-control-sm datepicker" value="<?= $from ?>">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>To Date</label> 
                                    <input name="to" type="text" placeholder="To Date" autocomplete="off" class="form-control form-control-sm datepicker" value="<?= $to ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-success btn-mini" type="submit">
                            <i class="fa fa-eye"></i> Show
                        </button>  
                    </div>
                </div>
            </div>
        </form>
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
                        <th class="text-right">Amount</th>
                        <th class="text-center">Next Followup Date</th>
                        <th>Created By</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($invoices as $key => $value) { ?>
                        <?php $client = $this->general_model->_get_client($value['client']); ?>
                        <tr id="tr_payment-<?= $value['id'] ?>">
                            <td class="text-center"><?= $value['inv'] ?></td>
                            <td class="text-center"><?= vd($value['date']) ?></td>
                            <td>#<?= $client['c_id'] ?> <br><b><?= $client['fname'] ?> <?= $client['mname'] ?> <?= $client['lname'] ?></b> <?= $client['firm'] != ""?'<br>'.$client['firm'] :'' ?> <br><small><?= $client['mobile'] ?></small></td>
                            <td class="text-right"><?= $value['total'] ?></td>
                            <td id="tr_payment-date<?= $value['id'] ?>" class="text-center">
                                <?= $value['fdate'] != null?vd($value['fdate']):'NA'; ?>
                            </td>
                            <td>
                                <?= $this->general_model->_get_user($value['created_by'])['name'] ?>
                                <?php if(get_user()['user_type'] == 0 && $value['created_by'] != 1){ ?>
                                    <br><p><b>Branch</b> : <?= $this->general_model->_get_branch($value['branch'])['name'] ?></p>  
                                <?php } ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('pdf/invoice/').$value['id'] ?>" target="_blank" class="btn btn-primary btn-mini" title="PDF">
                                    <i class="fa fa-file-pdf-o"></i>
                                </a>
                                <a href="<?= base_url('pdf/invoiceD/').$value['id'] ?>" target="_blank" class="btn btn-secondary btn-mini" title="Download PDF">
                                    <i class="fa fa-download"></i>
                                </a>
                                <button type="button" class="btn btn-success btn-mini add-payment-followup" data-id="<?= $value['id'] ?>" data-type="jobpayment" title="Check Followup">
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