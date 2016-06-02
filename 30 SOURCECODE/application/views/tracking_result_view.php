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
<title></title>
<!--[if lt IE 9]>
	<script src="js/libs/IE9.js"></script>
<![endif]-->
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

<link rel="shortcut icon" href="favicon.ico">
<link rel="apple-touch-icon" href="apple-touch-icon.png">
<link rel="stylesheet" href="<?=base_url()?>css/kickstart.css">
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
<script src="<?=base_url()?>js/vendor/modernizr-2.6.1.min.js"></script>
<script src="<?=base_url()?>js/libs/jquery-1.8.0.min.js"></script>
<!--<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
<script src="<?=base_url()?>js/main.js"></script>
</head>
<body>
<div id="container">
  <div id="header-wrapper">
    <header>
      <div id="logo"><a href="<?=base_url()?>"><img src="<?=base_url()?>images/sum/sum_logo_big.gif"></a></div>
      <!--
      <div id="box-search">
        <input name="" type="text" onfocus="if(this.value=='search') this.value='';" onblur="if(this.value=='') this.value='search';" value="search" class="normal">
        <input name="input" type="button" value="" class="iconsearch">
      </div>
  -->
  <!--
      <div id="icon-lock">
        <ul>
          <li><a href="#"><img src="images/shared/icon-cup.png" width="33" height="33" alt=""/></a></li>
        </ul>
      </div>
      <div id="avatar">
        <div class="myaccount"><a href="#">My account</a></div>
        <div class="name">CA Patrick</div>
        <img src="images/shared/avatar.jpg" width="33" height="33" alt=""/>
        <div class="logout"><a href="#">Logout</a></div>
      </div>
      <nav>
        <ul id="menus" >
          <li><a href="#">x</a></li>
          <li><a href="#" class="pink"><span>HOME</span>Kick Start</a></li>
          <li><a href="#">News</a></li>
        </ul>
      </nav>
      ----> 
    </header>
  </div>
  <div id="content">
    <section>
      <div id="box-kickstart">
        <div class="box"><br>
          <span>Tracking ID :</span>
          <div class="mode"><?=$tracking->track_code?></div>
        </div>
        <div id="box-video">
          <div class="videoName">Status</div>
          <div class="videoplayer">  In Progressed
            <!--  <img src="images/kickstart/video.jpg" alt=""/>-->
            </div>
        </div>
        <div id="box-tmbvideo">
          <ul class="videoStep" style="height:630px">
            <?php $step_num = 0; 
                 $step_idx = 0;?>
                <?php foreach($lt_trackstep->result() as $ls_trackstep ): ?>  

                <?php
                  $step_top = $step_num * 90;
                  $step_num = $step_num + 1 ;
                  $step_idx = 99 - $step_num;


                  $step_num_padded = sprintf("%02d", $step_num);
                ?>

            

                    <li style="z-index:<?=$step_idx?>; top:<?=$step_top?>px;">
                    <a href="#" class="">
                    <div class="label">
                    <div class="number"><?=$step_num_padded?></div>
                    <p>STEP</p>
                  </div>
                  <div class="name"><?=$ls_trackstep->step_short?></div>
                  <div class="tmb">
                   <!-- <img src="<?=$image_url?>" alt="" width="95" height="72"/>-->
                   <?=$ls_trackstep->step_datetime?>
                  </div>
                  </a>
                </li>

                <?php endforeach; ?>  

                
          </ul>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="btn-back"><a href="JavaScript:history.back();"></a></div>
    </section>
  </div>
  <div id="sitemap-wrapper" class="padtop">
    <div id="sitemap">
      <ul>
        <!--<li><a href="#">Home</a></li>-->
      </ul>
      <ul>
      </ul>
      <ul>
      </ul>
      <!--
      <div id="box-search">
        <input name="" type="text" onfocus="if(this.value=='search') this.value='';" onblur="if(this.value=='') this.value='search';" value="search" class="normal">
        <input name="input" type="button" value="" class="iconsearch">
      </div>
    -->
    </div>
  </div>
  <div id="footer-wrapper">
    <footer><img src="<?=base_url()?>images/sum/sum_logo_small.gif">Sum Tracing System</footer>
  </div>
</div>

<!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]--> 
<!-- Add your site or application content here --> 

<!-- 


 --> 

<script src="<?=base_url()?>js/plugins.js"></script> 
<script></script> 
<script>
	$(document).ready(function () {
    size_li = $("#box-comingsoon ul").size();
    x=1;
		$('#box-comingsoon h2:lt('+x+')').show();
    $('#box-comingsoon ul:lt('+x+')').show();
    $('#loadMore').click(function () {
        x= (x+1 <= size_li) ? x+1 : size_li;
				$('#box-comingsoon h2:lt('+x+')').fadeIn("slow");
        $('#box-comingsoon ul:lt('+x+')').fadeIn("slow");
    });
				
    $( "#datepickerFrom" ).datepicker();
		$( "#datepickerTo" ).datepicker();   
		
		$(".clearFilters").on("click", function(event){
        $("input").val("");
    });
  	
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