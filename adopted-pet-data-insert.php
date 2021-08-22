<?php
include __DIR__ . '/partials/init.php';
$title = '新增資料';


?>
<?php include __DIR__ . '/partials/html-head.php'; ?>
<?php include __DIR__ . '/partials/navbar.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增寵物資料</h5>
                    <form name="form1" onsubmit="checkForm(); return false;">
                        <div class="form-group">
                            <label for="name">別名*</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="breed">品種</label>
                            <input type="text" class="form-control" id="breed" name="breed" placeholder="米克斯/英國短毛/台灣土狗/柴犬">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="gender">gender</label>
                            <input type="text" class="form-control" id="gender" name="gender" placeholder="male/female">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="age">年齡</label>
                            <input type="text" class="form-control" id="age" name="age" placeholder="成年/幼年">

                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="family">科別</label>
                            <input type="text" class="form-control" id="family" name="family" placeholder="貓科/犬科">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="intro">描述</label>
                            <input type="text" class="form-control" id="intro" name="intro">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="district">區域</label>
                            <input type="text" class="form-control" id="district" name="district" placeholder="台北/新北/台中">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="avatar">大頭貼</label>
                            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*" method="post" enctype="multipart/form-data">
                            <img src="imgs/ <?= $r['avatar'] ?>" alt="" width="300px">
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
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
        fetch('adopted-pet-data-insert-api.php', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(obj => {
                console.log(obj);
                if (obj.success) {
                    location.href = 'adopted-data-list.php'
                    alert('新增成功');
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