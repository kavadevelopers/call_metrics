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
            <a href="<?= base_url('branch/add') ?>" class="btn btn-info btn-sm">
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
                        <th class="text-center">Branch Code</th>
                        <th>Name</th>
                        <th class="text-center">Mobile</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($branch as $key => $value) { ?>
                        <tr>
                            <td class="text-center"><?= $key + 1 ?></td>
                            <td class="text-center"><?= $value['code'] ?></td>
                            <td><?= $value['name'] ?></td>
                            <td class="text-center"><?= $value['mobile'] ?></td>
                            <td><?= $value['email'] ?></td>
                            <td><?= nl2br($value['address']) ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('branch/edit/').$value['id'] ?>" class="btn btn-primary btn-mini">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="<?= base_url('branch/delete/').$value['id'] ?>" class="btn btn-danger btn-mini btn-delete">
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