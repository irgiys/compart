<?php
include("./functions/session.php");
include("./functions/koneksi.php");
seller();
$fullname = $_SESSION["fullname"];
$seller_id = $_SESSION["id"];
$query = "SELECT * FROM product WHERE seller_id = '$seller_id'";
$result = mysqli_query($conn, $query);
$products = [];
while ($product = mysqli_fetch_assoc($result)) {
    $products[] = $product;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasboard Seller</title>
    <link rel="stylesheet" href="css/custom.min.css" />
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-light">
    <div class="container-fluid">
            <a class="navbar-brand fs-5" href="dashboard.php"> <?= $fullname ?> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="#">Profile</a>
                <a class="nav-link" href="#">Help</a>
                <a class="nav-link bg-altsecondary rounded" href="./functions/logout.php">Logout</a>
            </div>
        </div>
    </div>
    </nav>
    <div class="container-fluid mt-5">
        <div class="d-flex w-100 justify-content-between px-5">
            <p>All</p>
            <a class="btn btn-altprimary px-4 py-2" href="new.php">
                + Add New Product
            </a>
        </div>
        <div class="row container-fluid mt-4">
            <?php foreach ($products as $key => $product) :?>
                <div class="card h-fit col-sm-4 mx-2" style="width: 15rem;">
                    <img src="./assets/images/<?= $product["picture"] ?>" class="card-img-top img-fluid" >
                    <div class="card-body">
                        <h6 class="card-title"><?= $product["name"] ?></h6>
                        <p class="fs-sm">by <?= $product["merk"] ?></p>
                            <div class="pb-2">
                                <?php if($product["discount"] > 0) :?>
                                <span class="text-danger text-decoration-line-through">$<?= $product["price"] ?></span>
                                <?php endif ?>
                                <span class="ps-2">$<?= $product["price"] - ($product["discount"] / 100 * $product["price"])  ?></span>
                            </div>
                                <a href="#" class="btn btn-altsecondary float-start">Update</a>
                                <a href="#" class="btn btn-danger float-start ms-2">Delete</a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>