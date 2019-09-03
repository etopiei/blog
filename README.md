# blog

The software behind my blog.

The only dependencies are PHP and Python.

Super simple and lightweight.

## Install Instructions

To install locally/test:

	$ git clone git@github.com:etopiei/blog.git
	$ cd blog
	$ python3 setupBlog.py

	Answer the questions of the install script and it will set up the blog.

	$ php -S localhost:8000

Then you can view/use the blog on http://localhost:8000

For installing to a server running apache:

	$ cd /var/www/html
	$ git clone git@github.com:etopiei/blog.git . 
	$ python3 setupBlog.py

	Answer the questions of the install script and it will set up the blog.

## Writing Posts

Now just write posts in Vanilla HTML at: `/newPost.php`

The blog will be updated accordingly.

Edit posts at: `/editPost.html` you must first enter your U/P to access the enter edit mode, then enter them again, along with your changes to submit.

Tbh the edit/writing system is very basic as I usually write my posts on disk and then just upload new posts. manually. But this can be improved with time.

## Development Goals

 - [x] Remove MYSQL dependency
 - [] Add RSS Feed
 - [] WYSIWYG Editor
 - [] Add image upload capabilites to editor
 - [] Add import/export capabilities
 - [x] Re-design

## Any extra questions

Please direct other questions to me.etopiei@gmail.com