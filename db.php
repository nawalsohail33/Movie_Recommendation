<?php
$servername = 'localhost';
$database = 'movie_recommendation';
$user = 'root';
$password = '';
$conn=mysqli_connect($servername,$user,$password,$database);
if(!$conn)
{
  
    die('Connection failed: ' . $con->connect_error);
}
?>
