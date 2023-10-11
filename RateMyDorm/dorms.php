<!-- Jadon Silva, Mustafa Eldmerdash, Michael Komnick
       Apr 30, 2022
       RateMyDorm Final Project
       PHP page to list all dorms and overall ratings and descriptions
-->

<script src='jquery-3.6.0.min.js'></script>
<head>
    <title>
        Rate My Dorm
    </title>
    <meta name="viewport" content="user-scalable=no, width=device-width" >
    <link rel="stylesheet" href="mobileStyle.css" media="only screen and (max-width: 650px)">
    <link rel="stylesheet" href="style.css" media="screen and (min-width: 651px)">
</head>

<body>

<?php

    require_once 'header.php';

    $utf8Query = "SET NAMES 'utf8';";
    $utf8Result = $pdo->query($utf8Query);

    echo "\n\t<form method = post action = \"dorms.php\" class= 'filterbox'>\n\t\t<b>Filter by:</b>\n\t\t<select name = 'filter'>\n\t\t<option value = 'Overall'>Overall Alphabetical</option>";

    $catQuery = "SELECT * FROM reviewCat";
    $catResult = $pdo->query($catQuery);

    while ($row = $catResult->fetch()) {
        $cat = htmlspecialchars($row['catname']);
        echo "\n\t\t\t<option value = \"$cat\">$cat</option>";
    }
    
    echo "\n\t\t</select>\n\t\t<input type=\"submit\" value=\"Submit\" id='submitbutton'>\n\t</form>\n\n\t<table class = \"dorms\"><tr>";

    $catName = '';

    if(isset($_POST['filter'])) {
        $catName = $_POST['filter'];
    } else {
        $catName = 'Overall';
    }

    if($catName != 'Overall') {
        $dormQuery = "select dname, avg(rating) as average from reviews, reviewCat, dorms where reviews.dormid = dorms.dormid and reviews.rcid = reviewCat.rcid and reviewCat.catname like '$catName' group by dname order by average desc;";
    } else {
        $dormQuery = "select * from dorms;";
    }
        
    $dormResult = $pdo->query($dormQuery);

    $n = 0;

    while($dorm = $dormResult->fetch()) {


        $dName = htmlspecialchars($dorm['dname']);
        $dDesc = '';
        $rating = 0;

        if($catName == 'Overall') {

            $dDesc = htmlspecialchars($dorm['dormdesc']);
            $ratingQuery = "select avg(rating) as average from reviews, reviewCat, dorms where reviews.dormid = dorms.dormid AND reviews.rcid = reviewCat.rcid And dname like \"$dName\"";
            $ratingResult = $pdo->query($ratingQuery);

            while($ratingData = $ratingResult->fetch()) {
                $rating = (int)  (htmlspecialchars($ratingData['average']));
            }

        } else {

            $descQuery = "select dormdesc from dorms where dname like \"$dName\"";
            $descResult = $pdo->query($descQuery);

            if($dormData = $descResult->fetch()) {
                $dDesc = htmlspecialchars($dormData['dormdesc']);
            }

            $rating = (int)  (htmlspecialchars($dorm['average']));

        }

        if($n % 2 == 0 && $n != 0) echo "\n\t</tr>\n\t<tr>";

        echo "\n\t\t<td class=\"dorm\" class='break'>\n\t\t\t<h2>\n\t\t\t\t$dName\n\t\t\t</h2>\n\t\t\t<img class=\"dimg\" src=\"DormIMGs/$dName.jpeg\" alt=\"Picture of $dName Hall\">\n\t\t\t<p>\n\t\t\t\t$catName: $rating/5\n\t\t\t<br>\n\t\t\t\t";

        for($i = 1; $i <= $rating; $i++) {

            echo "⭐️";

        }

        echo "\n\t\t\t</p>\n\t\t\t<p class = 'desc'>\n\t\t\t\t$dDesc\n\t\t\t</p>\n\t\t</td>";

        $n++;

    }

    if($n %2 == 1) echo "\n\t</tr>";

    echo "\n</table>";

?>

<script>
    $('.dorm').hover(function() {
        $(this).css('background', 'rgba(230, 230, 230, .8)')
    }, function() {
        $(this).css('background', 'white')
    })
    $('.dorm').click(function() {
        var name = $(this).children('h2').text();
        window.location.href = name + ".php"
    })

    var width = $(window).width();
</script>

</body>
