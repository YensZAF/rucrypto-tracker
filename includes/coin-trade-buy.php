<?php

include_once("config.php");
include_once("secure.php");
include_once("functions.php");

if (isset($_POST['buy_submit'])) {
    $sold_currency_id = $_POST['BUY_sold_currency'];
    $sold_currency_amount = $_POST['BUY_sold_currency_amount'];
    $bought_currency_id = $_POST['BUY_bought_currency'];
    $bought_currency_amount = $_POST['BUY_bought_currency_amount'];
    $value_coin = $_POST['BUY_price_per'];
    $value_btc = 1;
    $value_usd = $_POST['value_usd'];
    $value_zar = $_POST['value_zar'];
    $user_id = $_SESSION['userid'];
    $date_time = $_POST['date_time'];

    $sql = "INSERT INTO trade (type, bought_currency_id, bought_currency_amount, sold_currency_id, sold_currency_amount, value_coin, value_btc, value_usd, value_zar, user_id, date_time)
                    VALUE ('buy','$bought_currency_id','$bought_currency_amount','$sold_currency_id','$sold_currency_amount', '$value_coin', '$value_btc', '$value_usd', '$value_zar','$user_id', '$date_time');";
    mysqli_query($conn, $sql) or die("insertTrade buy failed!");

    mysqli_close($conn);
    header("location: ../trades.php?coin_id=$bought_currency_id&coin_spent=$sold_currency_id&trade=success");
    exit();

} else {
    header("location: ../trades.php?coin_id=$bought_currency_id&coin_spent=$sold_currency_id&trade=error");
    exit();
}