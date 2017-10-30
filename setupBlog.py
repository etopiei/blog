import MySQLdb, sys, random, hashlib, getpass

def doHash(password):
    return hashlib.sha512(password.encode()).hexdigest()

def getSalt():
    ALPHABET = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"
    chars=[]
    for i in range(32):
        chars.append(random.choice(ALPHABET))
    return "".join(chars)

def setTitles():
    newTitle = input("Enter a title for your blog: ")
    newSubTitle = input("Enter a new sub-title for your blog: ")
    
    myFile = open("index.php", "r")
    output = ""
    for line in myFile:
        if "Blog Title" in line:
            output += "\n<h1>" + newTitle + " - " + newSubTitle + "</h1>"
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
            output += "\n<h1>" + newTitle + " - " + newSubTitle + "</h1>"
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
    hostName = input("Enter the hostname of your blog: ")
    dbName = input("Enter the name of your MYSQL database: ")
    dbUsername = input("Enter your MYSQL username: ")
    dbPassword = getpass.getpass("Enter your MYSQL password: ")
    blogUsername = input("Enter a username for your blog: ")
    blogPassword = getpass.getpass("Enter a password for your blog: ")

    myFile = open("upload.php", "r")
    output = ""
    for line in myFile:
        if "DATABASE_NAME" in line:
            output += "\n$database='" + dbName + "';"
        elif "HOSTNAME" in line:
            output += "\n$host = '" +  hostName + "';"
        elif "DATABASE_USERNAME" in line:
            output += "\n$databaseUsername='" + dbUsername + "';"
        elif "DATABASE_PASSWORD" in line:
            output += "\n$databasePassword= '" + dbPassword + "';"
        else:
            output += "\n" + line

    myFile.close()

    myFile = open("upload.php", "w")
    myFile.write(output)
    myFile.close()

    myFile = open("edit.php", "r")
    output = ""
    for line in myFile:
        if "DATABASE_NAME" in line:
            output += "\n$database='" + dbName + "';"
        elif "HOSTNAME" in line:
            output += "\n$host = '" +  hostName + "';"
        elif "DATABASE_USERNAME" in line:
            output += "\n$databaseUsername='" + dbUsername + "';"
        elif "DATABASE_PASSWORD" in line:
            output += "\n$databasePassword= '" + dbPassword + "';"
        else:
            output += "\n" + line
    
    myFile.close()
    
    myFile = open("edit.php", "w")
    myFile.write(output)
    myFile.close()
    
    return [hostName, dbName, dbUsername, dbPassword, blogUsername, blogPassword]

def createTableForPassword(creds):
    try:
        db = MySQLdb.connect(creds[0], creds[2], creds[3], creds[1])
        cur = db.cursor()
    except:
        print("Failed to connect to MYSQL database.")
        sys.exit(1)

    cur.execute("""CREATE TABLE Login (
        Username VARCHAR(20) NOT NULL,
        HashedPassword VARCHAR(128) NOT NULL, 
        Salt VARCHAR(32) NOT NULL
    )""")

    salt = getSalt()
    hashedPassword = doHash(creds[5]+salt)
    try:
        cur.execute("INSERT INTO Login (Username, HashedPassword, Salt) VALUES ('" + creds[4] + "', '" + hashedPassword + "', '" + salt + "')")
        db.commit()
    except:
        db.rollback()
    db.close()
    print("Data in database, blog is ready to use.")
    
def run():
    setTitles()
    changeSocialMediaLinks()
    creds = setDatabaseCreds()
    createTableForPassword(creds)

run()