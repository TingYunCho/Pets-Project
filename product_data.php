<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <title>product_data</title>
</head>

<body>
    <?php include __DIR__.'/partials/html-head.php'; ?>
    <?php include __DIR__.'/partials/navbar.php'; ?>
    <?php require_once 'process.php'; ?>

    <?php

    if (isset($_SESSION['message'])) : ?>

        <div class="alert alert-<?= $_SESSION['msg_type'] ?>">

            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);

            ?>

        </div>
    <?php endif ?>
    <div class="container">
        <?php
        $mysqli = new mysqli('localhost', 'root', '', 'pets_project') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM product_data") or die($mysqli->error);
        // pre_r($result);
        ?>

        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>brand</th>
                        <th>name</th>
                        <th>category</th>
                        <th>price</th>
                        <th>on_sale</th>
                        <th>intro</th>
                        <th colspan="6">Action</th>
                    </tr>
                </thead>

                <?php
                while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['brand']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['category']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['on_sale']; ?></td>
                        <td><?php echo $row['intro']; ?></td>
                        <td>
                            <a href="product_data.php?edit=<?php echo $row['sid']; ?>" class="btn btn-info">Edit</a>
                            <a href="process.php?delete=<?php echo $row['sid']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <?php
        // pre_r($result->fetch_assoc());

        function pre_r($array)
        {
            echo '<pre>';
            print_r($array);
            echo '<pre>';
        }

        ?>

        <div class="row justify-content-center">
            <form action="process.php" method="POST">
                <input type="hidden" name="sid" value="<?php echo $sid; ?>">

                <div class="form-group">
                    <label>brand</label>
                    <input type="text" name="brand" class="form-control" value="<?php echo $brand; ?>" placeholder="Enter product brand">
                </div>

                <div class="form-group">
                    <label>name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter product name">
                </div>

                <div class="form-group">
                    <label>category</label>
                    <input type="text" name="category" class="form-control" value="<?php echo $category; ?>" placeholder="Enter product category">
                </div>

                <div class="form-group">
                    <label>price</label>
                    <input type="number" name="price" class="form-control" value="<?php echo $price; ?>" placeholder="Enter product price">
                </div>

                <div class="form-group">
                    <label>on sale</label>
                    <input type="text" name="on_sale" class="form-control" value="<?php echo $on_sale; ?>" placeholder="Set on sale(Y/N)">
                </div>

                <div class="form-group">
                    <label>intro</label>
                    <input type="text" name="intro" class="form-control" value="<?php echo $intro; ?>" placeholder="Enter product intro">
                </div>

                <div class="form-group">
                    <?php
                    if ($update == true) :
                    ?>
                        <button type="submit" class="btn btn-info" name="update">Update</button>
                    <?php else : ?>
                        <button type="submit" class="btn btn-primary" name="save">Save</button>
                    <?php endif; ?>
                </div>

            </form>
        </div>
    </div>
</body>

</html>
