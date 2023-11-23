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

        // MySQL Database Connection
        $host = "localhost";
        $user_name = "root";
        $user_password = "root";
        $database = "restaurant";

        try {
            $conn = new PDO("mysql:host=$host;dbname=$database", $user_name, $user_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["error" => "Database connection error: " . $e->getMessage()]);
            exit;
        }

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
    <title>Koniya | Login - Backoffice</title>
</head>
<body>
    <h1>Se connecter</h1>

    <form method="post">    
        <div>
            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" id="username" value="<?= $username ?? '' ?>" class="form-control">
        </div><br>
        <?php if (isset($errors['username'])): ?>
        <div class="alert alert-danger">
            <?= $errors['username'] ?>
        </div>
        <?php endif ?>
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control">
        </div><br> 
        <?php if (isset($errors['password'])): ?>
        <div class="alert alert-danger">
            <?= $errors['password'] ?>
        </div>
        <?php endif ?>         
        <p><button type="submit" class="btn btn-primary">Se connecter</button></p>
    </form>
    <a href="/restaurant2.0/restaurant-frontend/index.html">Back to Home page</a>
</body>
</html>