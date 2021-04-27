<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller
{

  var $title = 'Accout Manajement';
  var $limit = 200;

  function __construct()
  {
    parent::__construct();
    $this->load->model('Log_model', '', TRUE);
    $this->load->model('Postilion_model', '', TRUE);
  }

  function setup_user()
  {
    if ($this->session->userdata('logged_role') != 'Administrator') // Jika user yg login bukan admin
    //die($this->session->userdata('logged_role'));
    show_404(); // Redirect ke halaman 404 Not found

    $terms = $this->Postilion_model->user_mangement();

    $i = 1;
    $recno = 2;

    foreach ($terms as $term) {


      $tmpl = array(
        'table_open'    => '<table class="table table-bordered table-striped table-hover nowrap" id="dt_terminal_log" width="100%">',
        'thead_open'            => '<thead>',
        'thead_close'           => '</thead>',
        'heading_row_start'   => '<tr>',
        'heading_row_end'     => '</tr>',
        'heading_cell_start'  => '<th>',
        'heading_cell_end'    => '</th>',
        'row_alt_start'  => '<tr>',
        'row_alt_end'    => '</tr>'
      );

      $recno++;
      if ($recno > $i) {
        // Penyusunan data baris per baris
        if ($term->status_active == '0') {
          $cell_active = anchor('account/active/' . $term->user_name, '<i class="zmdi zmdi-lock-open"></i>', array('class' => 'table-actions', 'rel' => 'tooltip', 'data-placement' => 'top', 'data-original-title' => 'Active'));
          $cell_status = '<span class="badge badge-danger">Not Active</span>';
        } else {
          $cell_active = anchor('account/nonactive/' . $term->user_name, '<i class="zmdi zmdi-lock"></i>', array('class' => 'table-actions', 'rel' => 'tooltip', 'data-placement' => 'top', 'data-original-title' => 'Block'));
          $cell_status = '<span class="badge badge-success">Active</span>';
        }
        $cell_update = anchor('account/update/' . $term->user_name, '<i class="zmdi zmdi-edit"></i>', array('class' => 'table-actions', 'rel' => 'tooltip', 'data-placement' => 'top', 'data-original-title' => 'Edit'));
        $cell_remove = anchor('account/remove/' . $term->user_name, '<i class="zmdi zmdi-delete"></i>', array('class' => 'table-actions', 'rel' => 'tooltip', 'data-placement' => 'top', 'data-original-title' => 'Remove'));
      }


      $this->table->set_template($tmpl);
      $this->table->set_empty("&nbsp;");
      $this->table->set_heading(
        'No',
        'Username',
        'Email',
        'Role_User',
        'Prefix ATM',
        'Status',
        'Action'

      );

      //   $cell_extends = array('class' => 'details-control', 'title' => $term->short_name );

      $this->table->add_row($i++, $term->user_name, $term->email, $term->role, $term->prefix_atm, $cell_status, $cell_update . ' ' . $cell_active . ' ' . $cell_remove);
    }

    $data = array(
      'title'               => 'Monitoring-Log',
      'header_view'         => 'header_view',
      'content_view'        => 'account/setup_user',
      'username'            => $this->session->userdata('logged_full_name'),
      'lastlogin'           => $this->session->userdata('logged_last_login'),
      'table'               => $this->table->generate(),
    );

    $this->load->view('template', $data);
  }

  function add()
  {


    $data['title'] = 'Monitoring-Log';
    $data['header_view'] = 'header_view';
    $data['content_view'] = 'account/account_add';
    $data['username'] = $this->session->userdata('logged_full_name');
    $data['lastlogin'] = $this->session->userdata('logged_last_login');
    $data['form_action'] = site_url('account/add_process');
    $data['default']['user_name'] = '';
    $data['default']['full_name'] = '';
    $data['default']['user_institution'] = '';
    $data['default']['email'] = '';
    $data['default']['password'] = '';
    $data['default']['confirm_password'] = '';
    $data['default']['user_right'] = '';
    $data['default']['prefix_atm'] = '';
    $data['table'] = $this->table->generate();
    $this->load->view('template', $data);
  }

  function add_process()
  {

    $data['title'] = 'Monitoring-Log';
    $data['header_view'] = 'header_view';
    $data['content_view'] = 'account/account_add';
    $data['username'] = $this->session->userdata('logged_full_name');
    $data['lastlogin'] = $this->session->userdata('logged_last_login');
    $data['form_action'] = site_url('account/add_process');
    $data['table'] = $this->table->generate();
    // Set validation rules
    $this->form_validation->set_rules('user_name', 'User Name', 'required');
    $this->form_validation->set_rules('full_name', 'Full Name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|matches[confirm_password]');
    $this->form_validation->set_rules('confirm_password', 'Confirmation', 'required|min_length[6]');
    $this->form_validation->set_rules('user_right', 'User Right', 'required');
    $this->form_validation->set_rules('prefix_atm', 'Prefix ATM', 'required');
    if ($this->form_validation->run() == TRUE) {
      $user = array(
        'user_name' => $this->input->post('user_name'),
        'full_name' => $this->input->post('full_name'),
        'email' => $this->input->post('email'),
        'password' => $this->input->post('password'),
        'user_right' => $this->input->post('user_right'),
        'prefix_atm' => $this->input->post('prefix_atm')
      );
      $this->Postilion_model->insert($user);
      $this->Postilion_model->insert_group($user);
      $this->session->set_flashdata('message', "Another User ID has been registered.");
      redirect('account/setup_user');
    } else {
      $data['default']['user_name'] = $this->input->post('user_name');
      $data['default']['full_name'] = $this->input->post('full_name');
      $data['default']['email'] = $this->input->post('email');
      $data['default']['password'] = $this->input->post('password');
      $data['default']['confirm_password'] = $this->input->post('confirm_password');
      $data['default']['user_right'] = $this->input->post('user_right');
      $data['default']['prefix_atm'] = $this->input->post('prefix_atm');
      $this->load->view('template', $data);
    }
  }

  function update($user_name)
  {

    $data['title'] = 'Monitoring-Log';
    $data['header_view'] = 'header_view';
    $data['content_view'] = 'account/account_update';
    $data['username'] = $this->session->userdata('logged_full_name');
    $data['last_login'] = $this->session->userdata('logged_last_login');
    $data['form_action'] = site_url('account/update_process/'.$user_name);
    $data['form_action_changepwd'] = site_url('account/change_uid_password/'. $user_name);

    $user = $this->Postilion_model->select($user_name);
    $this->session->set_userdata('date_insert', $user->date_insert);
    $this->session->set_userdata('last_login', $user->last_login);

    // Data untuk mengisi field2 form
    $data['default']['user_name'] = $user->user_name;
    $data['default']['full_name'] = $user->full_name;
    $data['default']['date_insert'] = $user->date_insert;
    $data['default']['last_login'] = $user->last_login;
    $data['default']['email'] = $user->email;
    $data['default']['password'] = $user->password;

    $this->load->view('template', $data);
  }

  function update_process($user_name)
  {

    $data['title'] = 'Monitoring-Log';
    $data['header_view'] = 'header_view';
    $data['content_view'] = 'account/account_update';
    $data['username'] = $this->session->userdata('logged_full_name');
    $data['lastlogin'] = $this->session->userdata('logged_last_login');
    $data['form_action'] = site_url('account/update_process/' . $user_name);
    $data['form_action_changepwd'] = site_url('account/change_uid_password/' . $user_name);
    $data['user_name'] = $user_name;
    $data['table'] = $this->table->generate();
    // Set validation rules
    $this->form_validation->set_rules('full_name', 'Full Name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    if ($this->form_validation->run() == TRUE) {
      $user = array(
        'full_name' => $this->input->post('full_name'),
        'email' => $this->input->post('email'),
        'password' => $this->input->post('password')
      );
      $this->Postilion_model->update_username($user_name, $user);
      $this->session->unset_userdata('date_insert');
      $this->session->unset_userdata('last_login');
      $this->session->set_flashdata('message', "User ID has been updated.");
      redirect('account/setup_user');
    } else {
      $data['default']['full_name'] = $this->input->post('full_name');
      $data['default']['date_insert'] = date($this->session->userdata('date_insert'));
      $data['default']['last_login'] = date('d-m-Y h:i:s', $this->session->userdata('last_login'));
      $data['default']['email'] = $this->input->post('email');
      $data['default']['password'] = $this->input->post('password');
      $data['default']['confirm_password'] = $this->input->post('confirm_password');
      $this->load->view('template', $data);
    }
  }



  function active($user_name)
  {
    //$this->validmodul();
    $this->Postilion_model->active($user_name);
    $this->session->set_flashdata('message', "User ID $user_name is set to active.");
    redirect('account/setup_user');
  }

  function nonactive($user_name)
  {
    //$this->validmodul();
    $this->Postilion_model->nonactive($user_name);
    $this->session->set_flashdata('message', "User ID $user_name is set to not active.");
    redirect('account/setup_user');
  }

  function ajax_get_history_offline($term_id)
  {
    $data = $this->Log_model->get_data_offline_history($term_id);
    echo json_encode($data);
  }

  function ajax_get_history_offline_crm($term_id)
  {
    $data = $this->Log_model->get_data_offline_history_crm($term_id);
    echo json_encode($data);
  }
}
