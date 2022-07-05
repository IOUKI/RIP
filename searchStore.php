<?php
include('./phpfunction/indexFc.php');
include('./phpfunction/searchStoreFc.php');
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>首頁</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <!-- sweetalert2 -->
    <script src="./assets/js/sweetalert.js"></script>
    <style>
        rwd-table {
            background: #fff;
            overflow: hidden;
        }

        .rwd-table tr:nth-of-type(2n) {
            background: #eee;
        }

        .rwd-table th,
        .rwd-table td {
            margin: 0.5em 1em;
        }

        .rwd-table {
            min-width: 100%;
        }

        .rwd-table th {
            display: none;
        }

        .rwd-table td {
            display: block;
        }

        .rwd-table td:before {
            content: attr(data-th) " : ";
            font-weight: bold;
            width: 6.5em;
            display: inline-block;
        }

        .rwd-table th,
        .rwd-table td {
            text-align: left;
        }

        .rwd-table th,
        .rwd-table td:before {
            color: #D20B2A;
            font-weight: bold;
        }

        @media (min-width: 555px) {
            .rwd-table td:before {
                display: none;
            }

            .rwd-table th,
            .rwd-table td {
                display: table-cell;
                padding: 0.25em 0.5em;
            }

            .rwd-table th:first-child,
            .rwd-table td:first-child {
                padding-left: 0;
            }

            .rwd-table th:last-child,
            .rwd-table td:last-child {
                padding-right: 0;
            }

            .rwd-table th,
            .rwd-table td {
                padding: 1em !important;
            }
        }
    </style>
</head>

<body id="page-top">

    <!-- sidebar start -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="login.php">業者登入</a>
            <a class="navbar-brand" href="index.php">首頁</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#page-top">TOP</a></li>
                    <li class="nav-item"><a class="nav-link" href="#searchResult">查詢結果</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">查詢店家</a></li>
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
                    <h1 class="text-white font-weight-bold">Rest in Peace</h1>
                    <hr class="divider" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 mb-5"></p>
                </div>
            </div>
        </div>
    </header>
    <!-- 頁首 -->

    <section class="page-section" id="searchResult">
        <div class="container px-4 px-lg-5">
            <h2 class="text-center mt-0">查詢結果</h2>
            <hr class="divider" />
            <div class="row gx-4 gx-lg-5">
                <!-- RWD Data Table start -->
                <table class="rwd-table">
                    <tr>
                        <th>店家名稱</th>
                        <th>服務宗教</th>
                        <th>價格範圍</th>
                        <th>通訊地址</th>
                    </tr> 　
                    <?php printStore(); //./phpfunction/searchStoreFc.php
                    ?>
                </table>
                <!-- RWD Data Table end -->
            </div>
        </div>
    </section>

    <!-- 搜尋欄 start -->
    <section class="page-section" id="contact">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 col-xl-6 text-center">
                    <h2 class="mt-0">查詢店家</h2>
                    <hr class="divider" />
                    <p class="text-muted mb-5"></p>
                </div>
            </div>
            <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                <div class="col-lg-6">
                    <form id="searchStoreForm" action="./searchStore.php#searchResult" method="POST">
                        <div class="form-floating mb-3">

                            <!-- 縣市區域 select -->
                            <select class="form-control" id="name" type="text" name="area">
                                <option value="" selected>請選擇縣市位置</option>
                                <option value="台北市">台北市</option>
                                <option value="新北市">新北市</option>
                                <option value="桃園市">桃園市</option>
                                <option value="臺中市">臺中市</option>
                                <option value="臺南市">臺南市</option>
                                <option value="高雄市">高雄市</option>
                                <option value="新竹縣">新竹縣</option>
                                <option value="苗栗縣">苗栗縣</option>
                                <option value="彰化縣">彰化縣</option>
                                <option value="南投縣">南投縣</option>
                                <option value="雲林縣">雲林縣</option>
                                <option value="嘉義縣">嘉義縣</option>
                                <option value="屏東縣">屏東縣</option>
                                <option value="宜蘭縣">宜蘭縣</option>
                                <option value="花蓮縣">花蓮縣</option>
                                <option value="臺東縣">臺東縣</option>
                                <option value="澎湖縣">澎湖縣</option>
                                <option value="金門縣">金門縣</option>
                                <option value="連江縣">連江縣</option>
                            </select>
                            <label for="name">選擇地區</label>
                        </div>

                        <!-- 宗教 select -->
                        <div class="form-floating mb-3 text-felt">
                            <select class="form-control" id="religion" type="religion" placeholder="" data-sb-validations="required,religion" name="religion" onchange="religionChange(this.value)">
                                <option value="" selected>請選擇信仰宗教</option>

                                <?php call_religion(); ?>

                            </select>
                            <label for="religion">選擇宗教</label>
                        </div>

                        <!-- 服務項目 checkbox -->
                        <div class="service_item_check" id="service_item_check">
                            <h5>宗教服務項目勾選：</h5>
                            <div class="form-check">
                                <input type="checkbox" class="serviceItem form-check-input" id="all_checkbox" name="all_checkbox">
                                <label for="all_checkbox">全選</label>
                            </div>
                            <div id="checkbox-group"></div>
                        </div>

                        <!-- 金額預算 input-->
                        <div class="form-floating mb-3">
                            <input class="form-control" id="price" type="text" value="" name="price" placeholder=" " />
                            <label for="price">輸入金額預算(無預算限制則流空白)</label>
                        </div>

                        <!-- submit btn -->
                        <div class="row gx-4 gx-lg-1 justify-content-center mb-5">
                            <button type="button" class="btn btn-primary btn-lg" onclick="searchStore()">查詢</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- 搜尋欄 end -->

    <!-- Footer start -->
    <footer class="bg-light py-5">
        <div class="container px-4 px-lg-5">
            <div class="small text-center text-muted">Rest in peace</div>
        </div>
    </footer>
    <!-- Footer end -->

    <!-- script src -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="./assets/vendors/jquery/jquery.min.js"></script>

    <script>
        $('#service_item_check').hide();

        let btn = document.querySelector('#all_checkbox');
        let allchecked = btn.checked;
        let checkboxes = document.getElementsByClassName('serviceItem');
        btn.addEventListener('click', function() {
            allchecked = btn.checked;
            checkboxes = document.getElementsByClassName('serviceItem');
            all_check(allchecked, checkboxes);
        })

        function all_check(allchecked, checkboxex) {
            if (allchecked == true) {
                for (var checkbox of checkboxes) {
                    checkbox.checked = true;
                }
            } else if (allchecked == false) {
                for (let checkbox of checkboxes) {
                    checkbox.checked = false;
                }
            }
        }

        function religionChange(num) {
            let number = document.getElementById('religion').value;
            checkboxes = document.getElementsByClassName('serviceItem');
            if (number != "") {
                $('#service_item_check').show();

                $.ajax({
                    type: "GET",
                    url: "./phpfunction/indexCheckbox.php",
                    data: {
                        s: num
                    },
                    success: function(data) {
                        $('#checkbox-group').html(data);
                    }
                });

            } else {
                $('#service_item_check').hide();
            }
            all_check(false, checkboxes);
        }

        function searchStore() {

            let checkOne = false;
            let chboxVal = [];
            let checkBox = $('input[type=checkbox]');

            for (let i = 0; i < checkBox.length; i++) {
                if (checkBox[i].checked) {
                    checkOne = true;
                    break;
                }
            }

            if (searchStoreForm.area.value == "") {
                Swal.fire({
                    icon: 'warning',
                    title: '請選擇地區',
                    confirmButtonColor: '#ff8c00'
                })
            } else if (searchStoreForm.religion.value == "") {
                Swal.fire({
                    icon: 'warning',
                    title: '請選擇您信仰宗教',
                    confirmButtonColor: '#ff8c00'
                })
            } else if (!checkOne) {
                Swal.fire({
                    icon: 'warning',
                    title: '至少選擇一項服務項目',
                    confirmButtonColor: '#ff8c00'
                })
            } else {
                searchStoreForm.submit();
            }
        }

        function openStorePage(m_id) {
            window.open('./storePageCheck.php?page=' + m_id, 'Store Page');
        }
    </script>

</body>

</html>