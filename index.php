<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/cv_style.css?v=1003">
  <script src="./js/jquery-3.4.1.js"></script>
  <script src="./js/popper.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <script src="./js/cv_js.js?v=1008"></script>
  <script src="./js/idle_check.js?v=1000"></script>
  <link href="./fontawesome/css/all.css" rel="stylesheet">
</head>

<body style="height:1500px">

<?php

 require_once("./views/nav.php");?>
<br>

<div class="container-fluid" id="content" style="margin-top:80px">
  <?php if(isset($_GET['p_users'])){require_once("./views/p_users.html");}
      else if(isset($_GET['p_type'])){require_once("./views/p_type.html");}
      else if(isset($_GET['p_store'])){require_once("./views/p_store.html");}
      else if(isset($_GET['store_type'])){require_once("./views/store_type.html");}
      else if(isset($_GET['p_product'])){require_once("./views/p_product.html");} 
      else if(isset($_GET['login'])){require_once("./views/login.html");}
      else{require_once("./views/sh_product.html");}?>
</div>



</body>
</html>



