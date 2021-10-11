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
      <div class="modal-content py-4 text-left px-6">
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
        <p>Modal content can go here</p>
        <p>...</p>
        <p>...</p>
        <p>...</p>
        <p>...</p>

        <!--Footer-->
        <div class="flex justify-end pt-2">
          <button class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">Action</button>
          <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Close</button>
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