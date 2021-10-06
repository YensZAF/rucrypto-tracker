<?php

if (isset($_POST['submit'])) {

    $username = $_POST['uid'];
    $pwd = $_POST['pwd'];

    require_once 'config.php';
    require_once 'functions.php';

    loginUser($conn, $username, $pwd);

} else {
    header("location: ../login");
    exit();
}

?>