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
        <form method="post" action="<?= base_url('setting/save') ?>">
            <div class="card-block">
                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Company Name <span class="-req">*</span></label>
                            <input name="company" type="text" class="form-control" value="<?= set_value('company',get_setting()['name']); ?>" >
                            <?= form_error('company') ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Referal Amount x n <span class="-req">*</span></label>
                            <input name="ref_amount" type="text" class="form-control numbers" placeholder="Referal Amount x n" value="<?= set_value('ref_amount',get_setting()['ref_amount']); ?>" >
                            <?= form_error('ref_amount') ?>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="card-footer text-right">
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-save"></i> Save
                </button>
            </div>
        </form>
    </div>
</div>