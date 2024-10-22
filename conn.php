<?php
$server = 'localhost';
$username = 'root';
$pass = '';
$db = 'con';

$con = new mysqli($server,$username,$pass,$db);
if($con->connect_error){
    die("Connection error:".$con->connect_errno);
}
?>


<!-- CREATE TABLE con2 (
    name VARCHAR(100) NOT NULL,
    roll INT PRIMARY KEY,
    course_category ENUM('UG', 'PG') NOT NULL,
    course_name VARCHAR(50) NOT NULL,
    phone BIGINT NOT NULL,
    email VARCHAR(100) NOT NULL,
    state VARCHAR(50) NOT NULL,
    gender ENUM('Male', 'Female', 'Custom') NOT NULL,
    languages VARCHAR(255),
    address VARCHAR(255)
); -->