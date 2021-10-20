<?php
include_once("config.php");
include_once("secure.php");
include_once("functions.php");

if (isset($_POST['submit_delete'])) {
    $userID = $_SESSION['userid'];
    
    $sql = "DELETE FROM rucrypto.user
            WHERE user_id='$userID';";
    mysqli_query($conn, $sql) or die("Cant DELETE user");

    $sql = "DELETE FROM rucrypto.trade
            WHERE user_id='$userID';";
    mysqli_query($conn, $sql) or die("Cant DELETE trade");

    $sql = "DELETE FROM rucrypto.watch_list
            WHERE watch_list_id='$userID';";
    mysqli_query($conn, $sql) or die("Cant DELETE watch_list");

    $sql = "DELETE FROM rucrypto.watch_list_has_cryptocurrency
            WHERE watch_list_id='$userID';";
    mysqli_query($conn, $sql) or die("Cant DELETE watch_list_has_cryptocurrency");

    session_unset();
    session_destroy();
    header("location: ../index.php");
    exit();
}

header("location: ../settings.php?error=yes");
exit();
