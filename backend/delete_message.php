<?php
session_start();

require('db_connection.php');

$id = $_GET['id'];

// Delete message
$query = $conn->prepare("DELETE FROM contact_entries WHERE id = ?");
$result = $query->execute([$id]);

if ($result === false) {
    throw new Exception("Impossible de supprimer l'enregistrement $id");
}

header("location: /restaurant2.0/backend/admin.php?delete=1");