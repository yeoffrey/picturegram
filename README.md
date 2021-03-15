
# Documentation For Each Page 

index.php: 
<sub>Based on the bootstrap template, this page represents the home page for the site.  Uses PHP to display all the posts
on the site, and passes each post's info to the post.php page to display it properly. If you are logged in, it will overwrite the
about.php page if you click on a different users post.</sub>

post.php: 
<sub>The comment section was taken from another template cited in my references called "Blog Post", just copied it into the file and made sure it was within the container class and looked nice. The post page takes the info that was passed from the index.php file and displays it dynamically. There is a form under the post info that takes the text and time added and passes the data to back to post.php and handles the respective comments table and updates the page/database. Under that, php accesses all the comments and displays them below the post info with the most recent comments on the top. You can't post a comment if you aren't logged in, if you're logged in it will post a comment with your username.</sub>

functions.php: 
<sub>created for a future assignment.</sub>

about.php:
<sub>If logged in the about page will show your bio, name, and banner image. If not, the default page is just the normal about for Picturegram. If you click on a post on index.php, the about page for that user will be shown </sub>

Add post: 
<sub>Handles the script to add a post, doesn't work if not logged in. If logged in, the post will be added to the database and shown on index.php.</sub>

logout.php: 
<sub>simple script to logout and reset the session.</sub>

login: 
<sub>changed the page from a contact page to a login page by renaming the fields for submition and calling into "login to your account". Runs a form that allows the user to login with a username and password, checks it against the DB and if its correct starts a session for the user as they are logged in.</sub>

navigation.php:
<sub>Handles the navigation bar, and handles different data depending on whether the user is logged in or not.</sub>

serverlogin.php: 
<sub>handles logging in into the database and starting the connection for queries.</sub>

header.php: 
<sub>just starts a session.</sub>

footer.php: 
<sub>footer for the site, imported on every page.</sub>

createaccount.php: 
<sub>form for creating an account on the site. once account is created the site will log you in and send you to index.php. Form does check using regex for required fields for password, and won't let you make an account until the regex is passed. </sub>

# References in APA:
Start Bootstrap. (2020, June 18). Blog Post. Retrieved from Start Bootstrap: https://startbootstrap.com/templates/blog-post/
Start Bootstrap. (2020, June 18). Clean Blog. Retrieved from Start Bootstrap: https://startbootstrap.com/themes/clean-blog/


