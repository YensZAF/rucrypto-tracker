<?php include_once("includes/config.php") ?>
<?php include_once("includes/secure.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once("includes/head-contents.php") ?>
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


<?php include_once("includes/footer.php") ?>
<script>
  drawLineChart();
  drawdoughChart();
</script>
</body>
</html>