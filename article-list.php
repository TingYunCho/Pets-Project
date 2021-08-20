<?php
include __DIR__.'/partials/init.php';
$title = '管理後台';

if(! isset($_SESSION)){
    header('location: index_.php');
    exit;
}

$keyword = isset($_GET['keyword']) ? ($_GET['keyword']) : '';
$qs = [];
$where = 'WHERE 1';
if(! empty($keyword)){
    $where .= sprintf(" AND `article_title` LIKE %s", $pdo->quote('%'. $keyword .'%'));
    $qs['keyword'] = $keyword;
}

$perPage = 6;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$totalRows = $pdo->query("SELECT count(1) FROM `pets_blog_articles` $where")->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows/$perPage);

$rows = [];

if($totalRows!=0){

    if($page<1) {
        header('location: ?page=1');
        exit;
    }
    if($page>$totalPages) {
        header('location: ?page='. $totalPages);
        exit;
    }

    $sql = sprintf("SELECT * FROM `pets_blog_articles` %s ORDER BY `article_sid` DESC LIMIT %s, %s", $where, ($page-1)*$perPage, $perPage);
    $rows = $pdo->query($sql)->fetchAll();
}

?>

<?php include __DIR__.'/partials/html-head.php'; ?>
<?php include __DIR__.'/partials/navbar.php'; ?>

<div class="container">
    <div class="row">
        <div class="col my-4 d-flex">
            <h2>鏟屎官大補帖</h2>
            <div class="col d-flex justify-content-end">
                <form action="article-list.php" class="form-inline">
                    <input class="form-control mr-sm-2" type="search" name="keyword" placeholder="搜尋文章標題" 
                    value="<?= htmlentities($keyword)?>"aria-label="Search">
                    <button class="btn btn-outline-success mr-sm-2" type="submit"><i class="fas fa-search"></i></button>
                    <a href="article-insert.php" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="rows">
        <table class="table">
            <thead class="thead-dark">
                    <tr>
                    <th scope="col"></th>
                    <th scope="col">文章標題</th>
                    <th scope="col">分類名稱</th>
                    <th scope="col">次分類名</th>
                    <th scope="col">發佈日期</th>
                    <th scope="col">編輯</th>
                    <th scope="col">刪除</th>
                    </tr>
            </thead>
            <tbody>
                <?php foreach($rows as $r): ?>
                <tr data-sid="<?= $r['sid'] ?>">
                    <td><?= $r['article_sid'] ?></td>    
                    <td><?= $r['article_title'] ?></td>
                    <td><?= $r['category_name'] ?></td>
                    <td><?= $r['sub_category_name'] ?></td>
                    <td><?= $r['publish_date'] ?></td>
                    <td>
                        <a href="article-edit.php">
                            <i class="fas fa-edit text-primary"></i>
                        </a>    
                    </td>
                    <td><i class="fas fa-trash-alt text-danger"></i></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination d-flex justify-content-center">
                <li class="page-item <?= $page<=1 ? 'disabled':'' ?>">
                    <a class="page-link" href="?page=<?= $page-1; echo http_build_query($qs); ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for($i=$page-1; $i<=$page+1; $i++):
                        if($i>=1 and $i<=$totalPages):
                        $qs['page']=$i; ?>
                <li class="page-item <?= $i==$page ? 'active':'' ?>">
                    <a class="page-link" href="?<?= http_build_query($qs) ?>"><?= $i ?></a>
                </li>
                <?php endif; endfor; ?>
                    
                <li class="page-item <?= $page>=$totalPages ? 'disabled':'' ?>">
                <a class="page-link" href="?page=<?= $page+1; echo http_build_query($qs); ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<?php include __DIR__.'/partials/scripts.php'; ?>
<?php include __DIR__.'/partials/html-foot.php'; ?>