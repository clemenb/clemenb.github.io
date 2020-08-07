<?php
for ($count = 1; $count <= 5; $count ++) {
    $starRatingId = $row['id'] . '_' . $count;
    if ($count == $userRating) {
        ?>
                    <li value="<?php echo $count; ?>" id="<?php echo $starRatingId; ?>"
    class="star"><img src="./img/<?php echo $apperance . $count; ?>-filled.png"></li>
<?php 
                } else {
?>
                    <li value="<?php $count; ?>" id="<?php echo $starRatingId; ?>"
    class="star"
    onclick="addRating(this,<?php echo $row['id']; ?>,<?php echo $count; ?>);"
    onMouseOver="mouseOverRating(<?php echo $row['id']; ?>,<?php echo $count; ?>,'<?php echo $apperance; ?>');"
    onMouseLeave="mouseOutRating(<?php echo $row['id']; ?>,<?php echo $userRating; ?>,'<?php echo $apperance; ?>');"><img
    src="./img/<?php echo $apperance . $count; ?>-open.png"></li>
<?php 
                }
            }
?>