<?php
// remaining 
?>
<form action="<?php $uri = explode('/', $_SERVER['REQUEST_URI']);
                        echo '/' . $uri[1] . "/hospital-management/backend/actions/users/update-userprofile.php"; ?>" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-2">
            <div class="img-wrapper">
                <img src="<?php echo !empty($admin->get_user_image()) ? BASE_URL . $admin->get_user_image() : BASE_URL . "assets/images/defaults/" . $admin->get_default_user_image() ?>" class="w-100 rounded-circle user-image-img">
            </div>
        </div>
        <div class="col-md-10">
            <div class="edit-row pt-1 pb-2">
            <div class="d-flex flex-wrap align-items-center">
                <div class="d-flex flex-90">
                    <p class="d-none" id="edit-mssg">Hey <span><?php echo $admin->get_user_first_name(); ?></span>, start editing your details</p>

                </div>
                <div class="d-flex flex-10">
                    <button class="btn btn-primary edit-profile"><i class="fa-duotone fa-user-pen"></i></i></button>
                </div>
            </div>
            </div>
            <div class="main-form" id="edit-form">
                <h3>Basic Details</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="profile-first-name">First Name</label>
                            <input type="text" name="profile-first-name" id="profile-first-name" class="form-control form-field border" readonly value="<?php echo $admin->get_user_first_name(); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="profile-last-name">Last Name</label>
                            <input type="text" name="profile-last-name" id="profile-last-name" class="form-control form-field border" readonly value="<?php  echo $admin->get_user_last_name(); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="profile-last-name">Last Name</label>
                            <input type="tel" name="profile-phone-number" id="profile-phone-number" class="form-control form-field border" readonly value="<?php  echo $admin->get_user_phone(); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="profile-email">Email</label>
                            <input type="email" name="profile-email" id="profile-email" class="form-control form-field border" readonly value="<?php  echo $admin->get_user_email(); ?>">
                        </div>
                    </div>
                    <?php if($_SESSION['user']['rank'] === "2") { ?>
                        <?php
                        if( $admin->get_user_otherInfo() === true){
                            $other_info = json_decode($admin->get_user_otherInfo(), true);
                        }
                        else{
                            $other_info = '';
                        }
                          
                        ?>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="profile-email">Degrees</label>
                            <input type="text" name="profile-degree" id="profile-degree" class="form-control form-field border" readonly value="<?php echo (!empty($other_info['profile-degree']) ) ? $other_info['profile-degree']: ''; ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="profile-email">Specialization</label>
                            <input type="text" name="profile-specialization" id="profile-specialization" class="form-control form-field border" readonly value="<?php echo (!empty($other_info['profile-specialization'])) ? $other_info['profile-specialization'] : '' ; ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="profile-email">Registration Number</label>
                            <input type="text" name="profile-regno" id="profile-regno" class="form-control form-field border" readonly value="<?php  echo (!empty($other_info['profile-regno'])) ? $other_info['profile-regno'] : '' ; ?>">
                        </div>
                    </div>
                    <?php } ?>
                    <div class="col-md-12">
                        <button class="btn btn-primary d-none " name="update-profile">Update profile</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id'] ;?>">
</form>