<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE"> 
		<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE"> 
	<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache"); 
?>
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style type='text/css'>
body
{
	font-family: Arial;
	font-size: 14px;
    background-color: #000;

}
.admintext{
    color: gray;
    text-decoration: none;
    font-size: 14px;
}
a {
    color: white;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
	text-decoration: underline;
	color: white;
}
</style>
</head>
<body>
	<div>
		<?php
		
		
		$menu = "";
		$admin_name = "" ;


		//operate the header 
		$menu = "<img src='".base_url()."images/sum/sum_logo_big.gif' > <br>" ;

			$menu = $menu." | <a href='".site_url('admin/tracking')."'>Tracking</a> ";
			$menu = $menu." | <a href='".site_url('admin/stepmon')."'>Step Monitoring</a> ";
			$menu = $menu." | <a href='".site_url('admin/stepadd')."'>Add Tracking Progress</a> ";
			$menu = $menu." | <a href='".site_url('admin/step')."'>Step Master</a> ";
			$menu = $menu." | <a href='".site_url('admin/status')."'>Status Master</a> ";

		//	$menu = $menu."<a href='".site_url('admin/member')."'>Become Member</a> ";		


		//Diamond Level
		if ($this->session->userdata('adminlvl') >= 5 ) {
			/*
			$menu = $menu." | <a href='".site_url('admin/bbschool')."'>Video</a> ";
			$menu = $menu." | <a href='".site_url('admin/keyword')."'>Keyword</a> ";
			$menu = $menu." | <a href='".site_url('admin/kickstart')."'>Kick Start</a> ";
			//$menu = $menu." | <a href='".site_url('admin/property')."'>Property</a> ";
			//$menu = $menu." | <a href='".site_url('admin/fundamental')."'>Fundamental</a> ";
			//$menu = $menu." | <a href='".site_url('admin/bbmember')."'>BB Member</a> ";
			//$menu = $menu." | <a href='".site_url('admin/history')."'>History</a> ";
			$menu = $menu." | <a href='".site_url('admin/news')."'>News</a> ";
			$menu = $menu." | <a href='".site_url('admin/epigram')."'>Epigram</a> ";
			$menu = $menu." | <a href='".site_url('admin/events')."'>Events</a> ";

			$menu = $menu." | <a href='".site_url('admin/trophycat')."'>Trophies Category</a> ";

			$menu = $menu." | <a href='".site_url('admin/action')."'>Trophies Action</a> ";
			$menu = $menu." | <a href='".site_url('admin/trophy')."'>Trophies</a> ";
			*/
		}

	    //Admin Level
		if ($this->session->userdata('adminlvl') >= 10 ) {
			/*
		//if ($this->session->userdata('userid') == 'admin') {
			$menu = $menu." | <a href='".site_url('admin/membermaster')."'>Member Master</a> ";
			$menu = $menu." | <a href='".site_url('admin/memberforgot')."'>Member Forgot Password</a> ";
			$menu = $menu." | <a href='".site_url('admin/user')."'>Admin User</a> ";

			*/
		}


		$admin_name = $this->session->userdata('fname')." ".$this->session->userdata('lname') ;

		
		?>

	
		<table width="100%" border="0" cellpadding="1" cellspacing="1">
		  <tr>
		    <th scope="col" align="left"><?php echo $menu; ?></th>
		    <th scope="col" align="right" class="admintext"> Welcome back, <?=$admin_name?>  
		    		<?=anchor('admin/do_logout','Log Out');?></th>
		  </tr>
		</table>

	</div>
	<div style='height:20px;'>
		
	</div>  
    <div>
		<?php echo $output; ?>
    </div>
</body>
</html>
