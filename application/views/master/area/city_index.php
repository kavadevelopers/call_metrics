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
    <div class="row">

        <?php if($_e == 0){ ?>
            <div class="col-md-4">
                <div class="card">
                    <form method="post" action="<?= base_url('area/save_city') ?>">
                        <div class="card-block">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name <span class="-req">*</span></label>
                                    <input name="name" type="text" class="form-control" value="<?= set_value('name'); ?>" placeholder="Name">
                                    <?= form_error('name') ?>
                                </div>
                            </div>    
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>State <span class="-req">*</span></label>
                                    <select class="form-control" name="state">
                                        <option value="">-- Select State --</option>
                                        <?php foreach ($this->general_model->list_state() as $key => $value) { ?>
                                            <option value="<?= $value['id'] ?>" <?= set_value('state') == $value['id']?'selected':'' ?>><?= $value['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <?= form_error('state') ?>
                                </div>
                            </div>                 
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-success">
                                <i class="fa fa-plus"></i> Add
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php }else{ ?>
            <div class="col-md-4">
                <div class="card">
                    <form method="post" action="<?= base_url('area/update_city') ?>">
                        <div class="card-block">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name <span class="-req">*</span></label>
                                    <input name="name" type="text" class="form-control" value="<?= set_value('name',$ind['name']); ?>" placeholder="Name">
                                    <?= form_error('name') ?>
                                </div>
                            </div>                    
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>State <span class="-req">*</span></label>
                                    <select class="form-control" name="state">
                                        <option value="">-- Select State --</option>
                                        <?php foreach ($this->general_model->list_state() as $key => $value) { ?>
                                            <option value="<?= $value['id'] ?>" <?= set_value('state',$ind['state']) == $value['id']?'selected':'' ?>><?= $value['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <?= form_error('state') ?>
                                </div>
                            </div>   
                        </div>
                        <div class="card-footer text-right">
                            <a href="<?= base_url('area/city') ?>" class="btn btn-danger">
                                <i class="fa fa-arrow-left"></i> Back
                            </a>
                            <button class="btn btn-success">
                                <i class="fa fa-save"></i> Save
                            </button>
                        </div>
                        <input type="hidden" name="id" value="<?= $ind['id'] ?>">
                    </form>
                </div>
            </div>
        <?php } ?>
        

        <div class="col-md-8">
            <div class="card">
                <div class="card-block">
                    <table class="table table-striped table-bordered table-mini table-dt">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Name</th>
                                <th>State</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $key => $value) { ?>
                                <tr>
                                    <td class="text-center"><?= $key + 1 ?></td>
                                    <td><?= $value['name'] ?></td>
                                    <td><?= $this->general_model->_get_state($value['state'])['name'] ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('area/edit_city/').$value['id'] ?>" class="btn btn-primary btn-mini">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="<?= base_url('area/delete_city/').$value['id'] ?>" class="btn btn-danger btn-mini btn-delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>    
        </div>
    </div>
</div>