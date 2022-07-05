<?php

if (isset($_POST['account']) && isset($_POST['pwd']) && isset($_POST['name']) && isset($_POST['email'])) {
    include('conn.php');
    $account = $_POST['account'];
    $sql = "SELECT m_account FROM member WHERE m_account = '$account'";
    $result = $conn->query($sql);

    if (mysqli_num_rows($result) == 0) {
        //讀取所有宗教數量
        $sql = "SELECT * FROM service_religion ORDER BY sr_id ASC";
        $result = $conn->query($sql);
        $num_religion = mysqli_num_rows($result);

        //接收post資料
        $pwd = $_POST['pwd'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $religion = "";
        $first = true;
        for ($i = 0; $i < $num_religion; $i++) {
            if (isset($_POST["religion" . ($i + 1)])) {
                if ($first) {
                    $first = false;
                    $religion = $_POST["religion" . ($i + 1)];
                } else {
                    $religion = $religion . "," . $_POST["religion" . ($i + 1)];
                }
            }
        }

        //上傳營業證明圖檔
        $file_name = uniqid();
        $desc_file_name = $file_name . ".jpg";    //亂碼檔名以及改檔
        $upload_dir = "./certificate/$desc_file_name";    //儲存路徑跟新檔名
        $upload_file = $upload_dir;                //功能全部包裹好

        if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $upload_file)) {    //執行上傳動作
            //上傳所有資料
            $sql = "INSERT INTO member(m_account, m_password, m_name, m_phone, m_address, m_email, m_religion, m_certificate, m_price)
                    VALUES ('$account', '$pwd', '$name', '$phone', '$address', '$email', '$religion', '$desc_file_name', ',')";
            if (($conn->query($sql)) === true) {
                echo "<script>";
                echo "alert('新增成功')";
                echo "</script>";
            }
        } else {
            echo "註冊失敗";
        }
    } else {
        echo "<script>";
        echo "alert('此帳號已有人註冊，請使用其他帳號名稱！');";
        echo "</script>";

        mysqli_close($conn);
    }
} else if (isset($_POST['account']) && isset($_POST['pwd'])) {
    include('conn.php');
    $account = $_POST['account'];
    $password = $_POST['pwd'];
    $sql = "SELECT m_id FROM member WHERE m_account = '$account' AND m_password = '$password'";
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) == 0) {
        mysqli_free_result($result);

        echo "<script>";
        echo "alert('查無使用者');";
        echo "</script>";

        mysqli_close($conn);
    } else {
        $row = mysqli_fetch_object($result);
        $m_id = $row->m_id;
        session_start();
        $_SESSION['m_id'] = $m_id;

        echo "<script>";
        echo "window.location.href = './main.php';";
        echo "</script>";

        mysqli_free_result($result);
        mysqli_close($conn);
    }
}

if (isset($_GET['p'])) {
    $p = $_GET['p'];
} else {
    $p = 'login';
}

?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if ($p == 'login') : ?>
        <title>業者登入</title>
    <?php elseif ($p == 'register') : ?>
        <title>業者註冊</title>
    <?php endif; ?>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/bootstrap-icons1.8.1/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <script src="assets/js/sweetalert.js"></script>
</head>

<body>
    <?php if ($p == 'login') : ?>
        <div id="auth">

            <div class="row h-100">
                <div class="col-lg-5 col-12">
                    <div id="auth-left">

                        <h1 class="auth-title"><i class="bi bi-person-circle"></i>業者登入</h1>

                        <form name="loginForm" action="./login.php" method="POST">
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="text" name="account" class="form-control form-control-xl" placeholder="請輸入帳號...">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="password" name="pwd" class="form-control form-control-xl" placeholder="請輸入密碼...">
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                            </div>

                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="button" class="btn btn-primary btn-lg btn-block" onclick="check(5)" value="登入">
                            </div>

                            <div class="form-group position-relative has-icon-left mb-4">
                                <a href="?p=register" class="btn btn-secondary btn-lg btn-block">註冊</a>
                            </div>

                            <div class="form-group position-relative has-icon-left mb-4">
                                <a href="./index.php" class="btn btn-secondary btn-lg btn-block">回首頁</a>
                            </div>

                        </form>

                    </div>
                </div>
                <div class="col-lg-7 d-none d-lg-block">
                    <div id="auth-right">

                    </div>
                </div>
            </div>

        </div>
    <?php elseif ($p == 'register') : ?>
        <div id="auth">

            <div class="row h-100">
                <div class="col-lg-5 col-12">
                    <div id="auth-left">

                        <h1 class="auth-title"><i class="bi bi-person-circle"></i>業者註冊</h1>

                        <form name="registerForm" action="./login.php" method="POST" enctype="multipart/form-data">

                            <label for="account">帳號：</label>
                            <div id="account" class="form-group position-relative has-icon-left mb-4">
                                <input type="text" name="account" class="form-control form-control-xl" placeholder="請輸入帳號..." required>
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>

                            <label for="pwd">密碼：</label>
                            <div id="pwd" class="form-group position-relative has-icon-left mb-4">
                                <input type="password" name="pwd" class="form-control form-control-xl" placeholder="請輸入密碼..." required>
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                            </div>

                            <label for="name">店家名稱：</label>
                            <div id="name" class="form-group position-relative has-icon-left mb-4">
                                <input type="text" name="name" class="form-control form-control-xl" placeholder="請輸入店家名稱..." required>
                                <div class="form-control-icon">
                                    <i class="bi bi-card-text"></i>
                                </div>
                            </div>

                            <label for="address">店家地址：</label>
                            <div id="address" class="form-group position-relative has-icon-left mb-4">
                                <input type="text" name="address" class="form-control form-control-xl" placeholder="請輸入店家地址..." required>
                                <div class="form-control-icon">
                                    <i class="bi bi-house"></i>
                                </div>
                            </div>

                            <label for="phone">聯絡電話：</label>
                            <div id="phone" class="form-group position-relative has-icon-left mb-4">
                                <input type="text" name="phone" class="form-control form-control-xl" placeholder="請輸入連絡電話..." required>
                                <div class="form-control-icon">
                                    <i class="bi bi-telephone"></i>
                                </div>
                            </div>

                            <label for="email">電子信箱：</label>
                            <div id="email" class="form-group position-relative has-icon-left mb-4">
                                <input type="text" name="email" class="form-control form-control-xl" placeholder="請輸入電子信箱..." required>
                                <div class="form-control-icon">
                                    <i class="bi bi-envelope"></i>
                                </div>
                            </div>

                            <label for="file">營業證明（營業登記資料）：</label>
                            <div id="file" class="input-group mb-3">
                                <label class="input-group-text" for="myfile"><i class="bi bi-upload"></i></label>
                                <input type="file" id="myfile" name="myfile" size="50" class="form-control" required>
                            </div>

                            <label for="religion">服務宗教：</label>
                            <div id="religion" class="form-group position-relative has-icon-left mb-4">

                                <?php
                                include('conn.php');
                                $sql = "SELECT * FROM service_religion ORDER BY sr_id ASC";
                                $result = $conn->query($sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<div class="form-check">';
                                    echo '<input type="checkbox" class="form-check-input form-check-primary" name="religion' . $row['sr_id'] . '" value="' . $row['sr_id'] . '" id="religion' . $row['sr_id'] . '">';
                                    echo '<label for="religion' . $row['sr_id'] . '">' . $row['sr_name'] . '</label>';
                                    echo '</div>';
                                }
                                ?>

                            </div>

                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="button" class="btn btn-primary btn-lg btn-block" onclick="check(3)" value="註冊">
                            </div>

                            <div class="form-group position-relative has-icon-left mb-4">
                                <a href="?p=login" class="btn btn-secondary btn-lg btn-block">回登入</a>
                            </div>

                            <div class="form-group position-relative has-icon-left mb-4">
                                <a href="./index.php" class="btn btn-secondary btn-lg btn-block">回首頁</a>
                            </div>

                        </form>

                    </div>
                </div>
                <div class="col-lg-7 d-none d-lg-block">
                    <div id="auth-right">

                    </div>
                </div>
            </div>

        </div>
    <?php endif; ?>

    <script>
        function check(type) {
            if (type == 5) {

                if (loginForm.account.value == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: '請輸入帳號！'
                    })
                } else if (loginForm.pwd.value == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: '請輸入密碼！'
                    })
                } else {
                    loginForm.submit();
                }

            } else if (type == 3) {

                let checkboxes = document.querySelectorAll('input[type=checkbox]:checked');

                if (registerForm.account.value == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: '請輸入帳號！'
                    })
                } else if (registerForm.pwd.value == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: '請輸入密碼！'
                    })
                } else if (registerForm.name.value == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: '請輸入姓名！'
                    })
                } else if (registerForm.phone.value == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: '請輸入連絡電話！'
                    })
                } else if (registerForm.email.value == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: '請輸入電子信箱！'
                    })
                } else if (registerForm.myfile.value == '') {
                    Swal.fire({
                        icon: 'warning',
                        title: '請附上營業證明！'
                    })
                } else if (checkboxes.length == 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: '請至少選擇一項宗教！'
                    })
                } else {
                    registerForm.submit();
                }

            }
        }
    </script>

</body>

</html>