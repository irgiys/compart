<?php
include("./functions/koneksi.php");
include("./functions/session.php");
include("./functions/cutword.php");
include("./functions/product.php");
user();
$id = $_GET['id'];
$userId = $_SESSION["id"];
$cartQuery = "SELECT c.*, p.id, p.deleted_at
             FROM cart_item AS c
             JOIN product AS p ON (c.product_id = p.id)
             WHERE user_id = '$userId' AND p.deleted_at IS NULL";

$cartData = mysqli_query($conn,$cartQuery);
$inCart = 0;
while($data = mysqli_fetch_column($cartData)){
    $inCart++;
}
$query = "SELECT p.*, pi.quantity, pi.sold, s.fullname
          FROM product AS p 
          JOIN product_inventory AS pi 
                ON (p.inventory_id = pi.id)
          JOIN seller AS s
                ON (p.seller_id = s.id) WHERE p.id = '$id'";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);
if ($product === null) {
    header("location:index.php");
    exit;
}

$idInventory = $product["inventory_id"];
$fullname = $_SESSION["fullname"];
$name = $product["name"];
$desc = $product["desc"];
$category = $product["category"];
$merk = $product["merk"];
$price = $product["price"];
$discount = $product["discount"];
$picture = $product["picture"];
$quantity = $product["quantity"];
$sold = $product["sold"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Product</title>
    <link rel="stylesheet" href="css/custom.min.css" />
</head>
<body>
<nav class="navbar navbar-expand-sm bg-white fixed-top ">
    <div class="container-fluid px-md-5 py-2">
            <a class="navbar-brand fs-5 m-0 fw-semibold font-fair" href="index.php">compart</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <form action="search.php" method="post">
                    <div class="input-group me-4 col">
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
                    <a class="nav-link py-0 ps-4" href="cart.php">
                        <div class="position-relative p-1">
                            <img src="./assets/svg/shopping-cart.svg" alt="cart">
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?= $inCart ?>
                                <span class="visually-hidden">In cart</span>
                                </span>
                            </div>
                    </a>
                    <a class="nav-link py-0 pe-4" href="cart.php">
                        <div class="position-relative p-1">
                            <img src="./assets/svg/clipboard-text.svg" alt="cart">
                                <!-- <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?= $inCart ?>
                                <span class="visually-hidden">unread messages</span>
                                </span> -->
                        </div>
                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"  aria-expanded="false">
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
<div class="container-fluid mt-large px-md-5">
        <!-- navigasi -->
        <nav>
            <a class="text-decoration-none" href="index.php">Home </a>
            <p class="d-inline text-capitalize"> > <?= $category ?> > </p>
            <p class="d-inline text-capitalize"><?= cutword($name,30) ?></p>
        </nav>
        <div class="row my-4">
            <div class="col-md-4">
                <div class="border rounded d-flex justify-content-center w-fit overflow-hidden">
                    <img class="image-product hover-zoom" src="./assets/images/products/<?= $picture ?>" alt="">
                </div>
            </div>
            <div class="col-md-5">
                <h4 class="d-inline text-capitalize"> <?= $name ?></h4>
                <!-- $product["price"] - ($product["discount"] / 100 * $product["price"] -->
                <h6 class="pt-2">Sold <?= $sold ?></h6>
                <h3 class="pt-4" id="price">$<?= $price - $discount / 100 * $price ?></h3>
                <?php if($discount > 0) : ?>
                    <span class="p-1 rounded bg-danger fw-semibold text-white"><?= $discount ?>%</span>
                    <p class="d-inline mx-1 text-decoration-line-through">$<?= $price ?></p>
                <?php endif ?>
                <div class="border-top border-bottom my-4 py-2">
                    <h6 class="py-2">Details</h6>
                    <p class="fs-mb my-1">Category : 
                        <span class="text-altprimary fw-semibold"><?= $category ?> </span>
                    </p>
                    <p class="fs-mb">Merk: 
                        <span class="text-altprimary fw-semibold"><?= $merk ?> </span>
                    </p>
                    <p><?= $desc ?></p>
                </div>
                <div class="d-flex align-items-end">    
                    <img src="./assets/svg/user.svg" alt="user" width="20" height="20">
                    <h6 class="px-2 m-0 d-inline">
                        <?= $product["fullname"] ?>
                    </h6>
            </div>
            </div>
                <div class="col">
                    <div class="border rounded p-3">
                        <h5>Set amount</h5>
                        <div class="d-flex align-items-center">
                            <img class="image-thumbnail" src="./assets/images/products/<?= $picture ?>" alt="<?= $name ?>">
                            <p class="fs-mb px-3"><?= cutword($name,20,"") ?></p>
                        </div>
                        <div class="row align-items-center mt-2">
                            <div class="col-md-7">
                                <div class="input-group border rounded">
                                    <button type="button" class="btn btn-outline-danger btn-number border-0" id="minus" data-field="quantity">-</button>
                                    <input type="number" id="quantity" class="form-control input-number border-0 text-center" value="1" min="1" max="<?= $quantity ?>">
                                    <button type="button" class="btn btn-outline-altprimary btn-number border-0" id="plus" data-field="quantity">+</button>
                                </div>
                            </div>
                            <div class="col">
                                <?php if($quantity >= 100) : ?>
                                    <span class="fs-sm">Stock <?= $quantity?></span>
                                <?php else :?>
                                <span class="fs-mb">Stock <?= $quantity?></span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="mt-4 d-flex align-items-center justify-content-between">
                            <h6>Subtotal</h6>
                            <h5 class="fw-semibold" id="subtotal">
                                $
                            </h5>
                        </div>
                        <div class="mt-3 justify-content-center d-flex">
                            <form action="./functions/cart.php" method="post">
                                <input type="hidden" id="post_quantity" name="quantity" value="">
                                <input type="hidden" id="post_amount" name="amount" value="">
                                <input type="hidden" id="post_product_id" name="product_id" value="<?= $id ?>">
                                <input type="hidden" id="post_user_id" name="user_id" value="<?= $_SESSION["id"] ?>">
                                <button type="submit" class="btn btn-altprimary" id="submit_button">+ add to chart</button>
                            </form>        
                        </div>
                    </div>
                </div>
        </div>    
    </div>
    <script>
        const plus = document.getElementById("plus");
        const minus = document.getElementById("minus");
        const quantity = document.getElementById("quantity");
        const subtotal= document.getElementById("subtotal");
        const price = document.getElementById("price");
        const actualPrice = parseFloat(price.innerText.replace("$",""));
        const spanText = document.createElement("span")
        subtotal.appendChild(spanText);
        
        const postQuantity =  document.getElementById("post_quantity");
        const postAmount = document.getElementById("post_amount");
        const submitButton = document.getElementById("submit_button");
        
        function changeThings(){
            spanText.innerText = actualPrice * (parseInt(quantity.value));
            postAmount.value = actualPrice * (parseInt(quantity.value));
            postQuantity.value = quantity.value;
        }
        quantity.addEventListener("input", () => {
            if(quantity.value > 0){
                changeThings();
            }
        })
        plus.addEventListener("click", () => {
            let max = parseInt(quantity.max)
            if(quantity.value < max){
                quantity.value++
                changeThings();
            }
        })
        minus.addEventListener("click", () => {
            if(quantity.value > 1){
                quantity.value--
                changeThings();
             }
        })
    changeThings()
    </script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>