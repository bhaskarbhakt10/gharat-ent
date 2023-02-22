<?php
require_once 'admin-functions.php';
?>

<aside class="sidebar-menu" id="sidebar-menu">
    <div class="">
        <div class="">
            <div class="user-image text-center mb-3">
                <img src="<?php echo  BASE_URL . $admin->get_user_image();?>" class="rounded-circle online-status user-image-img" alt="User Image">
            </div>
            <div class="user-desc text-center mb-3">
                <p class="user-name "><?php echo $admin->get_user_name() ;?>
                </p>
                <p class="user-email">
                   <?php echo $admin->get_user_email();?>
                    <span class="user-role d-block"><?php echo $admin->get_user_rank() ;?></span>
                </p>
            </div>
        </div>
        <ul class="aside-menu" id="aside-menu">
            <li>
                <span><i class="fa-duotone fa-gauge"></i></span>
                <a href="index.php?q=admin-dashboard" class="active">Dashboard</a>
            </li>
            <li>
                <a href="#" class="active">
                    <span>
                    <i class="fa-duotone fa-users"></i>
                    </span>
                Users</a>
                <ul>
                    <li><a href="index.php?q=admin-create-users">Create users</a></li>
                    <li><a href="index.php?q=admin-list-users">List users</a></li>
                </ul>
            </li>
            <?php /*<li>
                <a href="#">
                    <span>
                        <i class="fa-duotone fa-user-doctor"></i>
                    </span>
                    Docters</a>
                <ul>
                    <li><a href="index.php?q=admin-add-docters">Add Docters</a></li>
                    <li><a href="index.php?q=admin-list-docters">List Docters</a></li>
                </ul>
            </li> */?>
            <li>
                <a href="#">
                    <span>
                        <i class="fa-duotone fa-bed-pulse"></i>
                    </span>
                    Patients</a>
                <ul>
                    <li><a href="index.php?q=admin-add-patients">Add Patients</a></li>
                    <li><a href="index.php?q=admin-list-patients">List Patients</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <span><i class="fa-duotone fa-door-open"></i></span>
                    Room
                </a>
                <ul>
                    <li><a href="index.php?q=admin-add-room"> Add Room</a></li>
                    <li><a href="index.php?q=admin-list-room"> List rooms</a></li>
                </ul>
            </li>
            <li>
                <a>
                    <span><i class="fa-duotone fa-door-open"></i></span>
                    Super Settings
                </a>
                <ul>
                    <li><a href="index.php?q=admin-super-admin-controls"> Access Control</a></li>
                </ul>
            </li>

            <?php
            /*
             example dropdown all classes are coming from js 
            <li>
                <a href="#">
                    Dropdown
                </a>
                <ul>
                    <li><a href="#"><i class="fab fa-facebook"></i>CSS3 Animation</a></li>
                    <li><a href="#">General</a></li>
                    <li><a href="#">Buttons</a></li>
                    <li><a href="#">Tabs & Accordions</a></li>
                    <li><a href="#">Typography</a></li>
                    <li><a href="#">FontAwesome</a></li>
                    <li><a href="#">Slider</a></li>
                    <li><a href="#">Panels</a></li>
                    <li><a href="#">Widgets</a></li>
                    <li><a href="#">Bootstrap Model</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    Dropdown2
                </a>
                <ul>
                    <li><a href="#">CSS3 Animation</a></li>
                    <li><a href="#">General</a></li>
                    <li><a href="#">Buttons</a></li>
                    <li><a href="#">Tabs & Accordions</a></li>
                    <li><a href="#">Typography</a></li>
                    <li><a href="#">Bootstrap Model</a></li>
                </ul>
            </li>
            */
            ?>
        </ul>
    </div>
</aside>