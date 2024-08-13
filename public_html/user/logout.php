<?php
session_start();
session_unset();
session_destroy();
header("Location: /EventVersee/public_html/index.php");
exit;
?>
