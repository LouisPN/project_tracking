<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login controller class
 */
class Login extends CI_Controller{
     
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
    }
     
    public function index($msg = NULL){
        // Load our view to be displayed
        // to the user
       // echo "member ".$this->session->userdata('memberadmin');
        /*
        if($this->session->userdata('memberadmin') == $this->config->item('admin_lvl') ){
            $data = array(
                    'userid' => $this->session->userdata('memberid'),
                    'fname' => $this->session->userdata('firstname'),
                    'lname' => $this->session->userdata('lastname'),
                    'username' => $this->session->userdata('membername'),
                    'validated' => true
                    );
            $this->session->set_userdata($data);
            redirect('admin/bbschool','refresh');
        }
        */


        $data['msg'] = $msg;
        $this->load->view('login_view', $data);
        
    }

    public function process(){

        $username = $this->security->xss_clean($this->input->post('username'));
        $usernaem = 'admin';
        $password = $this->security->xss_clean($this->input->post('password'));
        $password = 'admin';


        // Prep the query

    $this->db->select('*');
    $this->db->from('user');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
         
        // Run the query
        $query_user = $this->db->get();
        // Let's check if there are any results
        $row = $query_user->row();
  //      if($query_user)
      if($query_user->num_rows() == 1)
        {
            // If there is a user, then create session data
            $row = $query_user->row();
            $data = array(
                    'adminid' => $row->id,
                    'adminlvl' => $row->group_lvl,
                    'userid' => $row->userid,
                    'fname' => $row->fname,
                    'lname' => $row->lname,
                    'username' => $row->username,
                    'memberid' => '',
                    'validated' => true,
                    'adminmode' => true
                    );
            $this->session->set_userdata($data);
            $result = true;
        }
        // If the previous process did not validate
        // then return false.
        $result = false;

        // Load the model
        //$this->load->model('login_model');
        // Validate the user can login
       // $result = $this->login_model->validate();
        // Now we verify the result
        if(! $result){
            // If user did not validate, then show them login page again
            $msg = '<font color=red>Invalid username and/or password.</font><br />';
            $this->index($msg);
        }else{
            // If user did validate,
            // Send them to members area
            
            redirect('admin/tracking','refresh');

        }       
    }
}
?>