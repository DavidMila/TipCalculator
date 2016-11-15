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
<form action="Home.php">

<?php
$host = 'localhost:3306';
$user = 'root';
$pass = '19Chem96';
$db = 'user_test';
$con = mysqli_connect($host, $user, $pass, $db);

$deletedQuestionID = $_POST["ID"];
$newQuestionStatement = $_POST["NewQuestionStatement"];
$newQuestionType = $_POST["QuestionType"];
$ID = intval($deletedQuestionID);

echo "The new Question statement is ".$newQuestionStatement."<br>";
$newQuestionStatement = mysqli_real_escape_string($con, $newQuestionStatement);
$UpdateQuestionQuery = "UPDATE `questions` SET `Statement` = '$newQuestionStatement' WHERE `QuestionID` = $ID";
$QUpdateQuery = mysqli_query($con, $UpdateQuestionQuery);

if ($newQuestionType == "Multiple Choice")
{
	$arrayOfAlphabets = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
	$numberOfNewOptions = intval($_POST["numberOfOptions"]);
	$arrayOfOptions = new SplFixedArray($_POST["numberOfOptions"]);

	for($i = 0; $i < $numberOfNewOptions; $i++)
	{
		$arrayOfOptions[$i] = $_POST["NewQuestionOption".$arrayOfAlphabets[$i]];
	}	

	$tempCounter = 0;
	for ($i = 0; $i < $numberOfNewOptions; $i++)
	{
		$arrayOfNewOptions[$tempCounter] = mysqli_real_escape_string($con, $arrayOfOptions[$tempCounter]);
		$tempCounter++;
	}
	$tempCounter = 0;
	for ($i = 0; $i < $numberOfNewOptions; $i++)
	{
		$arrayOfAlphabets[$tempCounter] = mysqli_real_escape_string($con, $arrayOfAlphabets[$tempCounter]);
		$tempCounter++;
	}
	$tempCounter = 0;
	$updateQuery = false;
	while($tempCounter < $numberOfNewOptions){
		$UpdateOptionsQuery = "UPDATE `options` SET `OptionValue` = '$arrayOfOptions[$tempCounter]' WHERE `RelatedQuestionID` = $deletedQuestionID AND  `OptionAlphabet` = '$arrayOfAlphabets[$tempCounter]'";
		$updateQuery = mysqli_query($con, $UpdateOptionsQuery);
		if(!$updateQuery)
		{
			echo "Error updating record: " . mysqli_error($con);
		}
		$tempCounter++;
	}
	if($updateQuery)
	{
		echo "Options Successfully Updated<br>";
	}else
	{
		echo "Oops! Update to Options did not go well.<br>";
	}

}
if($QUpdateQuery)
{
	echo "Questions successfully updated<br>";
}
else{
	echo "Oops! There was a problem adding this question<br>";
}


?>
<button class="button" type="submit">Return Home</button>
</form>
</body>
</html>
