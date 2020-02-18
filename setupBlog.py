def setTitles():
    newTitle = input("Enter a title for your blog: ")
    newSubTitle = input("Enter a new sub-title for your blog: ")
    blogUrl = input("Enter base URL of blog: ")
    
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

    myFile = open("feed.php", "r")
    output = ""
    for line in myFile:
        if "TITLE_HERE" in line:
            output += '\n$title="' + newTitle + '";'
        elif "SUB_HERE" in line:
            output += '\n$subtitle="' + newSubTitle + '";'
        elif "URL_HERE" in line:
            output += '\n$url="' + blogUrl + '";'
        else:
            output += "\n" + line
    myFile.close()

    myFile = open("feed.php", "w")
    myFile.write(output)
    myFile.close()

    myFile = open("history.php", "r")
    output = ""
    for line in myFile:
        if "Blog Title" in line:
            output += "\n<h1>" + newTitle + "</h1>"
        elif "Blog Subtitle" in line:
            output += "\n<h5>" + newSubTitle + "</h5>"
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
    
def run():
    setTitles()
    changeSocialMediaLinks()

run()
