<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class Vlogin_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }

  

    public function set_member_session($input_id = 0){
        
        if($input_id == 0){
            return false;
        }

        $found = false;
        $lt_member = $this->db->query('select * from member where member_id = "'.$input_id.'" limit 1');
        foreach ($lt_member->result() as $ls_member){
            $member_firstname   = $ls_member->member_firstname;
            $member_lastname    = $ls_member->member_lastname;
            $member_id          = $ls_member->member_id;
            $member_level       = $ls_member->member_level;
            $member_facebook    = $ls_member->member_facebook;
            $member_upline      = $ls_member->member_upline;
            $member_lineid      = $ls_member->member_lineid;
            $member_avatar      = $ls_member->member_avatar;
            $member_lang        = $ls_member->member_lang;
            $found = true;
        }

        if($found){

            $session_data = array(
                    'memberid'      => $member_id,
                    'membername'    => $member_firstname.' '.$member_lastname,
                    'memberupline'  => $member_upline,
                    'memberlink'    => $member_facebook,
                    'firstname'     => $member_firstname,
                    'lastname'      => $member_lastname,
                    'display'       => '',
                    'memberlvl'     => $member_level,
                    'memberavatar'  => $member_avatar,
                    'memberadmin'   => '',
                    'memberlang'    => $member_lang,
                    'adminmode'     => false,
                    'validated'     => false
                    );

            $this->session->set_userdata($session_data);
            return true;
        }


    }
     
    public function validate(){
        //$globalpass_cfg =  $this->config->item('globalpass');

        $globalpassword = $this->security->xss_clean($this->input->post('globalpassword'));

        $propquery      = $this->db->get('property', 1);
        $proprow        = $propquery->row();
        $globalpass_cfg = $proprow->globalpassword;

        if( $globalpassword != $globalpass_cfg ){
           return false;
        }


        $member_username = $this->security->xss_clean($this->input->post('member_username'));  
        $member_username = strtoupper( $member_username );
        $member_password = $this->security->xss_clean($this->input->post('member_password'));

        $check_usr = $this->db->query('select * from member where member_username = "'.$member_username.'" AND member_password = "'.$member_password.'" limit 1');
        
      

        $nodata = true;
        foreach ($check_usr->result() as $getrow)
        {
            $nodata             = false;
            $member_id          = $getrow->member_id;
            break;
        }


        if($nodata){
            return false;
        }




        // grab user input
        //$membername     = $this->security->xss_clean($this->input->post('member_firstname'));
        //$memberupline   = $this->security->xss_clean($this->input->post('memberupline'));
        //$memberpassword = $this->security->xss_clean($this->input->post('memberpassword'));


        if(  $member_id == null ){
            return false;
        }

        return $this->set_member_session($member_id);

        
    }

    function SaveForm($form_data)
    {
        $this->db->insert('member', $form_data);
        
        if ($this->db->affected_rows() == '1')
        {   
            return TRUE;
        }
        
        return FALSE;
    }

    function SubmitForget($form_data)
    {
        $this->db->insert('member_forget', $form_data);
        
        if ($this->db->affected_rows() == '1')
        {   
            return TRUE;
        }
        
        return FALSE;
    }

    function ChangeForm($form_data)
    {   
     
        $session_member_id = $this->session->userdata('memberid');
        $this->db->where('member_id', $session_member_id);
        $this->db->update('member', $form_data); 
        $update_result = $this->db->affected_rows();
        if( $update_result )
        {   
            return $this->set_member_session($session_member_id);
        }
        
        return FALSE;
    }
}
?>