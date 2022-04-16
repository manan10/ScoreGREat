<?php
    session_start();
    
    $t = $_COOKIE['c-tab'];
    
    if($t == 't0') {
        $obj = json_decode($_SESSION['set1'], true);
        $temp = json_decode($_SESSION['rq-set1'], true);
        // $obj = array_merge($obj, $temp);
        $tI = 0;
    }
    else if($t == 't1') {
        $obj = json_decode($_SESSION['set2'], true);
        $temp = json_decode($_SESSION['rq-set2'], true);
        $tI = 1;
    }
    else if($t == 't2') {
        $obj = json_decode($_SESSION['set3'], true);
        $temp = json_decode($_SESSION['rq-set3'], true);
        $tI = 2;
    }
    else if($t == 't3') {
        $obj = json_decode($_SESSION['set4'], true);
        $temp = json_decode($_SESSION['rq-set4'], true);
        $tI = 3;
    }
    else if($t == 't4') {
        $obj = json_decode($_SESSION['set5'], true);
        $temp = json_decode($_SESSION['rq-set5'], true);
        $tI = 4;
    }
    
    foreach($temp as $v) {
        if(!in_array($v, $obj))
            array_splice($obj, $v['sno']-1, 0, $temp);
    }
    
    $seq = json_decode($_SESSION['seq']);
    if($seq[0] == 0 && $seq[4] == 0) {
        $sequence = ["Quants Section 1", "Verbal Section 1", "Quants Section 2", "Verbal Section 2", "Quants Section 3"];
    }
    else if($seq[0] == 0 && $seq[4] == 1) {
        $sequence = ["Quants Section 1", "Verbal Section 1", "Quants Section 2", "Verbal Section 2", "Verbal Section 3"];
    }
    else if($seq[0] == 1 && $seq[4] == 0) {
        $sequence = ["Verbal Section 1", "Quants Section 1", "Verbal Section 2", "Quants Section 2", "Quants Section 3"];
    }
    else if($seq[0] == 1 && $seq[4] == 1) {
        $sequence = ["Verbal Section 1", "Quants Section 1", "Verbal Section 2", "Quants Section 2", "Verbal Section 3"];
    }
?>

<!DOCTYPE html>
<html>
    <head>
	    <link rel="icon" href="./../../../image/logo.png" type="image/icon type" style="width: max-content;">
        <title>Score GREat | Set Review</title>
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
        <div class='container-fluid ml-2 mt-3'>
            <a class='btn btn-dark btn-md' href='performance-review.php'><i class='fas fa-angle-left'></i> Performance Review</a>
        </div>
        <div class='container mt-0'>
            <?php 
                echo "<h2 class='text-center font-weight-bold mb-4'>" . $sequence[$tI] . "</h2>";
                $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                if($seq[$tI] == 0)
                    $stmt = $con->prepare("SELECT * FROM scoregreat.ques_math WHERE id=:ID;");
                else if($seq[$tI] == 1)
                    $stmt = $con->prepare("SELECT * FROM scoregreat.ques_verbal WHERE id=:ID;");
            
                $i = 1;
                foreach($obj as $x) {
                    if(array_key_exists('que', $x))
                        $stmt->bindParam(":ID", $x['que'] , PDO::PARAM_INT);
                    else if(!array_key_exists('que', $x))
                        $stmt->bindParam(":ID", $x['qid'] , PDO::PARAM_INT);
                    $stmt->execute();
                    $row = $stmt->fetch();
                    
                    if($seq[$tI] == 0) {
                        echo "<div class='card shadow mb-5 text-left' style='border-radius: 10px;'>
                                <div class='card-header' style='background-color:#80808030;'>
                                    " . $i . ") " . $row['ques'] . "        
                                </div>
                                <div class='card-body'>
                                    <p> Correct Answer:&nbsp;&nbsp;&nbsp;&nbsp;" . $row['ans'] . "</p>
                                    <p> Your Answer:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . (array_key_exists('ans', $x) ? $x['ans'] : 'Not Answered') . "</p>
                                </div>";
                    }
                    else if($seq[$tI] == 1) {
                        $ans = json_decode($row['ans']);
                        echo "<div class='card shadow mb-5' style='border-radius: 10px'>
                                <div class='card-header' style='background-color:#80808030;'>
                                    " . $i . ") " . $row['ques'] . "        
                                </div>";
                        if(array_key_exists('ans', $x)) {        
                            if(count($ans) == 2) {                  
                                echo "<div class='card-body'>
                                        <p> Correct Answer:&nbsp;&nbsp;&nbsp;" . $ans[0] . ", " . $ans[1] . "</p>
                                        <p> Your Answer:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $x['ans'][0] . ", " . $x['ans'][1] . "</p>
                                    </div>";
                            }
                            else {
                                echo "<div class='card-body'>
                                        <p> Correct Answer:&nbsp;&nbsp;&nbsp;&nbsp;" . $ans[0] . ", " . $ans[1] . ", " . $ans[2] . "</p>
                                        <p> Your Answer:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $x['ans'][0] . ", " . $x['ans'][1] . ", " . $x['ans'][2] . "</p>
                                    </div>";
                            }
                        }
                        else {
                            if(count($ans) == 2) {                  
                                echo "<div class='card-body'>
                                        <p> Correct Answer:&nbsp;&nbsp;&nbsp;" . $ans[0] . ", " . $ans[1] . "</p>
                                        <p> Your Answer:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Not Answered</p>
                                    </div>";
                            }
                            else {
                                echo "<div class='card-body'>
                                        <p> Correct Answer:&nbsp;&nbsp;&nbsp;&nbsp;" . $ans[0] . ", " . $ans[1] . ", " . $ans[2] . "</p>
                                        <p> Your Answer:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Not Answered</p>
                                    </div>";
                            }
                        }
                    }
                    if(array_key_exists('result', $x) && strcmp($x['result'],"Correct") == 0) {    
                        echo "<div class='card-footer text-center' style='background-color: #27a71e'>
                                <i class='fas fa-check'></i>
                            </div>";
                    } 
                    else {
                        echo "<div class='card-footer text-center' style='background-color: tomato'>
                                <i class='fas fa-times'></i>
                            </div>";
                    }
                    echo "</div>";
                    $i++;
                }
            ?>
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