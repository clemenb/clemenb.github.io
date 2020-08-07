<!-- Welcome to the scripts database of HIOX INDIA      -->
<!-- This tool is developed and a copyright             -->
<!-- product of HIOX INDIA.			        -->
<!-- For more information visit http://www.hscripts.com -->

<br>
<script type="text/javascript">
	var name = new Array();
	name[0]= "<?php echo($hm2);?>/images/star2.gif";
	if(document.images)
	{
		var ss = new Image();
		ss.src = name[0];		
	}			
</script>
<?php

  $start = $_GET['begin'];
  if($start == "")
	$start = 0;
  $url = $_SERVER['SCRIPT_NAME'];
  $host = $_SERVER['SERVER_NAME'];
  $ser = "http://$host";	
  $url1 = $_SERVER['argv'];
  $sss = count($url1);
  $serpath = $ser.$url;

if($sss >= 1)
  {
     $argas = $url1[0];
     $url="$url?$argas";
  }
  $url= $ser.$url;

  include "$hm/auth/config.php";

  $link = mysql_connect($hostname, $username,$password);
  if($link)
  {
	$dbcon = mysql_select_db($dbname,$link);
  }

//averaging rating 

  $qur1 = "select count(*) as dd, avg(rateval) as xx from hsrs where url='$url' group by url";
  $result1 = mysql_query($qur1,$link);
  if($line = @mysql_fetch_array($result1, MYSQL_ASSOC))
  {
	$count = $line['dd'];
	$rateval = $line['xx'];
  }

?>

<table width=100% cellpadding=0 cellspacing=0 border=0 style="border: 1px solid green; font-family: arial, verdana, san-serif; font-size: 13px;">
   <tr align=center>
      <td>
        <form name=rate method=post action="<?php echo($hm2); ?>/addrating.php">
             <b>This Page has been currently rated as: </b>
             <?php for($i=1;$i<=5;$i++)
                     {
                   	if($rateval>=1)
                	{
		           echo "<img src=\"$hm2/images/star2.gif\">";
                           $rateval=$rateval-1;
	                }
	                else if($rateval>=0.5)
	                {
 		           echo "<img src=\"$hm2/images/star3.gif\">";
		           $rateval=$rateval-1;
	                }
 	                else if ($rateval<0.5 && $rateval>0)
	                {
		           echo "<img src=\"$hm2/images/star1.gif\">";
		           $rateval=$rateval-1;
	                }
	                else if($rateval<=0)
	                {
		           echo "<img src=\"$hm2/images/star1.gif\">";
	                }
                    }	
           ?>
     </td>
   </tr>
     <style>
       .star{cursor:pointer; }

     </style>
     <Script language=javascript>
      function selstar(val)
      {
	for(var x=1;x<=val;x++)
	{
		document['i'+x].src="<?php echo "$hm2";?>/images/star2.gif";
	}
	
      }
      function remstar(val)
      {
	for(var x=1;x<=val;x++)
	{
		document['i'+x].src="<?php echo "$hm2";?>/images/star1.gif";
	}
      }

      function setrate(val)
      {
	document.rate.rating.value=val;
	document.rate.submit();
      }
     </script>

   <tr>
      <td align=center>
            <b>Rate this Page :</b> 
            <img name=i1 class=star onmouseover="selstar(1)" onmouseout="remstar(1)" onclick="setrate(1)" src="<?php echo "$hm2";?>/images/star1.gif">
            <img name=i2 class=star onmouseover="selstar(2)" onmouseout="remstar(2)" onclick="setrate(2)" src="<?php echo "$hm2";?>/images/star1.gif">
            <img name=i3 class=star onmouseover="selstar(3)" onmouseout="remstar(3)" onclick="setrate(3)" src="<?php echo "$hm2";?>/images/star1.gif">
            <img name=i4 class=star onmouseover="selstar(4)" onmouseout="remstar(4)" onclick="setrate(4)" src="<?php echo "$hm2";?>/images/star1.gif">
            <img name=i5 class=star onmouseover="selstar(5)" onmouseout="remstar(5)" onclick="setrate(5)" src="<?php echo "$hm2";?>/images/star1.gif">
            <input type=hidden name="rating">
            </form>&nbsp;&nbsp;
        <font color='#0000ff'>
	<?php 
	 echo "[&nbsp;$count&nbsp; <span style='font-size: 12px;'>votes</span>]";
	?>
	</font>
      </td>
    </tr>

    <tr>
      <td align=right>
	 <a style="color: green; font-size: 11px; text-decoration: none; " id=dum href="http://www.hscripts.com">&copy; hscripts.com</a>
      </td>
    </tr>
</table>
<script type="text/javascript">
document.onload = ctck();
function ctck()
{
var sds = document.getElementById("dum");
if(sds == null){alert("You are using a free package.\n You are not allowed to remove the tag.\n");}
}
</script>
<!-- Welcome to the scripts database of HIOX INDIA      -->
<!-- This tool is developed and a copyright             -->
<!-- product of HIOX INDIA.			        -->
<!-- For more information visit http://www.hscripts.com -->
