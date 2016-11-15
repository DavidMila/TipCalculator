<!DOCTYPE HTML>
<html>
<head>
<?php
if(!isset($_COOKIE["username"]))
{
    header("Location: LogInPage.php");
}
?>
</head>
<link rel="stylesheet" type="text/css" href="BasicStyle.css">
<div class="myTable" style="width:95%">
<h3 style="vertical-align:top; display:inline-block">MED PROJECT</h3>
<a href="LogInPage.php">
<button type="button" class="logoutbtn" style="vertical-align:top; float:right; display:inline-block">Log out</button>
</a>
</div>
<body bgcolor="#E6E6FA">

<form action="Home.php">

<?php
//1 is OpenResponse, 2 is multiple choice
//1 is displayed, 2 is hidden
//echo mysqli_error($con);
$host = "localhost:3306";
$user = "root";
$pass = "19Chem96";
$db = "user_test";
$con = mysqli_connect($host, $user, $pass, $db);

$QuestionID = $_POST["QuestionID"];
echo "Question Ref.ID : ".$QuestionID."<br>";
$getQuestionQuery = "SELECT * FROM `questions` WHERE `QuestionID` = $QuestionID"; 
$getQuestionCommand = mysqli_query($con, $getQuestionQuery);
$row = mysqli_fetch_assoc($getQuestionCommand);
$relevantID = $row["QuestionID"];

if ($row["Type"] == 2)
{
	echo'<table><th>Alphabet</th><th>Number of patients with choice</th><th>Value</th>';
	$getOptionsQuery = "SELECT * FROM `options` WHERE `RelatedQuestionID` = $QuestionID"; 
	$getOptionsResult = mysqli_query($con, $getOptionsQuery);	
	$numResults = mysqli_num_rows($getOptionsResult);	
	echo '<h1>'.$row["Statement"].'</h1>';
	echo '<br>';
	//$alphabets = ['A', 'B', 'C', 'D', 'E', 'F'];
	$arrayOfAlphabets = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
	for($i = 0 ; $i < $numResults ; $i ++)//for each alphabet
	{
		$optionRow = mysqli_fetch_assoc($getOptionsResult);
		$countUsersQuery = "SELECT COUNT(*) AS Number_of_Picks FROM `selectedchoices` WHERE `QuestionID` = $relevantID AND `Selection` = '$arrayOfAlphabets[$i]'";
		$countResult = mysqli_query($con, $countUsersQuery);
		$row = mysqli_fetch_object($countResult);
		$value = intval($row->Number_of_Picks);
		echo '<tr><td>'.$arrayOfAlphabets[$i].'</td><td>'.$value.'</td><td>'.$optionRow["OptionValue"].'</td></tr>';
	}
	echo "</table>";
}else if ($row["Type"] == 1)
{
	echo'<table><th>User Number</th><th>Response</th>';
	echo '<h1>'.$row["Statement"].'</h1>';
	$getResponsesQuery = "SELECT * FROM `Open Response` WHERE `QuestionID` = $QuestionID";
	$getResponsesQuery = mysqli_real_escape_string($con, $getResponsesQuery);
	$getResponsesResult = mysqli_query($con, $getResponsesQuery);
	$count = mysqli_num_rows($getResponsesResult);
	if ($count == 0)
	{
		echo '<h3>There are no responses for this question yet.</h3>';
	}
	else
	{
		for ($i = 0; $i < $count; $i++)
		{
			$ResponseRow = mysqli_fetch_assoc($getResponsesResult);	
			echo '<tr><td>'.$ResponseRow["User Number"].'</td><td>'.$ResponseRow["Response"].'</td></tr>';
		}
	}
	echo "</table>";
}
?>
<button class="button" type="submit">Return Home</button>
</form>
</body>
</html>