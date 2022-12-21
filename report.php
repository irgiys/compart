<?php
include("./functions/session.php");
include("./functions/koneksi.php");
include("./functions/cutword.php");
seller();
$fullname = $_SESSION["fullname"];
$seller_id = $_SESSION["id"];

$query = "SELECT p.id, p.name, p.desc, p.merk, p.picture, p.price, p.discount,p.created_at, p.modified_at ,p.deleted_at, p.category, pi.quantity,pi.sold, pi.id AS inventory_id
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
    <!-- DataTables -->
    <link rel="stylesheet" href="lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="lte/dist/css/adminlte.min.css"> -->
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
                <a class="nav-link" aria-current="page" href="dashboard.php">Overview</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="report.php">Report</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="archive.php">Archive</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="order.php">Order</a>
            </li>
        </ul>
        <div class="row mt-4 justify-content-around">
            <div class="card">
                <div class="card-header bg-white pt-3">
                    <h4>Data Product</h4>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped fs-mb">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Stock</th>
                                <th>Sold</th>
                                <th>Merk</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $key => $product) : ?>
                                <tr>
                                    <th><?= $product["id"] ?></th>
                                    <td><?= $product["name"] ?></td>
                                    <td>$<?= $product["price"] ?></td>
                                    <td><?= $product["discount"] ?>%</td>
                                    <td><?= $product["quantity"] ?></td>
                                    <td><?= $product["sold"] ?></td>
                                    <td><?= $product["merk"] ?></td>
                                    <td><?= cutword($product["created_at"], 10, "") ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Stock</th>
                                <th>Sold</th>
                                <th>Merk</th>
                                <th>Created</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <!-- <footer class="bg-gray mt-5 p-5 text-center">
        Made with ☕ by Kelompok 4 🤝 
    </footer> -->

    <!-- jQuery -->
    <script src="lte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="lte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="lte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="lte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="lte/plugins/jszip/jszip.min.js"></script>
    <script src="lte/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="lte/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="lte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="lte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="lte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="lte/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="lte/dist/js/demo.js"></script> -->
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>