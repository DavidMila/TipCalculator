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

<form action="AddQuestionConfirmationPage.php" method="post">
<input type="hidden" name="QuestionType" value="Open Response">
<input type="radio" name="QuestionIsHidden" value="Hidden">Hide Question<br>
<input type="radio" name="QuestionIsHidden" value="Shown">Show Question<br>
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

<h3>Please enter your new Question</h3><br>
<input type="text" name="QuestionStatement">
<button class="button" type="submit">Save</button>
</form>
<form action="Home.php">
<button class="button" type="submit" onclick="Home.php">Cancel</button>
</form>

</body>
</html>