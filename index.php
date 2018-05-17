<!DOCTYPE html>
<html>
    <title>DBPRGroup10</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <head >
        <meta name="robots" content="noindex">
        <link rel="stylesheet" type="text/css" href="default.css">
       
        
    </head>
        
   
    <body class="bgimg">

        <form action="index.php" submit="" method="post">
        Name: <input type="text" name="name"><br>
        E-mail: <input type="text" name="email"><br>
        <input type="submit">
        </form>

        <?php
            function addrecord(){
                $servername = "localhost";
                $username = "projecttest";
                $password = "test";
                $dbname = "test";
                $name = "testname";
                $email = "john@REEEEE.com";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 

                $sql = "INSERT INTO users (name, email)
                VALUES ($name, $    email)";

                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                $conn->close();
            }
           
            ?>

        
        <div class="center">
            <div class="fade-in"> 
                <h1>MENU</h1>
                <div class="menu">
                    <a href="testpage.php" class"menubutton"><img src="/Images/bats.jpg"></a>
                    <a href="testpage.php" class"menubutton"><img src="/Images/bats.jpg"></a>
                    <a href="testpage.php" class"menubutton"><img src="/Images/bats.jpg"></a>
                    <a href="testpage.php" class"menubutton"><img src="/Images/bats.jpg"></a>
                </div>
            </div>
        </div>
    </body>

    
    
</html> 