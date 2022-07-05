<?php
if (isset($_GET['s'])) {
    $s = $_GET['s'];

    include('../conn.php');

    $sql = "SELECT * FROM service_item WHERE sr_id = '$s'";
    $result = $conn->query($sql);
    
    while ($row = mysqli_fetch_array($result)) {
        echo '<div class="form-check">';
        echo '<input type="checkbox" class="serviceItem form-check-input" name="item' . $row['si_id'] . '" value=' . $row['si_id'] . '>';
        echo '<label for="item' . $row['si_id'] . '">' . $row['si_name'] . '</label>';
        echo '</div>';
    }
}else{
    echo "錯誤！找不到資料";
}
