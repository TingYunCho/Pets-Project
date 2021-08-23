    <?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'pets_project') or die(mysqli_error($mysqli));

$sid = 0;
$update = false;
$brand = '';
$name = '';
$category = '';
$price = '';
$on_sale = '';
$intro = '';

if (isset($_POST['save'])) {
    $brand = $_POST['brand'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $on_sale = $_POST['on_sale'];
    $intro = $_POST['intro'];


    $mysqli->query("INSERT INTO product_data (brand, name, category, price, on_sale, intro) VALUES
    ('$brand', '$name', '$category', '$price', '$on_sale', '$intro')") or
        die($mysqli->error);

    $_SESSION['message'] = "Product has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: product_data.php");
}

if (isset($_GET['delete'])) {
    $sid = $_GET['delete'];
    $mysqli->query("DELETE FROM product_data WHERE sid=$sid") or die($mysqli->error());

    $_SESSION['message'] = "Product has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: product_data.php");
}

if (isset($_GET['edit'])) {
    $sid = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM product_data WHERE sid=$sid") or die($mysqli->error());

    if (is_iterable($result) == 1) {
        $row = $result->fetch_array();
        $brand = $row['brand'];
        $name = $row['name'];
        $category = $row['category'];
        $price = $row['price'];
        $on_sale = $row['on_sale'];
        $intro = $row['intro'];
    }
}

if (isset($_POST['update'])) {
    $sid = $_POST['sid'];
    $brand = $_POST['brand'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $on_sale = $_POST['on_sale'];
    $intro = $_POST['intro'];

    $mysqli->query("UPDATE product_data SET 
    brand='$brand', name='$name', 
    category='$category', price='$price', 
    on_sale='$on_sale', intro='$intro' WHERE sid=$sid")
        or die($mysqli->error);

    $_SESSION['message'] = "Product has been updated!";
    $_SESSION['msg_type'] = "warning";

    header('location: product_data.php');
}
