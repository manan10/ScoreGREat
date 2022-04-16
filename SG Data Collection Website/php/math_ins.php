<?php
	session_start();
	
	if (!isset($_SESSION['uid'])) {
		header('Location: ../index.html');
	}

	$_SESSION['num'] = 0;
?>
    
<!DOCTYPE html>
<html>
<head>
	<title>ScoreGREat | Maths Instuctions</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One|Bangers|Germania+One|Josefin+Sans|Luckiest+Guy|ZCOOL+XiaoWei" rel="stylesheet">
</head>
<body style="background-color: #ebebe0">
 	<div class="card" style="background-color: #ebebe0">
		<h1 style="margin-top: 20px;font-size: 35px;font-family: ZCOOL XiaoWei ;text-align:center;color: black;"> &nbsp;&nbsp;&nbsp;<u><b>QUANTS</b>
		</u></h1><hr>
		<div class="row">
			<div class="col-md-3"></div>
				<div class="col-md-6" style="background-color: black;color: white">
					<h1 style="margin-top: 50px;font-size: 35px;"> 	&nbsp;&nbsp;&nbsp;
					<u><b>IMPORTANT INSTRUCTIONS</b></u> </h1>
					<ul class="info">
						<li style="margin-top: 20px;">All the candidates are requested to answer all the questionaries genuinely as this data will be used for research purpose.</li>
						<li> There will be total 15 questions in this section.</li>
						<li> After attempting each question , you are requested to rate the difficulty of the question.</li>
						<li> This section contains questionaries based on Mathematics.</li>
						<li> In this section , there will be 5 choice for each questions.</li>
						<li> For calculation purposes, kindly use the calculator of the system.</li>
					</ul>
					<br><br>
					<center><a href="math.php"> <button class="btn btn-light" type="button" name="math" style="width: 100px">Start</button> 
					</a>
					</center><br><br><br>
				</div>
			<div class="col-md-3"></div>
		</div><br>
	</div>
</body>
</html>