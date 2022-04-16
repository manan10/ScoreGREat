<?php
	session_start();
	if (!isset($_SESSION['email'])) {
		header('Location: ./../../../index.html');
	}
	
	$_SESSION['setid'] = 0;
	$_SESSION['set-size'] = 5;
	$_SESSION['correct'] = 0;
	$_SESSION['setScore'] = json_encode([]);
	$_SESSION['set1'] = json_encode([]);
	$_SESSION['set2'] = json_encode([]);
	$_SESSION['set3'] = json_encode([]);
	$_SESSION['set4'] = json_encode([]);
	$_SESSION['set5'] = json_encode([]);
	$_SESSION['rq-set1'] = json_encode([]);
	$_SESSION['rq-set2'] = json_encode([]);
	$_SESSION['rq-set3'] = json_encode([]);
	$_SESSION['rq-set4'] = json_encode([]);
	$_SESSION['rq-set5'] = json_encode([]);
?>


<!DOCTYPE html>
<html>
    <head>
	    <link rel="icon" href="./../../../image/logo.png" type="image/icon type" style="width: max-content;">
        <title>Score GREat | Mock Test Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Raleway|Kaushan+Script&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./../../../lib/bootstrap.min.css">
        <script src="./../../../lib/7aadfb7b53.js" crossorigin="anonymous"></script>
        <script src="./../../../lib/jquery.min.js"></script>
        <script src="./../../../lib/popper.min.js"></script>
        <script src="./../../../lib/bootstrap.min.js"></script>
        <style type="text/css">
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

            .jumbotron {
                padding-top: var(--jumbotron-padding-y);
                padding-bottom: var(--jumbotron-padding-y);
                margin-bottom: 0;
                background-color: #fff;
            }
            
            

            @media screen and (min-width: 768px) {
                li > a:hover, li > .active, .dropdown-item:hover {
                    background-color: black;
                    color: white;
                    border-radius: 5px;
                }

                .jumbotron {
                  padding-top: calc(var(--jumbotron-padding-y) * 2);
                  padding-bottom: calc(var(--jumbotron-padding-y) * 2);
                }
                .lead{
                  font-size: 20px;
                }
            }
            
            @media screen and (max-width: 767px) {
                li {
                    width: 100%;
                }
                .lead{
                    font-size: 15px
                }
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
      </style>
    </head>
    <body>
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
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Menu</a>
                            <div class="dropdown-menu toggler" style="font-size: large; font-weight: 500; margin-left: 0 !important; margin-right: 0 !important">
                                <a class="dropdown-item" href="./../dashboard.php">Dashboard</a>
                                <a class="dropdown-item" href="./../practice/practice-dashboard.php">Practice</a>
                                <a class="dropdown-item" href="./../awa/awa.php">AWA</a>
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
        <section class="jumbotron text-center py-4" style="background-color: white;">
            <div class="container">
              <h1 class="jumbotron-heading">Mock Test</h1>
              <p class="lead text-muted">Welcome to the Mock Test. Take a complete test equivalent to the GRE and find out your strength and weaknesses and hone your time management skills.</p>
            </div>
        </section>

      <div class="py-5 bg-light">
        <div class="container justify-content-center align-items-center d-flex">
            <div class="card mb-4 box-shadow" style="max-width:900px;">
                <img class="card-img-top" src="./../../../image/mock.png" style="max-height: 250px;">
                <div class="card-body">
                  <p class="card-text text-muted">A complete mock test based on the exam structure of GRE.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="set.php" class="btn btn-sm btn-outline-secondary float-right">Start</a>
                    </div>
                    
                    <div class="btn-group">
                      <a data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-outline-secondary">Instructions</a>
                    </div>
                </div>
            </div>    
          </div>
        </div>
      </div>
      
        <div class="modal" id="myModal">
            <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                <div class="modal-header" style=" background-image: linear-gradient(to right, #e6e600, #ffa31a);">
                  <h4 class="modal-title center"><b>General Instructions</b></h4>
                  <button type="button" class="close" data-dismiss="modal"><i class= 'far fa-window-close'></i></button>
                </div>
                
                <div class="modal-body">
                    <div class="container-fluid pl-5">	
                        <ul>
                            <li>This test will contain a total of 5 sets.</li>
                            <li>The maximum score that can be scored is 340.</li>
                            <li>Each set will consist of 20 questions.</l1>
                            <li>Out of these sets, one of the sets will be a dummy set.</li>
                            <li>A dummy set is a set whose marks do not count in the grand total.</li>
                            <li>There will be 2 Quants and 2 Verbal Sets alternatively for Set 1-4.</li>
                            <li>Set-5 is randomly selected as either Quant or Verbal.</li>
                            <li>Each set will have a certain Time limit.</li>
                        </ul>
                    </div>    
                </div>    
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
                
              </div>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function(){
            $(".navbar-collapse").on("click", "a:not([data-toggle])", null, function () {
                $(".navbar-collapse").collapse('hide');
            });
        });  
    </script>
</html>