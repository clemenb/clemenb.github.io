<?php
       // from the form
       $name = trim(strip_tags($_POST['name']));
       $email = trim(strip_tags($_POST['email']));
       $message = htmlentities($_POST['message']);

       // set here
       $subject = "Contact form submitted!";
       $to = 'info@vosmeilleurs.com';

       $body = <<<HTML
$message
HTML;

       $headers = "From: $email\r\n";
       $headers .= "Content-type: text/html\r\n";

       // send the email
       mail($to, $subject, $body, $headers);

       // redirect afterwords, if needed
       header('Location: thanks.html');
?>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=windows-1252">
  </head>
  <body>
    <form action="" method="post"> <label for="name">Name:</label> <input name="name"

        id="name" type="text"> <label for="Email">Email:</label> <input name="email"

        id="email" type="text"> <label for="Message">Message:</label><br>
      <textarea name="message" rows="20" cols="20" id="message"></textarea> <input

name="submit" value="Submit" type="submit">
    </form>
    
  </body>
</html>
