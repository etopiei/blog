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