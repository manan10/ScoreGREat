<html>
    <head>
        <script src="./../../../lib/jquery.min.js"></script>
        <script src="./../../../js/jquery-cookie/jquery.cookie.js"></script>
    </head>
</html>
<?php
    echo "
        <script>
            $.cookie('screen', $(window).width());
            window.location = 'my-profile-new.php';
        </script>    
    ";
?>