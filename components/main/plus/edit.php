
<!-- Button trigger modal -->
<button type="button" id="plus-edit" hidden class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalEdit">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">تحرير عنصر</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
<!-- ==================================================================== -->
<form action=""  id="form-post" class="post-box" enctype="multipart/form-data">
          <textarea rows="3" name="post" dir="rtl" id="AreaEdit"  ></textarea>
          <div class="d-flex justify-content-between align-items-center">
            <div>
            <input type="text" name="id" id="edit-id" value='' hidden  >
            <input type="text" name="post_id" id="post-id" value='' hidden  >
              <input type="text" name="table" id="edit-table" value='' hidden  >
              <input type="text" name="status" id="edit-status" value=''  hidden >

              <input type="file" name="images[]" id="upload-photo" style="display: none;" accept=".jpg, .jpeg, .png, .gif" multiple>
              <label for="upload-photo" class="btn btn-sm btn-secondary"><i class="fas fa-camera"></i> Upload Photo</label>
              <input type="file"  name="files[]" id="upload-file" style="display: none;" accept=".docx, .doc, .pdf" multiple>
              <label for="upload-file" class="btn btn-sm btn-secondary"><i class="fas fa-file"></i> Upload File</label>
            </div>
            <!-- <button id="save-post" type="submit" class="btn btn-primary">Post</button> -->
          </div>
        </form>
<!-- ===================================================================== -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء </button>
        <button type="button" class="btn btn-primary" id="edit_post_comment" >حفظ التعديل </button>
      </div>
    </div>
  </div>
</div>


<script>    

 $(document).ready(()=>{

//edit post or comment 

        $('#edit_post_comment').click(()=>{
          var id= $('#edit-id').val();
          var table = $('#edit-table').val();
          var status = $('#edit-status').val();
          var newData = $('#AreaEdit').val();
          var post_id = $('#post-id').val();
          var formData = new FormData();
          // alert(id+'---'+post_id+'==='+status);
          formData.append('table',table);
          formData.append('id',id);
          formData.append('status',status);
          formData.append('newData',newData);
          formData.append('post_id',post_id);
          var images = $('#upload-photo')[0].files; // Get selected image 
        for (var i = 0; i < images.length; i++) {
            formData.append('images['+i+']', images[i]);
        }
        var files = $('#upload-file')[0].files; // Get selected  files
        for (var i = 0; i < files.length; i++) {
            formData.append('files['+i+']', files[i]);
        }
          

          $('.btn-close').click();
                    $.ajax({
                        url: './../../controllers/editController.php',
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