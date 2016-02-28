<?php
class Vacations {

	public $destination;

	public $seats;

	public $starting_date;

	public $end_date;

   	function __construct($data = array()) {
       if(!is_array($data)){
           trigger_error('Nem tudtunk új nyaralást hozzáadni a'.get_calss($name).' osztállyal!');
       }      
    }
   
    function __get($name) {
       return $name;
    }
   
    function __set($name, $value) {
       trigger_error('Nem sikerült beállítani a __set által:'.$name);
    }

   	function save(){
        $db = Database::getInstance();
        $mysqli = $db->getConnection(); 
        $mysqli->set_charset("utf8");
        
        $qry = "INSERT INTO vacations (`destination`,`seats`,`starting_date`,`end_date`) VALUES ('$this->destination' , '$this->seats' , '$this->starting_date', '$this->end_date')";
        $mysqli->query($qry);
    }

    function listing(){
        $db = Database::getInstance();
        $mysqli = $db->getConnection(); 
        $mysqli->set_charset("utf8");
        
        $qry = "SELECT vacation_id, destination, seats, starting_date, end_date FROM vacations";
        $result = $mysqli->query($qry);
        echo'<table class="table">';
        echo"<tr><td>Nyaralás ID</td><td>Úticél</td><td>Férőhely</td><td>Kezdő Dátum</td><td>Végdátum</td><td>Módosítás</td><td>Törlés</td></tr>";
        while($row = mysqli_fetch_row($result)){
            $torles = '<form method="post"><input type="submit" class="btn btn-danger" name="delete" value="Törlés"><input type="hidden" name="id" value="'.$row[0].'"></form>';
            $update = '<form method="post"><input type="submit" class="btn btn-warning" name="select" value="Módosítás"><input type="hidden" name="id" value="'.$row[0].'"></form>';
            echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>$update</td><td>$torles</td></tr>";
        }
        echo "</table>";
    }

    function delete() {
        $db = Database::getInstance();
        $mysqli = $db->getConnection(); 
        $mysqli->set_charset("utf8");

        $qry = 'DELETE FROM `vacations` WHERE `vacation_id` = '.$_POST[id].' LIMIT 1';
        $result = $mysqli->query($qry);
    }

    function holyday_listing(){
        $db = Database::getInstance();
        $mysqli = $db->getConnection(); 
        $mysqli->set_charset("utf8");
        
        $qry = "SELECT vacation_id, destination, seats, starting_date, end_date FROM vacations";
        $result = $mysqli->query($qry);
        echo '<table class="table">';
        echo "<tr><td>Nyaralás ID</td><td>Úticél</td><td>Férőhely</td><td>Kezdő Dátum</td><td>Végdátum</td><td>Kapcsolat</td></tr>";
        while($row = mysqli_fetch_row($result)){
            $connection = '<div class="radio"><label><input type="radio" name="radio" id="radio" value="'.$row[0].'"></label></div>';
            echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>$connection</td></tr>";
        }
        echo "</table>";
    }
}

?>