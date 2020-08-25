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
            <a href="<?= base_url('task/my_task') ?>" class="btn btn-danger btn-mini"><i class="fa fa-arrow-left"></i> Back</a>
            <?php if($task['from'] == get_user()['id']){ ?>
                <a href="<?= base_url('task/done/').$task['id'] ?>" class="btn btn-danger btn-mini" onclick="return confirm('Are You sure you want to confirm?')" title="Delete">
                    Done ?
                </a>
            <?php } ?>
        </div>
    </div>
</div>
<?php $this->db->where('to',get_user()['id'])->where('task',$task['id'])->update('task_reply',['read' => '1']) ?>
<div class="page-body">
    <div class="card">
        <div class="card-block">
            <div class="row">
                <div class="col-md-5">
                    <h5>Task : <?= $task['name'] ?></h5>
                    <h5>Date : <?= vd($task['date']) ?></h5>
                    <br><br>
                    <p>From : <?= $this->general_model->_get_user($task['from'])['name'];   ?></p>
                    <p>To : <?= $this->general_model->_get_user($task['to'])['name'];   ?></p>
                </div>
                <div class="col-md-7">
                    <form method="post" action="<?= base_url('task/reply') ?>">
                        <table class="table table-striped table-bordered table-mini table-ndt">
                            <thead>
                                <tr>
                                    <th>
                                        <?php if($task['from'] == get_user()['id']){ ?>
                                            <input type="hidden" name="from" value="<?= get_user()['id'] ?>">
                                            <input type="hidden" name="to" value="<?= $task['to'] ?>">
                                        <?php }else{ ?>
                                            <input type="hidden" name="from" value="<?= $task['to'] ?>">
                                            <input type="hidden" name="to" value="<?= $task['from'] ?>">
                                        <?php } ?>
                                        <textarea class="form-control" name="desc" placeholder="Reply" required></textarea>
                                        <input type="hidden" name="task" value="<?= $task['id'] ?>">
                                    </th>
                                    <th class="text-center">
                                        <button type="submit" class="btn btn-primary btn-mini">Send</button>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </form>
                    <table class="table table-striped table-bordered table-mini table-ndt">
                        <thead>
                            <tr>
                                <th>From</th>
                                <th>Desc</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($replys as $key => $value) { ?>
                                <tr>
                                    <th>
                                        <?php if($value['from'] == get_user()['id']){ ?>
                                            ME
                                        <?php }else{ ?>
                                            <?= $this->general_model->_get_user($value['from'])['name'];   ?>
                                        <?php } ?>
                                    </th>
                                    <td><?= nl2br($value['desc']) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>