<?php
// require_once 'admin-functions.php'
?>
<div class="welcome-back">
    <div class="d-flex">
        <div class="flex-15 align-item-center text-center">
            <img src="<?php echo !empty($admin->get_user_image()) ? BASE_URL . $admin->get_user_image() : BASE_URL . "assets/images/defaults/" . $admin->get_default_user_image(); ?>" alt="" srcset="" class="w-120 rounded-circle">
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
<div class="dashboard-block">
    <div class="row">
        <div class="col-md-3">
            <div class="stats-block ">
                <div class="d-flex w-100 gap-10">
                    <div class="d-flex flex-25">
                        <img src="<?php echo BASE_URL ."assets/images/dashboard/1.png"?>" alt="" class=" img-fluid dashboard-icon">
                    
                    </div>
                    <div class="d-flex flex-70">
                        <div>
                            <span class="data-number">250</span>
                            <h4 class="data-heading">OPD Today</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-block">
                <div class="d-flex w-100 gap-10">
                    <div class="d-flex flex-30">
                    <img src="<?php echo BASE_URL ."assets/images/dashboard/2.png"?>" alt="" class=" img-fluid dashboard-icon">
                    
                    </div>
                    <div class="d-flex flex-70">
                        <div>
                            <span class="data-number">89</span>
                            <h4 class="data-heading">Relieved Today</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-block">
                <div class="d-flex w-100 gap-10">
                    <div class="d-flex flex-30">
                    <img src="<?php echo BASE_URL ."assets/images/dashboard/3.png"?>" alt="" class=" img-fluid dashboard-icon">
                    
                    </div>
                    <div class="d-flex flex-70">
                        <div>
                            <span class="data-number">300</span>
                            <h4 class="data-heading">In Patient Today</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-block">
                <div class="d-flex w-100 gap-10">
                    <div class="d-flex flex-30">
                    <img src="<?php echo BASE_URL ."assets/images/dashboard/4.png"?>" alt="" class=" img-fluid dashboard-icon">
                    
                    </div>
                    <div class="d-flex flex-70">
                        <div>
                            <span class="data-number">52</span>
                            <h4 class="data-heading">Ventilator</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="dual-stats-block">
    <div class="row">
        <div class="col-md-6">
            <div class="stats-block" style="height:40vh">
            <canvas id="myChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="stats-block">
                <table class="table align-middle mb-3 table-blue datatable" id="dashboard-follow-up-table">
                    <thead>

                    <tr>
                        <th>
                            Sr No.
                        </th>
                        <th>
                            Full Name
                        </th>
                        <th>
                            Follow up With
                        </th>
                        <th>
                            Last Visit
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Test Test</td>
                            <td>DR T</td>
                            <td>15</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Test Test</td>
                            <td>DR T</td>
                            <td>15</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>