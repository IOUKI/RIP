<?php
function call_religion()
{
    include('conn.php');

    $sql = "SELECT * FROM service_religion ORDER BY sr_id ASC";
    $result = $conn->query($sql);

    while ($row = mysqli_fetch_array($result)) {
        echo "<option value='" . $row['sr_id'] . "'>" . $row['sr_name'] . "</option>";
    }

    mysqli_close($conn);
}

function call_serviceItem()
{
    include('conn.php');
    $sql = "SELECT * FROM service_religion, service_item WHERE service_item.sr_id = service_religion.sr_id ORDER BY si_id ASC";
    $result = $conn->query($sql);
    $old_srid = '0';
    while ($row = mysqli_fetch_array($result)) {
        if ($old_srid == '0') {
            $old_srid = $row['sr_id'];
            echo '<div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card collapse-icon accordion-icon-rotate">
                        <div class="card-header">
                            <h1 class="card-title pl-1">' . $row['sr_name'] . '</h1>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="accordion" id="cardAccordion">';
        } elseif ($old_srid != $row['sr_id']) {
            $old_srid = $row['sr_id'];
            echo "</div></div></div></div></div>";
            echo '<div class="col-xl-4 col-md-6 col-sm-12">
                    <div class="card collapse-icon accordion-icon-rotate">
                        <div class="card-header">
                            <h1 class="card-title pl-1">' . $row['sr_name'] . '</h1>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="accordion" id="cardAccordion">';
        }
        echo 
        '<div class="card">
            <div class="card-header" id="headingOne" data-bs-toggle="collapse" data-bs-target="#item' . $row['si_id'] . '" aria-expanded="false" aria-controls="collapseOne" role="button">
                <span class="collapsed collapse-title">' . $row['si_name'] .'</span>
            </div>
            <div id="item' . $row['si_id'] . '" class="collapse pt-1" aria-labelledby="headingOne" data-parent="#cardAccordion">
                <div class="card-body">
                    ' . $row['si_content'] . '
                </div>
            </div>
        </div>';
    }
    echo "</div></div></div></div></div>";
}
