
<!-- Button trigger modal -->
<button type="button" id="plus-delete" hidden class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalDelete">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> حذف عنصر </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" dir="rtl">  

      <input type="text" name="post_id" id="post-id" value='' hidden  >
      <input type="text" name="id" id="delete-id" value='' hidden  >
      <input type="text" name="table" id="delete-table" value='' hidden  >
      <input type="text" name="status" id="delete-status" value='' hidden  >
           سيتم حذف هذا العنصر . هل انت متاكد؟
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal"> لا </button>
        <button type="button" class="btn btn-danger" id="delete-post"> نعم </button>
      </div>
    </div>
  </div>
</div>

<script>    

 $(document).ready(()=>{



        $('#delete-post').click(()=>{
          var id= $('#delete-id').val();
          var table = $('#delete-table').val();
          var status = $('#delete-status').val();
          var post_id = $('#post-id').val();
          var formData = new FormData();
          formData.append('table',table);
          formData.append('id',id);
          formData.append('status',status);
          $('.btn-close').click();
          console.log(id +'----'+table);
          $('#'+status+id).hide();

                    $.ajax({
                        url: './../../controllers/deleteController.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                          // $(this).hide();

                          if(status==='post'){
                                      socket.emit('new_post',formData);
                          }else{
                                      socket.emit('new_comment',post_id);
                          }
                           
                          var res = JSON.parse(response);
                          console.log(res);
                            //alert('Data saved successfully.');
                            // Additional code to handle the response if needed
                        },
                        error: function(xhr, status, error) {
            
                            alert('Error occurred. Please try again.');
                        }
                    });
                });
         
              
            




        });
               

</script>