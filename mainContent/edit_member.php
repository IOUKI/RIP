<?php
include('conn.php');

$sql = "SELECT * FROM member WHERE m_id = '$m_id'";
$result = $conn->query($sql);
$row = mysqli_fetch_object($result);
$member_name = $row->m_name;
$phone = $row->m_phone;
$email = $row->m_email;
$address = $row->m_address;
$line = $row->m_line_id;
$index = $row->m_index;
$religion = $row->m_religion;

$m_priceArray = explode(',', $row->m_price);
$m_religionArray = explode(",", $religion);

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
                                    <label for="index">官方網站連結(非必填)</label>
                                    <input type="text" class="form-control" id="index" name="index" value="<?php echo $index; ?>" placeholder="網站連結...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="line">LINE ID(非必填)</label>
                                    <input type="text" class="form-control" id="line" name="line" value="<?php echo $line; ?>" placeholder="LINE 好友ID...">
                                </div>
                            </div>

                            <div class="col-md-6">
                            <label for="price">店家金額範圍(非必填)</label>    
                            <fieldset>

                                    <div class="input-group">
                                        <div class="input-group-prepend" id="price">
                                            <span class="input-group-text">金額範圍</span>
                                        </div>
                                        <input type="text" name="price1" id="price1" class="form-control" value="<?php echo $m_priceArray[0];?>" placeholder="最低價">
                                        <input type="text" name="price2" id="price2" class="form-control" value="<?php echo $m_priceArray[1];?>" placeholder="最高價">
                                    </div>
                                </fieldset>
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

                                            if (in_array($row['sr_id'], $m_religionArray)) {
                                                echo '<input type="checkbox" class="form-check-input form-check-primary" name="religion' . $row['sr_id'] . '" value="' . $row['sr_id'] . '" checked>';
                                            } else {
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

    </div>
</div>