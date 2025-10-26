<?php

require_once 'db_credentials.php';

$conn_status = "Pending";
$conn = null;
try {
  $conn = mysqli_connect($hostname, $username, $password, $database);
  $conn_status = "\nConnected";
  if (!$conn) {
    $conn_status = "\nConnection failed";
  }
} catch (Exception $e) {
  $conn_status = "\nAn error occurred";
}