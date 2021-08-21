<?php
    include __DIR__. '/partials/init.php';
    $title = '資料列表';


    if(! isset($_SESSION['user'])){
        //如果沒有登入就轉首頁
        header('Location: login.php');
        exit;
    }
    // 固定每一頁最多幾筆
    $perPage = 5;

    // query string parameters
    $qs = [];

    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

    // 用戶決定查看第幾頁，預設值為 1
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

    $where = ' WHERE 1 ';
    if(! empty($keyword)){
        // $where .= " AND `name` LIKE '%{$keyword}%' "; // sql injection 漏洞
        $where .= sprintf(" AND `name` LIKE %s ", $pdo->quote('%'. $keyword. '%'));
        // .= 和 += 一樣

        $qs['keyword'] = $keyword;
    }


    // 總共有幾筆
    $totalRows = $pdo->query("SELECT count(1) FROM customers $where ")
        ->fetch(PDO::FETCH_NUM)[0];
    // 總共有幾頁, 才能生出分頁按鈕
    $totalPages = ceil($totalRows / $perPage); // 正數是無條件進位

    $rows = [];
    // 要有資料才能讀取該頁的資料
    if($totalRows!=0) {


        // 讓 $page 的值在安全的範圍
        if ($page < 1) {
            header('Location: ?page=1');
            exit;
        }
        if ($page > $totalPages) {
            header('Location: ?page=' . $totalPages);
            exit;
        }

        $sql = sprintf("SELECT * FROM customers %s ORDER BY sid DESC LIMIT %s, %s",
            $where,
            ($page - 1) * $perPage,
                $perPage);

        $rows = $pdo->query($sql)->fetchAll();

    }
?>
<?php include __DIR__. '/partials/html-head.php'; ?>
<?php include __DIR__. '/partials/navbar.php'; ?>
    <style>
        table tbody i.fas.fa-trash-alt {
            color: darkred;
        }
        table tbody i.fas.fa-trash-alt.ajaxDelete {
            color: darkorange;
            cursor: pointer;
            /* 可以點的樣子ˋ */

        }

    </style>
<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination d-flex justify-content-between mt-3">
                    <form action="customers-list.php" class="form-inline my-2 my-lg-0 d-flex">
                        <div class="add-new">
                            <li class="nav-item d-flex">
                                
                                <h3><i class="fas fa-user-plus"></i></h3>
                                <a class="nav-link" href="customer-insert.php">新增</a>
                            </li>
                        </div>
                        <input class="form-control mr-sm-2" type="search" name="keyword" placeholder="Search"
                            value="<?= htmlentities($keyword) ?>"
                            aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>

                    <div class="all-page d-flex">
                        <li class="page-item <?= $page<=1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?<?php
                            $qs['page']=$page-1;
                            echo http_build_query($qs);
                            ?>">
                                <i class="fas fa-arrow-circle-left"></i>
                            </a>
                        </li>
                        <?php for($i=$page-5; $i<=$page+5; $i++):
                            if($i>=1 and $i<=$totalPages):
                                $qs['page'] = $i;
                                ?>
                        <li class="page-item <?= $i==$page ? 'active' : '' ?>">
                            <a class="page-link" href="?<?= http_build_query($qs) ?>"><?= $i ?></a>
                        </li>
                        <?php endif;
                            endfor; ?>
                        <li class="page-item <?= $page>=$totalPages ? 'disabled' : '' ?>">
                            <a class="page-link" href="?<?php
                            $qs['page']=$page+1;
                            echo http_build_query($qs);
                            ?>">
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </li>
                    </div>
                </ul>
            </nav>

        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th scope="col"><i class="fas fa-trash-alt"></i></th>
                    <th scope="col">sid</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">mobile</th>
                    <th scope="col">birthday</th>
                    <th scope="col">address</th>
                    <th scope="col"><i class="fas fa-edit"></i></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($rows as $r): ?>
                <tr data-sid="<?= $r['sid'] ?>">
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-warning del1btn" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                    <td><?= $r['sid'] ?></td>
                    <td><?= $r['name'] ?></td>
                    <td><?= $r['email'] ?></td>
                    <td><?= $r['mobile'] ?></td>
                    <td><?= $r['birthday'] ?></td>
         
                    <td><?= htmlentities($r['address']) ?></td>
                    <td>
                        <a href="customer-edit.php?sid=<?= $r['sid'] ?>">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>


</div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">刪除注意</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary modal-del-btn">Delete</button>
                </div>
            </div>
        </div>
    </div>


<?php include __DIR__. '/partials/scripts.php'; ?>
<script>
    const myTable = document.querySelector('table');
    const modal = $('#exampleModal');

    let willDeleteId = 0;
    $('.del1btn').on('click', function(event){
        willDeleteId = event.target.closest('tr').dataset.sid;
        console.log(willDeleteId);
        modal.find('.modal-body').html(`確定要刪除編號為 ${willDeleteId} 的資料嗎？`);
    });

    // 按了確定刪除的按鈕
    modal.find('.modal-del-btn').on('click', function(event){
        console.log(`customer-delete.php?sid=${willDeleteId}`);
        location.href = `customer-delete.php?sid=${willDeleteId}`;
    });

    // modal 一開始顯示時觸發
    modal.on('show.bs.modal', function(event){
        // console.log(event.target);
    });
</script>
<?php include __DIR__. '/partials/html-foot.php'; ?>