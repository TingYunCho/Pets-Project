<?php
include __DIR__ . '/partials/init.php';
$title = '修改資料';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "SELECT * FROM `adopted` WHERE sid=$sid";



$r = $pdo->query($sql)->fetch();

?>
<?php include __DIR__ . '/partials/html-head.php'; ?>
<?php include __DIR__ . '/partials/navbar.php'; ?>
<style>
    form .form-group small {
        color: red;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">寵物修改資料</h5>

                    <form name="form1" onsubmit="checkForm(); return false;">
                        <input type="hidden" name="sid" value="<?= $r['sid'] ?>">
                        <div class="form-group">
                            <label for="name">姓名 *</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= htmlentities($r['name']) ?>">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="breed">種類</label>
                            <input type="text" class="form-control" id="breed" name="breed" value="<?= htmlentities($r['breed']) ?>">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="gender">性別</label>
                            <input type="text" class="form-control" id="gender" name="gender" value="<?= htmlentities($r['gender']) ?>">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="age">birthday</label>
                            <input type="text" class="form-control" id="age" name="age" value="<?= htmlentities($r['age']) ?>">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="family">科別</label>
                            <input type="text" class="form-control" id="family" name="family" value="<?= htmlentities($r['family']) ?>">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="intro">描述</label>

                            <textarea class="form-control" id="intro" name="intro" cols="30" rows="3"><?= htmlentities($r['intro']) ?></textarea>
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="district">區域</label>
                            <input type="text" class="form-control" id="district" name="district" value="<?= htmlentities($r['district']) ?>">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="avatar">大頭貼</label>
                            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*" method="post" enctype="multipart/form-data">
                            <?php if(empty( $r['avatar'])): ?>
                                <!-- 預設的大頭貼 -->
                            <?php else: ?>
                                <!-- 顯示原本的大頭貼 -->
                                <img src="imgs/<?= $r['avatar'] ?>" alt="" width="300px">
                            <?php endif; ?>
                            <img src="imgs/ <?= $r['avatar'] ?>" alt="" width="300px">
                        </div>
                        <button type="submit" class="btn btn-primary">修改</button>
                    </form>


                </div>
            </div>
        </div>
    </div>


</div>
<?php include __DIR__ . '/partials/scripts.php'; ?>
<script>
    function checkForm() {

        const fd = new FormData(document.form1);
        fetch('adopted-data-edit-api.php', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(obj => {
                console.log(obj);
                if (obj.success) {
                    location.href = 'adopted-data-list.php'
                    alert('修改成功');
                } else {
                    alert(obj.error);
                }
            })
            .catch(error => {
                console.log('error:', error);
            });


    }
</script>
<?php include __DIR__ . '/partials/html-foot.php'; ?>