<div class="page-body">

    
    <?php if(get_user()['user_type'] == '0'){ ?>
        <div class="row">
            <?php foreach ($this->db->get_where('branch',['df' => ''])->result_array() as $key => $value) { ?>
                <div class="col-md-6 col-xl-3">
                    <div class="card user-widget-card bg-c-green">
                        <div class="card-block">
                            <i class="feather icon-file-text bg-simple-c-green card1-icon"></i>
                            <h4><?= $this->db->get_where('leads',['df' => '','dump' => '','branch'  => $value['id']])->num_rows(); ?></h4>
                            <p><?= $value['name'] ?>'s Active Leads</p>
                            <a href="<?= base_url('leads') ?>" class="more-info">More Info</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>


        <div class="row">
            <?php foreach ($this->db->get_where('branch',['df' => ''])->result_array() as $key => $value) { ?>
                <div class="col-md-6 col-xl-3">
                    <div class="card user-widget-card bg-c-yellow">
                        <div class="card-block">
                            <i class="feather icon-file-text bg-simple-c-yellow card1-icon"></i>
                            <h4><?= $this->db->get_where('leads',['df' => '','dump' => 'yes','branch'   => $value['id']])->num_rows(); ?></h4>
                            <p><?= $value['name'] ?>'s Dump Leads</p>
                            <a href="<?= base_url('leads/dump_leads') ?>" class="more-info">More Info</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>

    <?php if(get_user()['user_type'] == '1'){ ?>
        <div class="row">
            <div class="col-md-6 col-xl-3">
                    <div class="card user-widget-card bg-c-green">
                        <div class="card-block">
                            <i class="feather icon-file-text bg-simple-c-green card1-icon"></i>
                            <h4><?= $this->db->get_where('leads',['df' => '','dump' => '','branch'  => get_user()['branch']])->num_rows(); ?></h4>
                            <p>Active Leads</p>
                            <a href="<?= base_url('leads') ?>" class="more-info">More Info</a>
                        </div>
                    </div>
                </div>
            <div class="col-md-6 col-xl-3">
                <div class="card user-widget-card bg-c-yellow">
                    <div class="card-block">
                        <i class="feather icon-file-text bg-simple-c-yellow card1-icon"></i>
                        <h4><?= $this->db->get_where('leads',['df' => '','dump' => 'yes','branch'   => get_user()['branch']])->num_rows(); ?></h4>
                        <p>Dump Leads</p>
                        <a href="<?= base_url('leads/dump_leads') ?>" class="more-info">More Info</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>   

    <?php if(get_user()['user_type'] == '3'){ ?>
        <div class="row">
            <div class="col-md-6 col-xl-3">
                    <div class="card user-widget-card bg-c-green">
                        <div class="card-block">
                            <i class="feather icon-file-text bg-simple-c-green card1-icon"></i>
                            <h4><?= $this->db->get_where('leads',['df' => '','dump' => '','owner'   => get_user()['id']])->num_rows(); ?></h4>
                            <p>Active Leads</p>
                            <a href="<?= base_url('leads') ?>" class="more-info">More Info</a>
                        </div>
                    </div>
                </div>
            <div class="col-md-6 col-xl-3">
                <div class="card user-widget-card bg-c-yellow">
                    <div class="card-block">
                        <i class="feather icon-file-text bg-simple-c-yellow card1-icon"></i>
                        <h4><?= $this->db->get_where('leads',['df' => '','dump' => 'yes','owner'    => get_user()['id']])->num_rows(); ?></h4>
                        <p>Dump Leads</p>
                        <a href="<?= base_url('leads/dump_leads') ?>" class="more-info">More Info</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>      
    
</div>




