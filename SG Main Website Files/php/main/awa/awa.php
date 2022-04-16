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
        <title>Score GREat | AWA Dashboard</title>
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
              
              .modal-body{
                    height: 300px;
                }
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
                                <a class="dropdown-item" href="./../public-discussion/public-discussion.php">Public Discussion</a>
                                <a class="dropdown-item" href="./../multiplayer-games/mg-dashboard.php">Multiplayer Games</a>
                                <a class="dropdown-item" href="./../mock-test/mt-dashboard.php">Mock Test</a>
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
              <h1 class="jumbotron-heading">Analytical Writing</h1>
              <p class="lead text-muted">The Analytical Writing measure tests your critical thinking and analytical writing skills. It assesses your ability to articulate and support complex ideas, construct and evaluate arguments, and sustain a focused and coherent discussion.</p>
            </div>
        </section>

      <div class="py-5 bg-light">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="./../../../image/essay.jpg" style="max-height: 250px;">
                <div class="card-body">
                  <p class="card-title">AWA Writing</p>
                  <p class="card-text text-muted">Write an AWA response from a catalouge of problem statements containing both issue and argument topics.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="awa-writing.php" class="btn btn-sm btn-outline-secondary">Start</a>
                    </div>
                    <div class="btn-group">
                      <a data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-outline-secondary">Stratergies</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="./../../../image/review.jpg" style="max-height: 250px;">
                <div class="card-body">
                  <p class="card-title">AWA Feed</p>    
                  <p class="card-text text-muted">View other responses to the same catalouge of problem statements and rate and comment on them.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="awa-review-ques.php" class="btn btn-sm btn-outline-secondary float-right">Start</a>
                    </div>
                    
                    <div class="btn-group">
                      <a data-toggle="modal" data-target="#myModal1" class="btn btn-sm btn-outline-secondary">Overview</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
        <div class="modal" id="myModal">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
              <div class="modal-content">
                <div class="modal-header" style=" background-image: linear-gradient(to right, #e6e600, #ffa31a);">
                  <h4 class="modal-title center"><b>Stratergies</b></h4>
                  <button type="button" class="close" data-dismiss="modal"><i class= 'far fa-window-close'></i></button>
                </div>
                
                <div class="modal-body">
                  <div class="container-fluid pl-5">	
                    <br>
                    <p>Before taking the GRE General Test, review the strategies, sample topics, essay responses and rater commentary for each task contained in this section. Also review the scoring guides for each task. This will give you a deeper understanding of how raters evaluate essays and the elements they're looking for in an essay.</p>
                    
                    <br>
        
                	<p>It is important to budget your time. Within the 30-minute time limit for the Issue task, you will need to allow sufficient time to consider the issue and the specific instructions, plan a response and compose your essay. Within the 30-minute time limit for the Argument task, you will need to allow sufficient time to consider the argument and the specific instructions, plan a response and compose your essay. Although the GRE raters who score your essays understand the time constraints under which you write and will consider your response a first draft, you still want it to be the best possible example of your writing that you can produce under the testing conditions.</p>
                    
                    <br>
                    
                	<p>Save a few minutes at the end of each timed task to check for obvious errors. Although an occasional spelling or grammatical error will not affect your score, serious and persistent errors will detract from the overall effectiveness of your writing and lower your score accordingly.</p>
                </div>	
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>
        
        <div class="modal" id="myModal1">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
              <div class="modal-content">
                <div class="modal-header" style=" background-image: linear-gradient(to right, #e6e600, #ffa31a);">
                  <h4 class="modal-title center"><b>Overview</b></h4>
                  <button type="button" class="close" data-dismiss="modal"><i class= 'far fa-window-close'></i></button>
                </div>
                
                <div class="modal-body">
                  <div class="container-fluid pl-5">
                    <br> 
                	<p>The Analytical Writing measure consists of two separately timed analytical writing tasks:</p>
                	<ul>
                		<li>a 30-minute "Analyze an Issue" task</li>
                		<li>a 30-minute "Analyze an Argument" task</li>
                	</ul>	
                    <br>
                	<p>The Issue task presents an opinion on an issue of general interest followed by specific instructions on how to respond to that issue. You are required to evaluate the issue, consider its complexities and develop an argument with reasons and examples to support your views.</p>
                    <br>
                	<p>The Argument task requires you to evaluate a given argument according to specific instructions. You will need to consider the logical soundness of the argument rather than agree or disagree with the position it presents.</p>
                     <br>
                	<p>The two tasks are complementary in that one requires you to construct your own argument by taking a position and providing evidence supporting your views on an issue, and the other requires you to evaluate someone else's argument by assessing its claims and evaluating the evidence it provides.</p>
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