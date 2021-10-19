<?php include_once("includes/config.php");
      include_once("includes/secure.php");
      include_once("includes/functions.php"); 

  $spentCoinName = "";
  $spentCoinPic = "";
  $spentCoinSymbol = "";
  $spentCoinUID = "";
  $spentCoinID = "";
  if (isset($_GET['coin_spent'])) {
    $spentCoin = $_GET['coin_spent'];
    $sql = "SELECT *
            FROM cryptocurrency
            WHERE currency_id = '$spentCoin';";
    $spentCoin = mysqli_query($conn, $sql) or die("fetchMainCoin failed!");
    while ($row = mysqli_fetch_array($spentCoin)) {
      $spentCoinName = $row['currency_name'];
      $spentCoinPic = $row['currency_pic'];
      $spentCoinSymbol = $row['currency_symbol'];
      $spentCoinUID = $row['currency_uid'];
      $spentCoinID = $row['currency_id'];
    }
  }
  $mainCoinName = "";
  $mainCoinPic = "";
  $mainCoinSymbol = "";
  $mainCoinUID = "";
  $mainCoinID = "";
  if (isset($_GET['coin_id'])) {
    $mainCoin = $_GET['coin_id'];
    $sql = "SELECT *
            FROM cryptocurrency
            WHERE currency_id = '$mainCoin';";
    $mainCoin = mysqli_query($conn, $sql) or die("fetchMainCoin failed!");
    while ($row = mysqli_fetch_array($mainCoin)) {
      $mainCoinName = $row['currency_name'];
      $mainCoinPic = $row['currency_pic'];
      $mainCoinSymbol = $row['currency_symbol'];
      $mainCoinUID = $row['currency_uid'];
      $mainCoinID = $row['currency_id'];
    }
  }              
      
      ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once("includes/head-contents.php"); ?>
</head>
<body>

<?php include_once("includes/navigation.php"); ?>

<h2><?php echo $CURRENT_PAGE ?></h2>

<!-- FLEX CONTAINER -->
<div class="lg:flex md:justify-center block flex-none">

<div class="lg:flex-initial lg:mr-5 flex-none">
<!-- Trades Tabs BUY SELL https://www.creative-tim.com/learning-lab/tailwind-starter-kit/documentation/javascript/tabs/icons -->
<div class="flex flex-wrap" id="tabs-id">
  <div class="max-w-md mx-auto">
    <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
      <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
        <a id="buy" class="<?php if (isset($_GET['trade_type'])) { ?>text-green-600 bg-white<?php } else { ?>text-white bg-green-600<?php }  ?> text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal cursor-pointer" onclick="changeAtiveTab(event,'tab-profile','buy')">
          <i class="fa fa-level-up text-base mr-1"></i>  Buy
        </a>
      </li>
      <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
        <a id="sell" class="<?php if (isset($_GET['trade_type'])) { ?>text-white bg-red-600<?php } else { ?>text-red-600 bg-white<?php }  ?> text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal cursor-pointer" onclick="changeAtiveTab(event,'tab-settings','sell')">
          <i class="fa fa-level-down text-base mr-1"></i>  Sell
        </a>
      </li>
    </ul>
    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
      <div class="px-4 py-5 flex-auto">
        <div class="tab-content tab-space">
          <!-- BUY TAB -->
          <div id="tab-profile" class="w-full max-w-xs <?php if (isset($_GET['trade_type'])) { ?>hidden<?php } else { ?>block<?php }  ?>">
            <form action="includes/coin-trade-buy.php" method="post">
              <div class="mb-4 flex justify-center">
                <span class="flex text-gray-700 text-lg font-bold mb-2 uppercase">BUY  
                <?php
                  if ($mainCoinUID !== "") {
                      ?>
                      <img src="<?php echo $mainCoinPic; ?>" alt="<?php echo $mainCoinName; ?>" class="w-8 mx-2">
                      <?php
                      echo $mainCoinName;
                    }
                ?>
                </span>
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="BUY_sold_currency">
                  Price Per Coin
                </label>
                <button type="submit" id="submit" name="submit" class="modal-open flex items-center justify-center focus:outline-none text-gray text-sm sm:text-base bg-white hover:bg-gray-300 rounded py-1 w-full transition duration-150 ease-in border-solid border-2 border-gray-300">
                  
                    <?php
                      if ($spentCoinUID !== "") {
                      ?>
                          <span class="pr-2 uppercase">
                            <img src="<?php echo $spentCoinPic; ?>" alt="<?php echo $spentCoinName; ?>" class="w-7">
                          </span>
                          <span class="pr-3 uppercase">
                           <?php echo $spentCoinName; ?> 
                          </span>
                          <input type="hidden" name="BUY_sold_currency" value="<?php echo $spentCoinID; ?>" />
                        <?php
                      } else {
                          ?>
                          <span class="mr-2 uppercase">$ USD</span>
                          <input type="hidden" name="BUY_sold_currency" value="201">
                          <?php
                      }
                    ?>
                  
                </button>
                <div class="mt-1 relative rounded-md shadow-sm">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm uppercase">
                      <?php
                        if ($spentCoinUID !== "") {
                            echo $spentCoinSymbol;
                        }
                      ?>
                    </span>
                  </div>
                  <input type="text" name="BUY_price_per" id="BUY_price_per" class="block w-full pl-16 py-2 shadow appearance-none border rounded text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="0.00">
                </div>
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="BUY_bought_currency_amount">
                  Quantity
                </label>
                <div class="mt-1 relative rounded-md shadow-sm">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm uppercase">
                      <?php
                        if ($mainCoinUID !== "") {
                            echo $mainCoinSymbol;
                        }
                      ?>
                    </span>
                  </div>
                  <input type="text" name="BUY_bought_currency_amount" id="BUY_bought_currency_amount" class="block w-full pl-16 py-2 shadow appearance-none border rounded text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="1">
                  <input type="hidden" name="BUY_bought_currency" value="<?php echo $mainCoinID; ?>">
                </div>
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="value_usd">
                  Total Spent
                </label>
                <div class="mt-1 relative rounded-md shadow-sm">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-900 sm:text-sm uppercase">
                      <?php
                        if ($spentCoinUID !== "") {
                            echo $spentCoinSymbol;
                        }
                      ?>
                    </span>
                  </div>
                  <input type="text" name="BUY_sold_currency_amount" id="BUY_sold_currency_amount" class="cursor-not-allowed block w-full pl-16 py-2 shadow appearance-none border rounded text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline" placeholder="0">
                </div>
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="value_usd">
                  Trade Price Today
                </label>
                <div class="flex">
                  <input class="flex-initial justify-self-start cursor-not-allowed shadow appearance-none border rounded w-1/2 mr-3 py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline" id="value_usd" name="value_usd" type="text" placeholder="$ 0.00">
                  <input class="flex-initial justify-self-end cursor-not-allowed shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline" id="value_zar" name="value_zar" type="text" placeholder="R 0.00">
                </div>
              </div>
              <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="date_time">
                  Date
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="date_time" name="date_time" type="datetime-local" value="2000-00-00T00:00" max="2000-00-00T00:00" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}" required>
              </div>
              <div class="flex items-center justify-center">
                <input class="bg-green-500 hover:bg-green-700 text-white font-bold w-full py-2 px-4 rounded focus:outline-none focus:shadow-outline uppercase" type="submit" name="buy_submit" value="buy">    
                <!-- <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                  Forgot Password?
                </a> -->
              </div>
            </form>
          </div>
          <!-- BUY TAB END -->

          <!-- SELL TAB -->
          <div id="tab-settings" class="w-full max-w-xs <?php if (isset($_GET['trade_type'])) { ?>block<?php } else { ?>hidden<?php }  ?>">
            <form action="includes/coin-trade-sell.php" method="post">
              <div class="mb-4 flex justify-center">
                <span class="flex text-gray-700 text-lg font-bold mb-2 uppercase">SELL  
                <?php
                  if ($mainCoinUID !== "") {
                      ?>
                      <img src="<?php echo $mainCoinPic; ?>" alt="<?php echo $mainCoinName; ?>" class="w-8 mx-2">
                      <?php
                      echo $mainCoinName;
                    }
                ?>
                </span>
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="SELL_sold_currency">
                  Price Per Coin
                </label>
                <button type="submit" id="submit" name="submit" class="modal-open2 modal-open flex items-center justify-center focus:outline-none text-gray text-sm sm:text-base bg-white hover:bg-gray-300 rounded py-1 w-full transition duration-150 ease-in border-solid border-2 border-gray-300">
                  
                    <?php
                      if ($spentCoinUID !== "") {
                      ?>
                          <span class="pr-2 uppercase">
                            <img src="<?php echo $spentCoinPic; ?>" alt="<?php echo $spentCoinName; ?>" class="w-7">
                          </span>
                          <span class="pr-3 uppercase">
                           <?php echo $spentCoinName; ?> 
                          </span>
                          <input type="hidden" name="SELL_sold_currency" value="<?php echo $spentCoinID; ?>" />
                        <?php
                      } else {
                          ?>
                          <span class="mr-2 uppercase">$ USD</span>
                          <input type="hidden" name="SELL_sold_currency" value="201">
                          <?php
                      }
                    ?>
                  
                </button>
                <div class="mt-1 relative rounded-md shadow-sm">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm uppercase">
                      <?php
                        if ($spentCoinUID !== "") {
                            echo $spentCoinSymbol;
                        }
                      ?>
                    </span>
                  </div>
                  <input type="text" name="SELL_price_per" id="SELL_price_per" class="block w-full pl-16 py-2 shadow appearance-none border rounded text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="0.00">
                </div>
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="SELL_bought_currency_amount">
                  Quantity
                </label>
                <div class="mt-1 relative rounded-md shadow-sm">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm uppercase">
                      <?php
                        if ($mainCoinUID !== "") {
                            echo $mainCoinSymbol;
                        }
                      ?>
                    </span>
                  </div>
                  <input type="text" name="SELL_bought_currency_amount" id="SELL_bought_currency_amount" class="block w-full pl-16 py-2 shadow appearance-none border rounded text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="1">
                  <input type="hidden" name="SELL_bought_currency" value="<?php echo $mainCoinID; ?>">
                </div>
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="SELL_sold_currency">
                  Total Recieved
                </label>
                <div class="mt-1 relative rounded-md shadow-sm">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-900 sm:text-sm uppercase">
                      <?php
                        if ($spentCoinUID !== "") {
                            echo $spentCoinSymbol;
                        }
                      ?>
                    </span>
                  </div>
                  <input type="text" name="SELL_sold_currency_amount" id="SELL_sold_currency_amount" class="cursor-not-allowed block w-full pl-16 py-2 shadow appearance-none border rounded text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline" placeholder="0">
                </div>
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="value_usd">
                  Trade Price Today
                </label>
                <div class="flex">
                  <input class="flex-initial justify-self-start cursor-not-allowed shadow appearance-none border rounded w-1/2 mr-3 py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline" id="value_usd_SELL" name="value_usd_SELL" type="text" placeholder="$ 0.00">
                  <input class="flex-initial justify-self-end cursor-not-allowed shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline" id="value_zar_SELL" name="value_zar_SELL" type="text" placeholder="R 0.00">
                </div>
              </div>
              <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="date_time">
                  Date
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="date_time_SELL" name="date_time_SELL" type="datetime-local" value="2000-00-00T00:00" max="2000-00-00T00:00" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}" required>
              </div>
              <div class="flex items-center justify-center">
                <input class="bg-red-500 hover:bg-red-700 text-white font-bold w-full py-2 px-4 rounded focus:outline-none focus:shadow-outline uppercase" type="submit" name="sell_submit" value="sell">    
                <!-- <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                  Forgot Password?
                </a> -->
              </div>
            </form>
          </div>
           <!-- SELL TAB END -->
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<div class="lg:flex-initial flex-none">
<!-- TRADES TABLE -->
<div class="container flex justify-center mx-auto pb-10">
  <div class="border-b border-gray-200 shadow overflow-auto">
    <table class="divide-y divide-gray-300 ">
      <thead class="bg-gray-50">
          <tr>
              <th class="px-6 py-2 text-xs text-gray-500">Type</th>
              <th class="px-6 py-2 text-xs text-gray-500 text-left">Price Per
                <span class="uppercase">
                  <?php echo $mainCoinSymbol; ?>
                </span>
              </th>
              <th class="px-6 py-2 text-xs text-gray-500">Quantity</th>
              <th class="px-6 py-2 text-xs text-gray-500">Date</th>
              <th class="px-6 py-2 text-xs text-gray-500">Cost</th>
              <!-- <th class="px-6 py-2 text-xs text-gray-500">PNL</th> -->
              <th class="px-6 py-2 text-xs text-gray-500"></th>
              <th class="px-6 py-2 text-xs text-gray-500"></th>
              <th class="hidden"></th>
          </tr>
      </thead>
      <tbody id="trades_table_coin" class="bg-white divide-y divide-gray-300">

          <?php
            printTrades($_SESSION['userid'],$_GET['coin_id'],$conn);
          ?>

      </tbody>
    </table>
  </div>
</div>
<!-- TRADES TABLE END -->
</div>

</div>
<!-- END FLEX CONTAINER -->

<!-- SEARCH MODAL -->
  <!--Modal-->
  <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
    
    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
      
      <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
          <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
        </svg>
        <span class="text-sm">(Esc)</span>
      </div>

      <!-- Add margin if you want to see some of the overlay behind the modal-->
      <div class="modal-content text-left h-1/2">
        <!--Title-->
        <div class="flex justify-between items-center pb-3 px-6 py-4">
          <p class="text-2xl font-bold">Pick Coin to Use.</p>
          <div class="modal-close cursor-pointer z-50">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
          </div>
        </div>

        <!--Body-->
        <div class="rounded shadow-md mt-2 relative pin-t pin-l overflow-auto h-64">
          <div class="p-2"><input type="text" id="myInput" onkeyup="searchAddCoins()" placeholder="Search for coins.." class="border-2 rounded h-8 px-3 py-4 w-full"></div>
          <ul id="myUL" class="list-reset">
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=201" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="assets/money.png" /></span><span class="pl-3 mx-0 my-auto">US Dollar</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=202" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="assets/money.png" /></span><span class="pl-3 mx-0 my-auto">SA Rand</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=1" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1/large/bitcoin.png?1547033579" /></span><span class="pl-3 mx-0 my-auto">Bitcoin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=2" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/279/large/ethereum.png?1595348880" /></span><span class="pl-3 mx-0 my-auto">Ethereum</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=3" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/825/large/binance-coin-logo.png?1547034615" /></span><span class="pl-3 mx-0 my-auto">Binance Coin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=4" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/325/large/Tether-logo.png?1598003707" /></span><span class="pl-3 mx-0 my-auto">Tether</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=5" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/975/large/cardano.png?1547034860" /></span><span class="pl-3 mx-0 my-auto">Cardano</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=6" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/44/large/xrp-symbol-white-128.png?1605778731" /></span><span class="pl-3 mx-0 my-auto">XRP</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=7" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4128/large/coinmarketcap-solana-200.png?1616489452" /></span><span class="pl-3 mx-0 my-auto">Solana</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=8" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12171/large/aJGBjJFU_400x400.jpg?1597804776" /></span><span class="pl-3 mx-0 my-auto">Polkadot</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=9" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/5/large/dogecoin.png?1547792256" /></span><span class="pl-3 mx-0 my-auto">Dogecoin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=10" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6319/large/USD_Coin_icon.png?1547042389" /></span><span class="pl-3 mx-0 my-auto">USD Coin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=11" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8284/large/luna1557227471663.png?1567147072" /></span><span class="pl-3 mx-0 my-auto">Terra</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=12" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11939/large/shiba.png?1622619446" /></span><span class="pl-3 mx-0 my-auto">Shiba Inu</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=13" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/7598/large/wrapped_bitcoin_wbtc.png?1548822744" /></span><span class="pl-3 mx-0 my-auto">Wrapped Bitcoin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=14" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12504/large/uniswap-uni.png?1600306604" /></span><span class="pl-3 mx-0 my-auto">Uniswap</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=15" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9576/large/BUSD.png?1568947766" /></span><span class="pl-3 mx-0 my-auto">Binance USD</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=16" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2/large/litecoin.png?1547033580" /></span><span class="pl-3 mx-0 my-auto">Litecoin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=17" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12559/large/coin-round-red.png?1604021818" /></span><span class="pl-3 mx-0 my-auto">Avalanche</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=18" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/877/large/chainlink-new-logo.png?1547034700" /></span><span class="pl-3 mx-0 my-auto">Chainlink</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=19" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/780/large/bitcoin-cash-circle.png?1594689492" /></span><span class="pl-3 mx-0 my-auto">Bitcoin Cash</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=20" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4380/large/download.png?1547039725" /></span><span class="pl-3 mx-0 my-auto">Algorand</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=21" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4713/large/matic-token-icon.png?1624446912" /></span><span class="pl-3 mx-0 my-auto">Polygon</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=22" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/100/large/Stellar_symbol_black_RGB.png?1552356157" /></span><span class="pl-3 mx-0 my-auto">Stellar</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=23" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1481/large/cosmos_hub.png?1555657960" /></span><span class="pl-3 mx-0 my-auto">Cosmos</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=24" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1167/large/VeChain-Logo-768x725.png?1547035194" /></span><span class="pl-3 mx-0 my-auto">VeChain</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=25" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14495/large/Internet_Computer_logo.png?1620703073" /></span><span class="pl-3 mx-0 my-auto">Internet Computer</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=26" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13029/large/axie_infinity_logo.png?1604471082" /></span><span class="pl-3 mx-0 my-auto">Axie Infinity</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=27" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12817/large/filecoin.png?1602753933" /></span><span class="pl-3 mx-0 my-auto">Filecoin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=28" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1094/large/tron-logo.png?1547035066" /></span><span class="pl-3 mx-0 my-auto">TRON</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=29" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9956/large/dai-multi-collateral-mcd.png?1574218774" /></span><span class="pl-3 mx-0 my-auto">Dai</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=30" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/453/large/ethereum-classic-logo.png?1547034169" /></span><span class="pl-3 mx-0 my-auto">Ethereum Classic</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=31" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9026/large/F.png?1609051564" /></span><span class="pl-3 mx-0 my-auto">FTX Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=32" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10643/large/ceth2.JPG?1581389598" /></span><span class="pl-3 mx-0 my-auto">cETH</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=33" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2538/large/theta-token-logo.png?1548387191" /></span><span class="pl-3 mx-0 my-auto">Theta Network</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=34" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/976/large/Tezos-logo.png?1547034862" /></span><span class="pl-3 mx-0 my-auto">Tezos</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=35" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4001/large/Fantom.png?1558015016" /></span><span class="pl-3 mx-0 my-auto">Fantom</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=36" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3688/large/mqTDGK7Q.png?1566256777" /></span><span class="pl-3 mx-0 my-auto">Hedera</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=37" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13442/large/steth_logo.png?1608607546" /></span><span class="pl-3 mx-0 my-auto">Lido Staked Ether</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=38" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/69/large/monero_logo.png?1547033729" /></span><span class="pl-3 mx-0 my-auto">Monero</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=39" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/7310/large/cypto.png?1547043960" /></span><span class="pl-3 mx-0 my-auto">Crypto.com Coin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=40" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12335/large/elrond3_360.png?1626341589" /></span><span class="pl-3 mx-0 my-auto">Elrond</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=41" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12632/large/pancakeswap-cake-logo_%281%29.png?1629359065" /></span><span class="pl-3 mx-0 my-auto">PancakeSwap</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=42" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13446/large/5f6294c0c7a8cda55cb1c936_Flow_Wordmark.png?1631696776" /></span><span class="pl-3 mx-0 my-auto">Flow</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=43" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/738/large/eos-eos-logo.png?1547034481" /></span><span class="pl-3 mx-0 my-auto">EOS</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=44" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4463/large/okb_token.png?1548386209" /></span><span class="pl-3 mx-0 my-auto">OKB</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=45" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9281/large/cDAI.png?1576467585" /></span><span class="pl-3 mx-0 my-auto">cDAI</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=46" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9672/large/CjbT82vP_400x400.jpg?1570548320" /></span><span class="pl-3 mx-0 my-auto">Klaytn</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=47" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10365/large/near_icon.png?1601359077" /></span><span class="pl-3 mx-0 my-auto">Near</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=48" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3370/large/5ZOu7brX_400x400.jpg?1612437252" /></span><span class="pl-3 mx-0 my-auto">Quant</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=49" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12645/large/AAVE.png?1601374110" /></span><span class="pl-3 mx-0 my-auto">Aave</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=50" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13397/large/Graph_Token.png?1608145566" /></span><span class="pl-3 mx-0 my-auto">The Graph</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=51" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9442/large/Compound_USDC.png?1567581577" /></span><span class="pl-3 mx-0 my-auto">cUSDC</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=52" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/16646/large/Logo_final-22.png?1628239446" /></span><span class="pl-3 mx-0 my-auto">eCash</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=53" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/692/large/IOTA_Swirl.png?1604238557" /></span><span class="pl-3 mx-0 my-auto">IOTA</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=54" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6799/large/BSV.png?1558947902" /></span><span class="pl-3 mx-0 my-auto">Bitcoin SV</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=55" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13120/large/Logo_final-21.png?1624892810" /></span><span class="pl-3 mx-0 my-auto">Bitcoin Cash ABC</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=56" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9568/large/m4zRhP5e_400x400.jpg?1576190080" /></span><span class="pl-3 mx-0 my-auto">Kusama</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=57" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/480/large/NEO_512_512.png?1594357361" /></span><span class="pl-3 mx-0 my-auto">NEO</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=58" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/425/large/waves.png?1548386117" /></span><span class="pl-3 mx-0 my-auto">Waves</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=59" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8418/large/leo-token.png?1558326215" /></span><span class="pl-3 mx-0 my-auto">LEO Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=60" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12681/large/UST.png?1601612407" /></span><span class="pl-3 mx-0 my-auto">TerraUSD</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=61" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2069/large/Stacks_logo_full.png?1604112510" /></span><span class="pl-3 mx-0 my-auto">Stacks</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=62" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4343/large/oRt6SiEN_400x400.jpg?1591059616" /></span><span class="pl-3 mx-0 my-auto">Arweave</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=63" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12407/large/Unknown-5.png?1599624896" /></span><span class="pl-3 mx-0 my-auto">Huobi BTC</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=64" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/7595/large/BTT_Token_Graphic.png?1555066995" /></span><span class="pl-3 mx-0 my-auto">BitTorrent</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=65" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3263/large/CEL_logo.png?1609598753" /></span><span class="pl-3 mx-0 my-auto">Celsius Network</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=66" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4344/large/Y88JAze.png?1565065793" /></span><span class="pl-3 mx-0 my-auto">Harmony</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=67" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14483/large/token_OHM_%281%29.png?1628311611" /></span><span class="pl-3 mx-0 my-auto">Olympus</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=68" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12409/large/amp-200x200.png?1599625397" /></span><span class="pl-3 mx-0 my-auto">Amp</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=69" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1364/large/Mark_Maker.png?1585191826" /></span><span class="pl-3 mx-0 my-auto">Maker</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=70" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4284/large/Helium_HNT.png?1612620071" /></span><span class="pl-3 mx-0 my-auto">Helium</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=71" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12271/large/512x512_Logo_no_chop.png?1606986688" /></span><span class="pl-3 mx-0 my-auto">Sushi</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=72" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6595/large/RUNE.png?1614160507" /></span><span class="pl-3 mx-0 my-auto">THORChain</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=73" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11090/large/icon-celo-CELO-color-500.png?1592293590" /></span><span class="pl-3 mx-0 my-auto">Celo</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=74" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/776/large/OMG_Network.jpg?1591167168" /></span><span class="pl-3 mx-0 my-auto">OMG Network</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=75" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/19/large/dash-logo.png?1548385930" /></span><span class="pl-3 mx-0 my-auto">Dash</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=76" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10775/large/COMP.png?1592625425" /></span><span class="pl-3 mx-0 my-auto">Compound</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=77" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8834/large/Chiliz.png?1561970540" /></span><span class="pl-3 mx-0 my-auto">Chiliz</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=78" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/16786/large/mimlogopng.png?1624979612" /></span><span class="pl-3 mx-0 my-auto">Magic Internet Money</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=79" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3406/large/SNX.png?1598631139" /></span><span class="pl-3 mx-0 my-auto">Synthetix Network Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=80" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3348/large/Holologo_Profile.png?1547037966" /></span><span class="pl-3 mx-0 my-auto">Holo</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=81" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/486/large/circle-zcash-color.png?1547034197" /></span><span class="pl-3 mx-0 my-auto">Zcash</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=82" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/329/large/decred.png?1547034093" /></span><span class="pl-3 mx-0 my-auto">Decred</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=83" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8029/large/1_0YusgngOrriVg4ZYx4wOFQ.png?1553483622" /></span><span class="pl-3 mx-0 my-auto">Theta Fuel</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=84" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4428/large/ECOMI.png?1557928886" /></span><span class="pl-3 mx-0 my-auto">ECOMI</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=85" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/242/large/NEM_Logo_256x256.png?1598687029" /></span><span class="pl-3 mx-0 my-auto">NEM</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=86" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1102/large/enjin-coin-logo.png?1547035078" /></span><span class="pl-3 mx-0 my-auto">Enjin Coin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=87" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1060/large/icon-icx-logo.png?1547035003" /></span><span class="pl-3 mx-0 my-auto">ICON</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=88" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2912/large/xdc-icon.png?1633700890" /></span><span class="pl-3 mx-0 my-auto">XDC Network</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=89" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3449/large/tusd.png?1618395665" /></span><span class="pl-3 mx-0 my-auto">TrueUSD</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=90" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/684/large/qtum.png?1547034438" /></span><span class="pl-3 mx-0 my-auto">Qtum</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=91" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/15861/large/abracadabra-3.png?1622544862" /></span><span class="pl-3 mx-0 my-auto">Spell Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=92" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11849/large/yfi-192x192.png?1598325330" /></span><span class="pl-3 mx-0 my-auto">yearn.finance</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=93" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2822/large/huobi-token-logo.png?1547036992" /></span><span class="pl-3 mx-0 my-auto">Huobi Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=94" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1043/large/bitcoin-gold-logo.png?1547034978" /></span><span class="pl-3 mx-0 my-auto">Bitcoin Gold</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=95" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2687/large/Zilliqa-logo.png?1547036894" /></span><span class="pl-3 mx-0 my-auto">Zilliqa</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=96" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1899/large/tel.png?1547036203" /></span><span class="pl-3 mx-0 my-auto">Telcoin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=97" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/17500/large/hjnIm9bV.jpg?1628009360" /></span><span class="pl-3 mx-0 my-auto">dYdX</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=98" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2523/large/IOST.png?1557555183" /></span><span class="pl-3 mx-0 my-auto">IOST</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=99" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/15628/large/JM4_vQ34_400x400.png?1621394004" /></span><span class="pl-3 mx-0 my-auto">Mina Protocol</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=100" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12124/large/Curve.png?1597369484" /></span><span class="pl-3 mx-0 my-auto">Curve DAO Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=101" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11370/large/Bitcoin.jpg?1628072791" /></span><span class="pl-3 mx-0 my-auto">renBTC</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=102" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14362/large/174x174-white.png?1617174846" /></span><span class="pl-3 mx-0 my-auto">SafeMoon</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=103" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/16310/large/k-h6Wead_400x400.jpg?1623726134" /></span><span class="pl-3 mx-0 my-auto">Decentralized Social</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=104" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3412/large/ravencoin.png?1548386057" /></span><span class="pl-3 mx-0 my-auto">Ravencoin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=105" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/677/large/basic-attention-token.png?1547034427" /></span><span class="pl-3 mx-0 my-auto">Basic Attention Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=106" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11810/large/nexus-mutual.jpg?1594547726" /></span><span class="pl-3 mx-0 my-auto">Nexus Mutual</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=107" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1047/large/sa9z79.png?1610678720" /></span><span class="pl-3 mx-0 my-auto">KuCoin Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=108" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/878/large/decentraland-mana.png?1550108745" /></span><span class="pl-3 mx-0 my-auto">Decentraland</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=109" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3139/large/REN.png?1589985807" /></span><span class="pl-3 mx-0 my-auto">REN</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=110" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12381/large/60d18e06844a844ad75901a9_mark_only_03.png?1628674771" /></span><span class="pl-3 mx-0 my-auto">Perpetual Protocol</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=111" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3695/large/nexo.png?1548086057" /></span><span class="pl-3 mx-0 my-auto">NEXO</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=112" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11970/large/serum-logo.png?1597121577" /></span><span class="pl-3 mx-0 my-auto">Serum</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=113" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6013/large/Pax_Dollar.png?1629877204" /></span><span class="pl-3 mx-0 my-auto">Pax Dollar</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=114" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/736/large/bancor-bnt.png?1628822309" /></span><span class="pl-3 mx-0 my-auto">Bancor Network Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=115" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/289/large/siacoin.png?1548386465" /></span><span class="pl-3 mx-0 my-auto">Siacoin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=116" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/691/large/horizen.png?1555052241" /></span><span class="pl-3 mx-0 my-auto">Horizen</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=117" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13725/large/xsushi.png?1612538526" /></span><span class="pl-3 mx-0 my-auto">xSUSHI</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=118" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/863/large/0x.png?1547034672" /></span><span class="pl-3 mx-0 my-auto">0x</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=119" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/16724/large/osmo.png?1632763885" /></span><span class="pl-3 mx-0 my-auto">Osmosis</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=120" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12913/large/AudiusCoinLogo_2x.png?1603425727" /></span><span class="pl-3 mx-0 my-auto">Audius</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=121" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3447/large/ONT.png?1583481820" /></span><span class="pl-3 mx-0 my-auto">Ontology</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=122" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11621/large/cUSDT.png?1592113270" /></span><span class="pl-3 mx-0 my-auto">cUSDT</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=123" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13775/large/mdex.png?1611739676" /></span><span class="pl-3 mx-0 my-auto">Mdex</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=124" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3318/large/photo1198982838879365035.jpg?1547037916" /></span><span class="pl-3 mx-0 my-auto">NuCypher</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=125" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4379/large/Celr.png?1554705437" /></span><span class="pl-3 mx-0 my-auto">Celer Network</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=126" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13245/large/SKALE_token_300x300.png?1606789574" /></span><span class="pl-3 mx-0 my-auto">SKALE</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=127" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/63/large/digibyte.png?1547033717" /></span><span class="pl-3 mx-0 my-auto">DigiByte</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=128" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8183/large/gt.png?1556085624" /></span><span class="pl-3 mx-0 my-auto">GateToken</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=129" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4324/large/U85xTl2.png?1608111978" /></span><span class="pl-3 mx-0 my-auto">Ankr</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=130" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11871/large/Secret.png?1595520186" /></span><span class="pl-3 mx-0 my-auto">Secret</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=131" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/756/large/nano-coin-logo.png?1547034501" /></span><span class="pl-3 mx-0 my-auto">Nano</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=132" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13928/large/PSigc4ie_400x400.jpg?1612875614" /></span><span class="pl-3 mx-0 my-auto">Raydium</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=133" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10951/large/UMA.png?1586307916" /></span><span class="pl-3 mx-0 my-auto">UMA</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=134" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12129/large/sandbox_logo.jpg?1597397942" /></span><span class="pl-3 mx-0 my-auto">The Sandbox</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=135" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/16911/large/icon200x200.png?1625618542" /></span><span class="pl-3 mx-0 my-auto">Metahero</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=136" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3334/large/iotex-logo.png?1547037941" /></span><span class="pl-3 mx-0 my-auto">IoTeX</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=137" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6450/large/linklogo.png?1547042644" /></span><span class="pl-3 mx-0 my-auto">LINK</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=138" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12493/large/GALA-COINGECKO.png?1600233435" /></span><span class="pl-3 mx-0 my-auto">Gala</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=139" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/17117/large/logo.png?1626412904" /></span><span class="pl-3 mx-0 my-auto">Coin98</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=140" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13469/large/1inch-token.png?1608803028" /></span><span class="pl-3 mx-0 my-auto">1inch</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=141" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14666/large/Group_3.png?1617631327" /></span><span class="pl-3 mx-0 my-auto">Liquity USD</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=142" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12921/large/w2UiemF__400x400.jpg?1603670367" /></span><span class="pl-3 mx-0 my-auto">WOO Network</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=143" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2784/large/inKkF01.png?1605007034" /></span><span class="pl-3 mx-0 my-auto">Polymath</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=144" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10547/large/WazirX.png?1580834330" /></span><span class="pl-3 mx-0 my-auto">WazirX</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=145" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2117/large/YJUrRy7r_400x400.png?1589794215" /></span><span class="pl-3 mx-0 my-auto">SwissBorg</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=146" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10117/large/78GWcZu.png?1600845716" /></span><span class="pl-3 mx-0 my-auto">Neutrino USD</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=147" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1152/large/gLCEA2G.png?1604543239" /></span><span class="pl-3 mx-0 my-auto">Dent</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=148" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/18126/large/time.PNG?1630621941" /></span><span class="pl-3 mx-0 my-auto">Wonderland</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=149" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/17358/large/le1nzlO6_400x400.jpg?1632465691" /></span><span class="pl-3 mx-0 my-auto">Yield Guild Games</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=150" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14570/large/ZqsF51Re_400x400.png?1617082206" /></span><span class="pl-3 mx-0 my-auto">Fei Protocol</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=151" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/913/large/LRC.png?1572852344" /></span><span class="pl-3 mx-0 my-auto">Loopring</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=152" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2090/large/rocket.png?1563781948" /></span><span class="pl-3 mx-0 my-auto">Rocket Pool</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=153" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/5681/large/Fetch.jpg?1572098136" /></span><span class="pl-3 mx-0 my-auto">Fetch.ai</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=154" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9761/large/Kava-icon.png?1585636197" /></span><span class="pl-3 mx-0 my-auto">Kava</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=155" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/662/large/logo_square_simple_300px.png?1609402668" /></span><span class="pl-3 mx-0 my-auto">Gnosis</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=156" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/17984/large/9285.png?1630028620" /></span><span class="pl-3 mx-0 my-auto">Moonriver</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=157" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1372/large/WAX_Coin_Tickers_P_512px.png?1602812260" /></span><span class="pl-3 mx-0 my-auto">WAX</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=158" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9566/large/Nervos_White.png?1608280856" /></span><span class="pl-3 mx-0 my-auto">Nervos Network</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=159" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/542/large/Golem_Submark_Positive_RGB.png?1606392013" /></span><span class="pl-3 mx-0 my-auto">Golem</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=160" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/7137/large/logo-circle-green.png?1619593365" /></span><span class="pl-3 mx-0 my-auto">Livepeer</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=161" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/385/large/Lisk_Symbol_-_Blue.png?1573444104" /></span><span class="pl-3 mx-0 my-auto">Lisk</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=162" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9129/large/WinK.png?1564624891" /></span><span class="pl-3 mx-0 my-auto">WINkLink</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=163" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4645/large/DAG.png?1626339160" /></span><span class="pl-3 mx-0 my-auto">Constellation</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=164" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3373/large/IuNzUb5b_400x400.jpg?1589526336" /></span><span class="pl-3 mx-0 my-auto">Keep Network</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=165" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8186/large/47271330_590071468072434_707260356350705664_n.jpg?1556096683" /></span><span class="pl-3 mx-0 my-auto">Function X</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=166" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/15585/large/convex.png?1621256328" /></span><span class="pl-3 mx-0 my-auto">Convex Finance</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=167" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12606/large/nqGlQzdz_400x400.png?1601019805" /></span><span class="pl-3 mx-0 my-auto">TitanSwap</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=168" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14468/large/ILV.JPG?1617182121" /></span><span class="pl-3 mx-0 my-auto">Illuvium</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=169" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12738/large/AlphaToken_256x256.png?1617160876" /></span><span class="pl-3 mx-0 my-auto">Alpha Finance</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=170" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8365/large/Reserve_Rights.png?1557737411" /></span><span class="pl-3 mx-0 my-auto">Reserve Rights Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=171" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13422/large/frax_logo.png?1608476506" /></span><span class="pl-3 mx-0 my-auto">Frax</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=172" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10886/large/R9gQTJV__400x400.png?1585604557" /></span><span class="pl-3 mx-0 my-auto">Energy Web Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=173" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2484/large/Ergo.png?1574682618" /></span><span class="pl-3 mx-0 my-auto">Ergo</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=174" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12900/large/Rari_Logo_Transparent.png?1613978014" /></span><span class="pl-3 mx-0 my-auto">Rari Governance Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=175" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8089/large/digitalbits-logo.jpg?1554454902" /></span><span class="pl-3 mx-0 my-auto">DigitalBits</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=176" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13509/large/8DjBZ79V_400x400.jpg?1609236331" /></span><span class="pl-3 mx-0 my-auto">Oxygen</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=177" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9368/large/swipe.png?1566792311" /></span><span class="pl-3 mx-0 my-auto">Swipe</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=178" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13383/large/plex.png?1608082719" /></span><span class="pl-3 mx-0 my-auto">PLEX</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=179" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/18024/large/syn.PNG?1630288945" /></span><span class="pl-3 mx-0 my-auto">Synapse</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=180" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6905/large/Pirate_Chain.png?1560913844" /></span><span class="pl-3 mx-0 my-auto">Pirate Chain</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=181" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1254/large/bitcoin-diamond.png?1547035280" /></span><span class="pl-3 mx-0 my-auto">Bitcoin Diamond</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=182" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2962/large/Coti.png?1559653863" /></span><span class="pl-3 mx-0 my-auto">COTI</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=183" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/203/large/verge-symbol-color_logo.png?1561543281" /></span><span class="pl-3 mx-0 my-auto">Verge</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=184" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/5230/large/vethor-token.png?1548760043" /></span><span class="pl-3 mx-0 my-auto">VeThor Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=185" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4519/large/XYO_Network-logo.png?1547039819" /></span><span class="pl-3 mx-0 my-auto">XYO Network</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=186" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13504/large/Group_10572.png?1610534130" /></span><span class="pl-3 mx-0 my-auto">Reef Finance</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=187" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12882/large/Secondary_Symbol.png?1628233237" /></span><span class="pl-3 mx-0 my-auto">Injective Protocol</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=188" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3693/large/djLWD6mR_400x400.jpg?1591080616" /></span><span class="pl-3 mx-0 my-auto">Kadena</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=189" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14582/large/512_Light.png?1617149658" /></span><span class="pl-3 mx-0 my-auto">Persistence</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=190" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14025/large/VRA.jpg?1613797653" /></span><span class="pl-3 mx-0 my-auto">Verasity</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=191" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11085/large/Trust.png?1588062702" /></span><span class="pl-3 mx-0 my-auto">Trust Wallet Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=192" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12588/large/bakerytoken_logo.jpg?1600940032" /></span><span class="pl-3 mx-0 my-auto">BakerySwap</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=193" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14575/large/tribe.PNG?1617487954" /></span><span class="pl-3 mx-0 my-auto">Tribe</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=194" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8843/large/sETH.png?1616150207" /></span><span class="pl-3 mx-0 my-auto">sETH</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=195" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14571/large/vDyefsXq_400x400.jpg?1617085003" /></span><span class="pl-3 mx-0 my-auto">Pundi X</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=196" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1374/large/medibloc_basic.png?1570607623" /></span><span class="pl-3 mx-0 my-auto">Medibloc</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=197" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/18715/large/beta_finance.jpg?1633087053" /></span><span class="pl-3 mx-0 my-auto">Beta Finance</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=198" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14420/large/anchor_protocol_logo.jpg?1615965420" /></span><span class="pl-3 mx-0 my-auto">Anchor Protocol</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=199" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11423/large/1_QAHTciwVhD7SqVmfRW70Pw.png?1590110612" /></span><span class="pl-3 mx-0 my-auto">LUKSO Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=200" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2063/large/vectorspace-ai-logo.jpeg?1547036362" /></span><span class="pl-3 mx-0 my-auto">Vectorspace AI</span></a></li>
          </ul>
        </div>

      </div>
    </div>
  </div>
  <!-- SEARCH MODAL END -->

  <!-- SEARCH MODAL SELL -->
  <!--Modal-->
  <div class="modal2 modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay2 modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
    
    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
      
      <div class="modal-close2 modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
          <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
        </svg>
        <span class="text-sm">(Esc)</span>
      </div>

      <!-- Add margin if you want to see some of the overlay behind the modal-->
      <div class="modal-content text-left h-1/2">
        <!--Title-->
        <div class="flex justify-between items-center pb-3 px-6 py-4">
          <p class="text-2xl font-bold">Pick Coin to Use.</p>
          <div class="modal-close2 modal-close cursor-pointer z-50">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
          </div>
        </div>

        <!--Body-->
        <div class="rounded shadow-md mt-2 relative pin-t pin-l overflow-auto h-64">
          <div class="p-2"><input type="text" id="myInput" onkeyup="searchAddCoins()" placeholder="Search for coins.." class="border-2 rounded h-8 px-3 py-4 w-full"></div>
          <ul id="myUL" class="list-reset">
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=201&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="assets/money.png" /></span><span class="pl-3 mx-0 my-auto">US Dollar</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=202&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="assets/money.png" /></span><span class="pl-3 mx-0 my-auto">SA Rand</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=1&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1/large/bitcoin.png?1547033579" /></span><span class="pl-3 mx-0 my-auto">Bitcoin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=2&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/279/large/ethereum.png?1595348880" /></span><span class="pl-3 mx-0 my-auto">Ethereum</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=3&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/825/large/binance-coin-logo.png?1547034615" /></span><span class="pl-3 mx-0 my-auto">Binance Coin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=4&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/325/large/Tether-logo.png?1598003707" /></span><span class="pl-3 mx-0 my-auto">Tether</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=5&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/975/large/cardano.png?1547034860" /></span><span class="pl-3 mx-0 my-auto">Cardano</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=6&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/44/large/xrp-symbol-white-128.png?1605778731" /></span><span class="pl-3 mx-0 my-auto">XRP</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=7&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4128/large/coinmarketcap-solana-200.png?1616489452" /></span><span class="pl-3 mx-0 my-auto">Solana</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=8&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12171/large/aJGBjJFU_400x400.jpg?1597804776" /></span><span class="pl-3 mx-0 my-auto">Polkadot</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=9&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/5/large/dogecoin.png?1547792256" /></span><span class="pl-3 mx-0 my-auto">Dogecoin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=10&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6319/large/USD_Coin_icon.png?1547042389" /></span><span class="pl-3 mx-0 my-auto">USD Coin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=11&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8284/large/luna1557227471663.png?1567147072" /></span><span class="pl-3 mx-0 my-auto">Terra</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=12&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11939/large/shiba.png?1622619446" /></span><span class="pl-3 mx-0 my-auto">Shiba Inu</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=13&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/7598/large/wrapped_bitcoin_wbtc.png?1548822744" /></span><span class="pl-3 mx-0 my-auto">Wrapped Bitcoin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=14&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12504/large/uniswap-uni.png?1600306604" /></span><span class="pl-3 mx-0 my-auto">Uniswap</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=15&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9576/large/BUSD.png?1568947766" /></span><span class="pl-3 mx-0 my-auto">Binance USD</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=16&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2/large/litecoin.png?1547033580" /></span><span class="pl-3 mx-0 my-auto">Litecoin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=17&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12559/large/coin-round-red.png?1604021818" /></span><span class="pl-3 mx-0 my-auto">Avalanche</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=18&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/877/large/chainlink-new-logo.png?1547034700" /></span><span class="pl-3 mx-0 my-auto">Chainlink</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=19&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/780/large/bitcoin-cash-circle.png?1594689492" /></span><span class="pl-3 mx-0 my-auto">Bitcoin Cash</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=20&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4380/large/download.png?1547039725" /></span><span class="pl-3 mx-0 my-auto">Algorand</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=21&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4713/large/matic-token-icon.png?1624446912" /></span><span class="pl-3 mx-0 my-auto">Polygon</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=22&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/100/large/Stellar_symbol_black_RGB.png?1552356157" /></span><span class="pl-3 mx-0 my-auto">Stellar</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=23&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1481/large/cosmos_hub.png?1555657960" /></span><span class="pl-3 mx-0 my-auto">Cosmos</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=24&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1167/large/VeChain-Logo-768x725.png?1547035194" /></span><span class="pl-3 mx-0 my-auto">VeChain</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=25&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14495/large/Internet_Computer_logo.png?1620703073" /></span><span class="pl-3 mx-0 my-auto">Internet Computer</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=26&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13029/large/axie_infinity_logo.png?1604471082" /></span><span class="pl-3 mx-0 my-auto">Axie Infinity</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=27&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12817/large/filecoin.png?1602753933" /></span><span class="pl-3 mx-0 my-auto">Filecoin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=28&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1094/large/tron-logo.png?1547035066" /></span><span class="pl-3 mx-0 my-auto">TRON</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=29&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9956/large/dai-multi-collateral-mcd.png?1574218774" /></span><span class="pl-3 mx-0 my-auto">Dai</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=30&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/453/large/ethereum-classic-logo.png?1547034169" /></span><span class="pl-3 mx-0 my-auto">Ethereum Classic</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=31&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9026/large/F.png?1609051564" /></span><span class="pl-3 mx-0 my-auto">FTX Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=32&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10643/large/ceth2.JPG?1581389598" /></span><span class="pl-3 mx-0 my-auto">cETH</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=33&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2538/large/theta-token-logo.png?1548387191" /></span><span class="pl-3 mx-0 my-auto">Theta Network</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=34&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/976/large/Tezos-logo.png?1547034862" /></span><span class="pl-3 mx-0 my-auto">Tezos</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=35&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4001/large/Fantom.png?1558015016" /></span><span class="pl-3 mx-0 my-auto">Fantom</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=36&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3688/large/mqTDGK7Q.png?1566256777" /></span><span class="pl-3 mx-0 my-auto">Hedera</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=37&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13442/large/steth_logo.png?1608607546" /></span><span class="pl-3 mx-0 my-auto">Lido Staked Ether</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=38&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/69/large/monero_logo.png?1547033729" /></span><span class="pl-3 mx-0 my-auto">Monero</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=39&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/7310/large/cypto.png?1547043960" /></span><span class="pl-3 mx-0 my-auto">Crypto.com Coin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=40&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12335/large/elrond3_360.png?1626341589" /></span><span class="pl-3 mx-0 my-auto">Elrond</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=41&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12632/large/pancakeswap-cake-logo_%281%29.png?1629359065" /></span><span class="pl-3 mx-0 my-auto">PancakeSwap</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=42&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13446/large/5f6294c0c7a8cda55cb1c936_Flow_Wordmark.png?1631696776" /></span><span class="pl-3 mx-0 my-auto">Flow</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=43&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/738/large/eos-eos-logo.png?1547034481" /></span><span class="pl-3 mx-0 my-auto">EOS</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=44&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4463/large/okb_token.png?1548386209" /></span><span class="pl-3 mx-0 my-auto">OKB</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=45&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9281/large/cDAI.png?1576467585" /></span><span class="pl-3 mx-0 my-auto">cDAI</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=46&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9672/large/CjbT82vP_400x400.jpg?1570548320" /></span><span class="pl-3 mx-0 my-auto">Klaytn</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=47&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10365/large/near_icon.png?1601359077" /></span><span class="pl-3 mx-0 my-auto">Near</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=48&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3370/large/5ZOu7brX_400x400.jpg?1612437252" /></span><span class="pl-3 mx-0 my-auto">Quant</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=49&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12645/large/AAVE.png?1601374110" /></span><span class="pl-3 mx-0 my-auto">Aave</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=50&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13397/large/Graph_Token.png?1608145566" /></span><span class="pl-3 mx-0 my-auto">The Graph</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=51&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9442/large/Compound_USDC.png?1567581577" /></span><span class="pl-3 mx-0 my-auto">cUSDC</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=52&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/16646/large/Logo_final-22.png?1628239446" /></span><span class="pl-3 mx-0 my-auto">eCash</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=53&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/692/large/IOTA_Swirl.png?1604238557" /></span><span class="pl-3 mx-0 my-auto">IOTA</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=54&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6799/large/BSV.png?1558947902" /></span><span class="pl-3 mx-0 my-auto">Bitcoin SV</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=55&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13120/large/Logo_final-21.png?1624892810" /></span><span class="pl-3 mx-0 my-auto">Bitcoin Cash ABC</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=56&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9568/large/m4zRhP5e_400x400.jpg?1576190080" /></span><span class="pl-3 mx-0 my-auto">Kusama</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=57&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/480/large/NEO_512_512.png?1594357361" /></span><span class="pl-3 mx-0 my-auto">NEO</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=58&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/425/large/waves.png?1548386117" /></span><span class="pl-3 mx-0 my-auto">Waves</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=59&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8418/large/leo-token.png?1558326215" /></span><span class="pl-3 mx-0 my-auto">LEO Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=60&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12681/large/UST.png?1601612407" /></span><span class="pl-3 mx-0 my-auto">TerraUSD</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=61&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2069/large/Stacks_logo_full.png?1604112510" /></span><span class="pl-3 mx-0 my-auto">Stacks</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=62&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4343/large/oRt6SiEN_400x400.jpg?1591059616" /></span><span class="pl-3 mx-0 my-auto">Arweave</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=63&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12407/large/Unknown-5.png?1599624896" /></span><span class="pl-3 mx-0 my-auto">Huobi BTC</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=64&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/7595/large/BTT_Token_Graphic.png?1555066995" /></span><span class="pl-3 mx-0 my-auto">BitTorrent</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=65&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3263/large/CEL_logo.png?1609598753" /></span><span class="pl-3 mx-0 my-auto">Celsius Network</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=66&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4344/large/Y88JAze.png?1565065793" /></span><span class="pl-3 mx-0 my-auto">Harmony</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=67&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14483/large/token_OHM_%281%29.png?1628311611" /></span><span class="pl-3 mx-0 my-auto">Olympus</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=68&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12409/large/amp-200x200.png?1599625397" /></span><span class="pl-3 mx-0 my-auto">Amp</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=69&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1364/large/Mark_Maker.png?1585191826" /></span><span class="pl-3 mx-0 my-auto">Maker</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=70&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4284/large/Helium_HNT.png?1612620071" /></span><span class="pl-3 mx-0 my-auto">Helium</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=71&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12271/large/512x512_Logo_no_chop.png?1606986688" /></span><span class="pl-3 mx-0 my-auto">Sushi</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=72&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6595/large/RUNE.png?1614160507" /></span><span class="pl-3 mx-0 my-auto">THORChain</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=73&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11090/large/icon-celo-CELO-color-500.png?1592293590" /></span><span class="pl-3 mx-0 my-auto">Celo</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=74&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/776/large/OMG_Network.jpg?1591167168" /></span><span class="pl-3 mx-0 my-auto">OMG Network</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=75&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/19/large/dash-logo.png?1548385930" /></span><span class="pl-3 mx-0 my-auto">Dash</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=76&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10775/large/COMP.png?1592625425" /></span><span class="pl-3 mx-0 my-auto">Compound</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=77&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8834/large/Chiliz.png?1561970540" /></span><span class="pl-3 mx-0 my-auto">Chiliz</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=78&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/16786/large/mimlogopng.png?1624979612" /></span><span class="pl-3 mx-0 my-auto">Magic Internet Money</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=79&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3406/large/SNX.png?1598631139" /></span><span class="pl-3 mx-0 my-auto">Synthetix Network Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=80&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3348/large/Holologo_Profile.png?1547037966" /></span><span class="pl-3 mx-0 my-auto">Holo</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=81&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/486/large/circle-zcash-color.png?1547034197" /></span><span class="pl-3 mx-0 my-auto">Zcash</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=82&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/329/large/decred.png?1547034093" /></span><span class="pl-3 mx-0 my-auto">Decred</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=83&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8029/large/1_0YusgngOrriVg4ZYx4wOFQ.png?1553483622" /></span><span class="pl-3 mx-0 my-auto">Theta Fuel</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=84&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4428/large/ECOMI.png?1557928886" /></span><span class="pl-3 mx-0 my-auto">ECOMI</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=85&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/242/large/NEM_Logo_256x256.png?1598687029" /></span><span class="pl-3 mx-0 my-auto">NEM</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=86&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1102/large/enjin-coin-logo.png?1547035078" /></span><span class="pl-3 mx-0 my-auto">Enjin Coin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=87&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1060/large/icon-icx-logo.png?1547035003" /></span><span class="pl-3 mx-0 my-auto">ICON</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=88&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2912/large/xdc-icon.png?1633700890" /></span><span class="pl-3 mx-0 my-auto">XDC Network</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=89&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3449/large/tusd.png?1618395665" /></span><span class="pl-3 mx-0 my-auto">TrueUSD</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=90&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/684/large/qtum.png?1547034438" /></span><span class="pl-3 mx-0 my-auto">Qtum</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=91&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/15861/large/abracadabra-3.png?1622544862" /></span><span class="pl-3 mx-0 my-auto">Spell Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=92&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11849/large/yfi-192x192.png?1598325330" /></span><span class="pl-3 mx-0 my-auto">yearn.finance</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=93&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2822/large/huobi-token-logo.png?1547036992" /></span><span class="pl-3 mx-0 my-auto">Huobi Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=94&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1043/large/bitcoin-gold-logo.png?1547034978" /></span><span class="pl-3 mx-0 my-auto">Bitcoin Gold</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=95&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2687/large/Zilliqa-logo.png?1547036894" /></span><span class="pl-3 mx-0 my-auto">Zilliqa</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=96&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1899/large/tel.png?1547036203" /></span><span class="pl-3 mx-0 my-auto">Telcoin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=97&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/17500/large/hjnIm9bV.jpg?1628009360" /></span><span class="pl-3 mx-0 my-auto">dYdX</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=98&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2523/large/IOST.png?1557555183" /></span><span class="pl-3 mx-0 my-auto">IOST</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=99&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/15628/large/JM4_vQ34_400x400.png?1621394004" /></span><span class="pl-3 mx-0 my-auto">Mina Protocol</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=100&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12124/large/Curve.png?1597369484" /></span><span class="pl-3 mx-0 my-auto">Curve DAO Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=101&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11370/large/Bitcoin.jpg?1628072791" /></span><span class="pl-3 mx-0 my-auto">renBTC</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=102&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14362/large/174x174-white.png?1617174846" /></span><span class="pl-3 mx-0 my-auto">SafeMoon</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=103&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/16310/large/k-h6Wead_400x400.jpg?1623726134" /></span><span class="pl-3 mx-0 my-auto">Decentralized Social</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=104&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3412/large/ravencoin.png?1548386057" /></span><span class="pl-3 mx-0 my-auto">Ravencoin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=105&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/677/large/basic-attention-token.png?1547034427" /></span><span class="pl-3 mx-0 my-auto">Basic Attention Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=106&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11810/large/nexus-mutual.jpg?1594547726" /></span><span class="pl-3 mx-0 my-auto">Nexus Mutual</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=107&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1047/large/sa9z79.png?1610678720" /></span><span class="pl-3 mx-0 my-auto">KuCoin Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=108&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/878/large/decentraland-mana.png?1550108745" /></span><span class="pl-3 mx-0 my-auto">Decentraland</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=109&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3139/large/REN.png?1589985807" /></span><span class="pl-3 mx-0 my-auto">REN</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=110&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12381/large/60d18e06844a844ad75901a9_mark_only_03.png?1628674771" /></span><span class="pl-3 mx-0 my-auto">Perpetual Protocol</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=111&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3695/large/nexo.png?1548086057" /></span><span class="pl-3 mx-0 my-auto">NEXO</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=112&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11970/large/serum-logo.png?1597121577" /></span><span class="pl-3 mx-0 my-auto">Serum</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=113&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6013/large/Pax_Dollar.png?1629877204" /></span><span class="pl-3 mx-0 my-auto">Pax Dollar</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=114&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/736/large/bancor-bnt.png?1628822309" /></span><span class="pl-3 mx-0 my-auto">Bancor Network Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=115&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/289/large/siacoin.png?1548386465" /></span><span class="pl-3 mx-0 my-auto">Siacoin</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=116&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/691/large/horizen.png?1555052241" /></span><span class="pl-3 mx-0 my-auto">Horizen</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=117&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13725/large/xsushi.png?1612538526" /></span><span class="pl-3 mx-0 my-auto">xSUSHI</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=118&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/863/large/0x.png?1547034672" /></span><span class="pl-3 mx-0 my-auto">0x</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=119&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/16724/large/osmo.png?1632763885" /></span><span class="pl-3 mx-0 my-auto">Osmosis</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=120&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12913/large/AudiusCoinLogo_2x.png?1603425727" /></span><span class="pl-3 mx-0 my-auto">Audius</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=121&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3447/large/ONT.png?1583481820" /></span><span class="pl-3 mx-0 my-auto">Ontology</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=122&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11621/large/cUSDT.png?1592113270" /></span><span class="pl-3 mx-0 my-auto">cUSDT</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=123&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13775/large/mdex.png?1611739676" /></span><span class="pl-3 mx-0 my-auto">Mdex</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=124&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3318/large/photo1198982838879365035.jpg?1547037916" /></span><span class="pl-3 mx-0 my-auto">NuCypher</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=125&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4379/large/Celr.png?1554705437" /></span><span class="pl-3 mx-0 my-auto">Celer Network</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=126&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13245/large/SKALE_token_300x300.png?1606789574" /></span><span class="pl-3 mx-0 my-auto">SKALE</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=127&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/63/large/digibyte.png?1547033717" /></span><span class="pl-3 mx-0 my-auto">DigiByte</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=128&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8183/large/gt.png?1556085624" /></span><span class="pl-3 mx-0 my-auto">GateToken</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=129&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4324/large/U85xTl2.png?1608111978" /></span><span class="pl-3 mx-0 my-auto">Ankr</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=130&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11871/large/Secret.png?1595520186" /></span><span class="pl-3 mx-0 my-auto">Secret</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=131&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/756/large/nano-coin-logo.png?1547034501" /></span><span class="pl-3 mx-0 my-auto">Nano</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=132&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13928/large/PSigc4ie_400x400.jpg?1612875614" /></span><span class="pl-3 mx-0 my-auto">Raydium</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=133&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10951/large/UMA.png?1586307916" /></span><span class="pl-3 mx-0 my-auto">UMA</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=134&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12129/large/sandbox_logo.jpg?1597397942" /></span><span class="pl-3 mx-0 my-auto">The Sandbox</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=135&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/16911/large/icon200x200.png?1625618542" /></span><span class="pl-3 mx-0 my-auto">Metahero</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=136&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3334/large/iotex-logo.png?1547037941" /></span><span class="pl-3 mx-0 my-auto">IoTeX</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=137&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6450/large/linklogo.png?1547042644" /></span><span class="pl-3 mx-0 my-auto">LINK</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=138&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12493/large/GALA-COINGECKO.png?1600233435" /></span><span class="pl-3 mx-0 my-auto">Gala</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=139&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/17117/large/logo.png?1626412904" /></span><span class="pl-3 mx-0 my-auto">Coin98</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=140&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13469/large/1inch-token.png?1608803028" /></span><span class="pl-3 mx-0 my-auto">1inch</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=141&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14666/large/Group_3.png?1617631327" /></span><span class="pl-3 mx-0 my-auto">Liquity USD</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=142&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12921/large/w2UiemF__400x400.jpg?1603670367" /></span><span class="pl-3 mx-0 my-auto">WOO Network</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=143&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2784/large/inKkF01.png?1605007034" /></span><span class="pl-3 mx-0 my-auto">Polymath</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=144&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10547/large/WazirX.png?1580834330" /></span><span class="pl-3 mx-0 my-auto">WazirX</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=145&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2117/large/YJUrRy7r_400x400.png?1589794215" /></span><span class="pl-3 mx-0 my-auto">SwissBorg</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=146&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10117/large/78GWcZu.png?1600845716" /></span><span class="pl-3 mx-0 my-auto">Neutrino USD</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=147&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1152/large/gLCEA2G.png?1604543239" /></span><span class="pl-3 mx-0 my-auto">Dent</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=148&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/18126/large/time.PNG?1630621941" /></span><span class="pl-3 mx-0 my-auto">Wonderland</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=149&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/17358/large/le1nzlO6_400x400.jpg?1632465691" /></span><span class="pl-3 mx-0 my-auto">Yield Guild Games</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=150&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14570/large/ZqsF51Re_400x400.png?1617082206" /></span><span class="pl-3 mx-0 my-auto">Fei Protocol</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=151&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/913/large/LRC.png?1572852344" /></span><span class="pl-3 mx-0 my-auto">Loopring</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=152&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2090/large/rocket.png?1563781948" /></span><span class="pl-3 mx-0 my-auto">Rocket Pool</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=153&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/5681/large/Fetch.jpg?1572098136" /></span><span class="pl-3 mx-0 my-auto">Fetch.ai</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=154&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9761/large/Kava-icon.png?1585636197" /></span><span class="pl-3 mx-0 my-auto">Kava</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=155&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/662/large/logo_square_simple_300px.png?1609402668" /></span><span class="pl-3 mx-0 my-auto">Gnosis</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=156&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/17984/large/9285.png?1630028620" /></span><span class="pl-3 mx-0 my-auto">Moonriver</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=157&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1372/large/WAX_Coin_Tickers_P_512px.png?1602812260" /></span><span class="pl-3 mx-0 my-auto">WAX</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=158&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9566/large/Nervos_White.png?1608280856" /></span><span class="pl-3 mx-0 my-auto">Nervos Network</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=159&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/542/large/Golem_Submark_Positive_RGB.png?1606392013" /></span><span class="pl-3 mx-0 my-auto">Golem</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=160&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/7137/large/logo-circle-green.png?1619593365" /></span><span class="pl-3 mx-0 my-auto">Livepeer</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=161&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/385/large/Lisk_Symbol_-_Blue.png?1573444104" /></span><span class="pl-3 mx-0 my-auto">Lisk</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=162&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9129/large/WinK.png?1564624891" /></span><span class="pl-3 mx-0 my-auto">WINkLink</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=163&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4645/large/DAG.png?1626339160" /></span><span class="pl-3 mx-0 my-auto">Constellation</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=164&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3373/large/IuNzUb5b_400x400.jpg?1589526336" /></span><span class="pl-3 mx-0 my-auto">Keep Network</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=165&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8186/large/47271330_590071468072434_707260356350705664_n.jpg?1556096683" /></span><span class="pl-3 mx-0 my-auto">Function X</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=166&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/15585/large/convex.png?1621256328" /></span><span class="pl-3 mx-0 my-auto">Convex Finance</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=167&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12606/large/nqGlQzdz_400x400.png?1601019805" /></span><span class="pl-3 mx-0 my-auto">TitanSwap</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=168&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14468/large/ILV.JPG?1617182121" /></span><span class="pl-3 mx-0 my-auto">Illuvium</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=169&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12738/large/AlphaToken_256x256.png?1617160876" /></span><span class="pl-3 mx-0 my-auto">Alpha Finance</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=170&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8365/large/Reserve_Rights.png?1557737411" /></span><span class="pl-3 mx-0 my-auto">Reserve Rights Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=171&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13422/large/frax_logo.png?1608476506" /></span><span class="pl-3 mx-0 my-auto">Frax</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=172&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10886/large/R9gQTJV__400x400.png?1585604557" /></span><span class="pl-3 mx-0 my-auto">Energy Web Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=173&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2484/large/Ergo.png?1574682618" /></span><span class="pl-3 mx-0 my-auto">Ergo</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=174&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12900/large/Rari_Logo_Transparent.png?1613978014" /></span><span class="pl-3 mx-0 my-auto">Rari Governance Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=175&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8089/large/digitalbits-logo.jpg?1554454902" /></span><span class="pl-3 mx-0 my-auto">DigitalBits</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=176&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13509/large/8DjBZ79V_400x400.jpg?1609236331" /></span><span class="pl-3 mx-0 my-auto">Oxygen</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=177&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9368/large/swipe.png?1566792311" /></span><span class="pl-3 mx-0 my-auto">Swipe</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=178&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13383/large/plex.png?1608082719" /></span><span class="pl-3 mx-0 my-auto">PLEX</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=179&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/18024/large/syn.PNG?1630288945" /></span><span class="pl-3 mx-0 my-auto">Synapse</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=180&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6905/large/Pirate_Chain.png?1560913844" /></span><span class="pl-3 mx-0 my-auto">Pirate Chain</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=181&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1254/large/bitcoin-diamond.png?1547035280" /></span><span class="pl-3 mx-0 my-auto">Bitcoin Diamond</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=182&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2962/large/Coti.png?1559653863" /></span><span class="pl-3 mx-0 my-auto">COTI</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=183&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/203/large/verge-symbol-color_logo.png?1561543281" /></span><span class="pl-3 mx-0 my-auto">Verge</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=184&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/5230/large/vethor-token.png?1548760043" /></span><span class="pl-3 mx-0 my-auto">VeThor Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=185&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4519/large/XYO_Network-logo.png?1547039819" /></span><span class="pl-3 mx-0 my-auto">XYO Network</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=186&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13504/large/Group_10572.png?1610534130" /></span><span class="pl-3 mx-0 my-auto">Reef Finance</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=187&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12882/large/Secondary_Symbol.png?1628233237" /></span><span class="pl-3 mx-0 my-auto">Injective Protocol</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=188&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3693/large/djLWD6mR_400x400.jpg?1591080616" /></span><span class="pl-3 mx-0 my-auto">Kadena</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=189&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14582/large/512_Light.png?1617149658" /></span><span class="pl-3 mx-0 my-auto">Persistence</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=190&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14025/large/VRA.jpg?1613797653" /></span><span class="pl-3 mx-0 my-auto">Verasity</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=191&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11085/large/Trust.png?1588062702" /></span><span class="pl-3 mx-0 my-auto">Trust Wallet Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=192&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12588/large/bakerytoken_logo.jpg?1600940032" /></span><span class="pl-3 mx-0 my-auto">BakerySwap</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=193&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14575/large/tribe.PNG?1617487954" /></span><span class="pl-3 mx-0 my-auto">Tribe</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=194&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8843/large/sETH.png?1616150207" /></span><span class="pl-3 mx-0 my-auto">sETH</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=195&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14571/large/vDyefsXq_400x400.jpg?1617085003" /></span><span class="pl-3 mx-0 my-auto">Pundi X</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=196&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1374/large/medibloc_basic.png?1570607623" /></span><span class="pl-3 mx-0 my-auto">Medibloc</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=197&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/18715/large/beta_finance.jpg?1633087053" /></span><span class="pl-3 mx-0 my-auto">Beta Finance</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=198&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14420/large/anchor_protocol_logo.jpg?1615965420" /></span><span class="pl-3 mx-0 my-auto">Anchor Protocol</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=199&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11423/large/1_QAHTciwVhD7SqVmfRW70Pw.png?1590110612" /></span><span class="pl-3 mx-0 my-auto">LUKSO Token</span></a></li>
            <li><a href="trades.php?coin_id=<?php echo $_GET['coin_id']; ?>&coin_spent=200&trade_type=sell" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2063/large/vectorspace-ai-logo.jpeg?1547036362" /></span><span class="pl-3 mx-0 my-auto">Vectorspace AI</span></a></li>
          </ul>
        </div>

      </div>
    </div>
  </div>
  <!-- SEARCH MODAL END SELL -->

<?php include_once("includes/footer.php"); ?>
<script>
  modal();
  modalSell();

  buyTable(<?php echo $mainCoinID ?>,'<?php echo $mainCoinUID ?>',<?php echo $spentCoinID ?>,'<?php echo $spentCoinUID ?>');
  sellTable(<?php echo $mainCoinID ?>,'<?php echo $mainCoinUID ?>',<?php echo $spentCoinID ?>,'<?php echo $spentCoinUID ?>');

  // value="2021-06-12T19:30" max="2021-06-14T00:00"
  let today = new Date();
  let todayISO = today.toLocaleString("sv", {timeZone: "Africa/Johannesburg"});
  console.log(today.toLocaleString("sv", {timeZone: "Africa/Johannesburg"}));
  console.log(today.toISOString().substring(0, 19));
  let dateTime = document.getElementById('date_time');
  dateTime.setAttribute("value", todayISO);
  dateTime.setAttribute("max", todayISO);
  dateTime = document.getElementById('date_time_SELL');
  dateTime.setAttribute("value", todayISO);
  dateTime.setAttribute("max", todayISO);

  const trades = document.querySelectorAll('#trades_table_coin tr');
  // adds currencies to array
  let currencies = [];
  for(i = 0; i < trades.length; ++i) {
    currencies.push(trades[i].children[8].innerHTML);
    // console.log(trades[i].children[2].innerHTML);
    // console.log(trades[i].children[4].lastChild.innerHTML);
    // console.log(trades[i].children[8].innerHTML);
    
  }
  console.log(currencies);
  // removes duplicates
  queryFiat = [...new Set(currencies)];
  console.log(queryFiat);
  // removes fiat
  const indexUSD = queryFiat.indexOf("usd");
  if (indexUSD > -1) {
    queryFiat.splice(indexUSD, 1);
  }
  const indexZAR = queryFiat.indexOf("zar");
  if (indexZAR > -1) {
    queryFiat.splice(indexZAR, 1);
  }
  // joins array to csv
  postfix = queryFiat.join(",");
  console.log(queryFiat);

  // API
  const http = new XMLHttpRequest();
  const url = 'https://api.coingecko.com/api/v3/simple/price?vs_currencies=usd,zar&ids='+queryFiat;
  http.open("GET", url);
  http.send();
  var p = 0;
  http.onreadystatechange = function() {
    if(this.readyState==4 && this.status==200){
      p = http.responseText;
    }
  } // API END
  console.log(p);
  

</script>

</body>
</html>