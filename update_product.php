<?php
include("./functions/koneksi.php");
include("./functions/session.php");
include("./functions/product.php");
seller();
$id = $_GET['id'];
$query = "SELECT * FROM product WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);
if ($product === null) {
    header("location:dashboard.php");
    exit;
}
$idInventory = $product["inventory_id"];
$queryInventory = "SELECT * FROM product_inventory WHERE id = '$idInventory'";
$sql = mysqli_query($conn, $queryInventory);
$quantity = $resultInventory = mysqli_fetch_assoc($sql)["quantity"];
$fullname = $_SESSION["fullname"];
$name = $product["name"];
$desc = $product["desc"];
$category = $product["category"];
$merk = $product["merk"];
$price = $product["price"];
$discount = $product["discount"];
$picture = $product["picture"];
if (isset($_POST["name"])) {
    global $id, $idInventory;
    if (updateProduct($_POST, $id, $idInventory) > 0) {
        echo "<script>
            alert('Product succesfully updated !')
            document.location.href = 'dashboard.php'
            </script>";
    } else {
        $name = $_POST["name"];
        $desc = $_POST["desc"];
        $category = $_POST["category"];
        $merk = $_POST["merk"];
        $price = $_POST["price"];
        $discount = $_POST["discount"];
        $quantity = $_POST["quantity"];
    }
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
    <div class="container-fluid px-md-5 mt-5">
        <h2>
            Update a product
        </h2>
        <div class="d-flex justify-content-center">
            <form action="" method="POST" enctype="multipart/form-data" class="w-100">
                <input type="hidden" name="oldPicture" value="<?= $product["picture"] ?>">
                <div class="mt-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Your awesome product name" name="name" value="<?= $name ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Something about your product..." name="desc"><?= $desc ?></textarea>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Category</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Mouse" name="category" value="<?= $category ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Merk</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Intel" name="merk" value="<?= $merk ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Price</label>
                            <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="10.12$" name="price" step=".01" value="<?= $price ?>">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Discount</label>
                            <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="2%" name="discount" value="<?= $discount ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="10" name="quantity" value="<?= $quantity ?>">
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <img class="col-2" src="./assets/images/products/<?= $picture ?>" alt="<?= $name ?>">
                                <div class="col">
                                    <label for="formFile" class="form-label">Picture</label>
                                    <input class="form-control" type="file" id="formFile" name="picture">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 ">
                    <a href="dashboard.php" class="btn btn-altsecondary text-white px-3 fs-sm">
                        < </a>
                            <button type="submit" class="btn btn-altprimary px-5 text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>