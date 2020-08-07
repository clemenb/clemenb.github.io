<?Php
echo "<br><br><div id='rating-box' style=\"text-align:center;border:1px solid red;width:550px;\">Please  rate this Article on one to five scale<br>";
echo "<input type=hidden id=page_name name=page_name value='$page_name'> 
<INPUT TYPE=RADIO NAME=rone Value=1 onClick='ajax_rating_Function(1)';><img src=images/star.gif> <INPUT TYPE=RADIO NAME=rone Value=2 onClick='ajax_rating_Function(2)';><img src=images/star.gif><img src=images/star.gif> <INPUT TYPE=RADIO NAME=rone Value=3 onClick='ajax_rating_Function(3)';><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif> <INPUT TYPE=RADIO NAME=rone Value=4 onClick='ajax_rating_Function(4)';><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif> <INPUT TYPE=RADIO NAME=rone Value=5 onClick='ajax_rating_Function(5)';><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif><img src=images/star.gif>";
echo" </div>";
?>