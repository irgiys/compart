<?php
include("./functions/session.php");
include("./functions/koneksi.php");
include("./functions/cutword.php");
admin();
$fullname = $_SESSION["fullname"];

$queryCheckout = "SELECT c.*, p.name, p.picture, p.price, p.discount, p.deleted_at, u.fullname
                FROM checkout_session as c 
                JOIN product AS p 
                    ON (c.product_id = p.id)
                JOIN seller AS s 
                    ON (p.seller_id = s.id)
                JOIN user AS u
                    ON (c.user_id = u.id)
                WHERE  c.deleted_at IS NULL AND p.deleted_at IS NULL";

$result = mysqli_query($conn, $queryCheckout);
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
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= $fullname ?>
                            </a>
                            <ul class="dropdown-menu-end dropdown-menu">
                                <li><a class="dropdown-item" href="profile_seller.php">Profile</a></li>
                                <li><a class="dropdown-item" href="./functions/logout.php">Logout</a></li>
                            </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid px-md-5 mb-3">
        <ul class="nav nav-pills py-3">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="admin_dashboard.php">Overview</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_report.php">Report</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_archive.php">Archive</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="admin_order.php">Order</a>
            </li>
        </ul>
        <div>
            <input type="radio" class="btn-check" name="options-outlined" id="all" autocomplete="off" checked>
            <label class="btn btn-outline-altdark mt-2" for="all">all</label>

            <input type="radio" class="btn-check btn-status" name="options-outlined" id="waiting" autocomplete="off">
            <label class="btn btn-outline-altdark mt-2" for="waiting">waiting</label>

            <input type="radio" class="btn-check btn-status" name="options-outlined" id="shipping" autocomplete="off">
            <label class="btn btn-outline-altdark mt-2" for="shipping">shipping</label>

            <input type="radio" class="btn-check btn-status" name="options-outlined" id="done" autocomplete="off">
            <label class="btn btn-outline-altdark mt-2" for="done">done</label>
        </div>
        <div class="mt-3 row justify-content-center">
            <?php
            $i = 0;
            $row = [];
            while ($row = mysqli_fetch_assoc($result)) : ?>
                <?php
                if ($row['status'] == 0) {
                    $status = "waiting";
                    $message = "waiting to ship";
                }
                if ($row['status'] == 1) {
                    $status = "shipping";
                    $message = "delivery to the destination address";
                }
                if ($row['status'] == 2) {
                    $status = "done";
                    $message = "arrived to the address location";
                }
                ?>
                <div class="col-5 m-1 border w-cart p-4 d-flex align-items-end justify-content-between product-status" data-status="<?= $status ?>" id="<?= $row['status'] ?>">
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-start">
                            <img src="./assets/svg/user.svg" alt="">
                            <h5 class="d-inline ps-2"><?= $row["fullname"] ?></h5>
                        </div>
                        <div class="d-flex mt-3">
                            <img class="image-thumbnail" src="./assets/images/products/<?= $row["picture"] ?>" alt="">
                            <div class="ps-4">
                                <a href="http://localhost/compart/checkout_detail.php?id=<?= $row["id"] ?>" class="text-decoration-none text-dark fs-5 fw-semibold"><?= cutword($row["name"], 30) ?></a>
                                <p class="pt-4" id="price">$<?= $row["price"] - $row["discount"] / 100 * $row["price"] ?> x <?= $row["quantity"] ?></p>
                                <p id="price">Total <span class="fw-semibold">
                                        $<?= ($row["price"] - $row["discount"] / 100 * $row["price"]) * $row["quantity"] ?>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>status : <?= $message ?></p>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <?php if ($row["status"] == 0) : ?>
                            <a class="btn btn-danger h-fit" href="delete_checkout.php?id=<?= $row['id'] ?>">Delete</a>
                            <a class="btn btn-warning ms-2 h-fit" href="./functions/shipping.php?id=<?= $row['id'] ?>">
                                Ship
                            </a>
                        <?php endif ?>
                        <?php if ($row["status"] == 1) : ?>
                            <a class="btn btn-altprimary h-fit" href="#">
                                Shiping
                            </a>
                        <?php endif ?>
                    </div>
                </div>
                <?php $i++ ?>
            <?php endwhile ?>
            <?php if ($i < 1) : ?>
                <p>Empty</p>
            <?php endif ?>
        </div>
    </div>
    </div>
    <script>
        const allStats = document.getElementById("all");
        const productStatus = document.querySelectorAll(".product-status");
        allStats.addEventListener("click", () => {
            productStatus.forEach(product => {
                product.classList.remove("d-none");
            })
        })
        const buttons = document.querySelectorAll(".btn-status");
        for (button of buttons) {
            button.addEventListener("click", function() {
                productStatus.forEach(product => {
                    let show = product.dataset.status.toLowerCase()
                    if (show === this.id) {
                        product.classList.remove("d-none");
                    } else {
                        product.classList.add("d-none");
                    }
                })
                console.log(this.id);
            })
        }
    </script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>