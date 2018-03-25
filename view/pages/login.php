<?php
//Access Control
if (isset($_SESSION['username'])) {
    header('Location: member');
    exit();
}
?>
<?php
//Validate login
$username = Param::get('username');
$password = Param::get('password');
$position = Param::get('position');

if ($username != '' & $password != '') {
    include 'database.php';
    $password = hash('sha256', $password);
    $username = strtoupper($username);

    //member login
    if ($position == "member"){
        //Check DB
        $sql = "SELECT ID,name,username FROM member WHERE username = '" . $username . "' AND password = '" . $password . "'";
        //  $stmt = sqlsrv_query($conn, $sql);
        $stmt = sqlsrv_query($conn, $sql, array(), array("Scrollable" => "buffered"));

        if (sqlsrv_fetch($stmt)) {
            $try = sqlsrv_num_rows($stmt);
            if ($try == 1) {
                $_SESSION['ID'] = sqlsrv_get_field($stmt, 0);
                $_SESSION['fullname'] = sqlsrv_get_field($stmt, 1);
                $_SESSION['username'] = sqlsrv_get_field($stmt, 2);
                $_SESSION['position'] = "member";
                header('Location: member');
                exit();
            } else {
                ?>
                <script>
                    alert('Error occured!!!');
                </script>
                <?php
            }
        } else {
            $error = true;
        }
    }

    //staff login
    if ($position == "staff"){
        //Check DB
        $sql = "SELECT ID,name,username,position FROM staff WHERE username = '" . $username . "' AND password = '" . $password . "'";
        //  $stmt = sqlsrv_query($conn, $sql);
        $stmt = sqlsrv_query($conn, $sql, array(), array("Scrollable" => "buffered"));

        if (sqlsrv_fetch($stmt)) {
            $try = sqlsrv_num_rows($stmt);
            if ($try == 1) {
                $_SESSION['StaffID'] = sqlsrv_get_field($stmt, 0);
                $_SESSION['fullname'] = sqlsrv_get_field($stmt, 1);
                $_SESSION['username'] = sqlsrv_get_field($stmt, 2);
                $_SESSION['position'] = sqlsrv_get_field($stmt, 3);
                if ($_SESSION['position'] == "admin") {
                    header('Location: schedule');
                    exit();
                } else {
                    header('Location: shipping');
                    exit();
                }

            } else {
                ?>
                <script>
                    alert('Error occured!!!');
                </script>
                <?php
            }
        } else {
            $error = true;
        }
    }

}
?>

<div class="ui middle center aligned stackable grid">
    <div class="column five wide">
        <h2 class="ui primary image header">
            <img src="/img/logo.png" class="image"/>
            <div class="content">
                Maersk Line Login
            </div>
        </h2>
        <form class="ui form segment">
            <div class="field">
                <div class="ui left input">
                    <input type="text" name="username" placeholder="Username"/>
                </div>
            </div>
            <div class="field">
                <div class="ui left input">
                    <input type="password" name="password" placeholder="Password"/>
                </div>
            </div>
            <div class="field">
                <select name="position" class="ui search dropdown fluid">
                    <option value="member">Member</option>
                    <option value="staff">Staff</option>
                </select>
            </div>
            <button type="submit" class="ui secondary basic button">Log In</button>
            <div class="ui message error" <?php if ($error == true) echo 'style="display:block"'; ?>>
                <?php
                if ($error == true) {
                    echo "<li>Invalid username or password</li>";
                    $error = false;
                }
                ?>
            </div>
        </form>
        <br>
    </div>
</div>