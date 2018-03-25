<?php
//Access Control
if (isset($_SESSION['username'])) {
    header('Location: member');
    exit();
}
?>
<?php
$username = Param::get('username');
$fullname = Param::get('fullname');
$password = Param::get('password');

if ($username != '' & $fullname != '' & $password != '') {
    $username = strtoupper($username);
    $fullname = strtoupper($fullname);
    $password = hash('sha256', $password);

    include 'database.php';

    //Check DB for existing user
    $sql = "SELECT username FROM member WHERE username = '" . $username . "'";
    //  $stmt = sqlsrv_query($conn, $sql);
    $stmt = sqlsrv_query($conn, $sql, array(), array("Scrollable" => "buffered"));

    if (sqlsrv_fetch($stmt)) {
        $error = true;
    } else {
        $sqlInsert = "INSERT into member(name,username,password) values ('" . $fullname . "','" . $username . "','" . $password . "')";

        $saveData = sqlsrv_query($conn, $sqlInsert);
        if ($saveData === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        ?>
        <script>
            alert('Register successful!!!');
        </script>
        <?php
        header('Location: login');
        exit();
    }
}
?>

<div class="ui middle center aligned stackable grid">
    <div class="column five wide">
        <h2 class="ui primary image header">
            <img src="/img/logo.png" class="image"/>
            <div class="content">
                New Account
            </div>
        </h2>
        <form class="ui form segment">
            <div class="field">
                <div class="ui left input">
                    <input type="text" name="fullname" placeholder="Full Name"/>
                </div>
            </div>
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
            <button type="submit" class="ui secondary basic button">Register</button>
            <div class="ui message error" <?php if ($error == true) echo 'style="display:block"'; ?>>
                <?php
                if ($error == true) {
                    echo "<li>Sorry, the username has already been taken</li>";
                    $error = false;
                }
                ?>
            </div>
        </form>
        <br>
    </div>
</div>