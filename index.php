<?php
//create a mySQL DB connection:
include "config.php";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
//testing connection success
if (mysqli_connect_errno()) {
    die("DB connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <script src="script/script.js"></script>
    <title>Yanai's Book store</title>
</head>

<body>
    <h1 class="title">Welcome to Yanai's Book store</h1>
    <div class="select">
        <script src="script/showCat.js"></script>
        <select id="category_ch" aria-label="category_ch">
            <option value="0" selected>Select category</option>
            <option value="All">All</option>
        </select>
    </div>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <section class="hero-section">
        <div class="card-grid">
            <?php
            if (!empty($_SERVER['QUERY_STRING'])) {
                $cat = $_GET['category'];
            } else {
                $cat = 'All';
            }
            $query = "SELECT * FROM tbl_33_books";
            if ($cat != 'All') {
                $query .= " WHERE category = '$cat'";
            }
            $query .=  " ORDER BY id";
            $result = mysqli_query($connection, $query);
            if (!$result) {
                die("DB query failed.");
            }
            while ($row = mysqli_fetch_assoc($result)) { //results are in associative array. keys are cols names
                $img = $row["img_url"];
                if (!$img) $img = "images/default.jpg";
                //output data from each row
                echo '<a class="card" href="book_page.php?id=' . $row["id"] . '">';
                echo    '<div class="card__background" style="background-image:url(' . $img . ')">';
                echo    '</div>';
                echo    '<div class="card__content">';
                echo        '<p class="card__category">Category: ' . $row["category"] . '</p>';
                echo        '<h3 class="card__heading">' . $row["book_name"] . '</h3>';
                echo    '</div>';
                echo '</a>';
            }
            //release returned data
            mysqli_free_result($result);
            ?>
        </div>
    </section>
</body>

</html>