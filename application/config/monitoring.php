<?php if( ! defined('BASEPATH')) exit('Akses langsung tidak diperkenankan');
$config['institution'] = 'alto';
$config['cardbase_prefix'] = '010';
$config['cardless_prefix'] = '041';
$config['realtime_version'] = '5';
//berkas wrapper untuk sisi publik
$config['public_view'] = 'login/login_view';
//restrict page after login 
$config['restrict_view'] = 'restricted_screen';
//captcha word
$config['captcha_word'] = array(
                                'kopi'
                                ,'teh'
                                ,'lab'
                                ,'sel'
                                ,'pena'
                                ,'korek'
                                ,'obat'
                                ,'resep'
                                ,'kaki'
                                ,'kafe'
                                ,'tablet'
                                ,'kapsul'
                                ,'kafe'
                                );
//captcha number
$config['captcha_num'] = array(
                                '123'
                                ,'234'
                                ,'345'
                                ,'456'
                                ,'567'
                                ,'678'
                                ,'789'
                                ,'890'
                                ,'901'
                                ,'012'
                                );

/**
* SISI ADMINISTRASI
*/
//tingkatan pengguna
$config['user_level'] = array(
                            1 => '1'
                            ,2 => '2' //view terminal monitor
                            ,3 => '3' //view 
                            ,4 => '4' //view 
                            ,5 => '5'
                            ,6 => '6'
                            ,7 => '7'
                            ,8 => '8' //administrator
                            ,9 => '9' //highest administrator
                            );


/*
| -------------------------------------------------------------------------
| Tables.
| -------------------------------------------------------------------------
| Database table names.
*/
$config['tables']['users']           = 'tbl_users';
$config['tables']['groups']          = 'cfg_user_group';
$config['tables']['lookup']          = 'cfg_lookup';
$config['tables']['calendars']       = 'cfg_calendars';
$config['tables']['claim_header']    = 'claim_header';
$config['tables']['claim_comment']   = 'claim_comment';
$config['tables']['batchs']          = 'iso_batch';
$config['tables']['batchs_reject']   = 'iso_batch_reject';
$config['tables']['trans']           = 'iso_trans';
$config['tables']['trans_reject']    = 'iso_trans_reject';
$config['tables']['terminals']       = 'iso_terminal';
$config['tables']['old_terminals']   = 'iso_old_terminal';
$config['tables']['vaults']          = 'iso_vaults';
$config['tables']['bins']            = 'msbin';
$config['tables']['cbc']             = 'msCBC';
$config['tables']['phonebooks']      = 'alto_phonebooks';

/*
 | Users table column and Group table column you want to join WITH.
 |
 */
$config['join']['response_type']  = 'rsp_code_rsp';
$config['join']['claim_type']  = 'claim_type';
$config['join']['lookup_code'] = 'code';
$config['join']['terminal_id'] = 'terminal_id';
$config['join']['bin']         = 'BIN';
$config['join']['cbc']         = 'cbc';
$config['join']['uid']          = 'userid';

/*
 | Users table column and Group table column you want to join WITH.
 |
 */
$config['column']['lookup_category']  = 'category';
$config['column']['lookup_display'] = 'display_name';
//nilai standar tingkatan pengguna saat registrasi
$config['default_user_level'] = 1;
//direktori view admin
$config['admin_view'] = "admin/";
?>