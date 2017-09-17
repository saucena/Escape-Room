<?php
require_once "random_compat-2.0.10/lib/random.php";

session_start();
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
?>