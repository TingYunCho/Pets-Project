<?php
    include __DIR__. '/partials/init.php';
    $title = '註冊';
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
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">註冊申請</h5>

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
                            <input type="text" class="form-control" id="name" name="name">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="nickname">暱稱 *</label>
                            <input type="text" class="form-control" id="nickname" name="nickname">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="email">email (account) *</label>
                            <input type="text" class="form-control" id="email" name="email">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="password">password *</label>
                            <input type="text" class="form-control" id="password" name="password">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="mobile">mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" >
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="birthday">birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="address">address</label>
                            <textarea  class="form-control" id="address" name="address" 
                            cols="30" rows="3"></textarea>
                            <small class="form-text "></small>
                        </div>

                        <button type="submit" class="btn btn-primary">註冊</button>
                    </form>


                </div>
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
    const nickname = document.querySelector('#nickname');



    function checkForm(){
        // 欄位的外觀要回復原來的狀態
        name.nextElementSibling.innerHTML = '';
        name.style.border = '1px #CCCCCC solid';
        
        nickname.nextElementSibling.innerHTML = '';
        nickname.style.border = '1px #CCCCCC solid';
        
        email.nextElementSibling.innerHTML = '';
        email.style.border = '1px #CCCCCC solid';

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

        if(! email_re.test(email.value)){
            isPass = false;
            email.nextElementSibling.innerHTML = '請填寫正確的 Email 格式';
            email.style.border = '1px red solid';
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
            const fd = new Formmember(document.form1);
            fetch('member-insert-api.php', {
                method: 'POST',
                body: fd
            })
                .then(r=>r.json())
                .then(obj=>{
                    console.log(obj);
                    if(obj.success){
                        alert ("註冊成功");
                        location.href = 'login.php';
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