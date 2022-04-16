<?php 
    session_start();
    if(!isset($_SESSION['email']))
       header('Location: ./../../../index.html');
       
    $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    
    
    if($_SESSION['counter'] >= 5)
        header('Location: result-gen.php');
    $questions = json_decode($_SESSION['round-ques']);
    $id = $questions[$_SESSION['counter']];
    $_SESSION['que'] = $id ;
    
    $str="SELECT * FROM scoregreat.words where id = :ID";
    $stmt = $con->prepare($str);
    $stmt->bindParam(":ID", $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch();
    
    $options = json_decode($row['opt']);
    $validform = "checkmath()";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" href="./../../../image/logo.png" type="image/icon type" style="width: max-content;">
        <title>Score GREat | Word Play</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Raleway|Kaushan+Script|Teko|Source+Serif+Pro|Slabo+27px|Rajdhani&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./../../../lib/bootstrap.min.css">
        <script src="./../../../lib/7aadfb7b53.js" crossorigin="anonymous"></script>
        <script src="./../../../lib/jquery.min.js"></script>
        <script src="./../../../js/jquery-cookie/jquery.cookie.js"></script>
        <script src="./../../../lib/popper.min.js"></script>
        <script src="./../../../lib/bootstrap.min.js"></script>
        <script type="text/javascript" src="./../../../js/jquery-countdown/jquery.simple.timer.js"></script>
        
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
            
            .nav-link {
                color:black;    
            }
            
            .nav-link:hover{
                color:black;
                background-color:rgba(0 0 0 0);
            }
            
            nav > a > span, .chat-popup > span {
            	font-family: 'Kaushan Script', cursive;
            	font-weight: 550;
            	font-size: x-large;
            }

            a, a:hover, a.disabled {
                color: black !important;
            }
            
            .nav-link:hover{
                color:black;
                background-color:rgba(0,0, 0, 0);
            }
            
            .dropdown-menu {
                background-color: rgba(0, 0, 0, 0.8);
            }
            
            .dropdown-menu > a {
                color: white;
            }
            
            .form-check {
                width: 90% !important;
            }

            
            input[type='radio'] {
                display: none;
            }
            
            #opts label {
                background-color: #c1c1c1;
                padding: 5px 10px;
                border-radius: 8px;
                cursor: pointer;
                width: inherit;
            }
            
            #correct {
                border-width: 0 1px 0 0;
                border-color: black;
                border-style: solid;
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
                .chat-popup {
                    top:200px;
                } 
            }
            
            .form-check{
                font-family:Source Serif Pro;
            }
        </style>
    </head>

    <body>
        <nav class="navbar navbar-expand-md" style="width: 100%;">
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
        
        <div class="container py-4 mx-auto mt-5">
            <form action="eval.php" onsubmit="return <?php echo $validform;?>" method="POST">
                <div class="form-group">
                    <label for="que"><b>Question <?php echo ($_SESSION['counter'] + 1); ?></b></label>
                     
                    <p></p>
                   
                    <textarea class="form-control mt-1 py-2" name="que" rows="1" id="que" readonly><?php   
                        echo "Select the synonym/meaning of the word --> ".$row['word'];
                        $_SESSION['ques'] = $row['word'];
                            
                        echo "</textarea></div>";
                
                        shuffle($options);
                        echo "<div class='row justify-content-center d-flex'>";
                        for($o = 0; $o < count($options); $o++) {
                            echo "<div class='form-check col-lg-5 m-2 justify-content-center d-flex' id='opts'>
                                    <label class='form-check-label' for='opt" . ($o + 1) . "'>
                                        <input type='radio' class='form-check-input' name='ans' id='opt" . ($o + 1) . "' value='" . $options[$o]. "'> &nbsp;" . $options[$o]."
                                    </label>
                                </div>";
                        }
                        echo "</div>"; 
                        echo "<input type='hidden' id='ans1' name='ans1' value='".$row['ans']."'>";
                        $con = null;
                    ?>
                    <div class='row mt-5'>
                        <div class='col-6 col-sm-6 text-center' id='correct'>
                            <label>Correct</label>
                            <div class=''><?php echo $_SESSION['correct']; ?></div>
                        </div>
                        <div class='col-6 col-sm-6 text-center'>
                            <label>Incorrect</label>
                            <div class=''><?php echo ($_SESSION['counter'] - $_SESSION['correct']); ?></div>
                        </div>
                    </div>
                    <button type="submit" id='sBtn' style="display: none;"></button>
            </form>
        </div>
    </body>

    <script>
        $(document).ready(function(){
            $(".navbar-collapse").on("click", "a:not([data-toggle])", null, function () {
                $(".navbar-collapse").collapse('hide');
            });

            $("textarea").height($("textarea")[0].scrollHeight);
            $('.nav-link, .navbar-brand').addClass('disabled');
            
            $('[name="ans"]').click(function() {
                if(!$(this).attr('disabled')) {
                    if($(this).val() === $('#ans1').val()) {
                        $(this).parent().css("background-color", "limegreen");
                    }
                    else {
                        $(this).parent().css("background-color", "red");
                    }
                }
                
                $("#sBtn").click();
                $('[name="ans"]').attr('disabled', 'disabled');

            });
        });        
    </script> 
</html>    