<?php
include_once("config.php");
include_once("secure.php");
include_once("functions.php");

$coin_id = $_REQUEST['coin_id'];
$userID = $_SESSION['userid'];
delete_coin($coin_id,$userID,$conn);

header("location: ../portfolio.php");
exit();
