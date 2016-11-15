<!DOCTYPE HTML>
<html>
<head>
<?php
if(!isset($_COOKIE["username"]))
{
    header("Location: LogInPage.php");
}
</head>
<body>

<form>
Please select the question to edit or delete by ID<br>

These are the current Questions:
<?php
$host = 'localhost:3306';
$user = 'root';
$pass = '19Chem96';
$db = 'user_test';

$con = mysqli_connect($host, $user, $pass, $db);
$getQuestionDataQuery = "SELECT * FROM `questions`";
$result = mysqli_query($con, $getQuestionDataQuery);

if (mysqli_num_rows($result) > 0) 
{
	$i = mysqli_num_rows($result);
	//echo $i;
	echo "<br>";
    while($i > 0) 
    {
    	$row = mysqli_fetch_assoc($result);
        echo "ID: " . $row["QuestionID"] . "  Statement: " . $row["Statement"]. " - Type: " . $row["Type"]. " " . "IsHidden: \t" . $row["IsHidden"]. "<br>";
        $i--;
    }
}
?>
</form>
</body>
</html>