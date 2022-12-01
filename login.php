<?php
include "./functions/login.php";
$error = false;
$username = "";
if(isset($_POST["role"])){
    if(login($_POST)){
        $error = false;
    }
    $username = $_POST["username"];
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
        <link rel="stylesheet" href="css/custom.min.css" />
    </head>
    <body>
        <?php if($error) : ?>
            <div class="text-white bg-danger vw-100 d-flex position-absolute justify-content-center align-items-center py-2">
                <span class="">
                    We couldn’t find an account matching the username and password you entered. Please check your username and password and try again.
                </span>
            </div>
        <?php endif ?>
        <div class="overflow-hidden container-fluid text-altdark">
            <div class="row min-vw-100 min-vh-100">
                <div class="col-sm-4 d-md-flex flex-column justify-content-center d-none bg-altprimary p-5">
                    <p class="font-fair fs-4">compart</p>
                    <h1 class="fs-2">
                        Discover the world's top Hardware
                    </h1>
                    <img class="image-fluid" src="./assets/svg/oranglaptop.svg" alt="gambar orang">
                </div>
                <div class="col">
                    <form action="" method="post" class="d-flex justify-content-center">
                        <div class="d-flex flex-column justify-content-center vh-100 w-75  px-md-5 px-sm-1">
                            <h1>Sign In</h1>
                            <p>New here ?
                                <a class="text-decoration-none text-altsecondary" href="register.php">Create Account</a>
                            </p>
                            <div class="mt-2 mb-4">
                                <label for="username">
                                    Username 
                                </label>
                                <input class="form-control bg-gray mt-1" type="text" id="username" name="username" value="<?= $username ?>">
                            </div>
                            <div>
                                <label for="password">
                                    Password 
                                </label>
                                <input class="form-control bg-gray mt-1" type="password" id="password" name="password">
                            </div>
                            <div class="input-group mt-4">
                                    <label class="input-group-text" for="inputGroupSelect01">Role</label>
                                    <select class="form-select" id="inputGroupSelect01" name="role">
                                        <option selected value="1">Customer</option>
                                        <option value="2">Seller</option>
                                    </select>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-altprimary text-white px-5 mt-3 fs-sm">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>
