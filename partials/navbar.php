<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">HOME<i class="fas fa-paw"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">毛孩找家</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">毛孩旅宿</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">貓貓用品</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">狗狗用品</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="article-list.php">鏟屎官大補帖</a>
                </li>
            </ul>
                
            <ul class="navbar-nav">
                <!-- 設定成功登入就跳轉index_頁面，並於navbar右上角顯示登入的帳號暱稱、登出按鈕 -->
                <?php if(isset($_SESSION['user'])): ?>
                    <li class="nav-item active">
                        <a class="nav-link"><?= $_SESSION['user']['nickname'] ?></a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="profile-edit.php">編輯個人資料</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">登出</a>
                    </li>
                <!-- 設定未成功登入則持續顯示login表單頁面 -->
                <?php else: ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="login.php">登入</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">註冊</a>
                    </li>
                <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i></a>
                    </li>
            </ul>
        </div>    
    </div>
</nav>