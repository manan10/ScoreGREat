<?php
    session_start();
    
    $jenish = "mysql:host=project.czr79hmop85p.ap-south-1.rds.amazonaws.com;db=scoregreat";
    $manan = "mysql:host=test.c1ruqdbfywti.ap-south-1.rds.amazonaws.com;db=scoregreat";
    $_SESSION['connect']= $jenish;
    $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $con->prepare("SELECT * FROM scoregreat.users_main");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    $cnt = 0;

    if(count($rows) > 0)
    {
        foreach($rows as $row)
        {
            if(strcmp($row['EMAIL'], $_POST['email']) == 0)
            {
                if(password_verify($_POST['pwd'], $row['PWD']))
                {
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['userid'] = $row['id'];
                    $_SESSION['name'] = $row['FNAME'] . " " . $row['LNAME'];
                    header('Location: ./main/dashboard.php');
                }
                else {
                    $con = null;
                    echo "<script> 
                            alert('Email or Password is Incorrect!!!');
                            window.open('./../index.html', '_self');    
                        </script>";    
                }
            }
            else    
                $cnt++;
        }   
        if($cnt == count($rows))
            $con = null;
          // header('Location: ../index.html');
    }
?>