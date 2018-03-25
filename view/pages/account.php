<?php
//Access Control
if ($_SESSION['position'] != "member") {
    header('Location: error403');
    exit();
}

date_default_timezone_set("Asia/Kuala_Lumpur");
$minTime = date('Y-m-d', time());
$password = Param::get('password');
$ID = $_SESSION['ID'];
$name = $_SESSION['fullname'];
include 'database.php';

if ($password != '') {
    $password = hash('sha256', $password);
    $sqlUpdate = "UPDATE member SET password = '$password' WHERE ID = '$ID'";
    ?>
    <script>
        alert('<?php echo $sqlUpdate; ?>');
    </script>
    <?php
    $saveData = sqlsrv_query( $conn, $sqlUpdate, array(), array("Scrollable" => "buffered"));
    if( $saveData === false ) {
        die( print_r( sqlsrv_errors(), true));
        ?>
        <script>
            alert('Wrong Password!!!');
        </script>
        <?php
    }
    ?>
    <script>
        alert('Update successful!!!');
    </script>
    <?php
} elseif ($username != '' && $user != $username) {
    $error = true;
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
            <div class="ten wide column">
                <h1 class="ui header">Member Profile</h1>
            </div>
        </div>
        <div class="row">
            <div class="seven wide column">
                <div class="ui sticky">
                    <form class="ui form segment">
                        <div class="field">
                            <label>Member ID</label>
                            <div class="ui left input">
                                <label><?php echo $ID; ?></label>
                            </div>
                        </div>
                        <div class="field">
                            <label>Name</label>
                            <div class="ui left input">
                                <label><?php echo $name; ?></label>
                            </div>
                        </div>
                        <br>
                        <div class="field">
                            <label>New Password</label>
                            <div class="ui left input">
                                <input name="password" class="form-control" type="password" placeholder="New Password" />
                            </div>
                        </div>
                        <button type="submit" class="ui fluid large primary submit button">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>