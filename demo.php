<?php

header('Access-Control-Allow-Origin: *');

//$con = mysqli_connect("localhost:3306", "root", "godiat2mi", "user_test");
$con = mysqli_connect("localhost:3306", "root", "19Chem96", "user_test");
if (!$con)
  {
    die('Could not connect: ' . mysqli_error());
  }

 //mysql_connect("localhost:3306", "root", "godiat2mi");
// mysql_select_db("test");
//if(isset($_REQUEST['type']))
if(isset($_REQUEST))
{

     //echo "yup here";
     //$data = json_decode(file_get_contents('php://input'), true);
     //var_dump($_POST);
     //$type = $data->type;
     $type = $_REQUEST['type'];
     if($type == "putopentext")
      {
//              $UserId = $data->UserId;
//               $QId= $data->QId;
//               $Text= $data->Text;

               $UserId = intval($_REQUEST['UserId']);
               $QId= intval($_REQUEST['QId']);
               $Text = mysqli_real_escape_string($con,$_REQUEST['Text']);
               //Create Query
               $dateAndTime = date('Y-m-d H:i:s');
               $query= "INSERT INTO `open response` (`User Number`, `QuestionID`, `Response`, `EntryDateTime`) VALUES ($UserId, $QId, '$Text', '$dateAndTime')";
               //Fire Query
               $result = mysqli_query($con, $query);
               if ( false===$result ) {
                 printf("error: %s\n", mysqli_error($con));
                 error_log("query unsuccessful: ".mysqli_error($con));
               }
               else {
                $output = json_encode($result);
                echo $output;
               }
                
       }

       if($type == "putmultichoice")
       {
//               $UserId = $data->UserId;
//               $QId= $data->QId;
//               $CId= $data->CId;

               $UserId = intval($_REQUEST['UserId']);
               $QId= intval($_REQUEST['QId']);
               $CId = intval($_REQUEST['CId']);
               if ($CId == 0)
               {
                error_log("no value was recieved for the selected options".$CId);
               }
               //Create Query
               $alphabets = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
               $selection = $alphabets[$CId - 1];
               $dateAndTime = date('Y-m-d H:i:s');
               $query= "INSERT INTO `selectedchoices` (`User Number`, `QuestionID`, `Selection`, `EntryDateTime`) VALUES ($UserId, $QId, '$selection', '$dateAndTime')";
               //Fire Query
               $result = mysqli_query($con, $query);
                //$result = mysqli_query($con, $query) or trigger_error(mysqli_error($con)." ".$query);
                if ( false===$result ) {
                  printf("error: %s\n", mysqli_error($con));
                }
                else {
                 $output = json_encode($result);
                 echo $output;
                }

                //echo "Good stuff";

       }

       if($type == "newsession")
              {
                      //Create Query
                      $query= "INSERT INTO `mobileusers` () VALUES ()";
                      //Fire Query
                      $result = mysqli_query($con, $query);
                      $last_id = mysqli_insert_id($con);
                       //$result = mysqli_query($con, $query) or trigger_error(mysqli_error($con)." ".$query);
                       if ( false===$result ) {
                         printf("error: %s\n", mysqli_error($con));
                       }
                       else {
                        $output = json_encode($last_id);
                        echo $output;
                       }

                       //echo "Good stuff";

              }
}
?>​ 
