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
            
        </div>
    </div>
</div>

<div class="page-body">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <form method="post" action="<?= base_url('reports/task_result') ?>">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>For</label>
                                    <select class="form-control form-control-sm select2" name="for" >
                                        <option value="">-- Select --</option>
                                        <?php foreach ($this->general_model->get_task_users() as $bkey => $bvalue) { ?>
                                            <option value="<?= $bvalue['id'] ?>" <?= selected($bvalue['id'],$for) ?>><?= $bvalue['name'] ?> - <?= getRole($bvalue['user_type']) ?> - <?= _user_type($bvalue['id']) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>  
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>From</label>
                                    <select class="form-control form-control-sm select2" name="from">
                                        <option value="">-- Select --</option>
                                        <?php foreach ($this->general_model->get_task_users() as $bkey => $bvalue) { ?>
                                            <option value="<?= $bvalue['id'] ?>" <?= selected($bvalue['id'],$from) ?>><?= $bvalue['name'] ?> - <?= getRole($bvalue['user_type']) ?> - <?= _user_type($bvalue['id']) ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div> 

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>From Date</label> 
                                    <input name="fdate" type="text" placeholder="From Date" autocomplete="off" class="form-control form-control-sm datepicker" value="<?= $fdate ?>">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>To Date</label> 
                                    <input name="tdate" type="text" placeholder="To Date" autocomplete="off" class="form-control form-control-sm datepicker" value="<?= $tdate ?>">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <button class="btn btn-success btn-mini" style="margin-top: 30px;">
                                    <i class="fa fa-eye"></i> Show
                                </button>    
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <?php if(isset($task)){  ?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block">
                        <table class="table table-striped table-bordered table-mini table-ndt">
                            <thead>
                                <tr>
                                    <th class="text-center">Date</th>
                                    <th>Particulars</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th class="text-center">Done?</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($task as $key => $value) { ?>
                                    <tr>
                                        <td class="text-center">
                                            <?= vd($value['date']) ?>        
                                        </td>
                                        <td><?= $value['name'] ?></td>
                                        <td><?= $this->general_model->_get_user($value['from'])['name'] ?></td>
                                        <td><?= $this->general_model->_get_user($value['to'])['name'] ?></td>
                                        <td class="text-center"><?= $value['done'] == '1'?'YES':'NO' ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('task/view/').$value['id'] ?>/0" class="btn btn-success btn-mini" data-id="<?= $value['id'] ?>" title="View">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>