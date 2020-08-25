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
            <button class="btn btn-primary btn-sm" type="button" id="addTodo">
                <i class="fa fa-plus"></i> Add
            </button>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="card">
        <div class="card-block dt-responsive table-responsive">
            <table class="table table-striped table-bordered table-mini table-dt">
                <thead>
                    <tr>
                        <th class="text-center">Date</th>
                        <th>Remarks</th>
                        <th>For</th>
                        <th>From</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($todo as $key => $value) { ?>
                        <tr>
                            <td class="text-center">
                                <?= vd($value['date']) ?>
                                <?= get_from_to($value['ftime'],$value['ttime']) ?>        
                            </td>
                            <td><?= nl2br($value['remarks']) ?></td>
                            <td><?= $this->general_model->_get_user($value['to'])['name'] ?></td>
                            <td><?= $this->general_model->_get_user($value['from'])['name'] ?></td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-mini btn-delete delete-todo" data-id="<?= $value['id'] ?>" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>