# blog

The software behind my blog.
Running PHP and MYSQL in the backend.
Super simple and lightweight.

## Install Instrcutions

First install Apache and MYSQL then clone the blog to the server:

	$ cd /var/www/html/
	$ git clone git@github.com:etopiei/blog.git . 

Before you begin setup you must create a mysql database for the blog

	$ mysql -u USERNAME -p PASSWORD
	mysql> CREATE DATABASE DATABASENAME;

Make sure you take note of the MYSQL username and password as well as the database name. 

## Dependencies for set-up script

Make sure you have python3 installed and then run:

	$ sudo pip3 install mysqlclient

Now Run setup script:

	$ python3 setupBlog.py

Answer the questions of the install script and it will set up the blog.

## Writing Posts

Now just write posts in Vanilla HTML at: host.com/newPost.php
The blog will be updated accordingly.

## Any extra questions

Please direct other questions to me.etopiei@gmail.com