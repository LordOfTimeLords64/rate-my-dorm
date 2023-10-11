<!-- Jadon Silva, Mustafa Eldmerdash, Michael Komnick
       Apr 30, 2022
       RateMyDorm Final Project
       A logout and redirect file
-->

<?php

  require_once 'header.php';

  if(isset($_SESSION['usrname'])) {
  	destroySession();
  	header("Location: index.php");
  }

?>