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
if ($_SESSION['position'] != "staff") {
    header('Location: error403');
    exit();
}

include 'database.php';
//Get Member
$sql = "SELECT * FROM member";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    ?>
    <div class="ui vertical stripe segment">
        <div class="ui top aligned stackable grid container">
            <div class="row">
                <div class="ten wide column">
                    <h1 class="ui header">No Member</h1>
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
                    <h1 class="ui header">Member Details</h1>
                </div>
            </div>
            <div class="row">
                <div class="eleven wide column">
                    <table class="ui celled table selectable">
                        <thead>
                        <tr>
                            <th>Member ID</th>
                            <th>Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><?php echo $row['ID']; ?></td>
                                <td><?php echo $row['name']; ?></td>
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