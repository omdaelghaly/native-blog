<!-- sio -->
<?php
// @session_start();

?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.7.5/socket.io.min.js" ></script>


<?php if(isset($_SESSION['id'])){ ?>


<script>
   var socket=io("http://newsite.com:4000",{query:'name=<?php echo $_SESSION['name'] ?>&id=<?php echo $_SESSION['id'] ?>'});

</script>


<?php }else{?>
  <script>
   var socket=io("http://newsite.com:4000",{query:'name=""&id=0'});

</script>

<?php } ?>
