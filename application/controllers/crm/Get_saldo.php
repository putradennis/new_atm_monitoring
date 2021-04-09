<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Get_saldo extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Postilion_model', '', TRUE);
  }

  function index()
  { 
    $data = array(
        'title'               => 'Monitoring-Transaction',
        'header_view'         => 'header_view',
        'content_view'        => 'crm/terminal_saldo',
        'sub_header_title'    => 'Get Saldo CRM',
        'header_title'        => 'Get Saldo CRM',
        'username'            => $this->session->userdata('logged_full_name'),
        'lastlogin'           => $this->session->userdata('logged_last_login'),
        // 'table'               => $this->table->generate(),
    );

    $terms = $this->Postilion_model->term_monitor_crm($this->session->userdata('logged_user_name'));
    $get_last_trx = $this->Postilion_model->get_latest_transaction_crm()->result_array();

    $tmpl = array(
        'table_open'    => '<table class="table table-bordered table-striped table-hover nowrap" id="dt_terminal_crm" width="100%">',
        'thead_open'            => '<thead>',
        'thead_close'           => '</thead>',
        'heading_row_start'   => '<tr>',
        'heading_row_end'     => '</tr>',
        'heading_cell_start'  => '<th>',
        'heading_cell_end'    => '</th>',
        'row_alt_start'  => '<tr>',
        'row_alt_end'    => '</tr>'
      );
    $this->table->set_template($tmpl);
    $this->table->set_empty("&nbsp;");
	$this->table->set_heading(
                                 'No', 
                                'ATM ID', 
                                'ATM Name', 
                                'Deposit', 
                                'Total Deposit', 
                                'Cardless Withdrawal', 
                                'Total Withdrawal',
                                'Total Transaction');

        //$i = 0 + $offset;
        $i = 0;
        //$nominal100 = '';
        foreach ($terms as $term) {

            //die($count_deposit->terminal_id);
            $count_deposit = 0;
            $count_wdl = 0;
            $datetime_deposit = "00:00:00";
            $datetime_wdl = "00:00:00";
            $total = 0;
            foreach ($get_last_trx as $v_get_last_trx) {
                if ($v_get_last_trx['terminal_id'] == $term->id) {
                    $count_deposit = $v_get_last_trx['count_deposit'];
                    $count_wdl = $v_get_last_trx['count_wdl'];
                    $datetime_deposit = $v_get_last_trx['datetime_deposit'];
                    $datetime_wdl = $v_get_last_trx['datetime_wdl'];
                    $total = $v_get_last_trx['total'];
                }
            }





                    $this->table->add_row(
                                            ++$i, 
                                            $term->id, 
                                            str_replace('_', ' ', $term->short_name),
                                            $datetime_deposit,
                                            $count_deposit,
                                            $datetime_wdl,
                                            $count_wdl,
                                            $total
                                            
                                        );
    				//$this->table->add_row(++$i, $term->id, str_replace('_', ' ', $term->short_name), $str_condition, $cell8);                    
                }

        $data['table_cardless'] = $this->table->generate();

        $this->load->view('template', $data);
    }
}

      
 



