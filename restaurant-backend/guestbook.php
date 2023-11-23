<?php

header("Content-Type: application/json");

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

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    $stmt = $conn->prepare("SELECT * FROM guestbook_entries");
    $stmt->execute();
    $response = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($response);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $name = $data["name"];
    $visitedRestaurant = $data["visited_restaurant"];
    $visitDate = $data["visit_date"];
    $comment = $data["comment"] ?? null;

    $stmt = $conn->prepare("INSERT INTO guestbook_entries (name, visited_restaurant, visit_date, comment) VALUES (?, ?, ?, ?)");
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $visitedRestaurant);
    $stmt->bindParam(3, $visitDate);
    $stmt->bindParam(4, $comment);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Guestbook entry added successfully"]);
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Error executing the database query"]);
        exit;
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Method not allowed"]);
}

$conn = null;


