<?php

session_start();




$servername = "127.0.0.1";  
$un = "root";  
$pd = "";
$db = new PDO("mysql:host=$servername;dbname=db_bank", $un, $pd);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$massage = "";

if (isset($_SESSION["username"]))
{
    header("Location: profilePage.php");
}

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


?>



<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>indexPage</title>
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
                <li class="active"><a href="#">Login Page</a></li>
                <li><a href="#">info</a></li>
                <li><a href="#">about</a></li>
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

    <div style="border-style:solid;border-color: gainsboro" class="container" >
        <div class="row">

            <div class="well well-lg"><h1 style="text-align: center;">Welcome To Startup Factory</h1></div>
            <div class="col-md-4"></div>
                <div class="col-md-4">


                    <form id="frm" action="#" method="post">
                        <div class="form-group">

                            <label>Username:</label>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <button style="background-color:#d9b3ff; color:black; display: block;margin-left: auto;margin-right:auto; width:50%" type="submit" class="btn btn-default btn btn-primary active"><strong>Submit</strong></button>

                            <br>
                           
                    
                    </form>
                    <div class="well">Don't have an account ? <button id="btn_register" style="background-color:#d9b3ff; color:black"  type="submit" class="btn btn-default btn btn-primary active"><strong>Sign up</strong></button></div>
                    <h6><?php echo $massage ?></h6>

        </div>
        <div class="col-md-4"></div>
    </div>
    </div>
        
        
        <script>
                        
            
            
            
                 $("#btn_register").click(function()
                 {
                        location.href = "registerPage.php";    
                 });
            
            
        
        </script>
        
        

        




    </body>
</html>
