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
        <form method="post" action="<?= base_url('user/update_sales_person') ?>">
            <div class="card-block">
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Name <span class="-req">*</span></label>
                            <input name="name" type="text" placeholder="Name" class="form-control" value="<?= set_value('name',$user['name']); ?>">
                            <?= form_error('name') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Username <span class="-req">*</span></label>
                            <input name="username" type="text" placeholder="Username" class="form-control" value="<?= set_value('username',$user['username']); ?>">
                            <?= form_error('username') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Password</label>
                            <input name="password" type="text" placeholder="Password" class="form-control" value="<?= set_value('password'); ?>">
                            <?= form_error('password') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Mobile <span class="-req">*</span></label>
                            <input name="mobile" type="text" placeholder="Mobile" class="form-control" value="<?= set_value('mobile',$user['mobile']); ?>">
                            <?= form_error('mobile') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Email <span class="-req">*</span></label>
                            <input name="email" type="text" placeholder="Email" class="form-control" value="<?= set_value('email',$user['email']); ?>">
                            <?= form_error('email') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Gender <span class="-req">*</span></label>
                            <select class="form-control" name="gender">
                                <option value="Male" <?= set_value('gender',$user['gender']) == 'Male'?'selected':'' ?>>Male</option>
                                <option value="Female" <?= set_value('gender',$user['gender']) == 'Female'?'selected':'' ?>>Female</option>
                            </select>
                            <?= form_error('gender') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Branch <span class="-req">*</span></label>
                            <select class="form-control" name="branch">
                                <option value="">-- Select Branch --</option>
                                <?php foreach ($this->general_model->get_branches() as $key => $value) { ?>
                                    <option value="<?= $value['id'] ?>" <?= $value['id'] == set_value('branch',$user['branch'])?'selected':'' ?>><?= $value['name'] ?></option>
                                <?php } ?>
                            </select>
                            <?= form_error('branch') ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Type <span class="-req">*</span></label>
                            <select class="form-control" name="type">
                                <option value="">-- Select Type --</option>
                                <option value="1" <?= selected(set_value('type',$user['type']),"1") ?>>Field Sales</option>
                                <option value="2" <?= selected(set_value('type',$user['type']),"2") ?>>Tele Sales</option>
                                <option value="3" <?= selected(set_value('type',$user['type']),"3") ?>>Freelance Sales</option>
                                <option value="4" <?= selected(set_value('type',$user['type']),"4") ?>>Admin Tele Sales</option>
                            </select>
                            <?= form_error('type') ?>
                        </div>
                    </div>

                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                </div>
            </div>

            <div class="card-footer text-right">
                <a href="<?= base_url('user/sales_person') ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Back</a>
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-save"></i> Save
                </button>
            </div>
        </form>
    </div>
</div>