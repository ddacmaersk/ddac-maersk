<?php
//Access Control
if ($_SESSION['position'] != "member") {
    header('Location: error403');
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");
include 'database.php';
$now = date('Y-m-d', time());

$noBook = false;
$availableBooking = false;
// for saving
$source = Param::get('source');
$destination = Param::get('destination');

if ($source != '' && $source != $destination) {
    $final = date('Y-m-d',strtotime('+1 month', strtotime($now)));
    $sql = "SELECT * FROM shipping WHERE source = '" . $source . "' AND destination = '" . $destination . "' AND date >= '". $now ."' AND date <= '" . $final . "'";
    $stmtBooking = sqlsrv_query($conn, $sql, array(), array("Scrollable" => "buffered"));
    $haveBooking = sqlsrv_num_rows($stmtBooking);
    if ($haveBooking != 0) {
        $availableBooking = true;
    } else {
        $noBook = true;
    }
} elseif ($source != '' && $source == $destination) {
    ?>
    <script>
        alert('Destination and Source can not be the same!!!');
        window.location = 'booking';
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
                <h1 class="ui header">Booking Date</h1>
            </div>
            <?php
            if ($availableBooking == true) {
                ?>
                <div class="ten wide column">
                    <h1 class="ui header">Available</h1>
                </div>
                <?php
            }
            if ($noBook == true) {
                ?>
                <div class="ten wide column">
                    <h1 class="ui header">No Schedule Yet Until <?php echo $final; ?></h1>
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
                        <button type="submit" class="ui fluid large primary submit button">Choose</button>
                    </form>
                </div>
            </div>
            <?php
            if ($availableBooking == true) {
                $num = 1;
                ?>
                <div class="ten wide column">
                    <table class="ui celled table selectable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Shipping Date</th>
                            <th>Source</th>
                            <th>Destination</th>
                            <th>Warehouse</th>
                            <th> </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = sqlsrv_fetch_array($stmtBooking, SQLSRV_FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?php echo $num; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo $row['source']; ?></td>
                                <td><?php echo $row['destination']; ?></td>
                                <td><?php echo $row['warehouse']; ?></td>
                                <td>
                                    <form action='AddBooking?shippingID=<?php echo $row['shippingID']; ?>' method="post">
                                        <input type="submit" name="submit" value="Choose">
                                    </form>
                                </td>
                            </tr>
                            <?php
                            $num = $num + 1;
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