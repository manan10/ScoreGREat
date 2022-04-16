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
	<title>ScoreGREat|Verbal Instructions</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One|Bangers|Germania+One|Josefin+Sans|Luckiest+Guy|ZCOOL+XiaoWei" rel="stylesheet">
</head>
<body style="background-color: #ebebe0">
 	<div class="card" style="background-color: #ebebe0">
		<h1 style="margin-top: 20px;font-size: 35px;font-family: ZCOOL XiaoWei ;text-align:center;color: black;"> &nbsp&nbsp&nbsp<u><b>VERBAL</b>
		</u></h1><hr>
					<div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6" style="background-color: black;color: white">
							<h1 style="margin-top: 50px;font-size: 35px;"> 	&nbsp&nbsp&nbsp
							<u><b>IMPORTANT INSTRUCTIONS</b></u> </h1>
							<ul class="info">
								<li style="margin-top: 20px;">All the candidates are requested to answer all the questionnaries genuinely as this data will be used for research purpose.</li>
								<li> This section contains questionnaries based on English.</li>
								<li> There will be total 15 questions in this section.</li>
								<li> After attempting each question , you are requested to rate the level of the question.</li>
								<li> In this section , there will be multiple choices for each question.</li>
								<li> Wish you all the best..!!</li>
							</ul>
							<br><br>
							<center><a href="eng.php"> <button class="btn btn-light" type="button" name="eng" style="width: 100px">Start</button> 
							</a>
							</center><br><br><br>
						</div>
						<div class="col-md-3"></div>
					</div>
				</div>
</body>
</html>