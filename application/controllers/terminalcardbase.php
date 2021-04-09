<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Terminalcardbase extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Postilion_model', '', TRUE);
    $this->load->model('Log_model', '', TRUE);
  }

  function terminal()
  {
    
    
    $data = array(
        'title'               => 'Monitoring-Log',
        'header_view'         => 'header_view',
        'content_view'        => 'log/terminal',
        'username'            => $this->session->userdata('logged_full_name'),
        'lastlogin'           => $this->session->userdata('logged_last_login'),
        'table'               => $this->table->generate(),
    );

    $this->load->view('template', $data);
  }

  function ajax_get_history_offline($term_id){
    $data = $this->Log_model->get_data_offline_history($term_id);
    echo json_encode($data);
  }

  // function count_trx_cardbase(){
  //   $tmpl = array(
  //     'table_open'    => '<table class="table table-bordered table-striped table-hover" id="dt_count_trx_cardbase" width="100%">',
  //     'thead_open'            => '<thead>',
  //     'thead_close'           => '</thead>',
  //     'heading_row_start'   => '<tr>',
  //     'heading_row_end'     => '</tr>',
  //     'heading_cell_start'  => '<th>',
  //     'heading_cell_end'    => '</th>',
  //     'row_alt_start'  => '<tr>',
  //     'row_alt_end'    => '</tr>'
  //   );
  //   $this->table->set_template($tmpl);
  //   $this->table->set_empty("&nbsp;");

  //   //$time_saldo = $this->Postilion_model->get_time_saldo();
  //   $this->table->set_heading(
  //             'ATM ID', 
  //             'ATM Name', 
  //             'Admin', 
  //             substr($time_saldo->saldo_awal, 0,19), 
  //             substr($time_saldo->saldo_mid, 0,19),
  //             substr($time_saldo->saldo_akhir, 0,19), 
  //             'Difference'
  //   );

  //   $data_terminal_saldo = $this->Postilion_model->get_terminal_saldo();

  //   foreach ($data_terminal_saldo as $data_term_saldo)
  //   {
      
  //     $this->table->add_row(
  //                           $data_term_saldo->terminal_id, 
  //                           $data_term_saldo->terminal_name,
  //                           number_format($data_term_saldo->admin_bars),
  //                           number_format($data_term_saldo->saldo_awal),
  //                           number_format($data_term_saldo->saldo_mid),
  //                           number_format($data_term_saldo->saldo),
  //                           number_format($data_term_saldo->trx)
  //                         );  

  //   }  

  // }

  function card_retain_cardbase(){
    $tmpl = array(
      'table_open'    => '<table style="align: center;" border="5"  class="table center table-bordered table-striped table-hover nowrap" id="dt_card_retain_cardbase">',
      'thead_open'            => '<thead>',
      'thead_close'           => '</thead>',
      'heading_row_start'   => '<tr style="border: 2px solid black; background-color: #2ecc71; font-weight:bold; color:white; align:center;">',
      'heading_row_end'     => '</tr>',
      'heading_cell_start'  => '<th style="align:center;border: 2px solid black;" height=20 width=300>',
      'heading_cell_end'    => '</th>',

      'row_start'           => '<tr style="background-color: #DBF6ED; font-weight:bold;">',
      'row_end'             => '</tr>',
      'cell_start'          => '<td style="border: 2px solid black;" align=center height=20>',
      'cell_end'            => '</td>',

      'row_alt_start'       => '<tr style="background-color: white; font-weight:bold;">',
      'row_alt_end'         => '</tr>',
      'cell_alt_start'      => '<td style="border: 2px solid black;" align=center height=20>',
      'cell_alt_end'        => '</td>',

      'table_close'         => '</table>'
    );
    $this->table->set_template($tmpl);
    $this->table->set_empty("&nbsp;");
    $this->table->set_heading(
              'ATM ID', 
              'ATM Name', 
              'Card Count', 
              'Kelola'
    );

    $card_retain_data = $this->Postilion_model->get_card_retain();
    // $terms_2 = $this->Postilion_model->term_monitor_offset_temp($this->session->userdata('logged_user_name'));

    foreach ($card_retain_data as $data_card_retain)
    {
      
      $this->table->add_row($data_card_retain->id, 
                            $data_card_retain->short_name,
                            $data_card_retain->count_card,
                            $data_card_retain->kelola
                          );  

    }  


  }

  function batch_terminal(){
    $data_batch_viewer = $this->Postilion_model->term_batch_viewer($this->input->post('txtterminalname'));

    $tmpl = array(
      'table_open'    => '<table class="table table-bordered table-striped table-hover nowrap" id="dt_batch_viewer" width="100%">',
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

    // $this->table->set_heading('No', 'ATM ID', 'ATM Name', 'Item End', 'Value Bar End','Time','Item Begin','Value Bar Begin','Date Begin','CIT');

    $this->table->set_heading(
      'Terminal Id',
      'Terminal Name',
      'Terminal City',
      'Location'
    );

    foreach ($data_batch_viewer as $dt_batch_viewer)
    {

    $this->table->add_row(
        $dt_batch_viewer->terminal_id,
        $dt_batch_viewer->terminal_name,
        $dt_batch_viewer->terminal_city,
        $dt_batch_viewer->location
      );

    }

    $data = array(
      'title'               => 'Monitoring-Cardbase',
      'header_view'         => 'header_view',
      'content_view'        => 'batch/contenviewer',
      'sub_header_title'    => 'Terminal Monitoring',
      'header_title'        => 'CARDBASE',
      'alert_flm'           => false,
      'username'            => $this->session->userdata('logged_full_name'),
      'lastlogin'           => $this->session->userdata('logged_last_login'),
      'table_batch_viewer'  => $this->table->generate(),
    );

    $this->load->view('template', $data);
    // var_dump($test);
  }

  function index()
  {

    $terminal = $this->Postilion_model->get_terminal_atm();
    $term = '<option value="">Select Terminal Name</option>';

    

    foreach ($terminal as $data_terminal)
    {
        $term .= '<option value="'.$data_terminal->terminal_name.'" style="font-size: 12px;">'.$data_terminal->terminal_name.'</option>';
    }

    $saldo_cut_off = $this->Postilion_model->date_cut_off_saldo();
    $saldo_date = '<option value="">Select Date Cutoff</option>';

    foreach ($saldo_cut_off as $data_saldo_cut_off)
    {
        $saldo_date .= '<option value="'.$data_saldo_cut_off->settle_date.'" style="font-size: 12px;">'.$data_saldo_cut_off->settle_date.'</option>';
    }

    $data = array(
      'title'               => 'Monitoring-Cardbase',
      'header_view'         => 'header_view',
      'content_view'        => 'terminal/cardbase',
      'sub_header_title'    => 'Terminal Monitoring',
      'header_title'        => 'CARDBASE',
      'alert_flm'           => false,
      'username'            => $this->session->userdata('logged_full_name'),
      'lastlogin'           => $this->session->userdata('logged_last_login'),
      'list_terminal'       => $term,
      'list_cut_off_saldo'  => $saldo_date,
    );

    


    
    $tmpl = array(
      'table_open'    => '<table class="table table-bordered table-striped table-hover nowrap" id="dt_terminal_cardbase" width="100%">',
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
      'ATM ID',
      'Terminal Name',
      'Condition',
      'Mode',
      'Denom',
      'Admin',
      'Amount Bar',
      'Percentage',
      'Jarkon',
      'CIT',
      // 'Detail',
      'FLM/SLM'
    );

    $terms_1 = $this->Postilion_model->term_monitor_offset($this->session->userdata('logged_user_name'));
    $terms_2 = $this->Postilion_model->term_monitor_offset_temp($this->session->userdata('logged_user_name'));
    $terms = array_merge($terms_1,$terms_2);

    foreach ($terms as $term) {

      

      switch ($term->worst_event_severity) {
        case "0":
          $str_condition = 'OK';
          break;
        case "1":
          $str_condition = 'CRITICAL';
          break;
        case "2":
          $str_condition = 'SUSPECT';
          break;
      }


      $status_slm = '';
      $status_flm = '';
      $date_insert_flm = '';
      $date_insert_slm = '';

      $result=$this->Postilion_model->get_status_flm_slm($term->id,'flm');
      foreach ($result as $v){
          $status_flm=$v->status_flm;
          $date_insert_flm = $v->date_insert;
      }

      $result=$this->Postilion_model->get_status_flm_slm($term->id,'slm');
      foreach ($result as $v){
          $status_slm=$v->status_slm;
          $date_insert_slm = $v->date_insert;
      }

      $mode = explode('|', $term->miscellaneous);

      if (substr($mode[0], 2, strlen($mode[0]) - 2) == 'Off-line') {

        if ($this->Postilion_model->get_terminal_offline_front($term->id)->num_rows() != 0) {
          $start_off = substr($this->Postilion_model->get_terminal_offline_front($term->id)->row()->start_time, 0, 19);
          $duration_off = $this->Postilion_model->get_terminal_offline_front($term->id)->row()->duration;
        } else {
          $start_off = '-';
          $duration_off = '-';
        }

        $v_off = '<div style=color:black;color:black>' . substr($mode[0], 2, strlen($mode[0]) - 2) . '</br>' . $start_off . '<br><br><span style="border-top:0px solid;color:red;font-weight:bold">' . $duration_off . '</span></div>';
      } else {
        $duration_off = '';
        $v_off = '<div style=color:black;color:black>' . substr($mode[0], 2, strlen($mode[0]) - 2) . '</div>';
      }

      if ($term->max_percent == '') {
        $coba = '0';
      } else {
        $coba = $term->max_percent;
      }

      if ($term->Percentage < $term->max_percent && $term->Percentage > 0) {
        //$cell11 = '<span style="background:red">'.$term->max_percent.'%</span>';
        $cell_percentage = array('data' => round($term->Percentage, 2) . '%', 'style' => 'background:red;font-weight: bold;color:white', 'class' => 'boxtemp', 'data-tooltip' => 'Max ' . $coba . '% to ' . $term->expired_saldo);
      } else if ($term->Percentage < $term->max_percent + 5) {
        $cell_percentage = array('data' => round($term->Percentage, 2) . '%', 'style' => 'background:yellow;font-weight: bold;color:black', 'class' => 'boxtemp', 'data-tooltip' => 'Max ' . $coba . '% to ' . $term->expired_saldo);
      } else {
        //$cell11 = '<span style="background-color:green">'.$term->max_percent.'%</span>';
        $cell_percentage = array('data' => round($term->Percentage, 2) . '%', 'style' => 'background:white;font-weight: regular;color:black', 'class' => 'boxtemp', 'data-tooltip' => 'Max ' . $coba . '% to ' . $term->expired_saldo);
      }

      

      if ($str_condition == 'OK' &&  $mode[0] == '6.In Service') {
        if ($status_flm == 'Submit' || $status_flm == 'Modify') {
          $this->Postilion_model->update_status_flm($term->id, 'status_flm');
        }
        if ($status_slm == 'Submit' || $status_slm == 'Modify') {
          $this->Postilion_model->update_status_slm($term->id, 'status_slm');
        }
        $cell_flm = '';
        $cell_slm = '';
      }

      if ($str_condition != 'OK' || $mode[0] != '6.In Service') {

        $cell_flm = '<input id="flmid" type="button" onclick="add_person(this.value,' . "'" . $term->id . "','Submit'" . ')" title="' . $term->id . '" value="FLM" class="btn btn-warning" 
                     onmouseover="this.title=\'\';" >';
        $cell_slm = '<input id="slmid" type=button value=SLM disabled class="btn btn-warning" 
                     >';
        if ($status_flm == 'Submit' || $status_flm == 'Modify') {

          $cell_flm = '<input id="flmid" type="button" onclick="add_person(this.value,' . "'" . $term->id . "|" .$date_insert_flm. "','Modify'" . ')" title="' . $term->id . '" value="FLM" class="btn btn-danger" 
               onmouseover="this.title=\'\';" >';
          $cell_slm = '<input id="slmid" type=button onclick=add_person(this.value,' . "'" . $term->id . "|" .$date_insert_flm. "','Submit'" . ') value=SLM class="btn btn-warning" 
              >';
        }
        if ($status_slm == 'Submit' || $status_slm == 'Modify') {

          $cell_flm = '<input id="flmid" type="button" onclick="add_person(this.value,' . "'" . $term->id . "|" .$date_insert_slm. "','Modify'" . ')" title="' . $term->id . '" value="FLM" class="btn btn-danger" 
               onmouseover="this.title=\'\';" >';

          $cell_slm = '<input id="slmid" type=button onclick="add_person(this.value,' . "'" . $term->id . "|" .$date_insert_slm. "','Modify'" . ')" value=SLM class="btn btn-danger" 
              >';
        }
        //die($status_flm);
      }

    //   $cell_extends = array('class' => 'details-control', 'title' => $term->id );

      $this->table->add_row(
        // $cell_extends,
        array('data' => anchor('terminalcardbase/terminal_monitor_detail/'.$term->id,$term->id,array('class' => 'table-view-link')), 'class' => 'row-nav'),
        //'<a href="#">'.$term->id.'</a>',
        $term->short_name,
        $str_condition,
        '<div style=color:white;float:left;display:none>' . substr($mode[0], 0, 1) . '</div>' . $v_off,
        $term->nominal,
        '<span title=' . $term->vAdminBars . '>' . number_format($term->vAdminBars) . '</span>',
        '<span title=' . $term->vValueBars . '>' . number_format($term->vValueBars) . '</span>',
        $cell_percentage,
        $term->jarkom,
        $term->cit,
        // array('data' => anchor('postilion/terminal_monitor_detail/' . $term->id, 'View', array('class' => 'table-view-link')), 'class' => 'row-nav'),
        $cell_flm . $cell_slm
      );

    }

    $data['table_cardbase'] = $this->table->generate();

    $this->card_retain_cardbase();
    $data['table_card_retain'] = $this->table->generate();

    // $this->count_trx_cardbase();
    // $data['table_count_trx_atm'] = $this->table->generate();

    $terms = $this->Log_model->get_terminal();

    $tmpl = array(
      'table_open'    => '<table style="align: center;" border="5" class="table table-bordered table-striped table-hover nowrap" id="dt_terminal_log">',
      // 'thead_open'            => '<thead>',
      // 'thead_close'           => '</thead>',
      'heading_row_start'   => '<tr style="border: 2px solid black; background-color: #2ecc71; font-weight:bold; color:white; align:center;">',
      'heading_row_end'     => '</tr>',
      'heading_cell_start'  => '<th style="align:center;border: 2px solid black;" height=20 width=100>',
      'heading_cell_end'    => '</th>',

      'row_start'           => '<tr style="background-color: #DBF6ED; font-weight:bold;">',
      'row_end'             => '</tr>',
      'cell_start'          => '<td style="border: 2px solid black;" align=center height=50>',
      'cell_end'            => '</td>',

      'row_alt_start'       => '<tr style="background-color: white; font-weight:bold;">',
      'row_alt_end'         => '</tr>',
      'cell_alt_start'      => '<td style="border: 2px solid black;" align=center height=50>',
      'cell_alt_end'        => '</td>',

    );
    $this->table->set_template($tmpl);
    $this->table->set_empty("&nbsp;");
    $this->table->set_heading(
      '',
      'ATM ID',
      'Terminal Name'
    );

    foreach ($terms as $term) {

      $cell_extends = array('class' => 'details-control', 'title' => $term->short_name );

      $this->table->add_row(
        $cell_extends,
        $term->id,
        $term->short_name
      );

    }

    $data['table_log'] = $this->table->generate();
    
    $this->load->view('template', $data);
  }

  public function get_datetime_server()
  {
    echo date('Y-m-d H:i:s');
  }

  public function ajax_add()
  {
    $vTable = $this->input->post('ajaxTable');
            if($vTable == 'SLM'){
            $status_flm_slm = 'status_slm';
            }else{
            $status_flm_slm = 'status_flm'; 
            }
    $data = array(
            'terminal_id' => $this->input->post('ajaxTerminalID'),
            'atmi_problem' => $this->input->post('ajaxProblem'),
            'vendor' => $this->input->post('ajaxVendor'),
            'date_time_problem' => $this->input->post('txtdatetime'),
            'description' => $this->input->post('txtdescription'),
            'user_create' => $this->input->post('ajaxUser'),
            $status_flm_slm => $this->input->post('ajaxStatusFLM_SLM'),  
            'date_insert' => $this->input->post('ajaxDateInsert'),
            
        );
    $insert = $this->Postilion_model->save($data,$vTable);
    $this->session->set_flashdata('messageinsertflm', "User ID has been inserted.");
    echo json_encode(array("status" => TRUE));
  }

  public function ajax_update()
    {
        $vTable = $this->input->post('ajaxTable');
                if($vTable == 'SLM'){
                $status_flm_slm = 'status_slm';
                }else{
                $status_flm_slm = 'status_flm'; 
                }

        $data = array(
                'atmi_problem' => $this->input->post('ajaxProblem'),
                'vendor' => $this->input->post('ajaxVendor'),
                'date_time_problem' => $this->input->post('txtdatetime'),
                'description' => $this->input->post('txtdescription'),
                'user_modify' => $this->input->post('ajaxUser'),
                $status_flm_slm => $this->input->post('ajaxStatusFLM_SLM'),  
                'date_modify' => $this->input->post('ajaxDateInsert'),
            );
        $param = explode('|', $this->input->post('ajaxTerminalID'));
        $this->Postilion_model->update(array('terminal_id' => $param[0],'date_insert' => $param[1]), $data);
        echo json_encode(array("status" => TRUE));
    }

  public function ajax_get_data_flm_slm()
  {
      $post_term_id = $this->input->get('term_id');
      $data = $this->Postilion_model->get_data_flm_slm($post_term_id);
      echo json_encode($data);
  }

  function terminal_monitor_detail($term_id='0'){
    $data = array(
      'title'               => 'Terminal Monitor Detail',
      'header_view'         => 'header_view',
      'content_view'        => 'terminal/details',
      'sub_header_title'    => 'Terminal Monitor Detail',
      'header_title'        => 'Details Monitors',
      'alert_flm'           => false,
      'username'            => $this->session->userdata('logged_full_name'),
      'lastlogin'           => $this->session->userdata('logged_last_login'),
    );

    $this->tbl_term_monitor_detail($term_id);
    $data['table_terminal_monitor_detail'] = $this->table->generate();

    $this->tbl_term_monitor_status_fields($term_id);
    $data['table_terminal_monitor_status_fields'] = $this->table->generate();

    $this->tbl_term_monitor_events($term_id);
    $data['table_terminal_monitor_events'] = $this->table->generate();

    $this->load->view('template', $data);

  }

  function tbl_term_monitor_detail($id){
    $tmpl = array(
      'table_open'    => '<table class="table table-hover c_table theme-color">',
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
              'ATM ID', 
              'ATM Name', 
              'Condition', 
              'Mode'
    );

    $term_monitor_detail = $this->Postilion_model->get_terminal_detail($id);

    foreach ($term_monitor_detail as $data_term_monitor_detail)
    {
      
      $this->table->add_row($data_term_monitor_detail->id, 
                            $data_term_monitor_detail->short_name,
                            $data_term_monitor_detail->miscellaneous,
                            $data_term_monitor_detail->worst_event_severity
                          );  

    }  


  }

  function tbl_term_monitor_status_fields($id){
    $tmpl = array(
      'table_open'    => '<table class="table table-hover c_table theme-color">',
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
              'Name', 
              'Description', 
              'Severity'
    );

    $term_monitor_detail = $this->Postilion_model->get_terminal_detail($id);

    foreach ($term_monitor_detail as $data_term_monitor_detail)
    {
      
      $this->table->add_row($data_term_monitor_detail->id, 
                            $data_term_monitor_detail->short_name,
                            $data_term_monitor_detail->miscellaneous,
                          );  

    }  


  }

  function tbl_term_monitor_events($id){
    $tmpl = array(
      'table_open'    => '<table class="table table-hover c_table theme-color">',
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
              'Severity', 
              'State', 
              'Date & Time', 
              'Description'
    );

    $term_monitor_detail = $this->Postilion_model->get_terminal_detail($id);

    foreach ($term_monitor_detail as $data_term_monitor_detail)
    {
      
      $this->table->add_row($data_term_monitor_detail->id, 
                            $data_term_monitor_detail->short_name,
                            $data_term_monitor_detail->miscellaneous,
                            $data_term_monitor_detail->worst_event_severity
                          );  

    }  


  }

  function term_detail(){
    $tmpl = array(
      'table_open'    => '<table class="table table-bordered table-striped table-hover" id="dt_card_retain_cardbase" width="100%">',
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
              'ATM ID', 
              'ATM Name', 
              'Card Count', 
              'Kelola'
    );

    $card_retain_data = $this->Postilion_model->get_card_retain();
    // $terms_2 = $this->Postilion_model->term_monitor_offset_temp($this->session->userdata('logged_user_name'));

    foreach ($card_retain_data as $data_card_retain)
    {
      
      $this->table->add_row($data_card_retain->id, 
                            $data_card_retain->short_name,
                            $data_card_retain->count_card,
                            $data_card_retain->kelola
                          );  

    }  


  }

  


}
