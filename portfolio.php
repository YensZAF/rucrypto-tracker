<?php include_once("includes/config.php") ?>
<?php include_once("includes/secure.php") ?>
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
                <th class="px-6 py-2 text-xs text-gray-500">
                    #
                </th>
                <th class="px-6 py-2 text-xs text-gray-500">
                    Coin
                </th>
                <th class="px-6 py-2 text-xs text-gray-500">
                    Price
                </th>
                <th class="px-6 py-2 text-xs text-gray-500">
                    24h
                </th>
                <th class="px-6 py-2 text-xs text-gray-500">
                    Mkt Cap
                </th>
                <th class="px-6 py-2 text-xs text-gray-500">
                    PNL
                </th>
                <th class="px-6 py-2 text-xs text-gray-500">
                    Buy/Sell
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-300">
            <tr class="whitespace-nowrap">
                <td class="px-6 py-4 text-sm text-gray-500">
                    1
                </td>
                <td class="px-6 py-4">
                    <div id="topCoinID-1" class="text-sm text-gray-900">
                        ID
                    </div>
                </td>
                <td class="px-6 py-4">
                    <div id="topCoinName-1" class="text-sm text-gray-500">
                        Coin
                    </div>
                </td>
                <td id="topCoinPrice-1" class="px-6 py-4 text-sm text-gray-500">
                    0%
                </td>
                <td id="topCoinChange-1" class="px-6 py-4 text-sm text-gray-500">
                    $0.00
                </td>
                <td id="topCoinChange-1" class="px-6 py-4 text-sm text-gray-500">
                    0%
                </td>
                <td id="topCoinChange-1" class="px-6 py-4 text-sm text-gray-500">
                  <a href="login" class="inline-flex items-center font-bold hover:text-blue-500 text-gray-700 text-xs text-center align-middle">
                      <span>
                        <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.8" viewBox="-2 -2 25 25" stroke="currentColor">
                          <path d="M12.522,10.4l-3.559,3.562c-0.172,0.173-0.451,0.176-0.625,0c-0.173-0.173-0.173-0.451,0-0.624l3.248-3.25L8.161,6.662c-0.173-0.173-0.173-0.452,0-0.624c0.172-0.175,0.451-0.175,0.624,0l3.738,3.736C12.695,9.947,12.695,10.228,12.522,10.4 M18.406,10c0,4.644-3.764,8.406-8.406,8.406c-4.644,0-8.406-3.763-8.406-8.406S5.356,1.594,10,1.594C14.643,1.594,18.406,5.356,18.406,10M17.521,10c0-4.148-3.374-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.147,17.521,17.521,14.147,17.521,10"></path>
                        </svg>
                      </span>
                    </a>
                </td>
            </tr>
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
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1/large/bitcoin.png?1547033579" /></span><span>Bitcoin</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/279/large/ethereum.png?1595348880" /></span><span>Ethereum</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/325/large/Tether-logo.png?1598003707" /></span><span>Tether</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/975/large/cardano.png?1547034860" /></span><span>Cardano</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/825/large/binance-coin-logo.png?1547034615" /></span><span>Binance Coin</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/44/large/xrp-symbol-white-128.png?1605778731" /></span><span>XRP</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4128/large/coinmarketcap-solana-200.png?1616489452" /></span><span>Solana</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12171/large/aJGBjJFU_400x400.jpg?1597804776" /></span><span>Polkadot</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6319/large/USD_Coin_icon.png?1547042389" /></span><span>USD Coin</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/5/large/dogecoin.png?1547792256" /></span><span>Dogecoin</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8284/large/luna1557227471663.png?1567147072" /></span><span>Terra</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11939/large/shiba.png?1622619446" /></span><span>Shiba Inu</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9576/large/BUSD.png?1568947766" /></span><span>Binance USD</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12504/large/uniswap-uni.png?1600306604" /></span><span>Uniswap</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2/large/litecoin.png?1547033580" /></span><span>Litecoin</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12559/large/coin-round-red.png?1604021818" /></span><span>Avalanche</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/7598/large/wrapped_bitcoin_wbtc.png?1548822744" /></span><span>Wrapped Bitcoin</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/877/large/chainlink-new-logo.png?1547034700" /></span><span>Chainlink</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/780/large/bitcoin-cash-circle.png?1594689492" /></span><span>Bitcoin Cash</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4380/large/download.png?1547039725" /></span><span>Algorand</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1481/large/cosmos_hub.png?1555657960" /></span><span>Cosmos</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4713/large/matic-token-icon.png?1624446912" /></span><span>Polygon</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/100/large/Stellar_symbol_black_RGB.png?1552356157" /></span><span>Stellar</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12817/large/filecoin.png?1602753933" /></span><span>Filecoin</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14495/large/Internet_Computer_logo.png?1620703073" /></span><span>Internet Computer</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1167/large/VeChain-Logo-768x725.png?1547035194" /></span><span>VeChain</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13029/large/axie_infinity_logo.png?1604471082" /></span><span>Axie Infinity</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/453/large/ethereum-classic-logo.png?1547034169" /></span><span>Ethereum Classic</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1094/large/tron-logo.png?1547035066" /></span><span>TRON</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9956/large/dai-multi-collateral-mcd.png?1574218774" /></span><span>Dai</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9026/large/F.png?1609051564" /></span><span>FTX Token</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2538/large/theta-token-logo.png?1548387191" /></span><span>Theta Network</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/976/large/Tezos-logo.png?1547034862" /></span><span>Tezos</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4001/large/Fantom.png?1558015016" /></span><span>Fantom</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10643/large/ceth2.JPG?1581389598" /></span><span>cETH</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3688/large/mqTDGK7Q.png?1566256777" /></span><span>Hedera</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/69/large/monero_logo.png?1547033729" /></span><span>Monero</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12335/large/elrond3_360.png?1626341589" /></span><span>Elrond</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13442/large/steth_logo.png?1608607546" /></span><span>Lido Staked Ether</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/7310/large/cypto.png?1547043960" /></span><span>Crypto.com Coin</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/738/large/eos-eos-logo.png?1547034481" /></span><span>EOS</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12632/large/pancakeswap-cake-logo_%281%29.png?1629359065" /></span><span>PancakeSwap</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4463/large/okb_token.png?1548386209" /></span><span>OKB</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/16646/large/Logo_final-22.png?1628239446" /></span><span>eCash</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/692/large/IOTA_Swirl.png?1604238557" /></span><span>IOTA</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9672/large/CjbT82vP_400x400.jpg?1570548320" /></span><span>Klaytn</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3370/large/5ZOu7brX_400x400.jpg?1612437252" /></span><span>Quant</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12645/large/AAVE.png?1601374110" /></span><span>Aave</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13120/large/Logo_final-21.png?1624892810" /></span><span>Bitcoin Cash ABC</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10365/large/near_icon.png?1601359077" /></span><span>Near</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6799/large/BSV.png?1558947902" /></span><span>Bitcoin SV</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13397/large/Graph_Token.png?1608145566" /></span><span>The Graph</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/480/large/NEO_512_512.png?1594357361" /></span><span>NEO</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9568/large/m4zRhP5e_400x400.jpg?1576190080" /></span><span>Kusama</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9442/large/Compound_USDC.png?1567581577" /></span><span>cUSDC</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14483/large/token_OHM_%281%29.png?1628311611" /></span><span>Olympus</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12681/large/UST.png?1601612407" /></span><span>TerraUSD</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/425/large/waves.png?1548386117" /></span><span>Waves</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9281/large/cDAI.png?1576467585" /></span><span>cDAI</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8418/large/leo-token.png?1558326215" /></span><span>LEO Token</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/7595/large/BTT_Token_Graphic.png?1555066995" /></span><span>BitTorrent</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4344/large/Y88JAze.png?1565065793" /></span><span>Harmony</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3263/large/CEL_logo.png?1609598753" /></span><span>Celsius Network</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4343/large/oRt6SiEN_400x400.jpg?1591059616" /></span><span>Arweave</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12407/large/Unknown-5.png?1599624896" /></span><span>Huobi BTC</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12409/large/amp-200x200.png?1599625397" /></span><span>Amp</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1364/large/Mark_Maker.png?1585191826" /></span><span>Maker</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2069/large/Stacks_logo_full.png?1604112510" /></span><span>Stacks</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12271/large/512x512_Logo_no_chop.png?1606986688" /></span><span>Sushi</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6595/large/RUNE.png?1614160507" /></span><span>THORChain</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/776/large/OMG_Network.jpg?1591167168" /></span><span>OMG Network</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/19/large/dash-logo.png?1548385930" /></span><span>Dash</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4284/large/Helium_HNT.png?1612620071" /></span><span>Helium</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10775/large/COMP.png?1592625425" /></span><span>Compound</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11090/large/icon-celo-CELO-color-500.png?1592293590" /></span><span>Celo</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/329/large/decred.png?1547034093" /></span><span>Decred</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3406/large/SNX.png?1598631139" /></span><span>Synthetix Network Token</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8834/large/Chiliz.png?1561970540" /></span><span>Chiliz</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3348/large/Holologo_Profile.png?1547037966" /></span><span>Holo</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8029/large/1_0YusgngOrriVg4ZYx4wOFQ.png?1553483622" /></span><span>Theta Fuel</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4428/large/ECOMI.png?1557928886" /></span><span>ECOMI</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/242/large/NEM_Logo_256x256.png?1598687029" /></span><span>NEM</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1102/large/enjin-coin-logo.png?1547035078" /></span><span>Enjin Coin</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1060/large/icon-icx-logo.png?1547035003" /></span><span>ICON</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2912/large/xdc-icon.png?1633700890" /></span><span>XDC Network</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/486/large/circle-zcash-color.png?1547034197" /></span><span>Zcash</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/16310/large/k-h6Wead_400x400.jpg?1623726134" /></span><span>Decentralized Social</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/684/large/qtum.png?1547034438" /></span><span>Qtum</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/17500/large/hjnIm9bV.jpg?1628009360" /></span><span>dYdX</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3449/large/tusd.png?1618395665" /></span><span>TrueUSD</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/16786/large/mimlogopng.png?1624979612" /></span><span>Magic Internet Money</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11849/large/yfi-192x192.png?1598325330" /></span><span>yearn.finance</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2822/large/huobi-token-logo.png?1547036992" /></span><span>Huobi Token</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1043/large/bitcoin-gold-logo.png?1547034978" /></span><span>Bitcoin Gold</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2523/large/IOST.png?1557555183" /></span><span>IOST</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/15861/large/abracadabra-3.png?1622544862" /></span><span>Spell Token</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13446/large/5f6294c0c7a8cda55cb1c936_Flow_Wordmark.png?1631696776" /></span><span>Flow</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2687/large/Zilliqa-logo.png?1547036894" /></span><span>Zilliqa</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/15628/large/JM4_vQ34_400x400.png?1621394004" /></span><span>Mina Protocol</span></a></li>
            <li><a href="#" class="p-2 block text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3412/large/ravencoin.png?1548386057" /></span><span>Ravencoin</span></a></li>
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