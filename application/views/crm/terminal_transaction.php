<section class="content">

<?php 
            $flashmessage = $this->session->flashdata('messageinsertflm'); 
            if (isset($flashmessage)) { 
          ?>
            <div class="alert alert-success" >
                <strong>Well done!</strong> FLM Has Been Submit Succesfully
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          <?php } ?>
          
<?php $this->load->view($header_view);?>
    
<div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>CRM</strong> Monitoring Transaction </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive" style="font-size: 12px;font-family:Arial, Helvetica, sans-serif">
                            <?php echo ! empty($table_cardless) ? $table_cardless : '';?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</section>




