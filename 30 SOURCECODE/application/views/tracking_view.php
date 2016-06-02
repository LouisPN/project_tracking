<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache"); 
?>
<title><?=$title?></title>
<!--[if lt IE 9]>
	<script src="js/libs/IE9.js"></script>
<![endif]-->
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
<meta property="fb:app_id"          content="93770069237" /> 
<meta property="og:type"            content="article" /> 
<meta property="og:title"           content="Braveberyschool" /> 
<meta property="og:image"           content="<?=base_url()?>images/shared/logo.jpg" /> 
<meta property="og:description"    content="Braveberry School " />

<link rel="image_src" href="<?=base_url()?>images/shared/logo.jpg" / >
<link rel="shortcut icon" href="<?=base_url()?>favicon.ico">
<link rel="apple-touch-icon" href="<?=base_url()?>apple-touch-icon.png">
<link rel="stylesheet" href="<?=base_url()?>css/register.css">
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
<script src="<?=base_url()?>js/libs/modernizr-2.6.1.min.js"></script>
<script src="<?=base_url()?>js/libs/jquery-1.8.0.min.js"></script>
<!--<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
<script src="<?=base_url()?>js/main.js"></script>

<script>
function loginSubmit()
{
document.getElementById("loginForm").submit();
}
</script>
</head>
<body>
<div id="container">
    <div class="wrapRegister">
       <form id="loginForm" action="<?=site_url()?>tracking/process" method="post" accept-charset="utf-8">


      -<div class="logoCenter"> 
        <img src="<?=base_url()?>images/sum/sum_logo_big.gif"  alt=""/>
      </div>
    
      <div align="center" ><?php if(! is_null($msg)) echo $msg;?>  </div>

      <table width="100%" border="0" cellspacing="15" cellpadding="0">
        <tbody>
          <tr>
            <td width="100%">

            <div class="box-form">
              <label for="trackid">Tracking ID</label>
              <input type="text" 

              onkeypress="if(event.keyCode ==13 || event.which== 13) this.form.submit();"
              
               name='trackid' id='trackid'>
             </div></td>
          </tr>
          
          <tr>
            <td height="50" align="center" valign="middle"><div class="btn-login"><a href="#" id="loginButton" onclick="loginSubmit();">Tracking</a></div></td>
          </tr>
          <!--
          <tr>
            <td align="center" valign="middle"><p><a href="<?=site_url()?>vlogin/register">Create an account &gt;</a><br>
             <a href="<?=site_url()?>vlogin/forgetpassword">I've forgotten my password</a> </p> </td>
          </tr>   
        -->
           
        </tbody>
      </table>
      <div class="clearfix"></div>
    </form>
    </div>s
    <div id="footer-wrapper" class="fixBtm">
      <footer><img src="<?=base_url()?>images/sum/sum_logo_small.gif"> Sum Tracking System</footer>
    
    </div>
</div>

<!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]--> 
<!-- Add your site or application content here --> 

<!-- 


 --> 

<script src="<?=base_url()?>js/jquery.backstretch.min.js"></script> 
<script src="<?=base_url()?>js/jquery.infieldlabel.min.js"></script> 
<script src="<?=base_url()?>js/plugins.js"></script> 
<script>
$( document ).ready(function() {
	$.backstretch("<?=base_url()?>images/register/bg-login.jpg");	
  $("label").inFieldLabels(); 
});
</script> 
<!-- scripts concatenated and minified via ant build script--> 
<!-- end scripts--> 
<!--[if lt IE 7 ]>
	<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script>
	<script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
<![endif]--> 

<!--[if (gte IE 6)&(lte IE 8)]>
  <script src="js/libs/selectivizr-min.js"></script>
  <noscript><link rel="stylesheet" href="[fallback css]" /></noscript>
<![endif]-->
</body>
</html>