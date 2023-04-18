<?php require_once '../components/header.php'; ?>

<main class="main-class viewport">
    <div class="">
        <div class="d-flex flex-wrap">
            <div class="flex-20 w-20 viewport">
                <?php require_once '../admin/inc/admin-nav-side.php'; ?>
            </div>
            <div class="flex-80 w-80 viewport bg-light-white bg_theme_blue <?php echo !empty($_GET['q']) ? $_GET['q'] : '' ;?>">
                <div class="header">
                    <?php require_once '../admin/inc/admin-nav-top.php'; ?>
                </div>
                <div class="main-body">
                    <div class="main-body-wrapper">
                        <?php
                        $dir = "../admin";
                        $all_dir = scandir($dir);
                        $user_rank = $_SESSION['user']['rank'];
                        switch ($user_rank) {
                            case '0':
                                $admin_allowed_arr = array();
                                unset($all_dir[0]);
                                unset($all_dir[1]);
                                foreach ($all_dir as $all_access) {
                                    array_push($admin_allowed_arr, preg_replace('/.php/', '', $all_access));
                                }
                                break;
                            case '1':
                                $admin_allowed_arr = array('admin-dashboard', 'admin-create-users', 'admin-list-users', 'admin-list-table-users','admin-user-profile', 'admin-log-out');
                                break;
                            case '2':
                                $admin_allowed_arr = array('admin-dashboard', 'admin-add-patients', 'admin-list-patients', 'admin-single-patient', 'admin-update-daily-check-up', 'admin-list-prescriptions', 'admin-single-prescription', 'template-prescription','admin-user-profile', 'admin-log-out');
                                break;
                            case '3':
                                $admin_allowed_arr = array('admin-dashboard', 'admin-add-patients', 'admin-list-patients', 'admin-single-patient', 'admin-update-daily-check-up', 'admin-list-prescriptions', 'admin-single-prescription', 'template-prescription','admin-user-profile', 'admin-log-out');
                                break;
                            case '4':
                                $admin_allowed_arr = array('admin-dashboard', "admin-add-patients", "admin-list-prescriptions", "admin-single-prescription", 'template-prescription','admin-user-profile', 'admin-log-out');
                                break;
                            case '5':
                            default:
                                # code...
                                break;
                        }
                        // var_dump($admin_allowed_arr);
                        if (array_key_exists('q', $_GET)) {
                            $load_file = $_GET['q'];
                            if (!empty($admin_allowed_arr) && in_array($load_file, $admin_allowed_arr)) {
                                foreach ($all_dir as $d) {
                                    if ($d === $load_file . ".php") {
                                        require_once './' . $load_file . '.php';
                                    }
                                }
                            } else {
                                require_once './inc/admin-access-denied.php';
                            }
                        }


                        ?>

                    </div>

                </div>
                <div class="footer-wrap">
                    <?php require_once '../admin/inc/admin-nav-bottom.php'; ?>
                </div>
            </div>
        </div>
    </div>
</main>




















<?php require_once '../components/footer.php'; ?>