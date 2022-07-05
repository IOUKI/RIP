<?php
include('conn.php');

$sql = "SELECT m_introduction FROM member WHERE m_id = '$m_id'";
$result = $conn->query($sql);
$row = mysqli_fetch_object($result);
$introduction = $row->m_introduction;

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

    </div>
</div>