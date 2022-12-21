<?php
include("./functions/session.php");
include("./functions/koneksi.php");
include("./functions/cutword.php");
seller();
$fullname = $_SESSION["fullname"];
$seller_id = $_SESSION["id"];

$query = "SELECT p.id, p.name, p.desc, p.merk, p.picture, p.price, p.discount, pi.quantity, p.deleted_at, pi.id AS inventory_id
            FROM product AS p
            JOIN product_inventory AS pi ON (p.inventory_id = pi.id) WHERE p.deleted_at IS NOT NULL AND p.seller_id = '$seller_id'";
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
    <title>Archive Seller</title>
    <link rel="stylesheet" href="css/custom.min.css" />

</head>

<body class="min-vh-100">
    <nav class="navbar navbar-expand-sm bg-light">
        <div class="container-fluid px-md-5">
            <a class="navbar-brand fs-5 m-0 fw-semibold font-fair" href="dashboard.php"> compart
                <span class="ms-4 translate-middle badge rounded-pill bg-altsecondary">seller</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link px-4" href="#">Faq</a>
                    <a class="nav-link px-4" href="#">Help</a>
                    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle after-none" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= $fullname ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item d-flex justify-content-around" href="profile_seller.php">
                                            <span>
                                                Profile
                                            </span>
                                            <img src="./assets/svg/chevron-right.svg" alt="right">
                                        </a></li>
                                    <li><a class="dropdown-item d-flex justify-content-around" href="./functions/logout.php">
                                            <span>
                                                Logout
                                            </span>
                                            <img src="./assets/svg/chevron-right.svg" alt="right"></a>
                                    </li>
                                </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid px-md-5">
        <ul class="nav nav-pills py-3">
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Overview</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="report.php">Report</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Archive</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="order.php">Order</a>
            </li>
        </ul>
        <div class="mt-3">
            <div class="d-flex justify-content-between w-100">
                <div class="col">
                    <input type="search" class="form-control" placeholder="Search Product" aria-label="Search Box" id="searchInput" oninput="setTimeout(()=>search(),500)">
                </div>
            </div>
        </div>
        <div class="row mt-4 justify-content-around">
            <div class="d-none h-100" id="result">
                <h1>
                    No Results Found
                </h1>
                <p>
                    Your search did not return any results.
                </p>
            </div>
            <?php foreach ($products as $key => $product) : ?>
                <!-- strlen($product["name"])  -->
                <div class="card col-sm-4 m-2" style="width: 14rem;" id="product">
                    <img src="./assets/images/products/<?= $product["picture"] ?>" class="image-card">
                    <div class="d-flex flex-column justify-content-between flex-auto flex-auto pb-3">
                        <h6 class="card-title mt-2"><?= $product["name"] ?></h6>
                        <div>
                            <?php if (strlen($product["name"]) < 30) { ?>
                                <p class="fs-sm mb-1"><?= cutword($product["desc"], 100) ?></p>
                            <?php } elseif (strlen($product["name"]) < 50) { ?>
                                <p class="fs-sm mb-1"><?= cutword($product["desc"], 40) ?></p>
                            <?php } else { ?>
                                <p class="fs-sm mb-1"><?= cutword($product["desc"], 20) ?></p>
                            <?php } ?>
                            <p class="fs-sm mt-1 fw-semibold"><?= $product["merk"] ?></p>
                        </div>
                        <div>
                            <div class="pb-2 d-flex justify-content-between">
                                <div class="d-flex flex-column">
                                    <span class="fw-semibold">$<?= $product["price"] - ($product["discount"] / 100 * $product["price"])  ?></span>
                                    <?php if ($product["discount"] > 0) : ?>
                                        <div class="fs-mb pt-2">
                                            <span class="p-1 bg-danger rounded text-white">%<?= $product["discount"] ?></span>
                                            <span class="ps-2 text-decoration-line-through">$<?= $product["price"] ?></span>
                                        </div>
                                    <?php endif ?>
                                </div>
                                <span class="bg-gray p-1 text-align-left rounded fs-sm align-self-end">stock <?= $product["quantity"] ?></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="update_product.php?id=<?= $product["id"] ?>" class="btn btn-warning text-dark">Update</a>
                                <a href="restore_product.php?id=<?= $product["id"] ?>" class="btn btn-altprimary">
                                    <img src="./assets/svg/refresh.svg" alt="restore">
                                </a>
                                <a href="delete_product.php?id=<?= $product["id"] ?>" class="btn btn-danger" onclick="return confirm('Delete this product?')">
                                    <img src="./assets/svg/trash.svg" alt="restore">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <!-- <footer class="bg-gray mt-5 p-5 text-center">
        Made with ☕ by Kelompok 4 🤝 
    </footer> -->
    <script>
        function search() {
            let searchInput = document.getElementById("searchInput").value;
            let result = document.getElementById("result");
            let products = document.querySelectorAll("#product")
            let i = 0
            products.forEach(product => {
                if (product.innerText.toLowerCase().includes(searchInput.toLowerCase())) {
                    product.classList.remove("d-none");
                    i++;
                } else {
                    product.classList.add("d-none");
                }
            });
            i === 0 ? result.classList.remove("d-none") : result.classList.add("d-none");
        }
    </script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>