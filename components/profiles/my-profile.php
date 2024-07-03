<?php
if (!isset($_SESSION['id'])) {
  echo "<script>window.location.href = './../../../index.php';</script>";
  exit();
}
?>

  <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/index.php">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img class="profile_image_x" src="/assets/images/profiles/<?php echo $_SESSION['image'] ?>" alt="Profile" style="width:80px;height:80px;border-radius:50% ;" class="rounded-circle">
              <h2 class="fullName_x"><?php echo $_SESSION['name']? $_SESSION['name']:' ';?></h2>
              <h3 class="job_x"><?php echo isset($_SESSION['job'])?$_SESSION['job']:' ' ?></h3>
              <div class="social-links mt-2">
                <a class="twitter_x" href="<?php echo isset($_SESSION['twitter'])?$_SESSION['twitter']:'#' ?>" class="twitter"><i class="bi bi-twitter"></i></a>
                <a class="facebook_x" href="<?php echo isset($_SESSION['facebook'])?$_SESSION['facebook']:'#' ?>" class="facebook"><i class="bi bi-facebook"></i></a>
                <a class="instagram_x" href="<?php echo isset($_SESSION['instagram'])?$_SESSION['instagram']:'#' ?>" class="instagram"><i class="bi bi-instagram"></i></a>
                <a class="linkedin_x" href="<?php echo isset($_SESSION['linkedin'])?$_SESSION['linkedin']:'#' ?>" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic about_x">
                  <?php echo isset($_SESSION['about'])?$_SESSION['about']:' ' ?>
                  </p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8 fullName_x"><?php echo isset($_SESSION['name'])?$_SESSION['name']:'' ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company</div>
                    <div class="col-lg-9 col-md-8 company_x"><?php echo isset($_SESSION['company'])?$_SESSION['company']:'' ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Job</div>
                    <div class="col-lg-9 col-md-8 job_x"><?php echo isset($_SESSION['job'])?$_SESSION['job']:'' ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8 country_x"><?php echo isset($_SESSION['country'])?$_SESSION['country']:'' ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8 address_x"><?php echo isset($_SESSION['address'])?$_SESSION['address']:'' ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8 phone_x"><?php echo isset($_SESSION['phone'])?$_SESSION['phone']:'' ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8 email_x"><?php echo isset($_SESSION['email'])?$_SESSION['email']:'' ?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form id="profile_update_form" action="" enctype="multipart/form-data">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img class="profile_image_x" src="/assets/images/profiles/<?php echo isset($_SESSION['image'])?$_SESSION['image']:'' ?>" alt="Profile">
                        <div class="pt-2 ">
                          <a href="#" id="profile_image_icon" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <a href="#" id="delete_profile_image" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                           <!--  -->
                             <input type="file" name="profile_image_upload[]" id="profile_image_upload" multiple hidden accept="image/*">
                           <!--  -->
                      </div>
                    </div>

                    <div class="row mb-3 ">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input onkeyup="update_val('fullName')" name="fullName" type="text" class="form-control" id="fullName" value="<?php echo isset($_SESSION['name'])?$_SESSION['name']:'full name' ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea onkeyup="update_val('about')" name="about" class="form-control" id="about" style="height: 100px"><?php echo isset($_SESSION['about'])?$_SESSION['about']:'Write something about u' ?></textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                      <div class="col-md-8 col-lg-9">
                        <input onkeyup="update_val('company')" name="company" type="text" class="form-control" id="company" value="<?php echo isset($_SESSION['company'])?$_SESSION['company']:' place of work' ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                      <div class="col-md-8 col-lg-9">
                        <input onkeyup="update_val('job')" name="job" type="text" class="form-control" id="job" value="<?php echo isset($_SESSION['job'])?$_SESSION['job']:'your current job' ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                      <div class="col-md-8 col-lg-9">
                        <input onkeyup="update_val('country')" name="country" type="text" class="form-control" id="country" value="<?php echo isset($_SESSION['country'])?$_SESSION['country']:' your country' ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input onkeyup="update_val('address')" name="address" type="text" class="form-control" id="address" value="<?php echo isset($_SESSION['address'])?$_SESSION['address']:'your address' ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input onkeyup="update_val('phone')" name="phone" type="text" class="form-control" id="phone" value="<?php echo isset($_SESSION['phone'])?$_SESSION['phone']:'your phone' ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input onkeyup="update_val('email')" name="email" type="email" class="form-control" id="email" value="<?php echo isset($_SESSION['email'])?$_SESSION['email']:'your email' ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input onkeyup="update_val('twitter')" name="twitter" type="text" class="form-control" id="twitter" value="<?php echo isset($_SESSION['twitter'])?$_SESSION['twitter']:'twitter link' ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input onkeyup="update_val('facebook')" name="facebook" type="text" class="form-control" id="facebook" value="<?php echo isset($_SESSION['facebook'])?$_SESSION['facebook']:'facebook link' ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input onkeyup="update_val('instagram')" name="instagram" type="text" class="form-control" id="instagram" value="<?php echo isset($_SESSION['instagram'])?$_SESSION['instagram']:'instagram link' ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input onkeyup="update_val('linkedin')" name="linkedin" type="text" class="form-control" id="linkedin" value="<?php echo isset($_SESSION['linkedin'])?$_SESSION['linkedin']:'linked in link' ?>">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" id="profile_update_btn">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  <!-- End #main -->

<script>

$(document).ready(()=>{
 
    $('#profile_image_icon').click(()=>{
         $('#profile_image_upload').click();
    })


    ////////////update profile
    $('#profile_update_btn').prop('disabled', false)
    $('#profile_update_form').submit(function(e) {
        e.preventDefault(); // Prevent normal form submission
        $('#profile_update_btn').prop('disabled', true).addClass('disabled').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading... `);
      
        var formData = new FormData(this);
            formData.append('process','update_profile');
            // console.log(formData.get('fullName'));
        $.ajax({
            url: './../../controllers/processController.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
              $('#profile_update_btn').prop('disabled', false).removeClass('disabled').html('Save Changes');

              var res = JSON.parse(response);
              console.log(res);
                //alert('Data saved successfully.');
                // Additional code to handle the response if needed
            },
            error: function(xhr, status, error) {
              $('#profile_update_btn').prop('disabled', false).removeClass('disabled').html('Save Changes');

                alert('Error occurred. Please try again.');
            }
        });
        
    });


    ////////////
 
})


//update data
function update_val(el){
  $('#'+el).on('keyup',()=>{
  var i = $('#'+el).val();
  $('.'+el+'_x').html(i);
   })

}
//update image
$('#profile_image_upload').on('change', function(event) {
        var file = event.target.files[0];
      //  var imageDataContainer = $('#imageData');

        var reader = new FileReader();
        reader.onload = function(e) {
            $('.profile_image_x').attr('src', e.target.result);
        };

        reader.readAsDataURL(file);
    });
////delete image
$('#delete_profile_image').click((e) => {
  e.preventDefault(); // Prevent the default action 
  $('.profile_image_x').attr('src', '/assets/images/profiles/default.jpg'); // Set the src attribute 
});


</script>
 