import sys, getpass

def setTitles():
    newTitle = input("Enter a title for your blog: ")
    newSubTitle = input("Enter a new sub-title for your blog: ")
    
    myFile = open("index.php", "r")
    output = ""
    for line in myFile:
        if "Blog Title" in line:
            output += "\n<h1>" + newTitle + "</h1>"
        elif "Blog Subtitle" in line:
            output += "\n<h5>" + newSubTitle + "</h5>"
        else:
            output += "\n" + line
    myFile.close()

    myFile = open("index.php", "w")
    myFile.write(output)
    myFile.close()

    myFile = open("newPost.php", "r")
    output = ""
    for line in myFile:
        if "Blog Title" in line:
            output += "\n<h1>" + newTitle + "</h1>"
        elif "Blog Subtitle" in line:
            output += "\n<h5>" + newSubTitle + "</h5>"
        else:
            output += "\n" + line
    myFile.close()

    myFile = open("newPost.php", "w")
    myFile.write(output)
    myFile.close()

    myFile = open("history.php", "r")
    output = ""
    for line in myFile:
        if "Blog Title" in line:
            output += "\n<h1>" + newTitle + " - " + newSubTitle + "</h1>"
        else:
            output += "\n" + line
    myFile.close()
    
    myFile = open("history.php", "w")
    myFile.write(output)
    myFile.close()

    print("Titles set.")

def changeSocialMediaLinks():
    github = input("Enter github url: ")
    linkedIn = input("Enter your linked-in url: ")
    instagram = input("Enter your instagram url: ")
    reddit = input("Enter your reddit url: ")
    twitter = input("Enter your twitter url: ")

    myFile = open("index.php", "r")
    output = ""
    for line in myFile:
        if "GITHUB_LINK" in line:
            output += "\n" + '<a href="' + github + '"><i class="fa fa-github"></i></a>'
        elif "LINKEDIN_LINK" in line:
            output += "\n" + '<a href="' + linkedIn + '"><i class="fa fa-linkedin"></i></a>'
        elif "INSTAGRAM_LINK" in line:
            output += "\n" + '<a href="' + instagram + '"><i class="fa fa-instagram"></i></a>'
        elif "REDDIT_LINK" in line:
            output += "\n" + '<a href="' + reddit + '"><i class="fa fa-reddit"></i></a>'
        elif "TWITTER_LINK" in line:
            output += "\n" + '<a href="' + twitter + '"><i class="fa fa-twitter"></i></a>'
        else:
            output += "\n" + line

    myFile.close()

    myFile = open("index.php", "w")
    myFile.write(output)
    myFile.close()

    myFile = open("newPost.php", "r")
    output = ""
    for line in myFile:
        if "GITHUB_LINK" in line:
            output += "\n" + '<a href="' + github + '"><i class="fa fa-github"></i></a>'
        elif "LINKEDIN_LINK" in line:
            output += "\n" + '<a href="' + linkedIn + '"><i class="fa fa-linkedin"></i></a>'
        elif "INSTAGRAM_LINK" in line:
            output += "\n" + '<a href="' + instagram + '"><i class="fa fa-instagram"></i></a>'
        elif "REDDIT_LINK" in line:
            output += "\n" + '<a href="' + reddit + '"><i class="fa fa-reddit"></i></a>'
        elif "TWITTER_LINK" in line:
            output += "\n" + '<a href="' + twitter + '"><i class="fa fa-twitter"></i></a>'
        else:
            output += "\n" + line

    myFile.close()

    myFile = open("newPost.php", "w")
    myFile.write(output)
    myFile.close()

    myFile = open("history.php", "r")
    output = ""
    for line in myFile:
        if "GITHUB_LINK" in line:
            output += "\n" + '<a href="' + github + '"><i class="fa fa-github"></i></a>'
        elif "LINKEDIN_LINK" in line:
            output += "\n" + '<a href="' + linkedIn + '"><i class="fa fa-linkedin"></i></a>'
        elif "INSTAGRAM_LINK" in line:
            output += "\n" + '<a href="' + instagram + '"><i class="fa fa-instagram"></i></a>'
        elif "REDDIT_LINK" in line:
            output += "\n" + '<a href="' + reddit + '"><i class="fa fa-reddit"></i></a>'
        elif "TWITTER_LINK" in line:
            output += "\n" + '<a href="' + twitter + '"><i class="fa fa-twitter"></i></a>'
        else:
            output += "\n" + line
    
    myFile.close()
    
    myFile = open("history.php", "w")
    myFile.write(output)
    myFile.close()

    print("Social Media Links Fixed")

def setDatabaseCreds():
    blogUsername = input("Enter a username for your blog: ")
    blogPassword = getpass.getpass("Enter a password for your blog: ")

    myFile = open("upload.php", "r")
    output = ""
    for line in myFile:
        if "$BLOG_PASSWORD=" in line:
            output += "\n$BLOG_PASSWORD='" + blogPassword + "';"
        elif "$BLOG_USERNAME=" in line:
            output += "\n$BLOG_USERNAME='" + blogUsername + "';"
        else:
            output += line

    myFile.close()

    myFile = open("upload.php", "w")
    myFile.write(output)
    myFile.close()

    myFile = open("edit.php", "r")
    output = ""
    for line in myFile:
        if "$BLOG_PASSWORD=" in line:
            output += "\n$BLOG_PASSWORD='" + blogPassword + "';"
        elif "$BLOG_USERNAME=" in line:
            output += "\n$BLOG_USERNAME='" + blogUsername + "';"
        else:
            output += line
    
    myFile.close()
    
    myFile = open("edit.php", "w")
    myFile.write(output)
    myFile.close()
    
def run():
    setTitles()
    changeSocialMediaLinks()
    setDatabaseCreds()

run()