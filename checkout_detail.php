<?php
include("./functions/koneksi.php");
include("./functions/session.php");
include("./functions/cutword.php");

$id = $_SESSION["id"];
$fullname = $_SESSION["fullname"];
$idCheckout = $_GET["id"];
$queryCart = "SELECT c.*,
            p.price, p.seller_id, p.picture, p.desc, p.discount,  p.name AS product_name, 
            s.fullname AS s_fullname, s.email AS s_email, 
            u.email AS u_email, u.fullname AS u_fullname, ua.address_line AS ua_address_line, ua.city AS ua_city, ua.postal_code AS ua_postal_code ,
            sa.address_line AS sa_address_line, sa.city AS sa_city, sa.postal_code AS sa_postal_code
            FROM checkout_session AS c
            JOIN product AS p 
                ON (c.product_id = p.id)
            JOIN seller AS s 
                ON (p.seller_id = s.id)
            JOIN seller_address AS sa
                ON (s.id = sa.seller_id)
            JOIN user AS u 
                ON (c.user_id = u.id)
            JOIN user_address AS ua 
                ON (u.id = ua.id)
            WHERE c.id = '$idCheckout'";
$resultCart = mysqli_query($conn, $queryCart);
$result = mysqli_fetch_assoc($resultCart);
// var_dump($result);
if ($result === NULL) {
    header("location:cart.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Compart</title>
    <link rel="stylesheet" href="css/custom.min.css" />
</head>

<body>
</body>
<div class="overflow-hidden container-fluid text-altdark">
    <div class="row min-vw-100 min-vh-100">
        <div class="col-sm-4 d-lg-flex flex-column justify-content-center d-none bg-gray p-5">
            <h4><?= $result["product_name"] ?></h4>
            <span class="fw-light mb-3"><?= $result["price"] ?>$</span>
            <img class="image-fluid image-checkout" src="./assets/images/products/<?= $result["picture"] ?>" alt="gambar orang">
            <p class="mt-3"><?= cutword($result["desc"], 90) ?></p>
            <div class="border-bottom">
                <div class="d-flex">
                    <img src="./assets/svg/map-pin.svg" alt="map" width="24" height="24">
                    <p class="ps-2">
                        Address
                    </p>
                </div>
                <p class="mb-1">
                    <?= $result["s_fullname"] . " | " . $result["s_email"] ?>
                </p>
                <p class="mb-1"><?= $result["sa_address_line"] ?></p>
                <p class="mb-1"><?= $result["sa_city"] ?></p>
                <p class="mb-3"><?= $result["sa_postal_code"] ?></p>
            </div>
        </div>
        <div class="col">
            <form action="./functions/checkout.php" method="post" class="d-flex justify-content-center">
                <div class="d-flex flex-column justify-content-center vh-100 w-75 px-md-5">
                    <h2>Payment Details</h2>
                    <div class="border-bottom">
                        <div class="d-flex mt-2">
                            <img src="./assets/svg/map-pin.svg" alt="map" width="24" height="24">
                            <p class="ps-2 mb-1">
                                Destination Address
                            </p>
                        </div>
                        <p class="mb-1">
                            <?= $result["u_fullname"] . " | " . $result["u_email"] ?>
                        </p>
                        <p class="mb-1"><?= $result["ua_address_line"] ?></p>
                        <p class="mb-1"><?= $result["ua_city"] ?></p>
                        <p class="mb-3"><?= $result["ua_postal_code"] ?></p>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <p>Subtotal</p>
                        <p>$<?= $result["price"] . " x " . $result["quantity"] ?></p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p>Discount</p>
                        <p><?= $result["discount"] ?>%</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h4>Total</h4>
                        <h4>$<?= $result["total"] ?></h4>
                    </div>
                    <div>
                        <a href="order.php" class="btn btn-altsecondary text-white px-3 mt-3 fs-sm">
                            < </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</html>