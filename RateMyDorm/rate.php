<!-- Jadon Silva, Mustafa Eldmerdash, Michael Komnick
       Apr 30, 2022
       RateMyDorm Final Project
       PHP page that acts as a form to rate dorms if you are logged in
-->

<?php

	require_once 'header.php';

	if($loggedin) {

		$catQuery = "select * from reviewCat order by rcid";
    	$catResult = $pdo->query($catQuery);

    	echo "\n<br><br><table class='rev'>\n\t<form method='post' action = 'rate.php'>\n\t\t<tr><td colspan = '4'><h3>Select a dorm to rate:</h3></td></tr>\n\t\t<tr><td colspan = '4'><select name = 'dorm'>";

    	$dormQuery = "select * from dorms;";
    	$dormResult = $pdo->query($dormQuery);

    	while($dorm = $dormResult->fetch()) {
    		$dName = htmlspecialchars($dorm['dname']);
    		$dormID = $dorm['dormid'];
    		echo "\n\t\t\t<option value = '$dormID'>$dName</option>";
    	}

    	echo "\n\t</select></td></tr>";

    	while($cats = $catResult->fetch()) {
        	$id = $cats['rcid'];
        	$name = htmlspecialchars($cats['catname']);
        	$desc = htmlspecialchars($cats['catdesc']);
        	$ratingTag = 'Cat'.$id;
        	$commentTag = 'Comment'.$id;

        	echo "\n\t\t<tr><td>$name</td><td><select name = \"$ratingTag\">";
        	for($i = 1; $i <= 5; $i ++) {
            	echo "\n\t\t\t<option value = $i>$i/5</option>";
        	}
        	echo "\n\t\t</select></td><td>Comments:</td><td><input type = \"text\" name = \"$commentTag\" maxlength = '1024' required></td></tr>";
    	}

    	echo "\n\t\t<tr><td colspan = '4'><button type='submit'>Sumbit</button></td></tr>\n\t</form>\n</table>";

		if(isset($_POST['dorm'])) {

      $usrID = '';
      $getID = "select usrid from users where usrname like '$usrname'";
      $selectID = $pdo->query($getID);
      if($usr = $selectID->fetch()) {
        	$usrID = (int) (htmlspecialchars($usr['usrid']));
      }

			$dormID = (int) $_POST['dorm'];
			$date = date("Y-m-d");

			$catQ = "select * from reviewCat order by rcid";
    	$catR = $pdo->query($catQ);

			while($cat = $catR->fetch()) {

        	$catID = $cat['rcid'];
        	$name = htmlspecialchars($cat['catname']);
        	$ratingTag = 'Cat'.$catID;
        	$commentTag = 'Comment'.$catID;

        	$rating = sanitizeString($_POST[$ratingTag]);
    			$comment = sanitizeString($_POST[$commentTag]);

    			$review = "INSERT INTO reviews (usrid, dormid, rcid, rating, comments, revdate) VALUES (\"$usrID\", \"$dormID\", \"$catID\", \"$rating\", \"$comment\", \"$date\")";
    			$insertRev = $pdo->query($review);

    		}
			
		}

	} else {
		echo "<h1>Please login <a href='signin.php'>here</a> or sign up <a href='signup.php'>here</a> to rate dorms.</h1>";
	}

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