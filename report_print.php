<?php
include("./functions/session.php");
include("./functions/koneksi.php");
include("./functions/cutword.php");
seller();
$fullname = $_SESSION["fullname"];
$seller_id = $_SESSION["id"];

$query = "SELECT p.id, p.name, p.desc,p.created_at, p.merk,p.category, p.picture, p.price, p.discount, p.modified_at ,p.deleted_at, pi.quantity,pi.sold, pi.id AS inventory_id
            FROM product AS p
            JOIN product_inventory AS pi ON (p.inventory_id = pi.id) WHERE p.deleted_at IS NULL AND p.seller_id = '$seller_id' ORDER BY p.modified_at DESC";
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
    <title>Report Seller</title>
    <link rel="stylesheet" href="css/custom.min.css" />
</head>

<body>
    <div class="container-fluid px-md-5">
        <div class="row mt-4 justify-content-around">
            <table class="table table-striped table-bordered fs-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Stock</th>
                        <th>Sold</th>
                        <th>Merk</th>
                        <th>Category</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $key => $product) : ?>
                        <tr>
                            <th><?= $product["id"] ?></th>
                            <td><?= $product["name"] ?></td>
                            <td>$<?= $product["price"] ?></td>
                            <td><?= $product["quantity"] ?></td>
                            <td><?= $product["discount"] ?>%</td>
                            <td><?= $product["sold"] ?></td>
                            <td><?= $product["merk"] ?></td>
                            <td><?= $product["category"] ?></td>
                            <td><?= cutword($product["created_at"], 10, "") ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- <footer class="bg-gray mt-5 p-5 text-center">
        Made with ☕ by Kelompok 4 🤝 
    </footer> -->
    <script type="text/javascript">
        window.print()
    </script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>