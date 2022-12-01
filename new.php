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
            <a class="navbar-brand fs-5" href="dashboard.php">your name</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="#">Profile</a>
                <a class="nav-link" href="#">FAQ</a>
                <a class="nav-link" href="#">About</a>
                <a class="nav-link" href="#">Help</a>
                <a class="nav-link" href="#">Logout</a>
               </div>
        </div>
    </div>
    </nav>
    <div class="container-fluid">
        <div class="mt-5">
            <h1>
                Let's sell a new product
            </h1>
            <p>To sell a new product, make sure your address is filled in. on the 
                <a href="profile.php">
                    profile
                </a>
                settings.</p>
            </div>
            
        <form action="" method="post">
            <div class="mt-5 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                <input type="email" class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Category</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Merk</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Price</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="$">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Discount</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="%">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="1">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Picture</label>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                    </div>
                </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-altprimary">Sell</button>   
            </div>

        </form>
     </div>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>