<?php
if (isset($_REQUEST['btnLogout'])) {
    session_unset();
    session_destroy();
    header("location: ../login.php");
}
?>