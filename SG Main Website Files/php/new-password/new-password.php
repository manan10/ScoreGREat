<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" href="image/logo.png" type="image/icon type" style="width: max-content;">
        <title>Score GREat | New Password</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./../../lib/bootstrap.min.css">
        <script src="./../../lib/7aadfb7b53.js" crossorigin="anonymous"></script>
        <script src="./../../lib/jquery.min.js"></script>
        <script src="./../../lib/popper.min.js"></script>
        <script src="./../../lib/bootstrap.min.js"></script>
        <style>
            body {
                font-family: 'Raleway', sans-serif;
                /*font-size: 5vw;*/
                font-weight: 700;
            }

            .form-control {
                font-family: 'Raleway', sans-serif, 'FontAwesome';
                height: 50px !important;
            }
            
            label {
                font-size: larger;
            }
        </style>
    </head>

    <body class="" style="background-image: radial-gradient(#e6e600, #ff9900);">
        <div class="container" style="padding: 12% 0;">
            <div class="card mx-auto p-3 shadow-lg bg-light" style="width: 75%; border-radius: 7px;">
                <h2 class="font-weight-bold p-2 text-center">Enter New Password</h2>
                <form action="./new-password-db.php" method="POST">
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" placeholder="Password" id="pwd" name="pwd" required>
                    </div>
                    <div class="form-group">
                        <label for="cpwd">Confirm Password:</label>
                        <input type="password" class="form-control" placeholder="Confirm password" id="cpwd" name="cpwd" required>
                    </div>
                    <button type="submit" class="btn btn-secondary p-2 mt-3 mx-auto d-block" style="width: 30%; min-width: 100px">Submit</button>
                </form>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function(){
            $("#cpwd").blur(function(){
                if($("#pwd").val() !== $("#cpwd").val()){
                    alert("Password does not match!");
                }
            }); 
        });        
    </script>
</html>