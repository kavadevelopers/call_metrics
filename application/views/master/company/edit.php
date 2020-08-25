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
        <form method="post" action="<?= base_url('company/update') ?>" enctype="multipart/form-data">
            <div class="card-block">
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Name <span class="-req">*</span></label>
                            <input name="name" type="text" placeholder="Name" class="form-control" value="<?= set_value('name',$company['name']); ?>">
                            <?= form_error('name') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>GST</label>
                            <input name="gst" type="text" placeholder="GST" pattern="[0-9]{2}[A-Za-z]{3}[CPHFATBLJGcphfatblj]{1}[A-Za-z]{1}[0-9]{4}[A-Za-z]{1}[0-9A-Za-z]{1}(Z|z)[0-9A-Za-z]{1}$" class="form-control" value="<?= set_value('gst',$company['gst']); ?>">
                            <?= form_error('gst') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>PAN</label>
                            <input name="pan" type="text" placeholder="PAN" maxlength="10" pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}" class="form-control" value="<?= set_value('pan',$company['pan']); ?>">
                            <?= form_error('pan') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Invoice Prefix <span class="-req">*</span></label>
                            <input name="prefix" type="text" placeholder="Prefix" class="form-control" value="<?= set_value('prefix',$company['prefix']); ?>">
                            <?= form_error('prefix') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Payment Prefix <span class="-req">*</span></label>
                            <input name="payment_prefix" type="text" placeholder="Prefix" class="form-control" value="<?= set_value('payment_prefix',$company['receipt_prefix']); ?>">
                            <?= form_error('payment_prefix') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Address Line-1 <span class="-req">*</span></label>
                            <input name="add1" type="text" placeholder="Address" class="form-control" value="<?= set_value('add1',$company['add1']); ?>">
                            <?= form_error('add1') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Address Line-2 </label>
                            <input name="add2" type="text" placeholder="Address" class="form-control" value="<?= set_value('add2',$company['add2']); ?>">
                            <?= form_error('add2') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Letter Head</label>
                            <input type="file" name="file" class="form-control fileupload-change" onchange="readFileImage(this)">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Bank Name <span class="-req">*</span></label>
                            <input name="bank" type="text" placeholder="Bank" class="form-control" value="<?= set_value('bank',$company['bank']); ?>">
                            <?= form_error('bank') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Account Holder Name <span class="-req">*</span></label>
                            <input name="ac_name" type="text" placeholder="Account Holder Name" class="form-control" value="<?= set_value('ac_name',$company['ac_name']); ?>">
                            <?= form_error('ac_name') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Account No. <span class="-req">*</span></label>
                            <input name="ac_no" type="text" placeholder="Account No." class="form-control" value="<?= set_value('ac_no',$company['ac_no']); ?>">
                            <?= form_error('ac_no') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>IFSC Code <span class="-req">*</span></label>
                            <input name="ifsc" type="text" placeholder="IFSC Code" class="form-control" value="<?= set_value('ifsc',$company['ifsc']); ?>">
                            <?= form_error('ifsc') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>G-PAY,PAYTM,PHONE-PAY MOBILE <span class="-req">*</span></label>
                            <input name="upi" type="text" placeholder="G-PAY,PAYTM,PHONE-PAY MOBILE" minlength="10" maxlength="10" class="form-control numbers" value="<?= set_value('upi',$company['upi']); ?>">
                            <?= form_error('upi') ?>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <img src="<?= base_url('uploads/company/').$company['letter_head'] ?>" style="width: 50%; border: 1px solid #ccc;">
                    </div>

                    <input type="hidden" name="id" value="<?= $company['id'] ?>">
                    <input type="hidden" name="oldFile" value="<?= $company['letter_head'] ?>">
                </div>
            </div>

            <div class="card-footer text-right">
                <a href="<?= base_url('company') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-save"></i> Save
                </button>
            </div>
        </form>
    </div>
</div>