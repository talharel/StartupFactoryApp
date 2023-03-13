<?php




session_start();
//////////////////////////// CONNECTION TO THE DATA BASE

$servername = "127.0.0.1";  
$un = "root";  
$pd = "";
$db = new PDO("mysql:host=$servername;dbname=db_bank", $un, $pd);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//////////////////////////// VARIABLES

$massage = "";



//////////////////////////// SECURITY

if (!isset($_SESSION["username"]))
{
    header("Location: index.php");
}


//////////////////////////// FUNCTIONS

if (isset($_POST["username"]) && isset($_POST["password"]))
{
    $conn = $db->prepare("SELECT * FROM users WHERE username=:username AND password=:password");
    $conn->execute(array(":username"=>$_POST["username"],":password"=>$_POST["password"]));
    
    if ($conn->rowCount())
   {
     $row = $conn->fetch();
     $_SESSION["username"] = $row['username'];
     $_SESSION["id"] = $row['id'];
     $_SESSION["email"] = $row['email'];
     $_SESSION["age"] = $row['age'];
     $_SESSION["total"] = $row['total'];
     header("Location: profilePage.php");
   }
    
    else
        {
            $massage = "<div class='alert alert-info'><strong>Info! </strong><strong>Username or password is incorrect, try again.</strong></div>";
        }
}

if (isset($_POST["searchProfile"]))
{
    $conn = $db->prepare("SELECT * FROM users WHERE username=:username");
    $conn->execute(array(":username"=>$_POST["username_to_see"]));
    
    if ($conn->rowCount())
{
     $row = $conn->fetch();;
     $_SESSION["other_user_name"] = $row['username'];
     $_SESSION["other_user_age"] = $row['age'];
     $_SESSION["other_user_email"] = $row['email'];
     $_SESSION["other_user_total"] = $row['total'];

     
     header("Location: userProfilePage.php");
}
    else
    {
        $massage = "<div class='alert alert-info'><strong>Info! </strong><strong>User not found please try again</strong></div>";
    }
}


?>



<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Forum</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>


    <body>
<!--NavBar-->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Startup Factory</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Forum</a></li>
                <li><a href="profilePage.php">Profile Page</a></li>
                <li><a href="transferPage.php">Transfer Page</a></li>
            </ul>
            
            
            <ul class="nav navbar-nav navbar-right">
                <li><a id="logout" href="#"><span class="glyphicon glyphicon-user"></span>Logout</a></li>
            </ul>
            
            <form class="navbar-form navbar-left" action="">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button style="background-color:#d9b3ff; color:black" type="submit" class="btn btn-default"><b>Submit</b></button>
            </form>
        </div>
    </nav>

<!-- Container -->

<div class="container" >
    <div class="row">

<div class="well well-lg" style ="background-color:#e7e6f5;"><h1 style="text-align: center;">Startup Factory Forum</h1></div>
            
            
            
<div class="col-md-3">
          
        <div class="panel panel-default">
                <div class="panel-heading">Account Info</div>
                <div class="panel-body" style="background-color:#d7f7e7;">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <p>
                                <kbd>Username:</kbd>
                                <span style="float:right;">
                             <?php echo  $_SESSION["username"]; ?>
                                </span>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <p>
                                <kbd>Total money to invest</kbd>
                                <span style="float:right;">
                                   <?php echo $_SESSION["total"];?>
                                </span>
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
             
    
    
            <div class="panel panel-default">
                <div class="panel-heading">Search User Profile</div>
                <div class="panel-body" style="background-color:#d7f7e7;">
                        <form action="forum.php" method="post">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="btn_searchProfile" type="text" class="form-control" name="username_to_see" placeholder="Type username">
                            <input id="" type="submit" class="form-control" name="searchProfile" value="Search user profile">
                          </div>
                            <?php echo $massage ?>
                        </form>
                </div>
            </div>
</div>
        
        
        <div class="col-md-9">
            

            <div class="panel panel-default">
                <div class="panel-heading">
                    Chat History
                </div>
                <div id="panel_body" class="panel-body" style="background-color:#e7e6f5;">
                    <ul class="list-group" id="post_history">
                    </ul>
                </div>
            </div>
            
            
                <div class="input-group">
                    <input id="msg" type="text" class="form-control" name="msg" placeholder="Write your message here...">
                    <input id="msg" type="hidden" id ="csrf" value="<?php $csrf_token ?>">
                    <span class="input-group-addon"><button id="btn_send">Send</button></span>
                </div>
                    

        </div>
    </div>
    </div>
        
        
        <script>
            
            
            $.post("api.php",{"action":"get_all_posts"},function(data)
            {
                if (data.return == "true")
                {   
                    $("#post_history").html(data.data);
                }
            });
            
            
        
            $("#logout").click(function()
                {
                   $.post("api.php",{"action":"logout"},function(data)
                   {
                        if (data.return == "logout")
                        {
                            location.href = "index.php";
                        }
                   }); 
                });
            
            
            
            $("#btn_send").click(function()
            {
                $.post("api.php",{"action":"send_post","data":$("#msg").val(),"csrf":$("#csrf").val()},function(data)
                {
                    if (data.return == "insert")
                    {
                        location.reload();
                    }
                    
                });    
            });
            
            
            
        
        </script>
        



    </body>
</html>
