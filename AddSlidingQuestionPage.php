<!DOCTYPE html>
<?php
include 'MakeRanges.php';
?>
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

<form id="sliderQuestionForm" action="AddQuestionConfirmationPage.php" method="post">
<input type="radio" name="QuestionIsHidden" value="Hidden">Hide<br>
<input type="radio" name="QuestionIsHidden" value="Shown">Show<br>
<input type="hidden" name="QuestionType" value="Sliding Question" style="display:inline-block">
<h3>
Please enter the statement of your new Question:
</h3>

<input type="text" placeholder="Statement" name="QuestionStatement">
<input style="display:inline-block" type="radio" name="RangeType" id="SingleType" value="SingleValues">Single Values<br>
<input style="display:inline-block" type="radio" name="RangeType" id="RangeType" value="RangeValues">Range Values<br>
<input type="hidden" name="RangeTypePost" id="RangeTypePost">

<h3>
Put the minimum and maximum range for the slider values:
</h3>

<div id="RangesDiv" style="width:90%">
<input type="text" placeholder="Min" name="SliderMin" id="MinSlider" style="vertical-align:middle">
<input type="text" placeholder="Max" name="SliderMax" id="MaxSlider" style="vertical-align:middle">
<input type="text" placeholder="Number of Intervals" name="Options" id="Intervals" style="vertical-align:middle">
<input type="hidden" name="StepValue" id="StepValue" value="">
<p> </p>
<myDiv id ="RangesSubDiv">
<input style="vertical-align:bottom" type="button" class="button" onClick="javascript:makeAllRangesActive()" value="Click to alter Intervals" id="addIntervalsButton">
</myDiv>
</div>

<br><p>Specify precision:</p>
<input id="precision" placeholder="e.g. 1, 0.1, 0.01" type="text">
<p><br></p>

<h3><br>Click here to put in intervals:</h3>
<input type="button" class="button" onClick="javascript:makeChoices()" value="Click to add Intervals" id="addIntervalsButton">

<button type="submit" class="button" onClick="javascript:showElement()">Submit Changes</button>
</form>

</body>
</html>