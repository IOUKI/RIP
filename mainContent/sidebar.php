<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <h3>歡迎來到RIP<br>業者後台</h3>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">

                <li class="sidebar-title">目錄</li>
                <li class="sidebar-item <?php echo $dashboard_active; ?>">
                    <a href="?page=dashboard" class='sidebar-link'>
                        <i class="bi bi-speedometer"></i>
                        <span>首頁</span>
                    </a>
                </li>

                <li class="sidebar-title">編輯</li>
                <li class="sidebar-item <?php echo $edit_member_active; ?>">
                    <a href="?page=edit_member" class='sidebar-link'>
                        <i class="bi bi-card-text"></i>
                        <span>店家基本資料</span>
                    </a>
                </li>
                <li class="sidebar-item <?php echo $edit_service_active; ?>">
                    <a href="?page=edit_service" class='sidebar-link'>
                        <i class="bi bi-clipboard2-check-fill"></i>
                        <span>生命禮儀服務</span>
                    </a>
                </li>
                <li class="sidebar-item <?php echo $edit_introduction_active; ?>">
                    <a href="?page=edit_introduction" class='sidebar-link'>
                        <i class="bi bi-body-text"></i>
                        <span>店家介紹</span>
                    </a>
                </li>
                <li class="sidebar-item <?php echo $edit_img_active; ?>">
                    <a href="?page=edit_img" class='sidebar-link'>
                        <i class="bi bi-image"></i>
                        <span>店家相簿</span>
                    </a>
                </li>

                <li class="sidebar-title">登出</li>
                <li class="sidebar-item">
                    <a href="?page=goOut" class='sidebar-link'>
                        <i class="bi bi-box-arrow-right"></i>
                        <span>登出回首頁</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>