<?php

session_start(); // start to delete
session_unset();
session_destroy();
header("location: home");
exit();

?>