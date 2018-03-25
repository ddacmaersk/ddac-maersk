<?php
//Access Control
if ($_SESSION['position'] != "admin") {
    header('Location: error403');
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");
include 'database.php';
$TodayDate = date('Y-m-d', time());

$upcomingSchedule = true;
$sqlSchedule = "SELECT * FROM shipping where date >= '" . $TodayDate . "'";
$stmtSchedule = sqlsrv_query($conn, $sqlSchedule, array(), array( "Scrollable" => 'static' ));
$haveSchedule = sqlsrv_num_rows($stmtSchedule);

if ($haveSchedule == 0) {
    $upcomingSchedule = false;
}
$minTime = date('Y-m-d', time());
$source = Param::get('source');
$destination = Param::get('destination');
$date = Param::get('date');
$warehouse = Param::get('warehouse');

if ($source != $destination && $date != '') {

    $sql = "SELECT * FROM shipping WHERE date = '" . $date . "'";
    $stmt = sqlsrv_query($conn, $sql, array(), array("Scrollable" => "buffered"));
    $total = sqlsrv_num_rows($stmt);

    $sqlInsert = "INSERT into shipping(source,destination,date,warehouse,status) values ('" . $source . "','" . $destination . "','" . $date . "','" . $warehouse . "','Pending')";
    $saveData = sqlsrv_query($conn, $sqlInsert);
    if ($saveData === false) {
        ?>
        <script>
            alert('Error adding schedule!!!');
        </script>
        <?php
    }

} elseif ($source != '' && $source == $destination) {
    ?>
    <script>
        alert('Destination need to be different from Source!!!');
        window.location = 'schedule';
    </script>
    <?php
}
?>

<style>
    #container {
        width: 100%;
        display: inline-block;
        position: relative;
    }
    #container:after {
        padding-top: 206.26%;
        display: block;
        content: '';
    }
    #container > div {
        position: absolute !important;
    }
</style>

<div class="ui vertical stripe segment">
    <div class="ui top aligned stackable grid container">
        <div class="row">
            <div class="five wide column">
                <h1 class="ui header">Schedule</h1>
            </div>
            <?php
            if ($upcomingSchedule == true) {
                ?>
                <div class="five wide column">
                    <h1 class="ui header">Schedule</h1>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="row">
            <div class="five wide column">
                <div class="ui sticky">
                    <form class="ui form segment">
                        <div class="field">
                            <label>Shipping Source</label>
                            <select name="source" class="ui search dropdown fluid">
                                <option value="Malaysia">Malaysia</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Japan">Japan</option>
                            </select>
                        </div>
                        <div class="field">
                            <label>Shipping Destination</label>
                            <select name="destination" class="ui search dropdown fluid">
                                <option value="Japan">Japan</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Malaysia">Malaysia</option>
                            </select>
                        </div>
                        <div class="field">
                            <label>Warehouse</label>
                            <select name="warehouse" class="ui search dropdown fluid">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                        </div>
                        <div class="field">
                            <label>Shipping Date</label>
                            <input type="date" name="date" class="ui input fluid"
                                   min="<?php echo htmlspecialchars($minTime); ?>"
                                   value="<?php echo htmlspecialchars($minTime); ?>"/>
                        </div>
                        <button type="submit" class="ui fluid large primary submit button">Add</button>
                    </form>
                </div>
            </div>
            <?php
            if ($upcomingSchedule == true) {
                ?>
                <div class="ten wide column">
                    <table class="ui celled table selectable">
                        <thead>
                        <tr>
                            <th> Shipping Date</th>
                            <th> Source</th>
                            <th> Destination</th>
                            <th> Warehouse</th>
                            <th> Shipping ID</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = sqlsrv_fetch_array($stmtSchedule, SQLSRV_FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo $row['source']; ?></td>
                                <td><?php echo $row['destination']; ?></td>
                                <td><?php echo $row['warehouse']; ?></td>
                                <td><?php echo $row['shippingID']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>