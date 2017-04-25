<?php  
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>

<html>
<head>
  <title>Welcome to IUSocial</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script>
    $(document).ready(function(){
     $('#wrapper').fadeIn();
    });
</script>
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <style>
    html{
      height:100%;
    }
    body{
      margin:0;
      height:100%;
    }
    #wrapper {
      width: 100%;
      height: 100%;
      background-image: url("http://localhost:220/IUSocial/assets/images/backgrounds/newwallz.jpg");
      background-size: cover;
      display: none;
    }
    .low_button {
      cursor: pointer;
      display: block;
      margin:  0 auto; 
      background-image: url("http://localhost:220/IUSocial/assets/images/icons/rightchevronfilled.png");
      border: 0;
      width: 50px;
      height: 50px;
      position: fixed;
      bottom: 50px;
      left: 50%;
      background-repeat: no-repeat;
      border-radius: 50px;      
    }
    .low_button:hover{
      background-image: url("http://localhost:220/IUSocial/assets/images/icons/rightchevron.png");
      border: 0;
      width: 50px;
      height: 50px;
      background-repeat: no-repeat;
      cursor: pointer;
      display: block;
      margin:  0 auto; 
      border-radius: 50px;
    }
    
  </style>
</head>
<body>
  <div id="wrapper">
    <Button class="low_button" onclick="window.location.href='register.php'">
    </Button>
  </div>
</body>
</html>