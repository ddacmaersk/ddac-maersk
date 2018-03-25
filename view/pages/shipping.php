<?php
if ($_SESSION['position'] != "staff") {
    header('Location: error403');
    exit();
}
date_default_timezone_set("Asia/Kuala_Lumpur");
$today = date('Y-m-d', time());
include 'database.php';

$minTime = date('Y-m-d', time());
$source = Param::get('source');
$destination = Param::get('destination');
$date = Param::get('date');
$shippingID = Param::get('shippingID');
$stat = Param::get('stat');

if ($shippingID != '' && $stat != '' && $date != '') {
    include 'database.php';
    $sql = "SELECT status FROM shipping WHERE shippingID = '" . $shippingID . "'";
    $stmt = sqlsrv_query($conn, $sql, array(), array("Scrollable" => "buffered"));
    if (sqlsrv_fetch($stmt)) {
        $sqlUpdate = "UPDATE shipping SET status = '$stat' WHERE shippingID = '$shippingID' AND source = '$source' AND destination = '$destination' AND date = '$date'";
        $saveData = sqlsrv_query($conn, $sqlUpdate);
        if ($saveData === false) {
            die(print_r(sqlsrv_errors(), true));
        } else {
            ?>
            <script>
                alert('Status Updated Successfully!!!');
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert('Invalid!!!');
            window.location = 'shipping';
        </script>
        <?php
    }
}

?>
    <style>
        .ui.header {
            padding-top: 1em;
        }
    </style>

    <div class="ui vertical stripe quote segment">
        <div class="ui equal width stackable internally celled grid">
            <div class="ui middle aligned stackable grid container">
                <div class="row">
                    <div class="five wide column">
                        <h1 class="ui header">Update Shipping</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="five wide column">
                        <div class="ui sticky">
                            <form class="ui form segment">
                                <div class="field">
                                    <label>Shipping ID</label>
                                    <div class="ui left input">
                                        <input id="ShipID" type="text" name="shippingID"/>
                                    </div>
                                </div>
                                <div class="field">
                                    <label>Source</label>
                                    <select name="source" class="ui search dropdown fluid">
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Japan">Japan</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label>Destination</label>
                                    <select name="destination" class="ui search dropdown fluid">
                                        <option value="Japan">Japan</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Malaysia">Malaysia</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label>Date</label>
                                    <div class="ui left input">
                                        <input type="date" name="date" class="ui input fluid"
                                               min="<?php echo htmlspecialchars($minTime); ?>"
                                               value="<?php echo htmlspecialchars($minTime); ?>"/>
                                    </div>
                                </div>
                                <div class="field">
                                    <label>Status</label>
                                    <select name="stat" class="ui search dropdown fluid">
                                        <option value="Transit">Transit</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>
                                </div>
                                <button type="submit" class="ui fluid large primary submit button">Update Status
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php
sqlsrv_free_stmt($stmt);
sqlsrv_free_stmt($saveData);
sqlsrv_close($conn);