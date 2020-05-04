Welcome to the start of the mAirlist Request Project. Goal is to build a request engine for mAirlist that is easy to implement, secure and easy to use. Feel free to collaborate.

This is a quick install guide for the beta version of the MairlistRequest module. This module allows you to enable your listerners to request a song and get it added automatically to mAirlist. 

The module exits of two components: 

 

A PHP website 

This website provides an API for mAirlist to query and to be used to place a request into the system. It is using a SQLite database to store requests and the music database. I have include a very simple example (index.php) to show how to query the API using JQuery 

A mAirlist (background) Script 

This is script is executed on the mAirlist machine and will query the API and replace the Request dummy with the request. Currently this is a normal script and need to be executed by the event scheduler or manually from mAirlist. Future plan is to let the script run on the start of every item. 

 

Let’s first start with the PHP website. You’ll need a webserver which can be reached by the listeners. This server needs to run PHP 7.x and higher and have the SQLite3 module enabled. 

Download the required files from GitHub - https://github.com/stefanwiele/mAirlistRequest/archive/master.zip 

Extract the zip file, go the mAirlistRequest-master -> PHP -> inc and open settings.inc.php with a text editor like notepad. 

Change $uploadCsvSecret to your own secure string. This string secures the page where you can upload the CSV from mAirlist to update the database. For now everytime you upload a new CSV the database table will be cleared, which means that if you do not protect this page with a good secret everyone can delete the table. (this is likely to change in the future). 

Save the file 

Upload the content of the PHP folder to your webhost 

Go to https://<yourhostname>/<folderofmairlistrequest/createDB.php - this will create the SQLite database 

DELETE createdb.php as a security measure 

 

Now we need to upload the mAirlist Database to the database as the website can not communicate directly with mAirlist (will likely change in the future).  

Open the mAirlist Database Window 

Click on Database -> Export -> Export Entire Library 

Select CSV file and press ok 

Give your file a name and press Save 

After the exporting is done press close 

Go to https://<yourhostname>/<folderofmairlistrequest/uploadcsv.php 

Press Choose File and select the CSV file you just generated 

Enter the secret you’ve set in step 3 and press Update Database (This can take some time depending on the size of your database) 

The PHP website is ready, you can send your listeners to https://<yourhostname>/<folderofmairlistrequest/ where they can search and click the database number behind the song to add this request to the queue. 

To get the songs to play in mAirlist follow these steps: 

Insert a Dummy with the title set to “Request” into your playlist (you can schedule this as well as part of a music template) 

Open the mAirlist Script (requestBackgroundNoRest.mls) from the BackgroundScript folder of the extracted zip. 

Change sPHPRootUrl to the root url of where you have put the PHP website 

Save the script 

Request a song from your website 

In mAirlist click on the downwards pointing arrow next to the mAirlist logo in the menu bar and select “Control Panel” 

Click on Background Scripts and then press Add 

Select the requestBackGroundNoRest.mls script, the Request dummy should be replaced by the latest request and the script will check at the start of every song 
