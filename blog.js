 function loadJSON(callback) {   

    var xobj = new XMLHttpRequest();
        xobj.overrideMimeType("application/json");
    xobj.open('GET', 'blogPosts.json', true); // Replace 'my_data' with the path to your file

    xobj.onreadystatechange = function () {

          if (xobj.readyState == 4 && xobj.status == "200") {
            // Required use of an anonymous callback as .open will NOT return a value but simply returns undefined in asynchronous mode
            callback(xobj.responseText);

          }

    };

    xobj.send(null);  

 }

function fetchJSON() {

 loadJSON(function(response) {

  // Parse JSON string into object
    var jsonObject = JSON.parse(response);
    var latestPost = getLatestPost(jsonObject);
    readJSON(jsonObject, latestPost);

 });

}

function getLatestPost(jsonObject) {

	var x = 1; 

	while (true) {

		if (typeof jsonObject.posts[x] == "undefined") {

			// x - 1 is the latest blog post

			return x - 1;

		} else {

			x = x + 1;
			continue;

		}

	}

}

function readJSON(jsonObject, latestPostNumber) {

	writePostAsDomElements(jsonObject.posts[latestPostNumber].title, jsonObject.posts[latestPostNumber].contents);

	var hiddenNumber = document.getElementById('post-number');
	hiddenNumber.value = latestPostNumber;

}

function writePostAsDomElements(title, contents) {

	var titlePlace = document.getElementById('title');
	titlePlace.innerHTML = title;

	var contentsPlace = document.getElementById('contents');
	contentsPlace.innerHTML = contents;

}

function goBack() {

	//get current post number

	var currentPostNumber = document.getElementById('post-number').value;

	var newPostNumber = parseInt(currentPostNumber) - 1;

	//retrieve new post

	loadJSON(function(response) {

		// Parse JSON string into object
    	var jsonObject = JSON.parse(response);

    	//check there is a previous post to go to

    	if (typeof jsonObject.posts[newPostNumber] != "undefined") {

    		//Get Title and Contents from JSON Object and Write it to DOM
    		writePostAsDomElements(jsonObject.posts[newPostNumber].title, jsonObject.posts[newPostNumber].contents);
    		var hiddenNumber = document.getElementById('post-number');
			hiddenNumber.value = newPostNumber;

    	} else {

    		//do nothing there is no post to go to. perhaps add an error message here later

    	}

 	});

}

function goForward() {

		//get current post number

	var currentPostNumber = document.getElementById('post-number').value;

	var newPostNumber = parseInt(currentPostNumber) + 1;

	//retrieve new post

	loadJSON(function(response) {

		// Parse JSON string into object
    	var jsonObject = JSON.parse(response);

    	//check there is a previous post to go to

    	if (typeof jsonObject.posts[newPostNumber] != "undefined") {

    		//Get Title and Contents from JSON Object and Write it to DOM

    		writePostAsDomElements(jsonObject.posts[newPostNumber].title, jsonObject.posts[newPostNumber].contents);

    		//change the post number hidden element.

    		var hiddenNumber = document.getElementById('post-number');
			hiddenNumber.value = newPostNumber;

    	} else {

    		//do nothing there is no post to go to. perhaps add an error message here later

    	}

 	});

}

function listPosts() {

    loadJSON(function(response) {

        // Parse JSON string into object
        var jsonObject = JSON.parse(response);
        var postsArray = [];

        for (var key in jsonObject) {
            if (jsonObject.hasOwnProperty(key)) {
                for (var i = 0; i < jsonObject[key].length; i++) {
                    var postTitle = jsonObject[key][i]['title'];
                    postsArray.push(postTitle, i+1);
                }
            }
        }

        writeList(postsArray);

    });

}

function writeList(postsArray){

    var x = document.getElementById('contents');

    html = "<h1>Post History</h1>";

    for (var i = 0; i < (postsArray.length); i = i + 2) {
        html = html + "<a class='post-links' href='index.html?=" + postsArray[i+1] + "'>" + postsArray[i] + "</a><br>";
    }

    x.innerHTML = html;

}

function getParticularPost() {

    var urlParameter = getParameterByName("?");

    if (urlParameter > 0) {

        //get JSON and use the post number from the url parameter to write the post to DOM

        loadJSON(function(response) {

            var jsonObject = JSON.parse(response);

            var post = jsonObject.posts[urlParameter-1];

            //check here that this post number actually exists

            if (typeof jsonObject.posts[urlParameter-1] == "undefined") {
                //don't get this post. instead load the latest.
                fetchJSON();
                return;
            }

            var postTitle = post['title'];
            var postContents = post['contents'];

            writePostAsDomElements(postTitle, postContents);
            var hiddenNumber = document.getElementById('post-number');
            hiddenNumber.value = urlParameter-1;

        });

    } else {

        fetchJSON();

    }

}

 function getParameterByName(name, url) {

     if (!url) url = window.location.href;
     name = name.replace(/[\[\]]/g, "\\$&");
     var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
         results = regex.exec(url);
     if (!results) return null;
     if (!results[2]) return '';
     return decodeURIComponent(results[2].replace(/\+/g, " "));

 }