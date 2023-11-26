<?php
session_start();

require('db_connection.php');

$id = $_GET['id'];

// Get image by id
$query = $conn->prepare("SELECT * FROM images_gallery WHERE id = ?");
$query->execute([$id]);
$img = $query->fetch();

// Delete image file from upload directory
$img_name = $img['filename'];
unlink("../frontend/upload-img-gallery/" . $img_name);

// Delete image file from database
$query2 = $conn->prepare("DELETE FROM images_gallery WHERE id = ?");
$result = $query2->execute([$id]);

if ($result === false) {
    throw new Exception("Impossible de supprimer l'enregistrement $id");
}


header("location: /restaurant2.0/backend/admin.php?delete=1");