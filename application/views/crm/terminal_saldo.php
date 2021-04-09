<section class="content">

    <?php
    $flashmessage = $this->session->flashdata('messageinsertflm');
    if (isset($flashmessage)) {
    ?>
        <div class="alert alert-success">
            <strong>Well done!</strong> FLM Has Been Submit Succesfully
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>

    <?php $this->load->view($header_view); ?>

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>CRM </strong> Saldo </h2>
                    </div>
                    <div class="body">
                        <form id="validate-form" class="form-horizontal" method="post" autocomplete="off">
                            <div class="form-group">
                                <div class="col-md-7">
                                    <label class="control-label col-md-2">Date Cut Off</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="test123"><i class="zmdi zmdi-calendar"></i></span>
                                        </div>
                                        <input type="text" class="form-control datetimepicker" name="txtdatetime">

                                        <!-- <input type="text" class="form-control" placeholder="Please choose date & time..." name="txtdatetime"> -->
                                    </div>

                                    <!-- <input type="text" class="form-control" placeholder="Please choose date & time..." name="txtdatetime"> -->
                                </div>

                            </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-7">
                            <label class="control-label col-md-2">Full Name</label>
                            <input type="text" id="full_name" name="full_name" class="form-control" maxlength="25" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-7">
                            <label class="control-label col-md-2">Email</label>
                            <input type="text" id="email" name="email" class="form-control" maxlength="25" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-7">
                            <label class="control-label col-md-2">New Password</label>
                            <input class="form-control" id="password" name="password" type="password" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-7">
                            <label class="control-label col-md-2">Confirm Password</label>
                            <input class="form-control" id="confirm_password" name="confirm_password" type="password" />

                        </div>
                    </div>

                    <!-- <div class="form-group">
                                <div class="col-md-7">
                                    <label class="control-label col-md-2">Role User</label>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" id="sProblem" name="cmbProblem">
                                        <option value="">Select Role</option>
                                        <option value="1. ADMINISTRATOR">1. Administrator</option>
                                        <option value="2. USER">2. User</option>
                                    </select>
                                </div>
                            </div> -->

                    <!-- <div class="form-group">
                                <div class="col-md-7">
                                    <label class="control-label col-md-2">ATM Prefix</label>
                                    <select class="form-control show-tick ms select2" data-placeholder="Select" id="sProblem" name="cmbProblem">
                                        <option value="">Select</option>
                                        <option value="1. ATM">1. ATM</option>
                                        <option value="2. CRM">2. CRM</option>
                                        <option value="3. ALL">3. ALL</option>
                                    </select>
                                </div>
                            </div> -->

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