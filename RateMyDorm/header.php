<!-- Jadon Silva, Mustafa Eldmerdash, Michael Komnick
       Apr 30, 2022
       RateMyDorm Final Project
       PHP file to set up every other php file for logging in, pdo queries, tracking sessions, etc
-->

<?php
session_start();

echo <<<_INIT
<!DOCTYPE html> 
<html>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'> 
    <link rel='stylesheet' href='jquery.mobile-1.4.5.min.css'>
    <link rel="stylesheet" href="mobileStyle.css" media="only screen and (max-width: 500px)">
    <link rel="stylesheet" href="style.css" media="screen and (min-width: 501px)">
    <script src='javascript.js'></script>
    <script src='jquery-2.2.4.min.js'></script>
    <script src='jquery.mobile-1.4.5.min.js'></script>
_INIT;

  require_once 'functions.php';
  $userstr = 'Welcome Guest';
  $randstr = substr(md5(rand()), 0, 7);

  if (isset($_SESSION['usrname']))
  {
    $usrname     = $_SESSION['usrname'];
    $loggedin = TRUE;
    $userstr  = "Logged in as: $usrname";
  }
  else $loggedin = FALSE;

echo <<<_MAIN
    <title>Rate My Dorm</title>
  </head>
  <body>
    <div data-role='page'>
      <div data-role='content'>
_MAIN;

  if ($loggedin)
  {
echo <<<_LOGGEDIN
    <div class="navi">
          <a href="index.php">Home</a>
          <a href="dorms.php">Dorm Ratings</a>
          <a href="compare.php">CompareDorms </a>
          <a href="rate.php">Leave a Rating</a>
          <a href="myprofile.php">My Reviews, Qs, & As</a>
          <a href="logout.php">Logout</a>
          <p id='usr'><b>$userstr</b></p>
    </div> <!-- navigation bar -->

    <div class="submenu">
        <a href="terms/terms.html" class="menu">Terms</a>
        <a href="terms/privacypolicy.html" class="menu">Privacy Policy</a>
        <a href="terms/contactus.html" class="menu">Contact</a>
        <a href="terms/about.html" class="menu">About</a>
    </div>
        
_LOGGEDIN;
  }
  else
  {
echo <<<_GUEST
    <div class="navi">
          <a href="index.php">Home</a>
          <a href="dorms.php">Dorm Ratings</a>
          <a href="signup.php">Register </a>
          <a href="signin.php">Login </a>
          <a href="compare.php">CompareDorms </a>
          <a href="rate.php">Leave a Rating</a>
          <p id='usr'><b>$userstr</b></p>
    </div> <!-- navigation bar -->

    <div class="submenu">
        <a href="terms/terms.html" class="menu">Terms</a>
        <a href="terms/privacypolicy.html" class="menu">Privacy Policy</a>
        <a href="terms/contactus.html" class="menu">Contact</a>
        <a href="terms/about.html" class="menu">About</a>
    </div>
        
_GUEST;
  }

?>

<script>
  var width = $( window ).width();
</script>