<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ajaxcontroller extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('Postilion_model', '', TRUE);
  }

  function batch_viewer()
  { 
    header('Content-Type: application/json');
    $terminal_name = $this->input->get('terminal_name');
    $date_batch = $this->input->get('datebatch');
    $draw = intval($this->input->get("draw"));
    $user = $this->session->userdata('logged_user_name');
    $query = $this->Postilion_model->get_batch_viewer($date_batch,  $user, $terminal_name);
    $data = [];
    foreach($query as $r) {
        $data[] = array(
            $r->terminal_id,
            $r->short_name,
            $r->nom_item_end,
            $r->item_count,
            $r->time,
            $r->nom_item_begin,
            $r->item_begin,
            $r->date_time_begin,
            $r->cit
        );
    }
    $result = array(
            "draw" => $draw,
            "data" => $data
        );
    echo json_encode($result);
    exit();
  }

  function batch_viewer_crm()
  {
    header('Content-Type: application/json');
    $terminal_name = $this->input->get('terminal_name');
    $date_batch = $this->input->get('datebatch');
    $draw = intval($this->input->get("draw"));
    $user = $this->session->userdata('logged_user_name');
    $query = $this->Postilion_model->get_batch_viewer_crm($date_batch,  $user, $terminal_name);
    $data = [];
    foreach ($query as $r) {
      $data[] = array(
        $r->terminal_id,
        $r->short_name,
        $r->nom_item_end,
        $r->item_count,
        $r->time,
        $r->nom_item_begin,
        $r->item_begin,
        $r->date_time_begin,
        $r->cit
    
      );
    }
    $result = array(
      "draw" => $draw,
      "data" => $data
    );
    echo json_encode($result);
    exit();
  }


  function saldo_terminal_crm()
  {
    header('Content-Type: application/json');
    $date_batch = $this->input->get('datebatch');
    $draw = intval($this->input->get("draw"));
    $query = $this->Postilion_model->get_saldo_crm($date_batch);
    $data = [];
    foreach ($query as $r) {
      $data[] = array(
        $r->terminal_id,
        $r->terminal_name,
        $r->nominal_50,
        $r->rem_50,
        $r->cap_50,
        $r->tran_cut_off,
        $r->nom_rem_50,
        number_format($r->vAdminBars_50),
        number_format($r->nominal_100),
        $r->rem_100,
        $r->cap_100,
        $r->nom_rem_100,
        number_format($r->vAdminBars_100)
      );
    }
    $result = array(
      "draw" => $draw,
      "data" => $data
    );
    echo json_encode($result);
    exit();
  }

  function saldo_terminal()
  { 
    header('Content-Type: application/json');
    $date_batch = $this->input->get('datebatch');
    $draw = intval($this->input->get("draw"));
    $query = $this->Postilion_model->get_saldo($date_batch);
    $data = [];
    foreach($query as $r) {
        $data[] = array(
            $r->terminal_id,
            $r->terminal_name,
            $r->nominal,
            $r->rem,
            $r->cap,
            $r->tran_cut_off,
            $r->nom_rem,
            $r->nom_cap
        );
    }
    $result = array(
            "draw" => $draw,
            "data" => $data
        );
    echo json_encode($result);
    exit();
  }

  function cardholder_not_take()
  { 
    header('Content-Type: application/json');
    $date_from = $this->input->get('datefrom');
    $date_end = $this->input->get('dateend');
    $terminal_name = $this->input->get('terminal_name');
    $draw = intval($this->input->get("draw"));
    $query = $this->Postilion_model->search_terminal_card($date_from,$date_end,$terminal_name);
    $data = [];
    foreach($query as $r) {
        $data[] = array(
            $r->entity,
            $r->event_time,
            $r->message,
        );
    }
    $result = array(
            "draw" => $draw,
            "data" => $data
        );
    echo json_encode($result);
    exit();
  }

}
