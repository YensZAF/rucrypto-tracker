<?php include_once("includes/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once("includes/head-contents.php"); ?>
</head>
<body>

<?php include_once("includes/navigation.php"); ?>

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