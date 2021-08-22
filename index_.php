<?php 
    include __DIR__ . '/partials/init.php';
    $title = '毛孩星球';
?>

<?php include __DIR__ . '/partials/html-head.php'; ?>
<?php include __DIR__ . '/partials/navbar.php'; ?>
<style>
    #index_banner img {
            width: 100%;
            object-fit: contain;   
        }
</style>
<div id="index_banner">
    <div class="container-fluid p-0 col-12">
        <div class="row">
            <div>
                <img src="imgs/index_pic/index-banner01.jpg" alt="">
            </div>
        </div>
    </div>
</div>


<?php include __DIR__ . '/partials/scripts.php'; ?>
<?php include __DIR__ . '/partials/html-foot.php'; ?>