<?php
include("./functions/session.php");
include("./functions/koneksi.php");
include("./functions/cutword.php");
user();
$fullname = $_SESSION["fullname"];
$id = $_SESSION["id"];

$cartQuery = "SELECT c.*, p.id, p.deleted_at
             FROM cart_item AS c
             JOIN product AS p ON (c.product_id = p.id)
             WHERE user_id = '$id' AND p.deleted_at IS NULL";
$cartData = mysqli_query($conn,$cartQuery);
$inCart = 0;
while($data = mysqli_fetch_column($cartData)){
    $inCart++;
}
$query = "SELECT p.*, s.fullname 
        FROM product AS p 
        JOIN seller AS s ON (p.seller_id = s.id) 
        WHERE deleted_at IS NULL ORDER BY p.discount DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Compart. Spend more smile less</title>
        <link rel="stylesheet" href="css/custom.min.css" />
    </head>
    <body>
    <nav class="navbar navbar-expand-sm bg-white fixed-top ">
    <div class="container-fluid px-md-5 py-2">
            <a class="navbar-brand fs-5 m-0 fw-semibold font-fair" href="index.php"> compart</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav px-4 sm:align-items-center align-items-end">
                <form action="search.php" method="post">
                    <div class="input-group">
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
                    <li class="nav-item dropdown px-md-5 py-2 py-md-0">
                        <a class="nav-link dropdown-toggle after-none" href="#" role="button" data-bs-toggle="dropdown"  aria-expanded="false">
                            <?= $fullname ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item d-flex justify-content-around" href="profile_seller.php"> 
                                <span>Profile</span><img src="./assets/svg/chevron-right.svg" alt="right">
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex justify-content-around" href="./functions/logout.php">
                                <span>Logout</span>
                                <img src="./assets/svg/chevron-right.svg" alt="right"></a>
                            </li>
                        </ul>
                    </li>
                    <a class="nav-link" href="cart.php">
                        <div class="position-relative p-1">
                            <img src="./assets/svg/shopping-cart.svg" alt="cart">
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <?= $inCart ?>
                                <span class="visually-hidden">unread messages</span>
                                </span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid px-md-5 mt-large">
        <!-- carousel -->
        <div>
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="./assets/images/photo-1.webp" class="d-block rounded w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                    <img src="./assets/images/photo-2.webp" class="d-block rounded w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                    <img src="./assets/images/photo-3.webp" class="d-block rounded w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>      
        </div>
        <!-- end carousel -->
        <div class="mt-5 mb-4">
            <h3>Choose by Category</h3>
        </div>
        <div class="d-flex justify-content-center">
            <?php
            $categories = [];
            while ($product = mysqli_fetch_assoc($result)):
            $categoryName = preg_replace('/\s+/', '_', $product["category"]);
            array_push($categories,strtolower($categoryName));
            $categories = array_unique($categories);
            ?>
            <?php endwhile ?>
            <div>
                <input type="radio" class="btn-check" name="options-outlined" id="all"  autocomplete="off" checked>
                <label class="btn btn-outline-altdark mt-2" for="all">all</label>
                <?php foreach ($categories as $i => $category) :
                ?>
                <input type="radio" class="btn-check btn-category"  name="options-outlined" id="<?= $category ?>"  autocomplete="off">
                <label class="btn btn-outline-altdark mt-2" for="<?= $category ?>"><?= $category ?></label>
                <?php endforeach ?>
            </div>
        </div>
        <div class="my-3 row justify-content-center ">
            <?php foreach ($result as $i => $product) :?>
                <?php $categoryName = preg_replace('/\s+/', '_', $product["category"]); ?>
                    <a class="card col-sm-4 m-2 px-2 text-dark text-decoration-none product-category" data-category="<?= $categoryName ?>" style="width: 12em;" href="detail_product.php?id=<?= $product["id"] ?>">
                        <img src="./assets/images/products/<?= $product["picture"] ?>" class="image-card" >
                        <div class="d-flex flex-column justify-content-between flex-auto flex-auto pb-3">
                            <h6 class="card-title mt-2 fs-mb"><?= cutword($product["name"],20) ?></h6>
                            <div>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column">
                                        <span class="fw-semibold">$<?= $product["price"] - ($product["discount"] / 100 * $product["price"])  ?></span>
                                        <?php if($product["discount"] > 0) :?>
                                            <div class="fs-mb pt-2">
                                                <span class="p-1 bg-danger rounded text-white"><?=$product["discount"]?>%</span>
                                                <span class="ps-2 text-decoration-line-through">$<?= $product["price"] ?></span>
                                            </div>
                                            <?php endif ?>
                                        </div>
                                        <div class="align-self-end">
                                            <h6 class="fs-sm m-0">
                                                <img src="./assets/svg/user.svg" alt="user" width="10" height="10">
                                                <?= $product["fullname"] ?>
                                            </h6>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </a>
            <?php endforeach ?>
            </div>
        </div>
    </div>
    <script>
        const allCat = document.getElementById("all");
        const productCategory = document.querySelectorAll(".product-category");
        allCat.addEventListener("click", () => {
            productCategory.forEach(product => {
                    product.classList.remove("d-none");  
            })
        })
        const buttons = document.querySelectorAll(".btn-category");
        for(button of buttons){
            button.addEventListener("click", function(){
                productCategory.forEach(product => {
                let show = product.dataset.category.toLowerCase()
                if(show === this.id){
                    product.classList.remove("d-none");
                }else{
                    product.classList.add("d-none");
                }
            })   
                console.log(this.id);
            })
        }
    </script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
