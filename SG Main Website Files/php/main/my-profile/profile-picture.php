<?php
    session_start();
    
    $con = new PDO($_SESSION['connect'],"admin","admin1234",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    if($_GET['modal']==1){
        $target_dir = "./../../../image/users/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false)
                $uploadOk = 1;
            else
                $uploadOk = 0;
        }
        
        if (file_exists($target_file))
            $uploadOk = 0;
        
        if ($_FILES["fileToUpload"]["size"] > 500000)
            $uploadOk = 0;

        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")
            $uploadOk = 0;
            
        else {
            $temp = explode(".", $_FILES["fileToUpload"]["name"]);
            $stmt = $con->prepare("select id from scoregreat.users_main where EMAIL= :EMAIL");
            $stmt->bindParam(":EMAIL",$_SESSION['email'],PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            $new = $target_dir.$row['id'].'.'.end($temp);                             
                              
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $new)) {
                $stmt = $con->prepare("update scoregreat.users_main set profile_pic=1,profile_ext= :EXT where EMAIL= :EMAIL");
                $stmt->bindParam(":EMAIL",$_SESSION['email'],PDO::PARAM_STR);
                $stmt->bindParam(":EXT",$imageFileType,PDO::PARAM_STR);
                $stmt->execute();
            } 
        }
    }
    else{
        $stmt = $con->prepare("update scoregreat.users_main set profile_pic=0 where EMAIL= :EMAIL");
        $stmt->bindParam(":EMAIL",$_SESSION['email'],PDO::PARAM_STR);
        $stmt->execute();
    }
    header('Location: my-profile.php');
?>