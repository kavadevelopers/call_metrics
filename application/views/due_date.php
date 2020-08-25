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

        <div class="col-md-4">
            <div class="card">
                <form method="post" action="<?= base_url('due_date/save') ?>">
                    <div class="card-block">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Remarks <span class="-req">*</span></label>
                                <input name="remarks" type="text" class="form-control" value="<?= set_value('remarks'); ?>" placeholder="Remarks">
                                <?= form_error('remarks') ?>
                            </div>
                        </div>  
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Date <span class="-req">*</span></label> 
                                <input name="date" type="text" placeholder="Date" class="form-control form-control-sm datepicker" value="<?= set_value('date',date('d-m-Y')); ?>">
                                <?= form_error('date') ?>
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

        

        <div class="col-md-8">
            <div class="card">
                <div class="card-block">
                    <table class="table table-striped table-bordered table-mini table-dt">
                        <thead>
                            <tr>
                                <th>Remarks</th>
                                <th>Date</th>
                                <th>Month</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $key => $value) { ?>
                                <tr>
                                    <td><?= $value['remarks'] ?></td>
                                    <td><?= vd($value['date']) ?></td>
                                    <td><?= date('m-Y',strtotime($value['dt'])) ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('due_date/delete/').$value['id'] ?>" class="btn btn-danger btn-mini btn-delete">
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