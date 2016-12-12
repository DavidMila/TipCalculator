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
//details to gain access to database
$host = 'localhost:3306';
$user = 'root';
$pass = '19Chem96';
$db = 'user_test';
$con = mysqli_connect($host, $user, $pass, $db);

$questionID = intval($_POST["QuestionID"]);
$questionStatement = $_POST["QuestionStatement"];
$questionIsHidden = $_POST["QuestionIsHidden"];
$questionType = $_POST["QuestionType"];

echo $questionStatement.'<br>';
//queries on the table: Question
$changeStatementQuery = "UPDATE `questions` SET `Statement` = '$questionStatement' WHERE `QuestionID` = $questionID";
//$changeStatementQuery = mysqli_real_escape_string($changeStatementQuery);
echo 'The query should be here-> '.$changeStatementQuery.' <-The query should beb here<br>';
$changeStatementCommand = mysqli_query($con, $changeStatementQuery);//returns a mysqli_result object
echo "Question Query Problem--->".mysqli_error($con).'<br>';

$questionStatement = mysqli_real_escape_string($con, $questionStatement);

if(true)
{
	$questionType = 3;
	$sliderMin = $_POST["SliderMin"];
	$sliderMax = $_POST["SliderMax"];
	$intervals = $_POST["Ranges"];
	$stepvalue = intval($_POST["StepValue"]);
	echo '<br>The step value is: '.$stepvalue.'<br>';
	$intervals = intval($intervals);
	if ($questionIsHidden === "Hidden")
	{
		$hiddentype = 2;	
	}
	else
	{
		$hiddentype = 1;
	}
	
	//then insert slider query details: min and max values
	$updateSliderQuery = "UPDATE `slider details` SET `minValue` = $sliderMin, `maxValue` = $sliderMax, `StepValue` = $stepvalue, `number_of_choices` = $intervals WHERE `RelatedQuestionID` = $questionID";
	$sliderQuery = mysqli_query($con, $updateSliderQuery);

	echo "Problem Updating Slider Details-->> ".mysqli_error($con).'<br>';



	//delete old slider_options
	$deleteOldOptionsQuery = "DELETE FROM `slider_options` WHERE `RelatedQuestionID` = $questionID";
	$deleteCommand = mysqli_query($con, $deleteOldOptionsQuery);
	echo "Problem deleting old slider_options --->".mysqli_error($con);

	//stepvalue 0 means no need to store step values because users have entered their own specific values
	if($stepvalue == 0)
	{
		//handling slider options(different ranges)
		$getHighestRangeIdQuery = "SELECT MAX(`RangeID`) AS HighestID FROM `slider_options`";
	
		//get the highest ID of the ranges that are currently in the table
		$highestRangeID = mysqli_query($con, $getHighestRangeIdQuery);
		$obj = mysqli_fetch_object($highestRangeID);		

		//we will being to insert with Ids greater than the current highest
		if($_POST["RangeTypePost"] == "RangeType")
		{		
			$currentRangeID = intval($obj->HighestID) + 1;
			for ($i = 0; $i < $intervals; $i++)
			{
				$index = (string)($i + 1);
				$tempStartPostName = $_POST["startInterval".($index)];
				$tempStopPostName = $_POST["stopInterval".($index)];
				$temp_interval_range = $tempStartPostName."-".$tempStopPostName;
				$insertRangesQuery = "INSERT INTO `slider_options` (`RelatedQuestionID`, `RangeID`, `Value`) VALUES ($questionID, $currentRangeID, '$temp_interval_range')";
				$insertRanges = mysqli_query($con, $insertRangesQuery);
				echo mysqli_error($con)."<br><-- Problem Inserting Slider Option";
				$currentRangeID++;
			}
		}
		else if($_POST["RangeTypePost"] == "SingleType")
		{
			$currentRangeID = intval($obj->HighestID) + 1;
			for ($i = 0; $i < $intervals; $i++)
			{
				$index = (string)($i + 1);
				echo $_POST["startInterval".$index];
				$tempStopPostName = $_POST["stopInterval".($index)];
				$temp_interval_range = $tempStopPostName;
				$insertRangesQuery = "INSERT INTO `slider_options` (`RelatedQuestionID`, `RangeID`, `Value`) VALUES ($questionID, $currentRangeID, '$temp_interval_range')";
				$insertRanges = mysqli_query($con, $insertRangesQuery);
				echo "Problem Inserting Slider Option -->>".mysqli_error($con);
				$currentRangeID++;
			}
		}
	}
}
function arrayIsEmpty($array, $num)
{
	$isEmpty = false;
	for($i = 0; $i < $num; $i++)
	{
		if (empty($array[$i]))
		{
			$isEmpty = true;
			return $isEmpty;
		}
	}
	return $isEmpty;
}
?>
<button class="button" type="submit" value="Go to HomePage.">Go to HomePage</button>
</form>
</body>
</html>