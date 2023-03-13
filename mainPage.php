<?php

        session_start();

?>

<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>mainPage</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Startup Factory</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">User Info</a></li>
                <li><a href="mainPage.html">MainPage</a></li>
                <li><a href="moneyTransferPage.html">TransferPage</a></li>
                <li><a href="profilePage.html">ProfilePage</a></li>
             

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span>Logout</a></li>
            </ul>
            <form class="navbar-form navbar-left" action="">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button style="background-color:#d9b3ff; color:black" type="submit" class="btn btn-default"><b>Submit</b></button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div style="text-align: center;" class="well well-lg"><h2>User Info</h2></div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th><?php  echo $_SESSION["username"] ?></th>
                <th>Deposit</th>
                <th>Withdrawal</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1.1.2020</td>
                <td>3000</td>
                <td>2000</td>
            </tr>
            <tr>
                <td>1.2.2020</td>
                <td>4000</td>
                <td>3000</td>
            </tr>
            <tr>
                <td>1.3.2020</td>
                <td>8000</td>
                <td>2000</td>
            </tr>
            </tbody>
        </table>
        <a style=color:#4d0099
           href="moneyTransferPage.html">For transfer money click here </a>
    </div>
    </body>
</html>