<?php
class Rating {
  private $pdo = null;
  private $stmt = null;

  function __construct () {
  // __construct() : connect to the database

    try {
      $this->pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_USER, DB_PASSWORD,
        [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES => false ]
      );
      return true;
    } catch (Exception $ex) {
      print_r($ex);
      die();
    }
  }

  function __destruct () {
  // __destruct() : close connection when done

    if ($this->stmt !== null) { $this->stmt = null; }
    if ($this->pdo !== null) { $this->pdo = null; }
  }

  function save ($user, $id, $stars){
  // save() : save the rating
  // PARAM $user - user ID
  //       $id   - article or product id being rated
  //       $stars - The number odf stars

    try {
      $this->stmt = $this->pdo->prepare(
        "REPLACE INTO `star_rating` (`product_id`, `user_id`, `rating`) VALUES (?, ?, ?)"
      );
      $this->stmt->execute([$user, $id, $stars]);
    } catch (Exception $ex) {
      // die($ex->getMessage());
      return false;
    }
    return true;
  }
  
  function avg ($id){
  // avg() : get the average rating for the selected article or product
  // PARAM $id - article or product id

    $this->stmt = $this->pdo->prepare(
      "SELECT AVG(`rating`) `avg` FROM `star_rating` WHERE `product_id`=?"
    );
    $this->stmt->execute([$id]);
    $average = $this->stmt->fetchAll();
    return is_numeric($average[0]['avg']) ? $average[0]['avg'] : 0 ;
  }
}
?>