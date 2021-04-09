<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Saldotermcrm extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Postilion_model', '', TRUE);
    }

    function index()
    {

        $saldo_cut_off = $this->Postilion_model->date_cut_off_saldo();
        $saldo_date = '<option value="">Select Date Cutoff</option>';

        foreach ($saldo_cut_off as $data_saldo_cut_off) {
            $saldo_date .= '<option value="' . $data_saldo_cut_off->settle_date . '" style="font-size: 12px;">' . $data_saldo_cut_off->settle_date . '</option>';
        }

        $data = array(
            'title'               => 'Monitoring-Terminal Saldo CRM',
            'header_view'         => 'header_view',
            'content_view'        => 'crm/saldo_terminal_crm',
            'sub_header_title'    => 'Terminal Saldo CRM',
            'header_title'        => 'TERMINAL SALDO CRM',
            'username'            => $this->session->userdata('logged_full_name'),
            'lastlogin'           => $this->session->userdata('logged_last_login'),
            'list_cut_off_saldo'  => $saldo_date,
        );



        $data['table_batch_viewer_crm'] = $this->table->generate();

        $this->load->view('template', $data);
    }
}
