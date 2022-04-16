<?php
	session_start();
	if (!isset($_SESSION['email'])) {
		header('Location: ./../../../index.html');
	}
	
	if($_GET['game']==1){
	    $game = 'Word-Play';
	    $inst = 'This game consists of 3 5-question sets of Vocabs. The Player with the max points at the end of round 3 will be declared winner.';
	}
	else{
        $game = 'Beat The Clock';
	    $inst = 'Score more number of questions than your opponent in 10 minutes to win the match.';
	}
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
                /*background-color: rgba(228, 228, 228, 0.4);*/
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
            
            .nav-link:hover{
                color:black;
                background-color:rgba(0,0,0,0);
            }
            
            .big-list{
                background-color:#757b80;
                color:white;
            }
            
            .big-list:hover, .user:hover{
                background-color:#303A40;
                color:white;
            }
        
            .jumbotron {
                padding-top: var(--jumbotron-padding-y);
                padding-bottom: var(--jumbotron-padding-y);
                margin-bottom: 0;
                background-color: #fff;
            }
            
            hr {
                background-color:black;
            }
            
            .card {
                max-width: 375px;
            }
            
            .card-header {
                border-radius: 10px 10px 0 0 !important;
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
                
                .card {
                    width: 30%;
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
            
            @media (max-width: 768px) {
                .carousel-inner .carousel-item > div {
                    display: none;
                }
                .carousel-inner .carousel-item > div:first-child {
                    display: block;
                }
            }
            
            .carousel-inner .carousel-item.active,
            .carousel-inner .carousel-item-next,
            .carousel-inner .carousel-item-prev {
                display: flex;
            }
            
            /* display 3 */
            @media (min-width: 768px) {
                
                .carousel-inner .carousel-item-right.active,
                .carousel-inner .carousel-item-next {
                    transform: translateX(33.333%);
                }
                
                .carousel-inner .carousel-item-left.active, 
                .carousel-inner .carousel-item-prev {
                    transform: translateX(-33.333%);
                }
            }
            
            .carousel-inner .carousel-item-right,
            .carousel-inner .carousel-item-left{ 
                transform: translateX(0);
            }
            
            .carousel-control-prev, .carousel-control-next {
                width: 40px; 
                height: 40px; 
                border-radius: 50%;
                margin-top: 14px;
            }
            
            @media (max-width: 425px) {
                .carousel-control-prev, .carousel-control-next {
                    margin-top: 23px;
                }   
            }
      </style>
    </head>
    
    <?php
            $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $con->prepare("select id,FNAME,LNAME from scoregreat.users_main where not EMAIL=:EMAIL");
            $stmt->bindParam(":EMAIL", $_SESSION['email'], PDO::PARAM_STR);
            $stmt->execute();
            $users = $stmt->fetchAll();
    ?>            
    <body class='bg-light'>
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
        <section class="jumbotron text-center py-4" style="background-color: white;">
            <div class="container">
              <h1 class="jumbotron-heading"><?php echo $game; ?></h1>
              <p class="lead text-muted"><?php echo $inst; ?></p>
            </div>
        </section>

      <div class="py-4 bg-light">
        <div class="container mt-0">
            <div class="p-3" style="border: 1px solid black; border-width: 0 0 1px 0;">
                <div>
                    <button class="btn btn-dark float-right" id="new-game">New Game</button>
                    <span class="text-left" style="font-size: x-large;"><b>Active Games</b></span>
                </div>
                <div class="d-none">
                    <button class="btn btn-dark float-right" id="active-game">Active Game</button>
                    <span class="text-left" style="font-size: x-large;"><b>New Games</b></span>        
                </div>
            </div>
            
            <div id="demo" class="container" style="display: none">
                <div>
                    <div id='random' class='list-group-item list-group-item-action mt-5 text-center big-list'>Random Opponent</div> 
                    <center>
                        <div id='ran' class='my-4 w-75'>
                            <div id='' class='list-group-item list-group-item-action text-center user' style="display: none"></div> 
                        </div>
                    </center>
                    
                    <div id='select' class='list-group-item list-group-item-action my-4 text-center big-list'>Select Opponent</div>
                    <?php
                        $stmt = $con->prepare("select * from scoregreat.user_friends where id=:ID");
                        $stmt->bindParam(":ID", $_SESSION['userid'], PDO::PARAM_INT);
                        $stmt->execute();
                        $fri = $stmt->fetch();
                        if($fri['friends']==NULL)
                            $friends = [];
                        else
                            $friends = json_decode($fri['friends']);
                        
                        $stmt = $con->prepare("select * from scoregreat.games where finished=0 and game=:GAME and (p1=:p1 or p2=:p1)");
                        $stmt->bindParam(":GAME", $_GET['game'], PDO::PARAM_INT);
                        $stmt->bindParam(":p1", $_SESSION['userid'], PDO::PARAM_INT);
                        $stmt->execute();
                        $games = $stmt->fetchAll();
                    ?>    
                    <center>                    
                        <div id='sel' class='my-4'>
                            <div id="players" class="carousel slide w-100" data-ride="carousel" data-interval="false">
                                <?php
                                    $i=0; 
                                    $j=0;
                                    $yourFriends = [];
                                    while($i < count($users)) {
                                        if(in_array(intval($users[$i]['id']),$friends,TRUE)){
                                            $yourFriends[$j] = $users[$i];
                                            $j++;
                                        }    
                                        $i++;
                                    }
                                    $i = 0;
                                    if(count($yourFriends) > 3) {
                                        echo '<div class="carousel-inner w-100">';
                                        while($i < count($yourFriends)) {
                                            echo "<div class='carousel-item justify-content-center" . ($i == 0 ? ' active' : '') . "'>
                                                    <div class='col-4 px-0 justify-content-center'>
                                                        <div style='max-width: 170px;' id='".$yourFriends[$i]['id']."' class='card-body px-0 text-center user'>".$yourFriends[$i]['FNAME']." ".$yourFriends[$i]['LNAME']."
                                                        </div>
                                                    </div>
                                                </div>";
                                            $i++;
                                        }
                                        echo 
                                            '</div>
                                            <a class="btn btn-light btn-sm carousel-control-prev shadow" href="#players" data-slide="prev">
                                                <i class="fas fa-angle-left" style="color: black;"></i>
                                            </a>
                                            <a class="btn btn-light btn-sm carousel-control-next shadow" href="#players" data-slide="next">
                                                <i class="fas fa-angle-right" style="color: black;"></i>
                                            </a>';
                                    }
                                    else {
                                        while($i < count($yourFriends)) {
                                            echo "
                                                <div id='".$yourFriends[$i]['id']."' class='list-group-item list-group-item-action text-center user'>".$yourFriends[$i]['FNAME']." ".$yourFriends[$i]['LNAME']."</div>";
                                            $i++;
                                        }
                                    }
                                    if($j == 0)
                                        echo "<div class='container'>
                                                <p> You dont have any friends </p>      
                                              </div>";
                                ?>
                            </div>
                        </div>
                    
                        <div id='start' class='my-4 d-none'>
                            <form action='new-game.php?game=<?php echo $_GET['game'];?>' method='POST'>
                                <input type='hidden' id='userid' name='userid'>        
                                <button type='submit' class='btn btn-outline-dark' id='newgame'>Start</button>
                            </form>
                        </div>
                    </center>
                </div>
            </div>
            
            <?php
                echo "<div id='active' class='row' style='justify-content: center;'>";
               	$empty = 0;
                foreach($games as $row) 
                    if($row['questions']!=NULL)
                        $empty += 1;
                if(count($games) == $empty) {
                    echo "<h4 class='mt-5'> You have no active games available.</h4>";
                }
                else {
                    foreach($games as $row) {
                        if($row['questions']!=NULL){
                            $stmt = $con->prepare("select FNAME,LNAME from scoregreat.users_main where id=:ID");
                            $stmt->bindParam(":ID", $_SESSION['userid'], PDO::PARAM_INT);
                            $stmt->execute();
                            $you = $stmt->fetch();
                            
                            $stmt = $con->prepare("select FNAME,LNAME from scoregreat.users_main where id=:ID");
                            if($row['p1']==$_SESSION['userid'])
                                $stmt->bindParam(":ID", $row['p2'], PDO::PARAM_INT);
                            else
                                $stmt->bindParam(":ID", $row['p1'], PDO::PARAM_INT);
                            $stmt->execute();
                            $opp = $stmt->fetch();
                            
                            if($row['p1']==$_SESSION['userid']){
                                $scorep1 = $row['score_p1'];
                                $scorep2 = $row['score_p2'];
                            }
                            else{
                                $scorep1 = $row['score_p2'];
                                $scorep2 = $row['score_p1'];
                            }
                            
                            if($row['turn'] == $_SESSION['userid'])
                                $turn = "Your";
                            else
                                $turn = $opp['FNAME'] . " " . $opp['LNAME'] . "'s";
                                
                            echo "
                                <div class='card shadow-lg m-3 text-left' id='" . $row['id'] . "' style='border-radius: 10px;'>
                                
                                    <div class='card-header bg-light'>
                                        <div class='row'>
                                            <div class='col-5 col-sm-5'>".$you['FNAME']." ".$you['LNAME']."</div>
                                            <div class='col-2 col-sm-2 text-center p-0'>v/s</div>
                                            <div class='col-5 col-sm-5 text-right'>".$opp['FNAME']." ".$opp['LNAME']."</div>
                                        </div>
                                    </div>
                                    
                                    <div class='card-body' style='line-height: 0.8'>
                                        <div class='row'>
                                            <div class='col-5 text-center'>
                                                <div>Points</div>
                                                <div class='mt-3'>" . $scorep1 . "</div>
                                            </div>
                                            <div class='col-2'></div>
                                            <div class='col-5 text-center'>
                                                <div>Points</div>
                                                <div class='mt-3'>" . $scorep2 . "</div>
                                            </div>
                                        </div>
                                        <div class='mt-4 pt-3 text-center' style='border: 1px solid black; border-width: 1px 0 0 0;'>It's " . $turn . " turn now.</div> 
                                    </div>
                                    
                                    <form action='load-game.php' method='POST'>
                                        <input type='hidden' name='game-id' value='".$row['id']."'>
                                        <input type='hidden' name='game' value='".$_GET['game']."'>
                                        <button type='submit' style='border-radius:0 0 10px 10px;' class='card-footer btn btn-dark text-center bg-dark w-100' " . ($row['turn'] != $_SESSION['userid'] ? 'disabled' : '')  . ">Play</button>
                                    <form>
                                </div>";
                        }        
                    }
                }
                echo "</div>";
            ?>
             
        </div>
      </div>
    </body>
    
    <script>
        $(document).ready(function(){
            $(".navbar-collapse").on("click", "a:not([data-toggle])", null, function () {
                $(".navbar-collapse").collapse('hide');
            }); 
            
            $('.carousel .carousel-item').each(function(){
                var minPerSlide = 3;
                var next = $(this).next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }
                next.children(':first-child').clone().appendTo($(this));
                
                for (var i=0;i<minPerSlide;i++) {
                    next=next.next();
                    if (!next.length) {
                    	next = $(this).siblings(':first');
                  	}
                    
                    next.children(':first-child').clone().appendTo($(this));
                }
            });

            
            $("#new-game").click(function() {
                $("#active").slideUp(function() {
                    $("#new-game").parent().addClass('d-none');
                    $('#active-game').parent().removeClass('d-none');
                    $("#demo").slideDown();
                });
            });
            
            $("#active-game").click(function() {
                $("#demo").slideUp(function() {
                    $("#active-game").parent().addClass('d-none');
                    $('#new-game').parent().removeClass('d-none');
                    $("#active").slideDown();
                });
            });
            
            <?php
                echo "var players = " . json_encode($users) . ";";
            ?>
            
            $('#random').click(function(){
                if($("#select").css('display') === 'none') {
                    $("#ran").hide();
                    $("#sel").hide();
                    $("#select").show(); 
                }
                else {
                    $("#ran").show();
                    $("#select").hide();
                    if($("#ran").children().css('display') !== 'none') {
                        $("#ran").children().css('display', 'none');
                    }
                    var total = players.length, selected = Math.floor( Math.random() * total );
                    $("#ran").children().text(players[selected].FNAME + " " + players[selected].LNAME);
                    $("#ran").children().attr('id', players[selected].id);
                    for (var i=0; i<total; i++) {
                        var xx = setTimeout((function(i){
                            return function(){
                                $("#random").text(players[i].FNAME + " " + players[i].LNAME);
                                
                                if(i === total-1) {
                                    $("#ran").children().fadeIn();
                                    $("#random").text('Random Opponent');
                                }
                            };
                        }(i)), i*100);
                    }
                }
            });
             
            // $("#ran").hide();
            $("#sel").hide();
            $("#start").hide();
             
            $("#select").click(function(){
                $("#ran").hide();
                $("#sel").toggle();
                $("#random").toggle();
            });
              
            $(".user").click(function(){
                $("#userid").val($(this).attr('id'));
                $("#newgame").click();
            });
        });
    </script>
</html>