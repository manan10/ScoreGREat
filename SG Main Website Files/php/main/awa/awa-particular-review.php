<?php 
    session_start();
    if(!isset($_SESSION['email']))
        header('Location: ./../../../index.html');
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" href="./../../../image/logo.png" type="image/icon type" style="width: max-content;">
        <title>Score GREat | AWA Review</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Raleway|Kaushan+Script|Teko|Source+Serif+Pro|Slabo+27px&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./../../../lib/bootstrap.min.css">
        <script src="./../../../lib/7aadfb7b53.js" crossorigin="anonymous"></script>
        <script src="./../../../lib/jquery.min.js"></script>
        <script src="./../../../lib/popper.min.js"></script>
        <script src="./../../../lib/bootstrap.min.js"></script>
        <style>
            body {
                font-family: 'Raleway', sans-serif;
                font-size: large;
                font-weight: 700;
                background-color: rgba(228, 228, 228, 0.4);
            }

            nav {
                background-image: linear-gradient(to right, #e6e600, #ffa31a); 
            }
            
            nav > a > span {
            	font-family: 'Kaushan Script', cursive;
            	font-weight: 550;
            	font-size: x-large;
            }

            a, a:hover {
                color: black;
            }
            
            .number{
                font-family: Source Serif Pro;
            }
            
            .dropdown-menu {
                background-color: rgba(0, 0, 0, 0.8);
            }
            
            .dropdown-menu > a {
                color: white;
            }
            
            #que-box {
                /*background-color: #8cff66;*/
                background-color:#717171;
                color:white;
                /*border-radius: 5px;*/
                border: 0;
                /*position: absolute;*/
            }
            
             #pro-pic-in{
                width:50px;
                height:50px;
            }
            
            .review-card:hover {
                text-decoration: none;
            }
            
            input[type='radio'] {
                display: none;
            }

            .stars {
                float: left;
            }

            .stars label {
                color: silver;
                float: right;
                font-size: larger;
            }

            label:hover{
                cursor: pointer;
            }

            .stars > input:checked ~ label,
            .stars:not(:checked) > label:hover,
            .stars:not(:checked) > label:hover ~ label { 
                color: black;  
            }

            .stars > input:checked + label:hover,
            .stars > input:checked ~ label:hover,
            .stars > label:hover ~ input:checked ~ label,
            .stars > input:checked ~ label:hover ~ label {
                color: #282828;
            }
            
            #btn-top {
                border-radius: 50%;
                position: fixed;
                bottom: 15px;
                right: 15px;
            }

            @media screen and (min-width: 768px) {
                li > a:hover, li > .active, .dropdown-item:hover {
                    background-color: black;
                    color: white;
                    border-radius: 5px;
                }
            }
            
            @media screen and (max-width: 767px) {
                li {
                    width: 100%;
                }
            }
        </style>
    </head>

    <body class="bg-light">
        <nav class="navbar navbar-expand-md shadow sticky-top" style="width: 100%;">
            <a class="navbar-brand ml-2 mr-auto" href="./../dashboard.php">
                <img src="./../../../image/logo.png" alt="Logo" style="width:45px;"><span class="mx-2">Score GREat</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <i class='fas fa-ellipsis-v' style="font-size:24px"></i>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Menu</a>
                            <div class="dropdown-menu toggler" style="font-size: large; font-weight: 500; margin-left: 0 !important; margin-right: 0 !important">
                                <a class="dropdown-item" href="./../dashboard.php">Dashboard</a>
                                <a class="dropdown-item" href="awa.php">AWA Home</a>
                                <a class="dropdown-item" href="./../practice/practice-dashboard.php">Practice</a>
                                <a class="dropdown-item" href="./../mock-test/mt-dashboard.php">Mock Test</a>
                                <a class="dropdown-item" href="./../public-discussion/public-discussion.php">Public Discussion</a>
                                <a class="dropdown-item" href="./../multiplayer-games/mg-dashboard.php">Multiplayer Games</a>
                                <a class="dropdown-item" href="./../saved-notes/saved-notes.php">Saved Notes</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item"> 
                        <div class="dropdown">
                            <a class="nav-link" href="#" id="navbardrop" data-toggle="dropdown">
                                <span class="ml-2">
                                    <?php echo $_SESSION['name']; ?>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right toggler" style="font-size: large; font-weight: 500; margin-left: 0 !important; margin-right: 0 !important">
                                <a class="dropdown-item" href="./../my-profile/my-profile.php"><i class='fas fa-user-circle pr-2'></i>My Profile</a>
                                <a class="dropdown-item" href="./../../logout.php"><i class='fas fa-sign-out-alt pr-2'></i> Log Out</a>
                            </div>
                        </div>
                    </li>  
                </ul>
            </div>   
        </nav>
        
         <div class="sticky-top shadow" style='z-index: ;' id='que'>
            <?php 
                $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                $stmt = $con->prepare("SELECT * FROM scoregreat.awa WHERE id=:ID");
                $stmt->bindParam(":ID", $_COOKIE['id'], PDO::PARAM_INT);
                $stmt->execute();
                $row = $stmt->fetch();
                
                echo "<div id='que-box' class='row p-2'  style=''>
                        <div class='col-4 col-sm-4 col-md-2 col-lg-2'>
                           <a href='awa-review.php' class='btn btn-outline-secondary mt-2' style='color:white;border-color:white;'><i class='fas fa-angle-left' aria-hidden='true'></i>&nbsp;&nbsp;Back to topic</a>
                        </div>
                        <div class='col-8 col-sm-8 col-md-10 col-lg-10'>
                            <div class=''>  " . $row['ques'] . "</div>
                        </div>
                    </div>";
            
                // echo "<div id='que-box' class='p-4' style='min-height: 71px;'>" . $row['ques'] . "</div>";
            ?>
        </div>
        
        <div class="container my-4 text-center">
            <?php
                $stmt = $con->prepare("SELECT * FROM scoregreat.awa_data WHERE awaid=:ID;");
                $stmt->bindParam(":ID", $_COOKIE['c-row'], PDO::PARAM_INT);
                $stmt->execute();
                $row = $stmt->fetch();
                $cmnts = json_decode($row['comments']);
                
              
                echo "<div class='card shadow-lg mb-2 text-left review-card'>
                        <div class='card-header bg-dark d-flex' style='color:white'>
                            <img src='". $_GET['propic']."' id='pro-pic-in' class='rounded-circle' alt='User Profile Picture'>
                            <span class='ml-2'>
                                <div style='font-size: large'>" . $row['username'] . "</div>
                                <div style='font-size: small'>" . $row['email'] . "</div>
                            </span> 
                        </div>
                        <div class='card-body'>
                            <span>" . nl2br($row['essay']) . "</span>
                        </div>
                        <div class='card-footer'>
                            <div class='float-right number' style='font-size: medium;'>
                                <span>" . $row['rating'] . " <i class='fas fa-star' style='font-size: larger;'></i></span> 
                            </div>
                            <div class='stars px-2'>
                                <input type='radio' id='star6' name='stars' value='6'>
                                <label for='star6' class='fas'>&#xf005;</label>
                                <input type='radio' id='star5' name='stars' value='5'>
                                <label for='star5' class='fas'>&#xf005;</label>
                                <input type='radio' id='star4' name='stars' value='4'>
                                <label for='star4' class='fas'>&#xf005;</label>
                                <input type='radio' id='star3' name='stars' value='3'>
                                <label for='star3' class='fas'>&#xf005;</label>
                                <input type='radio' id='star2' name='stars' value='2'>
                                <label for='star2' class='fas'>&#xf005;</label>
                                <input type='radio' id='star1' name='stars' value='1'>
                                <label for='star1' class='fas'>&#xf005;</label>
                            </div>
                            <hr class='w-100' style='margin-top: 35px;'>
                            <form action='awa-particular-review-db.php?propic=".$_GET['propic']."' method='POST'>
                                <input type='hidden' value='' id='rating' name='rating'>";
                        if($row['comments'] != null) {
                           
                            for($c=0;$c<count($cmnts);$c++){
                                $cmnt = $cmnts[$c];
                                foreach($cmnt as $key => $value) {
                                    if(strcmp($key, "username") == 0) 
                                        $user = $value;
                                    else if(strcmp($key, "value") == 0)
                                       $val = $value;
                                }
                                echo "<div class='px-2 d-block' style='line-height:1.3'>";
                                echo "<div class='' style='font-size: medium'>". $user . "</div>";
                                echo "<span class='text-muted' style='font-size: medium'>" . $val . "</span>";
                                echo "</div> <hr class='w-100'>";
                            }
                        }        
                                
                        echo "<div class='form-group row'>
                                    <div class='col-7 col-sm-8 col-md-10'>
                                        <input class='form-control' style='' type='text' placeholder='Enter comment here...' name='cmnt'>
                                    </div>
                                    <div class='col-5 col-sm-4 col-md-2'>
                                        <button type='submit' class='btn form-control' style='background-color: black; color: white'>Submit</button>
                                    </div>    
                                </div>
                            </form>    
                        </div>
                    </div>";
                    $con = null;
            ?>
        </div>
        <!--<footer class="bg-dark p-3" style="color: white; font-weight: 200; font-size: small; text-align: center;"><i class="far fa-copyright"></i> 2020 2S2 Inc. Ltd., All Rights Reserved.</footer>-->
    </body>
    <script>
        $(document).ready(function(){
            $(".navbar-collapse").on("click", "a:not([data-toggle])", null, function() {
                $(".navbar-collapse").collapse('hide');
            });
            
            $("[type='radio']").click(function(){
                $("#rating").val($(this).val());
            });
        });        
    </script>
</html>