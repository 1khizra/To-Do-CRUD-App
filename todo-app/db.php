<?php
$host="localhost";
$user="root";
$pass="";
$dbanme="todo_app";

$conn= new mysqli($host,$user,$pass,$dbanme);

if($conn->connect_error){
    die("database connection fail: ". $conn->connect_error);
}
?>