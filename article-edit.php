<?php
include __DIR__.'/partials/init.php';
$title = '修改文章資料';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
$sql = "SELECT * FROM `pets_blog_articles` WHERE `sid` = $sid";
$r = $pdo->query($sql)->fetch();

if(empty($r)){
    header('location:article-list.php');
    exit;
}
?>
<style>
    form .form-group small {
        color: #ccc;
    }
</style>

<?php include __DIR__.'/partials/html-head.php'; ?>
<?php include __DIR__.'/partials/navbar.php'; ?>

<div class="container">
    <div class="row d-flex justify-content-center my-4">
        <div class="col-md-6">
            
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">修改文章資料</h5>
                    
                    <form name="form1" onsubmit="checkForm(); return false;">
                        <div class="form-group">
                            <input type="hidden" name="sid" value="<?= $r['sid'] ?>">

                            <label for="article_title">文章標題*</label>
                            <input type="text" class="form-control" id="article_title" name="article_title"
                                value="<?=htmlentities($r['article_title'])?>">
                                <!-- htmlentities標籤可以完整保留輸入的內容(例如"")，但又不會讓網站跑出其他內容 -->
                            <small class="form-text">*必填欄位</small>
                        </div>
                        <div class="form-group">
                            <label for="category_name">分類名稱*</label>
                            <input type="text" class="form-control" id="category_name" name="category_name"
                                value="<?= htmlentities($r['category_name']) ?>">
                            <small class="form-text">*必填欄位</small>
                        </div>
                        <div class="form-group">
                            <label for="sub_category_name">次分類名*</label>
                            <input type="text" class="form-control" id="sub_category_name" name="sub_category_name"
                                value="<?= htmlentities($r['sub_category_name']) ?>">
                            <small class="form-text">*必填欄位</small>
                        </div>
                        <div class="form-group">
                            <label for="publish_date">發佈日期</label>
                            <input type="date" class="form-control" id="publish_date" name="publish_date"
                                value="<?= htmlentities($r['publish_date']) ?>">
                            <small class="form-text"></small>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">修改</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include __DIR__.'/partials/scripts.php'; ?>
<script>
    const title = document.querySelector('#article_title');
    const cate_name = document.querySelector('#category_name');
    const sub_cate_name = document.querySelector('#sub_category_name');

    function checkForm(){
        title.nextElementSibling.innerHTML='';
        title.style.border='1px solid #ccc';
        cate_name.nextElementSibling.innerHTML='';
        cate_name.style.border='1px solid #ccc';
        sub_cate_name.nextElementSibling.innerHTML='';
        sub_cate_name.style.border='1px solid #ccc';

        let isPass = true;
        if(title.value.length<2){
            isPass = false;
            title.nextElementSibling.innerHTML='請填寫正確標題';
            title.style.border='1px solid red';
        }
        if(cate_name.value.length<4){
            isPass = false;
            cate_name.nextElementSibling.innerHTML='請填寫正確分類名稱';
            cate_name.style.border='1px solid red';
        }
        if(sub_cate_name.value.length<6){
            isPass = false;
            sub_cate_name.nextElementSibling.innerHTML='請填寫正確次分類名稱';
            sub_cate_name.style.border='1px solid red';
        }
        if(isPass){
            const fd = new FormData(document.form1);
            fetch('article-edit-api.php',{
                method: 'POST',
                body: fd,
            })
            .then(r=>r.json())
            .then(obj=>{
                console.log(obj);
                if(obj.success){
                    alert('修改成功');
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

<?php include __DIR__.'/partials/html-foot.php'; ?>