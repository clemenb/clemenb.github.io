<?php
// (1) INIT - LOAD LIBRARY
require __DIR__ . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . "2a-config.php";
require PATH_LIB . "2b-lib-rating.php";
$starLib = new Rating();

// (2) DUMMY USER SESSION
// ! Use your own system's user session !
session_start();
$_SESSION['user'] = [
  "id" => 1,
  "name" => "John Doe"
];

// (3) HANDLE AJAX REQUESTS
switch ($_POST['req']) {
  /* [INVALID REQUEST] */
  default:
    echo "Invalid request";
    break;

  /* [SAVE RATING] */
  case "save":
    echo $starLib->save($_POST['product_id'], $_SESSION['user']['id'], $_POST['rating']) ? "OK" : "ERR";
    break;
}
?>