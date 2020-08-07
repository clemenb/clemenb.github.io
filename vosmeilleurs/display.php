<!doctype html public "-//w3c//dtd html 3.2//en">

<html>

<head>
<title>(Type a title for your page here)</title>
</head>

<body>

This is a test page only to display rating buttons at the end of this page.

<?Php
require "config.php"; 


//$sql="select count(rating_id) as no, FORMAT(avg(rating),1) as avg1, page_name from plus2net_rating group by page_name"; 
$sql="select count(rating_id) as no, FORMAT(avg(rating),1) as avg1, page_name from plus2net_rating group by page_name order by avg1 desc limit 0, 5"; 
echo "<table>";
echo "<tr><th>Page Name</th><th>Number of ratings</th><th>Average Rating</th></tr>";
foreach ($dbo->query($sql) as $row) {
echo "<tr ><td><a href=display-dtl.php?page_name=$row[page_name]>$row[page_name]</a></td><td>$row[no]</td><td>$row[avg1]</td></tr>";
}
echo "</table>";
?>
</body>

</html>
