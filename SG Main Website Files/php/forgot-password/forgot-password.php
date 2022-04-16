<?php 
    session_start();
    $con = new PDO("mysql:host=project.czr79hmop85p.ap-south-1.rds.amazonaws.com;db=scoregreat","admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $con->prepare("SELECT * FROM scoregreat.users_main");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    $cnt = 0;
    $otp = mt_rand(100000, 999999);

    if(count($rows) > 0)
    {
        foreach($rows as $row)
        {
            if(strcmp($row['EMAIL'], $_POST['email']) == 0)
            {
                $_SESSION['fpEmail'] = $_POST['email'];
                $_SESSION['otp'] = $otp;
                
                $to = $_POST['email'];
                $subject = "Score GREat Verification";
                $txt = "This is the OTP to change your password: " . $otp;
                $header = "From: Score GREat <no-reply@scoregreat.com>" . "\r\n";
                
                mail($to, $subject, $txt, $header);
                $con = null;
                header('Location: forgot-password-verification.php');
            }
            else    
                $cnt++;
        }   
        if($cnt == count($rows))
            header('Location: ../index.html');
    }
?>