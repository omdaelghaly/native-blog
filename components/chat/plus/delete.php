
<!-- Button trigger modal -->
<button type="button" id="plus-delete-msg" hidden class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalDeleteMsg">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalDeleteMsg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> حذف عنصر </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" dir="rtl">  

      <input type="text" name="del_msg_id" id="del_msg_id" value='' hidden  >
     <!--  <input type="text" name="id" id="delete-id" value='' hidden  >
      <input type="text" name="table" id="delete-table" value='' hidden  >
      <input type="text" name="status" id="delete-status" value='' hidden  > -->
           سيتم حذف هذا العنصر . هل انت متاكد؟
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal"> لا </button>
        <button type="button" class="btn btn-danger" id="delete-msg-btn"> نعم </button>
      </div>
    </div>
  </div>
</div>

<script>    

 $(document).ready(()=>{



        $('#delete-msg-btn').click(()=>{
          var id= $('#del_msg_id').val();

          var formData = new FormData();
          formData.append('msg_id',id);
          formData.append('process','deleteMsg');
          $('.btn-close').click();
          // console.log(id +'----'+table);
          // $('#'+status+id).hide();

                    $.ajax({
                        url: './../../controllers/chatController.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                          // $(this).hide();
                          refreshMessagesBox(u_id); //refresh here
                          var res = JSON.parse(response);
                                //console.log(res);

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