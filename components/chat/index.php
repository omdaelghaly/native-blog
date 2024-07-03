<?php

include('./../../classes/All.php');
$url = new Url;

$funClass = new Fun;


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo Env::siteName; ?>   </title>
  <meta content="" name="description">
  <meta content="" name="keywords">
<!-- ========nav links========= -->
<?php
 include('./../../components/inc/navLinks.php');

?>
  
</head>



<body >
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
<?php
 include('./../../components/inc/nav.php')
?>
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
<?php
 include('./../../components/inc/sidebar.php')
?>
  </aside>

  <!-- End Sidebar-->

  
<!-- ======================================================== -->
  <main id="main" class="main" >


 <?php

   include('./chat.php');
 ?>



  </main><!-- End #main -->
<!-- ================================================================ -->
  <!-- ======= Footer ======= -->
  <?php
  include('./../../components/inc/footer.php');
  ?>


  <!-- Vendor JS Files -->
 <!-- ========footer links=========== -->
<?php
include('./../../components/inc/footerLinks.php');
?>

</body>

</html>