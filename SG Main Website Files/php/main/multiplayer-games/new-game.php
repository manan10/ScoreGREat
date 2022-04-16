<?php 
    session_start();
    if(!isset($_SESSION['email']))
       header('Location: ./../../../index.html');
       
    $_SESSION['counter'] = 0;
    $_SESSION['correct'] = 0;
    $_SESSION['game'] = $_GET['game'];
       
    $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
    
    $ques = [];
    $i=0;
    
    if($_SESSION['game']==1){
        $stmt = $con->prepare("SELECT id FROM scoregreat.words");
        $stmt->execute();  
        $rows = $stmt->fetchAll();
        
        foreach($rows as $row){
            $ques[$i] = $row['id'];
            $i++;
        }
        
        shuffle($ques);
        
        for($j=0;$j<5;$j++)
            $rques[$j] = $ques[$j];
        
        $_SESSION['round-ques'] = json_encode($rques);
        $_SESSION['game-ques'] = json_encode($ques);
    }
    else{
        $stmt = $con->prepare("SELECT id FROM scoregreat.ques_math where id > 40");
        $stmt->execute();
        $rows = $stmt->fetchAll();

        foreach($rows as $row){
            $ques[$i] = $row['id'];
            $i++;
        }
        
        shuffle($ques);
        $_SESSION['game-ques'] = json_encode($ques);
    }
    
    $stmt = $con->prepare("select count(*) from scoregreat.games");
    $stmt->execute();
    $len = $stmt->fetch();
    
    $id = $len['count(*)'] + 1;
    $_SESSION['game-id'] = $id;
    
    $stmt = $con->prepare("insert into scoregreat.games (id,p1,p2,game,turn,round) values (:id,:p1,:p2,:game,:p1,1);");
    $stmt -> bindParam(":id",$id,PDO::PARAM_INT);
    $stmt -> bindParam(":p1",$_SESSION['userid'],PDO::PARAM_INT);
    $stmt -> bindParam(":p2",$_POST['userid'],PDO::PARAM_INT);
    $stmt -> bindParam(":game",$_SESSION['game'],PDO::PARAM_INT);
    $stmt->execute();
    
    if($_SESSION['game']==1)
        header('Location: wp.php');
    else
        echo "<script>
                var min = 1;
                var now = Date.parse(new Date());
                var endtime = Date.parse(new Date(now + min*60*1000));
                sessionStorage.setItem('time', endtime);
                
                window.open('btc.php','_self');
            </script>";
?>

