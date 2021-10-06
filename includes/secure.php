<?php
  if (!isset($_SESSION['useruid'])) header("location: index?error=404");
?>