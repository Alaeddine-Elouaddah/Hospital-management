<?php
$conn = new mysqli("localhost", "root", "", "hospitalmanagement");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

