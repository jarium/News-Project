# News Project
A news website project which contains register, login, users and content management system.
The website uses "Soft delete" system. So when a data is deleted, its only removed temporarly from the application. The data can either stay deleted or be restored by desire. 
<br> <br>

## Installation <hr>
```bash
$ cp .env.example .env
$ docker-compose up
```

### Setting Up The MySQL Database <hr>
After successfully installing, go to http://localhost:8082/ then login with the info below:

- Server: `mariadb`
- Username: `root`
- Password: `root`

After logging in, create a database called `newspage` then import the `newspage.sql` file to adminer.
After a successfull import, the database will be ready.
<br> <br>

## Routes <hr>

After installing the docker container and setting up our mysql database, the website will be available at http://localhost

### Routes For All Users <br>

- [/ or /news](http://localhost/news) -> Shows all news with search option
- [/api/news](http://localhost/api/news) ->Json data value of all news (Api)
- [/api/news?id=$id](http://localhost/api/news) ->Json data value of a spesific news with $id (Api)
- [/about](http://localhost/about) ->About us page
- [/news/spesific?_id=$id](http://localhost/news/spesific?_id=$id) -> View details, content, image of a spesific news with $id, view comments about that news and make comments if you are signed in
- [/news/science](http://localhost/news/science) -> News with "Science" category
- [/news/health](http://localhost/news/health) -> News with "Health" category
- [/news/political](http://localhost/news/political) -> News with "Political" category
- [/news/technology](http://localhost/news/technology) -> News with "Technology" category
- [/news/world](http://localhost/news/world) -> News with "World" category
- [/news/economy](http://localhost/news/economy) -> News with "Economy" category
- [/news/sports](http://localhost/news/sports) -> News with "Sports" category
- [/news/art](http://localhost/news/art) -> News with "Art" category
- [/news/education](http://localhost/news/education) -> News with "Education" category
- [/news/social](http://localhost/news/social) -> News with "Social" category
- [/.well-known/security.txt](http://localhost/.well-known/security.txt) -> Security.txt file <br> <br>

### Routes For Users That Aren't Logged In <br>
- [/users/login](http://localhost/users/login) -> Login Page
- [/users/register](http://localhost/users/register) -> Register Page

<br> <br>
### Routes For Users That Are Logged In <br>
- [/users](http://localhost/users) -> User Account Main Page, where the users can access certain activities and delete their account
- [/users/comments](http://localhost/users/comments) -> Page for the users to search their comments, check their comments and their data like create date etc.
- [/users/category](http://localhost/users/category) -> Page for the users to set/change their choice of news categories for their special news feed
- [/users/newsread](http://localhost/users/newsread) -> Page for the users to search and check their read news and see when
- [/news/forme](http://localhost/news/forme) -> Special news feed for the user. Determined by the user's choice of news categories at (http://localhost/users/category)
- [/users/logout](http://localhost/users/logout) -> Logout route for users that are logged in. 


<br> <br>
### Routes For Editors (Or for the user with higher role rank)<br>
- [/editor](http://localhost/editor) -> Editor panel
- [/editor/createnews](http://localhost/editor/createnews) -> Create news page for editors to create news with the news category they assigned
- [/editor/mynews](http://localhost/editor/mynews) -> Page for editors (or users with higher role rank) to see their created news, make search, get information about them.
- [/editor/updatenews](http://localhost/editor/updatenews) -> Page for editors to update their news if not 24 hours past after the editor created the news they want to update


<br> <br>
### Routes For Mods (Or for the user with higher role rank)<br>
- [/mod](http://localhost/mod) -> Mod panel
- [/mod/createnews](http://localhost/mod/createnews) -> Create news page for mods to create news with all types of categories
- [/mod/showusers](http://localhost/mod/showusers) -> Page for mods to search users that are not deleted with the role of editor and user and get information about them.
- [/mod/promote](http://localhost/mod/promote) -> Page for mods to promote users to editors or demote editors to users
- [/mod/editorcategory](http://localhost/mod/editorcategory) -> Page for mods to update/change editor's' categories
- [/mod/deletedusers](http://localhost/mod/deletedusers) -> Page for mods to search, check deleted users and get info about them
- [/mod/activities](http://localhost/mod/activities) -> Page for mods to check activities of users/editors
- [/mod/comments](http://localhost/mod/comments) -> Page for mods to search comments and deleted comments and gain info about them
- [/mod/editcomment](http://localhost/mod/editcomment) -> Page for mods to update, delete comments, or restore deleted comments.
- [/mod/news](http://localhost/mod/news) -> Page for mods to search news and deleted news and gain info about them
- [/mod/editnews](http://localhost/mod/editnews) -> Page for mods to update, delete news, or restore deleted news.


<br> <br>
### Routes For Admins <br>
- [/admin](http://localhost/admin) -> Admin panel
- [/admin/users](http://localhost/admin/users) -> Page for admins to search users for info with all kind of roles which are not deleted
- [/admin/promote](http://localhost/admin/promote) -> Page for admins to promote/demote users' roles
- [/admin/activities](http://localhost/admin/activities) -> Page for admins to check activities of users with all kind of roles
<br> <br>

## Maintenance <hr>
You can set/unset the maintenance mode by changing the MAINTENANCE constant in the "config.php" file. False = no maintenance, True = maintenance. If set to true, all of the users that visit the website will get the maintenance message and all of the routes will be unavailable other than the route that prints maintenance message.

<br> <br>

## Default Admin <hr>
username: admin<br>
password: adminşifresi
<br> <br>

## For More <hr>
You can mail to: efebyk97@gmail.com for more. <br>
With my regards, <br>
Efe Buyuk
