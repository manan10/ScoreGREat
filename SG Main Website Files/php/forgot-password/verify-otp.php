<?php 
    session_start();
    
    if($_SESSION['otp'] == (int)$_POST['otp'])
        header('Location: ./../new-password/new-password.php');
    else {
        echo "<script>
                alert('OTP does not match!!!');
                window.open(\"./../index.html\", \"_self\");
            </script>";
    }
?>