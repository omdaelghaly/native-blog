<!-- 
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div> -->
    <!-- End Page Title -->

    <section class="section dashboard ">
      <div class="row ">

        <!-- Left side columns -->
        <div class="col-lg-8 " >
          <div class="row" >
      <?php
       include('components/main/posts/createPost.php');
      ?>

<!-- =============================posts========================== -->
<div class="realtimePostsDiv col-12 p-0 m-0" >
<div class="col-12 text-center" style="height:200px">
<span class="spinner-border spinner-border-xl " style="margin-top:50px" role="status" aria-hidden="true"></span>

</div>  

<!-- here are posts realtime -->
    <?php
       //include('components/main/posts/posts.php');
       
    ?>
</div>
<!-- ================================================================ -->
          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
      <?php
         include('components/inc/right.php');
      ?>

        </div>
        <!-- End Right side columns -->

      </div>
    </section>

    <script>
    
    // Function to refresh the content of the div
    function refreshContent() {
        $.ajax({
            url: '/components/main/posts/posts.php', 
            type: 'GET',
            success: function(response) {
                // Update the content of the div with the response from PHP
                $('.realtimePostsDiv').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
    
 $(document).ready(function() {
    // Call the refreshContent function initially
    refreshContent();
});

    


 


///////////////////


socket.on('new_post_s',(data)=>{
  refreshContent();

  console.log('posts refresh');
      
})


    
    </script>

