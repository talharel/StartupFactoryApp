<?php


session_start();

$other_user_name = $_SESSION["other_user_name"];
$other_user_age = $_SESSION["other_user_age"];
$other_user_email = $_SESSION["other_user_email"];
$other_user_total = $_SESSION["other_user_total"];


if (!isset($_SESSION["username"]))
{
    header("Location: index.php");
}


?>


<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>profilePage</title>
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
                <li class="active"><a href="#"><?php echo $other_user_name."'s profile" ?></a></li>
                <li class="active"><a href="profilePage.php">Profile Page</a></li>
                <li><a href="forum.php">Forum</a></li>
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

    <div class="container" >
        <div class="row">
            <div style="text-align: center;" class="well well-lg"><h2><?php echo "This is ".$other_user_name ?></h2></div>

            <div class="col-md-4"></div>
            <div class="col-md-4">
                <ul class="list-group">
                    <li class="list-group-item">Username<span class="badge"><?php echo $other_user_name ?></span></li>
                    <li class="list-group-item">Age<span class="badge"><?php echo $other_user_age ?></span></li>
                    <li class="list-group-item">Email<span class="badge"><?php echo $other_user_email ?></span></li>
                    <li class="list-group-item">Total<span class="badge"><?php echo $other_user_total ?></span></li>
                </ul>
                

            </div>

            <div class="col-md-4">  <img style="min:50%;" src="\bankSite\Bank_Site\images\icon.png"></div>
        </div>
    </div>
        
            <center>         
            <h2><?php echo $other_user_name.' StartUp' ?></h2>
            <textarea id="textarea" name="w3review" rows="4" cols="150"></textarea>
            </center>
        
        
    <script>
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
        
     
            $.get("api.php",{"action":"get_other_user_text_field"},function(data)
            {
                if (data.return == "true")
                {   
                    $("#textarea").html(data.data);
                }
            });
        
        
        
    </script>
        
        
    <style> 
    #textarea 
    {
      background-color: #e7e6f5;
      padding: 15px;
      background-size: 50px, 130px, auto;
    }
    </style>



    </body>
</html>