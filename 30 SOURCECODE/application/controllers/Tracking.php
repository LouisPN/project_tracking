<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login controller class
 */
class Tracking extends CI_Controller{
     
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('date');
        //$this->load->model('vlogin_model');
    }
     
    public function index($msg = NULL){

        $data['msg'] = $msg;
        $data['title'] = 'SUM Tracking';
        $this->load->view('tracking_view', $data);
        
    }

    
    public function process(){

        $data['title'] = 'SUM Tracking';
        $data['msg'] = '';


        //Validate input code from URL
        $tracking_code = $this->uri->segment(3);
        $tracking_id = "";

        $submit_code = $this->security->xss_clean($this->input->post('trackid'));

        IF(strval($submit_code) != ""){

            $tracking_code = $submit_code;   
        } 

        // Modify Module ID if blank set default to librarry
        if(strval($tracking_code) == "" ){
            $msg = 'Tracking Code does not found';
            $this->index($msg);
            return false;
        }

        //Verify data from database
        //$query_tracking = $this->db->query('select * from tracking where track_code = "BKK001" limit 1');
         //$query_tracking = $this->db->query('select * from tracking where track_id = 1');
        
        $query_tracking = $this->db->query('select * from tracking where track_code = "'.$tracking_code.'" ');
        
        if( $query_tracking->num_rows() == 0 ){
          $msg = 'Incorrect Tracking CODE "'.$tracking_code.'" please try again';
          $this->index($msg);
          return false;
        }

        //assign tracking row to screen
        $tracking_row = $query_tracking->row();
        $data['tracking'] = $tracking_row;



        $query_trackstep = $this->db->query('select * from tracking_step where tracking_id = "'.$tracking_row->track_id.'"');
        $data['lt_trackstep'] = $query_trackstep;

        $this->load->view('tracking_result_view', $data);
        


/*
        // Load the model
        //$this->load->model('vlogin_model');
        // Validate the user can login
        $result = $this->vlogin_model->validate();
        // Now we verify the result
        if(! $result){
            // If user did not validate, then show them login page again
            $msg = '<font color=red>Invalid Username / Password or Global Password.</font><br />';
            $this->index($msg);
        }else{
            // If user did validate,
            // Send them to members area
            redirect('video','refresh');  
        }       
        */
    }
}
?>