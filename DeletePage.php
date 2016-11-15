<!DOCTYPE HTML>
<html>
<head>
<?php
if(!isset($_COOKIE["username"]))
{
    header("Location: LogInPage.php");
}
?>
<link rel="stylesheet" type="text/css" href="BasicStyle.css">
<div class="myTable" style="width:95%">
<h3 style="vertical-align:top; display:inline-block">MED PROJECT</h3>
<a href="LogInPage.php">
<button type="button" class="logoutbtn" style="vertical-align:top; float:right; display:inline-block">Log out</button>
</a>
</div>
</head>
<body bgcolor="#E6E6FA">

<form action="DeleteConfirmationPage.php" method="post">


<?php
//variables to hold login details to database
$host = 'localhost:3306';
$user = 'root';
$pass = '19Chem96';
$db = 'user_test';

$con = mysqli_connect($host, $user, $pass, $db);
$questionID = $_POST["QuestionID"];
$getQuestionQuery = "SELECT * FROM `questions` WHERE `QuestionID` = $questionID";
$getQuestionCommand = mysqli_query($con, $getQuestionQuery);
$QuestionRow = mysqli_fetch_assoc($getQuestionCommand);
echo "<h3>You chose to delete the following question</h3>";
echo '<table>';
echo '<tr><td>'.$QuestionRow["QuestionID"].'</td><td>'.$QuestionRow["Statement"].'</td></tr>';
echo '</table>'; 

echo "<a onClick=\"javascript: return confirm('Please confirm deletion');\" href='DeleteConfirmationPage.php?id="."'><button class='button'type='submit'>Submit</button></a>";
?>
<!--This is the actual input-->
<input type="hidden" name="IDOfDeletedQuestion" value="<?php echo $questionID;?>">
</form>
<form action="Home.php">
<button class="button" type="submit" onclick="Home.php">Cancel</button>
</form>

</body>
</html>
<?php
/*
//This to get everything in the database
$getQuestionDataQuery = "SELECT * FROM `questions`";
$result = mysqli_query($con, $getQuestionDataQuery);

if (mysqli_num_rows($result) > 0) 
{
    $i = mysqli_num_rows($result);
    //echo $i;
    echo "<br>";
    while($i > 0) 
    {
        //this to move thriugh the database row by row, retrieving and displaying the data
        $row = mysqli_fetch_assoc($result);
        echo "ID: " . $row["QuestionID"] . "  Statement: " . $row["Statement"]. " - Type: " . $row["Type"]. " " . "IsHidden: \t" . $row["IsHidden"]. "<br>";
        $i--;
    }
}
//this cretes the button that submits the entered ID to the actual delete page; it also creates the dialog box*/
?>