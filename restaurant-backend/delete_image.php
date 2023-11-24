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

// Get image by post_id
$query = $conn->prepare("SELECT * FROM images_gallery WHERE id = ?");
$query->execute([$id]);
$img = $query->fetch();

// Delete image file from upload directory
$img_name = $img['filename'];
unlink("../restaurant-frontend/upload-img-gallery/" . $img_name);

// Delete image file from database
$query2 = $conn->prepare("DELETE FROM images_gallery WHERE id = ?");
$result = $query2->execute([$id]);

if ($result === false) {
    throw new Exception("Impossible de supprimer l'enregistrement $id");
}


header("location: /restaurant2.0/restaurant-backend/admin.php?delete=1");