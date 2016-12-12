<!DOCTYPE html>
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
$username = 'root';
$pass = '19Chem96';
$host = 'localhost:3306';
$db = 'user_test';

$con = mysqli_connect($host, $username, $pass, $db);
$questionID = $_POST["QuestionID"];
$getQuestionQuery = "SELECT * FROM `questions` WHERE `QuestionID` = $questionID";
$question = mysqli_query($con, $getQuestionQuery);
$questionResult = mysqli_fetch_assoc($question);
$oldStatement = $questionResult["Statement"];

$getDetailsQuery = "SELECT * FROM `slider details` WHERE `RelatedQuestionID` = $questionID";
$details = mysqli_query($con, $getQuestionQuery);
$detailsResult = mysqli_fetch_assoc($question);
$stepValue = $detailsResult["stepValue"];
$number_of_choices = $detailsResult["number_of_choices"];


include 'MakeRangesEdit.php';
echo'

<form id="sliderQuestionForm" action="EditSlidingQuestionConfirmationPage.php" method="post">
<input type="hidden" name="QuestionID" value="'.$questionID.'">
<input type="hidden" name="QuestionType" value="Sliding Question" style="display:inline-block">
<input type="hidden" name="number_of_options" value="'.$number_of_choices.'" id="number_of_choices">
<h3>
Edit the Question Statement
</h3>

<input type="text" value="'.$oldStatement.'" name="QuestionStatement"><p></p>
<input style="display:inline-block" type="radio" name="RangeType" id="SingleType" value="SingleValues">Single Values<br>
<input style="display:inline-block" type="radio" name="RangeType" id="RangeType" value="RangeValues">Range Values<br>
<input type="hidden" name="RangeTypePost" id="RangeTypePost">

<br><br>

<input type="radio" name="QuestionIsHidden" value="Hidden">Make Hidden<br>
<input type="radio" name="QuestionIsHidden" value="Shown">Make Visible<br>';

echo '<h1>Change the details of the question below</h1>';


echo '<div id="RangesDiv" style="width:90%">
<input type="text" placeholder="Min" name="SliderMin" id="MinSlider" style="vertical-align:middle">
<input type="text" placeholder="Max" name="SliderMax" id="MaxSlider" style="vertical-align:middle">
<input type="text" placeholder="Number of Intervals" name="Options" id="Intervals" style="vertical-align:middle">
<input type="hidden" name="StepValue" id="StepValue" value="">
<p> </p>
<myDiv id="RangesSubDiv">';
if(intval($stepValue) == 0)
{
  $getRangesQuery = "SELECT * FROM `slider_options` WHERE `RelatedQuestionID` = $questionID";
  $ranges = mysqli_query($con, $getRangesQuery);
  $numberOfOptions = mysqli_num_rows($ranges);
  while($numberOfOptions > 0)
  {
    $id_and_name = (string)($numberOfOptions + 1);
    $range = mysqli_fetch_assoc($ranges);
    echo '<input type="text" id="stopInterval'.$id_and_name.'" name="'.$id_and_name.'" value="'.$range["Value"].'"><br>';
    $numberOfOptions--;
  }
}
echo'
</myDiv>
</div>

<br><p>Specify precision:</p>
<input id="precision" placeholder="e.g. 1, 0.1, 0.01" type="text">
<p><br></p>

<h3><br>Click here to put in intervals:</h3>
<input type="button" class="button" onClick="javascript:makeChoices()" value="Click to add Intervals" id="addIntervalsButton">

<button type="submit" class="button" onClick="javascript:showElement()">Submit Changes</button>
</form>';

?>


</body>
</html>