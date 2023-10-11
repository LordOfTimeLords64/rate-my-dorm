<!-- Jadon Silva, Mustafa Eldmerdash, Michael Komnick
       Apr 30, 2022
       RateMyDorm Final Project
       PHP page to show your reviews, answers, and questions
-->

<?php

    require_once 'header.php';

    if($loggedin) {

        $usrID = '';
        $getID = "select usrid from users where usrname like '$usrname'";
        $selectID = $pdo->query($getID);
        if($usr = $selectID->fetch()) {
            $usrID = (int) (htmlspecialchars($usr['usrid']));
        }

        $myRevs = "select  * from reviews, reviewCat, users, dorms where users.usrid = reviews.usrid AND reviews.rcid = reviewCat.rcid AND dorms.dormid = reviews.dormid AND users.usrid = $usrID order by reviews.dormid asc";
        $revs = $pdo->query($myRevs);

        echo "\n\t<h2 class = 'rat'>My Reviews:</h1>\n\t<table class = 'rat'>";

        while($rev = $revs->fetch()) {
            $rating = (int) (htmlspecialchars($rev['rating']));
            $cat = htmlspecialchars($rev['catname']);
            $dorm = htmlspecialchars($rev['dname']);
            $comment = htmlspecialchars($rev['comments']);
            $date = htmlspecialchars($rev['revdate']);

            if($dorm != $lastDorm) {
                if($lastDorm !== '') echo "\n\t\t</td></tr>";
                echo "\n\t\t<tr><td class = 'rat'><h3>$dorm:</h3>";
            }

            echo "\n\t\t<p style = 'text-align: left;'><b>$cat: $rating/5</b></p><p>\"$comment\" - $date</p>";

            $lastDorm = $dorm;
        }

        echo "\n\t</td></tr>\n\t</table>";

        $qQuery = "select usrname, quest, qdate, dname, qid from questions, users, dorms where questions.usrid = users.usrid and dorms.dormid = questions.dormid and users.usrid = $usrID order by qdate desc";
        $qResult = $pdo->query($qQuery);

        echo "\n\t<h2 class = 'rat'>My Questions:</h1>\n\t<table class = 'rat'>";
    

        while($qData = $qResult->fetch()) {
            $q = htmlspecialchars($qData['quest']);
            $date = htmlspecialchars($qData['qdate']);
            $qid = (int) (htmlspecialchars($qData['qid']));
            $dorm = htmlspecialchars($qData['dname']);

            echo "\n\t\t<tr><td class = 'rat'>\n\t\t\t<p style = 'text-align: left;'><b>Question About $dorm:</b></p>\n\t\t\t<p>$q</p>\n\t\t\t<p style = 'text-align: right;'>- $date</p>";

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

        echo "\n\t<h2 class = 'rat'>My Answers:</h1>\n\t<table class = 'rat'>";

        $answers = "select *, questions.usrid as qusr from answers, questions, users, dorms where answers.usrid = users.usrid and dorms.dormid = questions.dormid and answers.qid = questions.qid and users.usrid = $usrID order by adate desc";
        $getAnswers = $pdo->query($answers);

        while($answer = $getAnswers->fetch()) {
            $ans = htmlspecialchars($answer['answ']);
            $adate = htmlspecialchars($answer['adate']);
            $qdate = htmlspecialchars($answer['qdate']);
            $quest = htmlspecialchars($answer['quest']);
            $qusrid = $answer['qusr'];
            $quser = "select usrname from users where usrid = $qusrid";
            $quserR = $pdo->query($quser);
            if($questioner = $quserR->fetch()) $quserN = $questioner['usrname'];

            echo "\n\t\t<tr><td class = 'rat'>\n\t\t\t<p style = 'text-align: left;'><b>Question:</b></p>\n\t\t\t<p>$quest</p>\n\t\t\t<p style = 'text-align: right;'>- $quserN on $qdate</p>";
            echo "\n\t\t\t<p style = 'text-align: left;'><b>Answer:</b></p>\n\t\t\t<p>\"$ans\"</p>\n\t\t\t<p style = 'text-align: right;'>- $usrname on $adate</p>\n\t\t</td></tr>";

        }
        echo "\n\t</table><br><br>";

    } else {
        echo "<h1>Please login <a href='signin.php'>here</a> or sign up <a href='signup.php'>here</a> to view your profile.</h1>";
    }

?>