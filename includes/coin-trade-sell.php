<?php

include_once("config.php");
include_once("secure.php");
include_once("functions.php");

if (isset($_POST['sell_submit'])) {
    $sold_currency_id = $_POST['SELL_sold_currency'];
    $sold_currency_amount = $_POST['SELL_sold_currency_amount'];
    $bought_currency_id = $_POST['SELL_bought_currency'];
    $bought_currency_amount = $_POST['SELL_bought_currency_amount'];
    $price_per = $_POST['SELL_price_per'];
    $value_btc = -1;
    $value_usd = $_POST['value_usd_SELL'];
    $value_zar = $_POST['value_zar_SELL'];
    $user_id = $_SESSION['userid'];
    $date_time = $_POST['date_time_SELL'];
    $mainCoin = $_POST['SELL_bought_currency'];

    $sql = "INSERT INTO trade (type, bought_currency_id, bought_currency_amount, sold_currency_id, sold_currency_amount, price_per, value_btc, value_usd, value_zar, user_id, date_time, currency_id)
                    VALUE ('sell','$bought_currency_id','$bought_currency_amount','$sold_currency_id','$sold_currency_amount', '$price_per', '$value_btc', '$value_usd', '$value_zar','$user_id', '$date_time', '$mainCoin');";
    mysqli_query($conn, $sql) or die("insertTrade sell failed!");

    mysqli_close($conn);
    header("location: ../trades.php?coin_id=$bought_currency_id&coin_spent=$sold_currency_id&trade_type=sell&trade=success");
    exit();

} else {
    header("location: ../trades.php?coin_id=$bought_currency_id&coin_spent=$sold_currency_id&trade_type=sell&trade=error");
    exit();
}