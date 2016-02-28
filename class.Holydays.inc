<?php
class Holydays {

	public $customer_id;

	public $vacation_id;

   	function __construct($data = array()) {
       if(!is_array($data)){
           trigger_error('Nem tudtunk nyaralást hozzáadni a'.get_calss($name).' osztállyal!');
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
        
        $qry = "INSERT INTO holydays (`customer_id`,`vacation_id`) VALUES ('$this->customer_id' , '$this->vacation_id')";
        $mysqli->query($qry);
    }

    function listing(){
        $db = Database::getInstance();
        $mysqli = $db->getConnection(); 
        $mysqli->set_charset("utf8");

        $qry= "SELECT holyday_id, name, email, phone, destination, starting_date, end_date FROM `holydays` h JOIN `customers` c ON (h.customer_id=c.customer_id) JOIN `vacations` v ON (h.vacation_id=v.vacation_id)";
        $result = $mysqli->query($qry);
        echo'<table class="table">';
        echo"<tr><td>ID</td><td>Név</td><td>Email</td><td>Telefonszám</td><td>Uticél</td><td>Kezdő dátum</td><td>Végdátum</td><td>Törlés</td></tr>";
        while($row = mysqli_fetch_row($result)){
	        $torles = '<form method="post"><input type="submit" class="btn btn-danger" name="delete" value="Törlés"><input type="hidden" name="id" value="'.$row[0].'"></form>';
	        echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td>".$row[6]."</td><td>$torles</td></tr>";
        }
        echo "</table>";
    }

    function delete() {
        $db = Database::getInstance();
        $mysqli = $db->getConnection(); 
        $mysqli->set_charset("utf8");

        $qry = 'DELETE FROM `holydays` WHERE `holyday_id` = '.$_POST[id].' LIMIT 1';
        $result = $mysqli->query($qry);
    }
}

?>