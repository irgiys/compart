<?php
include "koneksi.php";
function addProduct($data)
{
    global $conn;
    $name = htmlspecialchars($data["name"]);
    $desc = htmlspecialchars($data["desc"]);
    $category = htmlspecialchars($data["category"]);
    $merk = htmlspecialchars($data["merk"]);
    $seller_id = $data["seller_id"];
    $price = htmlspecialchars($data["price"]);
    $quantity = htmlspecialchars($data["quantity"]);
    $discount = htmlspecialchars($data["discount"]);
    $created_at = date("Y-m-d H:i:s");
    $picture = upload();
    if (!$picture) {
        return false;
    }

    $inventory_query = "INSERT INTO product_inventory (`id`, `quantity`, `created_at`, `modified_at`, `deleted_at`)
        VALUES (NULL, '$quantity', '$created_at', '$created_at', NULL)
    ";

    if ($conn->query($inventory_query) === TRUE) {
        $inventory_id = $conn->insert_id;
    } else {
        echo "Error: " . $inventory_query . "<br>" . $conn->error;
    }

    $query = "INSERT INTO `product` (`id`, `name`, `desc`, `category`, `merk`, `picture`, `price`, `discount`, `created_at`, `modified_at`, `deleted_at`, `inventory_id`, `seller_id`) VALUES (NULL, '$name', '$desc', '$category', '$merk', '$picture', '$price', '$discount', '$created_at', NULL, NULL, '$inventory_id', '$seller_id')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
};
function upload()
{
    $nameFile = $_FILES["picture"]["name"];
    $sizeFile = $_FILES["picture"]["size"];
    $error = $_FILES["picture"]["error"];
    $tmpName = $_FILES["picture"]["tmp_name"];

    // cek apakkah tidakad gambar yang diupload
    if ($error == 4) {
        echo "<script>
                    alert(`Pilih gambar yang mau diupload`)
                    </script>";
        return false;
    }
    // cek apakah yang diupload adalah gambar
    $validExtensions = ['jpg', 'jpeg', 'png', 'webp'];
    $pictureExtension = explode(".", $nameFile);
    $pictureExtension = strtolower(end($pictureExtension));

    if (!in_array($pictureExtension, $validExtensions)) {
        echo "<script>
                    alert(`Yang di upload bukan gambar`)
            </script>";
        return false;
    }
    // cek jika gambar ukurannya terlalu besar
    if ($sizeFile > 1000000) {
        echo "<script>
                    alert(`Ukuran gambar besaarr`)
            </script>";
        return false;
    }
    $newNameFile = uniqid();
    $newNameFile .= ".";
    $newNameFile .= $pictureExtension;
    // lolos gambar siap diupload
    move_uploaded_file($tmpName, "assets/images/products/" . $newNameFile);
    return $newNameFile;
}
function updateProduct($data, $id, $idInventory)
{
    global $conn;
    $name = $data["name"];
    $desc = $data["desc"];
    $category = $data["category"];
    $merk = $data["merk"];
    $price = $data["price"];
    $quantity = $data["quantity"];
    $discount = $data["discount"];
    $oldPicture = $data["oldPicture"];
    $modified_at = date("Y-m-d H:i:s");
    if ($_FILES["picture"]["error"] == 4) {
        $picture = $oldPicture;
    } else {
        $picture = upload();
    }

    $query = "UPDATE `product` SET `name` = '$name', `desc` = '$desc', `category` = '$category',`merk` = '$merk', `picture` = '$picture', `price` = '$price', `discount` = '$discount', `modified_at` = '$modified_at' WHERE `product`.`id` = $id";

    $inventory_query = "UPDATE `product_inventory` SET `quantity` = '$quantity', `modified_at` = '$modified_at' WHERE `product_inventory`.`id` = $idInventory
    ";

    mysqli_query($conn, $inventory_query);
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
