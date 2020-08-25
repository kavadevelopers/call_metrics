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
            <a href="<?= base_url('services/add') ?>" class="btn btn-info btn-sm">
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
                        <th class="text-center">Weightage</th>
                        <th class="text-center">Time To Complete</th>
                        <th class="text-right">Price</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($services as $key => $value) { ?>
                        <tr>
                            <td class="text-center"><?= $key + 1 ?></td>
                            <td><?= $value['name'] ?></td>
                            <td class="text-center"><?= $value['weight'] ?></td>
                            <td class="text-center"><?= $value['time'] ?></td>
                            <td class="text-right"><?= $value['price'] ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('services/edit/').$value['id'] ?>" class="btn btn-primary btn-mini">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="<?= base_url('services/delete/').$value['id'] ?>" class="btn btn-danger btn-mini btn-delete">
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


