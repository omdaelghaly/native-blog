<!-- Button trigger modal -->
<button type="button" id="addreply" hidden class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalR">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalR" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

     <form id="form-recursion" enctype="multipart/form-data">
      <div class="modal-body p-0 m-0">

        <textarea type="text" class="form-control p-2 m-0" id="reply" name="comment" value="" placeholder="write your reply....."></textarea>
        <input type="number" name="post_id" id="postid" value="" hidden>
        <input type="number" name="commentid" id="commentid" value="" hidden>
        <input type="number" name="parentid" id="parentid" value="" hidden>
        <input type="file" name="images"  hidden>
        <input type="file" name="files"  hidden>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="closepop" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="recursivebtn" class="btn btn-primary">Save </button>
      </div>
    </form>

    </div>
  </div>
</div>


<script type="text/javascript">

     $('#form-recursion').submit(function(e){
            e.preventDefault();
          var post_id = $('#postid').val();
          var formData = new FormData(this);
        //console.log(formData);

              $.ajax({
                  url: './../../controllers/commentController.php',
                  type: 'POST',
                  data: formData,
                  contentType: false,
                  processData: false,
                  success: function(response) {
                    $('#reply').val('');
                    $('#closepop').click();

                  loadcomments(post_id);

                 // socket.emit('new_comment','<?php //echo $postId; ?>');

                    var res = JSON.parse(response);
                    console.log(res);
                      //alert('Data saved successfully.');
                      // Additional code to handle the response if needed
                  },
                  error: function(xhr, status, error) {


                      alert('Error occurred. Please try again.');
                  }
              });


          })

</script>
