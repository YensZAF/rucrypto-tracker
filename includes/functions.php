<?php

function uidExists($conn,$username,$email)  {
    $sql = "SELECT * FROM user WHERE user_uid = '$username' OR email = '$email';";

    $resultData = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
    mysqli_close($conn);
}

function createUser($conn, $name, $email, $username, $pwd)  {
    $hasedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    require_once('Multiavatar.php');
    $multiavatar = new Multiavatar();
    $svgCode = $multiavatar($username, null, null);

    $sql = "INSERT INTO user (user_fullname, email, user_uid, passwd, user_pic) VALUES ('$name', '$email', '$username', '$hasedPwd','$svgCode');";

    mysqli_query($conn, $sql) or die("createUser()1 failed!");

    $sql = "INSERT INTO watch_list (user_uid) VALUE ('$username');";

    mysqli_query($conn, $sql) or die("createUser()2 failed!");

    mysqli_close($conn);
    header("location: ../signup?error=none");
    exit();
}

function loginUser($conn, $username, $pwd) {
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false) {
        header("location: ../login?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists['passwd'];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkedPwd === false) {
        header("location: ../login?error=wronglogin");
        exit();
    } else if ($checkPwd === true) {
        session_start();
        $_SESSION['userid'] = $uidExists['user_id'];
        $_SESSION['useruid'] = $uidExists['user_uid'];
        $_SESSION['userpic'] = $uidExists['user_pic'];
        header("location: ../portfolio");
        exit();
    }

}

function addInventory($coin_uid,$userID,$conn) {
  $sql = "SELECT * FROM cryptocurrency WHERE currency_uid = '$coin_uid';";
  $currency = mysqli_query($conn, $sql) or die("fetchCrypto failed!");

  $coinID = -1;
  while ($row = mysqli_fetch_array($currency)) {
    $coinID = $row['currency_id'];
  }

  $sql = "SELECT * FROM watch_list_has_cryptocurrency WHERE watch_list_id = '$userID';";
  $currencyCheck = mysqli_query($conn, $sql) or die("fetchCrypto failed!");

  while ($row = mysqli_fetch_array($currencyCheck)) {
    if ($row['currency_id'] === $coinID) {
      header("location: portfolio?error=coinExists");
      exit();
    }
  }

  $sql = "INSERT INTO watch_list_has_cryptocurrency (watch_list_id, currency_id) VALUE ('$userID','$coinID');";
  mysqli_query($conn, $sql) or die("insertCurrency failed!");

  mysqli_close($conn);
  header("location: portfolio");
  exit();
}

function printInventory($userID,$conn) {
  $sql = "SELECT w.watch_list_id, c.currency_id, c.currency_name, c.currency_pic, c.currency_symbol, c.currency_uid 
          FROM watch_list_has_cryptocurrency w
          JOIN cryptocurrency c
            ON w.currency_id = c.currency_id
          WHERE watch_list_id = '$userID';";
  $invCoins = mysqli_query($conn, $sql) or die("fetchInvCryptoTable failed!");

  while ($row = mysqli_fetch_array($invCoins)) { ?>
    <tr class="whitespace-nowrap">
      <td class="px-6 py-4 text-sm text-gray-900"><img class="w-7" src="<?php echo $row['currency_pic'] ?>" /></td>
      <td class="px-6 py-4 text-sm text-gray-500"><?php echo $row['currency_name'] ?></td>
      <td class="px-6 py-4 text-sm text-gray-500">$0.00</td>
      <td class="px-6 py-4 text-sm text-gray-500">0.00</td>
      <td class="px-6 py-4 text-sm text-gray-500">0%</td>
      <td class="px-6 py-4 text-sm text-gray-500">$0.00</td>
      <td class="px-6 py-4 text-sm text-gray-500">0%</td>
      <td class="px-6 py-4 text-sm text-gray-500 text-center">
        <a href="trades?coin_id=<?php echo $row['currency_id'];  ?>" class="inline-flex items-center font-bold hover:text-blue-500 text-green-700 text-xs text-center align-middle">
            <span>
              <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.8" viewBox="-2 -2 25 25" stroke="currentColor">
                <path d="M17.431,2.156h-3.715c-0.228,0-0.413,0.186-0.413,0.413v6.973h-2.89V6.687c0-0.229-0.186-0.413-0.413-0.413H6.285c-0.228,0-0.413,0.184-0.413,0.413v6.388H2.569c-0.227,0-0.413,0.187-0.413,0.413v3.942c0,0.228,0.186,0.413,0.413,0.413h14.862c0.228,0,0.413-0.186,0.413-0.413V2.569C17.844,2.342,17.658,2.156,17.431,2.156 M5.872,17.019h-2.89v-3.117h2.89V17.019zM9.587,17.019h-2.89V7.1h2.89V17.019z M13.303,17.019h-2.89v-6.651h2.89V17.019z M17.019,17.019h-2.891V2.982h2.891V17.019z"></path>
              </svg>
            </span>
          </a>/
          <a href="includes/delete-coin-trades.php?coin_id=<?php echo $row['currency_id'];  ?>" class="inline-flex items-center font-bold hover:text-blue-500 text-red-700 text-xs text-center align-middle">
            <span>
              <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.8" viewBox="-2 -2 25 25" stroke="currentColor">
                <path d="M17.114,3.923h-4.589V2.427c0-0.252-0.207-0.459-0.46-0.459H7.935c-0.252,0-0.459,0.207-0.459,0.459v1.496h-4.59c-0.252,0-0.459,0.205-0.459,0.459c0,0.252,0.207,0.459,0.459,0.459h1.51v12.732c0,0.252,0.207,0.459,0.459,0.459h10.29c0.254,0,0.459-0.207,0.459-0.459V4.841h1.511c0.252,0,0.459-0.207,0.459-0.459C17.573,4.127,17.366,3.923,17.114,3.923M8.394,2.886h3.214v0.918H8.394V2.886z M14.686,17.114H5.314V4.841h9.372V17.114z M12.525,7.306v7.344c0,0.252-0.207,0.459-0.46,0.459s-0.458-0.207-0.458-0.459V7.306c0-0.254,0.205-0.459,0.458-0.459S12.525,7.051,12.525,7.306M8.394,7.306v7.344c0,0.252-0.207,0.459-0.459,0.459s-0.459-0.207-0.459-0.459V7.306c0-0.254,0.207-0.459,0.459-0.459S8.394,7.051,8.394,7.306"></path>
              </svg>
            </span>
          </a>
      </td>
      
      </td>
    </tr>
<?php
  }// while loop end

} // printInventory end

function delete_coin($coin_id,$userID,$conn) {
  $sql = "DELETE FROM rucrypto.watch_list_has_cryptocurrency
          WHERE watch_list_id='$userID' AND currency_id='$coin_id';";
  var_dump($sql);
  mysqli_query($conn, $sql) or die("Cant delete watchlist/currency relation");
}

?>