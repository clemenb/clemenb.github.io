<!-- Welcome to the scripts database of HIOX INDIA      -->
<!-- This tool is developed and a copyright             -->
<!-- product of HIOX INDIA.			        -->
<!-- For more information visit http://www.hscripts.com -->
<?php
   $type = $_POST['type'];

   require_once "auth/config.php";

   if(($hostname == "" || $dbname == "" || $username == "") || $type=="changedb")
   {
	if($type=="updatedb")
	  echo "<div align=center class=rad>Invalid Data, Please give proper values</div>";

	include "auth/inputdbname.php";
   }

?>

<head>
  <style>
     .ta{background-color: ffff44;}
     .rad{color:red; font-weight:bold; background-color: ffff44;}
  </style>
</head>


<?php

  if($type=="updatedb")
  {
	$username = $_POST['username'];
	$password = $_POST['pass'];
	$hostname = $_POST['hostname'];
	$dbname = $_POST['dbname'];

	//open config.php and write the data in to it.

	$file = "auth/config.php";
	$open = fopen($file, "w");
	fwrite($open,"<?php\n\n \$username = \"".$username."\";\n \$password = \"".$password."\";\n \$hostname = \"".$hostname."\";
		\n \$dbname = \"".$dbname."\";\n\n ?>");
	fclose($open);
  }


  if($type=="updatedb")
     include "auth/message.php";
  else if($type=="createtables")
     include "auth/create.php";
?>

<!-- Welcome to the scripts database of HIOX INDIA      -->
<!-- This tool is developed and a copyright             -->
<!-- product of HIOX INDIA.			        -->
<!-- For more information visit http://www.hscripts.com -->
