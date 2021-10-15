<?php include_once("includes/config.php");
      include_once("includes/functions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once("includes/head-contents.php"); ?>
</head>
<body>

<?php include_once("includes/navigation.php"); ?>

<h2><?php echo $CURRENT_PAGE ?></h2>

<!-- Trades Tabs BUY SELL https://www.creative-tim.com/learning-lab/tailwind-starter-kit/documentation/javascript/tabs/icons -->
<div class="flex flex-wrap" id="tabs-id">
  <div class="max-w-md mx-auto">
    <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
      <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
        <a id="buy" class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-white bg-green-600 cursor-pointer" onclick="changeAtiveTab(event,'tab-profile','buy')">
          <i class="fa fa-level-up text-base mr-1"></i>  Buy
        </a>
      </li>
      <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
        <a id="sell" class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-red-600 bg-white cursor-pointer" onclick="changeAtiveTab(event,'tab-settings','sell')">
          <i class="fa fa-level-down text-base mr-1"></i>  Sell
        </a>
      </li>
    </ul>
    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
      <div class="px-4 py-5 flex-auto">
        <div class="tab-content tab-space">
          <div class="block" id="tab-profile">
            <p>
              Collaboratively administrate empowered markets via
              plug-and-play networks. Dynamically procrastinate B2C users
              after installed base benefits.
              <br />
              <br />
              Dramatically visualize customer directed convergence
              without revolutionary ROI.
            </p>
          </div>
          <div class="hidden" id="tab-settings">
            <p>
              Completely synergize resource taxing relationships via
              premier niche markets. Professionally cultivate one-to-one
              customer service with robust ideas.
              <br />
              <br />
              Dynamically innovate resource-leveling customer service for
              state of the art customer service.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- TRADES TABLE -->
<div class="container flex justify-center mx-auto pb-10">
  <div class="border-b border-gray-200 shadow overflow-auto">
    <table class="divide-y divide-gray-300 ">
      <thead class="bg-gray-50">
          <tr>
              <th class="px-6 py-2 text-xs text-gray-500">Img</th>
              <th class="px-6 py-2 text-xs text-gray-500 text-left">Coin</th>
              <th class="px-6 py-2 text-xs text-gray-500">Price</th>
              <th class="px-6 py-2 text-xs text-gray-500">Quantity</th>
              <th class="px-6 py-2 text-xs text-gray-500">24h</th>
              <th class="px-6 py-2 text-xs text-gray-500">Mkt Cap</th>
              <th class="px-6 py-2 text-xs text-gray-500">PNL</th>
              <th class="px-6 py-2 text-xs text-gray-500"></th>
              <th class="px-6 py-2 text-xs text-gray-500"></th>
          </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-300">
          <tr class="whitespace-nowrap">
            <td class="px-6 py-4 text-sm text-gray-900"><img class="w-7" src="<?php echo $row['currency_pic'] ?>" /></td>
            <td class="px-6 py-4 text-sm text-gray-500"><?php echo $row['currency_name'] ?></td>
            <td class="px-6 py-4 text-sm text-gray-500">$0.00</td>
            <td class="px-6 py-4 text-sm text-gray-500">0.00</td>
            <td class="px-6 py-4 text-sm text-gray-500">0%</td>
            <td class="px-6 py-4 text-sm text-gray-500">$0.00</td>
            <td class="px-6 py-4 text-sm text-gray-500">0%</td>
            <td class="px-6 py-4 text-sm text-gray-500">edit</td>
            <td class="px-6 py-4 text-sm text-gray-500">delete</td>
          </tr>
      </tbody>
    </table>
  </div>
</div>
<!-- TRADES TABLE END -->

<?php include_once("includes/footer.php"); ?>

</body>
</html>