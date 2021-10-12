<?php include_once("includes/config.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once("includes/head-contents.php") ?>
</head>
<body>

<?php include_once("includes/navigation.php") ?>

<h2><?php echo $CURRENT_PAGE ?></h2>

<?php if (isset($_SESSION['useruid'])) { ?>
  <div class=" h-24 w-24 rounded-full">
  <?php echo $_SESSION['userpic']; ?>
  </div>
<?php } ?>

<div class="container flex justify-center mx-auto">
  <div class="border-b border-gray-200 shadow overflow-auto">
<table class="divide-y divide-gray-300 ">
	<thead class="bg-gray-50">
		<tr>
			<th class="px-6 py-2 text-xs text-gray-500">#</th>
			<th class="px-6 py-2 text-xs text-gray-500">Pic</th>
			<th class="px-6 py-2 text-xs text-gray-500">Name</th>
			<th class="px-6 py-2 text-xs text-gray-500" >Price</th>
			<th class="px-6 py-2 text-xs text-gray-500" >24h Change</th>
		</tr>
	</thead>
	<tbody class="bg-white divide-y divide-gray-300">
		<tr class="whitespace-nowrap">
			<td class="px-6 py-4 text-sm text-gray-500">1</td>
			<td class="px-6 py-4"><div id="topCoinPic-1" class="text-sm text-gray-900">Pic</div></td>
			<td class="px-6 py-4"><div id="topCoinName-1" class="text-sm text-gray-500">Coin</div></td>
			<td id="topCoinPrice-1" class="px-6 py-4 text-sm text-gray-500"> $0.00</td>
			<td id="topCoinChange-1" class="px-6 py-4 text-sm text-gray-500">$0.00</td>
		</tr>
		<tr class="whitespace-nowrap">
			<td class="px-6 py-4 text-sm text-gray-500">2</td>
			<td class="px-6 py-4"><div id="topCoinPic-2" class="text-sm text-gray-900">Pic</div></td>
			<td class="px-6 py-4"><div id="topCoinName-2" class="text-sm text-gray-500">Coin</div></td>
			<td id="topCoinPrice-2" class="px-6 py-4 text-sm text-gray-500"> $0.00</td>
			<td id="topCoinChange-2" class="px-6 py-4 text-sm text-gray-500">$0.00</td>
		</tr>
		<tr class="whitespace-nowrap">
			<td class="px-6 py-4 text-sm text-gray-500">3</td>
			<td class="px-6 py-4"><div id="topCoinPic-3" class="text-sm text-gray-900">Pic</div></td>
			<td class="px-6 py-4"><div id="topCoinName-3" class="text-sm text-gray-500">Coin</div></td>
			<td id="topCoinPrice-3" class="px-6 py-4 text-sm text-gray-500"> $0.00</td>
			<td id="topCoinChange-3" class="px-6 py-4 text-sm text-gray-500">$0.00</td>
		</tr>
		<tr class="whitespace-nowrap">
			<td class="px-6 py-4 text-sm text-gray-500">4</td>
			<td class="px-6 py-4"><div id="topCoinPic-4" class="text-sm text-gray-900">Pic</div></td>
			<td class="px-6 py-4"><div id="topCoinName-4" class="text-sm text-gray-500">Coin</div></td>
			<td id="topCoinPrice-4" class="px-6 py-4 text-sm text-gray-500"> $0.00</td>
			<td id="topCoinChange-4" class="px-6 py-4 text-sm text-gray-500">$0.00</td>
		</tr>
		<tr class="whitespace-nowrap">
			<td class="px-6 py-4 text-sm text-gray-500">5</td>
			<td class="px-6 py-4"><div id="topCoinPic-5" class="text-sm text-gray-900">Pic</div></td>
			<td class="px-6 py-4"><div id="topCoinName-5" class="text-sm text-gray-500">Coin</div></td>
			<td id="topCoinPrice-5" class="px-6 py-4 text-sm text-gray-500"> $0.00</td>
			<td id="topCoinChange-5" class="px-6 py-4 text-sm text-gray-500">$0.00</td>
		</tr>
		<tr class="whitespace-nowrap">
			<td class="px-6 py-4 text-sm text-gray-500">6</td>
			<td class="px-6 py-4"><div id="topCoinPic-6" class="text-sm text-gray-900">Pic</div></td>
			<td class="px-6 py-4"><div id="topCoinName-6" class="text-sm text-gray-500">Coin</div></td>
			<td id="topCoinPrice-6" class="px-6 py-4 text-sm text-gray-500"> $0.00</td>
			<td id="topCoinChange-6" class="px-6 py-4 text-sm text-gray-500">$0.00</td>
		</tr>
		<tr class="whitespace-nowrap">
			<td class="px-6 py-4 text-sm text-gray-500">7</td>
			<td class="px-6 py-4"><div id="topCoinPic-7" class="text-sm text-gray-900">Pic</div></td>
			<td class="px-6 py-4"><div id="topCoinName-7" class="text-sm text-gray-500">Coin</div></td>
			<td id="topCoinPrice-7" class="px-6 py-4 text-sm text-gray-500"> $0.00</td>
			<td id="topCoinChange-7" class="px-6 py-4 text-sm text-gray-500">$0.00</td>
		</tr>
		<tr class="whitespace-nowrap">
			<td class="px-6 py-4 text-sm text-gray-500">8</td>
			<td class="px-6 py-4"><div id="topCoinPic-8" class="text-sm text-gray-900">Pic</div></td>
			<td class="px-6 py-4"><div id="topCoinName-8" class="text-sm text-gray-500">Coin</div></td>
			<td id="topCoinPrice-8" class="px-6 py-4 text-sm text-gray-500"> $0.00</td>
			<td id="topCoinChange-8" class="px-6 py-4 text-sm text-gray-500">$0.00</td>
		</tr>
		<tr class="whitespace-nowrap">
			<td class="px-6 py-4 text-sm text-gray-500">9</td>
			<td class="px-6 py-4"><div id="topCoinPic-9" class="text-sm text-gray-900">Pic</div></td>
			<td class="px-6 py-4"><div id="topCoinName-9" class="text-sm text-gray-500">Coin</div></td>
			<td id="topCoinPrice-9" class="px-6 py-4 text-sm text-gray-500"> $0.00</td>
			<td id="topCoinChange-9" class="px-6 py-4 text-sm text-gray-500">$0.00</td>
		</tr>
		<tr class="whitespace-nowrap">
			<td class="px-6 py-4 text-sm text-gray-500">10</td>
			<td class="px-6 py-4"><div id="topCoinPic-10" class="text-sm text-gray-900">Pic</div></td>
			<td class="px-6 py-4"><div id="topCoinName-10" class="text-sm text-gray-500">Coin</div></td>
			<td id="topCoinPrice-10" class="px-6 py-4 text-sm text-gray-500"> $0.00</td>
			<td id="topCoinChange-10" class="px-6 py-4 text-sm text-gray-500">$0.00</td>
		</tr>
	</tbody>
</table>
  </div>
</div>

<ul>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/1/large/bitcoin.png?1547033579" /> <span>Bitcoin</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/279/large/ethereum.png?1595348880" /> <span>Ethereum</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/975/large/cardano.png?1547034860" /> <span>Cardano</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/325/large/Tether-logo.png?1598003707" /> <span>Tether</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/825/large/binance-coin-logo.png?1547034615" /> <span>Binance Coin</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/44/large/xrp-symbol-white-128.png?1605778731" /> <span>XRP</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/4128/large/coinmarketcap-solana-200.png?1616489452" /> <span>Solana</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/12171/large/aJGBjJFU_400x400.jpg?1597804776" /> <span>Polkadot</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/6319/large/USD_Coin_icon.png?1547042389" /> <span>USD Coin</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/5/large/dogecoin.png?1547792256" /> <span>Dogecoin</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/8284/large/luna1557227471663.png?1567147072" /> <span>Terra</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/11939/large/shiba.png?1622619446" /> <span>Shiba Inu</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/9576/large/BUSD.png?1568947766" /> <span>Binance USD</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/12504/large/uniswap-uni.png?1600306604" /> <span>Uniswap</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/2/large/litecoin.png?1547033580" /> <span>Litecoin</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/12559/large/coin-round-red.png?1604021818" /> <span>Avalanche</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/7598/large/wrapped_bitcoin_wbtc.png?1548822744" /> <span>Wrapped Bitcoin</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/877/large/chainlink-new-logo.png?1547034700" /> <span>Chainlink</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/780/large/bitcoin-cash-circle.png?1594689492" /> <span>Bitcoin Cash</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/4380/large/download.png?1547039725" /> <span>Algorand</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/1481/large/cosmos_hub.png?1555657960" /> <span>Cosmos</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/4713/large/matic-token-icon.png?1624446912" /> <span>Polygon</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/12817/large/filecoin.png?1602753933" /> <span>Filecoin</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/100/large/Stellar_symbol_black_RGB.png?1552356157" /> <span>Stellar</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/14495/large/Internet_Computer_logo.png?1620703073" /> <span>Internet Computer</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/1167/large/VeChain-Logo-768x725.png?1547035194" /> <span>VeChain</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/13029/large/axie_infinity_logo.png?1604471082" /> <span>Axie Infinity</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/453/large/ethereum-classic-logo.png?1547034169" /> <span>Ethereum Classic</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/1094/large/tron-logo.png?1547035066" /> <span>TRON</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/9956/large/dai-multi-collateral-mcd.png?1574218774" /> <span>Dai</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/9026/large/F.png?1609051564" /> <span>FTX Token</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/2538/large/theta-token-logo.png?1548387191" /> <span>Theta Network</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/976/large/Tezos-logo.png?1547034862" /> <span>Tezos</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/4001/large/Fantom.png?1558015016" /> <span>Fantom</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/10643/large/ceth2.JPG?1581389598" /> <span>cETH</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/3688/large/mqTDGK7Q.png?1566256777" /> <span>Hedera</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/12335/large/elrond3_360.png?1626341589" /> <span>Elrond</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/69/large/monero_logo.png?1547033729" /> <span>Monero</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/7310/large/cypto.png?1547043960" /> <span>Crypto.com Coin</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/13442/large/steth_logo.png?1608607546" /> <span>Lido Staked Ether</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/738/large/eos-eos-logo.png?1547034481" /> <span>EOS</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/12632/large/pancakeswap-cake-logo_%281%29.png?1629359065" /> <span>PancakeSwap</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/4463/large/okb_token.png?1548386209" /> <span>OKB</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/16646/large/Logo_final-22.png?1628239446" /> <span>eCash</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/9672/large/CjbT82vP_400x400.jpg?1570548320" /> <span>Klaytn</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/692/large/IOTA_Swirl.png?1604238557" /> <span>IOTA</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/3370/large/5ZOu7brX_400x400.jpg?1612437252" /> <span>Quant</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/12645/large/AAVE.png?1601374110" /> <span>Aave</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/13120/large/Logo_final-21.png?1624892810" /> <span>Bitcoin Cash ABC</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/10365/large/near_icon.png?1601359077" /> <span>Near</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/6799/large/BSV.png?1558947902" /> <span>Bitcoin SV</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/13397/large/Graph_Token.png?1608145566" /> <span>The Graph</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/480/large/NEO_512_512.png?1594357361" /> <span>NEO</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/9568/large/m4zRhP5e_400x400.jpg?1576190080" /> <span>Kusama</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/9442/large/Compound_USDC.png?1567581577" /> <span>cUSDC</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/14483/large/token_OHM_%281%29.png?1628311611" /> <span>Olympus</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/425/large/waves.png?1548386117" /> <span>Waves</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/12681/large/UST.png?1601612407" /> <span>TerraUSD</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/9281/large/cDAI.png?1576467585" /> <span>cDAI</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/8418/large/leo-token.png?1558326215" /> <span>LEO Token</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/7595/large/BTT_Token_Graphic.png?1555066995" /> <span>BitTorrent</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/4344/large/Y88JAze.png?1565065793" /> <span>Harmony</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/3263/large/CEL_logo.png?1609598753" /> <span>Celsius Network</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/4343/large/oRt6SiEN_400x400.jpg?1591059616" /> <span>Arweave</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/12407/large/Unknown-5.png?1599624896" /> <span>Huobi BTC</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/12409/large/amp-200x200.png?1599625397" /> <span>Amp</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/1364/large/Mark_Maker.png?1585191826" /> <span>Maker</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/2069/large/Stacks_logo_full.png?1604112510" /> <span>Stacks</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/12271/large/512x512_Logo_no_chop.png?1606986688" /> <span>Sushi</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/6595/large/RUNE.png?1614160507" /> <span>THORChain</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/776/large/OMG_Network.jpg?1591167168" /> <span>OMG Network</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/19/large/dash-logo.png?1548385930" /> <span>Dash</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/4284/large/Helium_HNT.png?1612620071" /> <span>Helium</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/10775/large/COMP.png?1592625425" /> <span>Compound</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/11090/large/icon-celo-CELO-color-500.png?1592293590" /> <span>Celo</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/329/large/decred.png?1547034093" /> <span>Decred</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/3406/large/SNX.png?1598631139" /> <span>Synthetix Network Token</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/3348/large/Holologo_Profile.png?1547037966" /> <span>Holo</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/8834/large/Chiliz.png?1561970540" /> <span>Chiliz</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/8029/large/1_0YusgngOrriVg4ZYx4wOFQ.png?1553483622" /> <span>Theta Fuel</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/4428/large/ECOMI.png?1557928886" /> <span>ECOMI</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/242/large/NEM_Logo_256x256.png?1598687029" /> <span>NEM</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/1102/large/enjin-coin-logo.png?1547035078" /> <span>Enjin Coin</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/1060/large/icon-icx-logo.png?1547035003" /> <span>ICON</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/2912/large/xdc-icon.png?1633700890" /> <span>XDC Network</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/486/large/circle-zcash-color.png?1547034197" /> <span>Zcash</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/16310/large/k-h6Wead_400x400.jpg?1623726134" /> <span>Decentralized Social</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/684/large/qtum.png?1547034438" /> <span>Qtum</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/17500/large/hjnIm9bV.jpg?1628009360" /> <span>dYdX</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/3449/large/tusd.png?1618395665" /> <span>TrueUSD</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/16786/large/mimlogopng.png?1624979612" /> <span>Magic Internet Money</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/1043/large/bitcoin-gold-logo.png?1547034978" /> <span>Bitcoin Gold</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/11849/large/yfi-192x192.png?1598325330" /> <span>yearn.finance</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/2822/large/huobi-token-logo.png?1547036992" /> <span>Huobi Token</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/2523/large/IOST.png?1557555183" /> <span>IOST</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/2687/large/Zilliqa-logo.png?1547036894" /> <span>Zilliqa</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/13446/large/5f6294c0c7a8cda55cb1c936_Flow_Wordmark.png?1631696776" /> <span>Flow</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/15861/large/abracadabra-3.png?1622544862" /> <span>Spell Token</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/15628/large/JM4_vQ34_400x400.png?1621394004" /> <span>Mina Protocol</span></li>
	<li><img class="w-7" src="https://assets.coingecko.com/coins/images/3412/large/ravencoin.png?1548386057" /> <span>Ravencoin</span></li>
</ul>

<?php
//   $json = file_get_contents("https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=10&page=1");
//   $file = "extracted.json";
//   file_put_contents($file, $json);
//   echo $json;
?>

<?php include_once("includes/footer.php") ?>
<script>
  topCoins();
</script>

</body>
</html>