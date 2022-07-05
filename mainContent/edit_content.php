<?php
include('conn.php');

$sql = "SELECT * FROM member WHERE m_id = '$m_id'";
$result = $conn->query($sql);
$row = mysqli_fetch_object($result);
$member_name = $row->m_name;
$phone = $row->m_phone;
$email = $row->m_email;
$address = $row->m_address;
$religion = $row->m_religion;
$service_item = $row->m_service_item;
$introduction = $row->m_introduction;

$m_religionArray = explode(",", $religion);
$m_service_itemArray = explode(",", $service_item);

mysqli_close($conn);
?>

<div id="main">

    <style>
        a {
            cursor: pointer;
        }
    </style>

    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>店家資料編輯</h3>
                    <p class="text-subtitle text-muted">
                        此處可以編輯店家在我們網站上刊登的資料訊息
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <a onclick="openStorePage()" class="btn btn-primary btn-lg">查看網頁</a>
                    </nav>
                </div>
            </div>
        </div>



        <!-- 基本資料 start -->
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">基本資料</h4>
                </div>

                <div class="card-body">
                    <form name="informationForm" action="?page=memberFC" method="post">
                        <div class="row">

                            <input type="hidden" name="type" value="update_member">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">店家名稱</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $member_name; ?>" placeholder="店家名稱...">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">連絡電話</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>" placeholder="連絡電話...">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">通訊地址</label>
                                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" placeholder="通訊地址...">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">電子信箱</label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" placeholder="電子信箱...">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="religionCheckboxes">服務宗教</label>
                                    <div id="religionCheckboxes" class="form-group position-relative has-icon-left mb-4">

                                        <?php
                                        include('conn.php');

                                        //列印資料
                                        $sql = "SELECT * FROM service_religion ORDER BY sr_id ASC";
                                        $result = $conn->query($sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo '<div class="form-check">';
                                            
                                            if(in_array($row['sr_id'], $m_religionArray)){
                                                echo '<input type="checkbox" class="form-check-input form-check-primary" name="religion' . $row['sr_id'] . '" value="' . $row['sr_id'] . '" checked>';
                                            }else{
                                                echo '<input type="checkbox" class="form-check-input form-check-primary" name="religion' . $row['sr_id'] . '" value="' . $row['sr_id'] . '">';
                                            }

                                            echo '<label for="religion' . $row['sr_id'] . '">' . $row['sr_name'] . '</label>';
                                            echo '</div>';
                                        }

                                        mysqli_close($conn);
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="button" id="submitbtn" class="btn btn-primary me-1 mb-1" onclick="check('update_member')">更新</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- 基本資料 end -->

        <!-- 服務項目 start -->
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">服務項目勾選</h4>
                </div>

                <div class="card-body">
                    <form name="service_itemForm" action="?page=memberFC" method="post">
                        <div class="row">

                            <input type="hidden" name="type" value="update_service_item">

                            <?php
                            include('conn.php');

                            $sql = "SELECT * FROM service_religion ORDER BY sr_id ASC";
                            $result = $conn->query($sql);
                            $religionNameArray = [];
                            $religionArray = [];
                            while ($row = mysqli_fetch_array($result)) {
                                array_push($religionNameArray, $row['sr_name']);
                                array_push($religionArray, $row['sr_id']);
                            }

                            $sql = "SELECT * FROM service_item ORDER BY sr_id ASC";
                            $result = $conn->query($sql);
                            $old_srid = '0';
                            $ii = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                if ($old_srid == '0') {
                                    $old_srid = $row['sr_id'];
                                    echo '<div class="form-group">';
                                    echo '<ul class="list-unstyled mb-0">';
                                    for ($i = 0; $i < count($religionArray); $i++) {
                                        if ($religionArray[$i] == $old_srid) {
                                            echo '<label for="religion' . $religionArray[$i] . '">' . $religionNameArray[$i] . '：</label>';
                                            echo '<div id="religion' . $religionArray[$i] . '" class="form-group position-relative has-icon-left mb-4">';
                                        }
                                    }
                                } else if ($row['sr_id'] != $old_srid) {
                                    $old_srid = $row['sr_id'];
                                    echo '</div>';
                                    echo '</ul>';
                                    echo '</div>';

                                    echo '<div class="form-group">';
                                    echo '<ul class="list-unstyled mb-0">';
                                    for ($i = 0; $i < count($religionArray); $i++) {
                                        if ($religionArray[$i] == $old_srid) {
                                            echo '<label for="religion' . $religionArray[$i] . '">' . $religionNameArray[$i] . '：</label>';
                                            echo '<div id="religion' . $religionArray[$i] . '" class="form-group position-relative has-icon-left mb-4">';
                                        }
                                    }
                                }

                                if (in_array($row['si_id'], $m_service_itemArray)) {
                                    echo '<li class="d-inline-block me-2 mb-1">
                                        <div class="form-check">
                                            <div class="checkbox">
                                                <input type="checkbox" name="item' . $row['si_id'] . '" id="checkbox' . $row['si_id'] . '" class="form-check-input" value="' . $row['si_id'] . '" checked>
                                                <label for="checkbox1">' . $row['si_name'] . '</label>
                                            </div>
                                        </div>
                                    </li>';
                                } else {
                                    echo '<li class="d-inline-block me-2 mb-1">
                                        <div class="form-check">
                                            <div class="checkbox">
                                                <input type="checkbox" name="item' . $row['si_id'] . '" id="checkbox' . $row['si_id'] . '" class="form-check-input" value="' . $row['si_id'] . '">
                                                <label for="checkbox1">' . $row['si_name'] . '</label>
                                            </div>
                                        </div>
                                    </li>';
                                }
                            }
                            echo '</div>';
                            echo '</ul>';
                            echo '</div>';

                            mysqli_close($conn);
                            ?>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="button" id="submitbtn" class="btn btn-primary me-1 mb-1" onclick="check('update_service_item')">更新</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- 服務項目 end -->

        <!-- 店家介紹 start -->
        <section class="section">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">店家介紹</h4>
                        </div>
                        <div class="card-body">
                            <form name="introductionForm" action="?page=memberFC" method="post">
                                <div class="row">
                                    <input type="hidden" name="type" value="update_introduction">

                                    <div class="form-group mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">
                                            請用文字簡述店家介紹～
                                        </label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="introduction" rows="5"><?php echo $introduction; ?></textarea>
                                    </div>

                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="button" id="submitbtn" class="btn btn-primary me-1 mb-1" onclick="check('update_introduction')">更新</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- 店家介紹 end -->

        <!-- 照片 start -->
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">店家相簿</h4>
                    <p>圖片最多為八張</p>
                </div>

                <div class="card-body">
                    <form name="addimageForm" action="?page=memberFC" method="post" enctype="multipart/form-data">
                        <div class="row">

                            <input type="hidden" name="type" value="4">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="file" id="myfile" name="myfile" size="50" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="imagename" name="imagename" placeholder="相片內容...">
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="button" id="submitbtn" class="btn btn-primary me-1 mb-1" onclick="check('add_picture')">新增相片</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>點擊圖片可以開啟編輯介面</h5>
                            </div>
                            <div class="card-body">

                                <?php
                                include('conn.php');

                                $sql = "SELECT * FROM member_image WHERE m_id = '$m_id'";
                                $result = $conn->query($sql);
                                $i = 0;
                                if (mysqli_num_rows($result) != 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        $i++;
                                        if ($i == 1) {
                                            echo '<div class="row gallery">';
                                        } else if (($i % 5) == 0) {
                                            echo '<div class="row mt-2 mt-md-4 gallery">';
                                        }

                                        echo '<div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2" data-bs-toggle="modal" data-bs-target="#galleryModal-' . $row['mi_id'] . '">
                                                <a>
                                                    <img class="w-100" src="./Store_Picture/' . $row['mi_filename'] . '">
                                                </a>
                                            </div>';

                                        if (($i % 4) == 0) {
                                            echo '</div>';
                                        }
                                    }
                                }

                                mysqli_close($conn);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 設定照片 modal -->
        <?php
        include('conn.php');

        $sql = "SELECT * FROM member_image WHERE m_id = '$m_id'";
        $result = $conn->query($sql);
        if (mysqli_num_rows($result) != 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo
                '<div class="modal fade" id="galleryModal-' . $row['mi_id'] . '" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="modal-header">
                                    <form name="edit_image_' . $row['mi_id'] . '" action="?page=memberFC" method="post">
                                        <input type="hidden" name="mi_id" value="' . $row['mi_id'] . '">
                                        <input type="hidden" name="type" value="update_imgName">
                                        <div class="modal-title">
                                            <div class="col-ml-6 mb-1">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="edit_imagename" value="' . $row['mi_name'] . '" placeholder="圖片名稱...">
                                                    <input type="submit" class="btn btn-primary" value="更新">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="Gallerycarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-100" src="./Store_Picture/' . $row['mi_filename'] . '">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form name="del_imgForm' . $row['mi_id'] . '" action="?page=memberFC" method="post">
                                    <input type="hidden" name="type" value="del_img">
                                    <input type="hidden" name="mi_id" value="' . $row['mi_id'] . '">
                                    <input type="submit" class="btn btn-danger" value="刪除">
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }

        ?>
        <!-- 照片 end -->


        <!-- 其他店家資訊 start -->
        <!-- 其他店家資訊 end -->

        <script src="../js/edit_JS.js"></script>

    </div>
</div>