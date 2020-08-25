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
                    <form method="post" action="<?= base_url('document/save_sub') ?>">
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
                                    <label>Folder <span class="-req">*</span></label>
                                    <select class="form-control form-control-sm select2" name="folder" required>
                                        <option value="">-- Select Folder --</option>
                                        <?php foreach ($this->general_model->get_folder_name() as $key => $value) { ?>
                                            <option value="<?= $value['id'] ?>" <?= set_value('name') == $value['id']?'selected':'' ?>><?= $value['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <?= form_error('name') ?>
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
        <?php } ?>
        

        <div class="col-md-8">
            <div class="card">
                <div class="card-block">
                    <table class="table table-striped table-bordered table-mini table-dt">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Name</th>
                                <th>Main Folder Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $key => $value) { ?>
                                <tr>
                                    <td class="text-center"><?= $key + 1 ?></td>
                                    <td><?= $value['name'] ?></td>
                                    <td><?= $this->general_model->_get_doc_folder($value['main'])['name'] ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('document/delete_sub/').$value['id'] ?>" class="btn btn-danger btn-mini btn-delete">
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