<?php
include "./functions/register.php";
$error = false;
if (isset($_POST["role"])) {
    if (register($_POST) > 0) {
        echo "<script>
            alert('Account succesfully created !')
            </script>";
    } else {
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register | Compart</title>
    <link rel="stylesheet" href="css/custom.min.css" />
</head>

<body>
    <?php if ($error) : ?>
        <div class="text-white bg-danger vw-100 d-flex position-absolute justify-content-center align-items-center py-2">
            <span class="">
                Username or email you entered already exist. Please use another one and try again.
            </span>
        </div>
    <?php endif ?>
    <div class="overflow-hidden container-fluid text-altdark">
        <div class="row min-vw-100 min-vh-100">
            <div class="col-sm-4 d-lg-flex flex-column justify-content-center d-none bg-altsecondary p-5">
                <p class="font-fair fs-4">compart</p>
                <h1 class="fs-2">
                    Discover the world's top Hardware
                </h1>
                <img class="image-fluid" src="./assets/svg/orangpaket.svg" alt="gambar orang">
            </div>
            <div class="col">
                <form action="" method="post" class="d-flex justify-content-center">
                    <div class="d-flex flex-column justify-content-center vh-100 w-75 px-md-5">
                        <h1>Sign Up to Compart</h1>
                        <p class="mb-0">Already have Account ?
                            <a class="text-decoration-none text-altprimary" href="login.php">Sign In</a>
                        </p>
                        <div class="my-4 row">
                            <div class="col-md mt-0 mt-sm-2">
                                <label for="fullname">
                                    Fullname
                                </label>
                                <input required class="form-control bg-gray mt-1" type="text" id="fullname" name="fullname">
                            </div>
                            <div class="col-md mt-0 mt-sm-2">
                                <label for="username">
                                    Username
                                </label>
                                <input required class="form-control bg-gray mt-1" type="text" id="username" name="username">
                            </div>
                        </div>
                        <div>
                            <label for="email">
                                Email
                            </label>
                            <input required class="form-control bg-gray mt-1" type="email" id="email" name="email">
                        </div>
                        <div class="my-4">
                            <label for="password">
                                Password
                            </label>
                            <input required class="form-control bg-gray mt-1" type="password" id="password" name="password">
                        </div>
                        <div class="input-group my-3">
                            <label class="input-group-text" for="inputGroupSelect01">Role</label>
                            <select class="form-select" id="inputGroupSelect01" name="role">
                                <option selected value="1">Customer</option>
                                <option value="2">Seller</option>
                                <option value="3">Admin</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-altsecondary text-b px-5 mt-3 fs-sm">Create account</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>