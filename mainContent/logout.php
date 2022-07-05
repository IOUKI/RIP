<?php
    //刪除所有全域會話變數並銷毀工作階段
    unset($_SESSION['m_id']);
    session_destroy();

    header("Location:./index.php");
?>
