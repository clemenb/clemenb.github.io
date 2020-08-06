 

<?php

if($_POST["message"]) {

mail("info@vosmeilleurs.com", "Notify me",

$_POST["Please notify me"]. "From: an@email.address");

}

?>


<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=windows-1252">
    <link rel="alternate stylesheet" type="text/css" href="resource://gre-resources/plaintext.css"

      title="emailform">
  </head>
  <body>
    <pre></pre>
    <br>
    <form method="post" action="emailForm.php">
      test
      <input type="submit">
    </form>
  </body>
</html>
