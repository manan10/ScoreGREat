<?php 
    session_start();
    if(!isset($_SESSION['email']))
        header('Location: ./../../../index.html');
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" href="./../../../image/logo.png" type="image/icon type" style="width: max-content;">
        <title>Score GREat | Discussion Forum</title>
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

            .number{
                font-family: Source Serif Pro;
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
            
            #que-box {
                background-color: #8cff66;
                /*border-radius: 5px;*/
                border: 0;
                /*position: absolute;*/
            }
            
            #pro-pic-in{
                width:50px;
                height:50px;
            }
            
            .card-header:first-child{
                color:white;
                border-radius: 0px;
            }

            .review-card{
                border-top: 5px solid #343a40;
            	border-left: 20px solid #343a40;
            	border-bottom: 20px solid #343a40;
            	border-right: 20px solid #343a40;
            }

            .card{
                border-radius: 0px;
                max-width: 900px;
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

            .jumbotron {
                padding-top: var(--jumbotron-padding-y);
                padding-bottom: var(--jumbotron-padding-y);
                margin-bottom: 0;
                background-color: #fff;
            }
            
            [name='que']:focus {
                outline: none;
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

                .jumbotron p:last-child {
	                margin-bottom: 0;
	              }

	              .jumbotron-heading {
	                font-weight: 300;
	              }

	              .jumbotron .container {
	                max-width: 40rem;
	              }
            }
        </style>
    </head>

    <body class="bg-light">
        <nav class="navbar navbar-expand-md sticky-top" style="width: 100%;">
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
                            <div class="dropdown-menu toggler" style="font-size: large; font-weight: 500; margin-left: 0 !important; margin-right: 0 !important;">
                                <a class="dropdown-item" href="./../dashboard.php">Dashboard</a>
                                <a class="dropdown-item" href="./../practice/practice-dashboard.php">Practice</a>
                                <a class="dropdown-item" href="./../awa/awa.php">AWA</a>
                                <a class="dropdown-item" href="./../mock-test/mt-dashboard.php">Mock Test</a>
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
        
        <section class="jumbotron text-center py-5" style="background-color: white;">
            <div class="container">
              <h1 class="jumbotron-heading">Discussion Forum</h1>
              <p class="lead text-muted">Ask and answer doubts and questions regarding GRE with your peers.	</p>
            </div>
        </section>

        <div class="container py-3 mt-3" style='background-color: white;border:5px inset #8c8c8c;' id='que'>
            <form class="p-4" action="public-discussion-db.php" method="post">
            	<h2 class="number ml-3 mb-2" style="text-decoration: bold">Create your own post</h2>
            	<div class="row">
            		<div class="col-9 col-sm-10 col-md-11">
	                	<textarea class="py-3 px-4" name="que" style="border: 1px solid black; border-radius: 15px; width: 100%" placeholder="Ask your question here"></textarea>
	                </div>
	                <div class="col-3 col-sm-2 col-md-1 justify-content-left">	
		                <button type="submit" class="btn mt-4" style="border-radius: 10px;background-color: white;margin-left: -20px;"><i class="fa fa-paper-plane fa-rotate-45" style='font-size: 30px;'></i>
		                </button>
	            	</div>
            	</div>
            </form>
        </div>
        <div class="container mt-5 text-center justify-content-center d-block align-items-center">
            <center>
            <?php
                $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                $stmt = $con->prepare("SELECT * FROM scoregreat.public_discussion_data;"); // WHERE NOT username=:NAME
                // $stmt->bindParam(":NAME", $_SESSION['name'], PDO::PARAM_STR);
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
                            
                        echo "<a class='card shadow-lg mb-5 text-left review-card' href='pd-particular-que.php?propic=".$pro."' id='" . $row['pdid'] . "' style=''>
                                <div class='card-header bg-dark d-flex' style=''>
                                    <img src='". $pro."' id='pro-pic-in' class='rounded-circle' alt='User Profile Picture'>
                                    <span class='ml-2'>
                                        <div style='font-size: large'>" . $row['username'] . "</div>
                                        <div style='font-size: small'>" . $row['email'] . "</div>
                                    </span> 
                                </div>
                                <div class='card-body'>
                                    <span>" . nl2br($row['que']) . "</span>
                                </div>
                                <div class='card-footer'>
                                    <div class='number' style='font-size: medium;'>";
                                        if($row['answers'] != null) {
                                            echo "<span><i class='far fa-comments' style='font-size: larger;'></i> : " . count(json_decode($row['answers'])) . "</span>";
                                        }
                                        else {
                                             echo "<span><i class='far fa-comments' style='font-size: larger;'></i> : 0</span>";
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
            </center>
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
                }
                else {
                    $('#btn-top').fadeOut();
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