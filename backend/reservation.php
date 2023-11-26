<?php

session_start();

header("Content-Type: application/json");


require('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    $stmt = $conn->prepare("SELECT * FROM reservation_entries");
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
    $email = test_input($data["email"]);
    $phone = test_input($data["phone"]);
    $date = test_input($data["date"]);
    $time = test_input($data["time"]);
    $people = test_input($data["people"]);
    $message = test_input($data["message"]) ?? null;

    $stmt = $conn->prepare("INSERT INTO reservation_entries (name, email, phone, date, time, people, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, $phone);
    $stmt->bindParam(4, $date);
    $stmt->bindParam(5, $time);
    $stmt->bindParam(6, $people);
    $stmt->bindParam(7, $message);

    if ($stmt->execute()) {
        //echo json_encode(["success" => true, "message" => "Reservation entry added successfully"]);
        echo "Reservation entry added successfully";
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