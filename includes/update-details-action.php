<?php
include_once("config.php");
include_once("functions.php");

if (isset($_POST['submit_update'])) {
    $currentTimeinSeconds = time(); 
    // converts the time in seconds to current date 
    $currentDate = date('Y-m-d', $currentTimeinSeconds);
    $image = $currentDate . $_FILES['file']['name'];
    $destination = "../assets/" . $image;
    move_uploaded_file($_FILES['file']['tmp_name'], $destination);
    $nameNew = $_POST['name'];
    $emailNew = $_POST['email'];
    $usernameNew = $_POST['uid'];
    $userID = $_SESSION['userid'];

    $update = [$nameNew,$emailNew,$usernameNew,$image];
    
    foreach ($update as $i) {
        if ($i == "" || $i == $currentDate) {
            continue;
        }
        if ($update[0] == $i) {
            $sql = "UPDATE rucrypto.user
                    SET user_fullname = '$i'
                    WHERE user_id='$userID';";
            mysqli_query($conn, $sql) or die("$sql Cant UPDATE fullname settings data");
            
        } elseif ($update[1] == $i) {
            $uidExists = uidExists($conn, $i, $emailNew);
            if ($uidExists !== false) {
                mysqli_close($conn);
                header("location: ../settings.php?error=userTaken");
                exit();
            }
            $sql = "UPDATE rucrypto.user
                    SET email = '$i'
                    WHERE user_id='$userID';";
            mysqli_query($conn, $sql) or die("Cant UPDATE email settings data");
            
        } elseif ($update[2] == $i) {
            $uidExists = uidExists($conn, $i, $usernameNew);
            if ($uidExists !== false) {
                mysqli_close($conn);
                header("location: ../settings.php?error=userTaken");
                exit();
            }
            $sql = "UPDATE rucrypto.user
                    SET user_uid = '$i'
                    WHERE user_id='$userID';";
            mysqli_query($conn, $sql) or die("Cant UPDATE uid settings data");
            
            $_SESSION['useruid'] = $i;
        } elseif ($update[3] == $i) {
            $sql = "UPDATE rucrypto.user
                    SET user_pic = 'assets/$i'
                    WHERE user_id='$userID';";
            mysqli_query($conn, $sql) or die("Cant UPDATE picture settings data");
            
            $_SESSION['userpic'] = 'assets/' . $i;
        }
    }
    mysqli_close($conn);
    header("location: ../settings.php?status=success");
    exit();

}
mysqli_close($conn);
header("location: ../settings.php?error=yes");
exit();
