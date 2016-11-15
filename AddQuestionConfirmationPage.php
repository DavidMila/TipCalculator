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

$questionStatement = $_POST["QuestionStatement"];
$questionIsHidden = $_POST["QuestionIsHidden"];
$questionType = $_POST["QuestionType"];

//queries on the table: Question
$getHighestIDQuery = "SELECT MAX(`QuestionID`) AS HighestID FROM `questions`";
$ID = mysqli_query($con, $getHighestIDQuery);//returns a mysqli_result object
$obj = mysqli_fetch_object($ID);		 //fetches the next field of the msqli_result object
$questionID = intval($obj->HighestID) + 1;	 //gets the value of "HighestID", a column in the field, and stores it in questionID
$questionStatement = mysqli_real_escape_string($con, $questionStatement);
if ($questionType == "Multiple Choice")
{
	$numberOfOptions = intval($_POST["numberOfOptions"]);
	if ($questionIsHidden === "Hidden")
	{
		$hiddentype = 2;	
	}
	else
	{
		$hiddentype = 1;
	}
	$sqlInsertNewQuestionQuery = "INSERT INTO `questions` (`Statement`, `Type`, `QuestionID`, `IsHidden`) VALUES ('$questionStatement', 2, $questionID, $hiddentype)";
	$arrayOfAlphabets = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
	
	//for some reason receiving these posts before conducting the above query made the questionQuery variable turn false so I did them below
	$arrayOfOptions= new SplFixedArray($numberOfOptions);
	for ($i = 0; $i < $numberOfOptions; $i++)
	{
		$arrayOfOptions[$i] = $_POST["NewQuestionOption".$arrayOfAlphabets[$i]];
	}
	if(!arrayIsEmpty($arrayOfOptions, $numberOfOptions))
	{
		$questionQuery = mysqli_query($con, $sqlInsertNewQuestionQuery);
		echo mysqli_error($con).'<br>';
		
		$tempCounter = 0;
		$getHighestOptionIDQuery = "SELECT MAX(`OptionID`) AS HighestOptionID FROM `options`";
		$OptionID = mysqli_query($con, $getHighestOptionIDQuery);//returns a mysqli_result object
		$optionObject = mysqli_fetch_object($OptionID);		 //fetches the next field of the msqli_result object
		$finalOptionID = intval($optionObject->HighestOptionID) + 1;	 //gets the value of "HighestOptionID", a column in the field, and stores it in finalOptionID

		//labels for the options
		
		echo $numberOfOptions;
		while ($tempCounter < $numberOfOptions)//because we anticipate no more than 6 options per qurstion
		{
			if($arrayOfOptions[$tempCounter] != "")
			{
				$sqlInsertNewOptionQuery = "INSERT INTO `options`(`RelatedQuestionID`, `OptionID`, `OptionAlphabet`, `OptionValue`) VALUES ($questionID, '$finalOptionID','$arrayOfAlphabets[$tempCounter]', '$arrayOfOptions[$tempCounter]')";
				$optionQueryCommand = mysqli_query($con, $sqlInsertNewOptionQuery);//insert the option into the table
				$finalOptionID++;//give the next option a new ID
				if($optionQueryCommand)
					echo "Your new Options was saved!<br>";
				else
					echo "We are sorry but there was a problem storing your new question<br>";
			}
			$tempCounter++;
		}
	}
	else 
	{
		echo "Array of options was empty";
	}
}
else if($questionType == "Open Response")
{
	$questionType = 1;
	echo "'".$questionIsHidden."'";
	if ($questionIsHidden === "Hidden")
	{
		$hiddentype = 2;
		
	}
	else
	{
		$hiddentype = 1;
	}
	$sqlInsertNewQuestionQuery = "INSERT INTO `questions` (`Statement`, `Type`, `QuestionID`, `IsHidden`) VALUES ('$questionStatement', $questionType, $questionID, $hiddentype)";
	$questionQuery = mysqli_query($con, $sqlInsertNewQuestionQuery);
	if($questionQuery)
	{
		echo "New Question was succesfully saved<br>";
	}
	else
	{
		echo mysqli_error($con)."<br>";
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