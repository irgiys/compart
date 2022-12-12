<?php 
include("./functions/koneksi.php");
include("./functions/session.php");
user();
$id = $_SESSION["id"];
$fullname = $_SESSION["fullname"];


$query = "SELECT c.*, p.name, p.picture, p.price, p.discount, s.fullname
        FROM cart_item as c 
        JOIN product AS p 
            ON (c.product_id = p.id)
        JOIN seller AS s 
            ON (p.seller_id = s.id)
        WHERE c.user_id = '$id' AND c.deleted_at IS NULL";

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/custom.min.css" />

</head>
<body>
<nav class="navbar navbar-expand-sm bg-white fixed-top ">
    <div class="container-fluid px-md-5 py-2">
            <a class="navbar-brand fs-5 m-0 fw-semibold font-fair" href="index.php"> compart</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav px-4 sm:align-items-center align-items-end">
                <form action="search.php" method="post">
                    <div class="input-group">
                            <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">                            
                            <button type="submit" class="input-group-text btn btn-gray rounded-end m-0" id="inputGroup-sizing-sm">
                                <img src="./assets/svg/search.svg" alt="search"/>
                            </button>
                        </div>
                    </form>
                    <datalist id="datalistOptions">
                    <option value="San Francisco">
                    <option value="New York">
                    <option value="Seattle">
                    <option value="Los Angeles">
                    <option value="Chicago">
                    </datalist>
                    <li class="nav-item dropdown px-md-5 py-2 py-md-0">
                        <a class="nav-link dropdown-toggle after-none" href="#" role="button" data-bs-toggle="dropdown"  aria-expanded="false">
                            <?= $fullname ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item d-flex justify-content-around" href="profile_seller.php"> 
                                <span>Profile</span><img src="./assets/svg/chevron-right.svg" alt="right">
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex justify-content-around" href="./functions/logout.php">
                                <span>Logout</span>
                                <img src="./assets/svg/chevron-right.svg" alt="right"></a>
                            </li>
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid px-5 mt-large">
        <h2>All</h2>
        <div class="mt-2 d-flex flex-column align-items-center">
            <?php
                $row = [];
                while($row = mysqli_fetch_assoc($result)) : ?>
                <div class="m-2 border w-cart p-4 d-flex align-items-end justify-content-between">
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-start">
                            <img src="./assets/svg/user.svg" alt="">
                            <h5 class="d-inline ps-2"><?= $row["fullname"] ?></h5>
                        </div>
                        <div class="d-flex mt-3">
                            <img class="image-thumbnail" src="./assets/images/products/<?= $row["picture"] ?>" alt="">
                            <div class="ps-4">
                                <a href="http://localhost/compart/detail_product.php?id=<?= $row["product_id"] ?>" class="text-decoration-none text-dark fs-5 fw-semibold"><?= $row["name"] ?></a>
                                <p class="pt-4" id="price">$<?= $row["price"] - $row["discount"] / 100 * $row["price"] ?> x <?= $row["quantity"] ?></p>
                                <h4 class="fw-semibold text-danger">$<?= $row["amount"] ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <a href="" class="btn btn-danger text-white" onclick="return confirm('Delete this product?')">
                            <img src="./assets/svg/trash.svg" alt="" srcset="">
                        </a>
                        <button class="btn btn-altprimary ms-2">Checkout</button>
                    </div>
                </div>
            <?php endwhile ?>
        
        </div>
    </div>
</body>
</html>