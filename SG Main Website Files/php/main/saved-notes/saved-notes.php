<?php 
    session_start();
    if(!isset($_SESSION['email']))
       header('Location: ./../../../index.html');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" href="./../../../image/logo.png" type="image/icon type" style="width: max-content;">
        <title>Score GREat | Saved Notes</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Raleway|Kaushan+Script&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./../../../lib/bootstrap.min.css">
        <script src="./../../../lib/7aadfb7b53.js" crossorigin="anonymous"></script>
        <script src="./../../../lib/jquery.min.js"></script>
        <script src="./../../../js/jquery-cookie/jquery.cookie.js"></script>
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
                z-index: 1000;
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

            .note {
                border: 0; 
                border-radius: 15px; 
                background-color: #f8f8ff; 
                height: 150px; 
                overflow: hidden;
                cursor: pointer;
            }
            
            .n-content {
                text-overflow: ellipsis;
                overflow: hidden;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
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
                
                .note {
                    margin-top: 15px;
                }
            }
        </style>
    </head>

    <!--body class="bg-light"-->
    <body style="background-color: rgba(33, 36, 07, 0.2);">
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
                                <a class="dropdown-item" href="./../practice/practice-dashboard.php">Practice</a>
                                <a class="dropdown-item" href="./../awa/awa.php">AWA</a>
                                <a class="dropdown-item" href="./../mock-test/mt-dashboard.php">Mock Test</a>
                                <a class="dropdown-item" href="./../public-discussion/public-discussion.php">Public Discussion</a>
                                <a class="dropdown-item" href="./../multiplayer-games/mg-dashboard.php">Multiplayer Games</a>
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
        <div class="container">
            <?php
                try {
            	    $conn = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            	 
            	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $conn->prepare("SELECT * FROM scoregreat.notes WHERE username=:NAME");
                    $stmt->bindParam(":NAME", $_SESSION['name'], PDO::PARAM_STR);
                    $stmt->execute();
                    $rows = $stmt->fetchAll(); 
                    
                    if(count($rows) == 0) {
                        echo "<div class='p-3 text-center'> No Notes Available </div>";
                    }
                    
                    $i = 0;
                     echo "<div class='row mt-3'>";
                    while($i < count($rows)) {
                        $j = 0;
                       
                        for($j=0;$j<4;$j++) {
                            if($i < count($rows)) {
                                echo "<div class='col-lg-6 col-md-6 col-sm-12 py-2'>
                                        <div class='p-3 shadow card' id='" . $rows[$i]['noteid'] . "'>
                                            <div class='card-header border-0 pt-4'>
                                                <button class='btn btn-outline-danger btn-sm float-right d-none'><i class='fas fa-trash-alt'></i></button>
                                                <a href='#n".$rows[$i]['noteid']."' data-toggle='collapse' style='text-decoration: none'><h3>" . $rows[$i]['ntitle'] . "</h3></a>
                                            </div>
                                            <div id='n".$rows[$i]['noteid']."' class='card-body collapse'>" . nl2br($rows[$i]['ncontent']) . "</div>
                                        </div>
                                    </div>";
                                $i++;
                            }
                        }
                       
                    }
                     echo "</div>";
                }
            	catch(PDOException $e)
                {
                	echo $sql . "<br>" . $e->getMessage();
                }
            
            	$conn = null;
            ?>
        </div>
        <div class="modal" id="myModal"></div>
    </body>
    <script>
        $(document).ready(function(){
            $(".navbar-collapse").on("click", "a:not([data-toggle])", null, function () {
                $(".navbar-collapse").collapse('hide');
            });
            
            $(".card-header").click(function(){
                $(this).find("button").toggleClass("d-none");
            });
            
            $(".btn-outline-danger").click(function(){
                $.post("delete-note.php",
                {
                    id: $(this).parents(".card").attr('id')
                },
                function(data){
                    location.reload();
                });
            });
            
            $(".close").click(function() {
                
            });
        });
    </script>
</html>