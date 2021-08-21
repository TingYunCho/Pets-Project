<?php
include __DIR__ . '/partials/init.php';
$title = '登入';
?>


<?php include __DIR__ . '/partials/html-head.php'; ?>
<?php include __DIR__ . '/partials/navbar.php'; ?>

<style>
    form .form-group small {
        display: none;
        color: red;
    }
</style>

<div class="container">

    <div class="col-md-6 mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">登入</h5>
                <form name="form1" onsubmit="sendForm();return false;">
                    <div class="form-group">
                        <label for="account">帳號</label>
                        <input type="text" class="form-control" id="account" placeholder="Enter email" name="account">
                        <small class="form-text">請填寫帳號</small>
                    </div>
                    <div class="form-group">
                        <label for="password">密碼</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                        <small class="form-text">請填寫密碼</small>
                    </div>
                    <button type="submit" class="btn btn-primary">登入</button>
                </form>
            </div>
        </div>

    </div>

</div>

<?php include __DIR__ . '/partials/scripts.php'; ?>
<script>
    function sendForm() {
        let isPass = true;
        document.form1.account.nextElementSibling.style.display = 'none';
        document.form1.password.nextElementSibling.style.display = 'none';

        if (!document.form1.account.value) {
            document.form1.account.nextElementSibling.style.display = 'block';
            let isPass = false;
        }
        if (!document.form1.password.value) {
            document.form1.password.nextElementSibling.style.display = 'block';
            let isPass = false;
        }

        if (isPass) {
            const fd = new FormData(document.form1);

            fetch('login-api.php', {
                    method: 'POST',
                    body: fd
                })
                // .then(r =>{console.log( r.text())
                // return r})
                .then(r => r.json())
                .then(obj => {
                    console.log('result:', obj);
                    if (obj.success) {
                        location.href='index_.php';
                    } else {
                        alert(obj.error);
                    }
                });

        }

    }
</script>

<?php include __DIR__ . '/partials/html-foot.php'; ?>