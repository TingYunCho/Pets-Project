<?php
include __DIR__.'/partials/init.php';
$title = '管理後台';

if(! isset($_SESSION['user']['nickname'])){
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

    $sql = sprintf("SELECT * FROM `pets_blog_articles` %s ORDER BY `sid` DESC LIMIT %s, %s", $where, ($page-1)*$perPage, $perPage);
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
                    <th scope="col" class="text-center">編輯</th>
                    <th scope="col" class="text-center">刪除</th>
                    </tr>
            </thead>
            <tbody>
                <?php foreach($rows as $r): ?>
                <tr data-sid="<?= $r['sid'] ?>">
                    <td><?= $r['sid'] ?></td>    
                    <td><?= $r['article_title'] ?></td>
                    <td><?= $r['category_name'] ?></td>
                    <td><?= $r['sub_category_name'] ?></td>
                    <td><?= $r['publish_date'] ?></td>
                    <td class="text-center">
                        <a href="article-edit.php?sid=<?= $r['sid'] ?>">
                            <i class="fas fa-edit text-primary"></i>
                        </a>    
                    </td>
                    <td class="text-center">
                        <!-- <button type="button" class="btn btn-transparent" data-toggle="modal" data-target="#deleteModal">
                            <i class="fas fa-trash-alt text-danger"></i>
                        </button> -->
                        <a type="button" id="delbtn" data-toggle="modal" data-target="#deleteModal">
                            <i class="fas fa-trash-alt text-danger"></i>
                        </a>
                    </td>
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

<!-- Vertically centered modal -->
<!-- <div class="modal-dialog modal-dialog-centered" tabindex="-1"> -->
<div class="modal fade modal-dialog-centered" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">注意：資料將被刪除！</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary modal-del-btn">確定刪除</button>
      </div>
    </div>
  </div>
</div>

<script>
    const myTable = document.querySelector('table');
    const modal = $('#exampleModal');
    
    myTable.addEventListener('click', function(event){
        if(event.target.classList.contains('#delbtn')) {
            const tr = event.target.closest('tr');
            const sid = tr.getAttribute('data-sid'); 
            console.log(sid);

            if(confirm(`是否要刪除編號為 ${sid} 的資料？`)){
                fetch('article-delete-api.php?sid=' + sid)
                    .then(r=>r.json())
                    .then(obj=>{
                        if(obj.success){
                            tr.remove();
                        } else {
                            alert(obj.error);
                        }
                    });
            }
        }
    });

    let willDeleteId = 0;
    $('#delbtn').on('click', function(event){
        willDeleteId = event.target.closest('tr').dataset.sid;
        console.log(willDeleteId);
        modal.find('.modal-body').html(`確定要刪除編號為 ${willDeleteId} 的資料嗎？`);
    });

    modal.find('#delbtn').on('click', function(event) {
        console.log(`article-delete.php?sid=${willDeleteId}`);
        location.href = `article-delete.php?sid=${willDeleteId}`;
    }); 
</script>

<?php include __DIR__.'/partials/scripts.php'; ?>
<?php include __DIR__.'/partials/html-foot.php'; ?>