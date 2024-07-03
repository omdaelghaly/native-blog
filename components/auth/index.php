<?php
include('./../../classes/All.php');

$env = new Env();
$con = $env->connect();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title id="titleDiv">Auth </title>
  <meta content="" name="description">
  <meta content="" name="keywords">
<!-- ========nav links========= -->
<?php
 include('./../inc/navLinks.php');
?>

</head>

<body>
<!-- onclick="loadPage('./login.php','auth','GET','')" -->
<div class="text-center pb-0 mb-0 mt-5">
<button type="button" id="loginShowBtn"  class="btn btn-outline-primary btn-sm">Login</button>
<button type="button" id="registerShowBtn" class="btn btn-outline-primary btn-sm">Register</button>
<a href="./../.." class="btn btn-outline-primary btn-sm">Home</a>

</div>
<!-- =================== -->

<div id="auth">

     <div id="loginDiv">
           <?php
                 include('./login.php');
          ?>
    </div>

    <div id="registerDiv">
         <?php
                 include('./register.php');
        ?>
     </div>

</div>

                   

</body>

<footer  class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span><?php echo Env::siteName; ?>  </span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="#">OMDA</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php
//  include('./../inc/footer.php');
 include('./../inc/footerLinks.php');
 ?>

  <script src="./../../app/auth.js"></script>

  <!-- ======== js route  -->
<script>
      $('#registerDiv').hide();
$(document).ready(()=>{
      $('#registerDiv').hide();
      $('#loginShowBtn').addClass('active');
        $('#loginShowBtn').click(function() {
            $('#registerDiv').hide();
            $('#loginDiv').show();
            $('#titleDiv').html('login');
            $(this).addClass('active');
            $('#registerShowBtn').removeClass('active');
          });      
        $('#registerShowBtn').click(function() {
            $('#registerDiv').show();
            $('#loginDiv').hide();
            $('#titleDiv').html('register');
            $(this).addClass('active');
            $('#loginShowBtn').removeClass('active');
          });

       
});
     
 function getPage(page){
      if(page==='login'){
        $('#registerDiv').hide();
            $('#loginDiv').show();

        
      }else{
         $('#loginDiv').hide();
            $('#registerDiv').show();

        } 

    alert(page);
      }
  


</script>

