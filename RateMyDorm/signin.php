<!-- Jadon Silva, Mustafa Eldmerdash, Michael Komnick
       Apr 30, 2022
       RateMyDorm Final Project
       PHP page to log in to an account
-->

<?php
  require_once 'header.php';
  $error = $user = $pass = "";

    if (isset($_POST['usrname'])) {
        $usrname  = $_POST['usrname'];
        $pass     = $_POST['pass'];

        if($usrname == "" || $pass == "")
          $error = 'Enter All Required Fields';
        else{
          $query = "SELECT * FROM `users` WHERE usrname='$usrname'
                     AND pass='" . md5($pass) . "'";
          $result = $pdo->query($query);

          if($result->rowCount() == 0) {
            $error = "Invalid login attempt";
          } else {
            $_SESSION['usrname'] = $usrname;
            $_SESSION['pass'] = $pass;
            header("Location: index.php");
          }
        }
      }

echo <<<_END
    <div class="formcontainer">
    <form id="signin" method="post" name="signin" action="signin.php">
    <br>
    <h3>Sign in</h3>
    <br>
    <label for="loginuser"> User Name    </label>
    <input type="text" name="usrname" id ="loginuser" placeholder= "User Name" autofocus="true" value='$usrname'>

    <br><br><br>
    <label for="loginpass">Password    </label>
    <input type="password" name="pass" id ="loginpass" placeholder= "Password" value='$pass'>

      <br><br>
      <button class="submit" type="submit" action="signin.php">Submit</button>
  </body>
        <h4>Not registered?</h4> <p class="link"><a href="signup.php">Sign up</a></p>
  </form>
_END;

?>
