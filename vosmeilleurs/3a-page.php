<?php
// (1) INIT - LOAD LIBRARY
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "2a-config.php";
require PATH_LIB . "2b-lib-rating.php";
$starLib = new Rating();

// (2) FETCH THE AVERAGE RATING
// For example, this is a product page with product id 1
$id = 1;
$avg_rating = $starLib->avg($id);

// (3) DUMMY USER SESSION
// ! Use your own system's user session !
session_start();
$_SESSION['user'] = [
  "id" => 1,
  "name" => "John Doe"
];

// (4) HTML ?>
<!DOCTYYPE html>
<html>
<head>
  <title>
    Star Rating Demo
  </title>
  <style>
  .star{
    display: inline-block;
    width: 50px;
    height: 50px;
    cursor: pointer;
    background-image: url('public/star-blank.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
  }
  .star.over{
    background-image: url('public/star.png');
  }
  </style>
  <script src="public/3b-rating.js"></script>
</head>
<body>
  <!-- [THE AVERAGE RATING] -->
  <div id="average">
    <h1>Average rating</h1>
    <?=$avg_rating?>
  </div>

  <!-- [RATING DOCKET] -->
  <?php if (is_array($_SESSION['user'])) { ?>
  <div id="rating">
    <h1>Rate this product or article</h1>
    <input type="hidden" id="rate-id" value="<?=$id?>"/>
    <?php
    for ($i=0; $i<MAX_STARS; $i++) {
      printf("<div class='star' onmouseover='rating.highlight(%u)' onclick='rating.save(%u)'></div>", $i+1, $i+1);
    }
    ?>
  </div>
  <?php } ?>
</body>
</html>