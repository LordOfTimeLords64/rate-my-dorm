<!-- Jadon Silva, Mustafa Eldmerdash, Michael Komnick
       Apr 30, 2022
       RateMyDorm Final Project
       PHP page to register and account
-->

<?php
  require_once 'header.php';

echo <<<_END
  <script>
    function checkUser(user) {
      if (user.value == '') {
        $('#used').html('&nbsp;')
        return
      }
      $.post (
              'checkuser.php',
              { user : user.value },
              function(data) {
               $('#used').html(data)
              }
             )
    }
  </script>  
_END;

  $error = $usrname = $pass = "";
  if (isset($_SESSION['usrname'])) destroySession();

  if(
     isset ($_POST['usrname'])
    ) {
        $fname    = sanitizeString($_POST['fname']);
        $lname    = sanitizeString($_POST['lname']);
        $usrname  = sanitizeString($_POST['usrname']);
        $pass     = sanitizeString($_POST['pass']);
        $confirm  = sanitizeString($_POST['confirm']);
        $email    = sanitizeString($_POST['email']);
        $gradyr   = sanitizeString($_POST['gradyr']);

        if ($fname == "" ||
            $lname == "" ||
            $usrname == "" ||
            $pass == "" ||
            $confirm == "" ||
            $email == "" ||
            $gradyr == ""
           )
          $error = 'Not all field were entered<br><br>';
        else if($pass != $confirm) $error = 'Passwords do not match!';
        else {
          $duplicateusr = "SELECT * FROM users where usrname='$usrname'";
          $duplicateresult = $pdo->query($duplicateusr);
          if($duplicateresult->rowCount())
            $error = 'That username already exists<br><br>';
          else {
            $createuser = "INSERT INTO users (fname, lname, usrname, pass, email, gradyr) VALUES" 
                        . "('$fname', '$lname', '$usrname', '".md5($pass)."', '$email', '$gradyr')";
            $newuser = $pdo->query($createuser);
            die('<h4>Account created</h4><a href="signin.php">Please Log in.</a></div></body></html>');
          }
        }
      }

echo <<<_END

    <div class="formcontainer">
      <form id="signup" method='post' action='signup.php' name="form">$error
      <br>
      <h3>Create your Account</h3>
      <br>
      <label for="first">First Name</label>
      <input type="text" name="fname" id ="first">

      <br><br><br>
      <label for="last">Last Name</label>
      <input type="text" name="lname" id ="last">

      <br><br><br>
      <label for="user">User Name</label>
      <input type="text" pattern="[A-Za-z0-9_]{1,64}" name="usrname" id ="user" placeholder="1-64 chars; letters, numbers & _">
      <p class='req'>Up to 64 characters including letters, numbers, & underscores.</p>
      <div id='usererror'></div>


      <br><br><br>
      <label for="password">Password</label>
      <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="pass" id ="password" placeholder="min 8 chars; 1 lower & uppercase ">
      <p class='req'>Minimum of 8 characters & must include 1 lowercase & 1 uppercase.</p>

      <br><br><br>
      <label for="confirm">Confirm Password</label>
      <input type="password" name="confirm" id ="confirm">

      <br><br><br>
      <label for="email">Sewanee E-mail</label>
      <input type="email" pattern=".+@sewanee\.edu" name="email" id ="email" placeholder="format: example@sewanee.edu">

      <br><br><br>
      <label for="year">Graduation Year</label>
      <select name="gradyr" id="year">
        <option value="2026">2026</option>
        <option value="2025">2025</option>
        <option value="2024">2024</option>
        <option value="2023">2023</option>
      </select>

      <br><br>
      <button class="submit" type="submit" onClick="CheckPassword($(submit).value)">Submit</button>

      </form>
    </div>
  </body>

</html>
_END;

?>

<script>
  $('input').focus(function() {
    $(this).css('background', '#edf5e1')
    $(this).css('color', '#163667')
  })
  $('input').blur(function() {
    $(this).css('background', 'white')
    $(this).css('color', 'black')
  })
</script>
