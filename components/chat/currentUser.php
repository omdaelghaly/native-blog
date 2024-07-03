<?php
include('./../../classes/All.php');
$url = new Url();

$funClass = new Fun;




?>

<?php
 $u_id= isset($_GET['u_id']) && is_numeric($_GET['u_id'])? intval($_GET['u_id']) :0 ;
  // echo 'current'.$u_id;
 ?>



<a href="/index.php" class="logo d-flex align-items-center">
        <?php
         $img= $funClass->getUser('users','image',$u_id) ;
        ?>
        <img src="/assets/images/profiles/<?php echo $img ? $img :'' ;?> " 
             style="width:60px;height:60px;" class="rounded-circle" alt="">
        <span class="d-none d-sm-block">
             <?php
                $userName= $funClass->getUser('users','name',$u_id) ;
                echo isset($userName)?$userName:'';
             ?>
        </span>
</a>