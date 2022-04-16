<?php
	session_start();
	//https://stackoverflow.com/questions/21396905/create-login-and-logout-session-in-php-and-database
	if (!isset($_SESSION['uid'])) {
		header('Location: ../index.html');
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Score GREat | Dashboard</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body style="background-color: #ebebe0">
	<div class="container">
		<div  class="display-4" style="margin-top: 10px">
			<center><b>
				Welcome...!!!
			</b></center>
		</div>
		<div class="row" style="margin-top: 40px">
			<div class="col-md-1"></div>
			<div class="card col-md-4">
			    <img class="card-img-top" src="../images/maths.png" alt="Card image" style="width:100%;max-height: 250px;max-width:500px;margin-top: 15px;">
			    <div class="card-body"><center>
			      <h4 class="card-title">Quants</h4>
			      <p class="card-text">Solve some mathematical questions.</p>
			      <a href="math_ins.php" class="btn btn-dark btn-block">Go</a></center>
			    </div>
			 </div>
			 <div class="col-md-2"></div>
			 <div class="card col-md-4" style="width:400px">
			    <img class="card-img-top" src="../images/english.jpg" alt="Card image" style="width:100%;max-height: 250px;margin-top: 15px;">
			    <div class="card-body"><center>
			      <h4 class="card-title" style="margin-top: 18px">Verbal</h4>
			      <p class="card-text">Solve some verbal questions.</p>
			      <a href="eng_ins.php" class="btn btn-dark btn-block">Go</a></center>
			    </div>
			 </div>
			 <div class="col-md-1"></div>
		</div>
	</div>
</body>
</html>