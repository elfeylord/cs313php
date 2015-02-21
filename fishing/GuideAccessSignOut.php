<?php

session_start();
unset($_SESSION['g_username']);

header("Location: GuideAccess.php");
die();
?>