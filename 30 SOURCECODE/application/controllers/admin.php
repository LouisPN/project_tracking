<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->helper('url');
        $this->load->helper('form');
		//$this->check_isvalidated();
		$this->load->helper('date');
		$this->load->library('grocery_CRUD');	

	  
    }
    
     
    private function check_isvalidated(){
        //if(! $this->session->userdata('validated')){
        if(! $this->session->userdata('adminmode')){
            redirect('login','refresh');
        }
    }

    public function do_logout(){
        $this->session->sess_destroy();
        redirect('login');
    }
	
	function _blog_output($output = null)
	{	
		
    	
		//operate the body
		$this->load->view('admin_view',$output);	
	
	
	}
	
	
	function index()
	{
		//$this->business();
		$this->_blog_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
		redirect('admin/tracking');
	}	
	
	



function delete_thumb($primary_key)
{
	redirect('.', 'refresh');
}

	function tracking(){

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('tracking');


		$crud->set_relation('track_status','status','status_name');

		$output = $crud->render();
		$this->_blog_output($output);

	}

	function stepadd(){

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('tracking_step');	

		$crud->set_relation('tracking_id','tracking','{track_id}:{track_code}');

		$crud->set_relation('step_id','step','{step_id}:{step_name}');

		//Unset some Delete and Edit view
		$crud->unset_delete();
		$crud->unset_edit();

		$output = $crud->render();
		$this->_blog_output($output);

	}

	function stepmon(){

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('tracking_step');

		$crud->set_relation('tracking_id','tracking','{track_id}:{track_code}');

		$crud->set_relation('step_id','step','{step_id}:{step_name}');

		//Unset  Add Edit Delete, but allow only Display on matrix only 
		$crud->unset_delete();
		$crud->unset_edit();
		$crud->unset_add();

		$output = $crud->render();
		$this->_blog_output($output);

	}

	function step(){
		// Step matrix master will allow user to add step to system

		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('step');
		$output = $crud->render();


		$this->_blog_output($output);

	}

	function status(){
		// Status matrix master will allow user to add status to system
		$crud = new grocery_CRUD();

		//$crud->set_theme('datatables');
		$crud->set_table('status');
		$output = $crud->render();
		$this->_blog_output($output);

	}




	function business()
	{
			$crud = new grocery_CRUD();

			// set Date theme and database connections
			$crud->set_theme('datatables');
			$crud->set_table('business');
			
			// Set Data relationship
			$crud->set_relation('thaiselect','thaiselectaward','{thaiselect_text}');
			$crud->set_relation('state','state','{state_text}');
			$crud->set_relation('category_id','category','{category_name}');

			$crud->set_relation('zagat','booleantable','{flag}');

			$crud->set_relation('michelin','booleantable','{flag}');


			// Set Field Label
			$crud->display_as('category_id','Business Category');
			$crud->display_as('address1','Address');
			$crud->display_as('business_id','Restaurant');
			$crud->display_as('business_id','Restaurant');

			// Set subject
			$crud->set_subject('Business');
			
			//$crud->required_fields('business_name','thaiselect','title','office_id','address1','state','phone','email','contact_person');
			$crud->required_fields('business_name','thaiselect','office_id','address1','state','phone');


			$crud->set_field_upload('picturemain','assets/uploads/files');
			$crud->set_field_upload('picturerelate1','assets/uploads/files');
			$crud->set_field_upload('picturerelate2','assets/uploads/files');
			$crud->set_field_upload('picturerelate3','assets/uploads/files');
			$crud->set_field_upload('picturerelate4','assets/uploads/files');
			$crud->set_field_upload('picturerelate5','assets/uploads/files');
			$crud->set_field_upload('picturerelate6','assets/uploads/files');
			$crud->set_field_upload('picturerelate7','assets/uploads/files');
			$crud->set_field_upload('picturerelate8','assets/uploads/files');
			$crud->set_field_upload('picturerelate9','assets/uploads/files');
			$crud->set_field_upload('picturerelate10','assets/uploads/files');
			$crud->set_field_upload('picturerelate11','assets/uploads/files');
			$crud->set_field_upload('picturerelate12','assets/uploads/files');
			$crud->set_field_upload('picturerelate13','assets/uploads/files');
			$crud->set_field_upload('picturerelate14','assets/uploads/files');
			$crud->set_field_upload('picturerelate15','assets/uploads/files');
			$crud->set_field_upload('picturerelate16','assets/uploads/files');
			$crud->set_field_upload('picturerelate17','assets/uploads/files');
			$crud->set_field_upload('picturerelate18','assets/uploads/files');
			$crud->set_field_upload('picturerelate19','assets/uploads/files');
			$crud->set_field_upload('picturerelate20','assets/uploads/files');
			
			
			// set column overview
			$crud->columns(array('business_name','address1','city','state','contact_person','telephone','email','update_by','update_date'));

			// add where clause
			if ($this->session->userdata('office_id') != 'NY') {


				$crud->where('office_id',$this->session->userdata('office_id'));
				$crud->change_field_type('office_id', 'hidden',$this->session->userdata('office_id')) ;


				//$crud->unset_edit_fields('office_id');
			//	$crud->unset_add_fields('office_id');

			}else{
				$crud->set_relation('office_id','offices','{city}');

				
			}

		    $state = $crud->getState();
		 
		    if($state == 'add')
		    {
		        // in add we do default create date as today
		        
		        //$crud->unset_add_fields('update_date','update_by');
		    	$crud->change_field_type('create_date', 'hidden',mdate("%Y-%m-%d %H:%i:%s", now()));
		    	$crud->change_field_type('create_by', 'hidden', $this->session->userdata('userid'));
		    	$crud->change_field_type('update_date', 'hidden', mdate("%Y-%m-%d %H:%i:%s", now()));
		    	$crud->change_field_type('update_by', 'hidden', $this->session->userdata('userid'));

		    }
		    elseif($state == 'edit')
		    {
		        // in edit state we do default update date as today

		        $crud->unset_edit_fields('create_date','create_by');
		    	$crud->change_field_type('update_date', 'hidden', mdate("%Y-%m-%d %H:%i:%s", now()));
		    	$crud->change_field_type('update_by', 'hidden', $this->session->userdata('userid'));

		    }
 //$crud->callback_field('phone',array($this,'field_callback_1'));

		    //zagat
		    
			
		    $crud->order_by('update_date','desc');
			$output = $crud->render();



			$this->_blog_output($output);
	}


	function recipe()
	{
			
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('recipe');


			
			$crud->set_relation('recipe_category_id','recipecategory','{recipe_category_text}');
			//$crud->set_relation('business_id','business','{business_name}');

			$crud->set_relation_n_n('Restaurants', 'recipe_business', 'business', 'link_recipe_id', 'link_business_id', 'business_name','link_priority');
				
			$crud->display_as('id','Row');
			$crud->display_as('business_id','Restaurant');

			$crud->callback_add_field('color',array($this,'add_field_callback_1'));

			$crud->set_subject('Recipe');
			
			$crud->required_fields('recipe_category_id','recipe_name','recipe_text');
			
			$crud->set_field_upload('recipe_thumbnail','assets/uploads/files');
			$crud->set_field_upload('recipe_picture_detail','assets/uploads/files');

			// set column overview
			$crud->columns(array('recipe_id','recipe_name','recipe_category_id','recipe_description','recipe_thumbnail','recipe_picture_detail','update_by','update_date'));
			$crud->order_by('update_date','desc');
			
			/*
			// add where clause
			if ($this->session->userdata('office_id') != 'XX') {


				$crud->where('office_id',$this->session->userdata('office_id'));
				$crud->change_field_type('office_id', 'hidden',$this->session->userdata('office_id')) ;

				//$crud->unset_edit_fields('office_id');
			//	$crud->unset_add_fields('office_id');

			}else{
				
			}*/

			$state = $crud->getState();
			if($state == 'add')
		    {
		        // in add we do default create date as today
		        
		       // $crud->unset_add_fields('update_date','update_by');

		        $now = date('d/m/Y h:m:s');
		    	//$crud->change_field_type('create_date', 'hidden',$now);
		    	$crud->change_field_type('create_date', 'hidden', mdate("%Y-%m-%d %H:%i:%s", now()));
		    	$crud->change_field_type('create_by', 'hidden', $this->session->userdata('userid'));
		    	$crud->change_field_type('update_date', 'hidden', mdate("%Y-%m-%d %H:%i:%s", now()));
		    	$crud->change_field_type('update_by', 'hidden', $this->session->userdata('userid'));
		    	

		    }
		    elseif($state == 'edit')
		    {
		        // in edit state we do default update date as today

		        $crud->unset_edit_fields('create_date','create_by');

		        //$now = date('d/m/Y h:m:s');
		    	//$crud->change_field_type('update_date', 'hidden',$now);

		    	$crud->change_field_type('update_date', 'hidden', mdate("%Y-%m-%d %H:%i:%s", now()));
		    	$crud->change_field_type('update_by', 'hidden', $this->session->userdata('userid'));


		    }

		   //$crud->callback_before_delete(array($this,'delete_thumb'));

	   		$crud->add_action('View', '', 'recipe/detail');
	   			//$crud->add_action('Imprimir Factura', base_url() . 'images/imprimir.jpg', '', 'imprimirFactura', array($this, 'redirecImprimirFactura'));
			$output = $crud->render();
			$this->_blog_output($output);

	}
	function add_field_callback_1()
	{
	    return '+30 <input type="text" maxlength="50" value="" name="phone" style="width:462px">';
	}
 
	function appform()
	{
			
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('appform');

			$crud->unset_edit();
			$crud->unset_add();
			$crud->set_subject('Application Form');

			$crud->columns(array('grade_from','grade_to','thai_select','restaurant_name','city','contact_person','phone','email',));
			$crud->set_relation('thai_select','thaiselectaward','{thaiselect_text}');

			$crud->add_action('View', '', 'appreport/detail');

			$output = $crud->render();
			$this->_blog_output($output);
	}

	function member()
	{
			
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('becomemember');

			//$crud->unset_edit();
			$crud->unset_add();
			$crud->set_subject('Become a Member Form');

			$crud->columns(array('id','member_restaurantname','member_thai_select','member_state','member_phone','member_email','member_contact_person','member_phone','create_date',));
			
			$crud->set_relation('member_thai_select','thaiselectaward','{thaiselect_text}');
			//$crud->set_relation('member_state','state','{state_text}');

			$crud->set_field_upload('upload_document1','uploads');
			$crud->set_field_upload('picture_restaurant','uploads');
			
			// add where clause
			if ($this->session->userdata('office_id') != 'NY') {


				//$crud->where('office_id',$this->session->userdata('office_id'));
				//$crud->change_field_type('office_id', 'hidden',$this->session->userdata('office_id')) ;

				$crud->set_relation('office_id','offices','{city}');

				//$crud->unset_edit_fields('office_id');
			//	$crud->unset_add_fields('office_id');

			}else{
				$crud->set_relation('office_id','offices','{city}');
				
			}

			$crud->add_action('View', '', 'pages/memberdetail');
			$output = $crud->render();
			$this->_blog_output($output);
	}

	function inquiryform()
	{
			
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('inquiryform');

			$crud->unset_edit();
			$crud->unset_add();
			$crud->set_subject('Inquiry Form');

			$crud->display_as('topic_id','Inquiry Topic');

			//$crud->columns(array('grade_from','grade_to','thai_select','restaurant_name','city','contact_person','phone','email',));
			$crud->set_relation('type_of_message','topics','{topic_name}');

			$crud->add_action('View', '', 'contactus/detail');

			$crud->order_by('create_date','desc');
			$output = $crud->render();
			$this->_blog_output($output);

	}


	function contactus()
	{
			
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('contactus');

			//$crud->unset_edit();
			$crud->unset_add();
			$crud->set_subject('Contact Us Form');

			$crud->display_as('type_of_message','Topic');

			//$crud->columns(array('grade_from','grade_to','thai_select','restaurant_name','city','contact_person','phone','email',));
			$crud->set_relation('type_of_message','topics','{topic_name}');

			//$crud->set_relation('area','state','{state_text}');



			// add where clause
			if ($this->session->userdata('office_id') != 'NY') {


				$crud->where('office_id',$this->session->userdata('office_id'));
				//$crud->change_field_type('office_id', 'hidden',$this->session->userdata('office_id')) ;

				$crud->set_relation('office_id','offices','{city}');
				
				//$crud->unset_edit_fields('office_id');
			//	$crud->unset_add_fields('office_id');

			}else{
				$crud->set_relation('office_id','offices','{city}');
				
			}
			$crud->order_by('create_date','desc');
		//	$crud->add_action('View', '', 'contactus/detail');
			$output = $crud->render();
			$this->_blog_output($output);
	}

	function user()
	{
			if ($this->session->userdata('userid') != 'admin') {
				redirect('admin/bbschool');
			}else{
				$crud = new grocery_CRUD();

				$crud->set_theme('datatables');
				$crud->set_table('user');

				$crud->field_type('password','password');

				//$crud->unset_edit();
				//$crud->unset_add();
				$crud->display_as('fname','First Name');
				$crud->display_as('lname','Last Name');

			   	$crud->change_field_type('facebook_id', 'hidden','');

				$crud->field_type('group_lvl','dropdown',array(  '0' => '0', 
																 '1' => '1 Upline',
																 '2' => '2',
																 '3' => '3',
																 '4' => '4',
																 '5' => '5 Content',
																 '6' => '6',
																 '7' => '7',
																 '8' => '8',
																 '9' => '9',
																 '10' => '10 Fully Admin'
																 ));

				//$crud->columns(array('grade_from','grade_to','thai_select','restaurant_name','city','contact_person','phone','email',));
		

			//	$crud->add_action('View', '', 'contactus/detail');
				$output = $crud->render();
				$this->_blog_output($output);
			}
	}


	function Memberview()
	{
				$crud = new grocery_CRUD();
				$crud->set_theme('datatables');
				//$crud->set_theme('flexigrid');
				$crud->set_subject('BB Watching History');

				$crud->set_table('member_video');
				$crud->set_relation('member_id','member','{member_firstname} {member_lastname}');
				$crud->set_relation('video_id','video','videotitle');

				$crud->columns(array('member_id','video_id','view_date'));

				$crud->display_as('member_id','Name');
				$crud->display_as('video_id','Video');
				$crud->display_as('view_date','Watch Date');

				$crud->order_by('view_date','desc');

				$crud->unset_delete();
				$crud->unset_edit();
				$crud->unset_add();

				$output = $crud->render();
				$this->_blog_output($output);
			
	}

	function History()
	{
				$crud = new grocery_CRUD();
				$crud->set_theme('datatables');
				//$crud->set_theme('flexigrid');
				$crud->set_subject('BB Watching History');

				$crud->set_table('fbuser_video');
				$crud->set_relation('user_id','fbuser','fb_name');
				$crud->set_relation('video_id','video','videotitle');

				$crud->columns(array('user_id','video_id','view_date'));

				$crud->display_as('user_id','Name');
				$crud->display_as('video_id','Video');
				$crud->display_as('view_date','Watch Date');

				$crud->order_by('view_date','desc');

				$crud->unset_delete();
				$crud->unset_edit();
				$crud->unset_add();

				$output = $crud->render();
				$this->_blog_output($output);
			
	}

	function Bbmember()
	{
				$crud = new grocery_CRUD();
				$crud->set_theme('datatables');
				//$crud->set_theme('flexigrid');
				$crud->set_table('fbuser');
				$crud->set_subject('BB Member');
				$crud->columns(array('fb_name','fb_link','join_date','last_visit_date'));
				$crud->display_as('fb_name','Name');
				$crud->display_as('fb_link','Facebook');
				$crud->display_as('join_date','Joined Date');
				$crud->display_as('last_visit_date','Visited Dated');

				$crud->unset_delete();
				$crud->unset_edit();
				$crud->unset_add();

				$output = $crud->render();
				$this->_blog_output($output);
			
	}
	function epigram()
	{
				$crud = new grocery_CRUD();
				$crud->set_theme('datatables');
				$crud->set_subject('Epigram');
				//$crud->set_theme('flexigrid');
				$crud->set_table('epigram');
				$crud->field_type('publish_flag','dropdown',array('0' => 'NO', '1' => 'YES'));
				$crud->display_as('publish_flag','Published');
				$crud->unset_add_fields('id');
				$crud->unset_edit_fields('id');
				$crud->columns(array('wording','reference','publish_flag','post_date'));
				$state = $crud->getState();

				$crud->required_fields('wording'
									  ); 

				if($state == 'add')
			    {
	
			    	$crud->change_field_type('post_date', 'hidden',mdate("%Y-%m-%d %H:%i:%s", now()));

			    }
				
				$output = $crud->render();
				$this->_blog_output($output);
			
	}

	function fundamental()
	{
				$crud = new grocery_CRUD();
				$crud->required_fields('id','language','fundamental_video');
				$crud->set_theme('datatables');
				//$crud->set_theme('flexigrid');
				$crud->set_table('video_fundamental');

				$crud->unset_delete();
				$crud->unset_add();

				$crud->set_relation('fundamental_video','video','videotitle');
				$crud->field_type('language','dropdown',array('TH' => 'TH','EN' => 'EN'));
				$crud->columns(array('id','language','fundamental_video'));
				$output = $crud->render();
				$this->_blog_output($output);
			
	}
	function property()
	{
				$crud = new grocery_CRUD();

				$crud->set_theme('datatables');
				//$crud->set_theme('flexigrid');
				$crud->set_table('property');
		

				$crud->field_type('fundamental_require','dropdown',array('0' => 'NO','1' => 'YES'));
				$crud->display_as('fundamental_require','Force Fundamental');
				$crud->columns('fundamental_require');
				$crud->unset_delete();
				$crud->unset_add();
				$output = $crud->render();
				$this->_blog_output($output);
			
	}
	function news()
	{
				$crud = new grocery_CRUD();

				$crud->set_theme('datatables');
				//$crud->set_theme('flexigrid');
				$crud->set_table('news');
				

				$crud->field_type('highlight','dropdown',array('0' => 'NO', '1' => 'YES'));
				$crud->field_type('homehighlight','dropdown',array('0' => 'NO', '1' => 'YES'));
				$crud->field_type('sharable','dropdown',array('0' => 'NO', '1' => 'YES'));
				$crud->set_rules('priority','Priority','integer');
				$crud->set_rules('view_count','Priority','integer');
				$crud->set_field_upload('newsposter','assets/uploads/files');
				$crud->set_field_upload('newscustomposter','assets/uploads/files');

				//Overview Screen
				$crud->columns(array('newstitle','newsshortdesc','newsposter','highlight','homehighlight','priority','post_date'));
				$crud->display_as('newstitle','Title');
				$crud->display_as('newsshortdesc','Description');
				$crud->display_as('newscontent','Long Description');
				$crud->display_as('newsposter','Poster');
				$crud->display_as('newscustomposter','Highlight Poster<br> Size 482x126px');
				$crud->display_as('post_date','Post Date');

				$crud->required_fields('newstitle',
									  'newsshortdesc',
									  'newsposter'
									  ); 



				$crud->unset_edit_fields('newsid','post_by','sharable');
				$crud->unset_add_fields('newsid','post_by','sharable','post_date');
				$state = $crud->getState();
			 
			    if($state == 'add')
			    {
			        
			        $crud->change_field_type('access_level', 'hidden','');
			    	$crud->change_field_type('post_date', 'hidden',mdate("%Y-%m-%d %H:%i:%s", now()));
				}else{
					$crud->change_field_type('access_level', 'hidden','');
				}

				$output = $crud->render();
				$this->_blog_output($output);
			
	}


	function _date($value, $row)
	{
		return "<span style='visibility:hidden;display:none;'>".date('Y-m-d H:i:s', strtotime($value))."</span>".date('d/M/Y H:i:s', strtotime($value))."";
	}


	function bbschool()
	{
				$crud = new grocery_CRUD();

				$crud->set_theme('datatables');
				//$crud->set_theme('flexigrid');
				$crud->set_subject('BB Video');
				$crud->set_table('video');
				$crud->columns(array('videoposter','videotitle','videodesc','highlight','videotype','priority','post_date'));
				$crud->set_relation('videotype','videotype','{group_name}');
				$crud->set_relation('videorestrict','group_data','{group_name}');
				$crud->field_type('highlight','dropdown',array('0' => 'NO', '1' => 'YES'));
				$crud->field_type('shareable','dropdown',array('0' => 'NO', '1' => 'YES'));
				$crud->set_rules('priority','Priority','integer');
				$crud->set_rules('view_count','Priority','integer');
		
				$crud->required_fields('videotitle','videotype','Languages','videorestrict'); // remove poster out of require field
				
//Upload
				$crud->set_field_upload('videom4v','assets/uploads/files');

				$crud->set_field_upload('videoposter','assets/uploads/files');
				$crud->set_field_upload('videopostercustom','assets/uploads/files');
				$crud->set_relation_n_n('Languages', 'video_lang', 'language', 'video_id', 'language_id', 'lang_longdesc','priority');
				$crud->set_relation_n_n('Keyword', 'video_keyword', 'keyword', 'video_id', 'keyword_id', 'keyword','priority');
				//$crud->unset_edit();
				//$crud->unset_add();

				$crud->callback_column('post_date',array($this,'_date'));

				$crud->display_as('videotitle','Title');
				$crud->display_as('videodesc','Description');
				$crud->display_as('videotype','Video Type');
				$crud->display_as('videom4v','Video URL');
				$crud->display_as('videoposter','Poster');
				$crud->display_as('videopostercustom','Highlight Poster<br>Home 738x356px<br>Why I Join 266x273<br>Product 472x212');	
				$crud->display_as('videotype','Video Type');
				//$crud->columns(array('grade_from','grade_to','thai_select','restaurant_name','city','contact_person','phone','email',));
				
				//$crud->change_field_type('post_date', 'display',mdate("%Y-%m-%d %H:%i:%s", now()));
			    $state = $crud->getState();
			 
			    if($state == 'add')
			    {
			        // in add we do default create date as today
			        //$crud->unset_add_fields('update_date','update_by');
			    	$crud->change_field_type('post_date', 'hidden',mdate("%Y-%m-%d %H:%i:%s", now()));
			    //	$crud->change_field_type('create_by', 'hidden', $this->session->userdata('userid'));
			    //	$crud->change_field_type('update_date', 'hidden', mdate("%Y-%m-%d %H:%i:%s", now()));
			    //	$crud->change_field_type('update_by', 'hidden', $this->session->userdata('userid'));

			    }
			    elseif($state == 'edit')
			    {
			        // in edit state we do default update date as today
			     //   $crud->change_field_type('post_date', 'hidden',mdate("%Y-%m-%d %H:%i:%s", now()));

			   /*     $crud->unset_edit_fields('create_date','create_by');
			    	$crud->change_field_type('update_date', 'hidden', mdate("%Y-%m-%d %H:%i:%s", now()));
			    	$crud->change_field_type('update_by', 'hidden', $this->session->userdata('userid'));
*/
			    }

			//	$crud->add_action('View', '', 'contactus/detail');

 
				$output = $crud->render();
				$this->_blog_output($output);
			
	}

	 

	function keyword()
	{
				$crud = new grocery_CRUD();

				$crud->set_theme('datatables');
				$crud->set_table('keyword');
				/*
				$crud->columns(array('videoposter','videotitle','videodesc','highlight','post_date'));
				$crud->set_relation('videotype','videotype','{group_name}');
				$crud->field_type('highlight','dropdown',array('0' => 'NO', '1' => 'YES'));
				$crud->field_type('shareable','dropdown',array('0' => 'NO', '1' => 'YES'));
				$crud->set_rules('priority','Priority','integer');
				$crud->set_rules('view_count','Priority','integer');
	
				$crud->set_field_upload('videom4v','assets/uploads/files');

				$crud->set_field_upload('videoposter','assets/uploads/files');
				$crud->set_relation_n_n('video', 'video_keyword', 'keyword', 'id', 'id', 'videotitle','keyword');
				*/
				//$crud->unset_edit();
				//$crud->unset_add();


				//$crud->columns(array('grade_from','grade_to','thai_select','restaurant_name','city','contact_person','phone','email',));
		

			//	$crud->add_action('View', '', 'contactus/detail');
				$crud->required_fields('keyword',
									  'keyword_desc'
									  ); 
		
				$output = $crud->render();
				$this->_blog_output($output);
			
	}

	function kickstart()
	{
		$crud = new grocery_CRUD();

		$crud->set_theme('datatables');
		$crud->set_table('kickstart');

		$crud->set_relation('kickstart_lang','language','{lang_id} : {lang_longdesc}');
		$crud->set_relation_n_n('Kickstart_Video', 'kickstart_video', 'video', 'kickstart_id', 'video_id', 'videotitle','priority');
	    
		$crud->columns(array('kickstart_lang','kickstart_name'));

		$crud->required_fields('kickstart_name',
							  'kickstart_lang'
							  ); 
		
		$crud->unset_edit_fields('kickstart_id');
		$crud->display_as('kickstart_id'  ,'ID');
		$crud->display_as('kickstart_name','Description');
		$crud->display_as('kickstart_lang','Language');

		$output = $crud->render();
		$this->_blog_output($output);
	}	


	function events()
	{
		$crud = new grocery_CRUD();

		$crud->set_theme('datatables');
		$crud->set_table('events');
		
		//file upload
		$crud->set_field_upload('eventposter','assets/uploads/files');
		$crud->set_field_upload('eventpostercustom','assets/uploads/files');

		$crud->set_relation('eventtimezone','timezone','{timezone_order} : {timezone_desc}');
		$crud->set_relation('eventzone','zone','{country_code} : {zone_name}');
		
		$crud->set_relation_n_n('Languages', 'events_lang', 'language', 'event_id', 'language_id', 'lang_longdesc','priority');
				

		$crud->required_fields('eventtitle',
							  'eventshorttext',
							  'eventstartdatetime',
							  'eventenddatetime',
							  'eventzone',
							  'eventtimezone'
							  ); 
				
		$crud->columns(array('eventposter','eventtitle','eventshorttext','eventstartdatetime','eventenddatetime'));
		$crud->display_as('eventtitle','Title');

		$crud->display_as('eventlocation','Location Text');
		$crud->display_as('eventshorttext','Short Description');
		$crud->display_as('eventlongtext','Long Description');
		$crud->display_as('eventposter','Poster');
		$crud->display_as('eventstartdatetime','Start Date/Time');
		$crud->display_as('eventenddatetime','End Date/Time');
		$crud->display_as('eventtimezone','Timezone'); 
		$crud->display_as('eventlat','Lattitute');
		$crud->display_as('eventlong','Longtitute');

				

		$output = $crud->render();
		$this->_blog_output($output);


	}

	function pingen(){

		$amount = 10;
		for( $i = 0; $i <= $amount; $i++ ) {

			$ss_admin_id = $this->session->userdata('adminid');

			//Generate pin
			$pin_gen = '';
			$digits = 8;
			$pin_gen = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT); // 8 digits

			$digits_admin = 4;
			$pin_admin = str_pad($ss_admin_id,$digits_admin,'0',STR_PAD_LEFT); // 4 digits

			$pin_yyyymm = mdate("%Y%m", now());    // 6 digits

			$pin_code = $pin_yyyymm.$pin_gen.$pin_admin;

			$dupdata = $this->db->query("SELECT * FROM pin WHERE pin_code = ".$pin_code);

			while( $dupdata->num_rows() > 0 ){
				$pin_gen = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
				$pin_code = $pin_yyyymm.$pin_gen.$pin_admin;
				$dupdata = $this->db->query("SELECT * FROM pin WHERE pin_code = ".$pin_code);
			}

			$param = array(
				'pin_created_by' => $ss_admin_id ,
				'pin_day' => 30,
				'pin_code' => $pin_code,
				'pin_created_datetime' => mdate("%Y-%m-%d %H:%i:%s", now())
			);     
			
			$this->db->insert('pin', $param);

		}

		$this->pinmon();
	}

	function pinmon(){

		$crud = new grocery_CRUD();

		$crud->set_theme('datatables');
		$crud->set_table('pin');
		

		$crud->set_relation('pin_created_by','user','{username}:{fname}');

		$crud->set_relation('pin_pay_by','user','{username}:{fname}');
		$crud->field_type('pin_pay','dropdown',array('0' => 'UNPAID', '1' => 'PAID'));

		$crud->field_type('pin_usage','dropdown',array('0' => 'NO', '1' => 'YES'));
		$crud->set_relation('pin_usage_by','member','{member_id}:{member_firstname} {member_lastname}');
		
		//$crud->set_relation_n_n('Languages', 'events_lang', 'language', 'event_id', 'language_id', 'lang_longdesc','priority');
				
/*

		$crud->columns(array('eventposter','eventtitle','eventshorttext','eventstartdatetime','eventenddatetime'));
		$crud->display_as('eventtitle','Title');

		$crud->display_as('eventlocation','Location Text');
		$crud->display_as('eventshorttext','Short Description');
		$crud->display_as('eventlongtext','Long Description');
		$crud->display_as('eventposter','Poster');
		$crud->display_as('eventstartdatetime','Start Date/Time');
		$crud->display_as('eventenddatetime','End Date/Time');
		$crud->display_as('eventtimezone','Timezone'); 
		$crud->display_as('eventlat','Lattitute');
		$crud->display_as('eventlong','Longtitute');
*/
		//$crud->where('pin_created_by',$this->session->userdata('userid'));
		$crud->unset_delete();
		$crud->unset_edit();
		$crud->unset_add();
		//$crud->add_action('Send', '', 'recipe/detail'); pin_created_datetime

		$crud->order_by('pin_created_datetime','desc');

		$output = $crud->render();
		$this->_blog_output($output);
	}


	function trophy(){
		$crud = new grocery_CRUD();

		$crud->set_theme('datatables');
		$crud->set_table('trophy');

		$crud->columns(array('trophy_logo','trophy_title','trophy_lang','trophy_cat','trophy_desc'));
		$crud->set_relation('trophy_lang','language','{lang_id}:{lang_longdesc}');
		$crud->set_relation('trophy_cat','trophycat','{trophycat_name}');

		$crud->set_field_upload('trophy_logo','assets/uploads/files');
	   

	   // $crud->set_relation_n_n('Languages', 'events_lang', 'language', 'event_id', 'language_id', 'lang_longdesc','priority');
				

		$crud->set_relation_n_n('Videos', 'trophy_video', 'video', 'trophy_id', 'video_id', 'videotitle','priority');

		$crud->set_relation_n_n('Actions', 'trophy_action', 'action', 'trophy_id', 'action_id',  '{action_name}','priority');		
		

		$crud->required_fields('trophy_title','trophy_cat','trophy_logo','trophy_lang');
				/*
		$crud->set_relation('trophy_video_01','video','videotitle');
		$crud->set_relation('trophy_video_02','video','videotitle');
		$crud->set_relation('trophy_video_03','video','videotitle');
		$crud->set_relation('trophy_video_04','video','videotitle');
		$crud->set_relation('trophy_video_05','video','videotitle');
		$crud->set_relation('trophy_video_06','video','videotitle');
		$crud->set_relation('trophy_video_07','video','videotitle');
		$crud->set_relation('trophy_video_08','video','videotitle');
		$crud->set_relation('trophy_video_08','video','videotitle');
		$crud->set_relation('trophy_video_09','video','videotitle');
		$crud->set_relation('trophy_video_10','video','videotitle');

		$crud->set_relation('trophy_action_01','action','action_name');
		$crud->set_relation('trophy_action_02','action','action_name');
		$crud->set_relation('trophy_action_03','action','action_name');
		$crud->set_relation('trophy_action_04','action','action_name');
		$crud->set_relation('trophy_action_05','action','action_name');
		$crud->set_relation('trophy_action_06','action','action_name');
		$crud->set_relation('trophy_action_07','action','action_name');
		$crud->set_relation('trophy_action_08','action','action_name');
		$crud->set_relation('trophy_action_09','action','action_name');
		$crud->set_relation('trophy_action_10','action','action_name');
		*/

		$output = $crud->render();
		$this->_blog_output($output);
		
	}
	function trophycat(){
		$crud = new grocery_CRUD();

		$crud->set_theme('datatables');
		$crud->set_table('trophycat');

		$crud->required_fields('trophycat_name',
							   'trophycat_text'
							   );


		//$crud->set_relation_n_n('Languages', 'trophy_lang', 'language', 'video_id', 'language_id', 'lang_longdesc','priority');
				
		//$crud->set_relation('trophy_video_01','video','videotitle');
		$output = $crud->render();
		$this->_blog_output($output);
		
	}
	function action(){
		$crud = new grocery_CRUD();

		$crud->set_theme('datatables');
		$crud->set_table('action');
		//$crud->set_relation('action_lang','language','{lang_id}:{lang_longdesc}');
		//$crud->set_relation_n_n('Languages', 'trophy_lang', 'language', 'video_id', 'language_id', 'lang_longdesc','priority');
				
		//$crud->set_relation('trophy_video_01','video','videotitle');
		$crud->required_fields('action_name'
							   );
		$output = $crud->render();
		$this->_blog_output($output);
		
	}

	function membermaster(){

		$crud = new grocery_CRUD();

		$crud->set_theme('datatables');
		$crud->set_table('member');
		$output = $crud->render();
		$this->_blog_output($output);

	}

	function memberforgot(){

		$crud = new grocery_CRUD();

		$crud->set_theme('datatables');
		$crud->set_table('member_forget');
		$output = $crud->render();
		$this->_blog_output($output);

	}
	function memberaction(){
		$crud = new grocery_CRUD();

		$crud->set_theme('datatables');
		$crud->set_table('member_action');

    	$crud->set_relation('action_id','action','{action_id}:{action_name}');
		$crud->set_relation('member_id','member','{member_firstname} {member_lastname}');

		$crud->unset_delete();
		$state = $crud->getState();
	    if($state == 'add' or $state == 'edit')
	    {
	    	$crud->change_field_type('action_date', 'hidden',mdate("%Y-%m-%d %H:%i:%s", now()));
		}

		$crud->callback_after_insert(array($this, 'action_trophy_gen'));
	    $crud->callback_after_update(array($this, 'action_trophy_gen'));
	    
    	$crud->required_fields('action_id','member_id');

		$output = $crud->render();
		$this->_blog_output($output);

		
	}


	function action_trophy_gen($post_array,$primary_key)
	{	

		$member_id = $post_array['member_id'];
   	    $this->load->model('trophy_model');
		$this->trophy_model->gen_trophy($member_id);
		return true;

	}
	
	
}