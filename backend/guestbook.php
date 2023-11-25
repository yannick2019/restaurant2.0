<?php

header("Content-Type: application/json");

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    $stmt = $conn->prepare("SELECT * FROM guestbook_entries");
    $stmt->execute();
    $response = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($response);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $name = test_input($data["name"]);
    $visitedRestaurant = test_input($data["visited_restaurant"]);
    $visitDate = test_input($data["visit_date"]);
    $comment = test_input($data["comment"]) ?? null;

    $stmt = $conn->prepare("INSERT INTO guestbook_entries (name, visited_restaurant, visit_date, comment) VALUES (?, ?, ?, ?)");
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $visitedRestaurant);
    $stmt->bindParam(3, $visitDate);
    $stmt->bindParam(4, $comment);

    if ($stmt->execute()) {
        //echo json_encode(["success" => true, "message" => "Guestbook entry added successfully"]);
        echo "Guestbook entry added successfully";
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


