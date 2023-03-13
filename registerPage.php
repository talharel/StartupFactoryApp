<?php

session_start();

$servername = "127.0.0.1"; 
$un = "root";
$pd = "";
$db = new PDO("mysql:host=$servername;dbname=db_bank", $un, $pd);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$massage = "";
$error = "false";

if (isset($_POST["submit"]))
{

    
    if (empty($_POST["username"]))
    {
        $massage = "<div class='alert alert-info'><strong>Info! </strong>All the fields are required.</div>";
        $error = "true";
    }
    
    if (empty($_POST["email"] ))
    {
        $massage = "<div class='alert alert-info'><strong>Info! </strong>All the fields are required.</div>";
        $error = "true";
    }
    
    
    if (empty($_POST["age"] ))
    {
        $massage = "<div class='alert alert-info'><strong>Info! </strong>All the fields are required.</div>";
        $error = "true";
    }
    
    if (empty($_POST["total"] ))
    {
        $massage = "<div class='alert alert-info'><strong>Info! </strong>All the fields are required.</div>";
        $error = "true";
    }

    
    if ($_POST["password"] != $_POST["password2"])
      {
          $massage = "<div class='alert alert-info'><strong>Info! </strong> Passwords are not equal, please try again.</div>";
          $error = "true";
      }
       
      $conn = $db->prepare("SELECT * FROM users WHERE username=:username");
      $conn->execute(array(":username"=>$_POST["username"]));
      
      if ($conn->rowCount())
      {
        $massage = "<div class='alert alert-info'><strong>Info! </strong> Username is not available, please try another.</div>";
        $error = "true";

      }
    
    
    
    
    
    if ($error == "false")
     {
        $conn = $db->prepare("INSERT INTO users(username,password,age,email,total)VALUES(:username,:password,:age,:email,:total)");
        $conn->execute(array(":username"=>$_POST["username"],":password"=>$_POST["password"],":age"=>$_POST["age"],":email"=>$_POST["email"],":total"=>$_POST["total"]));
        header("Location: index.php");
      }
}   



?>

<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Register Page</title>
        <meta name="description" content="">
<!--        <link rel="stylesheet" href="main.css">-->
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
                <li class="active"><a href="#">Home</a></li>
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

            <div class="well well-lg"><h1 style="text-align: center;">Registration</h1></div>
            <div class="col-md-4"></div>
                <div class="col-md-4">

                        <?php echo $massage ?>
                        <div id ="msg"></div>
                    
                        <form action="#" method="post">

                        <div class="form-group">
                            <label>Username</label>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" class="form-control" id="username_field" placeholder="Username" name="username">
                        </div>
                    
                        <div class="form-group">
                            <label>Money for invest (withdrawal from the bank)</label>
                            <span class="input-group-addon"><i><strong>$</strong></i></span>
                            <input type="text" name="total" class="form-control" id="invest_field" placeholder="Only numbers">
                        </div>
                    
                     
                        <div class="form-group">
                            <label>Age</label>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input type="text" name="age" class="form-control" id="age_field" placeholder="Age">
                        </div>
                    
                    
                         <div class="form-group">
                            <label>Email</label>
                            <span class="input-group-addon"><i>@</i></span>
                            <input type="email" name="email" class="form-control" id="email_field" placeholder="Email">
                        </div>
                    
                           <div class="form-group">
                            <label for="pwd">Password:</label>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control" id="pwd1_field" placeholder="Password" name="password">
                        </div>
                                      
                        <div class="form-group">
                            <label for="pwd">Verify Password:</label>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input type="password" class="form-control" id="pwd2_field" placeholder="Verify password" name="password2">
                        </div>
                        
                            
                        <button id="btn_register" name="submit" style="background-color:#d9b3ff; color:black;  display: block;margin-left: auto;margin-right:auto; width:50%"  type="submit" class="btn btn-default btn btn-primary active"><h4><strong>Register</strong></h4></button>
                    
                        <br>
                        <br>
                    
                    </form>
                             

        </div>
                        
        <div class="col-md-4"></div>

    </div>
    </div>
        
        
        


    </body>
</html>
