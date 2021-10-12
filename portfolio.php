<?php include_once("includes/config.php") ?>
<?php include_once("includes/secure.php") ?>

<?php // checks if addCoin variable passed through url
  include_once("includes/functions.php");
  if (isset($_GET['addCoin'])) {
    addInventory($_GET['addCoin'],$_SESSION['userid'],$conn);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once("includes/head-contents.php") ?>
<style> 
    /* for search modal to function */
    .modal {
      transition: opacity 0.25s ease;
    }
    body.modal-active {
      overflow-x: hidden;
      overflow-y: visible !important;
    }
  </style>
</head>
<body>

<?php include_once("includes/navigation.php") ?>

<h2><?php echo $CURRENT_PAGE ?></h2>

  <div class="mb-8 p-2 w-full flex justify-center flex-wrap bg-grey-light">
    <div class="h-auto w-full md:w-1/2 lg:w-1/4 bg-grey">
      <canvas id="doughChart" height="400" width="400"></canvas>
    </div>
    <div class="h-auto w-full md:w-1/2 lg:w-1/4 bg-grey">
      <canvas id="lineChart" height="400" width="400"></canvas>
    </div>
  </div>


      <div class="container w-1/4 mb-5 flex justify-center mx-auto">
          <button type="submit" id="submit" name="submit" class="modal-open flex items-center justify-center focus:outline-none text-white text-sm sm:text-base bg-rucrypto hover:bg-rucrypto-dark rounded py-2 w-full transition duration-150 ease-in">
            <span class="mr-2 uppercase">Add Coin</span>
            <span>
              <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </span>
          </button>
        </div>


    <!-- TRADES TABLE -->
  <div class="container flex justify-center mx-auto">
    <div class="border-b border-gray-200 shadow overflow-auto">
      <table class="divide-y divide-gray-300 ">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-2 text-xs text-gray-500">#</th>
                <th class="px-6 py-2 text-xs text-gray-500">Coin</th>
                <th class="px-6 py-2 text-xs text-gray-500">Price</th>
                <th class="px-6 py-2 text-xs text-gray-500">24h</th>
                <th class="px-6 py-2 text-xs text-gray-500">Mkt Cap</th>
                <th class="px-6 py-2 text-xs text-gray-500">PNL</th>
                <th class="px-6 py-2 text-xs text-gray-500">Buy/Sell</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-300">
            <tr class="whitespace-nowrap">
                <td class="px-6 py-4 text-sm text-gray-500">1</td>
                <td id="topCoinID-1" class="px-6 py-4 text-sm text-gray-900">ID</td>
                <td id="topCoinName-1" class="px-6 py-4 text-sm text-gray-500">Coin</td>
                <td id="topCoinPrice-1" class="px-6 py-4 text-sm text-gray-500">0%</td>
                <td id="topCoinChange-1" class="px-6 py-4 text-sm text-gray-500">$0.00</td>
                <td id="topCoinChange-1" class="px-6 py-4 text-sm text-gray-500">0%</td>
                <td id="topCoinChange-1" class="px-6 py-4 text-sm text-gray-500">
                  <a href="#" class="inline-flex items-center font-bold hover:text-blue-500 text-gray-700 text-xs text-center align-middle">
                      <span>
                        <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.8" viewBox="-2 -2 25 25" stroke="currentColor">
                          <path d="M12.522,10.4l-3.559,3.562c-0.172,0.173-0.451,0.176-0.625,0c-0.173-0.173-0.173-0.451,0-0.624l3.248-3.25L8.161,6.662c-0.173-0.173-0.173-0.452,0-0.624c0.172-0.175,0.451-0.175,0.624,0l3.738,3.736C12.695,9.947,12.695,10.228,12.522,10.4 M18.406,10c0,4.644-3.764,8.406-8.406,8.406c-4.644,0-8.406-3.763-8.406-8.406S5.356,1.594,10,1.594C14.643,1.594,18.406,5.356,18.406,10M17.521,10c0-4.148-3.374-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.147,17.521,17.521,14.147,17.521,10"></path>
                        </svg>
                      </span>
                    </a>
                </td>
            </tr>
            <?php
              printInventory($_SESSION['userid'],$conn);
            ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- TRADES TABLE END -->


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
      <div class="modal-content py-4 text-left px-6 h-1/2">
        <!--Title-->
        <div class="flex justify-between items-center pb-3">
          <p class="text-2xl font-bold">Search for Coins!</p>
          <div class="modal-close cursor-pointer z-50">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
          </div>
        </div>

        <!--Body-->
        <div class="rounded shadow-md my-2 relative pin-t pin-l overflow-auto h-44">
          <div class="p-2"><input type="text" id="myInput" onkeyup="searchAddCoins()" placeholder="Search for coins.." class="border-2 rounded h-8 w-full"></div>
          <ul id="myUL" class="list-reset">
            <li><a href="portfolio?addCoin=bitcoin" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1/large/bitcoin.png?1547033579" /></span><span class="pl-3 mx-0 my-auto">Bitcoin</span></a></li>
            <li><a href="portfolio?addCoin=ethereum" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/279/large/ethereum.png?1595348880" /></span><span class="pl-3 mx-0 my-auto">Ethereum</span></a></li>
            <li><a href="portfolio?addCoin=binancecoin" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/825/large/binance-coin-logo.png?1547034615" /></span><span class="pl-3 mx-0 my-auto">Binance Coin</span></a></li>
            <li><a href="portfolio?addCoin=tether" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/325/large/Tether-logo.png?1598003707" /></span><span class="pl-3 mx-0 my-auto">Tether</span></a></li>
            <li><a href="portfolio?addCoin=cardano" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/975/large/cardano.png?1547034860" /></span><span class="pl-3 mx-0 my-auto">Cardano</span></a></li>
            <li><a href="portfolio?addCoin=ripple" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/44/large/xrp-symbol-white-128.png?1605778731" /></span><span class="pl-3 mx-0 my-auto">XRP</span></a></li>
            <li><a href="portfolio?addCoin=solana" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4128/large/coinmarketcap-solana-200.png?1616489452" /></span><span class="pl-3 mx-0 my-auto">Solana</span></a></li>
            <li><a href="portfolio?addCoin=polkadot" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12171/large/aJGBjJFU_400x400.jpg?1597804776" /></span><span class="pl-3 mx-0 my-auto">Polkadot</span></a></li>
            <li><a href="portfolio?addCoin=usd-coin" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6319/large/USD_Coin_icon.png?1547042389" /></span><span class="pl-3 mx-0 my-auto">USD Coin</span></a></li>
            <li><a href="portfolio?addCoin=dogecoin" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/5/large/dogecoin.png?1547792256" /></span><span class="pl-3 mx-0 my-auto">Dogecoin</span></a></li>
            <li><a href="portfolio?addCoin=terra-luna" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8284/large/luna1557227471663.png?1567147072" /></span><span class="pl-3 mx-0 my-auto">Terra</span></a></li>
            <li><a href="portfolio?addCoin=shiba-inu" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11939/large/shiba.png?1622619446" /></span><span class="pl-3 mx-0 my-auto">Shiba Inu</span></a></li>
            <li><a href="portfolio?addCoin=binance-usd" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9576/large/BUSD.png?1568947766" /></span><span class="pl-3 mx-0 my-auto">Binance USD</span></a></li>
            <li><a href="portfolio?addCoin=wrapped-bitcoin" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/7598/large/wrapped_bitcoin_wbtc.png?1548822744" /></span><span class="pl-3 mx-0 my-auto">Wrapped Bitcoin</span></a></li>
            <li><a href="portfolio?addCoin=uniswap" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12504/large/uniswap-uni.png?1600306604" /></span><span class="pl-3 mx-0 my-auto">Uniswap</span></a></li>
            <li><a href="portfolio?addCoin=litecoin" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2/large/litecoin.png?1547033580" /></span><span class="pl-3 mx-0 my-auto">Litecoin</span></a></li>
            <li><a href="portfolio?addCoin=avalanche-2" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12559/large/coin-round-red.png?1604021818" /></span><span class="pl-3 mx-0 my-auto">Avalanche</span></a></li>
            <li><a href="portfolio?addCoin=chainlink" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/877/large/chainlink-new-logo.png?1547034700" /></span><span class="pl-3 mx-0 my-auto">Chainlink</span></a></li>
            <li><a href="portfolio?addCoin=bitcoin-cash" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/780/large/bitcoin-cash-circle.png?1594689492" /></span><span class="pl-3 mx-0 my-auto">Bitcoin Cash</span></a></li>
            <li><a href="portfolio?addCoin=algorand" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4380/large/download.png?1547039725" /></span><span class="pl-3 mx-0 my-auto">Algorand</span></a></li>
            <li><a href="portfolio?addCoin=cosmos" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1481/large/cosmos_hub.png?1555657960" /></span><span class="pl-3 mx-0 my-auto">Cosmos</span></a></li>
            <li><a href="portfolio?addCoin=matic-network" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4713/large/matic-token-icon.png?1624446912" /></span><span class="pl-3 mx-0 my-auto">Polygon</span></a></li>
            <li><a href="portfolio?addCoin=stellar" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/100/large/Stellar_symbol_black_RGB.png?1552356157" /></span><span class="pl-3 mx-0 my-auto">Stellar</span></a></li>
            <li><a href="portfolio?addCoin=filecoin" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12817/large/filecoin.png?1602753933" /></span><span class="pl-3 mx-0 my-auto">Filecoin</span></a></li>
            <li><a href="portfolio?addCoin=axie-infinity" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13029/large/axie_infinity_logo.png?1604471082" /></span><span class="pl-3 mx-0 my-auto">Axie Infinity</span></a></li>
            <li><a href="portfolio?addCoin=internet-computer" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14495/large/Internet_Computer_logo.png?1620703073" /></span><span class="pl-3 mx-0 my-auto">Internet Computer</span></a></li>
            <li><a href="portfolio?addCoin=vechain" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1167/large/VeChain-Logo-768x725.png?1547035194" /></span><span class="pl-3 mx-0 my-auto">VeChain</span></a></li>
            <li><a href="portfolio?addCoin=ethereum-classic" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/453/large/ethereum-classic-logo.png?1547034169" /></span><span class="pl-3 mx-0 my-auto">Ethereum Classic</span></a></li>
            <li><a href="portfolio?addCoin=tron" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1094/large/tron-logo.png?1547035066" /></span><span class="pl-3 mx-0 my-auto">TRON</span></a></li>
            <li><a href="portfolio?addCoin=dai" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9956/large/dai-multi-collateral-mcd.png?1574218774" /></span><span class="pl-3 mx-0 my-auto">Dai</span></a></li>
            <li><a href="portfolio?addCoin=ftx-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9026/large/F.png?1609051564" /></span><span class="pl-3 mx-0 my-auto">FTX Token</span></a></li>
            <li><a href="portfolio?addCoin=tezos" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/976/large/Tezos-logo.png?1547034862" /></span><span class="pl-3 mx-0 my-auto">Tezos</span></a></li>
            <li><a href="portfolio?addCoin=theta-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2538/large/theta-token-logo.png?1548387191" /></span><span class="pl-3 mx-0 my-auto">Theta Network</span></a></li>
            <li><a href="portfolio?addCoin=compound-ether" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10643/large/ceth2.JPG?1581389598" /></span><span class="pl-3 mx-0 my-auto">cETH</span></a></li>
            <li><a href="portfolio?addCoin=fantom" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4001/large/Fantom.png?1558015016" /></span><span class="pl-3 mx-0 my-auto">Fantom</span></a></li>
            <li><a href="portfolio?addCoin=monero" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/69/large/monero_logo.png?1547033729" /></span><span class="pl-3 mx-0 my-auto">Monero</span></a></li>
            <li><a href="portfolio?addCoin=hedera-hashgraph" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3688/large/mqTDGK7Q.png?1566256777" /></span><span class="pl-3 mx-0 my-auto">Hedera</span></a></li>
            <li><a href="portfolio?addCoin=staked-ether" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13442/large/steth_logo.png?1608607546" /></span><span class="pl-3 mx-0 my-auto">Lido Staked Ether</span></a></li>
            <li><a href="portfolio?addCoin=crypto-com-chain" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/7310/large/cypto.png?1547043960" /></span><span class="pl-3 mx-0 my-auto">Crypto.com Coin</span></a></li>
            <li><a href="portfolio?addCoin=elrond-erd-2" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12335/large/elrond3_360.png?1626341589" /></span><span class="pl-3 mx-0 my-auto">Elrond</span></a></li>
            <li><a href="portfolio?addCoin=ecash" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/16646/large/Logo_final-22.png?1628239446" /></span><span class="pl-3 mx-0 my-auto">eCash</span></a></li>
            <li><a href="portfolio?addCoin=eos" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/738/large/eos-eos-logo.png?1547034481" /></span><span class="pl-3 mx-0 my-auto">EOS</span></a></li>
            <li><a href="portfolio?addCoin=pancakeswap-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12632/large/pancakeswap-cake-logo_%281%29.png?1629359065" /></span><span class="pl-3 mx-0 my-auto">PancakeSwap</span></a></li>
            <li><a href="portfolio?addCoin=okb" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4463/large/okb_token.png?1548386209" /></span><span class="pl-3 mx-0 my-auto">OKB</span></a></li>
            <li><a href="portfolio?addCoin=bitcoin-cash-abc-2" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13120/large/Logo_final-21.png?1624892810" /></span><span class="pl-3 mx-0 my-auto">Bitcoin Cash ABC</span></a></li>
            <li><a href="portfolio?addCoin=klay-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9672/large/CjbT82vP_400x400.jpg?1570548320" /></span><span class="pl-3 mx-0 my-auto">Klaytn</span></a></li>
            <li><a href="portfolio?addCoin=iota" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/692/large/IOTA_Swirl.png?1604238557" /></span><span class="pl-3 mx-0 my-auto">IOTA</span></a></li>
            <li><a href="portfolio?addCoin=aave" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12645/large/AAVE.png?1601374110" /></span><span class="pl-3 mx-0 my-auto">Aave</span></a></li>
            <li><a href="portfolio?addCoin=quant-network" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3370/large/5ZOu7brX_400x400.jpg?1612437252" /></span><span class="pl-3 mx-0 my-auto">Quant</span></a></li>
            <li><a href="portfolio?addCoin=near" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10365/large/near_icon.png?1601359077" /></span><span class="pl-3 mx-0 my-auto">Near</span></a></li>
            <li><a href="portfolio?addCoin=the-graph" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13397/large/Graph_Token.png?1608145566" /></span><span class="pl-3 mx-0 my-auto">The Graph</span></a></li>
            <li><a href="portfolio?addCoin=bitcoin-cash-sv" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6799/large/BSV.png?1558947902" /></span><span class="pl-3 mx-0 my-auto">Bitcoin SV</span></a></li>
            <li><a href="portfolio?addCoin=neo" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/480/large/NEO_512_512.png?1594357361" /></span><span class="pl-3 mx-0 my-auto">NEO</span></a></li>
            <li><a href="portfolio?addCoin=waves" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/425/large/waves.png?1548386117" /></span><span class="pl-3 mx-0 my-auto">Waves</span></a></li>
            <li><a href="portfolio?addCoin=olympus" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14483/large/token_OHM_%281%29.png?1628311611" /></span><span class="pl-3 mx-0 my-auto">Olympus</span></a></li>
            <li><a href="portfolio?addCoin=compound-usd-coin" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9442/large/Compound_USDC.png?1567581577" /></span><span class="pl-3 mx-0 my-auto">cUSDC</span></a></li>
            <li><a href="portfolio?addCoin=kusama" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9568/large/m4zRhP5e_400x400.jpg?1576190080" /></span><span class="pl-3 mx-0 my-auto">Kusama</span></a></li>
            <li><a href="portfolio?addCoin=terrausd" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12681/large/UST.png?1601612407" /></span><span class="pl-3 mx-0 my-auto">TerraUSD</span></a></li>
            <li><a href="portfolio?addCoin=cdai" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9281/large/cDAI.png?1576467585" /></span><span class="pl-3 mx-0 my-auto">cDAI</span></a></li>
            <li><a href="portfolio?addCoin=leo-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8418/large/leo-token.png?1558326215" /></span><span class="pl-3 mx-0 my-auto">LEO Token</span></a></li>
            <li><a href="portfolio?addCoin=celsius-degree-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3263/large/CEL_logo.png?1609598753" /></span><span class="pl-3 mx-0 my-auto">Celsius Network</span></a></li>
            <li><a href="portfolio?addCoin=bittorrent-2" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/7595/large/BTT_Token_Graphic.png?1555066995" /></span><span class="pl-3 mx-0 my-auto">BitTorrent</span></a></li>
            <li><a href="portfolio?addCoin=arweave" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4343/large/oRt6SiEN_400x400.jpg?1591059616" /></span><span class="pl-3 mx-0 my-auto">Arweave</span></a></li>
            <li><a href="portfolio?addCoin=huobi-btc" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12407/large/Unknown-5.png?1599624896" /></span><span class="pl-3 mx-0 my-auto">Huobi BTC</span></a></li>
            <li><a href="portfolio?addCoin=harmony" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4344/large/Y88JAze.png?1565065793" /></span><span class="pl-3 mx-0 my-auto">Harmony</span></a></li>
            <li><a href="portfolio?addCoin=maker" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1364/large/Mark_Maker.png?1585191826" /></span><span class="pl-3 mx-0 my-auto">Maker</span></a></li>
            <li><a href="portfolio?addCoin=amp-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12409/large/amp-200x200.png?1599625397" /></span><span class="pl-3 mx-0 my-auto">Amp</span></a></li>
            <li><a href="portfolio?addCoin=blockstack" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2069/large/Stacks_logo_full.png?1604112510" /></span><span class="pl-3 mx-0 my-auto">Stacks</span></a></li>
            <li><a href="portfolio?addCoin=omisego" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/776/large/OMG_Network.jpg?1591167168" /></span><span class="pl-3 mx-0 my-auto">OMG Network</span></a></li>
            <li><a href="portfolio?addCoin=sushi" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12271/large/512x512_Logo_no_chop.png?1606986688" /></span><span class="pl-3 mx-0 my-auto">Sushi</span></a></li>
            <li><a href="portfolio?addCoin=thorchain" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6595/large/RUNE.png?1614160507" /></span><span class="pl-3 mx-0 my-auto">THORChain</span></a></li>
            <li><a href="portfolio?addCoin=dash" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/19/large/dash-logo.png?1548385930" /></span><span class="pl-3 mx-0 my-auto">Dash</span></a></li>
            <li><a href="portfolio?addCoin=helium" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4284/large/Helium_HNT.png?1612620071" /></span><span class="pl-3 mx-0 my-auto">Helium</span></a></li>
            <li><a href="portfolio?addCoin=compound-governance-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10775/large/COMP.png?1592625425" /></span><span class="pl-3 mx-0 my-auto">Compound</span></a></li>
            <li><a href="portfolio?addCoin=celo" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11090/large/icon-celo-CELO-color-500.png?1592293590" /></span><span class="pl-3 mx-0 my-auto">Celo</span></a></li>
            <li><a href="portfolio?addCoin=decred" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/329/large/decred.png?1547034093" /></span><span class="pl-3 mx-0 my-auto">Decred</span></a></li>
            <li><a href="portfolio?addCoin=ecomi" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4428/large/ECOMI.png?1557928886" /></span><span class="pl-3 mx-0 my-auto">ECOMI</span></a></li>
            <li><a href="portfolio?addCoin=havven" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3406/large/SNX.png?1598631139" /></span><span class="pl-3 mx-0 my-auto">Synthetix Network Token</span></a></li>
            <li><a href="portfolio?addCoin=chiliz" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8834/large/Chiliz.png?1561970540" /></span><span class="pl-3 mx-0 my-auto">Chiliz</span></a></li>
            <li><a href="portfolio?addCoin=holotoken" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3348/large/Holologo_Profile.png?1547037966" /></span><span class="pl-3 mx-0 my-auto">Holo</span></a></li>
            <li><a href="portfolio?addCoin=theta-fuel" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8029/large/1_0YusgngOrriVg4ZYx4wOFQ.png?1553483622" /></span><span class="pl-3 mx-0 my-auto">Theta Fuel</span></a></li>
            <li><a href="portfolio?addCoin=nem" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/242/large/NEM_Logo_256x256.png?1598687029" /></span><span class="pl-3 mx-0 my-auto">NEM</span></a></li>
            <li><a href="portfolio?addCoin=magic-internet-money" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/16786/large/mimlogopng.png?1624979612" /></span><span class="pl-3 mx-0 my-auto">Magic Internet Money</span></a></li>
            <li><a href="portfolio?addCoin=xdce-crowd-sale" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2912/large/xdc-icon.png?1633700890" /></span><span class="pl-3 mx-0 my-auto">XDC Network</span></a></li>
            <li><a href="portfolio?addCoin=enjincoin" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1102/large/enjin-coin-logo.png?1547035078" /></span><span class="pl-3 mx-0 my-auto">Enjin Coin</span></a></li>
            <li><a href="portfolio?addCoin=icon" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1060/large/icon-icx-logo.png?1547035003" /></span><span class="pl-3 mx-0 my-auto">ICON</span></a></li>
            <li><a href="portfolio?addCoin=zcash" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/486/large/circle-zcash-color.png?1547034197" /></span><span class="pl-3 mx-0 my-auto">Zcash</span></a></li>
            <li><a href="portfolio?addCoin=bitclout" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/16310/large/k-h6Wead_400x400.jpg?1623726134" /></span><span class="pl-3 mx-0 my-auto">Decentralized Social</span></a></li>
            <li><a href="portfolio?addCoin=true-usd" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3449/large/tusd.png?1618395665" /></span><span class="pl-3 mx-0 my-auto">TrueUSD</span></a></li>
            <li><a href="portfolio?addCoin=qtum" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/684/large/qtum.png?1547034438" /></span><span class="pl-3 mx-0 my-auto">Qtum</span></a></li>
            <li><a href="portfolio?addCoin=bitcoin-gold" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1043/large/bitcoin-gold-logo.png?1547034978" /></span><span class="pl-3 mx-0 my-auto">Bitcoin Gold</span></a></li>
            <li><a href="portfolio?addCoin=dydx" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/17500/large/hjnIm9bV.jpg?1628009360" /></span><span class="pl-3 mx-0 my-auto">dYdX</span></a></li>
            <li><a href="portfolio?addCoin=yearn-finance" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11849/large/yfi-192x192.png?1598325330" /></span><span class="pl-3 mx-0 my-auto">yearn.finance</span></a></li>
            <li><a href="portfolio?addCoin=huobi-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2822/large/huobi-token-logo.png?1547036992" /></span><span class="pl-3 mx-0 my-auto">Huobi Token</span></a></li>
            <li><a href="portfolio?addCoin=flow" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13446/large/5f6294c0c7a8cda55cb1c936_Flow_Wordmark.png?1631696776" /></span><span class="pl-3 mx-0 my-auto">Flow</span></a></li>
            <li><a href="portfolio?addCoin=iostoken" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2523/large/IOST.png?1557555183" /></span><span class="pl-3 mx-0 my-auto">IOST</span></a></li>
            <li><a href="portfolio?addCoin=zilliqa" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2687/large/Zilliqa-logo.png?1547036894" /></span><span class="pl-3 mx-0 my-auto">Zilliqa</span></a></li>
            <li><a href="portfolio?addCoin=mina-protocol" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/15628/large/JM4_vQ34_400x400.png?1621394004" /></span><span class="pl-3 mx-0 my-auto">Mina Protocol</span></a></li>
            <li><a href="portfolio?addCoin=spell-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/15861/large/abracadabra-3.png?1622544862" /></span><span class="pl-3 mx-0 my-auto">Spell Token</span></a></li>
            <li><a href="portfolio?addCoin=mdex" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13775/large/mdex.png?1611739676" /></span><span class="pl-3 mx-0 my-auto">Mdex</span></a></li>
          </ul>
        </div>

      </div>
    </div>
  </div>
  <!-- SEARCH MODAL END -->

<?php include_once("includes/footer.php") ?>
<script>
  drawLineChart();
  drawdoughChart();
</script>
</body>
</html>