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
                    <div class="main-body-wrapper">
                        <?php
                        $dir = "../admin";
                        $all_dir = scandir($dir);
                        if(array_key_exists('q', $_GET)){
                            $load_file = $_GET['q'];
                            foreach($all_dir as $d){
                                if($d === $load_file.".php")
                                {
                                    require_once './'.$load_file.'.php';
                                }
    
                            }
                        }
                        
                        
                        ?>

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