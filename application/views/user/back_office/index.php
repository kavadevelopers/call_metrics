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
            <a href="<?= base_url('user/new_back_office') ?>" class="btn btn-info btn-sm">
                <i class="fa fa-plus"></i> Add
            </a>
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
                        <th>Name</th>
                        <th class="text-center">Mobile</th>
                        <th>Email</th>
                        <th>Branch</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Gender</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($user as $key => $value) { ?>
                        <tr>
                            <td class="text-center"><?= $key + 1 ?></td>
                            <td><?= $value['name'] ?></td>
                            <td class="text-center"><?= $value['mobile'] ?></td>
                            <td><?= $value['email'] ?></td>
                            <td><?= $this->general_model->get_branch($value['branch'])['name'] ?></td>
                            <td class="text-center"><?= _user_type($value['id']) ?></td>
                            <td class="text-center">
                                <span style="display: none;"><?= $value['gender'] ?> </span>
                                <img src="<?= base_url() ?>asset/images/user/<?= $value['gender'] == 'Male'?'male.png':'female.png' ?>" class="img-radius" alt="User-Profile-Image" style="width: 35px;">    
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('user/edit_back_office/').$value['id'] ?>" class="btn btn-primary btn-mini">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="<?= base_url('user/delete_back_office/').$value['id'] ?>" class="btn btn-danger btn-mini btn-delete">
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