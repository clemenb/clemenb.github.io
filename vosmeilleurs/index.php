<html>
  <head>
  </head>
  <body>' . "\r\n";
    $headers .= 'Cc: info@vosmeilleurs.com ' . "\r\n";
    // Send email
    if(mail($to,$subject,$htmlContent,$headers))
    {
    echo 'Email has sent successfully.';
    }
    else{
    echo 'Some problem occurred, please try again.';
    }
    }
    ?&gt;
    <form method="post">
      <table align="center" border="1">
        <tbody>
          <tr>
            <td>Enter Your Email</td>
            <td><input name="email" type="text"></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input name="submit" value="Send Email"

type="submit"> </td>
          </tr>
        </tbody>
      </table>
      
      <table>
      </table>
    </form>
  </body>
</html>
