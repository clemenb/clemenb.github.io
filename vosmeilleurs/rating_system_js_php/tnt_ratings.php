<?php

// if you want to use a database to save data instead of plain file on server, then change this value (true/false)
// NOTE: table structure would be created automatically
$use_database = false;
$ratings_db_hostname = "localhost";		// database host, usually "localhost"
$ratings_db_name = "ratings_test";		// database name
$ratings_db_user = "ratings";			// database login username
$ratings_db_password = "12345";			// database login passowrd
$ratings_db_table = 'ratings';			// database table name


// total number of available stars (usually 5 or 10)
$max_stars = 10;

// the path to star image files; path relative to this PHP file
$star_image = "images/star.png";
$star_image_half = "images/star_half.png";
$star_image_rollover = "images/star_blue.png";
$star_image_disabled = "images/star_grey.png";

// the time to wait (in seconds) before the same user can vote again; 60*60*24*360 is a year of seconds ;)
$seconds_between_votes = (60*60*24*360);

// the words that appear when mouse is over a star, define 5 messages for 5 stars, 10 messages if you use 10 stars
$lang_rating_tooltip[0] = "Not rated";
$lang_rating_tooltip[1] = "Awful";
$lang_rating_tooltip[2] = "Very bad";
$lang_rating_tooltip[3] = "Bad";
$lang_rating_tooltip[4] = "Not good";
$lang_rating_tooltip[5] = "Average";
$lang_rating_tooltip[6] = "OK";
$lang_rating_tooltip[7] = "Nice";
$lang_rating_tooltip[8] = "Good";
$lang_rating_tooltip[9] = "Very good";
$lang_rating_tooltip[10] = "Outstanding";


// this message will say "rated 7 out of 10" or "40 votes", etc. Use these variables: %total_votes%, %score%, %int_score%, %max_stars%, %score_tooltip%
$lang_votes_info = "Rated %score% (%total_votes% votes). %score_tooltip%.";

// translations area, you can change this text to fit your language
$lang_click_to_vote = "Click stars to vote";
// shown when you return to page after a while
$lang_you_voted = "You voted"; 
// shown when you attempted to vote twice
$lang_you_already_voted = "You already voted"; 
// showen right after saving vote
$lang_thanks_for_voting = "Thank you";
// on some of your pages you can display votes without ability to vote, that is done in javascript by setting an option: readonly_ratings = true;
// this next message will be displayed instead of "click to rate".
$lang_read_only_mode = "Please login to vote";

// -------------------------------------------------------
// END of user settings area, do not edit after this line
// -------------------------------------------------------





if (!function_exists("GetSQLValueString")) {
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = ""){
	  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
	  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
	
	  switch ($theType) {
		case "text":
		  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
		  break;    
		case "long":
		case "int":
		  $theValue = ($theValue != "") ? intval($theValue) : "NULL";
		  break;
		case "double":
		  $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
		  break;
		case "date":
		  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
		  break;
		case "defined":
		  $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
		  break;
	  }
	  return $theValue;
	}
}


if($use_database){
	// connection string, do not edit this
	$ratings_db_connect = mysql_pconnect($ratings_db_hostname, $ratings_db_user, $ratings_db_password) or trigger_error(mysql_error(),E_USER_ERROR); 
	
	// create table structure
	mysql_select_db($ratings_db_name, $ratings_db_connect);
	$query_create_table = "CREATE TABLE IF NOT EXISTS $ratings_db_table (
										rating_id varchar(256) NOT NULL,
										rating_ip varchar(128) NOT NULL,
										rating_score bigint(20) NOT NULL,
										rating_date bigint(20) NOT NULL
										) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
	mysql_query($query_create_table, $ratings_db_connect) or die(mysql_error());
}


// get the URL path to this script, we will use this in images path
$document_url = $_SERVER['REQUEST_URI'];
$last_slash_in_url = strrpos($document_url,"/");
$document_path = substr($document_url,0,($last_slash_in_url+1));


if(!isset($_GET['rating_id']) or $_GET['rating_id']==''){
	echo 'ERROR: No rating id received';
	exit;
} else {
	$rating_id = strip_tags($_GET['rating_id']);
	$rating_id = trim($rating_id);
	$rating_id = str_replace(" ","_",$rating_id);
}



// -----------------------
// reading votes
// -----------------------
$score = 0;
$int_score = 0;
$score_sum = 0;
$total_votes = 0;
$user_vote_found = false;



if(!$use_database){
	$data_folder = "data/";
	$data_file = $data_folder.$rating_id.".dat";
	$file_contents = '';
	if(file_exists($data_file)){
		$file_contents = file_get_contents($data_file);
	}
	$file_lines = explode("\n",$file_contents);
	foreach($file_lines as $line){
		// remove any chars from margins, new line, etc, it appeared to have some junk data attached to last element
		$line = trim($line);
		list($vote_timestamp, $vote_score, $vote_ip) = explode ("|",$line);
		if(isset($vote_timestamp) and isset($vote_score) and isset($vote_ip) and $vote_timestamp!='' and $vote_score!='' and $vote_ip!=''){
			$total_votes++;
			$score_sum+=$vote_score;
			// if user ip is found and time is shorter than time allowed between votes, then user_vote_found;
			if($vote_ip == $_SERVER['REMOTE_ADDR'] and $vote_timestamp>=(time()-$seconds_between_votes)){
				$user_vote_found = true;
			}
		} 
	}
}


if($use_database){
	
	// read votes from database
	mysql_select_db($ratings_db_name, $ratings_db_connect);
	$query_Recordset_votes = sprintf("SELECT * FROM $ratings_db_table WHERE rating_id = %s", 
										  GetSQLValueString($rating_id, "text"));
	$Recordset_votes = mysql_query($query_Recordset_votes, $ratings_db_connect) or die(mysql_error());
	$row_Recordset_votes = mysql_fetch_assoc($Recordset_votes);
	$totalRows_Recordset_votes = mysql_num_rows($Recordset_votes);
	
	if($totalRows_Recordset_votes>0){
		do{
			$total_votes++;
			$score_sum+=$row_Recordset_votes['rating_score'];
			// if user ip is found and time is shorter than time allowed between votes, then user_vote_found;
			if($row_Recordset_votes['rating_ip'] == $_SERVER['REMOTE_ADDR'] and $row_Recordset_votes['rating_date']>=(time()-$seconds_between_votes)){
				$user_vote_found = true;
			}
		} while ($row_Recordset_votes = mysql_fetch_assoc($Recordset_votes));
	}
}


// if cookie found then user_vote_found; store vote timestamp in it to ignore cookie in case webmaster decreases seconds_between_votes
if($_COOKIE['tnt_rating_'.$rating_id]>=(time()-$seconds_between_votes)){
	$user_vote_found = true;
}
// <<< END OF READING VOTES. average and totals is calculated after a new possible vote is saved (below)


$read_only_mode = false;
if($_GET['rating_read_only']=="true"){
	$read_only_mode = true;
}


// set these variables here before saving vote, that next part could replace this with "you already voted" message
if($user_vote_found){
	$rating_message_2 = $lang_you_voted;
} else {
	$rating_message_2 = $lang_click_to_vote;
}



// ------------------
// writing a vote 
// ------------------
if($_GET['cmd']=="post_vote" and isset($_GET['posted_vote']) and $_GET['posted_vote']!='' and $_GET['key']==md5($_SERVER['REMOTE_ADDR'].'zxc'.$rating_id)){
	// we convert the clicked star into a percent, 
	// using percents will allow webmaster to switch from 5 stars to 10 stars any time, even after votes exist
	$posted_vote = round($_GET['posted_vote']);
	$posted_vote = round($posted_vote*100/$max_stars);
	//
	if(!$user_vote_found){
		
		if(!$use_database){
			// save vote by plain file
			// we have total votes and score_sum from previous read, now we just add this vote and recalculate average without re-reading the data file
			$content_to_save = time()."|".$posted_vote."|".$_SERVER['REMOTE_ADDR']."\n";
			if(!is_writable($data_folder)){
				echo '<span style="color:#F00;">Error ! Please make FOLDER writable:<br />'.$data_folder.'</span>'; 
				exit;
			}
			if(file_exists($data_file) and !is_writable($data_file)){
				echo '<span style="color:#F00;">Error ! Please make FILE writable:<br />'.$data_file.'</span>'; 
				exit;
			}
			
			if(!@file_put_contents($data_file,$content_to_save.$file_contents)){
				// on some windows machines it passes by the !is_writable above, windows machines stop by this^ test
				echo '<span style="color:#F00;">Error ! Cannot write data, first make sure folder <strong>'.$data_folder.'</strong> is writable; then only if needed make file <strong>'.$data_file.'</strong> writable</span>'; 
				exit;
			}
			
		}
		
		if($use_database){
			// save vote by database
			$insertSQL = sprintf("INSERT INTO $ratings_db_table (rating_id, rating_ip, rating_score, rating_date) VALUES (%s, %s, %s, %s)",
												GetSQLValueString($rating_id, "text"),
												GetSQLValueString($_SERVER['REMOTE_ADDR'], "text"),
												GetSQLValueString($posted_vote, "text"),
												GetSQLValueString(time(), "text"));
			mysql_select_db($ratings_db_name, $ratings_db_connect);
			$Result_rating_insert = mysql_query($insertSQL, $ratings_db_connect) or die(mysql_error());
		}
		
		$total_votes++;
		$score_sum+=$posted_vote;
		// set cookie
		$current_domain = $_SERVER['HTTP_HOST'];
		$current_domain = str_replace("www.",'',$current_domain);
		setcookie('tnt_rating_'.$rating_id,time(),time()+$seconds_between_votes,"/",".".$current_domain);
		// set user_vote_found, this might be needed
		$user_vote_found = true;
		// thanks for voting
		$rating_message_2 = $lang_thanks_for_voting;
	} else {
		// user tried to vote but already voted
		$rating_message_2 = $lang_you_already_voted;
	}
}
// <<< END of writing vote


// ------------------------------------
// calculate totals and average votes
// ------------------------------------

// avoid division by 0
$score = ceil($score_sum);
if($total_votes!=0){
	$score = $score_sum/$total_votes;
}
	
// the score at this time is a percent, convert it according to max stars
$score = number_format($score*$max_stars/100,1,'.','');	
$int_score = ceil($score);

// remove digits if they are zeros ?
if($int_score == $score){
	// $score = $int_score;
}


// set the texts to display to user
$rating_message_1 = $lang_votes_info;
// replace the variables in this message
$rating_message_1 = str_replace('%total_votes%',$total_votes,$rating_message_1);
$rating_message_1 = str_replace('%score%',$score,$rating_message_1);
$rating_message_1 = str_replace('%int_score%',$int_score,$rating_message_1);
$rating_message_1 = str_replace('%max_stars%',$max_stars,$rating_message_1);
$rating_message_1 = str_replace('%score_tooltip%',$lang_rating_tooltip[$int_score],$rating_message_1);

// replace "click to rate" by something like "please login to rate"? This is if ratings are in read-only mode.
if($read_only_mode){
	$rating_message_2 = $lang_read_only_mode;
}
?>

<span class="rating_stars">
	<?php for($star_counter=1; $star_counter<=$max_stars; $star_counter++){?>
        <?php
        // decide what star to show, based on score
        $current_star_file_name = $star_image;
		// show hald or full star 
		if($star_counter==ceil($score) and $score<$int_score){
			 $current_star_file_name = $star_image_half;
		}
        if($star_counter>$int_score){
            $current_star_file_name = $star_image_disabled;
        }
        ?>
        <img class="rating_star" id="star_<?php echo $rating_id;?>_<?php echo $star_counter;?>" src="<?php echo $document_path.$current_star_file_name;?>" alt="" width="16" height="16" <?php if(!$user_vote_found and !$read_only_mode){?> onmouseover="rollover_stars('<?php echo $rating_id;?>',<?php echo $star_counter;?>,<?php echo $max_stars;?>,'<?php echo $star_image_rollover;?>','<?php echo $star_image_disabled;?>','<?php echo addslashes($lang_rating_tooltip[$star_counter]);?>');"  onmouseout="rollout_stars('<?php echo $rating_id;?>',<?php echo $max_stars;?>, <?php echo $score;?>, <?php echo $int_score;?>, '<?php echo $star_image;?>', '<?php echo $star_image_half;?>','<?php echo $star_image_disabled;?>','<?php echo addslashes($rating_message_2);?>');" onmouseup="post_vote('<?php echo $rating_id;?>', <?php echo $star_counter;?>,'<?php echo md5($_SERVER['REMOTE_ADDR'].'zxc'.$rating_id);?>');" <?php } else { ?> style="cursor:default;" <?php }?>  />
    <?php }?>
	
	<?php // this is here as a pre-loader of rollover;?>
    <img width="0" height="0" style="visibility:hidden;" src="<?php echo $document_path.$star_image_rollover;?>"/>
	
</span>

<span class="rating_message_1"><?php echo $rating_message_1;?></span>
<span class="rating_message_2" id="tnt_ratings_<?php echo $rating_id;?>_message_2"><?php echo $rating_message_2;?></span>