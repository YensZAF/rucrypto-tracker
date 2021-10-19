<?php include_once("includes/config.php"); ?>
<?php include_once("includes/secure.php"); ?>

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
  <script src="js/palette.js"></script>
</head>
<body>

<?php include_once("includes/navigation.php") ?>

<h2><?php echo $CURRENT_PAGE ?></h2>

  <div class="mb-8 p-2 w-full flex justify-center flex-wrap bg-grey-light">
    <div class="h-auto w-full lg:w-1/5 md:w-1/3  bg-grey">
      <canvas id="doughChart" height="400" width="400"></canvas>
    </div>
    <!-- <div class="h-auto w-full md:w-1/2 lg:w-1/4 bg-grey">
      <canvas id="lineChart" height="400" width="400"></canvas>
    </div> -->
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
  <div class="container flex justify-center mx-auto pb-10">
    <div class="border-b border-gray-200 shadow overflow-auto">
      <table class="divide-y divide-gray-300 ">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-2 text-xs text-gray-500">Img</th>
                <th class="px-6 py-2 text-xs text-gray-500 text-left">Coin</th>
                <th class="px-6 py-2 text-xs text-gray-500">Price Per</th>
                <th class="px-6 py-2 text-xs text-gray-500">Quantity</th>
                <th class="px-6 py-2 text-xs text-gray-500">24h</th>
                <th class="px-6 py-2 text-xs text-gray-500">Mkt Cap</th>
                <th class="px-6 py-2 text-xs text-gray-500">PNL</th>
                <th class="px-6 py-2 text-xs text-gray-500">Trade/Delete</th>
                <th class="hidden"></th>
            </tr>
        </thead>
        <tbody id="inventoryTable" class="bg-white divide-y divide-gray-300">
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
      <div class="modal-content text-left h-1/2">
        <!--Title-->
        <div class="flex justify-between items-center pb-3 px-6 py-4">
          <p class="text-2xl font-bold">Search for Coins!</p>
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
            <li><a href="portfolio.php?addCoin=bitcoin" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1/large/bitcoin.png?1547033579" /></span><span class="pl-3 mx-0 my-auto">Bitcoin</span></a></li>
            <li><a href="portfolio.php?addCoin=ethereum" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/279/large/ethereum.png?1595348880" /></span><span class="pl-3 mx-0 my-auto">Ethereum</span></a></li>
            <li><a href="portfolio.php?addCoin=binancecoin" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/825/large/binance-coin-logo.png?1547034615" /></span><span class="pl-3 mx-0 my-auto">Binance Coin</span></a></li>
            <li><a href="portfolio.php?addCoin=tether" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/325/large/Tether-logo.png?1598003707" /></span><span class="pl-3 mx-0 my-auto">Tether</span></a></li>
            <li><a href="portfolio.php?addCoin=cardano" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/975/large/cardano.png?1547034860" /></span><span class="pl-3 mx-0 my-auto">Cardano</span></a></li>
            <li><a href="portfolio.php?addCoin=ripple" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/44/large/xrp-symbol-white-128.png?1605778731" /></span><span class="pl-3 mx-0 my-auto">XRP</span></a></li>
            <li><a href="portfolio.php?addCoin=solana" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4128/large/coinmarketcap-solana-200.png?1616489452" /></span><span class="pl-3 mx-0 my-auto">Solana</span></a></li>
            <li><a href="portfolio.php?addCoin=polkadot" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12171/large/aJGBjJFU_400x400.jpg?1597804776" /></span><span class="pl-3 mx-0 my-auto">Polkadot</span></a></li>
            <li><a href="portfolio.php?addCoin=usd-coin" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6319/large/USD_Coin_icon.png?1547042389" /></span><span class="pl-3 mx-0 my-auto">USD Coin</span></a></li>
            <li><a href="portfolio.php?addCoin=dogecoin" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/5/large/dogecoin.png?1547792256" /></span><span class="pl-3 mx-0 my-auto">Dogecoin</span></a></li>
            <li><a href="portfolio.php?addCoin=terra-luna" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8284/large/luna1557227471663.png?1567147072" /></span><span class="pl-3 mx-0 my-auto">Terra</span></a></li>
            <li><a href="portfolio.php?addCoin=shiba-inu" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11939/large/shiba.png?1622619446" /></span><span class="pl-3 mx-0 my-auto">Shiba Inu</span></a></li>
            <li><a href="portfolio.php?addCoin=uniswap" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12504/large/uniswap-uni.png?1600306604" /></span><span class="pl-3 mx-0 my-auto">Uniswap</span></a></li>
            <li><a href="portfolio.php?addCoin=wrapped-bitcoin" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/7598/large/wrapped_bitcoin_wbtc.png?1548822744" /></span><span class="pl-3 mx-0 my-auto">Wrapped Bitcoin</span></a></li>
            <li><a href="portfolio.php?addCoin=binance-usd" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9576/large/BUSD.png?1568947766" /></span><span class="pl-3 mx-0 my-auto">Binance USD</span></a></li>
            <li><a href="portfolio.php?addCoin=litecoin" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2/large/litecoin.png?1547033580" /></span><span class="pl-3 mx-0 my-auto">Litecoin</span></a></li>
            <li><a href="portfolio.php?addCoin=avalanche-2" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12559/large/coin-round-red.png?1604021818" /></span><span class="pl-3 mx-0 my-auto">Avalanche</span></a></li>
            <li><a href="portfolio.php?addCoin=chainlink" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/877/large/chainlink-new-logo.png?1547034700" /></span><span class="pl-3 mx-0 my-auto">Chainlink</span></a></li>
            <li><a href="portfolio.php?addCoin=bitcoin-cash" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/780/large/bitcoin-cash-circle.png?1594689492" /></span><span class="pl-3 mx-0 my-auto">Bitcoin Cash</span></a></li>
            <li><a href="portfolio.php?addCoin=algorand" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4380/large/download.png?1547039725" /></span><span class="pl-3 mx-0 my-auto">Algorand</span></a></li>
            <li><a href="portfolio.php?addCoin=matic-network" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4713/large/matic-token-icon.png?1624446912" /></span><span class="pl-3 mx-0 my-auto">Polygon</span></a></li>
            <li><a href="portfolio.php?addCoin=stellar" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/100/large/Stellar_symbol_black_RGB.png?1552356157" /></span><span class="pl-3 mx-0 my-auto">Stellar</span></a></li>
            <li><a href="portfolio.php?addCoin=cosmos" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1481/large/cosmos_hub.png?1555657960" /></span><span class="pl-3 mx-0 my-auto">Cosmos</span></a></li>
            <li><a href="portfolio.php?addCoin=vechain" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1167/large/VeChain-Logo-768x725.png?1547035194" /></span><span class="pl-3 mx-0 my-auto">VeChain</span></a></li>
            <li><a href="portfolio.php?addCoin=axie-infinity" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13029/large/axie_infinity_logo.png?1604471082" /></span><span class="pl-3 mx-0 my-auto">Axie Infinity</span></a></li>
            <li><a href="portfolio.php?addCoin=internet-computer" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14495/large/Internet_Computer_logo.png?1620703073" /></span><span class="pl-3 mx-0 my-auto">Internet Computer</span></a></li>
            <li><a href="portfolio.php?addCoin=filecoin" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12817/large/filecoin.png?1602753933" /></span><span class="pl-3 mx-0 my-auto">Filecoin</span></a></li>
            <li><a href="portfolio.php?addCoin=dai" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9956/large/dai-multi-collateral-mcd.png?1574218774" /></span><span class="pl-3 mx-0 my-auto">Dai</span></a></li>
            <li><a href="portfolio.php?addCoin=tron" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1094/large/tron-logo.png?1547035066" /></span><span class="pl-3 mx-0 my-auto">TRON</span></a></li>
            <li><a href="portfolio.php?addCoin=ethereum-classic" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/453/large/ethereum-classic-logo.png?1547034169" /></span><span class="pl-3 mx-0 my-auto">Ethereum Classic</span></a></li>
            <li><a href="portfolio.php?addCoin=ftx-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9026/large/F.png?1609051564" /></span><span class="pl-3 mx-0 my-auto">FTX Token</span></a></li>
            <li><a href="portfolio.php?addCoin=compound-ether" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10643/large/ceth2.JPG?1581389598" /></span><span class="pl-3 mx-0 my-auto">cETH</span></a></li>
            <li><a href="portfolio.php?addCoin=theta-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2538/large/theta-token-logo.png?1548387191" /></span><span class="pl-3 mx-0 my-auto">Theta Network</span></a></li>
            <li><a href="portfolio.php?addCoin=fantom" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4001/large/Fantom.png?1558015016" /></span><span class="pl-3 mx-0 my-auto">Fantom</span></a></li>
            <li><a href="portfolio.php?addCoin=tezos" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/976/large/Tezos-logo.png?1547034862" /></span><span class="pl-3 mx-0 my-auto">Tezos</span></a></li>
            <li><a href="portfolio.php?addCoin=hedera-hashgraph" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3688/large/mqTDGK7Q.png?1566256777" /></span><span class="pl-3 mx-0 my-auto">Hedera</span></a></li>
            <li><a href="portfolio.php?addCoin=staked-ether" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13442/large/steth_logo.png?1608607546" /></span><span class="pl-3 mx-0 my-auto">Lido Staked Ether</span></a></li>
            <li><a href="portfolio.php?addCoin=crypto-com-chain" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/7310/large/cypto.png?1547043960" /></span><span class="pl-3 mx-0 my-auto">Crypto.com Coin</span></a></li>
            <li><a href="portfolio.php?addCoin=monero" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/69/large/monero_logo.png?1547033729" /></span><span class="pl-3 mx-0 my-auto">Monero</span></a></li>
            <li><a href="portfolio.php?addCoin=elrond-erd-2" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12335/large/elrond3_360.png?1626341589" /></span><span class="pl-3 mx-0 my-auto">Elrond</span></a></li>
            <li><a href="portfolio.php?addCoin=flow" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13446/large/5f6294c0c7a8cda55cb1c936_Flow_Wordmark.png?1631696776" /></span><span class="pl-3 mx-0 my-auto">Flow</span></a></li>
            <li><a href="portfolio.php?addCoin=pancakeswap-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12632/large/pancakeswap-cake-logo_%281%29.png?1629359065" /></span><span class="pl-3 mx-0 my-auto">PancakeSwap</span></a></li>
            <li><a href="portfolio.php?addCoin=eos" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/738/large/eos-eos-logo.png?1547034481" /></span><span class="pl-3 mx-0 my-auto">EOS</span></a></li>
            <li><a href="portfolio.php?addCoin=okb" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4463/large/okb_token.png?1548386209" /></span><span class="pl-3 mx-0 my-auto">OKB</span></a></li>
            <li><a href="portfolio.php?addCoin=cdai" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9281/large/cDAI.png?1576467585" /></span><span class="pl-3 mx-0 my-auto">cDAI</span></a></li>
            <li><a href="portfolio.php?addCoin=near" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10365/large/near_icon.png?1601359077" /></span><span class="pl-3 mx-0 my-auto">Near</span></a></li>
            <li><a href="portfolio.php?addCoin=klay-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9672/large/CjbT82vP_400x400.jpg?1570548320" /></span><span class="pl-3 mx-0 my-auto">Klaytn</span></a></li>
            <li><a href="portfolio.php?addCoin=aave" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12645/large/AAVE.png?1601374110" /></span><span class="pl-3 mx-0 my-auto">Aave</span></a></li>
            <li><a href="portfolio.php?addCoin=quant-network" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3370/large/5ZOu7brX_400x400.jpg?1612437252" /></span><span class="pl-3 mx-0 my-auto">Quant</span></a></li>
            <li><a href="portfolio.php?addCoin=ecash" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/16646/large/Logo_final-22.png?1628239446" /></span><span class="pl-3 mx-0 my-auto">eCash</span></a></li>
            <li><a href="portfolio.php?addCoin=the-graph" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13397/large/Graph_Token.png?1608145566" /></span><span class="pl-3 mx-0 my-auto">The Graph</span></a></li>
            <li><a href="portfolio.php?addCoin=compound-usd-coin" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9442/large/Compound_USDC.png?1567581577" /></span><span class="pl-3 mx-0 my-auto">cUSDC</span></a></li>
            <li><a href="portfolio.php?addCoin=bitcoin-cash-abc-2" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13120/large/Logo_final-21.png?1624892810" /></span><span class="pl-3 mx-0 my-auto">Bitcoin Cash ABC</span></a></li>
            <li><a href="portfolio.php?addCoin=iota" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/692/large/IOTA_Swirl.png?1604238557" /></span><span class="pl-3 mx-0 my-auto">IOTA</span></a></li>
            <li><a href="portfolio.php?addCoin=bitcoin-cash-sv" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6799/large/BSV.png?1558947902" /></span><span class="pl-3 mx-0 my-auto">Bitcoin SV</span></a></li>
            <li><a href="portfolio.php?addCoin=kusama" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9568/large/m4zRhP5e_400x400.jpg?1576190080" /></span><span class="pl-3 mx-0 my-auto">Kusama</span></a></li>
            <li><a href="portfolio.php?addCoin=neo" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/480/large/NEO_512_512.png?1594357361" /></span><span class="pl-3 mx-0 my-auto">NEO</span></a></li>
            <li><a href="portfolio.php?addCoin=waves" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/425/large/waves.png?1548386117" /></span><span class="pl-3 mx-0 my-auto">Waves</span></a></li>
            <li><a href="portfolio.php?addCoin=leo-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8418/large/leo-token.png?1558326215" /></span><span class="pl-3 mx-0 my-auto">LEO Token</span></a></li>
            <li><a href="portfolio.php?addCoin=terrausd" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12681/large/UST.png?1601612407" /></span><span class="pl-3 mx-0 my-auto">TerraUSD</span></a></li>
            <li><a href="portfolio.php?addCoin=arweave" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4343/large/oRt6SiEN_400x400.jpg?1591059616" /></span><span class="pl-3 mx-0 my-auto">Arweave</span></a></li>
            <li><a href="portfolio.php?addCoin=huobi-btc" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12407/large/Unknown-5.png?1599624896" /></span><span class="pl-3 mx-0 my-auto">Huobi BTC</span></a></li>
            <li><a href="portfolio.php?addCoin=harmony" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4344/large/Y88JAze.png?1565065793" /></span><span class="pl-3 mx-0 my-auto">Harmony</span></a></li>
            <li><a href="portfolio.php?addCoin=olympus" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14483/large/token_OHM_%281%29.png?1628311611" /></span><span class="pl-3 mx-0 my-auto">Olympus</span></a></li>
            <li><a href="portfolio.php?addCoin=bittorrent-2" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/7595/large/BTT_Token_Graphic.png?1555066995" /></span><span class="pl-3 mx-0 my-auto">BitTorrent</span></a></li>
            <li><a href="portfolio.php?addCoin=celsius-degree-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3263/large/CEL_logo.png?1609598753" /></span><span class="pl-3 mx-0 my-auto">Celsius Network</span></a></li>
            <li><a href="portfolio.php?addCoin=amp-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12409/large/amp-200x200.png?1599625397" /></span><span class="pl-3 mx-0 my-auto">Amp</span></a></li>
            <li><a href="portfolio.php?addCoin=maker" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1364/large/Mark_Maker.png?1585191826" /></span><span class="pl-3 mx-0 my-auto">Maker</span></a></li>
            <li><a href="portfolio.php?addCoin=blockstack" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2069/large/Stacks_logo_full.png?1604112510" /></span><span class="pl-3 mx-0 my-auto">Stacks</span></a></li>
            <li><a href="portfolio.php?addCoin=helium" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4284/large/Helium_HNT.png?1612620071" /></span><span class="pl-3 mx-0 my-auto">Helium</span></a></li>
            <li><a href="portfolio.php?addCoin=sushi" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12271/large/512x512_Logo_no_chop.png?1606986688" /></span><span class="pl-3 mx-0 my-auto">Sushi</span></a></li>
            <li><a href="portfolio.php?addCoin=thorchain" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6595/large/RUNE.png?1614160507" /></span><span class="pl-3 mx-0 my-auto">THORChain</span></a></li>
            <li><a href="portfolio.php?addCoin=celo" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11090/large/icon-celo-CELO-color-500.png?1592293590" /></span><span class="pl-3 mx-0 my-auto">Celo</span></a></li>
            <li><a href="portfolio.php?addCoin=omisego" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/776/large/OMG_Network.jpg?1591167168" /></span><span class="pl-3 mx-0 my-auto">OMG Network</span></a></li>
            <li><a href="portfolio.php?addCoin=dash" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/19/large/dash-logo.png?1548385930" /></span><span class="pl-3 mx-0 my-auto">Dash</span></a></li>
            <li><a href="portfolio.php?addCoin=compound-governance-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10775/large/COMP.png?1592625425" /></span><span class="pl-3 mx-0 my-auto">Compound</span></a></li>
            <li><a href="portfolio.php?addCoin=magic-internet-money" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/16786/large/mimlogopng.png?1624979612" /></span><span class="pl-3 mx-0 my-auto">Magic Internet Money</span></a></li>
            <li><a href="portfolio.php?addCoin=chiliz" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8834/large/Chiliz.png?1561970540" /></span><span class="pl-3 mx-0 my-auto">Chiliz</span></a></li>
            <li><a href="portfolio.php?addCoin=havven" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3406/large/SNX.png?1598631139" /></span><span class="pl-3 mx-0 my-auto">Synthetix Network Token</span></a></li>
            <li><a href="portfolio.php?addCoin=holotoken" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3348/large/Holologo_Profile.png?1547037966" /></span><span class="pl-3 mx-0 my-auto">Holo</span></a></li>
            <li><a href="portfolio.php?addCoin=zcash" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/486/large/circle-zcash-color.png?1547034197" /></span><span class="pl-3 mx-0 my-auto">Zcash</span></a></li>
            <li><a href="portfolio.php?addCoin=decred" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/329/large/decred.png?1547034093" /></span><span class="pl-3 mx-0 my-auto">Decred</span></a></li>
            <li><a href="portfolio.php?addCoin=theta-fuel" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8029/large/1_0YusgngOrriVg4ZYx4wOFQ.png?1553483622" /></span><span class="pl-3 mx-0 my-auto">Theta Fuel</span></a></li>
            <li><a href="portfolio.php?addCoin=ecomi" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4428/large/ECOMI.png?1557928886" /></span><span class="pl-3 mx-0 my-auto">ECOMI</span></a></li>
            <li><a href="portfolio.php?addCoin=enjincoin" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1102/large/enjin-coin-logo.png?1547035078" /></span><span class="pl-3 mx-0 my-auto">Enjin Coin</span></a></li>
            <li><a href="portfolio.php?addCoin=nem" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/242/large/NEM_Logo_256x256.png?1598687029" /></span><span class="pl-3 mx-0 my-auto">NEM</span></a></li>
            <li><a href="portfolio.php?addCoin=spell-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/15861/large/abracadabra-3.png?1622544862" /></span><span class="pl-3 mx-0 my-auto">Spell Token</span></a></li>
            <li><a href="portfolio.php?addCoin=icon" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1060/large/icon-icx-logo.png?1547035003" /></span><span class="pl-3 mx-0 my-auto">ICON</span></a></li>
            <li><a href="portfolio.php?addCoin=xdce-crowd-sale" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2912/large/xdc-icon.png?1633700890" /></span><span class="pl-3 mx-0 my-auto">XDC Network</span></a></li>
            <li><a href="portfolio.php?addCoin=true-usd" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3449/large/tusd.png?1618395665" /></span><span class="pl-3 mx-0 my-auto">TrueUSD</span></a></li>
            <li><a href="portfolio.php?addCoin=qtum" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/684/large/qtum.png?1547034438" /></span><span class="pl-3 mx-0 my-auto">Qtum</span></a></li>
            <li><a href="portfolio.php?addCoin=yearn-finance" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11849/large/yfi-192x192.png?1598325330" /></span><span class="pl-3 mx-0 my-auto">yearn.finance</span></a></li>
            <li><a href="portfolio.php?addCoin=huobi-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2822/large/huobi-token-logo.png?1547036992" /></span><span class="pl-3 mx-0 my-auto">Huobi Token</span></a></li>
            <li><a href="portfolio.php?addCoin=dydx" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/17500/large/hjnIm9bV.jpg?1628009360" /></span><span class="pl-3 mx-0 my-auto">dYdX</span></a></li>
            <li><a href="portfolio.php?addCoin=zilliqa" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2687/large/Zilliqa-logo.png?1547036894" /></span><span class="pl-3 mx-0 my-auto">Zilliqa</span></a></li>
            <li><a href="portfolio.php?addCoin=bitcoin-gold" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1043/large/bitcoin-gold-logo.png?1547034978" /></span><span class="pl-3 mx-0 my-auto">Bitcoin Gold</span></a></li>
            <li><a href="portfolio.php?addCoin=iostoken" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2523/large/IOST.png?1557555183" /></span><span class="pl-3 mx-0 my-auto">IOST</span></a></li>
            <li><a href="portfolio.php?addCoin=telcoin" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1899/large/tel.png?1547036203" /></span><span class="pl-3 mx-0 my-auto">Telcoin</span></a></li>
            <li><a href="portfolio.php?addCoin=curve-dao-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12124/large/Curve.png?1597369484" /></span><span class="pl-3 mx-0 my-auto">Curve DAO Token</span></a></li>
            <li><a href="portfolio.php?addCoin=bitclout" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/16310/large/k-h6Wead_400x400.jpg?1623726134" /></span><span class="pl-3 mx-0 my-auto">Decentralized Social</span></a></li>
            <li><a href="portfolio.php?addCoin=mina-protocol" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/15628/large/JM4_vQ34_400x400.png?1621394004" /></span><span class="pl-3 mx-0 my-auto">Mina Protocol</span></a></li>
            <li><a href="portfolio.php?addCoin=safemoon" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14362/large/174x174-white.png?1617174846" /></span><span class="pl-3 mx-0 my-auto">SafeMoon</span></a></li>
            <li><a href="portfolio.php?addCoin=renbtc" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11370/large/Bitcoin.jpg?1628072791" /></span><span class="pl-3 mx-0 my-auto">renBTC</span></a></li>
            <li><a href="portfolio.php?addCoin=ravencoin" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3412/large/ravencoin.png?1548386057" /></span><span class="pl-3 mx-0 my-auto">Ravencoin</span></a></li>
            <li><a href="portfolio.php?addCoin=basic-attention-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/677/large/basic-attention-token.png?1547034427" /></span><span class="pl-3 mx-0 my-auto">Basic Attention Token</span></a></li>
            <li><a href="portfolio.php?addCoin=republic-protocol" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3139/large/REN.png?1589985807" /></span><span class="pl-3 mx-0 my-auto">REN</span></a></li>
            <li><a href="portfolio.php?addCoin=kucoin-shares" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1047/large/sa9z79.png?1610678720" /></span><span class="pl-3 mx-0 my-auto">KuCoin Token</span></a></li>
            <li><a href="portfolio.php?addCoin=decentraland" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/878/large/decentraland-mana.png?1550108745" /></span><span class="pl-3 mx-0 my-auto">Decentraland</span></a></li>
            <li><a href="portfolio.php?addCoin=nxm" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11810/large/nexus-mutual.jpg?1594547726" /></span><span class="pl-3 mx-0 my-auto">Nexus Mutual</span></a></li>
            <li><a href="portfolio.php?addCoin=perpetual-protocol" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12381/large/60d18e06844a844ad75901a9_mark_only_03.png?1628674771" /></span><span class="pl-3 mx-0 my-auto">Perpetual Protocol</span></a></li>
            <li><a href="portfolio.php?addCoin=serum" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11970/large/serum-logo.png?1597121577" /></span><span class="pl-3 mx-0 my-auto">Serum</span></a></li>
            <li><a href="portfolio.php?addCoin=nexo" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3695/large/nexo.png?1548086057" /></span><span class="pl-3 mx-0 my-auto">NEXO</span></a></li>
            <li><a href="portfolio.php?addCoin=paxos-standard" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6013/large/Pax_Dollar.png?1629877204" /></span><span class="pl-3 mx-0 my-auto">Pax Dollar</span></a></li>
            <li><a href="portfolio.php?addCoin=bancor" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/736/large/bancor-bnt.png?1628822309" /></span><span class="pl-3 mx-0 my-auto">Bancor Network Token</span></a></li>
            <li><a href="portfolio.php?addCoin=zencash" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/691/large/horizen.png?1555052241" /></span><span class="pl-3 mx-0 my-auto">Horizen</span></a></li>
            <li><a href="portfolio.php?addCoin=siacoin" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/289/large/siacoin.png?1548386465" /></span><span class="pl-3 mx-0 my-auto">Siacoin</span></a></li>
            <li><a href="portfolio.php?addCoin=xsushi" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13725/large/xsushi.png?1612538526" /></span><span class="pl-3 mx-0 my-auto">xSUSHI</span></a></li>
            <li><a href="portfolio.php?addCoin=nucypher" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3318/large/photo1198982838879365035.jpg?1547037916" /></span><span class="pl-3 mx-0 my-auto">NuCypher</span></a></li>
            <li><a href="portfolio.php?addCoin=osmosis" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/16724/large/osmo.png?1632763885" /></span><span class="pl-3 mx-0 my-auto">Osmosis</span></a></li>
            <li><a href="portfolio.php?addCoin=0x" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/863/large/0x.png?1547034672" /></span><span class="pl-3 mx-0 my-auto">0x</span></a></li>
            <li><a href="portfolio.php?addCoin=ontology" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3447/large/ONT.png?1583481820" /></span><span class="pl-3 mx-0 my-auto">Ontology</span></a></li>
            <li><a href="portfolio.php?addCoin=audius" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12913/large/AudiusCoinLogo_2x.png?1603425727" /></span><span class="pl-3 mx-0 my-auto">Audius</span></a></li>
            <li><a href="portfolio.php?addCoin=mdex" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13775/large/mdex.png?1611739676" /></span><span class="pl-3 mx-0 my-auto">Mdex</span></a></li>
            <li><a href="portfolio.php?addCoin=compound-usdt" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11621/large/cUSDT.png?1592113270" /></span><span class="pl-3 mx-0 my-auto">cUSDT</span></a></li>
            <li><a href="portfolio.php?addCoin=celer-network" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4379/large/Celr.png?1554705437" /></span><span class="pl-3 mx-0 my-auto">Celer Network</span></a></li>
            <li><a href="portfolio.php?addCoin=skale" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13245/large/SKALE_token_300x300.png?1606789574" /></span><span class="pl-3 mx-0 my-auto">SKALE</span></a></li>
            <li><a href="portfolio.php?addCoin=digibyte" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/63/large/digibyte.png?1547033717" /></span><span class="pl-3 mx-0 my-auto">DigiByte</span></a></li>
            <li><a href="portfolio.php?addCoin=secret" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11871/large/Secret.png?1595520186" /></span><span class="pl-3 mx-0 my-auto">Secret</span></a></li>
            <li><a href="portfolio.php?addCoin=nano" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/756/large/nano-coin-logo.png?1547034501" /></span><span class="pl-3 mx-0 my-auto">Nano</span></a></li>
            <li><a href="portfolio.php?addCoin=gatechain-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8183/large/gt.png?1556085624" /></span><span class="pl-3 mx-0 my-auto">GateToken</span></a></li>
            <li><a href="portfolio.php?addCoin=raydium" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13928/large/PSigc4ie_400x400.jpg?1612875614" /></span><span class="pl-3 mx-0 my-auto">Raydium</span></a></li>
            <li><a href="portfolio.php?addCoin=ankr" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4324/large/U85xTl2.png?1608111978" /></span><span class="pl-3 mx-0 my-auto">Ankr</span></a></li>
            <li><a href="portfolio.php?addCoin=uma" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10951/large/UMA.png?1586307916" /></span><span class="pl-3 mx-0 my-auto">UMA</span></a></li>
            <li><a href="portfolio.php?addCoin=the-sandbox" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12129/large/sandbox_logo.jpg?1597397942" /></span><span class="pl-3 mx-0 my-auto">The Sandbox</span></a></li>
            <li><a href="portfolio.php?addCoin=wonderland" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/18126/large/time.PNG?1630621941" /></span><span class="pl-3 mx-0 my-auto">Wonderland</span></a></li>
            <li><a href="portfolio.php?addCoin=link" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6450/large/linklogo.png?1547042644" /></span><span class="pl-3 mx-0 my-auto">LINK</span></a></li>
            <li><a href="portfolio.php?addCoin=1inch" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13469/large/1inch-token.png?1608803028" /></span><span class="pl-3 mx-0 my-auto">1inch</span></a></li>
            <li><a href="portfolio.php?addCoin=metahero" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/16911/large/icon200x200.png?1625618542" /></span><span class="pl-3 mx-0 my-auto">Metahero</span></a></li>
            <li><a href="portfolio.php?addCoin=gala" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12493/large/GALA-COINGECKO.png?1600233435" /></span><span class="pl-3 mx-0 my-auto">Gala</span></a></li>
            <li><a href="portfolio.php?addCoin=iotex" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3334/large/iotex-logo.png?1547037941" /></span><span class="pl-3 mx-0 my-auto">IoTeX</span></a></li>
            <li><a href="portfolio.php?addCoin=coin98" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/17117/large/logo.png?1626412904" /></span><span class="pl-3 mx-0 my-auto">Coin98</span></a></li>
            <li><a href="portfolio.php?addCoin=liquity-usd" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14666/large/Group_3.png?1617631327" /></span><span class="pl-3 mx-0 my-auto">Liquity USD</span></a></li>
            <li><a href="portfolio.php?addCoin=polymath" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2784/large/inKkF01.png?1605007034" /></span><span class="pl-3 mx-0 my-auto">Polymath</span></a></li>
            <li><a href="portfolio.php?addCoin=woo-network" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12921/large/w2UiemF__400x400.jpg?1603670367" /></span><span class="pl-3 mx-0 my-auto">WOO Network</span></a></li>
            <li><a href="portfolio.php?addCoin=loopring" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/913/large/LRC.png?1572852344" /></span><span class="pl-3 mx-0 my-auto">Loopring</span></a></li>
            <li><a href="portfolio.php?addCoin=wazirx" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10547/large/WazirX.png?1580834330" /></span><span class="pl-3 mx-0 my-auto">WazirX</span></a></li>
            <li><a href="portfolio.php?addCoin=neutrino" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10117/large/78GWcZu.png?1600845716" /></span><span class="pl-3 mx-0 my-auto">Neutrino USD</span></a></li>
            <li><a href="portfolio.php?addCoin=swissborg" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2117/large/YJUrRy7r_400x400.png?1589794215" /></span><span class="pl-3 mx-0 my-auto">SwissBorg</span></a></li>
            <li><a href="portfolio.php?addCoin=dent" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1152/large/gLCEA2G.png?1604543239" /></span><span class="pl-3 mx-0 my-auto">Dent</span></a></li>
            <li><a href="portfolio.php?addCoin=yield-guild-games" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/17358/large/le1nzlO6_400x400.jpg?1632465691" /></span><span class="pl-3 mx-0 my-auto">Yield Guild Games</span></a></li>
            <li><a href="portfolio.php?addCoin=fei-protocol" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14570/large/ZqsF51Re_400x400.png?1617082206" /></span><span class="pl-3 mx-0 my-auto">Fei Protocol</span></a></li>
            <li><a href="portfolio.php?addCoin=fetch-ai" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/5681/large/Fetch.jpg?1572098136" /></span><span class="pl-3 mx-0 my-auto">Fetch.ai</span></a></li>
            <li><a href="portfolio.php?addCoin=golem" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/542/large/Golem_Submark_Positive_RGB.png?1606392013" /></span><span class="pl-3 mx-0 my-auto">Golem</span></a></li>
            <li><a href="portfolio.php?addCoin=rocket-pool" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2090/large/rocket.png?1563781948" /></span><span class="pl-3 mx-0 my-auto">Rocket Pool</span></a></li>
            <li><a href="portfolio.php?addCoin=constellation-labs" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4645/large/DAG.png?1626339160" /></span><span class="pl-3 mx-0 my-auto">Constellation</span></a></li>
            <li><a href="portfolio.php?addCoin=kava" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9761/large/Kava-icon.png?1585636197" /></span><span class="pl-3 mx-0 my-auto">Kava</span></a></li>
            <li><a href="portfolio.php?addCoin=gnosis" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/662/large/logo_square_simple_300px.png?1609402668" /></span><span class="pl-3 mx-0 my-auto">Gnosis</span></a></li>
            <li><a href="portfolio.php?addCoin=moonriver" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/17984/large/9285.png?1630028620" /></span><span class="pl-3 mx-0 my-auto">Moonriver</span></a></li>
            <li><a href="portfolio.php?addCoin=wink" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9129/large/WinK.png?1564624891" /></span><span class="pl-3 mx-0 my-auto">WINkLink</span></a></li>
            <li><a href="portfolio.php?addCoin=livepeer" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/7137/large/logo-circle-green.png?1619593365" /></span><span class="pl-3 mx-0 my-auto">Livepeer</span></a></li>
            <li><a href="portfolio.php?addCoin=keep-network" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/3373/large/IuNzUb5b_400x400.jpg?1589526336" /></span><span class="pl-3 mx-0 my-auto">Keep Network</span></a></li>
            <li><a href="portfolio.php?addCoin=wax" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1372/large/WAX_Coin_Tickers_P_512px.png?1602812260" /></span><span class="pl-3 mx-0 my-auto">WAX</span></a></li>
            <li><a href="portfolio.php?addCoin=lisk" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/385/large/Lisk_Symbol_-_Blue.png?1573444104" /></span><span class="pl-3 mx-0 my-auto">Lisk</span></a></li>
            <li><a href="portfolio.php?addCoin=fx-coin" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8186/large/47271330_590071468072434_707260356350705664_n.jpg?1556096683" /></span><span class="pl-3 mx-0 my-auto">Function X</span></a></li>
            <li><a href="portfolio.php?addCoin=titanswap" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12606/large/nqGlQzdz_400x400.png?1601019805" /></span><span class="pl-3 mx-0 my-auto">TitanSwap</span></a></li>
            <li><a href="portfolio.php?addCoin=reserve-rights-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8365/large/Reserve_Rights.png?1557737411" /></span><span class="pl-3 mx-0 my-auto">Reserve Rights Token</span></a></li>
            <li><a href="portfolio.php?addCoin=nervos-network" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9566/large/Nervos_White.png?1608280856" /></span><span class="pl-3 mx-0 my-auto">Nervos Network</span></a></li>
            <li><a href="portfolio.php?addCoin=illuvium" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14468/large/ILV.JPG?1617182121" /></span><span class="pl-3 mx-0 my-auto">Illuvium</span></a></li>
            <li><a href="portfolio.php?addCoin=rari-governance-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12900/large/Rari_Logo_Transparent.png?1613978014" /></span><span class="pl-3 mx-0 my-auto">Rari Governance Token</span></a></li>
            <li><a href="portfolio.php?addCoin=convex-finance" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/15585/large/convex.png?1621256328" /></span><span class="pl-3 mx-0 my-auto">Convex Finance</span></a></li>
            <li><a href="portfolio.php?addCoin=frax" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13422/large/frax_logo.png?1608476506" /></span><span class="pl-3 mx-0 my-auto">Frax</span></a></li>
            <li><a href="portfolio.php?addCoin=ergo" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2484/large/Ergo.png?1574682618" /></span><span class="pl-3 mx-0 my-auto">Ergo</span></a></li>
            <li><a href="portfolio.php?addCoin=alpha-finance" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12738/large/AlphaToken_256x256.png?1617160876" /></span><span class="pl-3 mx-0 my-auto">Alpha Finance</span></a></li>
            <li><a href="portfolio.php?addCoin=digitalbits" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8089/large/digitalbits-logo.jpg?1554454902" /></span><span class="pl-3 mx-0 my-auto">DigitalBits</span></a></li>
            <li><a href="portfolio.php?addCoin=energy-web-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10886/large/R9gQTJV__400x400.png?1585604557" /></span><span class="pl-3 mx-0 my-auto">Energy Web Token</span></a></li>
            <li><a href="portfolio.php?addCoin=oxygen" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13509/large/8DjBZ79V_400x400.jpg?1609236331" /></span><span class="pl-3 mx-0 my-auto">Oxygen</span></a></li>
            <li><a href="portfolio.php?addCoin=swipe" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/9368/large/swipe.png?1566792311" /></span><span class="pl-3 mx-0 my-auto">Swipe</span></a></li>
            <li><a href="portfolio.php?addCoin=coti" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2962/large/Coti.png?1559653863" /></span><span class="pl-3 mx-0 my-auto">COTI</span></a></li>
            <li><a href="portfolio.php?addCoin=bitcoin-diamond" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1254/large/bitcoin-diamond.png?1547035280" /></span><span class="pl-3 mx-0 my-auto">Bitcoin Diamond</span></a></li>
            <li><a href="portfolio.php?addCoin=pirate-chain" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/6905/large/Pirate_Chain.png?1560913844" /></span><span class="pl-3 mx-0 my-auto">Pirate Chain</span></a></li>
            <li><a href="portfolio.php?addCoin=synapse-2" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/18024/large/syn.PNG?1630288945" /></span><span class="pl-3 mx-0 my-auto">Synapse</span></a></li>
            <li><a href="portfolio.php?addCoin=plex" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13383/large/plex.png?1608082719" /></span><span class="pl-3 mx-0 my-auto">PLEX</span></a></li>
            <li><a href="portfolio.php?addCoin=reef-finance" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/13504/large/Group_10572.png?1610534130" /></span><span class="pl-3 mx-0 my-auto">Reef Finance</span></a></li>
            <li><a href="portfolio.php?addCoin=xyo-network" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/4519/large/XYO_Network-logo.png?1547039819" /></span><span class="pl-3 mx-0 my-auto">XYO Network</span></a></li>
            <li><a href="portfolio.php?addCoin=vethor-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/5230/large/vethor-token.png?1548760043" /></span><span class="pl-3 mx-0 my-auto">VeThor Token</span></a></li>
            <li><a href="portfolio.php?addCoin=verge" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/203/large/verge-symbol-color_logo.png?1561543281" /></span><span class="pl-3 mx-0 my-auto">Verge</span></a></li>
            <li><a href="portfolio.php?addCoin=injective-protocol" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12882/large/Secondary_Symbol.png?1628233237" /></span><span class="pl-3 mx-0 my-auto">Injective Protocol</span></a></li>
            <li><a href="portfolio.php?addCoin=persistence" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14582/large/512_Light.png?1617149658" /></span><span class="pl-3 mx-0 my-auto">Persistence</span></a></li>
            <li><a href="portfolio.php?addCoin=tribe-2" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14575/large/tribe.PNG?1617487954" /></span><span class="pl-3 mx-0 my-auto">Tribe</span></a></li>
            <li><a href="portfolio.php?addCoin=bakerytoken" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/12588/large/bakerytoken_logo.jpg?1600940032" /></span><span class="pl-3 mx-0 my-auto">BakerySwap</span></a></li>
            <li><a href="portfolio.php?addCoin=trust-wallet-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11085/large/Trust.png?1588062702" /></span><span class="pl-3 mx-0 my-auto">Trust Wallet Token</span></a></li>
            <li><a href="portfolio.php?addCoin=pundi-x-2" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14571/large/vDyefsXq_400x400.jpg?1617085003" /></span><span class="pl-3 mx-0 my-auto">Pundi X</span></a></li>
            <li><a href="portfolio.php?addCoin=medibloc" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1374/large/medibloc_basic.png?1570607623" /></span><span class="pl-3 mx-0 my-auto">Medibloc</span></a></li>
            <li><a href="portfolio.php?addCoin=seth" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/8843/large/sETH.png?1616150207" /></span><span class="pl-3 mx-0 my-auto">sETH</span></a></li>
            <li><a href="portfolio.php?addCoin=vectorspace" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/2063/large/vectorspace-ai-logo.jpeg?1547036362" /></span><span class="pl-3 mx-0 my-auto">Vectorspace AI</span></a></li>
            <li><a href="portfolio.php?addCoin=beta-finance" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/18715/large/beta_finance.jpg?1633087053" /></span><span class="pl-3 mx-0 my-auto">Beta Finance</span></a></li>
            <li><a href="portfolio.php?addCoin=anchor-protocol" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/14420/large/anchor_protocol_logo.jpg?1615965420" /></span><span class="pl-3 mx-0 my-auto">Anchor Protocol</span></a></li>
            <li><a href="portfolio.php?addCoin=proton" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/10941/large/Proton-Icon.png?1588283737" /></span><span class="pl-3 mx-0 my-auto">Proton</span></a></li>
            <li><a href="portfolio.php?addCoin=lukso-token" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/11423/large/1_QAHTciwVhD7SqVmfRW70Pw.png?1590110612" /></span><span class="pl-3 mx-0 my-auto">LUKSO Token</span></a></li>
            <li><a href="portfolio.php?addCoin=electroneum" class="flex p-2 text-black hover:bg-gray-200 cursor-pointer"><span><img class="w-7" src="https://assets.coingecko.com/coins/images/1109/large/electroneum.png?1547224846" /></span><span class="pl-3 mx-0 my-auto">Electroneum</span></a></li>
          </ul>
        </div>

      </div>
    </div>
  </div>
  <!-- SEARCH MODAL END -->

<?php include_once("includes/footer.php") ?>
<script>

  const inven = document.querySelectorAll('#inventoryTable tr');
  // adds currencies to array
  let rows = [];
  for(i = 0; i < inven.length; ++i) {
    rows.push(inven[i].children[8].innerHTML);
  }
  postfix = rows.join(",");
  // API
  const http = new XMLHttpRequest();
  const url = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids='+postfix+'&order=market_cap_desc&per_page=100&page=1&sparkline=false';
           // https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=bitcoin%2Cethereum%2Cavalanche-2&order=market_cap_desc&per_page=100&page=1&sparkline=
  http.open("GET", url);
  http.send();
  http.onreadystatechange = function() {
    if(this.readyState==4 && this.status==200){
      resultPort = JSON.parse(http.responseText);
      for (i = 0; i < inven.length; ++i) {
        console.log(inven[i].children[4]);
        inven[i].children[2].innerHTML = "$ "+resultPort[i].current_price.toLocaleString("en-US");
        inven[i].children[4].innerHTML = roundToTwo(resultPort[i].price_change_percentage_24h)+"%";
        let tempPerc = resultPort[i].price_change_percentage_24h;
        console.log(tempPerc);
        if (tempPerc < 0) {
          inven[i].children[4].classList.remove("text-gray-500");
          inven[i].children[4].classList.add("text-red-500");
          // inven[i].children[4].className = "px-6 py-4 text-sm text-red-500 text-right"; //text-gray-500 px-6 py-4 text-sm text-gray-500 text-right
        } else {
          // inven[i].children[4].className = "px-6 py-4 text-sm text-green-500 text-right"; //text-gray-500 px-6 py-4 text-sm text-gray-500 text-right
          inven[i].children[4].classList.remove("text-gray-500");
          inven[i].children[4].classList.add("text-green-500");
        }
        inven[i].children[5].innerHTML = "$ "+resultPort[i].market_cap.toLocaleString("en-US");
      }

      rowPrice = [];
      for(i = 0; i < inven.length; ++i) {
        let pricePer = inven[i].children[2].innerHTML.substring(2).replace(',','');
        let quant = inven[i].children[3].innerHTML.replace(',','');
        rowPrice.push(pricePer*quant);
      }
      console.log(rows);
      console.log(rowPrice);

      drawdoughChart(rows,rowPrice);

    } // http END
  } // API END

  // drawLineChart();
  // drawdoughChart();
  modal();


</script>
</body>
</html>