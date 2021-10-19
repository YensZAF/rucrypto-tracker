<?php

if (isset($_POST['submit'])) { // checks if user uses post to get to the page
    
    // get the variables
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $pwdrepeat = $_POST['pwdrepeat'];

    // ERROR handling
    require_once 'config.php';
    require_once 'functions.php';

    if (uidExists($conn,$username,$email) !== false) {
        header("location: ../signup.php?error=usernametaken");
        exit();
    }

    createUser($conn, $name, $email, $username, $pwd);

} else {

    header("location: signup.php");
    
}

?>