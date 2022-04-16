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
        <script src="./../../../js/jquery-cookie/jquery.cookie.js"></script>
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
            
            .dropdown-menu {
                background-color: rgba(0, 0, 0, 0.8);
            }
            
            .dropdown-menu > a {
                color: white;
            }
            
            .number{
                font-family: Source Serif Pro;
            }
            
            #pro-pic-in{
                width:50px;
                height:50px;
            }
            
            .card-header{
                color:white;
            }
            
            #que-box {
                /*background-color: #8cff66;*/
                background-color:#717171;
                color:white;
                /*border-radius: 5px;*/
                border: 0;
                /*position: absolute;*/
            }
            
            .review-card:hover {
                text-decoration: none;
            }
            
            #btn-top {
                border-radius: 50%;
                position: fixed;
                bottom: 15px;
                right: 15px;
                display: none;
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
                            <a class="nav-link dropdown-toggle" href="#" id="navbardropmenu" data-toggle="dropdown">Menu</a>
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
        
        <div class="sticky-top shadow" id='que'>
           
            <?php 
                $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                $stmt = $con->prepare("SELECT * FROM scoregreat.awa WHERE id=:ID");
                $stmt->bindParam(":ID", $_COOKIE['id'], PDO::PARAM_INT);
                $stmt->execute();
                $row = $stmt->fetch();
            
                echo "<div id='que-box' class='row p-2 m-0'  style=''>
                        <div class='col-4 col-sm-4 col-md-2 col-lg-2'>
                           <a href='awa-review-ques.php' class='btn btn-outline-secondary mt-2' style='color:white;border-color:white;'><i class='fas fa-angle-left' aria-hidden='true'></i>&nbsp;&nbsp;Back to topics</a>
                        </div>
                        <div class='col-8 col-sm-8 col-md-10 col-lg-10'>
                            <div class=''>  " . $row['ques'] . "</div>
                        </div>
                    </div>";
                $con = null;
            ?>
        </div>
        <div class="container my-4 text-center">
            <?php
                $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                $stmt = $con->prepare("SELECT * FROM scoregreat.awa_data WHERE queid=:ID AND NOT username=:NAME;");
                $stmt->bindParam(":NAME", $_SESSION['name'], PDO::PARAM_STR);
                $stmt->bindParam(":ID", $_COOKIE['id'], PDO::PARAM_INT);
                $stmt->execute();
                $rows = $stmt->fetchAll();
                $cnt = 0;
            
                if(count($rows) > 0) {
                    foreach($rows as $row) {
                         $stmt = $con->prepare("SELECT id,profile_pic,profile_ext FROM scoregreat.users_main where EMAIL= :EMAIL");
                            $stmt->bindParam(":EMAIL",$row['email'],PDO::PARAM_STR);
                            $stmt->execute();
                            $rowPRO = $stmt->fetch();
                            $pro = './../../../image/users/avatar.jpg';
                            if($rowPRO['profile_pic']!=0)
                                $pro = './../../../image/users/'.$rowPRO['id'].'.'.$rowPRO['profile_ext'];
                                
                        echo "<a class='card shadow-lg mb-5 text-left review-card' href='awa-particular-review.php?propic=".$pro."' id='" . $row['awaid'] . "' style='border-radius: 10px;'>
                                 <div class='card-header bg-dark d-flex' style='border-radius: 10px 10px 0 0;color:white;'>
                                    <img src='". $pro."' id='pro-pic-in' class='rounded-circle' alt='User Profile Picture'>
                                    <span class='ml-2'>
                                        <div style='font-size: large'>" . $row['username'] . "</div>
                                        <div style='font-size: small'>" . $row['email'] . "</div>
                                    </span> 
                                </div>
                                <div class='card-body'>
                                    <span>" . nl2br($row['essay']) . "</span>
                                </div>
                                <div class='card-footer'>
                                    <div class='number' style='font-size: medium;'>
                                        <span>" . $row['rating'] . " <i class='fas fa-star' style='font-size: larger;'></i></span> ";
                                        if($row['comments'] != null) {
                                            echo "<span>&nbsp;&nbsp;<i class='far fa-comments' style='font-size: larger;'></i> : " . count(json_decode($row['comments'])) . "</span>";
                                        }
                                        else {
                                             echo "<span>&nbsp;&nbsp;<i class='far fa-comments' style='font-size: larger;'></i> : 0</span>";
                                        }
                                    echo "</div>
                                </div>
                           </a>";
                        $cnt++;
                    }   
                }
                else {
                    echo "<span> No Data Available. </span>";
                }
                $con = null;
            ?>
            <a href="#" class="btn btn-light float-right" id="btn-top"><i class='fas fa-angle-double-up'></i></a>
        </div>
    </body>
    <script>
        $(document).ready(function(){
            $(".navbar-collapse").on("click", "a:not([data-toggle])", null, function() {
                $(".navbar-collapse").collapse('hide');
            }); 
            
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $('#btn-top').fadeIn();
                    $('.navbar').css('z-index', '1000');
                }
                else {
                    $('#btn-top').fadeOut();
                    $('.navbar').css('z-index', '1500');
                }
            });
            
            $('#btn-top').click(function() {
                $('html, body').animate({scrollTop : 0},800);
                return false;
            });
            
            $(".review-card").click(function(){
                $.cookie("c-row", $(this).attr('id'));
            });
        });        
    </script>
</html>