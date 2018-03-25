<div class="ui large bottom fixed menu" style="background-color: orange;">
    <?php if (isset($_SESSION['username'])) {
        if ($_SESSION['position'] == "admin") {
            require_once(__DIR__ . '/nav_admin.php');
        }else if ($_SESSION['position'] == "staff") {
            require_once(__DIR__ . '/nav_staff.php');
        } else {
            require_once(__DIR__ . '/nav_member.php');
        }
    } else {
        require_once(__DIR__ . '/nav_public.php');
    }
    ?>
</div>