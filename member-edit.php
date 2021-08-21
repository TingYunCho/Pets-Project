<?php
    include __DIR__. '/partials/init.php';
    $title = '修改個人資料';

    if(! isset($_SESSION['user'])){
        //如果沒有登入就轉首頁
        header('Location: index_.php');
        exit;
    }


    $sql = "SELECT * FROM `members` WHERE id=". intval($_SESSION['user']['id']);
    //從資料庫拿資料

    $r = $pdo->query($sql)->fetch();

    if(empty($r)){
        header('Location: index_.php');
        exit;
    }


?>
<?php include __DIR__. '/partials/html-head.php'; ?>
<?php include __DIR__. '/partials/navbar.php'; ?>

<style>
        form .form-group small {
            color: red;
        }

    </style>

<div class="container">
    <div class="row">
        <div class="col-md-6 mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <h5><i class="fas fa-user-edit"></i></h5>
                        <h5 class="card-title">修改資料</h5>
                    </div>

                    <form name="form1" onsubmit="checkForm(); return false;">
                        <div class="form-group">
                            <label for="avatar">大頭貼</label>
                            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                            <?php if(empty( $r['avatar'])): ?>
                                <!-- 預設的大頭貼 -->
                            <?php else: ?>
                                <!-- 顯示原本的大頭貼 -->
                                <img src="imgs/<?= $r['avatar'] ?>" alt="" width="300px">
                            <?php endif; ?>
                        </div>   
                        <div class="form-group">
                            <label for="name">姓名 *</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?=htmlentities($r['name']) ?>">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="nickname">暱稱 *</label>
                            <input type="text" class="form-control" id="nickname" name="nickname" value="<?=htmlentities($r['nickname']) ?>">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="email">email (帳號不能修改) *</label>
                            <input type="text" class="form-control" id="email" name="email" disabled
                            value="<?=htmlentities($r['email']) ?>">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="password">password *</label>
                            <input type="text" class="form-control" id="password" name="password" value="<?=htmlentities($r['password']) ?>">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="mobile">mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" value="<?=htmlentities($r['mobile']) ?>">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="birthday">birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" value="<?=htmlentities($r['birthday']) ?>">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="address">address</label>
                            <textarea  class="form-control" id="address" name="address" 
                            cols="30" rows="3"><?= htmlentities($r['address'])?></textarea>
                            <small class="form-text "></small>
                        </div>

                        <button type="submit" class="btn btn-primary">修改</button>
                    </form>


                </div>
            </div>
        </div>
    </div>


</div>

</div>
<?php include __DIR__. '/partials/scripts.php'; ?>
<script>
    const password_re = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    //至少8個字符，至少1個大寫字母或1個小寫字母和1個數字,不能包含特殊字符（非數字字母）：
    const mobile_re = /^09[0-9]{8}$/;

    const name = document.querySelector('#name');
    const nickname = document.querySelector('#nickname');



    function checkForm(){
        // 欄位的外觀要回復原來的狀態
        name.nextElementSibling.innerHTML = '';
        name.style.border = '1px #CCCCCC solid';
        
        nickname.nextElementSibling.innerHTML = '';
        nickname.style.border = '1px #CCCCCC solid';
    

        password.nextElementSibling.innerHTML = '';
        password.style.border = '1px #CCCCCC solid';

        mobile.nextElementSibling.innerHTML = '';
        mobile.style.border = '1px #CCCCCC solid';


        let isPass = true;
        if(name.value.length < 2){
            isPass = false;
            name.nextElementSibling.innerHTML = '請填寫正確的姓名';
            name.style.border = '1px red solid';
        }

        if(nickname.value ==''){
            isPass = false;
            nickname.nextElementSibling.innerHTML = '請填寫暱稱';
            nickname.style.border = '1px red solid';
        }

        if(! password_re.test(password.value)){
            isPass = false;
            password.nextElementSibling.innerHTML = '密碼字數>8，須包含至少一個英文字母及一個數字';
            password.style.border = '1px red solid';
        }

        if(! mobile_re.test(mobile.value)){
            isPass = false;
            mobile.nextElementSibling.innerHTML = '請填寫正確的 手機號碼 格式';
            mobile.style.border = '1px red solid';
        }





        if(isPass){
            const fd = new FormData(document.form1);
            fetch('member-edit-api.php', {
                method: 'POST',
                body: fd
            })
                .then(r=>r.json())
                .then(obj=>{
                    console.log(obj);
                    if(obj.success){
                        alert('修改成功');
                        location.href = 'index_.php';
                    } else {
                        alert(obj.error);
                    }
                })
                .catch(error=>{
                    console.log('error:', error);
                });
        }
    }
</script>
<?php include __DIR__. '/partials/html-foot.php'; ?>