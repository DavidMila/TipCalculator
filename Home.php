<!DOCTYPE HTML>
<html>  
<head>
<link rel="stylesheet" type="text/css" href="BasicStyle.css">
<div class="myTable" style="width:95%">
<h3 style="vertical-align:top; display:inline-block">MED PROJECT</h3>
<a href="LogInPage.php">
<button type="button" class="logoutbtn" style="vertical-align:top; float:right; display:inline-block">Log out</button>
</a>
</div>
</head>

<body background="frost_background.jpg">
<?php


//Variables just to access the database
$host = 'localhost:3306';
$user = 'root';
$pass = '19Chem96';
$db = 'user_test';

$con = mysqli_connect($host, $user, $pass, $db);
//to confirm successful login
function Login($con)
{
    if (!isset($_COOKIE["username"]))
    {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
     
        if(!CheckLoginInDB($username,$password, $con))
        {
            return false;
        }        
        return true;
    }
    return true;
}

function CheckLoginInDB($username,$password, $con)
{
    $passwordmd5 = ($password);
    $qry = "SELECT * FROM `administrators` WHERE `username`='$username' AND `password`='$passwordmd5'";
     
    $result = mysqli_query($con, $qry);
    echo mysqli_error($con);
    if(mysqli_num_rows($result) == 0 && !isset($_COOKIE["username"]))
    {
        $row = mysqli_fetch_assoc($result);
        echo "<h3>There was a problem with the username and password</h3>";
        return false;
    }
    $usernameCookie = "username";
    $passwordCookie = "password";
    if(!isset($_COOKIE[$usernameCookie]))
    {
        if ($_POST["checkbox"] == "rememberme")
        {
            setcookie($usernameCookie, $username, time() + (86400 * 30));
            setcookie($passwordCookie, $password, time() + (86400 * 30));
        }
        else
        {
            
            setcookie($usernameCookie, $username);
            setcookie($passwordCookie, $password);
        }
    }
    return true;
}
if(Login($con) or isset($_COOKIE["username"]))
{
    echo '<myDiv>';
    echo '<form action="ChooseNewQuestionTypePage.php" method="post">';
    echo '<button class="button" type="submit" onclick="ChooseNewQuestionTypePage.php" style="display:inline-block; float:left; box-shadow: 4px 4px 16px #111111;"><span>Add a new question</span></button><br>';
    echo '</form>';

    echo '<table class="myTable" style="float:left; vertical-align:top">';//bgcolor="#ccffff"//background-color:#f1f1f1;
    echo '<th style="background-color: #f2f2f2">Ref.ID</th>';
    echo '<th style="background-color: #f2f2f2">Statement</th>';
    echo '<th style="background-color: #f2f2f2">Type</th>';
    echo '<th style="background-color: #f2f2f2">Viewability</th>';
    echo '<th style="background-color: #f2f2f2"></th><th style="background-color: #f2f2f2"></th><th style="background-color: #f2f2f2"></th>';
    echo '<br><br><br><br>';
    echo '<myDiv style="vertical-align:center; display:inline-block"><h3>These are the current questions</h3></myDiv>';

//inital query to get all the data from the database
    $getQuestionDataQuery = "SELECT * FROM `questions`";
    $result = mysqli_query($con, $getQuestionDataQuery);
    if (mysqli_num_rows($result) > 0) 
    {	//simply a loop to read all the data gotten from the result of the query store in $result
    	//and also create edit delete and view Response buttons for each question
	   $hiddenValue = "Displayed";
	   $type = "Multiple Choice";
	   $count = mysqli_num_rows($result);
        while($count > 0) 
        {
    	   $row = mysqli_fetch_assoc($result);
    	   if ($row["IsHidden"] == 2)
    	   {
    		  $hiddenValue = "Not displayed";
    	   }
    	   else {
    		  $hiddenValue = "Displayed";
    	   }
    	   if ($row["Type"] == 1)
    	   {
    		  $type = "Open Response";
    	   }else{
    		  $type = "Multiple Choice";
    	   }
    	//this gets the data row by row
            if($type == "Multiple Choice")
            {
                echo '<tr bgcolor="#ccffff"><td>'.$row["QuestionID"] .'</td>'. "<td>" . $row["Statement"].'</td>'."<td>" . $type. "</td><td>". $hiddenValue. "</td>";
            }else
            {
                echo '<tr bgcolor="#00e6e6"><td>'.$row["QuestionID"] .'</td>'. "<td>" . $row["Statement"].'</td>'."<td>" . $type. "</td><td>". $hiddenValue. "</td>";
            }
            if($type == "Open Response")
            {
                echo '<form action="EditOpenResponsePage.php" method="post">';
                echo '<td><button class="button" type="submit" style="color:white" onclick="EditOpenResponsePage.php"><span>Edit</span></button></td>';
                echo '<input type="hidden" name="QuestionID" value="'. $row["QuestionID"] . '">';
                echo '</form>';
            }else
            {
                echo '<form action="EditMultipleChoicePage.php" method="post">';
                echo '<td><button class="button" type="submit" onclick="EditMultipleChoicePage.php"><span>Edit</span></button></td>';
                echo '<input type="hidden" name="QuestionID" value="'. $row["QuestionID"] . '">';
                echo '</form>';
            }
            echo '<form action="DeletePage.php" method= "post">';
            echo '<input type="hidden" name="QuestionID" value="'. $row["QuestionID"] . '">';
            echo '<td><button class="button" type="submit" onclick="DeletePage.php"><span>Delete</span></button></td>';
            echo '</form>';
            echo '<form action="ViewResponses.php" method="post">';
            echo '<td><button class="button" type="submit" onclick="ViewResponses.php"><span>View</span></button></td></tr>';
            echo '<input type="hidden" name="QuestionID" value="'. $row["QuestionID"] . '">';
            echo '</form>';
            $count--;
        }
    }
echo '</table></myDiv>';
}
else
{
    echo "<h3>Click the logout button to go to the login page</h3>";
}

?>
</body>
</html>

