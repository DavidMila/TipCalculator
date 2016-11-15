<?php
 //echo "Fine";
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Allow-Methods: GET, POST, REQUEST');
//$con = mysqli_connect("localhost:3306", "root", "godiat2mi", "user_test");
$con = mysqli_connect("localhost:3306", "root", "19Chem96", 'user_test');
 //mysql_connect("localhost:3306", "root", "godiat2mi");
// mysql_select_db("test");


 if(isset($_GET['type']))
 {
    if($_GET['type'] == "get")
    {
         //$UserId = $_GET['UserId'];
         $QId= $_GET['QId'];
         //$CId= $_GET['CId'];

         //Create Query
         //$query= "INSERT INTO multichoice answers (UserId, QId, CId) VALUES ($UserId, $QId, $CId)";
         $query= "SELECT * FROM `Questions` WHERE `QuestionID` = $QId AND IsHidden = 1";
         //Fire Query
         $result = mysqli_query($con, $query);
         //$totalRows = mysqli_num_rows($result);
         //Prepare Code for JSON Format
         if(mysqli_num_rows($result) > 0){
            $recipes = array();
            while($recipe= mysqli_fetch_array($result, MYSQL_ASSOC)){
                $recipes[]= array('Question'=> $recipe);
            }
            $output = json_encode(array('Questions'=> $recipes));
              //$output = json_encode($result);
            echo $output;
            //echo "Good stuff";
         }
    }

     if($_GET['type'] == "getoptions")
        {
             //$UserId = $_GET['UserId'];
             $QId= $_GET['QId'];
             //$CId= $_GET['CId'];

             //Create Query
             //$query= "INSERT INTO multichoice answers (UserId, QId, CId) VALUES ($UserId, $QId, $CId)";
             $query= "SELECT * FROM `options` WHERE `RelatedQuestionID` = $QId";
             //Fire Query
             $result = mysqli_query($con, $query);
             //$totalRows = mysqli_num_rows($result);
             //Prepare Code for JSON Format
             if(mysqli_num_rows($result) > 0){
                $recipes = array();
                while($recipe= mysqli_fetch_array($result, MYSQL_ASSOC)){
                    $recipes[]= array('Option'=> $recipe);
                }
                $output = json_encode(array('Options'=> $recipes));
                  //$output = json_encode($result);
                echo $output;
                //echo "Good stuff";
             }
        }

     if($_GET['type'] == "getnumrows")
     {
          //$UserId = $_GET['UserId'];
          //$QId= $_GET['QId'];
          //$CId= $_GET['CId'];

          //Create Query
          //$query= "INSERT INTO multichoice answers (UserId, QId, CId) VALUES ($UserId, $QId, $CId)";
          //get all the Hidden questions
          $query= "SELECT * FROM questions WHERE IsHidden = 1";
          $result = mysqli_query($con, $query);

          $totalRowsDisplayed= mysqli_num_rows($result);
          //Get all questions
          $query2 = "SELECT * FROM questions";
          $result2 =  mysqli_query($con, $query2);
          if (!$result2) {
                 printf("error: %s\n", mysqli_error($con));
          } 
          $totalRows = mysqli_num_rows($result2);
          //Prepare for Json Output
          $arr1 = array('totalRows'=> $totalRows);
          $arr2 = array('RowsNotHidden'=>$totalRowsDisplayed);
          $arr = array($arr1, $arr2);
          $output= json_encode($arr);
          echo $output;
            //echo "Good stuff";
     }

 }

 ?>
