<?php
include('conn.php');
$sql = "SELECT * FROM member WHERE m_id = '$m_id'";
$result = $conn->query($sql);
$row = mysqli_fetch_object($result);
$name = $row->m_name;
$email = $row->m_email;
$hit_count = $row->m_hit_count;

if ($hit_count == null) {
    $hit_count = 0;
}

?>

<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>後台首頁</h3>
    </div>
    <div class="page-content">
        <section class="list-group-navigation">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Rest in Reace 網頁建置教學影片</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-8 mt-1">
                                        <div class="tab-content text-justify-center" id="nav-tabContent">
                                            <div class="tab-pane show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                                <a href="https://youtu.be/G0CtDbx3vWk">
                                                    <img src="./assets/img/teaching.png" width="100%" height="450" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>