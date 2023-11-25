<?php 
session_start();


$username = "";
$password = "";

$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        
    if (empty($username)) {
        $errors['username'] = "Veuillez saisir un nom d'utilisateur";
    }
    elseif (empty($password)) {
        $errors['password'] = "Veuillez saisir un mot de passe valid";
    }
    else {

        include 'db_connection.php';

        $sql = "SELECT * FROM users WHERE username = ?"; 

        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $query = $conn->prepare($sql); 
        $query->execute([$username]);
        $user = $query->fetch();

        if (isset($user["username"]) && isset($user["password"])) {
            if($user["password"] === $password){ 
                session_start();
                $_SESSION["NAME"] = $username;
                if($user['role'] === 'admin') {
                    $_SESSION['ROLE'] = 'admin';
                    header("location: /restaurant2.0/restaurant-backend/admin.php"); 
                } else {
                    header("location: /restaurant2.0/restaurant-frontend/index.html");
                }               
            }
            else{  
                $errors['password'] = "Veuillez saisir un mot de passe valid"; 
            }            
        } else {
            $errors['password'] = "Nom d'utilisateur ou mot de passe non valid"; 
        }

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Koniya | Login - Backoffice</title>
</head>
<body>    

    <div class="container bg-light p-4 mt-5" style="width: 500px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <h1 class="text-center">Backoffice</h1>
        <form method="post">    
            <div>
                <label for="username" class="form-label">Nom d'utilisateur</label>
                <input type="text" name="username" id="username" value="<?= $username ?? '' ?>" class="form-control">
            </div><br>
            <?php if (isset($errors['username'])): ?>
                <div class="alert alert-danger">
                    <?= $errors['username'] ?>
                </div>
            <?php endif ?>
            <div>
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control">
            </div><br> 
            <?php if (isset($errors['password'])): ?>
                <div class="alert alert-danger">
                    <?= $errors['password'] ?>
                </div>
            <?php endif ?>         
            <p><button type="submit" class="btn" style="background-color: #a82c48; color: #fff;">Se connecter</button></p>
        </form>
        <a href="/restaurant2.0/restaurant-frontend/index.html">Back to Home page</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>