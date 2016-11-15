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

<form name="NewQuestionForm" action="AddQuestionConfirmationPage.php" method="post">
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
<br>
Please enter your new question: 
<input type="text" name="QuestionStatement" required><br>
<input type="hidden" name="QuestionType" value="Multiple Choice">
<input type="radio" name="QuestionIsHidden" value="Hidden">Hide<br>
<input type="radio" name="QuestionIsHidden" value="Shown">Show<br>
Add the options here:<br>
<br>




<?php
$host = 'localhost:3306';
$user = 'root';
$pass = '19Chem96';
$db = 'user_test';

$con = mysqli_connect($host, $user, $pass, $db);
if($con)
	echo 'connected successfully to user_test database this time around<BR>';
//////////////////////////////////////////////////////////////////////
//Questions Table Handling
//Statement ID IsHidden(1 for no,2 for yes) Type(1 - open-response, 2 - multiple choice)
//just variables to hold the item I will use to identified the field to be changed.
$numberOfOptions = intval($_POST["numberOfOptions"]);
echo '<input type="hidden" name="numberOfOptions" value="'.$numberOfOptions.'">';
$optionsArray = new SplFixedArray($numberOfOptions); 
$alphabetArray = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
for($i = 0; $i < $numberOfOptions; $i++)
{
    echo $alphabetArray[$i].':<input type="text" name="NewQuestionOption'.$alphabetArray[$i].'"><br>';
}

echo '<button class="button" type="submit" value="Save">Save</button>';
echo '</form>';
echo '<form action="Home.php">';
echo '<button type="submit" class="button" onclick="Home.php">Cancel</button>';
echo '</form>';


//$questionStatement = "This is the default question statement";
//These to get the data from a doctor's new Question Entry

//queries to perfom different functions on the table: Question
//$getHighestIDQuery = "SELECT MAX(`QuestionID`) AS HighestID FROM `questions`";
//$ID = mysqli_query($con, $getHighestIDQuery);//returns a mysqli_result object
//$obj = mysqli_fetch_object($ID);		 //fetches the next field of the msqli_result object
//$questionID = intval($obj->HighestID) + 1;	 //gets the value of "HighestID", a column in the field, and stores it in questionID

//echo "{$questionID}<br>";				//I only used these to check whether I was geting the correct values from the form
//echo "{$questionStatement}<br>";
//echo "{$questionIsHidden}<br>";
//echo "{$questionType}<br>";

//to insert an entirely new question
/*
$sqlInsertNewQuestionQuery = "INSERT INTO `questions` (`Statement`, `Type`, `QuestionID`, `IsHidden`) VALUES ('{$questionStatement}', '{$questionType}','{$questionID}', '{$questionIsHidden}')";

//to update the value of a question identified by  ID
$sqlUpdateQuestionStatementQuery = "UPDATE `questions` SET `questionStatement` = '{$questionStatement}' WHERE `QuestionID` =  '{$questionID}'";

//to delete an question identified by its ID or Statement
$sqlDeleteQuestionQuery = "DELETE FROM `questions` WHERE `QuestionID` = '{$questionID}'";
$sqlDeleteQuestionByStatementQuery = "DELETE FROM `questions` WHERE `QuestinStatement` = {$QuestionStatement}";
//////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////
//Options Table Handling 


//just variables to hold the item I will use to identified the field to be changed.
$optionRelatedQuestionID = 0;
$optionOptionID = 1;
$optionOptionAlphabet = 'A';
$optionOptionValue = 'Default Option Data';

//queries to perfom different functions on the table: Options

//to insert an entirely new option
$sqlInsertNewOptionQuery = "INSERT INTO `options`(`RelatedQuestionID`, `OptionID`, `OptionAlphabet`, `OptionValue`) VALUES ('{$optionRelatedQuestionID}', '{$optionOptionID}','{$optionOptionAlphabet}', '{$optionOptionValue}')";

//to update the value of an option identified by alphabet or ID
$sqlUpdateOptionValueQueryByAlphabet = "UPDATE `options` SET `OptionValue` = '{$optionOptionValue}' WHERE `OptionAlphabet` =  '{$optionOptionAlphabet}'";
$sqlUpdateOptionValueQueryByOptionID = "UPDATE `options` SET `OptionValue` = '{$optionOptionValue}' WHERE `optionOptionID` =  '{$optionOptionID}'";

//to delete an option identified by its alphabet or by its value
$sqlDelelteOptionByOptionAlphabetQuery = "DELETE FROM `options` WHERE `OptionAlphabet` = '{$optionOptionAlphabet}'";
$sqlDelelteOptionByOptionValueQuery = "DELETE FROM `options` WHERE `OptionValue` = '{$optionOptionValue}'";
*/
////////////////////////////////////////////////////////////////////////
/*$query = mysqli_query($con, $sqlInsertNewQuestionQuery);
if($query){
	echo 'database altered successfully';
}else {
	//echo $sqlUpdateOptionValueQuery;
	echo "nope!query was not successful<BR>";
}*/


/*
function required()  
{  
var emptA = document.forms["NewQuestionForm"]["NewQuestionOptionA"].value;  
var emptB = document.forms["NewQuestionForm"]["NewQuestionOptionB"].value;
var emptC = document.forms["NewQuestionForm"]["NewQuestionOptionC"].value;  
var emptD = document.forms["NewQuestionForm"]["NewQuestionOptionD"].value;
var emptE = document.forms["NewQuestionForm"]["NewQuestionOptionE"].value;  
var emptF = document.forms["NewQuestionForm"]["NewQuestionOptionF"].value;
if (emptA == "")  
{  
alert("Please input a Value");  
return false;  
}   
if (emptB == "")  
{  
alert("Please input a Value");  
return false;  
}  
if (emptC == "")  
{  
alert("Please input a Value");  
return false;  
}   
if (emptD == "")  
{  
alert("Please input a Value");  
return false;  
}  
if (emptE == "")  
{  
alert("Please input a Value");  
return false;  
}   
if (emptF == "")  
{  
alert("Please input a Value");  
return false;  
}  
else   
{  
alert('Code has accepted : you can try another');  
return true;   
}  
}  
</script>

*/
?>
</body>
</html>