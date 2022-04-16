<?php
	session_start();
	
	if (!isset($_SESSION['uid'])) {
		header('Location: ../index.html');
	}

    $value = $_SESSION['num'];
            
    if($value >= 3){
        header('Location: eng_3ans.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>ScoreGREat|Verbal</title>
	<meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	  <link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One|Bangers|Germania+One|Josefin+Sans|Luckiest+Guy|ZCOOL+XiaoWei" rel="stylesheet">
</head>
<body style="background-color: #ebebe0" onload="start()">
	<div class="container-fluid" style="background-color: black;color: white;font-family: sans-serif;margin-top: 10px">
		<center>
			<div class="display-3">
			VERBAL
			</div>
		</center>
	</div>

	<?php
    		try {
    		    $conn = new PDO("mysql:host=project.c1ruqdbfywti.ap-south-1.rds.amazonaws.com;dbname=scoregreat","admin","admin1234");	 
    		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    		    $stmt = $conn->prepare("SELECT * FROM ques_verbal_test where id=".($value+1).";");
                $stmt->execute();
                $row = $stmt->fetch();
                $_SESSION['num'] = ($value+1);
    
                $opt = substr($row['opt'],1,strlen($row['opt'])-1);
                $options = explode(", ", $opt);

                $ans = substr($row['ans'],1,strlen($row['ans'])-1);
                $answers = explode(", ", $ans);
    ?>

	<div class="container" style="max-width: 900px">
		<div class="row" style="margin-top: 100px;font-size: 20px">
			<div class="col-md-1">
				<p id="counter"><b><?php echo $value+1; ?>)</b></p>
			</div>
			<div class="col-md-11">
				<p name="que"><b><?php echo $row['ques'];?><i> (Choose the 2 correct answers).</i></b></p>
			</div>	 
		</div>
		<div>
			<form action="eval_eng.php" style="font-size: 20px;margin-left: 80px" method="post">
				<input type="checkbox" value="<?php echo substr($options[0],1,strlen($options[0])-2) ?>" name="op[]">&nbsp;&nbsp;&nbsp;
				<?php echo substr($options[0],1,strlen($options[0])-2)?><br>
				<input type="checkbox" value="<?php echo substr($options[1],1,strlen($options[1])-2) ?>" name="op[]">&nbsp;&nbsp;&nbsp;
				<?php echo substr($options[1],1,strlen($options[1])-2)?><br>
				<input type="checkbox" value="<?php echo substr($options[2],1,strlen($options[2])-2) ?>" name="op[]">&nbsp;&nbsp;&nbsp;
				<?php echo substr($options[2],1,strlen($options[2])-2)?><br>
				<input type="checkbox" value="<?php echo substr($options[3],1,strlen($options[3])-2) ?>" name="op[]">&nbsp;&nbsp;&nbsp;
				<?php echo substr($options[3],1,strlen($options[3])-2)?><br>
				<input type="checkbox" value="<?php echo substr($options[4],1,strlen($options[4])-2) ?>" name="op[]">&nbsp;&nbsp;&nbsp;
				<?php echo substr($options[4],1,strlen($options[4])-2)?><br>
				<input type="checkbox" value="<?php echo substr($options[5],1,strlen($options[5])-2) ?>" name="op[]">&nbsp;&nbsp;&nbsp;
				<?php echo substr($options[5],1,strlen($options[5])-3)?><br><br>
				
				<input type="hidden" value="<?php echo $row['id'] ?>" name="queid">
				<input type="hidden" value="<?php echo substr($answers[0],1,strlen($answers[0])-2) ?>" name="answer1">
				<input type="hidden" value="<?php echo substr($answers[1],1,strlen($answers[1])-2) ?>" name="answer2">
				<input type="hidden" value="hard" name="diff">
				<input type="hidden" value="1000" name="timestamp">
				
				<div class="row">
					<div class="col-md-6"></div>
					<div class="col-md-3">
						<input type="button" name="next" id="check" style="width:130px" class="btn btn-dark" value="Submit" data-toggle="modal" data-target="#myModal">
					</div>
					<div class="col-md-3">						
						<input type="submit" name="next" id="next" style="width:130px" class="btn btn-dark" value="Next Question">
					</div>
				</div>
			</form>
		</div>			
	</div>
    
     	<?php 
    		}
    		catch(PDOException $e) {
        		echo "Error: " . $e->getMessage();
        	}	
        ?>

    <!-- Modal code -->
    <div class="modal" id="myModal">
	    <div class="modal-dialog modal-dialog-centered">
	      <div class="modal-content">
	      
	        <div class="modal-header bg-dark" style="color:white;">
	          <h5 class="modal-title">How difficult did you find this question?</h5>
	        </div>
	        
	        <div class="modal-body" id="diffi" style="margin-bottom:20px;">
	          <input type="radio" value="easy" name="difficulty" data-dismiss="modal" onclick="getvalue()">&nbsp;&nbsp;&nbsp;Easy<br>
	          <input type="radio" value="medium" name="difficulty" data-dismiss="modal" onclick="getvalue()">&nbsp;&nbsp;&nbsp;Medium<br>
	          <input type="radio" value="hard" name="difficulty" data-dismiss="modal" onclick="getvalue()">&nbsp;&nbsp;&nbsp;Hard<br>
	          <input type="radio" value="very hard" name="difficulty" data-dismiss="modal" onclick="getvalue()">&nbsp;&nbsp;&nbsp;Very Hard<br>
	        </div> 
	        
	      </div>
	    </div>
    </div>
    
	<script>
			$("#next").prop("disabled", true);
			
			$("input[name='difficulty']").click(function(){
					$("#next").prop("disabled", false);
			}); 			
				
			
			var st,et;
			
			function getvalue()
			{
				var a=$("input[name=difficulty]:checked").val()
				$("input[name=diff]").val(a)
				end();
			}
			
			function start()
			{
				st=Number(Date.now());
			}
			 
			function end()
			{
				et=Number(Date.now());
				var dif=et-st;
				$("input[name=timestamp]").val(dif);
				st=null;
			}
	</script>
</body>
</html>