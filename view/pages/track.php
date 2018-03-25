<style>
    .ui.header {
        padding-top: 1em;
    }
</style>
<?php
$searchNumber = Param::get('searchNumber');
if ($searchNumber != '') {

    include 'database.php';
    $sql = "SELECT booking.ID, booking . shippingID, shipping .source , shipping .destination , shipping . status FROM booking JOIN shipping ON (shipping . shippingID = booking . shippingID) WHERE booking.ID = '" . $searchNumber . "'";
    $stmt = sqlsrv_query($conn, $sql);
    if (sqlsrv_fetch($stmt)) {
        $source = sqlsrv_get_field($stmt, 2);
        $destination = sqlsrv_get_field($stmt, 3);
        $status = sqlsrv_get_field($stmt, 4);
    } else {
        ?>
        <script>
            alert('Enter a valid booking ID');
        </script>
        <?php
    }
}
?>

<div class="ui vertical stripe quote segment">
    <div class="ui equal width stackable internally celled grid">
        <div class="ui middle aligned stackable grid container">
            <div class="row">
                <div class="one wide right floated column column">
                </div>
                <img src="/img/track.png" class="ui rounded image">
                <div class="nine wide left floated column">
                    <h1>Track Booking</h1>
                    <div class="internal">
                        <form class="ui form segment">
                            <div class="field">
                                <div class="ui input">
                                    <input id="shipmentId" name="searchNumber"
                                           placeholder="Booking no." maxlength="10"
                                           class="form-control" type="text" required>
                                </div>
                                <button type="submit"
                                        class="ui secondary basic button">
                                    Track My Booking
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if ($source != '') {
    ?>
    <br>
    <div class="ui vertical stripe segment">
        <div class="ui top aligned stackable grid container">
            <div class="row">
                <div class="four wide right floated column column">
                </div>
                <div class="nine wide left floated column column">
                    <div class="row">
                        <div class="ten wide column">
                            <h1 class="ui header">Result</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="eleven wide column">
                            <table class="ui celled table selectable">
                                <thead>
                                <tr>
                                    <th> ID</th>
                                    <th> Source</th>
                                    <th> Destination</th>
                                    <th> Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><?php echo $searchNumber; ?></td>
                                    <td><?php echo $source; ?></td>
                                    <td><?php echo $destination; ?></td>
                                    <td><?php echo $status; ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>