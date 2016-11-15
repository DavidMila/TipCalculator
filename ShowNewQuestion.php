<html>
<head>
<?php
if(!isset($_COOKIE["username"]))
{
    header("Location: LogInPage.php");
}
?>
</head>
<body>

<?php 
$newQuestionStatement = $_POST["QuestionStatement"];
$newQuestionType = $_POST["QuestionType"];
echo "You entered the new question: '{$newQuestionStatement}'.<br>";
if ($newQuestionType == "1")
{
	$type = "open-ended";
}else{
	$type = "multiple choice";
}
echo "Your new Question is {$type}.<br>";
echo "Thank you doctor! Have a nice Day!";

?>


<!--Your email address is: <?php echo $_POST["email"]; ?>-->

</body>
</html>