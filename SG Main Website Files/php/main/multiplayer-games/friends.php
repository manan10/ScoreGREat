<?php
 	session_start();
 	if (!isset($_SESSION['email'])) {
 		header('Location: ./../../../index.html');
 	}
 	
 	$con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
?>


<!DOCTYPE html>
<html>
    <head>
	    <link rel="icon" href="./../../../image/logo.png" type="image/icon type" style="width: max-content;">
        <title>Score GREat | Friends</title>
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

            a, a:hover {
                color: black;
            }
            
            .nav-link:hover{
                color:black;
                background-color:rgba(0,0,0,0);
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
        
         <div class="py-4 bg-light">
            <div class="container mt-0">
                <div class="p-3" style="border: 1px solid black; border-width: 0 0 1px 0;">
                    <div class="d-none">
                        <button class="btn btn-dark float-right" id="add">Add Friends</button>
                        <span class="text-left" style="font-size: x-large;"><b>Friend Requests</b></span>
                    </div>
                    <div>
                        <button class="btn btn-dark float-right" id="requests">Friend Requests</button>
                        <span class="text-left" style="font-size: x-large;"><b>Add Friends</b></span>        
                    </div>
                </div>
            </div>
            
            <div id="active" class="container mb-4"  style="display: none">
                <div class='row' style='justify-content: center;'>
                    <?php 
                    
                        $stmt = $con->prepare("SELECT friends,requests FROM scoregreat.user_friends where id =:ID");
                        $stmt->bindParam(":ID",$_SESSION['userid'],PDO::PARAM_INT);
                        $stmt->execute();  
                        $req = $stmt->fetch();
                        $requests = json_decode($req['requests']);
                        
                        $stmt = $con->prepare("SELECT id,FNAME,LNAME,profile_pic FROM scoregreat.users_main where NOT id =:ID");
                        $stmt->bindParam(":ID",$_SESSION['userid'],PDO::PARAM_INT);
                        $stmt->execute();  
                        $rows = $stmt->fetchAll();
                        shuffle($rows);
                    
                        if($requests == NULL){
                            echo "
                                <div class = 'container justify-content-center mt-5'>
                                    <center>
                                        <p class='mt-5'> You have no friend Requests </p>
                                    <center>   
                                </div>
                            ";    
                        }
                        else
                        {
                            foreach($rows as $row){
                                if(in_array(intval($row['id']),$requests,TRUE)){
        
                                    if($row['profile_pic']==1)
                                        $src = "./../../../image/users/".$row['id'].".jpg";
                                    else
                                        $src = "./../../../image/users/avatar.jpg";
                                    echo '
                                        <div class="card mx-4 mt-5 col-sm-6 col-md-3">
                                            <center>
                                                <img class="card-img-top rounded-circle mt-3" src="'.$src.'" alt="Card image" style="height:150px;width:150px;">
                                                <div class="card-body">
                                                  <h4 class="card-title mb-2">'.$row["FNAME"].' '.$row["LNAME"].'</h4>
                                                  <button class="btn btn-outline-success accept" id="'.$row["id"].'">Accept</button>
                                                  <button class="btn btn-outline-danger decline" id="'.$row["id"].'">Decline</button>
                                                  <button class="btn btn-outline-success accepted" disabled>Accepted</button>
                                                  <button class="btn btn-outline-danger declined" disabled>Declined</button>
                                                  <div class="spinner-border" style="display: none;"></div>
                                                </div>
                                            </center>
                                        </div>
                                    ';
                                } 
                            }
                        }    
                    ?>
                </div>
            </div>
            
            <div id="demo" class="container">
                <div class='row' style='justify-content: center;'>
                    <?php 
                        $friends = json_decode($req['friends']);
                        $flag = 0;
                        if($friends == null) $friends = [];
                        if($requests == null) $requests = [];
                        foreach($rows as $row){
                            if(!(in_array(intval($row['id']),$friends,TRUE))){
                                if(!(in_array(intval($row['id']),$requests,TRUE))){
                                    
                                    $stmt = $con->prepare("SELECT requests FROM scoregreat.user_friends where id =:ID");
                                    $stmt->bindParam(":ID",$row['id'],PDO::PARAM_INT);
                                    $stmt->execute();  
                                    $requ = $stmt->fetch();
                                    $request = json_decode($requ['requests']);
                                    
                                    if($request == null) $request = [];
                                    
                                    if(in_array(intval($_SESSION['userid']),$request,TRUE))
                                        $button = 2;
                                    else
                                        $button = 1;

                                    $flag = 1;
                                    if($row['profile_pic']==1)
                                        $src = "./../../../image/users/".$row['id'].".jpg";
                                    else
                                        $src = "./../../../image/users/avatar.jpg";
                                    echo '
                                        <div class="card mx-4 mt-5 col-sm-6 col-md-3">
                                            <center>
                                                <img class="card-img-top rounded-circle mt-3" src="'.$src.'" alt="Card image" style="height:150px;width:150px;">
                                                <div class="card-body">
                                                  <h4 class="card-title">'.$row["FNAME"].' '.$row["LNAME"].'</h4>
                                                  <button class="btn btn-outline-primary addfriends" id="'.$row['id'].'" ' . ($button == 2 ? 'style="display: none"' : '') . '>Add Friend</button>
                                                  <button class="btn btn-outline-secondary removefriends" id="rf'.$row['id'].'" ' . ($button == 1 ? 'style="display: none"' : '') . '>Request Sent</button>
                                                  <div class="spinner-border" style="display: none;"></div>
                                                </div>
                                            </center>
                                        </div>
                                    ';
                                }
                            }    
                        }
                        if($flag == 0){
                            echo "
                                <div class = 'container justify-content-center mt-5'>
                                    <center>
                                        <p class='mt-5'> No people left to add.</p>
                                    <center>   
                                </div>
                            ";
                        }
                    ?>
                </div>
            </div>    
        </div>    
    </body>
    
    <script>
        $(document).ready(function(){
            var users = [];
            // $(".removefriends").hide();
            $(".accepted").hide();
            $(".declined").hide();
            
            $(".navbar-collapse").on("click", "a:not([data-toggle])", null, function () {
                $(".navbar-collapse").collapse('hide');
            }); 
            
            $("#add").click(function() {
                $("#active").slideUp(function() {
                    $("#add").parent().addClass('d-none');
                    $("#requests").parent().removeClass('d-none');
                    $("#demo").slideDown();
                });
            });
            
            $("#requests").click(function() {
                $("#demo").slideUp(function() {
                    $("#requests").parent().addClass('d-none');
                    $('#add').parent().removeClass('d-none');
                    $("#active").slideDown();
                });
            });
            
            $(".addfriends").click(function() {
                var id = $(this).attr('id');
                $(this).hide();
                $(this).siblings('.spinner-border').removeClass('text-secondary').addClass('text-primary').toggle();
                $.post("add-requests.php?req=1",{
                    id: $(this).attr('id')
                },
                function(data){
                    $('#' + id).hide();
                    $('#' + id).siblings('.spinner-border').removeClass('text-primary').addClass('text-secondary').toggle();
                    $('#rf' + id).show();
                });
            });   
            
            $(".removefriends").click(function() {
                var id = $(this).attr('id');
                $(this).hide();
                $(this).siblings('.spinner-border').removeClass('text-primary').addClass('text-secondary').toggle();
                $.post("add-requests.php?req=2", {
                    id: id.slice(2)
                },
                function(data){
                    $('#' + id).hide();
                    $('#' + id).siblings('.spinner-border').removeClass('text-secondary').addClass('text-primary').toggle();
                    $('#' + id.slice(2)).show();
                });
            });
            
            $(".accept").click(function() {
                var id = $(this).attr('id');
                $(this).hide();
                $(this).siblings('.btn').hide();
                $(this).siblings('.spinner-border').removeClass('text-danger').addClass('text-success').toggle();
                $.post("add-friends.php?mode=1",{
                    id: $(this).attr('id')
                },
                function(data){
                    $('#' + id).siblings('.spinner-border').toggle();
                    $('#' + id).siblings('.accepted').show();       
                });
            });  
            
            $(".decline").click(function() {
                var id = $(this).attr('id');
                $(this).hide();
                $(this).siblings('.btn').hide();
                $(this).siblings('.spinner-border').removeClass('text-success').addClass('text-danger').toggle();
                $.post("add-friends.php?mode=2",{
                    id: $(this).attr('id')
                },
                function(data){
                    $('#' + id).siblings('.spinner-border').toggle();
                    $('#' + id).siblings('.declined').show();       
                });
            });
            
            $("#save").click(function(){
                var friends = JSON.stringify(users);
                $("#myfriends").val(friends);
            });
        });
    </script>    
            
</html>
