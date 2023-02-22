<?php
// require_once 'admin-functions.php'
?>
<div class="welcome-back">
    <div class="d-flex">
        <div class="flex-15 align-item-center text-center">
            <img src="<?php echo BASE_URL . $admin->get_user_image() ;?>" alt="" srcset="" class="w-120 rounded-circle">
        </div>
        <div class="flex-80 d-flex justify-content-center flex-column">
            <h2 class="">
                Welcome Back, <span><?php echo $admin->get_user_first_name(); ?> !</span>
            </h2>
            <div class="d-block">
                <p>
                    current time goes here
                </p>
            </div>
        </div>
    </div>
</div>