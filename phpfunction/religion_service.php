<?php
include('conn.php');

//接收member服務的宗教ID以及服務項目ID
$sql = "SELECT m_religion FROM member WHERE m_id = '$m_id'";
$result = $conn->query($sql);
$row = mysqli_fetch_object($result);
$m_religion = $row->m_religion;
$m_service_item = $row->m_service_item;
$m_service_itemIdArray = [];
$m_religionIdArray = [];
for ($i = 0; $i < strlen($m_religion); $i++) {
    array_push($m_religionIdArray, substr($m_religion, $i, 1));
}
for ($i = 0; $i < strlen($m_religion); $i++) {
    array_push($m_religionIdArray, substr($m_religion, $i, 1));
}

//取得所有宗教名稱以及ID
$sql = "SELECT * FROM service_religion ORDER BY sr_id ASC";
$result = $conn->query($sql);
$religionIdArray = [];
$religionNameArray = [];
while ($row = mysqli_fetch_array($result)) {
    array_push($religionIdArray, $row['sr_id']);
    array_push($religionNameArray, $row['sr_name']);
}

//執行列印服務項目
$sql = "SELECT * FROM service_item ORDER BY sr_id ASC";
$result = $conn->query($sql);
$old_srid = '0';
while ($row = mysqli_fetch_array($result)) {

    if (in_array($row['sr_id'], $m_religionIdArray)) {
        if ($old_srid == '0') {
            $old_srid = $row['sr_id'];
            echo '<div class="form-group">';
            echo '<ul class="list-unstyled mb-0">';
            for ($i = 0; $i < count($religionIdArray); $i++) {
                if ($row['sr_id'] == $religionIdArray[$i]) {
                    echo '<label for="religion-' . $religionIdArray[$i] . '">' . $religionNameArray[$i] . '：</label>';
                    echo '<div id="religion-' . $religionIdArray[$i] . '" class="form-group position-relative has-icon-left mb-4">';
                    break;
                }
            }
        } elseif ($old_srid != $row['sr_id']) {
            echo '</div>';
            echo '</ul>';
            echo '</div>';
            $old_srid = $row['sr_id'];
            echo '<div class="form-group">';
            echo '<ul class="list-unstyled mb-0">';
            for ($i = 0; $i < count($religionIdArray); $i++) {
                if ($row['sr_id'] == $religionIdArray[$i]) {
                    echo '<label for="religion-' . $religionIdArray[$i] . '">' . $religionNameArray[$i] . '：</label>';
                    echo '<div id="religion-' . $religionIdArray[$i] . '" class="form-group position-relative has-icon-left mb-4">';
                    break;
                }
            }
        }

        //print checkbox
        echo '<li class="d-inline-block me-2 mb-1">
                <div class="form-check">
                    <div class="checkbox">
                        <input type="checkbox" name="item-' . $row['si_id'] . '" id="checkbox' . $row['si_id'] . '" class="form-check-input">
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
