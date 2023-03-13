<?php




session_start();

$username = $_SESSION["username"];
$user_id = $_SESSION["id"];
$user_email = $_SESSION["email"];
$user_total = $_SESSION["total"];
$user_age = $_SESSION["age"];


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
                <li class="active"><a href="#">Profile Page</a></li>
                <li><a href="forum.php">Forum</a></li>
                <li><a href="transferPage.php">Transfer Page</a></li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <li><a id="logout" href="#"><span class="glyphicon glyphicon-user"></span>Logout</a></li>
            </ul>
            
            
            
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input id = "field_search" type="text" class="form-control" placeholder="Search" value="">
                </div>
                <button id="btn_search" style="background-color:#d9b3ff; color:black" type="submit" class="btn btn-default"><b>Submit</b></button>
            </form>
        </div>
    </nav>

    <div class="container" >
        <div class="row">
            <div style="text-align: center; background-color:#e7e6f5;" class="well well-lg"><h2><?php echo "Hello ".$username ?></h2></div>

            <div class="col-md-4"></div>
            <div class="col-md-4">
                <ul class="list-group">
                    <li class="list-group-item">Username<span class="badge"><?php echo $username ?></span></li>
                    <li class="list-group-item">Id<span class="badge"><?php echo $user_id ?></span></li>
                    <li class="list-group-item">Age<span class="badge"><?php echo $user_age ?></span></li>
                    <li class="list-group-item">Email<span class="badge"><?php echo $user_email ?></span></li>
                    <li class="list-group-item">Total<span class="badge"><?php echo $user_total ?></span></li>
                </ul>
                


            </div>

            <div class="col-md-4">  <img style="min:50%;" src="\bankSite\Bank_Site\images\icon.png"></div>
        </div>
    </div>


            <center>         
            <h2>My Start Up</h2>
            <textarea id="textarea" name="w3review" rows="4" cols="150"></textarea>
              <br><br>
              <input id="btn_edit_text_area" type="submit" value="Edit">
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
        
        
                $("#btn_edit_text_area").click(function()
                {
                  $.get("api.php",{"action":"edit_text_area","dataForEdit":$("#textarea").val()},function(data)
                  {
                      if (data.return == "true")
                      {
                        location.reload();
                      }
                  });
                });
        
        
        
            $.get("api.php",{"action":"get_text_field"},function(data)
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