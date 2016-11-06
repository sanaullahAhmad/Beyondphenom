<!doctype html>
<html><head>
    <meta charset="utf-8">
    <title>Beyond Phenom Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Carlos Alvarez - Alvarez.is">

    <!-- Le styles -->
    <link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/main.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/font-style.css'); ?>" rel="stylesheet">
    <<?php if($this->uri->segment(1)=='myadmin'){?>
    <link href="<?php echo base_url('assets/css/flexslider.css'); ?>" rel="stylesheet">
    <?php } ?>
    <link href="<?php echo base_url('assets/css/templates_form.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/colpick.css'); ?>" rel="stylesheet">
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>

    <style type="text/css">
      body {
        padding-top: 60px;
      }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/ico/favicon.ico'); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('assets/ico/apple-touch-icon-144-precomposed.png'); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url('assets/ico/apple-touch-icon-114-precomposed.png'); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url('assets/ico/apple-touch-icon-72-precomposed.png'); ?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url('assets/ico/apple-touch-icon-57-precomposed.png'); ?>">

    <!-- Google Fonts call. Font Used Open Sans & Raleway -->
  <link href="http://fonts.googleapis.com/css?family=Raleway:400,300" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">

<script type="text/javascript">
$(document).ready(function () {

    $("#btn-blog-next").click(function () {
      $('#blogCarousel').carousel('next')
    });
     $("#btn-blog-prev").click(function () {
      $('#blogCarousel').carousel('prev')
    });

     $("#btn-client-next").click(function () {
      $('#clientCarousel').carousel('next')
    });
     $("#btn-client-prev").click(function () {
      $('#clientCarousel').carousel('prev')
    });
    
});

<?php if($this->uri->segment(1)=='myadmin'){?>
 $(window).load(function(){

    $('.flexslider').flexslider({
        animation: "slide",
        slideshow: true,
        start: function(slider){
          $('body').removeClass('loading');
        }
    });  
});

<?php } ?>
</script>

<script src="https://use.fontawesome.com/79031b81db.js"></script>
    
  </head>
    <body>

