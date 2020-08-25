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
        <form method="post" action="<?= base_url('branch/save') ?>">
            <div class="card-block">
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Branch Code <span class="-req">*</span></label>
                            <input name="code" type="text" placeholder="Branch Code" class="form-control" value="<?= set_value('code'); ?>">
                            <?= form_error('code') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Name <span class="-req">*</span></label>
                            <input name="name" type="text" placeholder="Name" class="form-control" value="<?= set_value('name'); ?>">
                            <?= form_error('name') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Mobile <span class="-req">*</span></label>
                            <input name="mobile" type="text" placeholder="Mobile" class="form-control" value="<?= set_value('mobile'); ?>">
                            <?= form_error('mobile') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Email <span class="-req">*</span></label>
                            <input name="email" type="text" placeholder="Email" class="form-control" value="<?= set_value('email'); ?>">
                            <?= form_error('email') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Address <span class="-req">*</span></label>
                            <textarea name="address" type="text" placeholder="Address" class="form-control" value=""><?= set_value('address'); ?></textarea>
                            <?= form_error('address') ?>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-footer text-right">
                <a href="<?= base_url('branch') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-plus"></i> Add
                </button>
            </div>
        </form>
    </div>
</div>