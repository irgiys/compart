<?php 
include("./functions/session.php");
include("./functions/koneksi.php");
include("./functions/seller.php");
seller();
$fullname = $_SESSION["fullname"];
$id = $_SESSION["id"];
$query = "SELECT * FROM seller WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$seller = mysqli_fetch_assoc($result);

$queryAddress = "SELECT * FROM seller_address WHERE seller_id = '$id'";
$resultAddress = mysqli_query($conn, $queryAddress);
$address = mysqli_fetch_assoc($resultAddress);

if($address === NULL){  
    if(isset($_POST["fullname"])){
        if(addAddress($_POST) > 0){       
            echo "<script>
                alert('Profile successfuly updated !')
            </script>";
        }
    }
} else {
    if (isset($_POST["fullname"])) {
        if (updateAddress($_POST) > 0) {
            echo "<script>
            alert('Profile successfuly updated !')
        </script>";
        }
    }
}
// echo $_POST["fullname"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $fullname ?> | Profile</title>
    <link rel="stylesheet" href="css/custom.min.css" />
</head>
<body>
    <div class="overflow-hidden container-fluid text-altdark">
            <div class="row min-vw-100 min-vh-100">
                <div class="col-sm-4 d-lg-flex flex-column justify-content-center d-none bg-altprimary p-5">
                    <h1 class="text-capitalize"><?= $fullname ?>'s</h1>
                    <h2>Profile</h2>
                    <img class="image-fluid" src="./assets/svg/oranglaptop.svg" alt="gambar orang">
                </div>
                <div class="col">
                    <form action="" method="POST" class="d-flex justify-content-center">
                        <input type="hidden" name="seller_id" value="<?= $id ?>">
                        <div class="d-flex flex-column justify-content-center vh-100 w-75  px-md-5 px-sm-1">
                            <div class="d-lg-none">
                                <h1 class="text-capitalize"><?= $fullname ?>'s</h1>
                                <h2>Profile</h2>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-4 mb-4">
                                    <label for="username">
                                        Username 
                                    </label>
                                    <input class="form-control bg-gray mt-1" type="text" id="username" name="username" value="<?= $seller["username"] ?>" disabled>
                                </div>
                                <div class="col mb-4">
                                    <label for="fullname">
                                        Fullname 
                                    </label>
                                    <input class="form-control bg-gray mt-1" type="text" id="fullname" name="fullname" value="<?= $seller["fullname"] ?>">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="email">
                                    Email 
                                </label>
                                <input class="form-control bg-gray mt-1" type="email" id="email" name="email" value="<?= $seller["email"] ?>">
                            </div>
                            <p>
                                Addresess : 
                            </p>
                            <div class="mb-4">
                                <label for="fullname">
                                    Address Line  
                                </label>
                                <textarea class="form-control bg-gray" id="exampleFormControlTextarea1" rows="3" name="address_line"><?= $address["address_line"] ?></textarea>   
                             </div>
                            <div class="row">
                                <div class="col mb-4">
                                    <label for="city">
                                    City
                                     </label>
                                <input class="form-control bg-gray mt-1" type="text" id="city" name="city" value="<?= $address["city"] ?>">
                            </div>
                            <div class="col-sm-4 mb-4">
                                <label for="postal_code">
                                    Postal Code
                                </label>
                                <input class="form-control bg-gray mt-1" type="text" id="postal_code" name="postal_code" value="<?= $address["postal_code"] ?>">
                            </div>
                        </div>
                            <div>
                                <a href="dashboard.php" class="btn btn-altsecondary text-white px-3 mt-3 fs-sm"><</a>
                                <button type="submit" class="btn btn-altprimary text-white px-5 mt-3 fs-sm">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</body>
</html>