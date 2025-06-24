<?php
session_start();
session_unset();
session_destroy();
require_once(__DIR__ . "/functions.php");
redirectTo("index.php");
?>