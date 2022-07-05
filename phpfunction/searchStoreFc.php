<?php
function printStore()
{
    if (isset($_POST['area']) && isset($_POST['religion'])) {
        include('conn.php');
        $area = $_POST['area']; //接收地區名稱
        $searchReligion = $_POST['religion']; //接收宗教
        if (isset($_POST['price'])) {
            $searchPrice = $_POST['price'];
        } else {
            $searchPrice = "";
        }

        //查詢此宗教服務項目
        $sql = "SELECT * FROM service_item WHERE sr_id = '$searchReligion' ORDER BY si_id ASC";
        $result = $conn->query($sql);
        $serviceItemArray = [];
        while ($row = mysqli_fetch_array($result)) {
            array_push($serviceItemArray, $row['si_id']);
        }
        $min = min($serviceItemArray);
        $max = max($serviceItemArray);

        $searchItem = [];
        for ($i = $min; $i <= $max; $i++) { //接收服務項目
            if (isset($_POST['item' . $i])) {
                $item = $_POST['item' . $i];
                array_push($searchItem, $item);
            }
        }

        //取得宗教名稱
        $sql = "SELECT * FROM service_religion ORDER BY sr_id ASC";
        $result = $conn->query($sql);
        $religionArray = [];
        $religionNameArray = [];
        while ($row = mysqli_fetch_array($result)) {
            array_push($religionArray, $row['sr_id']);
            array_push($religionNameArray, $row['sr_name']);
        }

        //查詢店家
        $sql = "SELECT * FROM member WHERE m_address LIKE '%$area%' AND m_religion LIKE '%$searchReligion%' ORDER BY m_id ASC";
        $result = $conn->query($sql);
        $count = 0;
        while ($row = mysqli_fetch_array($result)) {
            //服務項目需求比對
            $yes = false;
            for ($i = 0; $i < count($searchItem); $i++) {
                $com = explode($searchItem[$i], $row['m_service_item']);
                if ($com > 1) {
                    $yes = true;
                    break;
                }
            }

            //比對價格
            if ($searchPrice != "") {
                $m_price = explode(",", $row['m_price']);
                if ($m_price[0] < $searchPrice && $m_price[1] > $searchPrice) {
                    $yes = true;
                } else {
                    $yes = false;
                }
            }

            if ($yes) {
                $price = explode(",", $row['m_price']);
                $m_religion = explode(",", $row['m_religion']);
                $religion = "";
                for ($i = 0; $i < count($m_religion); $i++) {
                    for ($j = 0; $j < count($religionArray); $j++) {
                        if ($m_religion[$i] == $religionArray[$j]) {
                            if ($religion == "") {
                                $religion = $religionNameArray[$j];
                            } else {
                                $religion .= "、" . $religionNameArray[$j];
                            }
                        }
                    }
                }

                echo '<tr>';
                echo '<td data-th="店家名稱"><button class="btn btn-primary" onclick="openStorePage(' . $row['m_id'] . ')">' . $row['m_name'] . '</button></td>';
                echo '<td data-th="服務宗教">' . $religion . '</td>';
                echo '<td data-th="價格範圍">' . $price[0] . '~' . $price[1] . '</td>';
                echo '<td data-th="通訊地址">' . $row['m_address'] . '</td>';
                echo '<tr>';
                $count++;
            }
        }
        if ($count == 0) {
            echo '<tr>';
            echo '<td data-th="店家名稱">查無結果</td>';
            echo '<td data-th="服務宗教">查無結果</td>';
            echo '<td data-th="價格範圍">查無結果</td>';
            echo '<td data-th="通訊地址">查無結果</td>';
            echo '<tr>';
        }
    }
}
