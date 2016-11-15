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
<body>
<?php

echo '<form action="AddMultipleChoicePage.php" method="post">';
echo "How many options will this question have?";
echo '<input type=text name="numberOfOptions">';
echo '<button class="button" type ="submit">Submit</button>';
echo'<input type="hidden" value="MultipleChoice" name="QuestionType">';
echo '</form>';
?>

</body>
</html>