<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>TransferPage</title>
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
                <li class="active"><a href="#">Transfer Page</a></li>
                <li><a href="forum.php">Forum</a></li>
                <li><a href="profilePage.php">Profile Page</a></li>
            </ul>
            <form class="navbar-form navbar-left" action="">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button style="background-color:#d9b3ff; color:black" type="submit" class="btn btn-default"><b>Submit</b></button>
            </form>
        </div>
    </nav>



    <div style="border-style:solid;border-color: gainsboro" class="container" >
        <div class="row">
            <div style="text-align: center; background-color:#e7e6f5;" class="well well-lg"><h2>Transfer Money</h2></div>

            <div class="col-md-4"></div>
            <div class="col-md-4">
                    
                    
                <input id="field_sum" type="number" placeholder="Sum"<br><br>
                <input id="field_send" type="text"  placeholder="Send to"><br><br>
                <button id="btn_transfer" style="background-color:#d9b3ff; color:black" type="submit" class="btn btn-default"><strong>Transfer</strong></button>
                    
                <br>
             
                <div id="msg"></div>
             
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
        
        
        <script>
                    var worked = "";
            
                    $("#btn_transfer").click(function()
                    {
                       $.post("api.php",{"action":"transfer_money","data_send":$("#field_sum").val(),"to_user":$("#field_send").val()},function(data)
                       {
                          if (data.return == "transfer")
                          {
                              location.reload();
                              worked = "true";
                          }
                       }); 
                    });
            
            
                    if (worked == "true")
                    {
                        $("#msg").text("Transfer has made !")
                    }
            
        
        </script>
        
        
    </body>
</html>