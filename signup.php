<?php
require_once "config.php";

if (isset($_SESSION["user_id"])) {
    header("Location: dashboard.php");
    exit;
}

include "header.php";
?>