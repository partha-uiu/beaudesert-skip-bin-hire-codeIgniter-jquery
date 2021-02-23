<?php ob_start("ob_gzhandler"); ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>Beaudesert Area Skip Bin Hire</title>
<meta name="keywords" content="beaudesert area, wastebin , skipbinhire , hire , bin , waste removal service, book online , order , waste management, household rubbish, rubbish, general waste, heavy waste,dirt,green waste,bricks and concrete, recycling , online order, commercial organisation, recycling industry, book a bin">
<meta name="description" content="Beaudesert Area Skip Bin Hire offers waste removal services for builders, new home buildings, renovations, and commercial buildings. We supply waste bins to business and residential homes for the removal and clean up of your general household rubbish, scrap steel, green waste, dirt, bricks and concrete.">

<!-- Mobile viewport -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">

<link rel="shortcut icon" href="images/favicon.ico"  type="image/x-icon">

<!-- CSS-->
<!-- Google web fonts.!-->

<link rel="stylesheet" href="css/reset.css">
<!--[if IE]><link rel="stylesheet" href="css/normalize.css"><!--<![endif]-->
<link rel="stylesheet" href="js/flexslider/flexslider.css">
<link rel="stylesheet" href="css/style.css">

<!--[if IE]>
<style>
.flexslider { 
display : block; 
margin : 0 0 60px; 
background : #fff; 
border : #fff solid 4px; 
border-radius : 4px; 
box-shadow : 0 1px 4px rgba(0, 0, 0, 0.2); 
} 
.grid_1 { 
width : 8.33333333%;
min-width: 300px; 
} 
.grid_2 { 
width : 16.66666667%; 
min-width: 300px;
} 
.grid_3 { 
width : 25%; 
min-width: 300px;
} 
.grid_4 { 
width : 33.33333333%; 
min-width: 250px;
} 
.grid_5 { 
width : 41.66666667%; 
min-width: 300px;
} 
.grid_6 { 
width : 50%; 
} 
.grid_7 { 
width : 58.33333333%; 
} 
.grid_8 { 
width : 66.66666667%; 
} 
.grid_9 { 
width : 75%; 
} 
.grid_10 { 
width : 83.33333333%; 
} 
.grid_11 { 
width : 91.66666667%; 
} 
.grid_12 { 
width : 100%; 
} 
.grid_1, .grid_2, .grid_3, .grid_4, .grid_5, .grid_6, .grid_7, .grid_8, .grid_9, .grid_10, .grid_11, .grid_12 { 
float : left; 
display : block; 
} 


</style>
<![endif]-->

<!-- end CSS-->
    
<!-- JS-->
<script src="js/libs/modernizr-2.6.2.min.js"></script>
<!-- end JS-->
</head>
<body id="home">
<!-- header -->
<?php include "includes/header.htm"; ?>
<?php include "content/message.htm"; ?>
<!-- end header -->
<!-- hero area (the grey one with a slider) -->
    <section id="hero" class="clearfix">    
    
    <div class="wrapper">
      <div class="row">
        <div class="grid_4">
		<h1>Beaudesert Area Skip Bin Hire</h1>
        <p>Beaudesert Area Skip Bin Hire offers waste removal services for builders, 
        new home buildings, renovations, and commercial buildings. We supply waste 
        bins to business and residential homes for the removal and clean up of 
        your general household rubbish, scrap steel, green waste, dirt, bricks 
        and concrete.</p>
            <p><a href="http://www.beaudesertareaskipbinhire.com/shop/product" class="buttonlink">Book Your Skip Bin</a></p>
        </div>
        <div class="grid_8 rightfloat">
        		<!-- FlexSlider -->
				<?php include "content/flexslider.htm"; ?>
              <!-- FlexSlider -->
                </div><!-- end grid div -->
           </div><!-- end .row div -->
        </div><!-- end .wrapper div -->
    </section><!-- end hero area -->
<!-- main content area -->      
<div id="main" class="wrapper clearfix">  
  
<!-- content area -->
<?php include "content/main.htm"; ?> 
<!-- #end content area -->
</div>
<!-- #end div #main .wrapper -->
<!-- 3 columns -->
<?php include "content/three_columns.htm"; ?> 
<!-- #end div .wrapper -->
<!-- #end 3 columns -->
<!-- footer area -->
<?php include "includes/footer.htm"; ?>
<!-- #end footer area -->
<!-- jQuery -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/libs/jquery-1.9.0.min.js">\x3C/script>')</script>

<script defer src="js/flexslider/jquery.flexslider-min.js"></script>

<!-- fire ups - read this file!  -->   
<script src="js/main.js"></script>
<!-- end fire ups - read this file!  -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {
		if ($.browser.msie && $.browser.version.substr(0,1)<7)
		{
		$('li').has('ul').mouseover(function(){
			$(this).children('ul').css('visibility','visible');
			}).mouseout(function(){
			$(this).children('ul').css('visibility','hidden');
			})
		}

		/* Mobile */
		$('#menu-wrap').prepend('<div id="menu-trigger">Menu</div>');		
		$("#menu-trigger").on("click", function(){
			$("#menu").slideToggle();
		});

		// iPad
		var isiPad = navigator.userAgent.match(/iPad/i) != null;
		if (isiPad) $('#menu ul').addClass('no-transition');      
    });          
</script>
</body>
</html>
