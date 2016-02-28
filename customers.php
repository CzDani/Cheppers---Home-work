<?php
  date_default_timezone_set('Europe/Budapest');
  setlocale(LC_ALL, 'hungarian');

  function __autoload($class_name){
    include('class.'.$class_name.'.inc');
    }

  if(filter_input(INPUT_POST,'submit')){
    $name = filter_input(INPUT_POST,'name');
    $email = filter_input(INPUT_POST,'email');
    $phone = filter_input(INPUT_POST,'phone');
    $newcustomer = new Customers();
    $newcustomer -> name = $name;
    $newcustomer -> email = $email;
    $newcustomer -> phone = $phone;
    $newcustomer->save();
    }

  if(filter_input(INPUT_POST,'delete')){
    $delete = Customers::delete();
    }

  if(filter_input(INPUT_POST,'select')){
    $db = Database::getInstance();
    $mysqli = $db->getConnection(); 
    $mysqli->set_charset("utf8");
        
    $qry = 'SELECT customer_id, name, email, phone FROM customers WHERE `customer_id` = '.$_POST[id].' LIMIT 1';
    $result = $mysqli->query($qry);
    $row = mysqli_fetch_row($result);
    }

  if(filter_input(INPUT_POST,'update')){
    $update_name = filter_input(INPUT_POST,'update_name');
    $update_email = filter_input(INPUT_POST,'update_email');
    $update_phone = filter_input(INPUT_POST,'update_phone');

    $db = Database::getInstance();
    $mysqli = $db->getConnection(); 
    $mysqli->set_charset("utf8");

    $qry = "UPDATE customers SET `name` = '$update_name', `email` = '$update_email', `phone` = '$update_phone' WHERE `customer_id` = ".$_POST[asd]." LIMIT 1";
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
            <a class="nav-link active" href="#"><i class="fa fa-users icon"></i>Vásárlók</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="vacations.php"><i class="fa fa-plane icon"></i>Nyaralási lehetőségek</a>
          </li>
        </ul>
      </nav>

      <div class="mainContent top">
        <h3>Vásárló hozzáadása</h3>
        <div class="form">
          <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal">Vásárló hozzáadása</button>
        </div>
        <hr>
        <form method="post" class="form">
          <h3>Vásárló adatainak módosítása</h3>
          <fieldset class="form-group">
            <input type="hidden" name="asd" value="<?php echo $row[0]; ?>">
            <label for="exampleInputEmail1">Vásárló neve:</label>
            <input type="text" class="form-control" name="update_name" id="update_name" placeholder="" value="<?php echo $row[1]; ?>">
          </fieldset>
          <fieldset class="form-group">
            <label for="exampleInputEmail1">Vásárló email címe:</label>
            <input type="email" class="form-control" name="update_email" id="update_email" placeholder="" value="<?php echo $row[2]; ?>">
          </fieldset>
          <fieldset class="form-group">
            <label for="exampleInputEmail1">Vásárló telefonszáma:</label>
            <input type="text" class="form-control" name="update_phone" id="update_phone" placeholder="" value="<?php echo $row[3]; ?>">
          </fieldset>
          <br>
          <input type="submit" class="btn btn-warning btn-block" value="Vásárló adatainak módosítása" name="update">
        </form>
        <hr>
        <h3>Vásárlók listája</h3>
        <?php $listing = Customers::listing(); ?>
      </div>

      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h3 class="modal-title cim" id="myModalLabel">Vásárló hozzáadása</h3>
            </div>
            <div class="modal-body">
              <form method="post">
                <fieldset class="form-group">
                  <label for="exampleInputEmail1">Vásárló neve:</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="" value="<?php echo $asd; ?>">
                </fieldset>
                <fieldset class="form-group">
                  <label for="exampleInputEmail1">Vásárló email címe:</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="">
                </fieldset>
                <fieldset class="form-group">
                  <label for="exampleInputEmail1">Vásárló telefonszáma:</label>
                  <input type="text" class="form-control" name="phone" id="phone" placeholder="">
                </fieldset>
                  <br>
                  <input type="submit" class="btn btn-success btn-block" value="Vásárló hozzáadása" name="submit">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
