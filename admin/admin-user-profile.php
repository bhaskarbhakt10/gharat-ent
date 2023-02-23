<?php
// remaining 
?>
<form action="" method="POST" enctype="multipart/form-data">
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
                    <p>Hey <span><?php echo $admin->get_user_first_name(); ?></span>, start editing your details</p>

                </div>
                <div class="d-flex flex-10">
                    <button class="btn edit-profile"><i class="fa-duotone fa-user-pen"></i></i></button>
                </div>
            </div>
            </div>
            <div class="main-form">
                <h3>Basic Details</h3>
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="">First Name</label>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>