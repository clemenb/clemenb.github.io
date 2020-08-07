<!doctype html public "-//w3c//dtd html 3.2//en">

<html>

<head>
<title>(Type a title for your page here)</title>
</head>

<body>

This is a test page only to display rating buttons at the end of this page.

<br><br><br>
<?
require "config.php"; 
$page_name=$_GET['page_name'];

$sql="select rating_id,rating, page_name from plus2net_rating where page_name='$page_name'"; 



echo "<table>";
echo "<tr><th>ID</th><th>Page Name</th><th>ratings</th></tr>";
foreach ($dbo->query($sql) as $row) {
echo "<tr ><td>$row[rating_id]</td><td>$row[page_name]</td><td>$row[rating]</td></tr>";
}
echo "</table>";

?>
</body>

</html>
