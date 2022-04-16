<?php 
    session_start();
    if(!isset($_SESSION['email']))
        header('Location: ./../../../index.html');
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" href="./../../../image/logo.png" type="image/icon type" style="width: max-content;">
        <title>Score GREat | AWA Writing</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Raleway|Kaushan+Script&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./../../../lib/bootstrap.min.css">
        <script src="./../../../lib/7aadfb7b53.js" crossorigin="anonymous"></script>
        <script src="./../../../lib/jquery.min.js"></script>
        <script src="./../../../lib/popper.min.js"></script>
        <script src="./../../../lib/bootstrap.min.js"></script>
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
            
            .list-group-item {
                border-width: 0 0 0 10px;
                border-color: #a9a7a7;
            }
            
            .list-group-item:hover {
                background-color: dimgrey !important;
                color: white;
            }
            
            .list-group-item:nth-child(even) {
                background-color: rgba(0,0,0,0.05);
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
        </style>
    </head>

    <body class="bg-light">
        <nav class="navbar navbar-expand-md shadow sticky-top" style="width: 100%;">
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
                                <a class="dropdown-item" href="awa.php">AWA Home</a>
                                <a class="dropdown-item" href="./../practice/practice-dashboard.php">Practice</a>
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
                                <!-- <a class="dropdown-item" href="#">Link 3</a> -->
                            </div>
                        </div>
                    </li>  
                </ul>
            </div>   
        </nav>
        <div class="container mt-5" id="h2">
            <hr style='background-color:black;'>
            <h2 class="my-3 text-center">List of Topics</h2>
            <hr style='background-color:black;'>
        </div>
        <div class='container mt-4'>
            <form action="awa-db.php" method="POST">
                <div class="list-group my-3">
                    <?php 
                        $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $stmt = $con->prepare("SELECT * FROM scoregreat.awa");
                        $stmt->execute();
                        $rows = $stmt->fetchAll();
                        $i=0;
                        foreach($rows as $row)
                            echo "<a href='#' class='list-group-item list-group-item-action' id='" . $row['id'] . "'><i class='far fa-window-close float-right mr-2' style='font-size: 24px; color: white;'></i></button>" . $row['ques'] . "</a>";
                    ?>
                </div>
                <input type="hidden" id="que" name="que" value="">
                <textarea class="form-control my-3" style="height: 25em" id="content" name="content" placeholder="Enter your answer here..."></textarea>
                <button type='submit' class='btn btn-dark mb-3' id="sub" style='width: 100%;'>Submit</button>
            </form>
        </div>
        <!--<footer class="bg-dark p-3" style="color: white; font-weight: 200; font-size: small; text-align: center;"><i class="far fa-copyright"></i> 2020  2S2 Inc. Ltd., All Rights Reserved.</footer>-->
    </body>
    <script>
        $(document).ready(function(){
            $(".navbar-collapse").on("click", "a:not([data-toggle])", null, function () {
                $(".navbar-collapse").collapse('hide');
            }); 

            $("#content").hide();
            $(".fa-window-close").hide();
            $("#sub").hide();
            $(".list-group-item").click(function(){
                $("#que").val($(this).attr("id"));
                $(this).siblings().hide();
                $(".fa-window-close").show();
                $(this).css({"border-radius": "5px", "border": "0", "background-color": "dimgrey", "color": "white"});
                $(".list-group-item").mouseenter(function() {
                    $(this).css("color", "white");
                });
                $(".list-group-item").mouseleave(function() {
                    $(this).css("color", "white");
                });
                $("#content").show();
                $("#sub").show();
                $("#h2").hide();
            });
            
            $(".fa-window-close").click(function(e){
                e.stopPropagation();
                $("#que").val("");
                $(".list-group-item").show();
                $(".list-group-item").css({"border-radius": "", "border": "", "background-color": "", "color": "black"});
                $(".list-group-item").mouseenter(function() {
                    $(this).css("color", "white");
                });
                $(".list-group-item").mouseleave(function() {
                    $(this).css("color", "black");
                });
                $("#content").hide();
                $(".fa-window-close").hide();
                $("#sub").hide();
                $("#h2").show();
            });
        });        
    </script>
</html>