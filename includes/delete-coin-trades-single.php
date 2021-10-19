<?php
include_once("config.php");
include_once("secure.php");
include_once("functions.php");

$trade_id = $_REQUEST['trade_id'];
$coin_id = $_REQUEST['coin_id'];
$userID = $_SESSION['userid'];
delete_coin_single($trade_id,$userID,$conn);
// trades.php?coin_id=2&coin_spent=201
header("location: ../trades.php?coin_id=$coin_id&coin_spent=201");
exit();
