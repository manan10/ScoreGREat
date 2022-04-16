<?php 
    session_start();
    if(!isset($_SESSION['email']))
       header('Location: ./../../../index.html');
       
    $_SESSION['counter'] = 0;
    $_SESSION['correct'] = 0;
    $_SESSION['game-id'] = $_POST['game-id'];
    $_SESSION['game'] = $_POST['game'];
       
    $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
    $stmt = $con->prepare("SELECT questions,round FROM scoregreat.games where id =:ID");
    $stmt->bindParam(":ID",$_POST['game-id'],PDO::PARAM_INT);
    $stmt->execute();  
    $row = $stmt->fetch();
    $_SESSION['game-ques'] = $row['questions'];
    
    if($_SESSION['game']==1){
       
        $ques = json_decode($row['questions']);
        $i = ($row['round']-1)*5;    
        $rques = [];
        
        for($j = 0; $j < 5; $j++){
            $rques[$j] = $ques[$i];
            $i++;
        }
        $_SESSION['round-ques'] = json_encode($rques);
        
        header('Location: wp.php');
    }
    else
        echo "<script>
                var min = 1;
                var now = Date.parse(new Date());
                var endtime = Date.parse(new Date(now + min*60*1000));
                sessionStorage.setItem('time', endtime);
                
                window.open('btc.php','_self');
            </script>";
?>

