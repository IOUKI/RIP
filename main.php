<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'dashboard':
            $dashboard_active = 'active';
            break;
        case 'edit_member':
            $edit_member_active = 'active';
            break;
        case 'edit_service':
            $edit_service_active = 'active';
            break;
        case 'edit_introduction':
            $edit_introduction_active = 'active';
            break;
        case 'edit_img':
            $edit_img_active = 'active';
            break;
        case 'goOut':
            break;
        case 'memberFC':
            break;
        default:
            $page = '404';
            break;
    }
} else {
    $page = 'dashboard';
    $dashboard_active = 'active';
}

session_start();
if(isset($_SESSION['m_id'])){
    $m_id = $_SESSION['m_id'];
}else{
    echo '<script>';
    echo 'alert("查無使用者?");';
    echo 'window.location.href = "./index.php";';
    echo '</script>';
}

?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <link rel="stylesheet" href="./assets/bootstrap-icons1.8.1/bootstrap-icons.css">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

    <?php if ($page == 'dashboard') : ?>
        <title>Dashboard</title>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
        <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
        <link rel="stylesheet" href="assets/css/app.css">

    <?php elseif ($page == 'edit_member' || $page == 'memberFC' || $page == 'edit_service' || $page == 'edit_introduction' || $page == 'edit_img') : ?>
        <title>編輯店家資料</title>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
        <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
        <link rel="stylesheet" href="assets/css/app.css">
        <script src="assets/js/sweetalert.js"></script>

    <?php elseif ($page == '404') : ?>
        <title>Error 404</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/app.css">
        <link rel="stylesheet" href="assets/css/pages/error.css">
    <?php endif; ?>

</head>

<body>

    <div id="app">

        <!-- sidebar -->
        <?php
        if ($page != '404' || $page != 'memberFC') {
            include('./mainContent/sidebar.php');
        }
        ?>

        <!-- main content -->
        <?php
        if ($page == 'dashboard') {
            include('./mainContent/dashboard.php');
        } elseif ($page == 'edit_member') {    //編輯店家資訊
            include('./mainContent/edit_member.php');
        } elseif ($page == 'edit_service') {
            include('./mainContent/edit_service.php');
        } elseif ($page == 'edit_introduction') {
            include('./mainContent/edit_introduction.php');
        } elseif ($page == 'edit_img') {
            include('./mainContent/edit_img.php');
        } elseif ($page == '404') {     //找不到頁面
            include('./mainContent/404.php');
        } elseif ($page == 'goOut') {   //登出回首頁
            include('./mainContent/logout.php');
        } elseif ($page == 'memberFC') {
            include('./mainContent/memberfunction.php');
        }
        ?>

    </div>

    <!-- script:src -->
    <?php if ($page == 'dashboard') : ?>
        <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendors/apexcharts/apexcharts.js"></script>
        <script src="assets/js/pages/dashboard.js"></script>
        <script src="assets/js/mazer.js"></script>

    <?php elseif ($page == 'edit_member' || $page == 'memberFC' || $page == 'edit_service' || $page == 'edit_introduction' || $page == 'edit_img') : ?>
        <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/mazer.js"></script>
        <script src="./js/edit_JS.js"></script>
    <?php elseif ($page == '404') : ?>

    <?php endif; ?>
</body>

</html>