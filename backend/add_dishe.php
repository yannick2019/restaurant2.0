<?php

session_start();

include 'db_connection.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="../restaurant-frontend/images/koniya-favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/admin.css">
    <title>Backoffice | Add dishe</title>
</head>
<body>

    <div class="container bg-light p-4 mt-5" style="width: 600px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">

        <h1 class="text-center">Add dishe</h1>

        <a href="./admin.php"><i class="fa-solid fa-arrow-left mb-4" style="color: #0a1529;"></i> Back to Menu</a>

        <form method="post" enctype="multipart/form-data">
            
            <div class="form-group mb-2">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="<?= $name ?? '' ?>" class="form-control">
            </div>
            <?php if(isset($errors['name'])): ?>
                <div class="alert alert-danger">
                    <?= $errors['name'] ?>
                </div>
            <?php endif ?>
            <div class="form-group mb-2">
                <label for="category">Category</label>
                <select name="category" id="category">
                    <option value="appetizer">Appetizer</option>
                    <option value="main_course">Main course</option>
                    <option value="dessert">Dessert</option>
                    <option value="Culture">Culture</option>
                    <option value="drink">Drink</option>
                </select>
            </div>
            <?php if(isset($errors['category'])): ?>
                <div class="alert alert-danger">
                    <?= $errors['category'] ?>
                </div>
            <?php endif ?> 
            <div class="form-group mb-2"> 
                <textarea name="description" rows="8" class="form-control" placeholder="Description"><?= $description ?? '' ?></textarea>
            </div>
            <?php if(isset($errors['description'])): ?>  
                <div class="alert alert-danger">
                    <?= $errors['description'] ?>
                </div>
            <?php endif ?>
            <div class="form-group mb-2">
                <label for="price">Price</label>
                <input type="text" name="price" id="price" value="<?= $name ?? '' ?>" class="form-control">
            </div>
            <?php if(isset($errors['price'])): ?>
                <div class="alert alert-danger">
                    <?= $errors['price'] ?>
                </div>
            <?php endif ?>
            
            <!-- Uploader une image -->
            <label for="filename" class="mb-2">Image</label>
            <input type="file" name="filename" id="filename" class="form-control mb-2">
            <?php if(isset($errors['filename'])): ?>  
                <div class="alert alert-danger">
                    <?= $errors['filename'] ?>
                </div>
            <?php endif ?>
            <!-- End -->

            <button type="submit" class="btn mt-2" style="background-color: #a82c48; color: #fff;">Add dishe</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="./js/admin.js"></script>
    
</body>
</html>