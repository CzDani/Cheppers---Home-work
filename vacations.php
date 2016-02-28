<?php
  date_default_timezone_set('Europe/Budapest');
  setlocale(LC_ALL, 'hungarian');

  function __autoload($class_name){
    include('class.'.$class_name.'.inc');
    }
  $today = date("Y-m-d");

  if(filter_input(INPUT_POST,'submit')){
    $destination = filter_input(INPUT_POST,'destination');
    $seats = filter_input(INPUT_POST,'seats');
    $starting_date = filter_input(INPUT_POST,'starting_date');
    $end_date = filter_input(INPUT_POST,'end_date');
    $newvacation = new Vacations();
    $newvacation -> destination = $destination;
    $newvacation -> seats = $seats;
    $newvacation -> starting_date = $starting_date;
    $newvacation -> end_date = $end_date;
    $newvacation->save();
    }

  if(filter_input(INPUT_POST,'delete')){
    $delete = Vacations::delete();
    }

  if(filter_input(INPUT_POST,'select')){
    $db = Database::getInstance();
    $mysqli = $db->getConnection(); 
    $mysqli->set_charset("utf8");
        
    $qry = 'SELECT vacation_id, destination, seats, starting_date, end_date FROM vacations WHERE `vacation_id` = '.$_POST[id].' LIMIT 1';
    $result = $mysqli->query($qry);
    $row = mysqli_fetch_row($result);
    }

  if(filter_input(INPUT_POST,'update')){
    $update_destination = filter_input(INPUT_POST,'update_destination');
    $update_seats = filter_input(INPUT_POST,'update_seats');
    $update_starting_date = filter_input(INPUT_POST,'update_starting_date');
    $update_end_date = filter_input(INPUT_POST,'update_end_date');

    $db = Database::getInstance();
    $mysqli = $db->getConnection(); 
    $mysqli->set_charset("utf8");

    $qry = "UPDATE vacations SET `destination` = '$update_destination', `seats` = '$update_seats', `starting_date` = '$update_starting_date', `end_date` = '$update_end_date' WHERE `vacation_id` = ".$_POST[asd]." LIMIT 1";
    $result = $mysqli->query($qry);
    }

?>
<!DOCTYPE html>
<html lang="hu">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Random utazási iroda - Backend</title>

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
          <a class="nav-link" href="index.php"><i class="fa fa-globe icon"></i>Nyaralások</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="customers.php"><i class="fa fa-users icon"></i>Vásárlók</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#"><i class="fa fa-plane icon"></i>Nyaralási lehetőségek</a>
        </li>
      </ul>
    </nav>
    <div class="mainContent top">
        <h3>Nyaralás hozzáadása</h3>
        <div class="form">
          <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal">Nyaralás hozzáadása</button>
        </div>
        <hr>
        <form method="post" class="form">
          <h3>Nyaralás adatainak módosítása</h3>
          <fieldset class="form-group">
            <input type="hidden" name="asd" value="<?php echo $row[0]; ?>">
            <label for="exampleInputEmail1">Uticél:</label>
            <input type="text" class="form-control" name="update_destination" id="update_destination" placeholder="" value="<?php echo $row[1]; ?>">
          </fieldset>
          <fieldset class="form-group">
            <label for="exampleInputEmail1">Férőhely:</label>
            <input type="number" class="form-control" name="update_seats" id="update_seats" placeholder="" value="<?php echo $row[2]; ?>">
          </fieldset>
          <fieldset class="form-group">
            <label for="exampleInputEmail1">Kezdő dátum:</label>
            <input type="date" class="form-control" name="update_starting_date" id="update_starting_date" placeholder="" value="<?php echo $row[3]; ?>">
          </fieldset>
          <fieldset class="form-group">
            <label for="exampleInputEmail1">Végdátum:</label>
            <input type="date" class="form-control" name="update_end_date" id="update_end_date" placeholder="" value="<?php echo $row[4]; ?>">
          </fieldset>
          <br>
          <input type="submit" class="btn btn-warning btn-block" value="Nyaralás adatainak módosítása" name="update">
        </form>
        <hr>
        <h3>Nyaralások listája</h3>
        <?php $listing = Vacations::listing(); ?>
      </div>

      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h3 class="modal-title" id="myModalLabel">Nyaralás hozzáadása</h3>
            </div>
            <div class="modal-body">
              <form method="post" class="form">
                <fieldset class="form-group">
                  <label for="exampleInputEmail1">Uticél:</label>
                  <input type="text" class="form-control" name="destination" id="destination" minlength="3" placeholder="" value="">
                </fieldset>
                <fieldset class="form-group">
                  <label for="exampleInputEmail1">Férőhely:</label>
                  <input type="number" class="form-control" name="seats" id="seats" min="1" placeholder="" value="">
                </fieldset>
                <fieldset class="form-group">
                  <label for="exampleInputEmail1">Kezdő dátum:</label>
                  <input type="date" class="form-control" name="starting_date" id="starting_date" min="<?php echo $today; ?>" placeholder="" value="">
                </fieldset>
                <fieldset class="form-group">
                  <label for="exampleInputEmail1">Végdátum:</label>
                  <input type="date" class="form-control" name="end_date" id="end_date" min="<?php echo $today; ?>" placeholder="" value="">
                </fieldset>
                <br>
                <input type="submit" class="btn btn-warning btn-block" value="Nyaralás hozzáadása" name="submit">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
