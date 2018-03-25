<script>
    $(document).ready(function () {
        $('.ui.dropdown').dropdown({
            'forceSelection': false
        });
        $('.ui.form').form();
    });
</script>

<?php
//Access Control
if ($_SESSION['position'] != "member") {
    header('Location: error403');
    exit();
}

$ID = $_SESSION['ID'];
include 'database.php';

$sql = "SELECT booking.ID,booking . userID, booking . shippingID, shipping .source , shipping .destination , shipping . status FROM booking JOIN shipping ON (shipping . shippingID = booking . shippingID) WHERE booking.userID = '" . $ID . "'";
$stmt = sqlsrv_query($conn, $sql, array(), array( "Scrollable" => 'static' ));
$haveBooked = sqlsrv_num_rows($stmt);

if ($haveBooked == 0) {
    ?>
    <div class="ui vertical stripe segment">
        <div class="ui top aligned stackable grid container">
            <div class="row">
                <div class="ten wide column">
                    <h1 class="ui header">No Booking</h1>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="ui vertical stripe segment">
        <div class="ui top aligned stackable grid container">
            <div class="row">
                <div class="ten wide column">
                    <h1 class="ui header">Booking</h1>
                </div>
            </div>
            <div class="row">
                <div class="eleven wide column">
                    <table class="ui celled table selectable">
                        <thead>
                        <tr>
                            <th> Booking ID</th>
                            <th> Source</th>
                            <th> Destination</th>
                            <th> Status</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $num = 1;
                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?php echo $row['ID']; ?></td>
                                <td><?php echo $row['source']; ?></td>
                                <td><?php echo $row['destination']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php
}