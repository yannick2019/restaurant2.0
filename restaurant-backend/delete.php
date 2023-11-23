<?php
session_start();

// MySQL Database Connection
$host = "localhost";
$username = "root";
$password = "root";
$database = "restaurant";

try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection error: " . $e->getMessage()]);
    exit;
}

$id = $_GET['id'];

// Delete post
$query = $conn->prepare("DELETE FROM contact_entries WHERE id = ?");
$result = $query->execute([$id]);

if ($result === false) {
    throw new Exception("Impossible de supprimer l'enregistrement $id");
}

header("location: /restaurant2.0/restaurant-backend/admin.php?delete=1");