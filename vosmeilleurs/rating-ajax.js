function ajax_rating_Function(rating)
{
alert(rating);
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

document.getElementById("rating-box").innerHTML=httpxml.responseText;
document.getElementById("rating-box").style.borderColor='#00FF00 #0000FF';
document.getElementById("rating-box").style.display='inline';

      }
    }
function getFormData() { 
var page_name=document.getElementById("page_name").value;
var sParam = "page_name="+page_name+"&rating=" + rating + "&todo=submit-rating";
return sParam;
} 



	var url="rating-window-ajax.php";

var parameters=getFormData();
alert(parameters);
httpxml.onreadystatechange=stateChanged;
httpxml.open("POST", url, true)
httpxml.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
httpxml.send(parameters)  

document.getElementById("rating-box").style.background='#ffffcc';
document.getElementById("rating-box").offsetWidth='550px';
document.getElementById("rating-box").innerHTML="Data Processing ....";
document.getElementById("rating-box").style.display='inline';

}





