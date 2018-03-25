<?php

$ID = $_SESSION['ID'];
$shippingID = Param::get('shippingID');
date_default_timezone_set("Asia/Kuala_Lumpur");
$now = date('Y-m-d', time());
include 'database.php';

$sql = "SELECT * FROM booking WHERE  userID= '" . $ID . "' AND shippingID = '" . $shippingID . "'";
$stmtBook = sqlsrv_query($conn, $sql, array(), array("Scrollable" => "buffered"));
$haveBooked = sqlsrv_num_rows($stmtBook);

if ($haveBooked == 0) {
    $sqlInsert = "INSERT into booking(userID,dateCreated,shippingID) values ('" . $ID . "','" . $now . "','" . $shippingID . "')";
    $saveData = sqlsrv_query($conn, $sqlInsert, array(), array("Scrollable" => "buffered"));
    if ($saveData === false) {
        ?>
        <script>
            alert('Book Failed!!!');
            window.location = 'booking';
        </script>
        <?php
    } else {
        ?>
        <script>
            alert('Book Successfully!!!');
            window.location = 'member';
        </script>
        <?php
    }
} else {
    ?>
    <script>
        alert('Already Booked!!!');
        window.location = 'member';
    </script>
    <?php
}