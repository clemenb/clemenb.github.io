<?php
namespace Phppot;

use Phppot\Rating;
require_once "./Common/Config.php";
$config = new Config();
require_once "./Model/Rating.php";
$rating = new Rating();
// Here the user id is harcoded.
// You can integrate your authentication code here to get the logged in user id
$userId = 5;

$apperance = $config::RATING_APPEARANCE;

$courseResult = $rating->getCourse();
if (! empty($courseResult)) {
    foreach ($courseResult as $row) {
        $userRating = $rating->getUserRating($userId, $row['id']);
        $totalRating = $rating->getTotalRating($row['id']);
        $date = date_create($row["last_date_to_register"]);
        ?>
<div class="row-item">
    <div class="row-title"><?php echo $row['name']; ?></div>
    <ul class="list-inline" id="list-<?php echo $row['id']; ?>">
 <?php require $apperance . "-rating-view.php"; ?>

        <img src="img/loader.gif" class="loader-icon" id="loader-icon">
    </ul>
    <div class="response" id="response-<?php echo $row['id']; ?>"></div>


    <p class="review-note">Total Reviews: <?php echo $totalRating; ?></p>
    <p class="text-address">
        <label class="course-detail">Period: <?php echo $row["period"]; ?></label><label
            class="course-detail">Available seats: <?php echo $row["availabe_seats"]; ?></label><label
            class="course-detail">Last Date to Register: <?php echo date_format($date, "d M Y"); ?></label>
    </p>
</div>
<?php
    }
}
?>