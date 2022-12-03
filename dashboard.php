<?php
include("./functions/session.php");
include("./functions/koneksi.php");
seller();
$fullname = $_SESSION["fullname"];
$seller_id = $_SESSION["id"];

$query = "SELECT p.id, p.name, p.desc, p.merk, p.picture, p.price, p.discount, pi.quantity, p.deleted_at, pi.id AS inventory_id
            FROM product AS p
            JOIN product_inventory AS pi ON (p.inventory_id = pi.id) WHERE p.deleted_at IS NULL AND p.seller_id = '$seller_id'";
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
    <div class="container-fluid px-md-5 py-2">
            <a class="navbar-brand fs-5 m-0 w-fit" href="dashboard.php"> <?= $fullname ?> 
            <span class="ms-4 translate-middle badge rounded-pill bg-altsecondary">seller</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link px-4" href="profile_seller.php">Profile</a>
                <a class="nav-link px-4" href="#">Help</a>
                <a class="nav-link px-4 bg-altsecondary rounded" href="./functions/logout.php">Logout</a>
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
        <div class="row mt-4 px-md-5">
            <?php foreach ($products as $key => $product) :?>
                <div class="card col-sm-4 m-2" style="width: 15rem;">
                    <img src="./assets/images/<?= $product["picture"] ?>" class="image-card" >
                    <div class="d-flex flex-column justify-content-between flex-auto flex-auto pb-3">
                        <div>
                            <h6 class="card-title"><?= $product["name"] ?></h6>
                            <p class="fs-sm">by <?= $product["merk"] ?></p>
                        </div>
                        <div>
                            <div class="pb-2 d-flex justify-content-between">
                                <?php if($product["discount"] > 0) :?>
                                    <div>
                                    <span class="text-danger text-decoration-line-through">$<?= $product["price"] ?></span>
                                <?php endif ?>
                                    <span class="ps-2">$<?= $product["price"] - ($product["discount"] / 100 * $product["price"])  ?></span> 
                                <?php if($product["discount"] > 0) :?>
                                     </div>
                                <?php endif ?>
                                    <span class="bg-gray p-1 text-align-left rounded fs-sm">stock <?= $product["quantity"]?></span>
                            </div>
                                    <div class="d-flex justify-content-between">
                                        <a href="update.php?id=<?= $product["id"] ?>" class="btn btn-altsecondary">Update</a>
                                        <a href="delete.php?id=<?= $product["id"] ?>" class="btn btn-danger" onclick="return confirm('Delete this?')">Delete</a>
                                    </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>