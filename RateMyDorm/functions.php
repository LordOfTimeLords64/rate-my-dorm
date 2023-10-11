<!-- Jadon Silva, Mustafa Eldmerdash, Michael Komnick
       Apr 30, 2022
       RateMyDorm Final Project
       PHP file to contain functions
-->

<?php

  $host = "HostRedacted"; // This information has been redacted
  $data = "ratemydorms";
  $user = "UserRedacted"; // This information has been redacted
  $pass = "PasswordRedacted"; // This information has been redacted
  $chrs = 'utf8mb4';
  $attr = "mysql:host=$host;dbname=$data;charset=$chrs";
  $opts = [
           PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
           PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
           PDO::ATTR_EMULATE_PREPARES   => false,
          ];

 try {
    $pdo = new PDO($attr, $user, $pass, $opts);
 } catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
 }

  function destroySession() {
    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
      setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
  }

  function sanitizeString($var) {
    global $pdo;

    $var = strip_tags($var);
    $var = htmlentities($var);

    if (get_magic_quotes_gpc())
      $var = stripslashes($var);

    $result = $pdo->quote($var);
    return str_replace("'", "", $result);
  }

?>
