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
        <form method="post" action="<?= base_url('services/save') ?>">
            <div class="card-block">
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Name <span class="-req">*</span></label>
                            <input name="name" type="text" placeholder="Name" class="form-control" value="<?= set_value('name'); ?>">
                            <?= form_error('name') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Weightage <span class="-req">*</span></label>
                            <input name="wightage" type="text" placeholder="Weightage" class="form-control numbers" value="<?= set_value('wightage'); ?>">
                            <?= form_error('wightage') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Time To Complete <small>(In Minutes)</small> <span class="-req">*</span></label>
                            <input name="time" type="text" placeholder="Time To Complete" class="form-control numbers" value="<?= set_value('time'); ?>">
                            <?= form_error('time') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Price <span class="-req">*</span></label>
                            <input name="price" type="text" placeholder="Price" class="form-control decimal-num" value="<?= set_value('price'); ?>">
                            <?= form_error('price') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Renual In Month <span class="-req">*</span></label>
                            <input name="renual" type="text" placeholder="Renual In Month" class="form-control numbers" value="<?= set_value('renual'); ?>">
                            <?= form_error('renual') ?>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-footer text-right">
                <a href="<?= base_url('services') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-plus"></i> Add
                </button>
            </div>
        </form>
    </div>
</div>