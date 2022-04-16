<?php 
    session_start();
    if(!isset($_SESSION['email']))
       header('Location: ./../../../index.html');
       
    $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" href="./../../../image/logo.png" type="image/icon type" style="width: max-content;">
        <title>Score GREat | My Profile</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Raleway|Kaushan+Script|Teko|Source+Serif+Pro|Slabo+27px&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./../../../lib/bootstrap.min.css">
        <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        
        <script src="./../../../lib/7aadfb7b53.js" crossorigin="anonymous"></script>
        <script src="./../../../lib/jquery.min.js"></script>
        <script src="./../../../js/jquery-cookie/jquery.cookie.js"></script>
        <script src="./../../../lib/popper.min.js"></script>
        <script src="./../../../lib/bootstrap.min.js"></script>

        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        
        <style>
            body {
                font-family: 'Raleway', sans-serif;
                font-size: large;
                font-weight: 700;
            }

            nav {
                background-image: linear-gradient(to right, #e6e600, #ffa31a); 
                z-index: 1000;
            }
            
            .modal-header{
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

            #mtable > div > div > .col-sm-12:first-child{
                justify-content:start;
                display:flex;
            }
            
            .dropdown-menu {
                background-color: rgba(0, 0, 0, 0.8);
            }
            
            .dropdown-menu > a {
                color: white;
            }
            
            .nav-tabs{
                border-radius:0px !important;
            }
            
            .active{
                background-color:white;
                color:black !important;
            }
            
            .nav-tabs{
                border-radius:0px;
            }
            
            .data {
                width: 50%;
                border-radius: 15px;
                padding-top: 10px;
                padding-left: 5px;
                padding-right: 5px;
                /*background-color: #343A40;*/
                background-color: #112121;
                color:white;
            }
            
            .number{
                font-family: Source Serif Pro;
            }
            
            .c-data {
                display: table-cell;
                width: 1%;
                border-radius: 50%;
                height: 180px;
                vertical-align: middle;
            }
            
            .review-card:hover {
                text-decoration: none;
            }
            
            hr{
                 background-color:#c0afaf;
            }
            
            .card-header{
                background-color:#111212 !important;
                color:white;
            }
            
            .card-footer{
                color:black;
            }
            
            .btn-calc-note {
                border-radius: 10px;
            }
            
            #pro-pic{
                width:150px;
                height:150px;
            }

            .page-item a{
            	color:black;
            }

            .pagination .active a{
            	color:white;
            	background-color: black;
            }
            
            .paginate_button.active a {
                background-color: black !important;
                border: 0 !important;
                border-radius: 0 !important;
            }
            
            .paginate_button:not(.active) a:hover {
                color: black !important;
            }
            
            @media screen and (min-width: 768px) {
                li > a:hover, li > .active, .dropdown-item:hover {
                    background-color: #000000;
                    color: white;
                    border-radius: 5px;
                }
            }
            
            #pro-pic-in{
                width:50px;
                height:50px;
            }
            
            @media screen and (max-width: 767px) {
                .sideNav {
                    height: 100%;
                    width: 0;
                    position: fixed;
                    z-index: 1;
                    top: 0;
                    left: -10px;
                    background-color: rgba(0, 0, 0, 0.9);
                    overflow-x: hidden;
                    transition: 0.5s;
                    padding: 24px 0px 50px 0px;
                }

                #mtable > div > div > .col-sm-12:first-child{
                    justify-content:none;
                    display:block;
                }

                .sideNav a{
                	color:white;
                	background-color: black;
                }

                .rounded-circle{
                    width:30%;
                }
                
                #main {
                    margin-left: 0;
                }
                

                .carousel-item.active, .carousel-item-next, .carousel-item-prev {
                    width: 640px;
                    height: 360px;
                    display: block;
                }

                .dropdown > a > i {
                    margin-right: -1%;
                }
            }
        </style>
    </head>

    <body>
        <nav class="navbar navbar-expand-md" style="width: 100%;">
        	<button class="navbar-toggler p-0" type="button" data-toggle="collapse" data-target="#nav-menu">
                <i class='fas fa-bars' style="font-size:28px"></i>
            </button>
            <button class="navbar-toggler p-0" type="button" style="display: none;">
                <i class='far fa-window-close' style="font-size:28px"></i>
            </button>
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
                                <a class="dropdown-item" href="./../multiplayer-games/mg-dashboard.php">Multiplayer Games</a>
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
                                <a class="dropdown-item" href="./../../new-password/new-password.php"> Change Password</a>
                                <a class="dropdown-item" href="./../../logout.php"><i class='fas fa-sign-out-alt pr-2'></i> Log Out</a>
                            </div>
                        </div>
                    </li>  
                </ul>
            </div>   
        </nav>
        
        <div class="container-fluid mx-auto d-block" style="background-image: linear-gradient(to right, #e6e600, #ffa31a)">
           <div class="pt-2">
               <center>
                   <?php
                        $stmt = $con->prepare("SELECT id,profile_pic,profile_ext FROM scoregreat.users_main where EMAIL= :EMAIL");
                        $stmt->bindParam(":EMAIL",$_SESSION['email'],PDO::PARAM_STR);
                        $stmt->execute();
                        $rowPRO = $stmt->fetch();
                        $pro = './../../../image/users/avatar.jpg';
                        if($rowPRO['profile_pic']!=0)
                            $pro = './../../../image/users/'.$rowPRO['id'].'.'.$rowPRO['profile_ext'];
                    ?>
                    <img src="<?php echo $pro; ?>" id="pro-pic" width="10%" class="rounded-circle" alt="User Profile Picture">
                    
                    <button type='button' id='dp' data-toggle="tooltip" title="Change Profile Photo" class='btn btn-success btn-calc-note shadow-lg pt-2 mt-5'><i class='fas fa-pen' style='font-size: larger;'></i></button>
                    <button type='button' id='rdp' data-toggle="tooltip" title="Remove Profile Photo" class='btn btn-success btn-calc-note shadow-lg pt-2 mt-5'><i class='fas fa-trash-alt' style='font-size: larger;'></i></button>
                    <div class='mt-1' style='' id='profile'>
                       <div style='font-size: 250%;color:black !important;' id='p-name'><b><?php echo $_SESSION['name'] ?></b></div>
                       <div class='number' style='font-size: medium;color:black !important;'><?php echo $_SESSION['email'] ?></div>
                    </div>
                    <?php
                        if($_COOKIE['screen'] < 981){
                            echo "<br>";
                            $navigate = "sideNav";
                            $ul = "nav nav-tabs justify-content-center mt-5 flex-column";
                        }   
                        else{
                            $navigate = "container-fluid";
                            $ul = "nav nav-tabs justify-content-center mt-5";
                        }
                    ?>
                    <div class="<?php echo $navigate; ?>" id='navigate'>
                        <ul class="<?php echo $ul; ?>" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#personal-data">Statistics</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#prac">Rankings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#mocks">My Mocks</a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#games">My Games</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#awa">My AWA</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#public">My Questions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#friends">My Friends</a>
                            </li>
                        </ul>
                    </div>
                </center>
            </div>
        </div>

        <div class="container-fluid mb-5" id="content" style="background-color:">
            <div class="tab-content" id="main">
                <div id="awa" name="awa" class="container tab-pane fade"><br>
                    <div class="mx-auto d-block text-center">
                        <hr>
                        <h1 class="mb-3"><b>Your AWA Submissions</b></h1>
                        <hr class="mb-5">
                        <?php
                            $stmt = $con->prepare("SELECT * FROM scoregreat.awa_data WHERE username=:NAME;");
                            $stmt->bindParam(":NAME", $_SESSION['name'], PDO::PARAM_STR);
                            $stmt->execute();
                            $rowsAWA = $stmt->fetchAll();
                        
                            if(count($rowsAWA) == 0)
                                echo "<div class='text-center mt-5' style='font-size: larger;'>You have not submitted any AWA yet.</div>";
                            
                            foreach($rowsAWA as $row) {
                                $stmt = $con->prepare("SELECT * FROM scoregreat.awa WHERE id=:ID;");
                                $stmt->bindParam(":ID", $row['queid'], PDO::PARAM_INT);
                                $stmt->execute();
                                $que = $stmt->fetch();
                                $cmnts = json_decode($row['comments']);
                                
                                echo "<a target='_blank' class='card shadow-lg mb-4 text-left review-card' href='my-profile-awa.php' id='" . $row['awaid'] . "' style='border-radius: 10px;'>
                                        <div class='card-header bg-light'>
                                            <span>" . $que['ques'] . "</span>
                                        </div>
                                        <div class='card-body'>
                                            <span>" . nl2br($row['essay']) . "</span>
                                        </div>
                                        <div class='card-footer'>
                                            <div class='' style='font-size: medium;'>
                                                <span>" . $row['rating'] . " <i class='fas fa-star' style='font-size: larger;'></i></span> ";
                                                if($row['comments'] != null) {
                                                    echo "<span>&nbsp;&nbsp;<i class='far fa-comments' style='font-size: larger;'></i> : " . count($cmnts) . "</span>";
                                                }
                                                else {
                                                     echo "<span>&nbsp;&nbsp;<i class='far fa-comments' style='font-size: larger;'></i> : 0</span>";
                                                }
                                      echo "</div>
                                    </div>
                                </a>";
                            }
                        ?>
                    </div>
                </div>
               
                <div id="public" class="container tab-pane fade"><br>
                    <div class="mx-auto d-block text-center">
                        <hr>
                        <h1 class="mb-3"><b>Questions You Asked</b></h1>
                        <hr class="mb-5">
                        <?php
                          $stmt = $con->prepare("SELECT * FROM scoregreat.public_discussion_data WHERE username=:NAME;");
                            $stmt->bindParam(":NAME", $_SESSION['name'], PDO::PARAM_STR);
                            $stmt->execute();
                            $rowsPD = $stmt->fetchAll();
                            
                            if(count($rowsPD) == 0)
                                echo "<div class='text-center mt-3' style='font-size: larger;'>You have not asked any question yet.</div>";
                            
                            foreach($rowsPD as $row) {
                                $cmnts = json_decode($row['answers']);
                                echo "<a target='_blank' class='card shadow-lg mb-4 text-left review-card' href='my-profile-que.php?propic=".$pro."' id='" . $row['pdid'] . "' style='border-radius: 10px;'>
                                        <div class='card-header bg-light d-flex'>
                                            <img src='". $pro."' id='pro-pic-in' class='rounded-circle' alt='User Profile Picture'>
                                            <span class='ml-2'>
                                                <div style='font-size: large'>" . $row['username'] . "</div>
                                                <div style='font-size: small'>" . $row['email'] . "</div>
                                            </span> 
                                        </div>
                                        <div class='card-body'>
                                            <span>" . nl2br($row['que']) . "</span>
                                        </div>
                                        <div class='card-footer'>
                                            <div class='' style='font-size: medium;'>";
                                            if($row['answers'] != null) {
                                                echo "<span>&nbsp;&nbsp;<i class='far fa-comments' style='font-size: larger;'></i> : " . count($cmnts) . "</span>";
                                            }
                                            else {
                                                 echo "<span>&nbsp;&nbsp;<i class='far fa-comments' style='font-size: larger;'></i> : 0</span>";
                                            }    
                                        echo "</div>
                                        </div>
                                    </a>";
                            }
                        ?>
                    </div>
                </div>
                
                <div id="mocks" class="container tab-pane"><br>
                    <div class="mx-auto d-block text-center">
                        <hr>
                        <h1 class="mb-3"><b>Your Mock History</b></h1>
                        <hr>
                        <?php
                            $str = "SELECT mscore,mqscore,mvscore FROM scoregreat.users_score WHERE email=:EMAIL;";
                            $stmt = $con->prepare($str);
                            $stmt->bindParam(":EMAIL", $_SESSION['email'], PDO::PARAM_STR);
                            $stmt->execute();
                            $rowM = $stmt->fetch();
                            
                            $total = json_decode($rowM['mscore']);
                            $quants = json_decode($rowM['mqscore']);
                            $verbal = json_decode($rowM['mvscore']);
                        ?>
                        <div class='row mt-4'>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo ($total == NULL) ? "-" :  max($quants); ?></h2>
                                    <p>Best Quants Score</p>
                                </div>
                            </div>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo ($total == NULL) ? "-" :  max($verbal);;?></h2>
                                    <p>Best Verbal Score</p>
                                </div>
                            </div>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo ($total == NULL) ? "-" :  max($total);;?></h2>
                                    <p>Best Total Score</p>
                                </div>
                            </div>
                        </div>    
                        
                        <?php
                            if($total == NULL)
                                echo "
                                    <div class='conatainer mt-5'>
                                        <p> You haven't completed any Mocks </p>
                                    </div>";
                            else{
                                 echo "
                                    <div class='table-responsive text-nowrap'>
                                        <table class='table table-bordered table-hover table-striped text-center my-5'>
                                            <thead class='thead-dark'>
                                                <tr>
                                                    <th>Test No</th>
                                                    <th>Quants Score</th>
                                                    <th>Verbal Score</th>
                                                    <th>Total Score</th>
                                                </tr>
                                            </thead>    ";
                                $i=0;            
                                while($i < count($total))
                                {
                                    echo "
                                            <tr class='number'>
                                                <td>".($i+1)."</td>
                                                <td>".$quants[$i]."</td>
                                                <td>".$verbal[$i]."</td>
                                                <td>".$total[$i]."</td>
                                            </tr>";
                                    $i++;
                                }
                                echo "</table>
                                </div>";
                            }
                        ?>    
                    </div> 
                </div>    
                
                <div id="prac" class="container tab-pane"><br>
                    <div class="mx-auto d-block text-center">
                        <hr>
                        <h1 class="mb-3"><b>General Practice Rankings</b></h1>
                        <hr>
                        
                        <?php
                            $stmt = $con->prepare("SELECT pscore,ppercent FROM scoregreat.users_score WHERE email=:EMAIL;");
                            $stmt->bindParam(":EMAIL", $_SESSION['email'], PDO::PARAM_STR);
                            $stmt->execute();
                            $rowsPR = $stmt->fetch();
                            
                            $str = "SELECT pscore, ppercent, scoregreat.users_main.email, FNAME, LNAME FROM scoregreat.users_score INNER JOIN scoregreat.users_main ON scoregreat.users_main.id = scoregreat.users_score.id order by pscore DESC;";
                            $stmt = $con->prepare("$str");
                            $stmt->execute();
                            $rowsRK = $stmt->fetchAll();
                            
                            for($j = 0; $j < count($rowsRK); $j++){
                                if(strcmp($_SESSION['email'],$rowsRK[$j]['email'])==0)
                                    break;
                            }        
                        ?> 
                        
                        <div class='row my-5'>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo $rowsPR['pscore'];?></h2>
                                    <p>Your Points</p>
                                </div>
                            </div>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo $rowsPR['ppercent'];?></h2>
                                    <p>Your Percentage</p>
                                </div>
                            </div>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo ($j+1);?></h2>
                                    <p>Your Rank</p>
                                </div>
                            </div>
                        </div>    
                         
                        <?php
                            echo "
                                <div class='table-responsive text-nowrap' id='mtable'>
                                    <table class='table table-bordered table-hover table-striped text-center my-5' id='myTable'>
                                        <thead class='thead-dark'>
                                            <tr> 
                                                <th class'th-sm'>Rank</th>
                                                <th class'th-sm'>Name</th>
                                                <th class'th-sm'>E-Mail ID</th>
                                                <th class'th-sm'>Percentage</th>
                                                <th class'th-sm'>Points</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                                        
                            for($i = 0; $i < count($rowsRK); $i++){
                                if($i!=$j)
                                    echo "<tr>";
                                else
                                    echo "<tr style='background-color:#a2a1a1;'>";
                                
                                        echo "<td class='number'>".($i+1)."</td>
                                              <td>". $rowsRK[$i]['FNAME'] ." ". $rowsRK[$i]['LNAME'] ."</td>
                                              <td class='number'>". $rowsRK[$i]['email'] ."</td>
                                              <td class='number'>". $rowsRK[$i]['ppercent'] ."</td>
                                              <td class='number'>". $rowsRK[$i]['pscore']."</td>
                                        </tr>";
                            }
                                echo "</tbody>
                                </table>
                            </div>";
                        ?>
                    </div> 
                </div>
                
                <div id="friends" class="container tab-pane"><br>
                    <div class="mx-auto d-block text-center">
                        <?php 
                            $stmt = $con->prepare("SELECT friends FROM scoregreat.user_friends where id =:ID");
                            $stmt->bindParam(":ID",$_SESSION['userid'],PDO::PARAM_INT);
                            $stmt->execute();  
                            $fri = $stmt->fetch();
                            $friends = json_decode($fri['friends']);
                            
                            if($friends == NULL){
                                echo "
                                    <div class = 'container justify-content-center mt-5'>
                                        <center>
                                            <p class='mt-5'> You have no friends.</p>
                                            <a class='btn btn-outline-dark' href='./../multiplayer-games/friends.php'>Add Friends</a>
                                        <center>   
                                    </div>
                                ";    
                            }
                            else
                            {
                                echo "<div class='row'  style='justify-content: center;'>";
                                
                                $stmt = $con->prepare("SELECT id,FNAME,LNAME,profile_pic FROM scoregreat.users_main where NOT id =:ID");
                                $stmt->bindParam(":ID",$_SESSION['userid'],PDO::PARAM_INT);
                                $stmt->execute();  
                                $rowsfr = $stmt->fetchAll();
                                
                                foreach($rowsfr as $row){
                                    if(in_array(intval($row['id']),$friends,TRUE)){
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
                                                      <button class="btn btn-outline-danger remove" id="rf'.$row["id"].'">Remove Friend</button>
                                                      <button class="btn btn-outline-secondary removed" disabled>Removed</button>
                                                      <div class="spinner-border text-danger" style="display: none;"></div>
                                                    </div>
                                                </center>
                                            </div>
                                        ';
                                    } 
                                }
                            echo "</div>";
                            }
                        ?>    
                    </div>    
                </div>      
                <div id="games" class="container tab-pane"><br>
                    <div class="mx-auto d-block text-center">
                        <hr>
                        <h1 class="mb-3"><b>Your Game History</b></h1>
                        <hr>
                        
                        <?php
                            $stmt = $con->prepare("SELECT * FROM scoregreat.games WHERE (p1=:ID or p2=:ID) and finished=1;");
                            $stmt->bindParam(":ID", $_SESSION['userid'], PDO::PARAM_INT);
                            $stmt->bindParam(":EMAIL", $_SESSION['email'], PDO::PARAM_STR);
                            $stmt->execute();
                            $rowsG = $stmt->fetchAll();
                            
                            $ngames = count($rowsG);
                            
                            $wins = 0;
                            foreach($rowsG as $game){
                                if($game['winner']==$_SESSION['userid'])
                                    $wins++;    
                            }
                        ?> 

                        <div class='row mt-4'>
                            <div class='col-md-12 col-lg-1 justify-content-center d-flex mt-3'>
                            </div>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo $ngames;?></h2>
                                    <p>Games Played</p>
                                </div>
                            </div>
                            <div class='col-md-12 col-lg-2 justify-content-center d-flex mt-3'>
                            </div>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo $wins;?></h2>
                                    <p>Wins</p>
                                </div>
                            </div>
                            <div class='col-md-12 col-lg-1 justify-content-center d-flex mt-3'>
                            </div>
                        </div>
                        
                        <?php
                            if($ngames == 0)
                                echo "
                                    <div class='conatainer mt-5'>
                                        <p> You haven't completed any games </p>
                                    </div>";
                            else{        
                                $stmt = $con->prepare("SELECT FNAME,LNAME FROM scoregreat.users_main;");
                                $stmt->execute();
                                $users = $stmt->fetchAll();
                                echo "
                                    <div class='table-responsive text-nowrap'>
                                        <table class='table table-borderless table-striped text-center my-5'>
                                            <thead class='thead-dark'>
                                                <tr>
                                                    <th class'th-sm'>No</th>
                                                    <th class'th-sm'>v/s</th>
                                                    <th class'th-sm'>Game</th>
                                                    <th class'th-sm'>Your Points</th>
                                                    <th class'th-sm'>Oppo Points</th>
                                                    <th class'th-sm'>Winner</th>
                                                </tr>
                                            </thead>
                                            <tbody style='border: 1px solid silver;border-width:0 0 1px 0;'>";
                                            
                                for($i = 0; $i < count($rowsG); $i++){
                                    if($rowsG[$i]['p1'] == $_SESSION['userid']){
                                        $opp = $users[$rowsG[$i]['p2'] - 1]['FNAME']." ".$users[$rowsG[$i]['p2'] - 1]['LNAME'];
                                        $yscore = $rowsG[$i]['score_p1'];
                                        $oscore = $rowsG[$i]['score_p2'];
                                    }
                                    else{
                                        $opp = $users[$rowsG[$i]['p1'] - 1]['FNAME']." ".$users[$rowsG[$i]['p1'] - 1]['LNAME'];
                                        $yscore = $rowsG[$i]['score_p2'];
                                        $oscore = $rowsG[$i]['score_p1'];
                                    }
                                    
                                    if($rowsG[$i]['game']==1)
                                        $game = 'Word Play';
                                    else
                                        $game = 'Beat The Clock';
                                    
                                    echo "<tr>";
                                    echo "<td class='number'>".($i+1)."</td>
                                          <td>".$opp."</td>
                                          <td class='number'>". $game ."</td>
                                          <td class='number'>". $yscore ."</td>
                                          <td class='number'>". $oscore."</td>";
                                    if($yscore > $oscore)    
                                        echo "<td><i class='far fa-thumbs-up' style='color: limegreen'></td>";
                                    else if($oscore > $yscore)
                                        echo "<td><i class='far fa-thumbs-down' style='color: tomato'></td>";
                                    else
                                        echo "<td><i class='far fa-handshake' style='color: dimgrey'></td>";
                                              
                                        echo "</tr>";
                                }
                                    echo "</tbody>
                                    </table>
                                </div>";
                            }    
                        ?>
                    </div>
                </div>
                
                <div id="personal-data" class="container tab-pane active"><br>
                    <?php
                        $totalAwa = count($rowsAWA) | 0;
                        $avgRating = 0;
                        if($totalAwa > 0) {
                            foreach($rowsAWA as $row) {
                                $avgRating += $row['rating'];
                            }
                            $avgRating = round(($avgRating / $totalAwa), 2);
                        }
                        
                        $totalQue = count($rowsPD) | 0;
                        $avgAns = 0;
                        if($totalQue > 0) {
                            foreach($rowsPD as $row) {
                                if($row['answers'] != null)
                                  $avgAns += count(json_decode($row['answers'])); 
                            }
                            $avgAns = round(($avgAns / $totalQue), 2);
                        }
                        
                        $totalAWA = count($rowsAWA) | 0;
                        $avgComm = 0;
                        if($totalAWA > 0) {
                            foreach($rowsAWA as $row) {
                                if($row['comments'] != null)
                                  $avgComm += count(json_decode($row['comments'])); 
                            }
                            $avgComm = round(($avgComm / $totalAWA), 2);
                        }
                    ?>    
                    <div class="mx-auto d-block text-center">
                        <hr>
                        <h1 class="mb-3"><b>Analytical Writing</b></h1>
                        <hr>
                        
                        <div class='row mt-4 mb-4'>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo $totalAwa;?></h2>
                                    <p>Total AWA</p>
                                </div>
                            </div>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo $avgRating;?></h2>
                                    <p>Average Rating</p>
                                </div>
                            </div>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo $avgComm;?></h2>
                                    <p>Comments/AWA</p>
                                </div>
                            </div>
                        </div> 
                        
                        <hr class="mt-5">
                        <h1 class="mb-3"><b>Discussion Activity</b></h1>
                        <hr>
                        
                        <div class='row mt-4'>
                            <div class='col-md-12 col-lg-1 justify-content-center d-flex mt-3'>
                            </div>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo $totalQue;?></h2>
                                    <p>Questions Asked</p>
                                </div>
                            </div>
                            <div class='col-md-12 col-lg-2 justify-content-center d-flex mt-3'>
                            </div>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo $avgAns;?></h2>
                                    <p>Responses/Post</p>
                                </div>
                            </div>
                            <div class='col-md-12 col-lg-1 justify-content-center d-flex mt-3'>
                            </div>
                        </div>
                        
                        <hr class="mt-5">
                        <h1 class="mb-3"><b>General Practice</b></h1>
                        <hr>
                        
                        <div class='row mt-4'>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo $rowsPR['pscore'];?></h2>
                                    <p>Your Points</p>
                                </div>
                            </div>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo $rowsPR['ppercent'];?></h2>
                                    <p>Your Percentage</p>
                                </div>
                            </div>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo ($j+1);?></h2>
                                    <p>Your Rank</p>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="mt-5">
                        <h1 class="mb-3"><b>Game History</b></h1>
                        <hr>
                        
                        <div class='row mt-4'>
                            <div class='col-md-12 col-lg-1 justify-content-center d-flex mt-3'>
                            </div>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo $ngames;?></h2>
                                    <p>Games Played</p>
                                </div>
                            </div>
                            <div class='col-md-12 col-lg-2 justify-content-center d-flex mt-3'>
                            </div>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo $wins;?></h2>
                                    <p>Wins</p>
                                </div>
                            </div>
                            <div class='col-md-12 col-lg-1 justify-content-center d-flex mt-3'>
                            </div>
                        </div>
                        
                        <hr class="mt-5">
                        <h1 class="mb-3"><b>Mock Tests</b></h1>
                        <hr>
                        
                        <div class='row mt-4'>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo max($quants);?></h2>
                                    <p>Best Quants Score</p>
                                </div>
                            </div>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo max($verbal);?></h2>
                                    <p>Best Verbal Score</p>
                                </div>
                            </div>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo max($total);?></h2>
                                    <p>Best Total Score</p>
                                </div>
                            </div>
                            
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo ceil(array_sum($quants)/count($quants));?></h2>
                                    <p>Mean Quants Score</p>
                                </div>
                            </div>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo ceil(array_sum($verbal)/count($verbal));?></h2>
                                    <p>Mean Verbal Score</p>
                                </div>
                            </div>
                            <div class='col-md-12 col-lg-4 justify-content-center d-flex mt-3'>
                                <div class='text-center shadow data'>
                                    <h2 class="number"><?php echo ceil(array_sum($total)/count($total));?></h2>
                                    <p>Mean Total Score</p>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
          
        <div style="height: 0; overflow: hidden">
            <form action='profile-picture.php?modal=1' method='POST' enctype="multipart/form-data">
                    <input id='fileToUpload' name='fileToUpload' type='file' accept='image/*'><br>
                    <input type="hidden" id='id' name='id' value=<?php echo $rowPRO['profile_pic'];?>>
                    <button type="submit" id="imageSubmit" class="btn btn-dark">Submit</button>
            </form>
        
            <form action='profile-picture.php?modal=2' method='POST' enctype="multipart/form-data">
                <button type="submit" id="imageRemove" class="btn btn-dark">Yes</button>
            </form>
        </div>
    </body>
    
    <script>
    	if ($(window).width() < 768) {
		   $("#navigate").addClass('sideNav');
		   $('#navigate ul').addClass('flex-column');
		}

        $(document).ready(function(){

            $('[data-toggle="tooltip"]').tooltip();  

            $('#myTable').DataTable({
                "pageLength": 5,
                "lengthMenu": [ 5, 10, 15 ]
            });

            $(".fa-bars").click(function(){
                $(".sideNav").css({"width": "100%", "left": "0", "z-index": "5"});
                // $("#demo").find("ul").css({"z-index": "1", "transition": ""});
                $(".fa-window-close").parent().css("display", "");
                $(this).parent().css("display", "none");
            });

            $(".fa-window-close").click(function(){
                $(".sideNav").css({"width": "0", "left": "-10px", "z-index": ""});
                // $("#demo").find("ul").css({"z-index": "", "transition": "0.8s"});
                $(this).parent().css("display", "none");
                $(".fa-bars").parent().css("display", "");
            });

            $(".sideNav").find(".nav-link").click(function(){
                if($(window).width() < 768) {
                    $(".sideNav").css({"width": "0", "left": "-10px", "z-index": ""});
                    // $("#demo").find("ul").css("z-index", "");
                    $(".fa-window-close").parent().css("display", "none");
                    $(".fa-bars").parent().css("display", "");
                }
            }); 
            
            $("#dp").click(function(){
                $("#fileToUpload").click();
            });
            
            $("#rdp").click(function(){
                $("#imageRemove").click();
            });
  
            $(".navbar-collapse").on("click", "a:not([data-toggle])", null, function () {
                $(".navbar-collapse").collapse('hide');
            });
            
            $(".removed").hide();
            $(".remove").click(function() {
                var id = $(this).attr('id');
                $(this).hide();
                $(this).siblings('.spinner-border').toggle();
                $.post("remove-friends.php",{
                    id: id.slice(2)
                },
                function(data){
                    $('#' + id).siblings('.spinner-border').toggle();
                    $('#' + id).siblings('.removed').show();       
                });
            });
            
            $(".review-card").click(function(){
                $.cookie("p-c-row", $(this).attr('id'));
            });
            
            $("#fileToUpload").change(function(){
                $("#imageSubmit").click();
            });
        });        
    </script>
</html>