// JavaScript Document

// function to use on most requests
function load_ratings(url_to_load,target_div,do_on_load){
	// show loading
	document.getElementById(target_div).innerHTML= 'loading...';
	
	var xmlhttp;
	if (window.XMLHttpRequest){
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById(target_div).innerHTML=xmlhttp.responseText;
			eval(do_on_load);
		}
	}
	xmlhttp.open("GET",url_to_load,true);
	xmlhttp.send();
}



// get the path to this script and then ratings folder
function getActiveScript(){
    var t = document.getElementsByTagName("script");
	return t[ t.length - 1 ];
}
js_url = getActiveScript().src;

// ratings_url = document.URL;
ratings_url = js_url;
last_url_slash = ratings_url.lastIndexOf('/');

if(typeof(ratings_path)=="undefined"){
	var ratings_path=new Array()
}
ratings_path[rating_id] = ratings_url.slice(0,(last_url_slash+1));






function rollover_stars(rating_id, star_id, max_stars, star_image_rollover, star_image_disabled, rollover_text){
	for(star_counter=1; star_counter<=max_stars; star_counter=star_counter+1){
		if(star_counter<=star_id){
			document.getElementById("star_"+rating_id+'_'+star_counter).src = ratings_path[rating_id]+star_image_rollover;
		} else {
			document.getElementById("star_"+rating_id+'_'+star_counter).src = ratings_path[rating_id]+star_image_disabled;
		}
	}
	document.getElementById('tnt_ratings_'+rating_id+'_message_2').innerHTML = rollover_text;
}

function rollout_stars(rating_id, max_stars, score, int_score, star_image, star_image_half, star_image_disabled, rollout_text){
	for(star_counter=1; star_counter<=max_stars; star_counter=star_counter+1){
		if(star_counter<=int_score){
			// show full or half star if score is smaller than integer score
			if(star_counter==Math.ceil(score) && score<int_score){
				document.getElementById("star_"+rating_id+'_'+star_counter).src = ratings_path[rating_id]+star_image_half;
			} else {
				document.getElementById("star_"+rating_id+'_'+star_counter).src = ratings_path[rating_id]+star_image;
			}
		} else {
			document.getElementById("star_"+rating_id+'_'+star_counter).src = ratings_path[rating_id]+star_image_disabled;
		}
	}
	document.getElementById('tnt_ratings_'+rating_id+'_message_2').innerHTML = rollout_text;
}


read_only_query_string = '';
if(typeof(rating_read_only) != "undefined"){
	if(rating_read_only == true){
		read_only_query_string = '&rating_read_only=true';
	}
}




current_timestamp = Math.round(new Date().getTime() / 1000);


function post_vote(rating_id, posted_vote, key){
	// post a vote / reload page
	load_ratings(ratings_path[rating_id]+'tnt_ratings.php?rating_id='+rating_id+"&cmd=post_vote&posted_vote="+posted_vote+"&key="+key+read_only_query_string+"&"+current_timestamp,'tnt_ratings_'+rating_id);
}


// load the css file once
if (!document.getElementById('tnt_ratings_css')){
    var head  = document.getElementsByTagName('head')[0];
    var link  = document.createElement('link');
    link.id   = 'tnt_ratings_css';
    link.rel  = 'stylesheet';
    link.type = 'text/css';
    link.href = ratings_path[rating_id]+'style.css';
    link.media = 'all';
    head.appendChild(link);
}



// write this id unless it already exists on same page
if (!document.getElementById('tnt_ratings_'+rating_id)) {
	document.write('<span class="tnt_ratings" id="tnt_ratings_'+rating_id+'"></span>');
	// load the ratings file
	load_ratings(ratings_path[rating_id]+'tnt_ratings.php?rating_id='+rating_id+'&'+read_only_query_string+"&"+current_timestamp,'tnt_ratings_'+rating_id);
} else {
	document.write('<span class="tnt_ratings" style="color:#CC0000">ERROR: rating_id <em>'+rating_id+'</em> already exist on same page, use different ID for each rating instance</span>');
}

// reset this rating_read_only variable because next one might not have this rating_read_only enbabled
rating_read_only = false;