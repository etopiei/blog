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

## Writing Posts

Now just write posts in Vanilla HTML and save them to the `posts` directory (with the name `1.post`, `2.post` etc.).

Then update the corresponding `metadata.post` and `description.post` files, so that the RSS feed can be filled in. 

## Development Goals

 - [x] Remove MYSQL dependency
 - [x] Add RSS Feed
 - [x] Re-design
 - [] Comment Section
 - [x] Redo Routing API to make RSS easier and site nicer (needs to be backwards compatible though)

## Any extra questions

Please direct other questions to me.etopiei@gmail.com
