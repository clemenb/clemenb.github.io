

Features:
---------------

- Very easy to integrate in your site.
- Loads and posts new votes without reloading the web page.
- Can be included in any html file type like html, htm, asp, php, etc.
- It saves data automatically in a plain file on server
- It can ALSO save data to a database (you define few variables like username, password, table name).
- Easy to change stars by replacing the small images
- Easy to customize looks and colors by editing existent CSS file
- Can allow users to vote again after X seconds
- Can display half stars
- You can define labels for each star clicked: good, bad, outstanding, etc.
- Easy to translate or change the texts
- Ratings can also be displayed in read-only mode so users cannot post new votes
- You can set the total number of stars (usually 5 or 10) and can change this at any time without affecting the current vote results.



Using the script:
---------------------

Unzip the files, upload the ratings folder on your server by FTP.

Make the "data" folder writable, on most servers this means 777 permission code, while on others 755

On the pages where you want ratings to appear insert the JavaScript like this:


<script type="text/javascript">
rating_id = 'product_1';
</script>
<script type="text/javascript" src="tnt_ratings.js"></script>


Where the value of "rating_id" is an unique item to be rated (article_20, photo_4, product_10, etc)

If you want to just display votes on that page without ability to vote, then add this: rating_read_only = true;

Customize the looks by editing style.css file

Edit ratings.php file to change total number of stars, path to images, time between votes, etc



---
For any questions or problems contact http://www.adriantnt.com
