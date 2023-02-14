<?php
$servername = "localhost";
$username = "root";
$dbname="bookstore_db";


$conn = new mysqli($servername, $username, '',$dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>