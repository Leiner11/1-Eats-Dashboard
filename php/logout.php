<?php
session_start();
session_destroy();
header("Location:../Login/loginPage.php");
exit;
?>
