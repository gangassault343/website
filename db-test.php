<?php
$host = 'db';              // The service name of MySQL container (from docker-compose.yml)
$user = 'root';            // Or 'user' if you want to use the regular user
$password = 'secret'; // Matches MYSQL_ROOT_PASSWORD in docker-compose.yml
$database = 'phpcrud';       // Matches MYSQL_DATABASE in docker-compose.yml

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
#echo "Connected successfully to MySQL!";
?>