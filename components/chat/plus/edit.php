
<!-- Button trigger modal -->
<button type="button" id="plus-edit-msg" hidden class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalEditMsg">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalEditMsg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">تحرير عنصر</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0 m-0">
<!-- ==================================================================== -->
<form action=""  id="form-msg" class="post-box" enctype="multipart/form-data">
          <textarea class="col-12 p-0 m-0 px-2 border-0" name="msg_edit" dir="rtl" id="msg_edit"  ></textarea>
          <div class="d-flex justify-content-between align-items-center">
            <div>
            <input type="text" name="msg_id" id="msg_id" value='' hidden  >
            <!-- <input type="text" name="post_id" id="post-id" value='' hidden  >
              <input type="text" name="table" id="edit-table" value='' hidden  >
              <input type="text" name="status" id="edit-status" value=''  hidden >
 -->
              <!-- <input type="file" name="images[]" id="upload-photo" style="display: none;" accept=".jpg, .jpeg, .png, .gif" multiple>
              <label for="upload-photo" class="btn btn-sm btn-secondary"><i class="fas fa-camera"></i> Upload Photo</label>
              <input type="file"  name="files[]" id="upload-file" style="display: none;" accept=".docx, .doc, .pdf" multiple>
              <label for="upload-file" class="btn btn-sm btn-secondary"><i class="fas fa-file"></i> Upload File</label> -->
            </div>
            <!-- <button id="save-post" type="submit" class="btn btn-primary">Post</button> -->
          </div>
        </form>
<!-- ===================================================================== -->
      </div>
      <div class="modal-footer p-0 m-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء </button>
        <button type="button" class="btn btn-primary" id="edit_msg_btn" >حفظ التعديل </button>
      </div>
    </div>
  </div>
</div>


<script>    

 $(document).ready(()=>{

//edit msg
        $('#edit_msg_btn').click(()=>{
          var msg_id= $('#msg_id').val();
          var msg = $('#msg_edit').val();
          
          var formData = new FormData();
          // alert(id+'---'+post_id+'==='+status);
          formData.append('msg_id',msg_id);
          formData.append('msg',msg);
          formData.append('process','editMsg');
          

          $('.btn-close').click();
                    $.ajax({
                        url: './../../controllers/chatController.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                         refreshMessagesBox(u_id); //refresh here


                          var res = JSON.parse(response);
                             // console.log(res.data['my_id']);
                             // console.log(res.data['other_id']);

                         socket.emit('new_msg',res.data['my_id'] ,res.data['other_id']);///refresh other user

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