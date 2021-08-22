<?php
include __DIR__ . '/partials/init.php';
$title = '登入';

// 固定每一頁最多幾筆
$perPage = 3;

// query string parameters
$qs = [];

// 關鍵字查詢
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// 用戶決定查看第幾頁，預設值為 1
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$where = ' WHERE 1 ';
if (!empty($keyword)) {
    // $where .= " AND `name` LIKE '%{$keyword}%' "; // sql injection 漏洞
    $where .= sprintf(" AND `name` LIKE %s ", $pdo->quote('%' . $keyword . '%'));

    $qs['keyword'] = $keyword;
}


// 總共有幾筆
$totalRows = $pdo->query("SELECT count(1) FROM adopted $where ")
    ->fetch(PDO::FETCH_NUM)[0];
// 總共有幾頁, 才能生出分頁按鈕
$totalPages = ceil($totalRows / $perPage); // 正數是無條件進位

$rows = [];
// 要有資料才能讀取該頁的資料
if ($totalRows != 0) {


    // 讓 $page 的值在安全的範圍
    if ($page < 1) {
        header('Location: ?page=1');
        exit;
    }
    if ($page > $totalPages) {
        header('Location: ?page=' . $totalPages);
        exit;
    }

    $sql = sprintf(
        "SELECT * FROM adopted %s ORDER BY sid DESC LIMIT %s, %s",
        $where,
        ($page - 1) * $perPage,
        $perPage
    );

    $rows = $pdo->query($sql)->fetchAll();
}
?>
<?php include __DIR__ . '/partials/html-head.php'; ?>
<?php include __DIR__ . '/partials/navbar.php'; ?>
<style>
    .content {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card-deck {
        margin: 3rem 0;
        width: 25%;
        height: 600px;


    }

    .card-text {
        color: #656765;
        
    }
   
</style>
<div class="container">
    <div class="row w-100 d-flex justify-content-end">
        <?php if(isset($_SESSION['user'])): ?>
        <div class="create-btn">
        <button type="button" class="btn btn-primary" onclick="location.href='adopted-pet-data-insert.php'">新增寵物認養資料</button>
        </div>
        <?php else: ?>  
        <?php endif; ?>
    </div>
    <div class="row  w-100 mt-4 mb-2">
        <div class="col">
            <form action="data-list.php" class="form-inline my-2 my-lg-0 d-flex justify-content-end">
                <input class="form-control mr-sm-2" type="search" name="keyword" placeholder="Search" value="<?= htmlentities($keyword) ?>" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
    <div class="row w-100">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination d-flex justify-content-end">

                    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?<?php $qs['page'] = $page - 1;
                                                    echo http_build_query($qs); ?>">
                            <i class="fas fa-arrow-circle-left"></i>
                        </a>
                    </li>

                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                        if ($i >= 1 and $i <= $totalPages) :
                            $qs['page'] = $i;
                    ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link" href="?<?= http_build_query($qs) ?>"><?= $i ?></a>
                            </li>
                    <?php endif;
                    endfor; ?>

                    <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?<?php $qs['page'] = $page + 1;
                                                    echo http_build_query($qs); ?>">
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>
   
    <div class="row w-100">
        <div class="content">
            <div class="card-deck col-lg-12 col-12">
                <?php foreach ($rows as $r) : ?>
                    <div class="card p-2" data-sid="<?= $r['sid'] ?>" style="border-radius: 10px;">

                        <img src="adopted-imgs/<?= $r['avatar'] ?>" class="card-img-top" alt="..." style="width: 100%; height:300px;object-fit:cover">

                        <div class="card-body">
                            <h3 class="card-title" style="font-weight: 500;"><?= $r['name'] ?></h3>
                            <p class="card-text">科別：<?= ($r['family']) ?></p>
                            <p class="card-text">性別：<?= ($r['gender']) ?></p>
                            <p class="card-text">品種：<?= ($r['breed']) ?></p>
                            <p class="card-text" style="letter-spacing: 0.3rem;color:gray;font-size:0.9rem;font-weight: 200">描述：<?= ($r['intro']) ?></p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">刊登日期：<?= $r['created_at'] ?></small>
                            <div class="func-btn d-flex justify-content-between">
                                <div class="follow">
                                    <div class="like-btn p-2">
                                        <a href="" style="color: red;text-decoration:none">
                                        <i class="fas fa-heart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="func d-flex">
                                <div class="del p-2">
                                    <a href="adopted-data-del.php?sid=<?= $r['sid'] ?>" style="color: gray;text-decoration:none"
                                    onclick="return confirm('確定要刪除編號 <?= $r['sid']?>的資料嗎？')">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </div>
                                <div class="edit p-2">
                                    <a href="adopted-data-edit.php?sid=<?= $r['sid'] ?>" style="color: gray; text-decoration:none">
                                        <i class="far fa-edit"></i>
                                    </a>
                                </div>
                            </div>

                            </div>
                            
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</div>



<?php include __DIR__ . '/partials/scripts.php'; ?>



<?php include __DIR__ . '/partials/html-foot.php'; ?>