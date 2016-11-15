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
<!--Edit Open Response Page-->
<body bgcolor="#E6E6FA">

<form action="EditQuestionConfirmationPage.php" method="post" onsubmit="return confirm('Please confirm edit');">
<input type="hidden" name="QuestionType" value="Open Response">
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
<table>
<th>Ref.ID</th>
<th>Statement</th>
<th>Type</th>
<th>Viewability</th>
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
//echo '<tr><td>'.$row["QuestionID"].'</td><td>'.$row["Statement"].'</td><td>.'$row["Type"].'</td><td>'.$row["IsHidden"].'</td></tr>';
echo '<input type="hidden" name = "ID" value ="'.$IDOfQuestionToBeEdited.'">';
echo "<br>";
?>
</table>
<br>

 <h3>Please enter the new Statement of the quesiton:</h3>
<input type="text" name="NewQuestionStatement">
<br>    
<button class="button" type="submit" value="Submit">Submit</button>
</form>
<form action="Home.php">
<button class="button" type="submit" onclick="Home.php">Cancel</button>
</form>
</body>
</html>
<?php
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