<section class="content">

<?php $this->load->view($header_view);?>
<div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="card project_list">
                        <div class="table-responsive">
                            <!-- <table class="table table-hover c_table theme-color">
                                <thead>
                                    <tr>                                       
                                        <th>ATM ID</th>
                                        <th>ATM Name</th>
                                        <th>Condition</th>                                        
                                        <th>Mode</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            01000447
                                        </td>
                                        <td>
                                            IDM RUMPIN
                                        </td>
                                        <td>
                                            CRITICAL
                                        </td>                                        
                                        <td class="hidden-md-down">
                                            IN SERVICE
                                        </td>                                       
                                    </tr>
                                    
                                </tbody>
                            </table> -->
                            <?php echo ! empty($table_terminal_monitor_detail) ? $table_terminal_monitor_detail : '';?>
                        </div>
                        
                    </div>
                    <div class="card project_list">
                        <div class="table-responsive">
                            <!-- <table class="table table-hover c_table theme-color">
                                <thead>
                                    <tr>                                       
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Severity</th>                                                                               
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                        Card Reader/Writer
                                        </td>
                                        <td>
                                        SUSPECT
                                        </td>
                                        <td>
                                        SUSPECT
                                        </td>                                                                            
                                    </tr>
                                    
                                </tbody>
                            </table> -->
                            <?php echo ! empty($table_terminal_monitor_status_fields) ? $table_terminal_monitor_status_fields : '';?>
                        </div>
                        
                    </div>
                    <div class="card project_list">
                        <div class="table-responsive">
                            <!-- <table class="table table-hover c_table theme-color">
                                <thead>
                                    <tr>                                       
                                        <th>Severity</th>
                                        <th>State</th>
                                        <th>Date & Time</th>                                        
                                        <th>Description</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                        Suspect
                                        </td>
                                        <td>
                                        Unattended
                                        </td>
                                        <td>
                                        14 Mar 2021 09:28
                                        </td>                                        
                                        <td>
                                        Reversal failed. Reason : Rsp code 25 returned by TM for transaction #Reversal (8403).
                                        </td>                                       
                                    </tr>
                                    
                                </tbody>
                            </table> -->
                            <?php echo ! empty($table_terminal_monitor_events) ? $table_terminal_monitor_events : '';?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

</section>


