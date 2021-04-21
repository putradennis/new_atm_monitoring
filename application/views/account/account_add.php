<section class="content">
    <?php $this->load->view($header_view); ?>
    <!-- <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Monitoring</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Aero</a></li>
                    <li class="breadcrumb-item active">Log</li>
                </ul>
                <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
            </div>
        </div>
    </div> -->
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>User</strong> Account </h2>
                    </div>
                    <div class="body">
                        <form id="validate-form" action="<?php echo $form_action; ?>" class="form-horizontal" method="post" autocomplete="off">
                            <div class="form-group">
                                <div class="col-md-7">
                                    <label class="control-label col-md-2">User Name</label>
                                    <input type="text" id="user_name" name="user_name" class="form-control" maxlength="25" value="<?php echo set_value('user_name', isset($default['user_name']) ? $default['user_name'] : ''); ?>" />
                                    <?php echo form_error('user_name', '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">&times;</button>', '</div>'); ?>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-7">
                                    <label class="control-label col-md-2">Full Name</label>
                                    <input type="text" id="full_name" name="full_name" class="form-control" maxlength="50" value="<?php echo set_value('full_name', isset($default['full_name']) ? $default['full_name'] : ''); ?>" />
                                    <?php echo form_error('full_name', '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">&times;</button>', '</div>'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-7">
                                    <label class="control-label col-md-2">Email</label>
                                    <input type="text" id="email" name="email" class="form-control" value="<?php echo set_value('email', isset($default['email']) ? $default['email'] : ''); ?>" />
                                    <?php echo form_error('email', '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">&times;</button>', '</div>'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-7">
                                    <label class="control-label col-md-2">New Password</label>
                                    <input class="form-control" id="password" name="password" type="password" value="<?php echo set_value('password'); ?>" />
                                    <?php echo form_error('password', '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">&times;</button>', '</div>'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-7">
                                    <label class="control-label col-md-2">Confirm Password</label>
                                    <input class="form-control" id="confirm_password" name="confirm_password" type="password" value="<?php echo set_value('confirm_password'); ?>" />
                                    <?php echo form_error('confirm_password', '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button">&times;</button>', '</div>'); ?>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-7">
                                    <label class="control-label col-md-2">Role User</label>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" id="user_role" name="user_role">
                                        <option value="">- Select Role -</option>
                                        <option value="8">Administrator</option>
                                        <option value="1">User</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-7">
                                    <label class="control-label col-md-2">ATM Prefix</label>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" id="atm_prefix" name="atm_prefix">
                                        <option value="">- Select -</option>
                                        <option value="1">ALL View</option>
                                        <option value="010">ATM</option>
                                        <option value="041">CRM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2"></label>
                                <div class="col-md-7">
                                    <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Register" />
                                    <input type="button" class="btn btn-default-outline" name="cancel" value="Cancel" onclick="window.location='<?php echo base_url(); ?>account/setup_user'" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_open.png') no-repeat center center;
        cursor: pointer;
    }

    tr.shown td.details-control {
        background: url('<?php echo base_url(); ?>assets/images/details_close.png') no-repeat center center;
    }

    table.dataTable tbody th,
    table.dataTable tbody td {
        padding: 8px;
        /* e.g. change 8x to 4px here */
    }
</style>