<?php require_once '../components/header.php'; ?>

<main class="main-class viewport">
    <div class="">
        <div class="d-flex">
            <div class="flex-20 viewport">
                <?php require_once '../admin/inc/admin-nav-side.php'; ?>
            </div>
            <div class="flex-80 viewport bg-light-white">
                <div class="header">
                    <?php require_once '../admin/inc/admin-nav-top.php'; ?>
                </div>
                <div class="main-body">
                    <div class="welcome-back-wrapper">
                        <?php require_once '../admin/inc/admin-welcome.php';?>
                    </div>
                </div>
                <div class="footer-wrap">
                    <?php require_once '../admin/inc/admin-nav-bottom.php';?>
                </div>
            </div>
        </div>
    </div>
</main>




















<?php require_once '../components/footer.php'; ?>