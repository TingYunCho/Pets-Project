<?php include __DIR__. '/partials/init.php'; ?>

<?php include __DIR__. '/partials/html-head.php'; ?>
<?php include __DIR__. '/partials/navbar.php'; ?>
<style>
        form .form-group small {
            color: red;
        }

    </style>

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center border rounded be-light my-5">
            <h1>購物車</h1>
        </div>

        <div class="col-lg-9">
            <table class="table table-striped">
                <thead class="text-center">
                    <tr>
                        <th scope="col">編號</th>
                        <th scope="col">商品名稱</th>
                        <th scope="col">單價</th>
                        <th scope="col">數量</th>
                        <th scope="col">小計</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    $total=0;
                        if(!empty($_SESSION['cart']))
                        {
                            foreach($_SESSION['cart'] as $key => $value)
                            {   
                                $sr=$key+1;
                                // $total=$total+$value['Price'];
                                echo"
                                    <tr>
                                        <td>$sr</td>
                                        <td>$value[Item_Name]</td>
                                        <td>$value[Price]<input type='hidden' class='iprice' value='$value[Price]'></td>
                                        <td>
                                        <form action='manage_cart.php' method='POST'>
                                            <input class='text-center iquantity' name='Mod_Quantity' onchange='this.form.submit();' type='number' value='$value[Quantity]' min='1' max='10'>
                                            <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                                        </form>
                                        </td>
                                        <td class='itotal'></td>
                                        <td>
                                            <form action='manage_cart.php' method='POST'>
                                                <button name='Remove_Item' class='btn btn-sm btn-outline-danger'>刪除</button>
                                                <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                                            </form>
                                        </td>
                                    </tr>
                                ";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="col-lg-3">
            <div class= "border bg-light rounded p-4">
                <h4>總金額:</h4>
                <h6 class="text-right" id="gtotal">元</h6>
                <br>
                <?php
                if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0)
                    {
                ?>
                <!-- <form action="save-orders.php" method="POST">
                    <div class="form-group">
                        <label>姓名</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>電話</label>
                        <input type="number" name="mobile" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>地址</label>
                        <input type="text" name="address" class="form-control" required>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="pay_mode" value="COD " id="defaultCheck1" checked>
                        <label class="form-check-label" for="defaultCheck1">
                            現金支付
                        </label>
                    </div>
                    <br>
                    <button class="btn btn-primary btn-block" name="purchase">商品結帳</button>
                </form> -->
                <form name="form1" onsubmit="checkForm(); return false;">
                        <div class="form-group">
                            <label for="name">姓名 *</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="email">email *</label>
                            <input type="text" class="form-control" id="email" name="email">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="mobile">mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile">
                            <small class="form-text "></small>
                        </div>
                        <div class="form-group">
                            <label for="address">address</label>
                            <input type="text" class="form-control" id="address" name="address">
                            <small class="form-text "></small>
                        </div>

                        <button type="submit" class="btn btn-primary">訂單送出</button>
                    </form>
                <?php 
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__. '/partials/scripts.php'; ?>

<!-- 計算總額 -->
<script>
    let gt=0;
    let iprice=document.getElementsByClassName('iprice');
    let iquantity=document.getElementsByClassName('iquantity');
    let itotal=document.getElementsByClassName('itotal');
    let gtotal=document.querySelector('#gtotal');

    function subTotal()
    {   
        gt=0;
        for(i=0;i<iprice.length;i++)
        {
            itotal[i].innerText=(iprice[i].value)*(iquantity[i].value);

            gt=gt+(iprice[i].value)*(iquantity[i].value);

        }
        gtotal.innerText=gt;
    }


    subTotal();

</script>
<!-- 資料上傳 -->
<script>
    const email_re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/;

    const name = document.querySelector('#name');
    const email = document.querySelector('#email');
    const iprice = document.querySelector('#iprice');

    function checkForm(){
        // 欄位的外觀要回復原來的狀態
        name.nextElementSibling.innerHTML = '';
        name.style.border = '1px #CCCCCC solid';
        email.nextElementSibling.innerHTML = '';
        email.style.border = '1px #CCCCCC solid';

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

        if(isPass){
            const fd = new FormData(document.form1);
            fetch('save-orders.php', {
                method: 'POST',
                body: fd
            })
                .then(r=>r.json())
                .then(obj=>{
                    console.log(obj);
                    if(obj.success){
                        location.href = '#';
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