<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "form";
$table = "formData";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connection OK.";

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS ".$db;
if ($conn->query($sql) === TRUE) {
	mysqli_select_db($conn, $db);
    echo "Database OK.";
} else {
    echo "Error creating database: " . $conn->error.".";
}

// sql to create table
$query = "SELECT * FROM ".$table;
$result = $conn->query($query);


$sql = "CREATE TABLE ".$table." (
id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
name VARCHAR(30) NOT NULL,
designation VARCHAR(30) NOT NULL,
employee_id VARCHAR(30) NOT NULL,
department VARCHAR(30) NOT NULL,
work ENUM ('AC','Electrical','Vehicle Maintenance'),
description VARCHAR(500) NOT NULL,
time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if(empty($result)) {
	if ($conn->query($sql) === TRUE) {
		echo "Table OK.";
	} else {
		echo "Error creating table: " . $conn->error;
	}
}else{
	echo "Table OK.";
}
?>
