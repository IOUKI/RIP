<?php
if (isset($_GET['page'])) {
    $m_id = $_GET['page'];
    include('conn.php');
    $sql = "SELECT * FROM member WHERE m_id = '$m_id'";
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) == 0) {
        echo "<script>";
        echo "alert('查無頁面');";
        echo "window.href='./index.php'";
        echo "</script>";
        mysqli_close($conn);
    } else {
        $row = mysqli_fetch_object($result);
        $member_name = $row->m_name;
        $phone = $row->m_phone;
        $email = $row->m_email;
        $address = $row->m_address;
        $index = $row->m_index;
        $line = $row->m_line_id;
        $introduction = $row->m_introduction;
        $religion = $row->m_religion;
        $service_item = $row->m_service_item;

        $m_priceArray = explode(',', $row->m_price);
        $m_religionArray = explode(",", $religion);
        $m_service_itemArray = explode(",", $service_item);

        $sql = "SELECT * FROM service_religion ORDER BY sr_id ASC";
        $result = $conn->query($sql);
        $religionArray = [];
        $religionNameArray = [];
        while ($row = mysqli_fetch_array($result)) {
            array_push($religionArray, $row['sr_id']);
            array_push($religionNameArray, $row['sr_name']);
        }

        mysqli_close($conn);
    }
} else {
    echo "<script>";
    echo "alert('查無頁面');";
    echo "window.href='./index.php'";
    echo "</script>";
}
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>店家頁面</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap Icons-->
    <link rel="stylesheet" href="./assets/bootstrap-icons1.8.1/bootstrap-icons.css">
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <!-- Swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;

            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .swiper-slide {
            cursor: pointer;
        }

        .swiper-button-prev {
            color: darkorange;
        }

        .swiper-button-next {
            color: darkorange;
        }

        .swiper-pagination span {
            background-color: darkorange;
        }
    </style>
</head>

<body id="page-top">

    <!-- sidebar start -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="javascript:window.close();">關閉</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#page-top">TOP</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">店家介紹</a></li>
                    <li class="nav-item"><a class="nav-link" href="#imageSlider">店家照片</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">服務內容</a></li>
                    <li class="nav-item"><a class="nav-link" href="#information">聯絡店家</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- sidebar end -->

    <!-- 頁首 -->
    <header class="masthead">
        <div class="container px-4 px-lg-5 h-100">
            <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                    <h1 class="text-white font-weight-bold"><?php echo $member_name; ?></h1>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 mb-5"></p>
                </div>
            </div>
        </div>
    </header>
    <!-- 頁首 -->

    <!-- 關於我們start -->
    <section class="page-section bg-primary" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-white mt-0">店家介紹</h2>
                    <hr class="divider divider-light" />
                    <p class="text-white-75 mb-4" style="font-size: 20px;"><?php echo $introduction; ?></p>
                </div>
            </div>
        </div>
    </section>
    <!-- 關於我們end -->

    <!-- 店家相片輪播 start -->
    <!-- Swiper -->
    <section class="page-section" id="imageSlider">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-black mt-0">店家相簿</h2>
                    <hr class="divider divder-light" />
                </div>
                <div class="swiper mySwiper" style="width: 75%;">
                    <div class="swiper-wrapper">
                        <?php
                        include('conn.php');

                        $sql = "SELECT * FROM member_image WHERE m_id = '$m_id'";
                        $result = $conn->query($sql);
                        if (mysqli_num_rows($result) != 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $scriptFileName = "'" . $row['mi_filename'] . "'";
                                $scriptImgName = ",'" . $row['mi_name'] . "'";
                                echo '<div class="swiper-slide"><img src="./Store_Picture/' . $row['mi_filename'] . '" alt="..." onclick="alertImage(' . $scriptFileName . $scriptImgName . ')"></div>';
                            }
                        }

                        mysqli_close($conn);
                        ?>
                        <!-- <div class="swiper-slide"><img src="./Store_Picture/619da86e0ea57.jpg" alt="..." onclick="alertImage('619da86e0ea57')"></div> -->
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- 店家相片輪播 end -->

    <!-- 店家資訊 start -->
    <section class="page-section" id="services">
        <div class="container text-center">
            <h2 class="text-center mt-0">服務資訊</h2>
            <hr class="divider" />
            <div class="row row-cols-2 row-cols-lg-5 g-2 g-lg-3">

                <?php
                include('conn.php');

                $religion_Name_Id_Array = array_combine($religionArray, $religionNameArray);

                $sql = "SELECT * FROM service_item ORDER BY si_id ASC";
                $result = $conn->query($sql);
                $old_srid = '0';
                $first_null = false;
                while ($row = mysqli_fetch_array($result)) {
                    $now_sr_id = $row['sr_id'];
                    //head
                    if ($old_srid == '0') { //first loop
                        $old_srid = $row['sr_id'];
                        $first_null = true;
                        echo '<div class="col text-center">';
                        echo '<div class="mt-5">';
                        echo '<div class="mb-2">';

                        if (in_array($now_sr_id, $m_religionArray)) {
                            echo '<button class="btn btn-success btn-lg">';
                            echo '<i class="bi bi-bookmark-check"></i>';
                            echo '</button>';
                        } else {
                            echo '<button class="btn btn-danger btn-lg">';
                            echo '<i class="bi bi-bookmark-x"></i>';
                            echo '</button>';
                        }
                        echo '</div>';
                        echo '<h3 class="h4 mb-2">' . $religion_Name_Id_Array[$now_sr_id] . '</h3>';
                    } elseif ($old_srid != $now_sr_id) { //if change religion
                        $first_null = true;
                        $old_srid = $now_sr_id;
                        echo "</div>";
                        echo "</div>";

                        echo '<div class="col text-center">';
                        echo '<div class="mt-5">';
                        echo '<div class="mb-2">';

                        if (in_array($now_sr_id, $m_religionArray)) {
                            echo '<button class="btn btn-success btn-lg">';
                            echo '<i class="bi bi-bookmark-check"></i>';
                            echo '</button>';
                        } else {
                            echo '<button class="btn btn-danger btn-lg">';
                            echo '<i class="bi bi-bookmark-x"></i>';
                            echo '</button>';
                        }
                        echo '</div>';
                        echo '<h3 class="h4 mb-2">' . $religion_Name_Id_Array[$now_sr_id] . '</h3>';
                    }
                    if (in_array($now_sr_id, $m_religionArray)) {
                        if (in_array($row['si_id'], $m_service_itemArray)) {
                            echo '<p><i class="bi bi-check-square-fill" style="color: green;"></i>' . $row['si_name'] . '</p>';
                        } else {
                            echo '<p><i class="bi bi-x"style="color: red;"></i>' . $row['si_name'] . '</p>';
                        }
                    } else {
                        if ($first_null) {
                            echo '<p>無服務</p>';
                            $first_null = false;
                        }
                    }
                }

                echo "</div>";
                echo "</div>";

                mysqli_close($conn);
                ?>

            </div>
        </div>
    </section>
    <!-- 店家資訊 end -->

    <!-- Footer start -->
    <!-- Footer -->
    <footer class="text-center text-lg-start bg-light text-muted" id="information">
        <!-- Section: Links  -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4"><i class="bi bi-building"></i>公司名稱：<?php echo $member_name; ?></h6>
                        <p><i class="bi bi-house-heart"></i>地址：<?php echo $address; ?></p>
                        <p><i class="bi bi-envelope"></i>電子信箱：</i><?php echo $email; ?></p>
                        <p><i class="bi bi-telephone"></i>連絡電話：<?php echo $phone; ?></p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            其他聯絡資訊
                        </h6>
                        <p><i class="bi bi-bookmark-star"></i>官方網站：<a href="#!" onclick="goindex('<?php echo $index ?>')"><?php echo $index ?></a></p>
                        <p><i class="bi bi-phone"></i>LINE ID：<?php echo $line; ?></p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">
                            服務宗教
                        </h6>

                        <?php
                        for ($i = 0; $i < count($m_religionArray); $i++) {
                            if (in_array($m_religionArray[$i], $religionArray)) {
                                echo '<p>';
                                echo '<a href="#!" class="text-reset">' . $religionNameArray[$i] . '</a>';
                                echo '</p>';
                            }
                        }
                        ?>

                        <h6 class="text-uppercase fw-bold mb-4">
                            價格範圍
                        </h6>

                        <p>
                            <?php
                            echo $m_priceArray[0] . " ~ " . $m_priceArray[1];
                            ?>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <!-- <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        
                    </div> -->
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2022 Rest in peace
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
    <!-- <footer class="bg-light py-5">
        <div class="container px-4 px-lg-5">
            <div class="small text-center text-muted">Rest in peace</div>
        </div>
    </footer> -->
    <!-- Footer end -->

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- sweetalert2 JS -->
    <script src="./assets/js/sweetalert.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        function alertImage(filename, imgName) {
            img_address = './Store_Picture/' + filename;
            Swal.fire({
                imageUrl: img_address,
                text: imgName,
                confirmButtonColor: '#ff8c00'
            })
        }

        function goindex(urlstr) {
            window.location.href = urlstr;
        }
    </script>
</body>

</html>