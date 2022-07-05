<?php
if (isset($_POST['type'])) {
    include('conn.php');

    $type = $_POST['type'];
    switch ($type) {
        case 'update_member':   //更新店家基本資料
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $price = $_POST['price1'] . "," . $_POST['price2'];

            $religion = "";
            $sql = "SELECT * FROM service_religion";
            $result = $conn->query($sql);
            $r_quantity = mysqli_num_rows($result);
            for ($i = 1; $i <= $r_quantity; $i++) {
                if (isset($_POST['religion' . $i])) {
                    if ($i == 1) {
                        $religion = $_POST['religion' . $i];
                    } else {
                        $religion = $religion . "," . $_POST['religion' . $i];
                    }
                }
            }

            $sql = "UPDATE member
                    SET m_name = '$name',
                        m_phone = '$phone',
                        m_address = '$address',
                        m_email = '$email',
                        m_religion = '$religion',
                        m_price = '$price'";

            if($_POST['index'] != ""){
                $index = $_POST['index'];
                $sql .= ", m_index = '" . $index . "'";
            }

            if($_POST['line'] != ""){
                $line = $_POST['line'];
                $sql .= ", m_line_id = '" . $line . "'";
            }

            $sql .= " WHERE m_id = '$m_id'";
            
            if (($conn->query($sql)) === true) {
                echo "<script>";
                echo "Swal.fire({
                        title: '基本資料更新成功',
                        icon: 'success'
                    }).then((result) => {
                        window.location.href='?page=edit_member';
                    })";
                echo "</script>";
            } else {
                echo "<script>";
                echo "Swal.fire({
                        title: '基本資料更新失敗',
                        text: '請確認網路有無連接',
                        icon: 'error'
                    }).then((result) => {
                        window.location.href='?page=edit_member';
                    })";
                echo "</script>";
            }
            break;
        case 'update_introduction':   //更新店家介紹
            $introduction = $_POST['introduction'];
            $sql = "UPDATE member
                    SET m_introduction = '$introduction'
                    WHERE m_id = '$m_id'";
            if (($conn->query($sql)) === true) {
                echo "<script>";
                echo "Swal.fire({
                        title: '店家介紹更新成功',
                        icon: 'success'
                    }).then((result) => {
                        window.location.href='?page=edit_introduction';
                    })";
                echo "</script>";
            } else {
                echo "<script>";
                echo "Swal.fire({
                        title: '店家介紹更新失敗',
                        text: '請確認網路有無連接',
                        icon: 'error'
                    }).then((result) => {
                        window.location.href='?page=edit_introduction';
                    })";
                echo "</script>";
            }
            break;
        case 'add_picture':   //新增相片
            $sql = "SELECT mi_id FROM member_image WHERE m_id = '$m_id'";
            $result = $conn->query($sql);
            if (mysqli_num_rows($result) >= 8) {
                echo "<script>";
                echo "Swal.fire({
                            title: '圖片最多為八張！',
                            icon: 'error'
                        }).then((result) => {
                            window.location.href='?page=edit_img';
                        })";
                echo "</script>";
            } else {
                $img_name = $_POST['imagename'];

                $file_name = $m_id . "-" . uniqid() . ".jpg";
                $upload_dir = "./Store_Picture/$file_name";
                $upload_file = $upload_dir;

                if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $upload_file)) {
                    $sql = "INSERT INTO member_image(m_id, mi_name, mi_filename)
                        VALUES ('$m_id', '$img_name', '$file_name')";
                    if (($conn->query($sql)) === true) {
                        echo "<script>";
                        echo "Swal.fire({
                                title: '圖片新增成功',
                                icon: 'success'
                            }).then((result) => {
                                window.location.href='?page=edit_img';
                            })";
                        echo "</script>";
                    }
                } else {
                    echo "<script>";
                    echo "Swal.fire({
                            title: '圖片新增成功',
                            text: '請確認網路有無連接',
                            icon: 'error'
                        }).then((result) => {
                            window.location.href='?page=edit_img';
                        })";
                    echo "</script>";
                }
            }
            break;
        case 'del_img':   //刪除相片
            $imageID = $_POST['mi_id'];
            $sql = "SELECT mi_filename FROM member_image WHERE mi_id = '$imageID'";
            $result = $conn->query($sql);
            $row = mysqli_fetch_object($result);
            $filename = $row->mi_filename;

            $sql = "DELETE FROM member_image WHERE mi_id = '$imageID'";
            if (($result = $conn->query($sql)) === true) {

                unlink('./Store_Picture/' . $filename);
                echo "<script>";
                echo "Swal.fire({
                            title: '圖片刪除成功',
                            icon: 'success'
                        }).then((result) => {
                            window.location.href='?page=edit_img';
                        })";
                echo "</script>";
            } else {
                echo "<script>";
                echo "Swal.fire({
                            title: '圖片刪除失敗',
                            text: '請確認網路有無連接',
                            icon: 'error'
                        }).then((result) => {
                            window.location.href='?page=edit_img';
                        })";
                echo "</script>";
            }
            break;
        case 'update_imgName':
            if (isset($_POST['edit_imagename']) && isset($_POST['mi_id'])) {
                $imageID = $_POST['mi_id'];
                $new_imgName = $_POST['edit_imagename'];
                if ($new_imgName != "") {
                    $sql = "UPDATE member_image
                            SET mi_name = '$new_imgName'
                            WHERE mi_id = '$imageID'";
                    if (($conn->query($sql)) === true) {
                        echo "<script>";
                        echo "Swal.fire({
                                title: '圖片名稱更新成功',
                                icon: 'success'
                            }).then((result) => {
                                window.location.href='?page=edit_img';
                            })";
                        echo "</script>";
                    }
                } else {
                    echo "<script>";
                    echo "Swal.fire({
                            title: '圖片名稱不可為空白！',
                            icon: 'error'
                        }).then((result) => {
                            window.location.href='?page=edit_img';
                        })";
                    echo "</script>";
                }
            }
            break;
        case 'update_service_item':
            $sql = "SELECT si_id FROM service_item";
            $result = $conn->query($sql);
            $s_quantity = mysqli_num_rows($result);
            $m_service_item = "";
            for ($i = 1; $i <= $s_quantity; $i++) {
                if (isset($_POST['item' . $i])) {
                    if ($i == 1) {
                        $m_service_item = $_POST['item' . $i];
                    } else {
                        $m_service_item = $m_service_item . "," . $_POST['item' . $i];
                    }
                }
            }

            $sql = "UPDATE member
                    SET m_service_item = '$m_service_item'
                    WHERE m_id = '$m_id'";
            if (($conn->query($sql)) === true) {
                echo "<script>";
                echo "Swal.fire({
                        title: '宗教服務項目更新成功',
                        icon: 'success'
                    }).then((result) => {
                        window.location.href='?page=edit_service';
                    })";
                echo "</script>";
            } else {
                echo "<script>";
                echo "Swal.fire({
                        title: '宗教服務項目更新失敗',
                        text: '請確認網路有無連接',
                        icon: 'error'
                    }).then((result) => {
                        window.location.href='?page=edit_service';
                    })";
                echo "</script>";
            }
            break;
    }

    mysqli_close($conn);
}
