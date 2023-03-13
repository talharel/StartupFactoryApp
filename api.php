<?php

session_start();



//////////////////////////////////// CONNECTIONS TO DATA BASE

$servername = "127.0.0.1";
$un = "root";
$pd = "";
$db = new PDO("mysql:host=$servername;dbname=db_bank", $un, $pd);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//////////////////////////////////// VARIABLES

$username = $_SESSION["username"];
$user_id = $_SESSION["id"];


if (isset($_POST["data"]))
{
    $data = htmlentities(htmlentities($_POST["data"]));
}


//////////////////////////////////// SECURITY
    
if (!isset($_SESSION["username"]))
{
    header("Location: index.php");
}


/////////////////////////////////// CSRF

$csrf_token = bin2hex(random_bytes(72));
$_SESSION['csrf'] = $csrf_token;


    

//////////////////////////////////// FUNCTIONS

header("Content-Type:application/json");

if (isset($_POST["action"]))
{


    if ($_POST["action"] == "logout")
      {
          session_destroy();
          echo '{"return":"logout"}';
      }


    if ($_POST["action"] == "send_post")
    {
        $conn = $db->prepare("INSERT INTO posts(user_id,username,post_data)VALUES(:id,:username,:data)");
        $conn->execute(array(":username"=>$username,":id"=>$user_id,":data"=>$data));
        echo '{"return":"insert"}';
    }



    if ($_POST["action"] == "get_all_posts")
    {

            $conn = $db->prepare("SELECT * FROM posts");
            $conn->execute();
            $retval = "";


            foreach($conn->fetchAll() as $row)
            {
                if ($row["user_id"] == $user_id)
                {
                        $retval = $retval."<div class='media'><div class='media-body text-right'><h4 class = 'media-heading'>".$username."</h4><p>".$row['post_data']."</p></div><div class='media-right'><img src='images/icon.png' class='media-object' style='width:60px'></div></div>";
                }
                else
                {
                        $retval = $retval."<div class='media'><div class='media-left'><img src='images/icon_forum.jpg' class='media-object' style='width:60px'></div><div class='media-body'><h4 class='media-heading'>".$row["username"]."</h4><p>".$row["post_data"]."</p></div></div>";
                }
            } 
            echo '{"return":"true","data":"'.$retval.'"}';
            die();
    }
        
        
    
    
    if ($_POST["action"] == "transfer_money")
    {
        //////////////////////////////////////// Addition to the user they sent to 
        
        $conn = $db->prepare("UPDATE users SET total = total + :transfer WHERE username = :username");
        $conn->execute(array(":transfer"=>$_POST["data_send"],":username"=>$_POST["to_user"]));
        
        //////////////////////////////////////// Subtraction to the sending user
        
        $conn = $db->prepare("UPDATE users SET total = total - :transfer WHERE username = :username");
        $conn->execute(array(":transfer"=>$_POST["data_send"],":username"=>$username));
        
        echo '{"return":"transfer"}';
    }
    
    
}

    if(isset($_GET["action"]))
    {
        if ($_GET["action"] == "edit_text_area")
        {                           
            $conn = $db->prepare("UPDATE users SET text_field = :text_field WHERE username = :username");
            $conn->execute(array(":username"=>$username,":text_field"=>$_GET["dataForEdit"]));
            echo '{"return":"true"}';
        }
        
        
        if ($_GET["action"] == "get_text_field")
        {
            $conn = $db->prepare("SELECT * FROM users WHERE username=:username");
            $conn->execute(array(":username"=>$username));
            
            if ($conn->rowCount())
                {
                     $row = $conn->fetch();
                     $text = $row['text_field'];
                }
            
            echo '{"return":"true","data":"'.$text.'"}';
        }
        
        
        if ($_GET['action'] == "get_other_user_text_field")
        {
            $other_user_name = $_SESSION["other_user_name"];
            $conn = $db->prepare("SELECT * FROM users WHERE username=:username");
            $conn->execute(array(":username"=>$other_user_name));
            
            if ($conn->rowCount())
                {
                     $row = $conn->fetch();
                     $user_text_field = $row['text_field'];
                }
            
            echo '{"return":"true","data":"'.$user_text_field.'"}';

        }
    }

    




  

?>