<!-- Jadon Silva, Mustafa Eldmerdash, Michael Komnick
       Apr 30, 2022
       RateMyDorm Final Project
       Humphreys specific php page
-->

<?php

    require_once 'header.php';

    $utf8Query = "SET NAMES 'utf8';";
    $utf8Result = $pdo->query($utf8Query);

    $path = $_SERVER['SCRIPT_NAME'];

    $dName = basename($path, ".php");

    echo "<h1 class = 'rat'>$dName</h1>";

    echo "<img src = \"DormIMGs/$dName.jpeg\" class = 'singleimg'>";


    if($loggedin) {

        $usrID = '';
        $getID = "select usrid from users where usrname like '$usrname'";
        $selectID = $pdo->query($getID);
        if($usr = $selectID->fetch()) {
            $usrID = (int) (htmlspecialchars($usr['usrid']));
        }

        $date = date("Y-m-d");

        if(isset($_POST['answer']) && $_POST['answer'] != '' && isset($_POST['qid'])) {

            $qID = $_POST['qid'];

            $answ = sanitizeString($_POST['answer']);
            $answer = "INSERT INTO answers (usrid, qid, answ, adate) VALUES ('$usrID', '$qID', '$answ', '$date')";
            $insertAnswer = $pdo->query($answer);

        }

        if(isset($_POST['question'])) {
            $dormIDQ = "select dormid from dorms where dname like '$dName'";
            $dormIDR = $pdo->query($dormIDQ);
            if($dorm = $dormIDR->fetch()) $dormID = $dorm['dormid'];
            $quest = sanitizeString($_POST['question']);
            $question = "INSERT INTO questions (usrid, dormid, quest, qdate) VALUES ('$usrID', '$dormID', '$quest', '$date')";
            $insertQuestion = $pdo->query($question);
        }

    }

    $revQuery = "select rating, catname, usrname, comments, revdate from reviews, reviewCat, dorms, users where reviews.dormid = dorms.dormid AND reviews.rcid = reviewCat.rcid And reviews.usrid = users.usrid And dname like \"$dName\" order by usrname";
    $revResult = $pdo->query($revQuery);

    $lastUser = '';

    echo "\n\t<h2 class = 'rat'>Reviews:</h1>\n\t<table class = 'rat'>";

    while($review = $revResult->fetch()) {
        $rating = (int) (htmlspecialchars($review['rating']));
        $cat = htmlspecialchars($review['catname']);
        $user = htmlspecialchars($review['usrname']);
        $comment = htmlspecialchars($review['comments']);
        $date = htmlspecialchars($review['revdate']);

        if($user != $lastUser) {
            if($lastUser !== '') echo "\n\t\t</td></tr>";
            echo "\n\t\t<tr><td class = 'rat'><h3>$user:</h3>";
        }

        echo "\n\t\t<p style = 'text-align: left;'><b>$cat: $rating/5</b></p><p>\"$comment\" - $date</p>";

        $lastUser = $user;
    }

    echo "\n\t</td></tr>\n\t</table>";

    $qQuery = "select usrname, quest, qdate, qid from questions, users, dorms where questions.usrid = users.usrid and dorms.dormid = questions.dormid and dname like \"$dName\" order by qdate desc";
    $qResult = $pdo->query($qQuery);

    if($loggedin) {
        echo "\n\t<h2 class = 'rat'>Questions & Answers:</h1>\n\t<table class = 'rat'>\n\t\t<tr><td class='rat'><form method='post' action='$dName.php'><p><b>Have a question about $dName? Ask here:</b></p><br>\n\t\t\t<input type = 'text' maxlength = '1024' name = 'question' required><br><br>\n\t\t\t<button type='submit'>Submit</button></form></td></tr>";
    } else {
        echo "\n\t<h2 class = 'rat'>Questions & Answers:</h1>\n\t<table class = 'rat'>\n\t\t<tr><td class='rat'><p><b>Have a question about $dName? Sign in <a href='signin.php'>here</a> or register <a href='signup.php'>here</a> to ask questions on each dorm page.</b></p></td></tr>";
    }
    

    while($qData = $qResult->fetch()) {
        $user = htmlspecialchars($qData['usrname']);
        $q = htmlspecialchars($qData['quest']);
        $date = htmlspecialchars($qData['qdate']);
        $qid = (int) (htmlspecialchars($qData['qid']));

        echo "\n\t\t<tr><td class = 'rat'>\n\t\t\t<p style = 'text-align: left;'><b>Question:</b></p>\n\t\t\t<p>$q</p>\n\t\t\t<p style = 'text-align: right;'>- $user on $date</p>";

        if($loggedin) {
            echo "\n\n\t\t\t\t<form method='post' action='$dName.php'>\n\t\t\t\t\t<label for=\"answ\">Answer The Queston: </label>\n\t\t\t\t\t<input type=\"text\" name=\"answer\" id =\"answ\" maxlength = '1024' required>\n\t\t\t\t\t<input type = 'hidden' name = 'qid' value = '$qid'><br><br>\n\t\t\t\t\t<button type=\"submit\">Submit</button>\n\t\t\t\t</form>";
        }

        $aQuery = "select usrname, answ, adate from answers, users where answers.usrid = users.usrid and qid = $qid order by adate desc";
        $aResult = $pdo->query($aQuery);

        while($aData = $aResult->fetch()) {
            $user = htmlspecialchars($aData['usrname']);
            $answer = htmlspecialchars($aData['answ']);
            $date = htmlspecialchars($aData['adate']);

            echo "\n\t\t\t<p style = 'text-align: left;'><b>Answer:</b></p>\n\t\t\t<p>\"$answer\"</p>\n\t\t\t<p style = 'text-align: right;'>- $user on $date</p>";
        }

        echo "\n\t\t</td></tr>";

    }

    echo "\n\t</table><br><br>";

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

</body>
