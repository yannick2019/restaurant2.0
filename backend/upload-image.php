<?php

include 'db_connection.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($errors)) {
        // Uploader l'image dans la base de donnée
        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $error = $_FILES['image']['error'];

        if ($error === 0) {
            if ($img_size > 200000) {
                $errors['image'] = "Taille du fichier trop grande";
            } else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array('jpg', 'jpeg', 'png', 'webp');

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid('IMG-', true) . '.' . $img_ex_lc;
                    $img_upload_path = '../frontend/upload-img-gallery/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    $query = $conn->prepare("INSERT INTO images_gallery (filename) VALUES (?)");
                    $query->execute([$new_img_name]);
                    header("location: /restaurant2.0/backend/admin.php"); 
                } else {
                    $errors['image'] = "Fichier non supporté.";
                }
            }
        }
    } else {

    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $stmt = "SELECT * FROM images_gallery";
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $query = $conn->prepare($stmt);
    $query->execute();
    $images = $query->fetchAll();

    if ($images !== false) {
        $arr = [];
        foreach($images as $image) {
            array_push($arr, $image);
        }
        echo json_encode(['images' => $arr]);
    } else {
        echo json_encode(['error' => 'Something went wrong.']);
    }
    exit();
} 

