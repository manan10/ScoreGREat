<?php
	session_start();
	if (!isset($_SESSION['email'])) {
		header('Location: ./../../../index.html');
	}
	
    $_SESSION['marked'] = [];

	if($_SESSION['setid'] < 3)
	    $no = 1;
	else if($_SESSION['setid'] < 5)
	    $no = 2;
	else
	    $no = 3;
	    
	if(strcmp($_SESSION['section'],"ques_math")==0){
	    $sec = "Quants Section ".$no;
	    $image = "./../../../image/maths.jpg";
	}    
	else{
	    $sec = "Verbal Section ".$no;
	    $image = "./../../../image/english.png";
	}    
?>

<!DOCTYPE html>
<html>
    <head>
	    <link rel="icon" href="./../../../image/logo.png" type="image/icon type" style="width: max-content;">
        <title>Score GREat | Set Instructions</title>
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
              
              <h1 class="jumbotron-heading"><?php echo $sec;?></h1>
              <h1 class="lead text-muted" style="font-size:30px;">Set <?php echo $_SESSION['setid']?></h1>
            </div>
        </section>

      <div class="py-5 bg-light">
        <div class="container justify-content-center align-items-center d-flex">
            <div class="card mb-4 box-shadow" style="max-width:900px;">
                <img class="card-img-top" src=<?php echo $image; ?> style="max-height: 250px;">
                <div class="card-body">
                  <p class="card-text text-muted">A complete mock test based on the exam structure of GRE.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <?php
                         if(strcmp($_SESSION['section'],"ques_math")==0)
                            $time = $_SESSION['set-size']*2;
                         else
                            $time = ceil($_SESSION['set-size'] * 1.5);
                         echo '<a href="mock-test.php" onclick="setTime('.$time.')" class="btn btn-sm btn-outline-secondary float-right">Start</a>';
                       ?>        

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
                  <h4 class="modal-title center"><b>Instructions</b></h4>
                  <button type="button" class="close" data-dismiss="modal"><i class= 'far fa-window-close'></i></button>
                </div>
                
                <div class="modal-body">
                    <div class="container-fluid pl-5">
                        <?php 
                            if(strcmp($_SESSION['section'],"ques_math")==0){
                                echo "<ul>
                                        <li>This is a Quants Set.</li>
                                        <li>This set contains 20 questions.</li>
                                        <li>Each Question has one correct answer.</li>
                                        <li>You have 35 minutes to solve this section.</li>
                                        <li>You can mark questions for review and solve them at the end.</li>
                                    </ul>";
                            }        
                            else{ 
                                echo "<ul>
                                        <li>This is a Verbal Set.</li>
                                        <li>This set contains 20 questions.</li>
                                        <li>Questions have multiple correct answers.</li>
                                        <li>You have 30 minutes to solve this section.</li>
                                        <li>You can mark questions for review and solve them at the end.</li>
                                    </ul>";
                            }            
                                        
                        ?>
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
        
        function setTime(x){
            var min = x;
            var now = Date.parse(new Date());
            var endtime = Date.parse(new Date(now + min*60*1000));
            
            sessionStorage.setItem("timer", endtime);
        }

    </script>
</html>