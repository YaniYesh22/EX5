<?php
//create a mySQL DB connection:
include "config.php";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
//testing connection success
if (mysqli_connect_errno()) {
    die("DB connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
}
$bookId = $_GET["id"];
$query = "SELECT * FROM tbl_33_books WHERE id = $bookId";
$result = mysqli_query($connection, $query);
if ($result) {
    $row = mysqli_fetch_assoc($result); //there is only 1 with id=X
} else die("DB query failed.");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php
    echo ' <h1 class="title" >Book name: "' . $row["book_name"] . '"  Category : "' . $row["category"] . '" </h1>';
    ?>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <section class="hero-section">
        <div class="card-grid">
            <?php
            $img = $row["img_url"];
            $author_img = $row["author_img"];
            //output data from each row
            echo '<a class="card" href="book_page.php?id=' . $row["id"] . '">';
            echo    '<div class="card__background" style="background-image:url(' . $img . ')">';
            echo    '</div>';
            echo    '<div class="card__content">';
            echo        '<p class="card__category">Category: ' . $row["category"] . '</p>';
            echo        '<h3 class="card__heading">' . $row["book_name"] . '</h3>';
            echo    '</div>';
            echo '</a>';
            echo '<a class="card" href="book_page.php?id=' . $row["id"] . '">';
            echo    '<div class="card__background" style="background-image:url(' . $author_img . ')">';
            echo    '</div>';
            echo    '<div class="card__content">';
            echo        '<p class="card__category">Category: ' . $row["category"] . '</p>';
            echo        '<h3 class="card__heading">Author: ' . $row["author"] . '</h3>';
            echo    '</div>';
            echo '</a>';
            ?>
            <?php
            //release returned data
            mysqli_free_result($result);
            ?>
        </div>
    </section>
</body>
</html>