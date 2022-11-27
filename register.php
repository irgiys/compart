<?php
    include "./functions/register.php";
    $error = false;
    if(isset($_POST["username"])){
        if(register($_POST) > 0){
            echo "<script>
            alert('Account succesfully created !')
            </script>";
        }else{
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
        <title>Document</title>
        <link rel="stylesheet" href="css/custom.min.css" />
    </head>
    <body>
        <div class="overflow-hidden container-fluid text-altdark">
            <div class="row min-vw-100 min-vh-100">
                <div class="col-sm-4 d-md-flex flex-column justify-content-center d-none bg-altsecondary p-md-5">
                    <p class="font-fair fs-5">compart</p>
                    <h1 class="fs-4">
                        Discover the world's top Hardware
                    </h1>
                    <img class="image-fluid" src="./assets/svg/orangpaket.svg" alt="gambar orang">
                </div>
                <div class="col">
                    <form action="" method="post" class="d-flex justify-content-center">
                        <div class="d-flex flex-column justify-content-center vh-100 w-75 px-5">
                            <h1>Sign Up to Compart</h1>
                            <p>Already have Account ?
                                <a class="text-decoration-none text-altprimary" href="login.php">Sign In</a>
                            </p>
                            <?php if($error) : ?>
                                        <span class="text-danger d-block">User already exist !</span>
                            <?php endif ?>
                            <div class="my-4 row">
                                <div class="col">
                                    <label for="fullname">
                                        Fullname
                                    </label>
                                    <input required class="form-control bg-gray mt-1" type="text" id="fullname" name="fullname">
                                </div>
                                <div class="col">
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
                                    </select>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-altsecondary text-white px-5 mt-3 fs-sm">Create account</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>
