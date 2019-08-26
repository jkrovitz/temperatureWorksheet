<head> 
	<?php include('connect_db.php');?>
	<title>Convert Temperature</title> 
	<!-- Bootstrap CDN -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- Jquery cdn -->
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
</head> 
<body class="m-5"> 
	<h2>Temperature Conversion</h2> 
	<form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "GET"> 
		<div class="form-group">
			<label>Degrees: </label>
			<input class="form-control" type = "text" name = "degree" size=4 value="">
		</div>

		<div class="form-group">
			<label>Select Input Unit</label>
			<select class="form-control"name="scale"> <option value="celsius">Celsius</option> <option value="fahrenheit">Fahrenheit</option> <option value="kelvin">Kelvin</option> <option value="rankine">Rankine</option> </select> 
		</div>
		<div class="form-group">
			<label> Select target unit</label>
			<select class="form-control" name="scale2"> <option value="celsius">Celsius</option> <option value="fahrenheit">Fahrenheit</option> <option value="kelvin">Kelvin</option> <option value="rankine">Rankine</option> </select> 
		</div>
		<div class="form-group">
			<label>Student Response</label>
			<input type = "text" name="studentResponse" class="form-control" size=4> 
		</div>
		<br/>
		<div class="text-center"> 
			<input type = "submit" class="btn btn-primary" name="Convert Temperature"/> 
		</div>
	</form> 

	<?php 
 //check for input
	if (array_key_exists('degree',$_GET) && array_key_exists('studentResponse', $_GET)){
		$scale = $_GET['scale'];
		$scale2 = $_GET['scale2'];
		$degree = $_GET['degree'];
		$studentResponse = $_GET['studentResponse'];
		$studentResponseRounded = round($studentResponse,0); 
		$firstLength = strlen($_GET['degree']);

		if(($firstLength > 0) && (is_numeric($_GET['degree'])))
		{
			if ($scale == "celsius" && $scale2 == "celsius") 
			{
				$c_2_c = round($degree);
				handleIfStatements($degree, $scale, $scale2, $c_2_c, $studentResponseRounded); 

			} 
			if ($scale == "celsius" && $scale2 == "kelvin") 
			{

				$c_2_k = round($degree+273.15,0); 
				handleIfStatements($degree, $scale, $scale2, $c_2_k, $studentResponseRounded); 
			} 
			if ($scale == "celsius" && $scale2 == "fahrenheit") 
			{

				$f_2_k = round($degree+273.15,0); 
				handleIfStatements($degree, $scale, $scale2, $f_2_k, $studentResponseRounded); 
			}
			if ($scale == "celsius" && $scale2 == "rankine"){
				$c_2_r = round(($degree+273.15)*9/5,0); 
				handleIfStatements($degree, $scale, $scale2, $c_2_r, $studentResponseRounded); 
			}
			if ($scale == "fahrenheit" && $scale2 == "fahrenheit") {
				$f_2_f = round($degree);
				handleIfStatements($degree, $scale, $scale2, $f_2_f, $studentResponseRounded); 

			} 
			if ($scale == "fahrenheit" && $scale2 == "kelvin"){
				$f_2_k = round($f_2_c+273.15); 
				handleIfStatements($degree, $scale, $scale2, $f_2_k, $studentResponseRounded); 
			} 
			if ($scale == "fahrenheit" && $scale2 == "celsius"){
				$f_2_c = round(($degree -32)*5/9); 
				handleIfStatements($degree, $scale, $scale2, $f_2_c, $studentResponseRounded); 
			}
			if ($scale == "fahrenheit" && $scale2 == "rankine"){
				$f_2_r = round($degree+459.6 ); 
				handleIfStatements($degree, $scale, $scale2, $f_2_r, $studentResponseRounded); 
			}
			if ($scale == "kelvin" && $scale2 == "kelvin"){
				$k_2_k = round($degree);
				handleIfStatements($degree, $scale, $scale2, $k_2_k, $studentResponseRounded); 

			} 
			if ($scale == "kelvin" && $scale2 == "celsius"){
				$k_2_c = round($degree-273.15); 
				handleIfStatements($degree, $scale, $scale2, $k_2_c, $studentResponseRounded); 
			} 
			if ($scale == "kelvin" && $scale2 == "fahrenheit"){
				$k_2_f = round(($degree - 273.15) * 9 / 5 + 32); 
				handleIfStatements($degree, $scale, $scale2, $k_2_f, $studentResponseRounded); 
			}
			if ($scale == "kelvin" && $scale2 == "rankine"){
				$k_2_r = round((($degree - 273.15) * 9 / 5 + 32)+459.6); 
				handleIfStatements($degree, $scale, $scale2, $k_2_r, $studentResponseRounded); 
			}
			if ($scale == "rankine" && $scale2 == "rankine"){
				$r_2_r = round($degree);
				handleIfStatements($degree, $scale, $scale2, $r_2_r, $studentResponseRounded); 
			} 
			if ($scale == "rankine" && $scale2 == "fahrenheit"){
				$r_2_f = round($degree-459.6); 
				handleIfStatements($degree, $scale, $scale2, $r_2_f, $studentResponseRounded); 
			} 
			if ($scale == "rankine" && $scale2 == "celsius"){
				$r_2_c = round(($degree-459.6 - 32)*5/9); 
				handleIfStatements($degree, $scale, $scale2, $r_2_c, $studentResponseRounded); 
			}
			if ($scale == "rankine" && $scale2 == "kelvin"){
				$r_2_k = round((($degree-459.6 - 32)*5/9) + 273.15); 
				handleIfStatements($degree, $scale, $scale2, $r_2_k, $studentResponseRounded); 
			}
		}else
		//print invalid if the input temperature is not of data type float 
			echo "<span style = \"color:red\">Invalid</span>";
	}
	?> 
	<?php 
	function handleIfStatements($degree, $scale ,$scale2, $unit_2_unit, $studentResponseRounded){
		if($unit_2_unit != $studentResponseRounded){
			print"<table class='table table-bordered'><tr>
			<td>$degree</td>
			<td>$scale</td>
			<td>$scale2</td>
			<td>$studentResponseRounded</td>
			<td>Incorrect</td>
			</tr></table>";
		}
		if($unit_2_unit == $studentResponseRounded){
			print"<table class='table table-bordered'>
			<tr>
			<td>$degree</td>
			<td>$scale</td>
			<td>$scale2</td>
			<td>$studentResponseRounded</td>
			<td>Correct</td>
			</tr></table>";
		}
	}
	?>