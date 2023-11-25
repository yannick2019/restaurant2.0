<?php 
session_start();

if ($_SESSION['ROLE'] !== 'admin') {
    header("location: /restaurant2.0/restaurant-backend/login.php"); 
    die();
}

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
    <title>Koniya | Backoffice</title>
</head>
<body>

    <!-- Specials Section -->
    <section id="specials" class="specials">
        <div class="dashboard">
            <div class="sidebar">
                <div class="logo">
                    <span class="fs-3">Koniya Restaurants</span>
                </div>
                <ul class="nav nav-tabs flex-column">
                    <li class="nav-item">
                        <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#tab-1" href="#tab-1">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-2" href="#tab-2">Message</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-3" href="#tab-3">Guest book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-4" href="#tab-4">Reservation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-5" href="#tab-5">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-6" href="#tab-6">Menu</a>
                    </li>
                </ul>
                <form action="./logout.php" method="post" style="display:inline;">
                    <button type="submit" class="nav-link logout-btn" style="background: transparent; border: none;"><i class="fa-solid fa-right-from-bracket" style="color: black;"></i> Disconnect</button>
                </form>
            </div>
                <div class="main-content-dashboard">
                    <nav class="navbar-dashboard">
                        <form action="./logout.php" method="post" style="display:inline;">
                            <button type="submit" class="nav-link fs-3 logout-btn" style="background: transparent; border: none;"><i class="fa-solid fa-right-from-bracket" style="color: black;"></i></button>
                            <div class="hover-text">Logout</div>
                        </form>
                    </nav>
                    <div class="content-dashboard">
                        <div class="tab-content pt-5">
                            <!-- ********** Dashboard ****************** -->
                            <div class="tab-pane active show" id="tab-1">
                                <div class="row">
                                    <div class="details order-2 order-lg-1">                                        
                                        <div class="container">
                                            <h2 class="pb-4"><i class="fa fa-fw fa-dashboard"></i>Dashboard</h2>
                                            <div class="row">
                                                <div class="col-xl-3 col-sm-6 mb-3">                                      
                                                    <div class="card" style="height: 12rem; background-color: #a82c48; color: #fff;">
                                                        <div class="card-body">
                                                            <h4>Messages</h4>
                                                            <?php 
                                                            //Count messages
                                                            $count_msg = (int)$conn->query("SELECT COUNT(id) FROM contact_entries")->fetch(PDO::FETCH_NUM)[0];
                                                            echo "<p style='font-size: 2rem;'>$count_msg</p>";
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-xl-3 col-sm-6 mb-3">                                      
                                                    <div class="card" style="height: 12rem; background-color: #a82c48; color: #fff;">
                                                        <div class="card-body">
                                                            <h4>Guest book</h4>
                                                            <?php 
                                                            $count_msg = (int)$conn->query("SELECT COUNT(id) FROM guestbook_entries")->fetch(PDO::FETCH_NUM)[0];
                                                            echo "<p style='font-size: 2rem;'>$count_msg</p>";
                                                            echo "messages";
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-sm-6 mb-3">                                      
                                                    <div class="card" style="height: 12rem; background-color: #a82c48; color: #fff;">
                                                        <div class="card-body">
                                                            <h4>Reservations</h4>
                                                            <?php 
                                                            $count_msg = (int)$conn->query("SELECT COUNT(id) FROM reservation_entries")->fetch(PDO::FETCH_NUM)[0];
                                                            echo "<p style='font-size: 2rem;'>$count_msg</p>";
                                                            echo "reservations";
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3 col-sm-6 mb-3">                                      
                                                    <div class="card" style="height: 12rem; background-color: #a82c48; color: #fff;">
                                                        <div class="card-body">
                                                            <h4>Gallery</h4>
                                                            <?php 
                                                            $count_msg = (int)$conn->query("SELECT COUNT(id) FROM images_gallery")->fetch(PDO::FETCH_NUM)[0];
                                                            echo "<p style='font-size: 2rem;'>$count_msg</p>";
                                                            echo "images";
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ********** Messages ****************** -->
                            <div class="tab-pane" id="tab-2">
                                <div class="row">
                                    <div class="details order-2 order-lg-1">
                                        <h2 class="pb-4">Messages</h2>
                                        <?php 
                                        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                                        $query = $conn->prepare("SELECT * 
                                                                FROM contact_entries
                                                                ORDER BY created_at DESC");
                                        $query->execute();
                                        $contact_entries = $query->fetchAll();
                                        ?>
                                        <table class="table table-striped table-bordered border-dark">
                                            <thead>
                                                <th>Date</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Subject</th>
                                                <th>Message</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <?php foreach($contact_entries as $contact_entrie): ?>
                                                <tr>
                                                    <td><?= $contact_entrie['created_at'] ?></td>
                                                    <td>
                                                        <?= $contact_entrie['name'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $contact_entrie['email'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $contact_entrie['subject'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $contact_entrie['message'] ?>
                                                    </td>
                                                    <td>
                                                        <form action="./delete_message.php?id=<?= $contact_entrie['id'] ?>" method="POST"
                                                            onsubmit="return confirm('Voulez vous supprimer ?')" style="display:inline;">
                                                            <button type="submit" class="btn"><i class="fa-solid fa-trash-can" style="color: black;"></i></button>                                                        
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- ********** Guest book ******************* -->
                            <div class="tab-pane" id="tab-3">
                                <div class="row">
                                    <div class="details order-2 order-lg-1">                                        
                                        <h2 class="pb-4">Guest book</h2>
                                        <?php 
                                        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                                        $query = $conn->prepare("SELECT * 
                                                                FROM guestbook_entries
                                                                ORDER BY id DESC");
                                        $query->execute();
                                        $guestbook_entries = $query->fetchAll();
                                        ?>
                                        <table class="table table-striped table-bordered border-dark">
                                            <thead>
                                                <th>Date</th>
                                                <th>Name</th>
                                                <th>Visited restaurant</th>
                                                <th>Comment</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <?php foreach($guestbook_entries as $guestbook_entrie): ?>
                                                <tr>
                                                    <td>
                                                        <?= $guestbook_entrie['created_at'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $guestbook_entrie['name'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $guestbook_entrie['visited_restaurant'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $guestbook_entrie['comment'] ?>
                                                    </td>
                                                    <td>
                                                        <form action="./delete_guestbook_entrie.php?id=<?= $guestbook_entrie['id'] ?>" method="POST"
                                                            onsubmit="return confirm('Voulez vous supprimer ?')" style="display:inline;">
                                                            <button type="submit" class="btn"><i class="fa-solid fa-trash-can" style="color: black;"></i></button>                                                        
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- ********** Reservations ******************** -->
                            <div class="tab-pane" id="tab-4">
                                <div class="row">
                                    <div class="details order-2 order-lg-1">
                                        <h2 class="pb-4">Reservations</h2>
                                        <?php 
                                        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                                        $query = $conn->prepare("SELECT * FROM reservation_entries");
                                        $query->execute();
                                        $reservation_entries = $query->fetchAll();
                                        ?>
                                        <table class="table table-striped table-bordered border-dark">
                                            <thead>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone number</th>
                                                <th>Reservation date</th>
                                                <th>Time</th>
                                                <th>People</th>
                                                <th>Message</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <?php foreach($reservation_entries as $reservation_entrie): ?>
                                                <tr>
                                                    <td>
                                                        <?= $reservation_entrie['name'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $reservation_entrie['email'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $reservation_entrie['phone'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $reservation_entrie['date'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $reservation_entrie['time'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $reservation_entrie['people'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $reservation_entrie['message'] ?>
                                                    </td>
                                                    <td>
                                                        <form action="./delete_reservation.php?id=<?= $reservation_entrie['id'] ?>" method="POST"
                                                            onsubmit="return confirm('Voulez vous supprimer ?')" style="display:inline;">
                                                            <button type="submit" class="btn"><i class="fa-solid fa-trash-can" style="color: black;"></i></button>                                                        
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- ************ Gallery ******************** -->
                            <div class="tab-pane" id="tab-5">
                                <div class="row">
                                    <div class="details order-2 order-lg-1">
                                        <h2 class="pb-3">Gallery</h2>
                                        <form action="./upload-image.php" method="post" enctype="multipart/form-data" class="pt-4">
                                            <div class="col-auto">
                                                <input type="file" name="image" class="form-control" required>
                                                <span class="form-text">exemple.jpg</span>
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" class="btn mb-3 mt-3" style="background-color: #a82c48; color: white">Upload</button>
                                            </div>
                                        </form>
                                        <?php 
                                        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                                        $query = $conn->prepare("SELECT * FROM images_gallery");
                                        $query->execute();
                                        $images_gallery = $query->fetchAll();
                                        ?>
                                        <table class="table table-striped table-bordered border-dark">
                                            <thead>
                                                <th>Date</th>
                                                <th>Filename</th>
                                                <th>Img</th>
                                                <th>Delete</th>
                                            </thead>
                                            <tbody>
                                                <?php foreach($images_gallery as $image_gallery): ?>
                                                <tr>
                                                    <td>
                                                        <?= $image_gallery['created_at'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $image_gallery['filename'] ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                        $img = $image_gallery['filename'];
                                                        echo "<img src='../restaurant-frontend/upload-img-gallery/$img' alt='image' style='width: 100px;'>";
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <form action="./delete_image.php?id=<?= $image_gallery['id'] ?>" method="POST"
                                                            onsubmit="return confirm('Voulez vous supprimer ?')" style="display:inline;">
                                                            <button type="submit" class="btn"><i class="fa-solid fa-trash-can" style="color: black;"></i></button>                                                        
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- ************ Menu ******************** -->
                            <div class="tab-pane" id="tab-6">
                                <div class="row">
                                    <div class="details order-2 order-lg-1">
                                        <h2 class="pb-4"><i class="fa-solid fa-utensils fs-3"></i> Menu</h2>
                                        <div class="mb-3">
                                            <i class="fa-solid fa-plus" style="color: #1a2942;"></i> <a href="./add_dishe.php">Add dishe</a>
                                        </div>
                                        <?php 
                                        ?>
                                        <table class="table table-striped table-bordered border-dark">
                                            <thead>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <?php //foreach($dishes as $dishe): ?>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td> </td>
                                                    <td>
                                                        <form action="./delete_dishe.php?id=<?= $reservation_entrie['id'] ?>" method="POST"
                                                            onsubmit="return confirm('Voulez vous supprimer ?')" style="display:inline;">
                                                            <button type="submit" class="btn"><i class="fa-solid fa-trash-can" style="color: black;"></i></button>                                                        
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php //endforeach ?>
                                            </tbody>
                                        </table>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>            
    </section>
    <!-- End Specials Section -->


    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="./js/admin.js"></script>
    
</body>
</html>