<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/cv_style.css?v=1002">
  <script src="./js/jquery-3.4.1.js"></script>
  <script src="./js/popper.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <script src="./js/cv_js.js?v=1006"></script>
  <script src="./js/idle_check.js?v=1000"></script>
  <link href="./fontawesome/css/all.css" rel="stylesheet">
</head>

<body style="height:1500px">

<?php

 require_once("./views/nav.php");?>
<br>

<div class="container-fluid" id="content" style="margin-top:80px">
  <h3>Collapsible Navbar</h3>
  <p>In this example, the navigation bar is hidden on small screens and replaced by a button in the top right corner (try to re-size this window).</p>
  <p>Only when the button is clicked, the navigation bar will be displayed.</p>
  <p>Tip: You can also remove the .navbar-expand-md class to ALWAYS hide navbar links and display the toggler button.</p>
</div>



</body>
</html>


