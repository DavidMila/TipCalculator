<!DOCTYPE HTML>
<html>
<head>
<?php
if(!isset($_COOKIE["username"]))
{
    header("Location: LogInPage.php");
    //make sure the user is logged in via cookies
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

<form action="EditQuestionConfirmationPage.php" method="post" onsubmit="return confirm('Please confirm edit');">
<input type="hidden" name="QuestionType" value="Multiple Choice">

<table>
<th>Ref.ID</th>
<th>Statement</th>
<th>Type</th>
<th>Viewability</th>

<style>
input[type=text]{
    width: 25%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 5px solid #b3ffff;
    border-radius: 4px;
    box-sizing: border-box;
}
</style>

<?php
$host = 'localhost:3306';
$user = 'root';
$pass = '19Chem96';
$db = 'user_test';
$con = mysqli_connect($host, $user, $pass, $db);

$IDOfQuestionToBeEdited = $_POST["QuestionID"];
$IDOfQuestionToBeEdited = intval($IDOfQuestionToBeEdited);

$getQuestionCommand = "SELECT * FROM `questions` WHERE `QuestionID` = $IDOfQuestionToBeEdited";

$getQuestionQuery = mysqli_query($con, $getQuestionCommand); 
$row = mysqli_fetch_assoc($getQuestionQuery);
if ($row["IsHidden"] == 2)
{
	$hiddenValue = "Is not diaplayed";
}
else {
	$hiddenValue = "Is displayed";
}
if ($row["Type"] == 1)
{
	$type = "OpenResponse";
}else{
	$type = "Multiple Choice";
}
echo "<h3>You chose to edit the following question:  </h3><br>";
echo '<tr><td>'.$row["QuestionID"] .'</td>'. "<td>" . $row["Statement"].'</td>'."<td>" . $type. "</td><td>". $hiddenValue. "</td></tr>";

echo '<input type="hidden" name = "ID" value ="'.$IDOfQuestionToBeEdited.'">';
echo "<br>";
$arrayOfAlphabets = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
$getOldOptionsQuery = "SELECT * FROM `options` WHERE `RelatedQuestionID` = $IDOfQuestionToBeEdited";
$getOldOptionsCommand = mysqli_query($con, $getOldOptionsQuery);
echo '<table>';
$numberOfOldOptions = mysqli_num_rows($getOldOptionsCommand);
for($count = 0; $count < $numberOfOldOptions; $count++)
{
    $oldOptionsResult = mysqli_fetch_assoc($getOldOptionsCommand);
    echo '<tr><td>'.$arrayOfAlphabets[$count].'</td><td>'.$oldOptionsResult["OptionValue"].'</td></tr>';
}

echo '</table>';
$oldOptionsResult = mysqli_fetch_assoc($getOldOptionsCommand);
echo '</table>';
$numberOfOptionsQuery = "SELECT COUNT(*) AS Number_of_Picks FROM `options` WHERE `RelatedQuestionID` = $IDOfQuestionToBeEdited"; 
$result = mysqli_query($con, $numberOfOptionsQuery);
$resultData = mysqli_fetch_object($result);
echo mysqli_error($con);
echo '<input type="hidden" name="numberOfOptions" value="'.$resultData->Number_of_Picks.'">';
echo $resultData->Number_of_Picks."ddd";
$numOfOptions = intval($resultData->Number_of_Picks);
echo $numOfOptions;
echo '<h3>Please enter the new Statement of the quesiton:</h3>';
echo '<input type="text" name="NewQuestionStatement"><br>';
echo '</table>';
echo 'Please replace the options here:<br>';
for($i = 0; $i < $numOfOptions; $i++)
{
    echo $arrayOfAlphabets[$i].':<input type="text" name="NewQuestionOption'.$arrayOfAlphabets[$i].'"><br>';
}
echo '<button class="button" type="submit" value="Submit">Submit</button>';
echo '</form>';
echo '<form action="Home.php">';
echo '<button class="button" type="submit" onclick="Home.php">Cancel</button>';
echo '</form>';
echo '</body>';
echo '</html>';

/*$getQuestionDataQuery = "SELECT * FROM `questions`";
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
}*/
?>