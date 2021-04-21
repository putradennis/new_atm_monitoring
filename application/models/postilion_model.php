<?php

class Postilion_model extends CI_Model {
    
    function __construct()
    {
        parent::__construct();
        $this->db_temp = $this->load->database('old_posti', TRUE);
        $this->tables = $this->config->item('tables');
        $this->join    = $this->config->item('join');
    }

    function insert($set)
    {
        $data = array(

            'status_active' => '0',
            'user_name' => $set['user_name'],
            'full_name' => $set['full_name'],
            'password' => md5($set['password']),
            'date_insert' => date("Y-m-d H:i:s"),
            'email' => $set['email'],
            'user_role' => $set['user_role'],
            'atm_prefix' => $set['atm_prefix'],
            
        );
        $this->load->database('default', TRUE);
        $this->db->insert($this->tables['users'], $data);
    }

    // function get_latest_transaction_crm()
    // {
    //     return $this->db->get('v_transaction')->result();
    // }
    
    // DNS
    function get_latest_transaction_crm()
    {
        $post = $this->load->database('default', TRUE);
        $sql = "select * from atm_monitoring..v_transaction";
        return $post->query($sql);
    }
    
    
    function term_monitor_offset($username) {
        $query = $this->db->query("exec get_terminal_monitor ?", $username);
        return $query->result();
    }

    function user_mangement()
    {
        $query = $this->db->query("exec get_user");
        return $query->result();
    }

    function active($user_name)
    {
        $data = array(
            'user_active' => '1'
        );
        $this->load->database('default', TRUE);
        $this->db->update($this->tables['tbl_users'], $data, array('user_name' => $user_name, 'user_institution' => $this->config->item('institution')));
    }

    function nonactive($user_name)
    {
        $data = array(
            'user_active' => '0'
        );
        $this->load->database('default', TRUE);
        $this->db->update($this->tables['tbl_users'], $data, array('user_name' => $user_name, 'user_institution' => $this->config->item('institution')));
    }

    function term_monitor_offset_temp($username) {
        $query = $this->db_temp->query("exec get_terminal_monitor_temp ?", $username);
        return $query->result();
    }

    function get_terminal_offline_front($id){
        $query = $this->db->query("exec get_mode_terminal '".$id."'");
        return $query;
    }

    function all_terminal() {
        $query = $this->db->query("exec get_dashboard_all_terminal");
        return $query->num_rows();
    }

    public function save($data,$tbl)
    {
        $this->db->insert('tbl_flm', $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update('tbl_flm', $data, $where);
        return $this->db->affected_rows();
    }

    function update_status_flm($term_id)
    {
        $data = array(
                'status_flm' => 'OK',  
                'date_time_ok' => date('Y-m-d H:i:s'),
            );
        $this->db->update('tbl_flm', $data, array('terminal_id' => $term_id));
    }

    function update_status_slm($where, $status_flm_slm)
    {
        $data = array(
                $status_flm_slm => 'OK',  
                'date_time_ok' => date('Y-m-d H:i:s'),
            );
        $this->db->update('tbl_slm', $data, array('terminal_id' => $where));
    }

    function term_monitor_crm($user_term) {
        $query = $this->db->query("exec get_terminal_crm ?", $user_term);
        return $query->result();
    }

    function get_data_flm_slm($term_id){
        $query = $this->db->query("exec get_data_flm_slm ?", $term_id);
        return $query->result();
    }

    function get_status_flm_slm($value_id,$status) {
        $this->db->select('status_'.$status);
        $this->db->select('date_insert');
        $this->db->from('tbl_'.$status);
        $this->db->where('terminal_id', $value_id);
        $this->db->order_by("date_insert", "asc");
        return $this->db->get()->result();
    }

    function get_card_retain(){
        return $this->db->get('v_card_retain')->result();
    }

    function get_offline_term(){
        return $this->db->get('v_terminal_offline')->result();
    }

    function get_closed_term(){
        return $this->db->get('v_terminal_closed')->result();
    }

    function get_inservice_term(){
        return $this->db->get('v_terminal_inservice')->result();
    }

    function get_faulty_term(){
        return $this->db->get('v_terminal_faulty')->result();
    }

    function get_faulty_term_temp(){
        return $this->db->get('v_terminal_faulty')->result();
    }

    function get_terminal_saldo_detail(){
        return $this->db->get('v_terminal_saldo_min')->result();
    }
    

    // function get_time_saldo() {
    //     $query = $this->db->query("exec sp_history_saldo_gettime");
    //     return $query->row();
    // }

    function get_terminal_saldo() {
        $query = $this->db->query("exec sp_history_saldo_getall");
        return $query->result();
    }

    function insert_from_csv($data)
    {
        $this->db->insert_batch('tbl_terminal_upload', $data);
        return $this->db->insert_id();
    }

    function get_data_upload($id_upload){
        return $this->db->get_where('tbl_terminal_upload',array('id_upload' => $id_upload))->result();
    }

    function get_terminal_atm(){
        $this->db->select('terminal_name');
        return $this->db->get('tbl_terminal')->result();
    }

    function term_batch_viewer($terminal){
        return $this->db->get_where('tbl_terminal',array('terminal_name' => $terminal))->result();
    }

    function date_cut_off_saldo(){
        $this->db->select('CONVERT(DATE, CAST(bsn_date AS VARCHAR(8)), 112) as settle_date');
        $this->db->where('bsn_date > 20191231');
        // $this->db->order_by('bsn_date DESC, name ASC');
        $this->db->order_by('bsn_date DESC');
        // $this->db->get('alto_history');
        // die($this->db->last_query());
        return $this->db->get('alto_history')->result();
    }

    function get_parameterize_saldo() {
        $query = $this->db->query("exec getParameterizeAtmi");
        return $query->result();
    }

    function get_terminal_detail($terminal_id) {
        return $this->db->get_where('v_term_monitor_detail',array('id' => $terminal_id))->result();
    }

    function get_terminal_staus_fields($terminal_id) {
        return $this->db->get_where('v_term_monitor_detail',array('id' => $terminal_id))->result();
    }

    function get_terminal_events($terminal_id) {
        return $this->db->get_where('v_term_monitor_detail',array('id' => $terminal_id))->result();
    }

    function get_batch_viewer($date,$user,$terminal){
        // $sql = sprintf("exec sp_getreplenish '%s','%s','%s'", $date,$user,$terminal);
        //$query = $this->db->query("exec sp_getreplenish ?,?,?", $date,$user,$terminal);
        $query = $this->db->query(sprintf("exec sp_getreplenish '%s','%s','%s'", $date,$user,$terminal));
        return $query->result();
    }
    function get_batch_viewer_crm($date, $user, $terminal)
    {
        // $sql = sprintf("exec sp_getreplenish '%s','%s','%s'", $date,$user,$terminal);
        //$query = $this->db->query("exec sp_getreplenish ?,?,?", $date,$user,$terminal);
        $query = $this->db->query(sprintf("exec sp_getreplenish '%s','%s','%s'", $date, $user, $terminal));
        return $query->result();
    }

    function get_saldo($datecutoff){
        $query = $this->db->query(sprintf("exec get_terminal_saldo '%s'", $datecutoff));
        return $query->result();
    }

    function get_saldo_crm($datecutoff)
    {
        $query = $this->db->query(sprintf("exec sp_get_saldo_crm '%s'", $datecutoff));
        return $query->result();
    }

    function search_terminal_card($date_from,$date_end,$terminal){
        $query = $this->db->query(sprintf("exec get_cardholder_not_take '%s','%s','%s'", $date_from,$date_end,$terminal));
        return $query->result();
    }
}
