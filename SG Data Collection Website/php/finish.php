<?php
	session_start();
	//https://stackoverflow.com/questions/21396905/create-login-and-logout-session-in-php-and-database
	if (!isset($_SESSION['uid'])) {
		header('Location: ../index.html');
	}
?>

<!DOCTYPE html>
  <!--%
  response.setHeader("Cache-Control","no-cache");
  response.setHeader("Cache-Control","no-store");
  response.setHeader("Pragma","no-cache");
  response.setDateHeader ("Expires", 0);

  if(session.getAttribute("username")==null)
      response.sendRedirect("login.html");

  %--> 


<html>
<head>
	<meta charset="ISO-8859-1">
	<title>Finished</title>
	<meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	  <link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One|Bangers|Germania+One|Josefin+Sans|Luckiest+Guy|ZCOOL+XiaoWei" rel="stylesheet">
</head>

<body style="background-color: #ebebe0">
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-end" style="height:80px">
			  <ul class="navbar-nav" style="font-size:20px;font-weight:bold;font-family:Josefin Sans">
			  
			    <li class="nav-item">
			      <a class="nav-link" href="dashboard.php">Dashboard</a>
			    </li>
			    <li class="nav-item">
			      <a class="nav-link" href="#"></a>
			    </li>
			     <li class="nav-item">
			      <a class="nav-link" href="logout.php">Log Out</a>
			    </li>
			  </ul>
		</nav>
		
		<div class="row" style="margin-top:150px;font-size:28px;font-family:Josefin Sans;font-weight:bold">
			<div class="col-md-3"></div>
				<div class="col-md-7">
					<ul>
						<li style="margin-top:15px">You have completed this section.</li>
						<li> Thank you for Your co-operation.</li>
						<li> If you have finished all sections, please logout from here.</li>
						<li> Else go back to Dashboard.</li>
					</ul>
				</div>
			<div class="col-md-2"></div>
		</div>
</body>
</html>