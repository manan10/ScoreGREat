<?php 
    session_start();
    if(!isset($_SESSION['email']))
       header('Location: ./../index.html');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="./../../image/logo.png" type="image/icon type" style="width: max-content;">
    <title>Score GREat | Dashboard</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Raleway|Kaushan+Script|Teko|Source+Serif+Pro|Slabo+27px&display=swap" rel="stylesheet">
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
            background-image: -webkit-linear-gradient(left, #e6e600, #ffa31a); 
            z-index: 1000;
        }
        
        .number{
                font-family: Source Serif Pro;
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
<body>
        <!-- Aapnu valu -->
       <nav class="navbar navbar-expand-md sticky-top shadow" style="width: 100%;">
            <a class="navbar-brand ml-2 mr-auto" href="#">
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
    <div class="hero-content">
        <div class="hero-content-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="hero-content-wrap flex flex-column justify-content-center align-items-start">
                            <header class="entry-header">
                                <h4>Get started with your practice</h4>
                                <h1>best online<br/>Learning Platform for GRE</h1>
                            </header>

                            <div class="entry-content">
                                <p>Score GREat comes with a wide range of features that tailor the course around your comfort and abilities, and help you focus on your weaknesses.</p>
                            </div>

                            <footer class="entry-footer read-more">
                                <a href="#services">Learn More</a>
                            </footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="icon-boxes" id="services">
        <div class="container-fluid">
            <div class="flex flex-wrap align-items-stretch">
                <div class="icon-box">
                    <div class="icon">
                        <span class="ti-book"></span>
                    </div>

                    <header class="entry-header">
                        <h2 class="entry-title">General Practice</h2>
                    </header>

                    <div class="entry-content">
                        <p> We have designed a perfect way to practice your Quants and Verbal skills so that you can achieve your dream score and crack the GRE General Test.</p>
                    </div>

                    <footer class="entry-footer read-more">
                        <a href="practice/practice-dashboard.php">Goto Practice<i class="fa fa-long-arrow-right"></i></a>
                    </footer>
                </div>

                <div class="icon-box">
                    <div class="icon">
                        <span class="ti-write"></span>
                    </div>

                    <header class="entry-header">
                        <h2 class="entry-title">Analytical Writing Assessment</h2>
                    </header>

                    <div class="entry-content">
                        <p>Get ready to polish your writing skills on various selected topics provided by Score GREat which will help you achieve your dream score in the AWA Section of the GRE General Test.</p>
                    </div>

                    <footer class="entry-footer read-more">
                        <a href="awa/awa.php">Goto AWA<i class="fa fa-long-arrow-right"></i></a>
                    </footer>
                </div>

                <div class="icon-box">
                    <div class="icon">
                        <span class="ti-ruler-pencil"></span>
                    </div>

                    <header class="entry-header">
                        <h2 class="entry-title">Mock Test</h2>
                    </header>

                    <div class="entry-content">
                        <p>The best way to study for a test is by appearing for some practice tests. Here is a GRE based complete mock test for you.</p>
                    </div>

                    <footer class="entry-footer read-more">
                        <a href="mock-test/mt-dashboard.php">Goto Mock<i class="fa fa-long-arrow-right"></i></a>
                    </footer>
                </div>

                <div class="icon-box">
                    <div class="icon">
                        <span class="ti-comments"></span>
                    </div>

                    <header class="entry-header">
                        <h2 class="entry-title">Public Discussion Forum</h2>
                    </header>

                    <div class="entry-content">
                        <p> We believe in a collaborative method of learning to be the most efficient. Keeping that in mind, use the Score GREat Public Discussion Forum to help each other out with all your doubts and problems regarding the GRE General Test.</p>
                    </div>

                    <footer class="entry-footer read-more">
                        <a href="public-discussion/public-discussion.php">Goto Forum<i class="fa fa-long-arrow-right"></i></a>
                    </footer>
                </div>
                
                <div class="icon-box">
                    <div class="icon">
                        <span class="ti-game"></span>
                    </div>

                    <header class="entry-header">
                        <h2 class="entry-title">Multiplayer Games</h2>
                    </header>

                    <div class="entry-content">
                        <p> We here at Score GREat aspire to make learning <cite>FUN</cite>. Compete with your companions in a healthy, informative and most importantly, FUN games based on the GRE General Test.</p>
                    </div>

                    <footer class="entry-footer read-more">
                        <a href="multiplayer-games/mg-dashboard.php">Goto Games<i class="fa fa-long-arrow-right"></i></a>
                    </footer>
                </div>

                <div class="icon-box">
                    <div class="icon">
                        <span class="ti-notepad"></span>
                    </div>

                    <header class="entry-header">
                        <h2 class="entry-title">Saved Notes</h2>
                    </header>

                    <div class="entry-content">
                        <p>Remembering stuff is pretty difficult. Writing them down on paper is better. But what if you could just create notes on our platform itself ? Wouldn't that be great ? Well, Sorry to not dissapoint, but here at Score GREat you can ! To see all your saved notes, click the button below.</p>
                    </div>

                    <footer class="entry-footer read-more">
                        <a href="saved-notes/saved-notes.php">Goto Notes<i class="fa fa-long-arrow-right"></i></a>
                    </footer>
                </div>
            </div>
        </div>
    </div>

    <section class="about-section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 align-content-lg-stretch">
                    <header class="heading">
                        <h2 class="entry-title">About ScoreGREat</h2>

                        <p>We at Score GREat are focused on One simple goal, to make us a one stop spot for everything you need to prepare for your GRE examination and help you achieve your academic goals in the most efficient and fun mannar.</p>
                    </header>

                    <footer class="entry-footer read-more">
                            <a class="btn btn-outline-dark" href="about.php">Learn More</a>
                    </footer>
                </div>

                <div class="col-12 col-lg-6 flex align-content-center mt-5 mt-lg-0">
                    <div class="ezuca-video position-relative">
                        <img src="./../../image/dash/learning.png" alt="" style="width: 100%; filter: brightness(0.95);">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonial-section">
        <div class="swiper-container testimonial-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6 order-2 order-lg-1 flex align-items-center mt-5 mt-lg-0">
                                <figure class="user-avatar">
                                    <img src="./../../image/dash/mj.jpg" alt="">
                                </figure>
                            </div>

                            <div class="col-12 col-lg-6 order-1 order-lg-2 content-wrap h-100">
                                <div class="entry-content">
                                    <p>What You Lack In Talent Can Be Made Up With Desire, Hustle And Giving it Your all.</p>
                                </div>

                                <div class="entry-footer">
                                    <h3 class="testimonial-user">Don Zimmer - <span>Baseball Player</span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6 order-2 order-lg-1 flex align-items-center mt-5 mt-lg-0">
                                <figure class="user-avatar">
                                    <img src="./../../image/dash/rc.jpg" alt="">
                                </figure>
                            </div>

                            <div class="col-12 col-lg-6 order-1 order-lg-2 content-wrap h-100">
                                <div class="entry-content">
                                    <p>"You must expect great things of yourself before you can do them."</p>
                                </div>

                                <div class="entry-footer">
                                    <h3 class="testimonial-user">Micheal Jordon - <span>BasketBall Player</span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6 flex order-2 order-lg-1 align-items-center mt-5 mt-lg-0">
                                <figure class="user-avatar">
                                    <img src="./../../image/dash/dz.jpg" alt="">
                                </figure>
                            </div>

                            <div class="col-12 col-lg-6 order-1 order-lg-2 content-wrap h-100">
                                <div class="entry-content">
                                    <p>Success is the sum of small efforts, repeated day-in and day-out.</p>
                                </div>

                                <div class="entry-footer">
                                    <h3 class="testimonial-user">Robert Collier - <span>Author</span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 mt-5 mt-lg-0">
                        <div class="swiper-pagination position-relative flex justify-content-center align-items-center"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                                <li class="number">Phone: (+91) 81406 38471</li>
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
    <script>
         $(document).ready(function(){
            $(".navbar-collapse").on("click", "a:not([data-toggle])", null, function () {
                $(".navbar-collapse").collapse('hide');
            });
        });        
    </script>

</body>
</html>