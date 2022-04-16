<?php
	session_start();
 
    $con = new PDO("mysql:host=project.c1ruqdbfywti.ap-south-1.rds.amazonaws.com;dbname=scoregreat","admin","admin1234");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $con->prepare("SELECT * FROM users");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    $cnt = 0;

    if(count($rows) > 0)
    {
        foreach($rows as $row)
        {
            if(strcmp($row['userid'],$_POST['uid']) == 0)
            {
                if(strcmp($row['pass'],$_POST['pwd']) == 0)
                {
                    $_SESSION['uid'] = $_POST['uid'];
                    header('Location: ../dashboard.html');
                }

                else if(strcmp($row['pass'],$_POST['pwd']) != 0)
                    header('Location: ../index.html');
            }
            else    
                $cnt++;
        }
        if($cnt == count($rows))
            header('Location: ../index.html');
    }
?>