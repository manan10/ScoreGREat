<?php 
    session_start();
    if(!isset($_SESSION['email']))
        header('Location: ./../../../index.html');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" href="./../../../image/logo.png" type="image/icon type" style="width: max-content;">
        <title>Score GREat | Game Result</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Raleway|Kaushan+Script|Teko|Source+Serif+Pro|Slabo+27px|Rajdhani&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./../../../lib/bootstrap.min.css">
        <script src="./../../../lib/7aadfb7b53.js" crossorigin="anonymous"></script>
        <script src="./../../../lib/jquery.min.js"></script>
        <script src="./../../../lib/popper.min.js"></script>
        <script src="./../../../lib/bootstrap.min.js"></script>
        <script type="text/javascript" src="./../../../js/jquery-countdown/jquery.simple.timer.js"></script>
        
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
            
            nav > a > span, .chat-popup > span {
            	font-family: 'Kaushan Script', cursive;
            	font-weight: 550;
            	font-size: x-large;
            }

            a, a:hover, a.disabled {
                color: black;
            }
            
            .dropdown-menu {
                background-color: rgba(0, 0, 0, 0.8);
            }
            
            .dropdown-menu > a {
                color: white;
            }
            
            .nav-link:hover{
                color:black;
                background-color:rgba(0,0,0,0);
            }
            
            #dash:hover{
                color:white;
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
            
            .form-check{
                font-family:Source Serif Pro;
            }
        </style>
    </head>
    
    <body class="bg-light">
        <nav class="navbar navbar-expand-md shadow sticky-top" style="width: 100%;">
            <a class="navbar-brand ml-2 mr-auto" href="../dashboard.php">
                <img src="./../../../image/logo.png" alt="Logo" style="width:45px;"><span class="mx-2">Score GREat</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <i class='fas fa-ellipsis-v' style="font-size:24px"></i>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="mg-dashboard.php">Home</a>
                    </li>    
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Menu</a>
                            <div class="dropdown-menu toggler" style="font-size: large; font-weight: 500; margin-left: 0 !important; margin-right: 0 !important">
                                <a class="dropdown-item" href="./../dashboard.php">Dashboard</a>
                                <a class="dropdown-item" href="./../practice/practice-dashboard.php">Practice</a>
                                <a class="dropdown-item" href="./../awa/awa.php">AWA</a>
                                <a class="dropdown-item" href="./../mock-test/mt-dashboard.php">Mock Test</a>
                                <a class="dropdown-item" href="./../public-discussion/public-discussion.php">Public Discussion</a>
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
        
        <div class='container-fluid mt-3'>
            <h2 class='text-center mx-auto pb-2 w-75 mt-5' style='border: 1px solid black; border-width: 0 0 1px 0;'><b>Result</b></h2>
            <div class='mt-3 row'>
                <div class='col-5 text-center mt-5'>
                    <h3><?php echo $_SESSION['yourname']; ?></h3>
                    <div class='mt-3'>Points</div>
                    <div class='mt-3'>
                    <?php echo $_SESSION['yourscore']; ?>
                    </div>
                </div>
                <div class='col-2 align-items-center d-flex' style='writing-mode: vertical-lr; text-orientation: upright; white-space: nowrap;'></div>
                <div class='col-5 text-center mt-5'>
                    <h3><?php echo $_SESSION['oppname']; ?></h3>
                    <div class='mt-3'>Points</div>
                    <div class='mt-3'><?php echo $_SESSION['oppscore']; ?>       
                    </div>
                </div>
            </div>
            <h4 class='mt-4 text-center'> <?php echo $_SESSION['mssg']; ?></h4>
            <div class='my-3 justify-content-center d-flex'>
                <a class='btn btn-outline-dark' href='mg-dashboard.php' id='dash'> Go to Dashboard </a>
            </div>
        </div>
    </body>
</html>    