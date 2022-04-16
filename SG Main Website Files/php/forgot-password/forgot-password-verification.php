<?php 
    session_start();    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" href="image/logo.png" type="image/icon type" style="width: max-content;">
        <title>Score GREat | Forgot Password Verification</title>
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
                font-size: 1.5vw;
                font-weight: 700;
            }

            .form-control {
                font-family: 'Raleway', sans-serif, 'FontAwesome';
                height: 50px !important;
            }
        </style>
    </head>

    <body class="" style="background-image: radial-gradient(#e6e600, #ff9900);">
        <div class="container" style="padding: 12% 0;">
            <div class="card mx-auto p-3 shadow-lg bg-light" style="width: 35%; min-width: 240px; border-radius: 7px;">
                <h2 class="font-weight-bold p-2 text-center">OTP Verification</h2>
                <form action="./verify-otp.php" method="POST">
                    <input type="text" class="form-control p-2" id="otp" name="otp" placeholder="Enter OTP here" pattern="^[0-9]{6}$" required>
                    <button type="submit" class="btn btn-secondary p-2 mt-3 mx-auto d-block" style="width: 30%; min-width: 100px">Submit</button>
                </form>
            </div>
        </div>
    </body>
    
    <script>
        $(document).ready(function(){
           
        });        
    </script>
</html>

