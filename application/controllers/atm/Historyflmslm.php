<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Historyflmslm extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Postilion_model', '', TRUE);
  }

  function index()
  { 
    $data = array(
        'title'               => 'Monitoring-History FLM/SLM',
        'header_view'         => 'header_view',
        'content_view'        => 'atm/history_flm_slm',
        'sub_header_title'    => 'History Flm Slm',
        'header_title'        => 'HISTORY FLM SLM',
        'username'            => $this->session->userdata('logged_full_name'),
        'lastlogin'           => $this->session->userdata('logged_last_login'),
        // 'table'               => $this->table->generate(),
    );

    $terms = $this->Postilion_model->term_monitor_crm($this->session->userdata('logged_user_name'));

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
	  $this->table->set_heading('No',
                                'Terminal ID', 
                                'Terminal Name',
                                'Min Saldo (%)',
                                'Status Email',
                                'From',
                                'To',
                                'Current Saldo (%)',
                                'Action');


    $i = 0; $recno = 0;
    $str_condition = '';
    foreach ($terms as $term) 
    {


    }

    $this->load->view('template', $data);
  }

}
