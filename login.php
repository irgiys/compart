<?php 
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
        <div class="overflow-hidden container-fluid text-altdark">
            <div class="row min-vw-100 min-vh-100">
                <div class="col-sm-4 d-md-flex flex-column justify-content-center d-none bg-altprimary p-md-5">
                    <p class="font-fair fs-5">compart</p>
                    <h1 class="fs-4">
                        Discover the world's top Hardware
                    </h1>
                    <img class="image-fluid" src="./assets/svg/oranglaptop.svg" alt="gambar orang">
                </div>
                <div class="col">
                    <form action="" method="post" class="d-flex justify-content-center">
                        <div class="d-flex flex-column justify-content-center vh-100 w-75 px-5">
                            <h1>Sign In</h1>
                            <p>New here ?
                                <a href="register.php">Create Account</a>
                            </p>
                            <div class="mt-2 mb-4">
                                <label for="username">
                                    Username 
                                </label>
                                <input class="form-control bg-gray mt-1" type="text" id="username" name="username">
                            </div>
                            <div>
                                <label for="password">
                                    Password 
                                </label>
                                <input class="form-control bg-gray mt-1" type="password" id="password" name="password">
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
