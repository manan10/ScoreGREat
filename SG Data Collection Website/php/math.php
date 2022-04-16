<?php
	session_start();
	
	if (!isset($_SESSION['uid'])) {
		header('Location: ../index.html');
	}

    $value = $_SESSION['num'];
            
    if($value >= 15){
        header('Location: finish.php');
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>ScoreGREat | Maths</title>
	<meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	  <link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One|Bangers|Germania+One|Josefin+Sans|Luckiest+Guy|ZCOOL+XiaoWei" rel="stylesheet">
</head>
    <body style="background-color: #ebebe0" onload="start();">
    	<div class="container-fluid" style="background-color: black;color: white;font-family: sans-serif;margin-top: 10px">
    		<center>
    			<div class="display-3">QUANTS</div>
    		</center>
    	</div>
    
    	<?php
    		try {
    		    $conn = new PDO("mysql:host=project.c1ruqdbfywti.ap-south-1.rds.amazonaws.com;dbname=scoregreat","admin","admin1234");	 
    		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    		    $stmt = $conn->prepare("SELECT * FROM ques_math where id=".($value+1).";");
                $stmt->execute();
                $row = $stmt->fetch();
                $_SESSION['num'] = ($value+1);
    
                $opt = substr($row['opt'],1,strlen($row['opt'])-1);
                $options = explode(", ", $opt);
      	?>
    
    	<div class="container" style="max-width: 900px">
    		<div class="row" style="margin-top: 100px;font-size: 20px">
    			<div class="col-md-1">
    				<p id="counter"><b><?php echo $value+1; ?>)</b></p>
    			</div>
    			<div class="col-md-11">
    				<p name="que"><b><?php echo $row['ques'];?></b></p>
    			</div>	 
    		</div>
    		<div>
    			<form action="eval/eval_math.php"  style="font-size: 20px;margin-left: 80px"  onsubmit="return checknull()" method="post">
    				
                    <input type="radio" value="<?php echo substr($options[0],1,strlen($options[0])-2) ?>" name="op" data-toggle="modal" data-target="#myModal">&nbsp;&nbsp;&nbsp;
                    <?php echo substr($options[0],1,strlen($options[0])-2)?><br>
    				
                    <input type="radio" value="<?php echo substr($options[1],1,strlen($options[1])-2) ?>" name="op" data-toggle="modal" data-target="#myModal">&nbsp;&nbsp;&nbsp;
                    <?php echo substr($options[1],1,strlen($options[1])-2)?><br>
    				
                    <input type="radio" value="<?php echo substr($options[2],1,strlen($options[2])-2) ?>" name="op" data-toggle="modal" data-target="#myModal">&nbsp;&nbsp;&nbsp;
                    <?php echo substr($options[2],1,strlen($options[2])-2)?><br>
    				
                    <input type="radio" value="<?php echo substr($options[3],1,strlen($options[3])-2) ?>" name="op" data-toggle="modal" data-target="#myModal">&nbsp;&nbsp;&nbsp;
                    <?php echo substr($options[3],1,strlen($options[3])-2)?><br>
    				
                    <input type="radio" value="<?php echo substr($options[4],1,strlen($options[4])-2) ?>" name="op" data-toggle="modal" data-target="#myModal">&nbsp;&nbsp;&nbsp;
                    <?php echo substr($options[4],1,strlen($options[4])-3)?><br><br>
    				
    				<input type="hidden" value="<?php echo $row['id'] ?>" name="queid">
    				<input type="hidden" value="<?php echo $row['ans'] ?>" name="answer">
    				<input type="hidden" value="hard" name="diff">
    				<input type="hidden" value="1000" name="timestamp">
    				
    				<div class="row">
    					<div class="col-md-9"></div>
    					<div class="col-md-3">						
    						<input type="submit" name="next" id="next" class="btn btn-dark" value="Next Question">
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
			var st,et;	
			
			function checknull()
			{
				var a=$("input[name=op]:checked").val()
				if(a==null){
					alert("Please select an option.")
					return false;
				}
				else
				    alert(a);
			}
			
				
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
				var dif=0;
				dif = et - st;
				$("input[name=timestamp]").val(dif);
				st=null;
			}
		</script>
    </body>
</html>