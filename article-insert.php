<?php
include __DIR__.'/partials/init.php';
$title = '新增文章';

?>

<?php include __DIR__.'/partials/html-head.php'; ?>
<?php include __DIR__.'/partials/navbar.php'; ?>
<style>
    form .form-group small {
        color: #ccc;
    }
</style>

<div class="container">
    <div class="row d-flex justify-content-center my-4">
        <div class="col-md-6">
            
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增文章</h5>
                    
                    <form name="form1" onsubmit="checkForm(); return false;">
                        <div class="form-group">

                            <label for="article_title">文章標題*</label>
                            <input type="text" class="form-control" id="article_title" name="article_title">
                            <small class="form-text">*必填欄位</small>
                        </div>
                        <div class="form-group">
                            <label for="category_name">分類名稱*</label>
                            <input type="text" class="form-control" id="category_name" name="category_name">
                            <small class="form-text">*必填欄位</small>
                        </div>
                        <div class="form-group">
                            <label for="sub_category_name">次分類名*</label>
                            <input type="text" class="form-control" id="sub_category_name" name="sub_category_name">
                            <small class="form-text">*必填欄位</small>
                        </div>
                        <div class="form-group">
                            <label for="publish_date">發佈日期</label>
                            <input type="date" class="form-control" id="publish_date" name="publish_date">
                            <small class="form-text"></small>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">新增</button>
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
        if(empty(cate_name.value)){
            isPass = false;
            cate_name.nextElementSibling.innerHTML='請填寫正確分類名稱';
            cate_name.style.border='1px solid red';
        }
        if(empty(sub_cate_name.value)){
            isPass = false;
            sub_cate_name.nextElementSibling.innerHTML='請填寫正確次分類名稱';
            sub_cate_name.style.border='1px solid red';
        }
        if(isPass){
            const fd = new FormData(document.form1);
            fetch('article-insert-api.php',{
                method: 'POST',
                body: fd,
            })
            .then(r=>r.json())
            .then(obj=>{
                console.log(obj);
                if(obj.success){
                    alert('新增成功');
                    header('location:article-list.php');
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