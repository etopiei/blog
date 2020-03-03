# blog

The software behind my blog.

The only dependency is PHP.

## Install Instructions

To install locally/test:

	$ git clone git@github.com:etopiei/blog.git
	$ cd blog

Edit the constants in `constants.php` and you are good to go.

## Writing Posts

Now just write posts in Vanilla HTML and save them to the `posts` directory (with the name `1.post`, `2.post` etc.).

Then update the corresponding `metadata.post` and `description.post` files, so that the RSS feed can be filled in. 

The format of `metadata.post` is that each line should contain:

```
<unix_timestamp> <post title>
```

eg:

```
1485475200 Welcome to my blog
```

## Development Goals

 - [x] Remove MYSQL dependency
 - [x] Add RSS Feed
 - [x] Re-design
 - [ ] Comment Section
 - [x] Redo Routing API to make RSS easier and site nicer (needs to be backwards compatible though)

## Any extra questions

Please direct other questions to me.etopiei@gmail.com
