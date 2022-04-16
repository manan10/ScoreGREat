<?php
	session_start();
	if (!isset($_SESSION['email'])) {
		header('Location: ./../../../index.html');
	}
	
	$con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $con->prepare("SELECT requests FROM scoregreat.user_friends where id =:ID");
    $stmt->bindParam(":ID",$_SESSION['userid'],PDO::PARAM_INT);
    $stmt->execute();  
    $req = $stmt->fetch();
    $requests = json_decode($req['requests']);
    
    if($requests== NULL)
        $reqcount = 0;
    else
        $reqcount = count($requests); 
?>


<!DOCTYPE html>
<html>
    <head>
	    <link rel="icon" href="./../../../image/logo.png" type="image/icon type" style="width: max-content;">
        <title>Score GREat | Games Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway|Kaushan+Script&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/7aadfb7b53.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
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

            .nav-link:hover{
                color:black;
                background-color:rgba(0,0,0,0);
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
                        <a class="nav-link" style='font-size:larger;' href="friends.php" id="friends" title="Friendships"><i class="fas fa-user-friends"><sup><span class="badge badge-pill badge-light ml-1 <?php echo ($reqcount == 0) ? 'd-none' : '' ?>"><?php echo $reqcount; ?></span></sup></i></a>
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
        <section class="jumbotron text-center py-4" style="background-color: white;">
            <div class="container">
              <h1 class="jumbotron-heading">Multiplayer Games</h1>
              <p class="lead text-muted">Welcome to Multiplayer Games. Who says learning can't be fun? We have designed these games with the motive to rid our users from the boredom of learing in the monotonous way but still make progress in their learing process.</p>
            </div>
        </section>

      <div class="py-5 bg-light">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="./../../../image/wp.jpg" style="max-height: 250px;">
                <div class="card-body">
                  <p class="card-title">Word-Play</p>    
                  <p class="card-text text-muted">Improve your Vocabs by competing with your friends.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="dash.php?game=1" class="btn btn-sm btn-outline-secondary">Start</a>
                      <!--<a href="dash1.php?game=1" class="btn btn-sm btn-outline-secondary">Temp</a>-->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="./../../../image/clock.jpg" style="max-height: 250px;">
                <div class="card-body">
                  <p class="card-title">Beat the Clock</p>    
                  <p class="card-text text-muted">Solve as many questions as you can till the timer runs out.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="dash.php?game=2" class="btn btn-sm btn-outline-secondary float-right">Start</a>
                      <!--<a href="dash1.php?game=2" class="btn btn-sm btn-outline-secondary float-right">Temp</a>-->
                    </div>
                  </div>
                </div>
              </div>
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
            
            $('[data-toggle="tooltip"]').tooltip();
        });  
    </script>
</html>