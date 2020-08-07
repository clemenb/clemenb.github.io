<?Php
require "config.php"; 
@$todo=$_POST['todo'];
if(isset($todo) and $todo=="submit-rating"){
$rating=$_POST['rating'];
$page_name=$_POST['page_name'];
$msg="";
$status="OK";
if(!isset($rating)){$msg=$msg."Pleae give your score ";
$status="NOT OK";
}				


if ($status=="OK")
{
$sql=$dbo->prepare("insert into plus2net_rating (rating,page_name) values(:rating,:page_name)");
$sql->bindParam(':rating',$rating,PDO::PARAM_INT, 1);
$sql->bindParam(':page_name',$page_name,PDO::PARAM_STR, 100);

if($sql->execute()){
$rating_id=$dbo->lastInsertId(); 
echo " Thanks ..  id = $rating_id ";
}
else{
echo " Not able to add data please contact Admin ";
}

}else {
echo $msg;
}	
}// end of todo checking
?>