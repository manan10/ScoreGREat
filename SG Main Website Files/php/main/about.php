<?php 
    session_start();
    if(!isset($_SESSION['email']))
       header('Location: ./../index.html');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="./../../image/logo.png" type="image/icon type" style="width: max-content;">
    <title>Score GREat | About Us</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Raleway|Kaushan+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./../../lib/bootstrap.min.css">
    <!--<link rel="stylesheet" href="./../../lib/font-awesome.min.css">-->
    <link rel="stylesheet" href="./../../lib/elegant-fonts.css">
    <link rel="stylesheet" href="./../../lib/themify-icons.css">
    <link rel="stylesheet" href="./../../lib/swiper.min.css">
    <link rel="stylesheet" href="./../../lib/style.css">
    <script src="./../../lib/7aadfb7b53.js" crossorigin="anonymous"></script>
    <script src="./../../lib/jquery.min.js"></script>
    <script src="./../../lib/popper.min.js"></script>
    <script src="./../../lib/bootstrap.min.js"></script>

    <style>
        body {
            font-family: 'Raleway', sans-serif;
            font-size: large;
            font-weight: 700;
            /*background-color: rgba(228, 228, 228, 0.4);*/
        }
    
        nav {
            background-image: linear-gradient(to right, #e6e600, #ffa31a); 
            z-index: 1000;
        }
        
        nav > a > span {
            font-family: 'Kaushan Script', cursive;
            font-weight: 550;
            font-size: x-large;
        }
        
        .nav-link, .nav-link:hover, .navbar-brand, .navbar-brand:hover {
            color: black !important;
        }
        
        .dropdown-menu {
            background-color: rgba(0, 0, 0, 0.8);
        }
        
        .dropdown-menu > a {
            color: white;
        }

        @media screen and (min-width: 768px) {
            li > a:hover, li > .active, .dropdown-item:hover {
                background-color: black;
                color: white;
                border-radius: 5px;
            }
        }
        
        @media screen and (max-width: 767px) {
            .dropdown > a > i {
                margin-right: -1%;
            }
        }
        
        @media screen and (max-width: 1024px) {
            .foot-about img {
                margin: auto;
                display: block;
            }
            
            .foot-about a {
                margin-left: 0;
            }
            
            .foot-about p {
                text-align: center;
            }
        }
    </style>
</head>

<body class="about-page">
    <nav class="navbar navbar-expand-md shadow sticky-top" style="width: 100%;">
            <a class="navbar-brand ml-2 mr-auto" href="dashboard.php">
                <img src="./../../image/logo.png" alt="Logo" style="width:45px;"><span class="mx-2">Score GREat</span>
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
                                <a class="dropdown-item" href="practice/practice-dashboard.php">Practice</a>
                                <a class="dropdown-item" href="awa/awa.php">AWA</a>
                                <a class="dropdown-item" href="mock-test/mt-dashboard.php">Mock Test</a>
                                <a class="dropdown-item" href="public-discussion/public-discussion.php">Public Discussion</a>
                                <a class="dropdown-item" href="multiplayer-games/mg-dashboard.php">Multiplayer Games</a>
                                <a class="dropdown-item" href="saved-notes/saved-notes.php">Saved Notes</a>
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
                                <a class="dropdown-item" href="my-profile/my-profile.php"><i class='fas fa-user-circle pr-2'></i>My Profile</a>
                                <a class="dropdown-item" href="./../logout.php"><i class='fas fa-sign-out-alt pr-2'></i> Log Out</a>
                            </div>
                        </div>
                    </li>  
                </ul>
            </div>   
        </nav>
    <div class="container">
        <div class="row mt-0">
            <div class="col-12">
                <div class="about-heading">
                    <h2 class="entry-title">Welcome to Score GREat</h2>

                    <p>Your One stop spot for all things GREat</p>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="about-values">
                    <h3>Our Origin</h3>

                    <p class="mt-4">We started Score GREat as a final year project for our Bachelors in Computer Engineering Degree from SCET,Surat in India.</p>

                    <p>Some of us who studied GRE in the past came to  a realization that there is no one single resource where one can study all the aspects of GRE, atleast not free of cost.</p>

                    <p>Thus, when we got the chance to deliver a big project, we could'nt resist the idea of making an application where the users can prepare for GRE completely and efficiently.</p>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="about-stories">
                    <h3>Our Purpose</h3>

                    <p class="mt-4">Main objective of making Score GREat is to enable our users to study for the GRE any time they want at any place they want.</p>

                    <p>Most of the applications that provide adaptive learning for GRE do not have all the features within itself to completely nurture the students capabilities all by itself.</p>
                    <p> Thus the student needs to look for many other resources outside the application.Thus, we by making Score GREat aspire to make an adaptive system for GRE test preparation a one stop spot for all the students.</p>
                </div>
            </div>

            
        </div>
    </div>

    <div class="container mb-5">
        <div class="row">
            <div class="col-12">
                <div class="team-heading">
                    <h2 class="entry-title">Meet Our Team</h2>
                    <p>We at Score GREat have worked tirelessly towards building this website in the past few months.</p>
                </div>
            </div>

            <div class="col-md-0 col-lg-2"></div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="team-member">
                    <img src="./../../image/about/manan1.jpg" alt="">

                    <h3>Manan Dalal</h3>
                    <h4>Project Manager</h4>

                    <ul class="p-0 m-0 d-flex justify-content-center align-items-center">
                        <li><a href="http://www.facebook.com/manan.dalal.16" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="http://www.instagram.com/manan__10" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="https://www.linkedin.com/mwlite/in/manan-dalal-013b121a6" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="team-member">
                    <img src="./../../image/about/jenish1.jpg" alt="">

                    <h3>Jenish Modi</h3>
                    <h4>Head Developer</h4>

                    <ul class="p-0 m-0 d-flex justify-content-center align-items-center">
                        <li><a href="http://www.facebook.com/jenish.modi.129" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="http://www.instagram.com/_jenish_modi_" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="https://www.linkedin.com/mwlite/in/jenish-modi-0424861a7" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="team-member">
                    <img src="./../../image/about/honey1.jpg" alt="">

                    <h3>Honey Kapadia</h3>
                    <h4>Developer</h4>

                    <ul class="p-0 m-0 d-flex justify-content-center align-items-center">
                        <li><a href="http://www.facebook.com/honey.kapadia.193" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="http://www.instagram.com/honey_kapadia198" target="_blank"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>

            

            <div class="col-12 col-md-6 col-lg-4">
                <div class="team-member">
                    <img src="./../../image/about/mohit1.jpg" alt="">

                    <h3>Mohit Mali</h3>
                    <h4>Chief of Operations</h4>

                    <ul class="p-0 m-0 d-flex justify-content-center align-items-center">
                        <li><a href="http://www.facebook.com/mohit.mali.374" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="http://www.instagram.com/mohitmali._" target="_blank"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="team-member">
                    <img src="./../../image/about/megha1.jpg" alt="">

                    <h3>Megha Hogade</h3>
                    <h4>Database Analyst</h4>

                    <ul class="p-0 m-0 d-flex justify-content-center align-items-center">
                        <li><a href="http://www.facebook.com/megha.hogade" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="http://www.instagram.com/megha_h_7" target="_blank"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <footer class="site-footer" id="contact" style="background-color:#212921;">
        <div class="footer-widgets" style="color:#9e9e9e;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="foot-about">
                            <a class="foot-logo" href="#" style='margin-left: 3rem;'>
                                <img src="./../../image/logo_name10.png" alt="" height="25%" width="30%" style='min-width: 150px'>
                            </a>

                            <p style="color:#9e9e9e;margin-top:0px;margin-left: 6px;"> Online Learning Platform for GRE. </p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 mt-5 mt-md-0">
                        <div class="foot-contact">
                            <h2 style="color:#ffce00b3">Contact Us</h2>

                            <ul>
                                <li>Email: forsgapp@gmail.com</li>
                                <li>Phone: (+91) 81406 38471</li>
                                <li>Address: Sarvajanik College of Technology, India.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script type='text/javascript' src='./../../lib/jquery.js'></script>
    <script type='text/javascript' src='./../../lib/swiper.min.js'></script>
    <script type='text/javascript' src='./../../lib/masonry.pkgd.min.js'></script>
    <script type='text/javascript' src='./../../lib/jquery.collapsible.min.js'></script>
    <script type='text/javascript' src='./../../lib/custom.js'></script>

</body>
</html>