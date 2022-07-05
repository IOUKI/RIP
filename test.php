<?php
include('conn.php');
$sql = "SELECT * FROM service_religion, service_item WHERE service_item.sr_id = service_religion.sr_id ORDER BY si_id ASC";
$result = $conn->query($sql);
$br = false;
$old_srid = '0';
while ($row = mysqli_fetch_array($result)) {
    if($old_srid == '0'){
        $old_srid = $row['sr_id'];
        echo $row['sr_name'] . "：";
    }elseif($old_srid != $row['sr_id']){
        $old_srid = $row['sr_id'];
        echo "<br>";
        echo $row['sr_name'] . "：";
    }
    echo $row['si_id'] . "、";
}
