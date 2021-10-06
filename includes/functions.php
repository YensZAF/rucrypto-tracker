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

?>