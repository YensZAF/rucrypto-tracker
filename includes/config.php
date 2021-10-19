<?php

include_once("env.php");

$conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName)
            or die("Connection failed: " . mysqli_connect_error());


switch ($_SERVER['SCRIPT_NAME']) {
  case '/rucrypto-tracker/login.php':
    $CURRENT_PAGE = 'Login';
    $PAGE_TITLE = 'Login into your app!';
    break;
  case '/rucrypto-tracker/signup.php':
    $CURRENT_PAGE = 'Signup';
    $PAGE_TITLE = 'Sign up with RUcrypto!';
    break;
  case '/rucrypto-tracker/profile.php':
    $CURRENT_PAGE = 'Profile';
    $PAGE_TITLE = 'Account page';
    break;
  case '/rucrypto-tracker/about.php':
    $CURRENT_PAGE = 'About';
    $PAGE_TITLE = 'About us!';
    break;
  case '/rucrypto-tracker/blog.php':
    $CURRENT_PAGE = 'Blog';
    $PAGE_TITLE = 'Find out more';
    break;
  case '/rucrypto-tracker/portfolio.php':
    $CURRENT_PAGE = 'Portfolio';
    $PAGE_TITLE = 'Portfolio Summary';
    break;
  case '/rucrypto-tracker/trades.php':
    $CURRENT_PAGE = 'Trades';
    $PAGE_TITLE = 'Trade coins';
    break;
  default:
    $CURRENT_PAGE = 'Index';
    $PAGE_TITLE = 'Home Page';
    break;
  }


session_start();

?>