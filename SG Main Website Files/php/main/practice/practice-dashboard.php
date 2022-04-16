<?php
	session_start();
	if (!isset($_SESSION['email'])) {
		header('Location: ./../../../index.html');
	}
?>


<!DOCTYPE html>
<html>
    <head>
	    <link rel="icon" href="./../../../image/logo.png" type="image/icon type" style="width: max-content;">
        <title>Score GREat | Practice Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Raleway|Kaushan+Script|Teko|Source+Serif+Pro|Slabo+27px&display=swap" rel="stylesheet">
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
            
            .number{
                font-family: Source Serif Pro;
            }

            .jumbotron {
                padding-top: var(--jumbotron-padding-y);
                padding-bottom: var(--jumbotron-padding-y);
                margin-bottom: 0;
                background-color: #fff;
            }
            
            .container:hover .card:not(:hover) {
                filter: blur(1px);
                /*transform: scale(.7);*/
            }
            
            .container:hover .card:hover {
                /*transform: scale(1.1);*/
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
                                <a class="dropdown-item" href="./../awa/awa.php">AWA</a>
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
        <section class="jumbotron text-center py-4" style="background-color: white;">
            <div class="container">
              <h1 class="jumbotron-heading">General Practice</h1>
              <p class="lead text-muted">Welcome to the practice section. Here, you will be able to practice your way to perfection by solving multiple questions of both Quants and Verbal Section of the GRE through our special Performance Adaptive Trainer.</p>
            </div>
        </section>

      <div class="py-5 bg-light">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="./../../../image/maths.jpg" style="max-height: 250px;">
                <div class="card-body">
                  <p class="card-text text-muted">Solve Maths questions spanning through various categories like algebra, arithmetic, geometry etc.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="math_session.php" class="btn btn-sm btn-outline-secondary">Start</a>
                    </div>
                    <div class="btn-group">
                      <a data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-outline-secondary">Set Prefrences</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="./../../../image/english.png" style="max-height: 250px;">
                <div class="card-body">
                  <p class="card-text text-muted">Solve Verbal Questions spanning through various categories like Sentence Equivalence and Text Completion</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="verbal_session.php" class="btn btn-sm btn-outline-secondary float-right">Start</a>
                    </div>
                    
                    <div class="btn-group">
                      <a data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-outline-secondary">Set Prefrences</a>
                    </div>
                  </div>
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
                  <h4 class="modal-title center"><b>Set Your Preferences</b></h4>
                  <button type="button" class="close" data-dismiss="modal"><i class= 'far fa-window-close'></i></button>
                </div>
                
                <div class="modal-body">
                  <br>
                  <form action="setpreferences.php" method="POST">
                      <div class="row">
                      	<div class="col-sm-4">
                      		Set Size:&nbsp;&nbsp;
                      	</div>
                     	<div class="col-sm-8">
                              <button type="button" name="minus" id="minus" class="btn btn-sm btn-outline-secondary"><i class='fas fa-minus'></i></button>
                              <input class="text-center number" type="text" name="size" id="size" value="10" style="max-width:60px" readonly>
                              <button type="button" name="plus" id="plus" class="btn btn-sm btn-outline-secondary"><i class='fas fa-plus'></i></button>
                        </div>
                      </div> 
                      <br>
                      <div class="row">
                          <div class="col-sm-4">
                            Difficulty Level:
                          </div>
                          <div class="col-sm-8">
                            <select class="form-control w-50" name="diffi" id="diffi" title="Choose Difficulty">
                                <option value='easy'>Easy</option>
                                <option value='medium'>Medium</option>
                                <option value='hard'>Hard</option>
                                <option value='very hard'>Very hard</option>
                                <option value='adaptive'>Adaptive</option>
                                <option value='random'>Random</option>
                            </select>
                         </div>
                      </div>
                      <br>
                    </div>
                    
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-dark" id="save">Save</button>  
                    </div>
                </form>
                
              </div>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function(){
            $(".navbar-collapse").on("click", "a:not([data-toggle])", null, function () {
                $(".navbar-collapse").collapse('hide');
            });
            
            $("#minus").on('click',function(){
                var a = Number($("#size").val());
                if(a > 5) {
                    a = a-1;
                    $("#size").val(a);
                }
            });
            
            $("#plus").on('click',function(){
                var a = Number($("#size").val());
                if(a < 20) {
                    a = a+1;
                    $("#size").val(a);
                }
            });
        });  
    </script>
</html>