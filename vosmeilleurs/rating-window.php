<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>Rating of Article </title>
<script type="text/javascript">
function ajaxFunction_rating(r1)
{
var httpxml;
try
  {
  // Firefox, Opera 8.0+, Safari
  httpxml=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    httpxml=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      httpxml=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
function stateChanged() 
    {
    if(httpxml.readyState==4)
      {
document.getElementById("msg").innerHTML=httpxml.responseText;
//document.getElementById("msg").style.background='#f1f1f1';
document.getElementById("msg").innerHTML="Thank You, press the Close this window button";
document.getElementById("msg").style.display='inline';
self.close();
      }
    }

function getFormData(myForm) { 

var myParameters = new Array(); 
var sParam = "rating="+r1+"&page_name=" + document.getElementById("page_name").value;
sParam +="&todo=" + document.getElementById("todo").value;
return sParam;
} 



	var url="rating-window-ajax.php";
var myForm = document.forms[0]; 

var parameters=getFormData(myForm);

httpxml.onreadystatechange=stateChanged;
httpxml.open("POST", url, true)
httpxml.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
httpxml.send(parameters)  
}

</script>



</head>
<body >
<div id=msg style="position:absolute; width:500px; height:25px; 
     z-index:1; left: 10px; top: 0px; 
     background-color: #ffffff;      border: 1px none #000000">
</div>

<?Php
$page_name=$_GET['page_name'];
echo "<br><br><TABLE width=95% border=0 align=center cellpadding=0 cellspacing=0 > ";
echo "<form name=f1 action='' method=post>";
echo "<input type=hidden name=page_name id=page_name value='$page_name'>";
echo "<input type=hidden name=todo id =todo value='submit-rating'>";
echo "<tr><td ><INPUT TYPE=RADIO NAME=rone Value=1 onClick='ajaxFunction_rating(1)';><img src=images/star.gif>1</td>";
echo "<td><INPUT TYPE=RADIO NAME=rone Value=2 onClick='ajaxFunction_rating(2)';><font color=#343423><img src=images/star.gif><img src=images/star.gif>2</font></td>";

echo "<td ><INPUT TYPE=RADIO NAME=rone Value=3 onClick='ajaxFunction_rating(3)';><font color=#343432><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif>3</font></td>";

echo "<td ><INPUT TYPE=RADIO NAME=rone Value=4 onClick='ajaxFunction_rating(4)';;>";
echo "<img src=images/star.gif><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif>4</td>";

echo "<td ><INPUT TYPE=RADIO NAME=rone Value=5 onClick='ajaxFunction_rating(5)';><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif>5</td></tr>";
echo "<tr><td align=center colspan=5 bgcolor='#f1f1f1'> <br><br><INPUT TYPE=button  value='Close this Window' onClick=\"self.close();\" NAME=Vote>";
echo" </td>	</tr></form></table></center> ";

?>



</body>
</html>
