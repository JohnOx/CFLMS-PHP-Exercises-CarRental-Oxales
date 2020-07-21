<?php 

require_once 'db_connect.php';

if($_POST) {
    $brand = $_POST['brand'];
    $type = $_POST['type'];
    $price = $_POST['price'];

    $sql = "INSERT INTO car(brand, type, price) VALUES ('$brand','$type','$price')";

    if($con->query($sql) === TRUE) {
        echo "<p>New Car added!</p>" ;
        echo "<a href='../add.php'><button type='button'>Back</button></a>";
         echo "<a href='./../CarRental.php'><button type='button'>Home</button></a>";
    } else  {
        echo "Error " . $sql . ' ' . $con->connect_error;
    }
 
    $con->close();
 }

?>

