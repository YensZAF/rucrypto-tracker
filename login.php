<?php include_once("includes/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once("includes/head-contents.php"); ?>
</head>

<body>

<?php
include_once("includes/navigation.php");
include_once("includes/banner.php");
?>

    <!-- <section class="login">
        <h3>Login</h3>
        <form action="includes/login-action.php" method="post">
            <input type="text" name="uid" placeholder="Username/Email" required><br>
            <input type="password" name="pwd" placeholder="Password" required><br>
            <button type="submit" name="submit">Login</button>
        </form>
        
    </section> -->

<div class="py-10 min-h-full flex flex-col items-center justify-center bg-gray-300">
  <div class="flex flex-col bg-white shadow-md px-4 sm:px-6 md:px-8 lg:px-10 py-8 rounded-md w-full max-w-md">
    <div class="font-medium self-center text-xl sm:text-2xl uppercase text-gray-800">Login To Your Account</div>
    <div class="mt-10">
      <form action="includes/login-action.php" method="post">
        <div class="flex flex-col mb-6">
          <label for="uid" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">Username / Email:</label>
          <div class="relative">
            <div class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
              <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
              </svg>
            </div>

            <input id="uid" type="text" name="uid" class="text-sm sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400" placeholder="Username / E-Mail" />
          </div>
        </div>
        <div class="flex flex-col mb-6">
          <label for="pwd" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">Password:</label>
          <div class="relative">
            <div class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
              <span>
                <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                  <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
              </span>
            </div>

            <input id="pwd" type="password" name="pwd" class="text-sm sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400" placeholder="Password" />
          </div>
        </div>

        <!-- <div class="flex items-center mb-6 -mt-4">
          <div class="flex ml-auto">
            <a href="#" class="inline-flex text-xs sm:text-sm text-blue-500 hover:text-blue-700">Forgot Your Password?</a>
          </div>
        </div> -->

        <div class="flex w-full">
          <button type="submit" name="submit" class="flex items-center justify-center focus:outline-none text-white text-sm sm:text-base bg-blue-600 hover:bg-blue-700 rounded py-2 w-full transition duration-150 ease-in">
            <span class="mr-2 uppercase">Login</span>
            <span>
              <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </span>
          </button>
        </div>
      </form>
    </div>

<?php
            $errorMsg = $_GET['error'] ?? "";
            if (isset($errorMsg)) {
              if ($errorMsg == "wronglogin") { ?>
                   
                    <div class="flex justify-center items-center mt-6">
                    <div class="inline-flex items-center font-bold text-red-500 text-xs text-center">
                      <span>
                        <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" stroke="currentColor">
                          <path d="M10.185,1.417c-4.741,0-8.583,3.842-8.583,8.583c0,4.74,3.842,8.582,8.583,8.582S18.768,14.74,18.768,10C18.768,5.259,14.926,1.417,10.185,1.417 M10.185,17.68c-4.235,0-7.679-3.445-7.679-7.68c0-4.235,3.444-7.679,7.679-7.679S17.864,5.765,17.864,10C17.864,14.234,14.42,17.68,10.185,17.68 M10.824,10l2.842-2.844c0.178-0.176,0.178-0.46,0-0.637c-0.177-0.178-0.461-0.178-0.637,0l-2.844,2.841L7.341,6.52c-0.176-0.178-0.46-0.178-0.637,0c-0.178,0.176-0.178,0.461,0,0.637L9.546,10l-2.841,2.844c-0.178,0.176-0.178,0.461,0,0.637c0.178,0.178,0.459,0.178,0.637,0l2.844-2.841l2.844,2.841c0.178,0.178,0.459,0.178,0.637,0c0.178-0.176,0.178-0.461,0-0.637L10.824,10z"></path>
                        </svg>
                      </span>
                      <span>Incorrect Login information!</span>
                </div>
                  </div>

          <?php   } else { ?>
            
            <div class="flex justify-center items-center mt-6">
      <a href="signup" class="inline-flex items-center font-bold text-blue-500 hover:text-blue-700 text-xs text-center">
        <span>
          <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
          </svg>
        </span>
        <span class="ml-2">You don't have an account?</span>
      </a>
    </div>

            <?php

                    }
             } 
          ?>

  </div>
</div>

<?php include_once("includes/footer.php") ?>

</body>
</html>