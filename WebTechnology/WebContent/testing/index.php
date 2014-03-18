<!DOCTYPE html>
<html>
<head>
<title>PHP testing</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Bootstrap -->
<link href="bootstrap/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="css/font-awesome.min.css" rel="stylesheet" media="screen">
<link href="css/bootflat.css" rel="stylesheet" media="screen">
<link href="css/bootflat-extensions.css" rel="stylesheet" media="screen">
<link href="css/bootflat-square.css" rel="stylesheet" media="screen">
<link href="style/style.css" rel="stylesheet">
<script type="text/javascript" src="scripts/xmlScript.js"></script>
<script type="text/javascript" src="md5.js"></script>


<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
      <![endif]-->
</head>

<body>
	<form action="index.php" method="POST">
		<div class="form-group">
			<label for="exampleInputEmail1">Username:</label> <input
				name="username" id="username" class="form-control" type="text"
				placeholder="Enter username"></input>
		</div>
		<div class="form-group">
			<label for="exampleInputEmail1">Email adress:</label> <input
				name="email" id="exampleInputEmail1" class="form-control"
				type="email" placeholder="Enter email"></input>
		</div>
		<div class="form-group">
			<select name="salaire" class="selectpicker">
				<option value="1">Moins de 1000 euros</option>
				<option value="2">Moins de 2000 euros</option>
				<option value="3">Autres</option>
			</select>
		</div>
		<button name="submit" class="btn btn-primary" type="submit">Submit</button>
	</form>

<?php
$phpArray = array ();
$phpArray [] = 0;
$phpArray [] = 1;
$phpArray [] = 2;
$phpArray [] = 3;
?>

<script type="text/javascript">
    var jArray= <?php echo json_encode($phpArray ); ?>;

    /*for(var i=0;i<4;i++){
        alert(jArray[i]);
    }*/
 </script>


	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="//code.jquery.com/jquery.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="js/bootstrap.min.js"></script>
</body>

</html>
