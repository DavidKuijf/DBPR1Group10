<?php

require 'database.php';
require 'sessioncheck.php';


// start database connection
$conn = new \PDO("mysql:host=".$dbHost.";dbname=".$dbName,$dbUserName,$dbPassword);

// if a session exists, find out if the current logged in user is an admin, otherwise redirect to login
if (isset($_SESSION['id']))
{
    $userid = $_SESSION['id'];
    
    $query = $conn->prepare("SELECT isadmin FROM speler WHERE id = :id");
    
    $query->execute(['id' => $userid]);

    $result = $query->fetchAll();

    $currentisadmin = $result[0]['isadmin'];
}
else
{
    header("Location: index.php");
} 

// if a post request exists, store the current logged in user's id
if (isset($_POST['id']))
{
    $userid = $_POST['id'];
}

// fetch all user information from the database
$query = $conn->prepare("SELECT roepnaam, achternaam, username, isadmin, skill FROM speler WHERE id = :id");
        
$query->execute(['id' => $userid]);
    
$result = $query->fetchAll();
    
// store the information locally so we can use it
$firstname = $result[0]['roepnaam'];
$lastname = $result[0]['achternaam'];
$username = $result[0]['username'];
$isadmin = $result[0]['isadmin'];
$skill = $result[0]['skill'];

// echo the player's skill to the page so we can use it in JS
echo "<text id='skill'>" . $skill . "</text>";

// if the post request has the edit tag change the values in the database to the entered values on the page
if (isset($_POST['edit']))
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $id = $_POST['id'];

    if (isset($_POST['skillselect']))
    {
        $skill = $_POST['skillselect'];
    }

    if (isset($_POST['isadmin']))
    {
        $isadmin = 1;
    }
    else
    {
        $isadmin = 0;
    }

    $checkquery = $conn->prepare("SELECT username FROM speler WHERE username LIKE :username");

    $checkquery->execute([
        'username' => $username
    ]);

    if ($checkquery->fetchAll() > 1) 
    {
        $query = $conn->prepare("UPDATE speler SET roepnaam = :firstname, achternaam = :lastname, username = :username, isadmin = :isadmin, skill = :skill WHERE id = :id");
    }
    else
    {
        echo "Error: username is already taken!";
    }


    $query->execute([
        'firstname' => $firstname,
        'lastname' => $lastname,
        'username' => $username,
        'id' => $id,
        'isadmin' => $isadmin,
        'skill' => $skill
    ]);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/user.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="css/default.css"/>
</head>

<body>
<ul class="optionMenu">
    <li class="optionMenuContainerLeft"><a class="optionMenuButton" href="#" id="home">Thuis</a>
    <li class="optionMenuContainerRight"><a class="optionMenuButton" href="#" id="log-out">log uit</a>
    <li class="optionMenuContainerRight"><a class="optionMenuButton" href="#" id="create-user">Maak account</a>
</ul>
<div id="infocontainer">
    <h1>Gebruikersprofiel</h1>
    <form method="post">
        <ul>
            <?php
            // if the current user is an admin, show the user selection box
            echo "<li>";
            if ($currentisadmin == 1)
            {
                echo "<label for='userselect'>Speler</label>";
                echo "<span><select id='userlist'>";
                
                $query = $conn->prepare("SELECT id, roepnaam, achternaam FROM speler");
                $query->execute();

                while($result = $query->fetch())
                {
                    echo "<option value='" . $result['id'] . "'>" . $result['id'] . " " . $result['roepnaam'] . " " . $result['achternaam'] . "</option>";
                }

                echo "</select></span>";
                echo "<input type='button' name='loaduser' id='loaduser' value='Laad gegevens'>";
            }
            echo "</li>";
            ?>
            <li id="userid">
                <label for="userid">User Id</label>
                <span><input type="text" name="id" id="id" value='<?php echo "$userid" ?>' readonly="readonly"></span>
            </li>
            <li>
                <label for="firstname">Roepnaam</label>
                <span><input type="text" name="firstname" value='<?php echo "$firstname" ?>'></span><br>
            </li>
            <li>
                <label for="lastname">Achternaam</label>
                <span><input type="text" name="lastname" value='<?php echo "$lastname" ?>'></span><br>
            </li>
            <li>
                <label for="username">Gebruikersnaam</label>
                <span><input type="text" name="username" value='<?php echo "$username" ?>'></span><br>
            </li>
            <?php
            // if the current user is an admin, show the skill selection box and the 'is admin' box
            if ($currentisadmin == 1)
            {
                echo "
                <li>
                    <label for='skillselect'>Bekwaamheid</label>
                    <span>
                        <select name='skillselect' id='skillselect'>
                            <option value='0'>Bronze</option>
                            <option value='1'>Silver</option>
                            <option value='2'>Gold</option>
                            <option value='3'>Platinum</option>
                            <option value='4'>Diamond</option>
                        </select>
                    </span>
                </li>"; 
                    
                if ($isadmin == 1)
                {
                    echo "<li><label for='isadmin'>Admin?</label><span><input type='checkbox' name='isadmin' checked></span>"; 
                }
                else
                {
                    echo "<li><label for='isadmin'>Admin?</label><span><input type='checkbox' name='isadmin'></span>"; 
                }
            }
            ?>
            <li>
                <span><button type="submit" name="edit" value="true">Wijzig Info</button></span>
            </li>
        </ul>
    </form>
</div>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/user.js"></script>
<script src="js/navigationbar.js"></script>
</html>