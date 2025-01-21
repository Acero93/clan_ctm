<?php 
  
    include  __DIR__."/../../utils/helpers.php"; 
    $base_url = "http://" . $_SERVER['HTTP_HOST'];

?>

<!DOCTYPE html>
<html lang="es">

  <head>
    <?php include __DIR__."/../components/main/baseHead.php"; ?>


    <style>
      .hero-section {
        background: url('<?php echo $base_url; ?>/public/assets/images/main/hll_01.png') no-repeat center;
      }
  </style>

  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <?php include __DIR__."/../components/main/navBar.php"; ?>
  </header>
  <!-- ***** Header Area End ***** -->

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">

        <?php 
                    isset($content)? include $content : null;

         ?>

        </div>
      </div>
    </div>
  </div>
  
  <footer>
    <?php include __DIR__."/../components/main/footer.php"; ?>
  </footer>



  <?php include __DIR__."/../components/main/bodyScripts.php"; ?>


  </body>

</html>
