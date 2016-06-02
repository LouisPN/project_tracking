<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 
<head>   
      <?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache"); 
?>
    <title>SUM Tracking Login Screen for Administrator| Welcome </title>
<style type="text/css">
body {
    background-color: #000;
}
.ds {
    color: #FFFFFF
    ;
}
</style>
</head>
<body bgcolor="#000000">
    <div id="login_form" align="center">
        
        <!--<form action="/login/process" method="post" name="process"> -->
         <?=form_open('login/process'); ?>

            <!--<h2><img src="<?php echo base_url("images/shared/logo.jpg"); ?>" /></h2>-->
            <h2 class="ds">Administrator Login</h2>
            <br />
            <?php if(! is_null($msg)) echo $msg;?>           
            <label for="username" class="ds" >Username</label>
            <input type="text" name='username' id='username' size="25" /><br />
         
            <label for="password" class="ds">Password</label>
            <input type="password" name="password" id='password' size="25" /><br />                        
         
            <input type="Submit" value="Login" />

        </form>
</div>
</body>
</html>