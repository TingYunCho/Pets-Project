<?php include __DIR__. '/partials/init.php'; 

$perPage = 4;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$cate = isset($_GET['cate']) ? intval($_GET['cate']) : 0;
$pageBtnQS = [];

$where = ' WHERE 1 ';
if(! empty($cate)){
    $where .= " AND category_sid=$cate ";
    $pageBtnQS['cate'] = $cate;
}


// 總筆數
$t_sql = "SELECT COUNT(1) FROM products $where ";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows/$perPage); // 總頁數
if($page<1) $page=1;
if($page>$totalPages) $page=$totalPages;

$rows = [];
// 如果有資料
if($totalRows>0){
    $sql = sprintf("SELECT * FROM products $where LIMIT %s, %s", ($page-1)*$perPage, $perPage);
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll();
}

?>

<?php include __DIR__. '/partials/html-head.php'; ?>
<?php include __DIR__. '/partials/navbar.php'; ?>


<div class="container mt-5">
    <!-- 分頁標籤 -->
    <div class="row">
            <div class="col">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item <?= $page==1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?<?php
                            $pageBtnQS['page']=$page-1;
                            echo http_build_query($pageBtnQS)
                            ?>">
                                <i class="fas fa-arrow-circle-left"></i>
                            </a>
                        </li>
                        <?php for($i=1; $i<=$totalPages; $i++):
                            $pageBtnQS['page']=$i;
                            ?>
                            <li class="page-item <?= $i===$page ? 'active' : '' ?>">
                                <a class="page-link" href="?<?= http_build_query($pageBtnQS) ?>">
                                    <?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= $page==$totalPages ? 'disabled' : '' ?>">
                            <a class="page-link" href="?<?php
                            $pageBtnQS['page']=$page+1;
                            echo http_build_query($pageBtnQS)
                            ?>">
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- 分頁標籤 -->
        <!-- 商品區 -->
    <div class="row">
        <?php foreach($rows as $r): ?>
        <div class="col-lg-3">
            <form action="manage_cart.php" method="POST">
                <div class="card">
                    <!-- <img src="./imgs/dog_food.png" class="card-img-top"> -->
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= $r['name'] ?></h5>
                        <p class="card-text">品牌:<?= $r['brand'] ?></p>
                        <p class="card-text">$NT:<?= $r['price'] ?></p>
                        <button type="submit" name="Add_To_Cart" class="btn btn-info">加入購物車</button>
                        <input type="hidden" name="Item_Name" value="<?= $r['name'] ?>">
                        <input type="hidden" name="Price" value="<?= $r['price'] ?>">
                    </div>
                </div>
            </form>
        </div>
        <?php endforeach;?>
    </div>
    <!-- 商品區 -->
</div>








<?php include __DIR__. '/partials/html-foot.php'; ?>