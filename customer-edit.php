<?php
include __DIR__. '/partials/init.php';
$title = '修改資料';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "SELECT * FROM `customers` WHERE sid=$sid";


$r = $pdo->query($sql)->fetch();


if(empty($r)){
    header(`Location: customers-list.php`);
    exit;
}

// echo json_encode($row,JSON_UNESCAPED_UNICODE);
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
                    <h5 class="card-title">修改資料</h5>

                    <form name="form1" onsubmit="checkForm(); return false;">
                        <input type="hidden" name="sid" value="<?= $r['sid']?>">
                        <div class="form-group">
                            <label for="name">姓名 *</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                value="<?=htmlentities($r['name']) ?>">
                            <small class="form-text"></small>
                        </div>
                        <div class="form-group">
                            <label for="email">email *</label>
                            <input type="text" class="form-control" id="email" name="email"
                            value="<?= htmlentities($r['email'])?>">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="mobile">mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile"
                            value="<?= htmlentities($r['mobile'])?>">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="birthday">birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday"
                            value="<?= $r['birthday']?>">
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
<?php include __DIR__. '/partials/scripts.php'; ?>
<script>
    const email_re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

const password_re = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
//至少8個字符，至少1個大寫字母或1個小寫字母和1個數字,不能包含特殊字符（非數字字母）：
const mobile_re = /^09[0-9]{8}$/;

const name = document.querySelector('#name');



function checkForm(){
    // 欄位的外觀要回復原來的狀態
    name.nextElementSibling.innerHTML = '';
    name.style.border = '1px #CCCCCC solid';
    
    email.nextElementSibling.innerHTML = '';
    email.style.border = '1px #CCCCCC solid';

    mobile.nextElementSibling.innerHTML = '';
    mobile.style.border = '1px #CCCCCC solid';


    let isPass = true;
    if(name.value.length < 2){
        isPass = false;
        name.nextElementSibling.innerHTML = '請填寫正確的姓名';
        name.style.border = '1px red solid';
    }

    if(! email_re.test(email.value)){
        isPass = false;
        email.nextElementSibling.innerHTML = '請填寫正確的 Email 格式';
        email.style.border = '1px red solid';
    }

    if(! mobile_re.test(mobile.value)){
        isPass = false;
        mobile.nextElementSibling.innerHTML = '請填寫正確的 手機號碼 格式';
        mobile.style.border = '1px red solid';
    }

        if(isPass){
            const fd = new FormData(document.form1);
            fetch('customer-edit-api.php', {
                method: 'POST',
                body: fd
            })
                .then(r=>r.json())
                .then(obj=>{
                    console.log(obj);
                    if(obj.success){
                        alert('修改成功!');
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