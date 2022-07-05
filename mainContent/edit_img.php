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
                    <a onclick="openStorePage(<?php echo $m_id;  ?>)" class="btn btn-primary btn-lg">查看網頁</a>
                    </nav>
                </div>
            </div>
        </div>

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

                            <input type="hidden" name="type" value="add_picture">

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

    </div>
</div>