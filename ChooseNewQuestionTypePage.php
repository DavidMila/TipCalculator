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
<?php 
echo '<h3>Please select the type of Question</h3><br>';
echo'<form action="PickNumberOfOptionsPage.php">';
echo '<button class="button" type="submit" onclick="PickNumnerOfOptionsPage.php" value="Multiple Choice">Multiple Choice</button>';
echo '</form>';
echo '<form action="AddOpenResponsePage.php">';
echo '<button class="button" type="submit" value="Open Response">Open Response</button>';
echo '</form>';
?>
<form action="Home.php">
<button class="button" type="submit" onclick="Home.php">Cancel</button>
</form>
</body>
</html>