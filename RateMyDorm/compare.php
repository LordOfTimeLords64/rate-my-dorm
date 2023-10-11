<!-- Jadon Silva, Mustafa Eldmerdash, Michael Komnick
       Apr 30, 2022
       RateMyDorm Final Project
       Comparison php page to compare ratings of two dorms
-->

<?php

    require_once 'header.php';

    $utf8Query = "SET NAMES 'utf8';";
    $utf8Result = $pdo->query($utf8Query);

    $dorms = "select * from dorms;";
    $dormsData1 = $pdo->query($dorms);
    $dormsData2 = $pdo->query($dorms);
    echo "<div class='formcontainer'><h2>Compare Two Dorms:</h2>";
if(isset($_POST['dorm1']) && isset($_POST['dorm2'])) {
        $dName1 = $_POST['dorm1'];
        $dName2 = $_POST['dorm2'];}
    echo <<<_END
    <form method=post action="compare.php">
    <b>Select first dorm:</b><br><br>
    &emsp;&emsp;<select name='dorm1'><br>
_END;

    while($dorm = $dormsData1->fetch()) {
        $dName = htmlspecialchars($dorm['dname']);
        echo "<option value = \"$dName\">$dName";
    }

    echo <<<_END
    </select><br><br><br>
    <b>Select second dorm:</b><br><br>
    &emsp;&emsp;<select name='dorm2'><br>
_END;

    while($dorm = $dormsData2->fetch()) {
        $dName = htmlspecialchars($dorm['dname']);
        echo "<option value = \"$dName\">$dName";
    }

    echo <<<_END
    </select><br><br>
    <input id='submitbutton' type="submit" value="Compare">
</form>
_END;

    $dName1 = '';
    $dName2 = '';

    if(isset($_POST['dorm1']) && isset($_POST['dorm2'])) {
        $dName1 = $_POST['dorm1'];
        $dName2 = $_POST['dorm2'];

        $catQuery = "select * from reviewCat";
        $catResult = $pdo->query($catQuery);

        echo "<table class = 'comp'><tr><td>Category</td><td>$dName1 Rating</td><td>$dName2 Rating</td></tr>";

        while($cats = $catResult->fetch()) {
            $id = (int) (htmlspecialchars($cats['rcid']));
            $name = htmlspecialchars($cats['catname']);
            $desc = htmlspecialchars($cats['catdesc']);

            $rating1 = "select avg(rating) as average from reviews, reviewCat, dorms where reviews.dormid = dorms.dormid AND reviews.rcid = reviewCat.rcid And catname like \"$name\" And dname like \"$dName1\"";
            $result1 = $pdo->query($rating1);

            $rating2 = "select avg(rating) as average from reviews, reviewCat, dorms where reviews.dormid = dorms.dormid AND reviews.rcid = reviewCat.rcid And catname like \"$name\" And dname like \"$dName2\"";
            $result2 = $pdo->query($rating2);

            echo "<tr><td>$name</td><td>";
            if($data1 = $result1->fetch()) {
                $stars1 = (int) (htmlspecialchars($data1['average']));
                echo "$stars1</td><td>";
            }
            if($data2 = $result2->fetch()) {
                $stars2 = (int) (htmlspecialchars($data2['average']));
                echo "$stars2</td></tr>";
            }
        }

        echo "</table>";

    }
    echo "</div>";
?>

</body>
