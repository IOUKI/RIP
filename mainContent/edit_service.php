<?php
include('conn.php');

$sql = "SELECT * FROM member WHERE m_id = '$m_id'";
$result = $conn->query($sql);
$row = mysqli_fetch_object($result);
$religion = $row->m_religion;
$service_item = $row->m_service_item;

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
                                if (in_array($row['sr_id'], $m_religionArray)) {
                                    if ($old_srid == '0') {
                                        $old_srid = $row['sr_id'];
                                        echo '<div class="form-group">';
                                        echo '<ul class="list-unstyled mb-0">';
                                        for ($i = 0; $i < count($religionArray); $i++) {
                                            if ($religionArray[$i] == $old_srid) {
                                                echo '<label for="religion' . $religionArray[$i] . '">' . $religionNameArray[$i] . '：</label>';
                                                echo '<div id="religion' . $religionArray[$i] . '" class="form-group position-relative has-icon-left mb-4">';
                                                break;
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
                                                break;
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

    </div>
</div>