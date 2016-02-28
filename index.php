<?php
  date_default_timezone_set('Europe/Budapest');
  setlocale(LC_ALL, 'hungarian');

  function __autoload($class_name){
    include('class.'.$class_name.'.inc');
    }

    $result = array();
    if(filter_input(INPUT_POST,'connection')){
		if(!empty($_POST['check_list'])){
			foreach($_POST['check_list'] as $value){
				if($result[$value] == undefined){
				$result[$value] =1;}
				else{
				$result[$value] ++;}
				}
		}
		else{ 
			echo "<script type='text/javascript'>alert('Jelöljön ki legalább egy vásárlót!')</script>";}
		if(!empty($_POST['radio'])){
			$radio = filter_input(INPUT_POST,'radio');
		}
		else{
			echo "<script type='text/javascript'>alert('Jelöljön ki egy nyaralást!')</script>";}
			
		foreach ($result as $key => $value) {
			$newcustomer = new Holydays();
			$newcustomer -> customer_id = $key;
			$newcustomer -> vacation_id = $radio;
			$newcustomer->save();
		}		
	}

	if(filter_input(INPUT_POST,'delete')){
    $delete = Holydays::delete();
    }	

?>
<!DOCTYPE html>
<html lang="hu">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Random utazási iroda - Backend</title>
    <!--  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  	<link href='https://fonts.googleapis.com/css?family=Maven+Pro' rel='stylesheet' type='text/css'>
  	<link rel="stylesheet" type="text/css" href="style/style.css">

  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
  </head>
  <body>
	  <div class="container">
	  	<nav class="navbar">
		  <ul class="nav navbar-nav">
		    <li class="nav-item">
		      <a class="nav-link active" href="#"><i class="fa fa-globe icon"></i>Nyaralások</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link" href="customers.php"><i class="fa fa-users icon"></i>Vásárlók</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link" href="vacations.php"><i class="fa fa-plane icon"></i>Nyaralási lehetőségek</a>
		    </li>
		  </ul>
		</nav>
	  </div>
		<div class="connectionContent top">
			<form method="post">
			<div class="customers">		
				<?php $holyday_listing = Customers::holyday_listing(); ?>
			</div>
			<div class="vacations">
				<?php $holyday_listing = Vacations::holyday_listing(); ?>
			</div>
				<input type="submit" class="btn btn-success btn-block" value="Nyaralás hozzáadása" name="connection">
			<h3 class="top">Nyaralások</h3>
			<hr>
			<div class="holydayContent">
				<?php $listing = Holydays::listing(); ?>
			</div>
			</form>
		</div>
	  
  </body>
</html>
