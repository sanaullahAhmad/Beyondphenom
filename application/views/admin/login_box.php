 <link href="<?php echo base_url('assets/css/login.css'); ?>" rel="stylesheet">



    <style type="text/css">
      body {
        padding-top: 30px;
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

    <!-- Jquery Validate Script -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.validate.js'); ?>"></script>

    <!-- Jquery Validate Script - Validation Fields -->
    <script type="text/javascript">
    $.validator.setDefaults({
      submitHandler: function() { window.open ('dashboard.html','_self',false) }
    });
    
    $().ready(function() {
      // validate the comment form when it is submitted
      $("#commentForm").validate();
    
      // validate signup form on keyup and submit
      $("#signupForm").validate({
        rules: {
          firstname: "required",
          lastname: "required",
          username: {
            required: true,
            minlength: 1
          },
          password: {
            required: true,
            minlength: 1
          },
          confirm_password: {
            required: true,
            minlength: 2,
            equalTo: "#password"
          },
          email: {
            required: true,
            email: true
          },
          topic: {
            required: "#newsletter:checked",
            minlength: 2
          },
          agree: "required"
        },
        messages: {
          firstname: "Please enter your firstname",
          lastname: "Please enter your lastname",
          username: {
            required: "Please enter a username",
            minlength: "Your username must consist of at least 1 character"
          },
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 1 character long"
          },
          confirm_password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long",
            equalTo: "Please enter the same password as above"
          },
          email: "Please enter a valid email address",
          agree: "Please accept our policy"
        }
      });
    
      // propose username by combining first- and lastname
      $("#username").focus(function() {
        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        if(firstname && lastname && !this.value) {
          this.value = firstname + "." + lastname;
        }
      });
    
      //code to hide topic selection, disable for demo
      var newsletter = $("#newsletter");
      // newsletter topics are optional, hide at first
      var inital = newsletter.is(":checked");
      var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
      var topicInputs = topics.find("input").attr("disabled", !inital);
      // show when newsletter is checked
      newsletter.click(function() {
        topics[this.checked ? "removeClass" : "addClass"]("gray");
        topicInputs.attr("disabled", !this.checked);
      });
    });
    </script>


      <div class="container">
        <div class="row">
      <div class="col-lg-offset-4 col-lg-4" style="margin-top:100px">
        <div class="block-unit" style="text-align:center; padding:8px 8px 8px 8px;">
          <img src="<?php echo base_url('assets/img/face80x80.jpg'); ?>" alt="" class="img-circle">
          <br>
          <br>
           <fieldset>
        <?php
            echo form_open('myadmin/login');
            echo form_label('','email');
            $edata = array('name'=>'email','class'=>'input-block-level','placeholder'=>'Email Address', 'style'=>'width: auto; background: white!important;text-indent:0;');
            echo form_input($edata);
            echo form_label('','password');
            $pdata = array('name'=>'password','class'=>'input-block-level', 'id'=>'password', 'placeholder'=>'Password', 'style'=>'text-indent:0;');
            echo form_password($pdata);
            ?>
    <br>
            <?php 
            $sub = array('class'=>'btn  btn-primary');
            echo form_submit($sub,'Login','login');
            echo form_close();
        ?>
    </fieldset> 
      

      </div>


        </div>
    </div>



    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
