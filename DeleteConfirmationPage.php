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
//echo '<script type="text/javascript">confirm("It works.");</script>';

$host = 'localhost:3306';
$user = 'root';
$pass = '19Chem96';
$db = 'user_test';
$con = mysqli_connect($host, $user, $pass, $db);
//no actual need for conditional
if (TRUE)
{	//Get access to database
	//Get ID of question passed from deletion page
	$IDForDeletion = $_POST["IDOfDeletedQuestion"];
	//Create query that will be passed to data base
	$deleteQuestionQuery = "DELETE FROM `questions` WHERE `QuestionID` = $IDForDeletion";
	$deleteAssociatedOptionsQuery = "DELETE FROM `options` WHERE `RelatedQuestionID` = $IDForDeletion";
	echo $deleteQuestionQuery;
	//Execute delete query
	$query = mysqli_query($con, $deleteQuestionQuery);
	$optionDeleteQuery = mysqli_query($con, $deleteAssociatedOptionsQuery);
	if ($query){
		//notify if query succeeded
		echo "Deletion Succesful<br>";
	}else {
		//notify if query failed
		echo "Deletion not successful.<br>Sorry, your changes were not made to the database.<br>";
	}
	if ($optionDeleteQuery){
		//notify if query to delete options succeeded
		echo "Deletion of options Succesful<br>";
	}else {
		//notify if query to delete options failed
		echo "Deletion of Associcated options not successful.<br>Sorry, your changes were not made to the database.<br>";
	}
}
?>
Please click the button below to go to the Home page<br>
<button class="button" type="submit" value="Go Home">Go Home</button>
</form>
</body>
</html>