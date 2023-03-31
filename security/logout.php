<?php
session_start();
?>
<!DOCTYPE html>
<html>

<body>

    <?php
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();
    setcookie("token", "", time() - 60, "/", "", 0);
    setcookie("name", "", time() - 60, "/", "", 0);
    header("Location: /sanarate/index.php");

    ?>

</body>

</html>